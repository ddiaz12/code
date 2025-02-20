<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Auth extends CI_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation', 'ftp']);
        $this->load->helper(['url', 'language', 'form', 'email_helper']);
        $this->load->model('UsuarioModel');
        $this->load->model('NotificacionesModel');
        $this->load->config('ftp_config');

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    private function connectFTP()
    {
        $config = $this->config->item('ftp');
        $this->ftp->connect($config);
    }

    private function disconnectFTP()
    {
        $this->ftp->close();
    }

    /**
     * Redirect if needed, otherwise display the user list
     */
    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // Redirige a la página de login
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('sedeco')) {
            show_error('You must be an administrator to view this page.');
        } else {
            $this->data['title'] = $this->lang->line('index_heading');
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            // Cargar el modelo de notificaciones
            $this->load->model('NotificacionesModel');

            // Obtener el usuario actual y su grupo
            $usuarios = $this->ion_auth->user()->row();
            $group = $this->ion_auth->get_users_groups($usuarios->id)->row();
            $groupName = $group->name;

            // Obtener las notificaciones y el conteo de notificaciones no leídas
            $notifications = $this->NotificacionesModel->getNotificationsGrupos($groupName);
            $this->data['notificaciones'] = $notifications;
            $this->data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

            // Obtén los usuarios desde Ion Auth
            $users = $this->ion_auth->users()->result();

            // Para cada usuario, obtén la información adicional y agrégala
            foreach ($users as $k => $user) {
                // Agrega grupos al usuario
                $user->groups = $this->ion_auth->get_users_groups($user->id)->result();
                // Agrega información adicional al usuario
                $additionalInfo = $this->UsuarioModel->getPorUsuario($user->id);

                if ($additionalInfo) {
                    $user->sujeto = $additionalInfo->nombre_sujeto;
                    $user->unidad = $additionalInfo->nombre;
                } else {
                    $user->sujeto = 'No especificado';
                    $user->unidad = 'No especificado';
                }
                $this->data['users'][$k] = $user;
            }

            $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'index', $this->data);
        }
    }


    /**
     * Log the user in
     */
    public function login()
    {
        $this->data['title'] = $this->lang->line('login_heading');

        // validate form input
        $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required', [
            'required' => 'El correo electrónico es obligatorio.'
        ]);
        $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required', [
            'required' => 'La contraseña es obligatoria.'
        ]);

        if ($this->form_validation->run() === TRUE) {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {

                // check user role and redirect accordingly
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('home', 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page

                $this->session->set_flashdata('error', 'Correo o contraseña incorrectos');
                $this->data['error'] = $this->session->flashdata('error');
                $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
                // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $this->data['message'] = $this->session->flashdata('message');
            $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

            $this->data['identity'] = [
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            ];

            $this->data['password'] = [
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
            ];
            $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
            //$this->blade->render('login' . DIRECTORY_SEPARATOR . 'login', $this->data);
        }
    }

    /**
     * Log the user out
     */
    public function logout()
    {
        $this->data['title'] = "Logout";

        // log the user out
        $this->ion_auth->logout();

        // redirect them to the login page
        redirect('auth/login', 'refresh');
    }

    /**
     * Change password
     */
    public function change_password()
    {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() === FALSE) {
            // display the form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = [
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
            ];
            $this->data['new_password'] = [
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            ];
            $this->data['new_password_confirm'] = [
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            ];
            $this->data['user_id'] = [
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id,
            ];

            // render
            $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'change_password', $this->data);
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/change_password', 'refresh');
            }
        }
    }

    /**
     * Forgot password
     */
    public function forgot_password()
    {
        // setting validation rules by checking whether identity is username or email
        if ($this->config->item('identity', 'ion_auth') != 'email') {
            $this->form_validation->set_rules('identity', 'correo electrónico', 'required');
        } else {
            $this->form_validation->set_rules('identity', 'correo electrónico', 'required|valid_email');
        }


        if ($this->form_validation->run() === FALSE) {
            $this->data['type'] = $this->config->item('identity', 'ion_auth');
            // setup the input
            $this->data['identity'] = [
                'name' => 'identity',
                'id' => 'identity',
            ];

            if ($this->config->item('identity', 'ion_auth') != 'email') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            // set any errors and display the form
            $this->data['message'] = $this->session->flashdata('message');
            $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
            $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'forgot_password', $this->data);
        } else {
            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

            if (empty($identity)) {
                // Email does not exist in the system
                $this->session->set_flashdata('error', 'El correo no esta registrado.');
                redirect("auth/forgot_password");
            }

            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                $correo = $identity->email;
                $titulo = 'Recuperación de contraseña';
                $contenido = 'Has clic en el link para recuperar tu contraseña: ';
                $contenido .= '<a href="' . base_url() . 'auth/reset_password/' . $forgotten['forgotten_password_code'] . '">Restablecer Contraseña</a>';

                // Send email
                $response = enviaCorreo($correo, $titulo, $contenido);

                if (strpos($response, 'cURL Error') === false) {
                    $this->session->set_flashdata('message', 'Se ha enviado un correo con instrucciones para restablecer tu contraseña.');
                    redirect("auth/login");
                } else {
                    $this->session->set_flashdata('error', 'No se pudo enviar el correo: ' . $response);
                    redirect("auth/forgot_password");
                }
            } else {
                $this->session->set_flashdata('error', 'No se pudo restablecer la contraseña. Inténtalo de nuevo.');
                redirect("auth/forgot_password", 'refresh');
            }
        }
    }



    /**
     * Reset password - final step for forgotten password
     *
     * @param string|null $code The reset code
     */
    public function reset_password($code = NULL)
    {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            // if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', 'nueva contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', 'confirmar contraseña', 'required');

            if ($this->form_validation->run() === FALSE) {
                // display the form

                // set the flash data error message if there is one
                $this->data['message'] = $this->session->flashdata('message');
                $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = [
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                ];
                $this->data['new_password_confirm'] = [
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                ];
                $this->data['user_id'] = [
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                ];
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                // render
                $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'reset_password', $this->data);
            } else {
                $identity = $user->{$this->config->item('identity', 'ion_auth')};

                // do we have a valid request?
                if ($user->id != $this->input->post('user_id')) {

                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($identity);

                    show_error($this->lang->line('error_csrf'));

                } else {
                    // finally change the password
                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        $this->session->set_flashdata('message', 'Contraseña cambiada exitosamente.');
                        // if the password was successfully changed
                        if ($this->input->is_ajax_request()) {
                            echo json_encode([
                                'status' => 'success',
                                'redirect_url' => site_url('auth/login'),
                                'message' => $this->ion_auth->messages()
                            ]);
                            return;
                        }

                        redirect("auth/login");
                    } else {
                        $this->session->set_flashdata('message', 'No fue posible cambiar la contraseña. Inténtalo de nuevo más tarde.');
                        redirect('auth/reset_password/' . $code);
                    }
                }
            }
        } else {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('error', 'No fue posible restablecer la contraseña. Inténtalo de nuevo.');
            redirect("auth/forgot_password", 'refresh');
        }
    }

    /**
     * Activate the user
     *
     * @param int         $id   The user ID
     * @param string|bool $code The activation code
     */
    public function activate($encoded_id, $code = FALSE)
    {
        $id = base64_decode($encoded_id);
        $activation = FALSE;

        if ($code !== FALSE) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            // redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            // redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    public function activatePendiente($encoded_id, $code = FALSE)
    {
        $id = base64_decode($encoded_id);
        $activation = FALSE;

        if ($code !== FALSE) {
            $activation = $this->ion_auth->activate($id, $code);
            return json_encode(['success' => true]);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['error' => 'Invalid request']);
        }
    }

    /**
     * Deactivate the user
     *
     * @param int|string|null $id The user ID
     */
    public function deactivate($id = NULL)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            show_error('You must be an administrator to view this page.');
        }

        $id = (int) $id;

        // Validar la solicitud AJAX
        if ($this->input->is_ajax_request()) {
            // Comprobar si se proporcionó el ID del usuario
            if ($id) {
                // Comprobar si se confirmó la desactivación
                $confirm = $this->input->post('confirm');
                if ($confirm == 'yes') {
                    // Desactivar al usuario
                    $this->ion_auth->deactivate($id);
                    // Enviar respuesta de éxito
                    //$this->output->set_output(json_encode(['success' => true]));
                    return json_encode(['success' => true]);
                }
            }
            // Si no se proporciona un ID válido o no se confirma la desactivación, enviar respuesta de error
            //$this->output->set_output(json_encode(['error' => 'Invalid request']));
            return json_encode(['error' => 'Invalid request']);
        }
    }

    public function pending_user($id)
    {
        try {
            $this->deactivate($id);
            $data = ['status' => 1];
            $this->ion_auth->update($id, $data);

            $user = $this->ion_auth->user($id)->row();
            $correo = $user->email;
            $name = $user->first_name;

            $titulo = 'Usuario pendiente';
            $contenido = "Hola $name, tu cuenta está pendiente de activar.";

            // Crear el enlace temporal
            $link = $this->create_temporary_link($id);

            // Agregar el enlace temporal al contenido del correo
            $contenido .= "\n\nPara completar tu registro, por favor sigue el siguiente enlace: $link";


            // Enviar correo electrónico usando la función enviaCorreo
            $response = enviaCorreo($correo, $titulo, $contenido);

            if (strpos($response, "cURL Error") === false) {
                // Correo enviado exitosamente
                $result = ['status' => 'success'];
            } else {
                // Error al enviar el correo
                $result = ['status' => 'error'];
            }
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['status' => 'errorCatch', 'message' => $e->getMessage()]);
        }
    }

    public function activate_from_pending($encoded_id)
    {
        $this->activatePendiente($encoded_id);
        $id = base64_decode($encoded_id);
        try {
            $data = array('status' => 0);
            $this->ion_auth->update($id, $data);

            // Obtener la información del usuario para el correo electrónico
            $user = $this->ion_auth->user($id)->row();
            $correo = $user->email;
            $name = $user->first_name;

            // Contenido del correo electrónico
            $titulo = 'Cuenta activada';
            $contenido = "Hola $name, tu cuenta ha sido activada correctamente.";

            // Enviar correo electrónico usando la función enviaCorreo
            $response = enviaCorreo($correo, $titulo, $contenido);

            if (strpos($response, "cURL Error") === false) {
                $result = ['status' => 'success'];
            } else {
                $result = ['status' => 'error'];
            }

            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['status' => 'errorCatch', 'message' => $e->getMessage()]);
        }
    }



    function uploadFile($file, $userId)
    {
        // Validación y subida del archivo
        try {
            if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) {
                $allowed_types = ['image/jpeg', 'image/png', 'application/pdf']; // Define los tipos de archivos permitidos
                $max_size = 4096; // Define el tamaño máximo del archivo en KB

                if ($_FILES['userfile']['size'] > $max_size * 1024) {
                    throw new Exception('El tamaño del archivo no debe exceder los 4 MB.');
                }
                if (!in_array($_FILES['userfile']['type'], $allowed_types)) {
                    throw new Exception('Formato de archivo no permitido. Solo se permiten archivos JPEG, PNG y PDF.');
                }

                // Subir el archivo por FTP antes de registrar el usuario
                $this->connectFTP();

                // Directorio de destino en el servidor FTP
                $upload_path = 'assets/ftp/';

                // Nombre del archivo en el servidor
                $file_name = $this->formatFileName($file['name'], $userId);
                $file_tmp = $file['tmp_name'];


                // Subir el archivo al servidor FTP
                if ($this->ftp->upload($file_tmp, $upload_path . $file_name, 'auto')) {
                    $file_path = $upload_path . $file_name;
                    $this->disconnectFTP();
                    return ['status' => 'success', 'file_path' => $file_path];
                } else {
                    throw new Exception('Error al subir el archivo por FTP.');
                }
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'file_error' => $e->getMessage()];
        }
        return ['status' => 'success'];
    }

    function formatFileName($name, $userId)
    {
        // Obtener la extensión del archivo
        $extension = pathinfo($name, PATHINFO_EXTENSION);

        // Obtener el nombre sin la extensión
        $nameWithoutExtension = pathinfo($name, PATHINFO_FILENAME);

        // Reemplazar espacios y caracteres no alfanuméricos por guiones bajos
        $nameWithoutExtension = preg_replace('/[^a-zA-Z0-9]/', '_', $nameWithoutExtension);

        // Convertir a minúsculas
        $nameWithoutExtension = strtolower($nameWithoutExtension);

        //Obtener fecha actual sin la hora
        $date = date('Ymd');

        // Añadir la fecha y id al nombre del archivo
        $newName = $nameWithoutExtension . '_' . $userId . '_' . $date . '.' . $extension;

        return $newName;
    }

    // Función para validar el archivo
    private function validateFile($file)
    {
        try {
            $allowed_types = ['image/jpeg', 'image/png', 'application/pdf']; // Define los tipos de archivos permitidos
            $max_size = 4096; // Define el tamaño máximo del archivo en KB

            if ($file['size'] > $max_size * 1024) {
                return ['status' => 'error', 'file_error' => 'El tamaño del archivo no debe exceder los 4 MB.'];
            }
            if (!in_array($file['type'], $allowed_types)) {
                return ['status' => 'error', 'file_error' => 'Formato de archivo no permitido. Solo se permiten archivos JPEG, PNG y PDF.'];
            }
            return ['status' => 'success'];
        } catch (Exception $e) {
            return ['status' => 'error', 'file_error' => $e->getMessage()];
        }
    }


    /**
     * Create a new user
     */
    public function create_user()
    {
        if (!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('sedeco')) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'No está autorizado para realizar esta acción.']);
                return;
            } else {
                redirect('auth', 'refresh');
            }
        }

        $this->load->model('NotificacionesModel');
        $usuarios = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($usuarios->id)->row();
        $groupName = $group->name;
        $this->data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // Validación del formulario
        $this->form_validation->set_rules(
            'first_name',
            'nombre',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'last_name',
            'primer apellido',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'ap2',
            'segundo apellido',
            'trim|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        //$this->form_validation->set_rules('tipoSujeto', 'tipo de sujeto obligado', 'trim|required');
        $this->form_validation->set_rules('sujetos', 'sujeto obligado', 'trim|required');
        $this->form_validation->set_rules('unidades', 'unidad administrativa', 'trim|required');
        $this->form_validation->set_rules('fecha', 'fecha alta en el cargo', 'trim|required');
        $this->form_validation->set_rules(
            'cargo',
            'cargo',
            'trim|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'titulo',
            'titulo',
            'trim|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'clave_empleado',
            'clave empleado',
            'trim|numeric',
            array(
                'numeric' => 'El campo %s debe ser numérico.'
            )
        );

        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', 'correo electrónico oficial', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', 'Correo electrónico oficial', 'trim|required|valid_email');
        } else {
            $this->form_validation->set_rules('email', 'Correo electrónico oficial', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules(
            'phone',
            'Teléfono',
            'required|regex_match[/^\(\d{3}\) \d{3}-\d{4}$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no tiene el formato correcto. Ejemplo: (123) 456-7890'
            )
        );
        $this->form_validation->set_rules(
            'ext',
            'extension',
            'trim|numeric|max_length[6]|min_length[2]',
            array(
                'numeric' => 'El campo %s debe ser numérico.',
                'max_length' => 'El campo %s no debe exceder los 6 caracteres.',
                'min_length' => 'El campo %s debe tener al menos 2 caracteres.'
            )
        );
        $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'confirmar contraseña', 'required');

        if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) {
            // Validar el archivo
            $upload_result = $this->validateFile($_FILES['userfile']);
            if ($upload_result['status'] === 'error') {
                if ($this->input->is_ajax_request()) {
                    echo json_encode($upload_result);
                    return;
                } else {
                    $this->data['file_error'] = $upload_result['file_error'];
                    $this->_render_page('auth/create_user', $this->data);
                    return;
                }
            }
        }

        // Validación de formulario
        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = [
                'first_name' => $this->input->post('first_name', true),
                'ap1' => $this->input->post('last_name', true),
                'ap2' => $this->input->post('ap2', true),
                'id_sujeto' => $this->input->post('sujetos'),
                'id_unidad' => $this->input->post('unidades'),
                'ext' => $this->input->post('ext'),
                'phone' => $this->input->post('phone'),
                'fecha_cargo' => $this->input->post('fecha'),
                'cargo' => $this->input->post('cargo', true),
                'titulo' => $this->input->post('titulo', true),
                'clave_empleado' => $this->input->post('clave_empleado')
            ];

            // Intentar registrar al usuario
            $userId = $this->ion_auth->register($identity, $password, $email, $additional_data);

            if ($userId) {
                if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) {
                    // Subida del archivo con el ID del usuario
                    $upload_result = $this->uploadFile($_FILES['userfile'], $userId);

                    if ($upload_result['status'] === 'success') {
                        $file_path = $upload_result['file_path'];

                        // Actualizar al usuario con la ruta del archivo
                        $this->ion_auth->update($userId, ['file_path' => $file_path]);
                    } else {
                        // Error al subir el archivo
                        $response = [
                            'status' => 'error',
                            'message' => $upload_result['file_error']
                        ];
                        echo json_encode($response);
                        return;
                    }
                }

                $response = [
                    'status' => 'success',
                    'message' => $this->ion_auth->messages(),
                    'redirect_url' => base_url('auth')
                ];
                echo json_encode($response);
                return;
            } else {
                // Error al registrar al usuario
                $response = [
                    'status' => 'error',
                    'message' => $this->ion_auth->errors()
                ];
                echo json_encode($response);
            }
        } else {
            // Validación del formulario fallida
            if ($this->input->is_ajax_request()) {
                $response = [
                    'status' => 'error',
                    'errores' => $this->form_validation->error_array()
                ];
                echo json_encode($response);
            } else {
                // Cargar datos necesarios para la vista
                //$this->data['tipos'] = $this->UsuarioModel->getTipoSujetoObligado();
                $this->data['unidades'] = $this->UsuarioModel->getUnidadesAdministrativas();
                $this->data['sujetos'] = $this->UsuarioModel->getSujetosObligados();

                // Mostrar vista con errores de validación
                $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'create_user', $this->data);
            }
        }
    }

    public function get_unidades_by_sujeto($sujeto_id)
    {
        $user = $this->ion_auth->user()->row();
        $user_id = $user->id;
        $unidades = $this->UsuarioModel->getUnidadesAdministrativasBySujeto($sujeto_id, $user_id);
        echo json_encode($unidades);
    }


    /**
     * Redirect a user checking if is admin
     */
    public function redirectUser()
    {
        if ($this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }
        redirect('/', 'refresh');
    }

    /**
     * Edit a user
     *
     * @param int|string $id
     */

    public function edit_user($encoded_id)
    {
        $id = base64_decode($encoded_id);

        if (!is_numeric($id)) {
            redirect('auth', 'refresh');
        }

        if (!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('sedeco')) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'No está autorizado para realizar esta acción.']);
                return;
            } else {
                redirect('auth', 'refresh');
            }
        }

        $this->load->model('NotificacionesModel');
        $usuarios = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($usuarios->id)->row();
        $groupName = $group->name;
        $this->data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules(
            'first_name',
            'nombre',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'last_name',
            'primer apellido',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'ap2',
            'segundo apellido',
            'trim|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'phone',
            'número de teléfono',
            'required|regex_match[/^\(\d{3}\) \d{3}-\d{4}$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no tiene el formato correcto. Ejemplo: (123) 456-7890'
            )
        );
        $this->form_validation->set_rules(
            'ext',
            'extension',
            'trim|numeric|max_length[6]|min_length[2]',
            array(
                'numeric' => 'El campo %s debe ser numérico.',
                'max_length' => 'El campo %s no debe exceder los 6 caracteres.',
                'min_length' => 'El campo %s debe tener al menos 2 caracteres.'
            )
        );
        //$this->form_validation->set_rules('tipoSujeto', 'tipo de sujeto obligado', 'trim|required');
        $this->form_validation->set_rules('sujetos', 'sujeto obligado', 'trim|required');
        $this->form_validation->set_rules('unidades', 'unidad administrativa', 'trim|required');
        $this->form_validation->set_rules('fecha', 'fecha alta en el cargo', 'trim|required');
        $this->form_validation->set_rules(
            'cargo',
            'cargo',
            'trim|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'titulo',
            'titulo',
            'trim|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'clave_empleado',
            'clave_empleado',
            'trim|numeric',
            array(
                'numeric' => 'El campo %s debe ser numérico.'
            )
        );
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[' .
                $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', 'confirmar contraseña', 'required');
        }

        if ($this->form_validation->run() === TRUE) {
            $upload_result = $this->uploadFile($_FILES['userfile'], $id);

            if ($upload_result['status'] === 'error') {
                if ($this->input->is_ajax_request()) {
                    echo json_encode($upload_result);
                    return;
                } else {
                    $this->data['file_error'] = $upload_result['file_error'];
                    $this->_render_page('auth/edit_user', $this->data);
                    return;
                }
            }

            $file_path = isset($upload_result['file_path']) ? $upload_result['file_path'] : null;

            // Eliminar el archivo anterior si existe en el servidor FTP, no es el mismo que el nuevo archivo y si el archivo nuevo no es nulo
            if (!empty($user->file_path) && $user->file_path !== $file_path && $file_path !== null) {
                $this->connectFTP();
                $this->ftp->delete_file($user->file_path);
                $this->disconnectFTP();
            }

            $data = [
                'first_name' => $this->input->post('first_name', true),
                'ap1' => $this->input->post('last_name', true),
                'ap2' => $this->input->post('ap2', true),
                'ext' => $this->input->post('ext'),
                'phone' => $this->input->post('phone'),
                'id_sujeto' => $this->input->post('sujetos'),
                'id_unidad' => $this->input->post('unidades'),
                'fecha_cargo' => $this->input->post('fecha'),
                'cargo' => $this->input->post('cargo', true),
                'titulo' => $this->input->post('titulo', true),
                'clave_empleado' => $this->input->post('clave_empleado')
            ];

            if ($file_path) {
                $data['file_path'] = $file_path;
            }

            if ($this->input->post('password')) {
                $data['password'] = $this->input->post('password');
            }

            // Only allow updating groups if user is admin
            if ($this->ion_auth->is_admin()) {
                $groupData = $this->input->post('groups');

                if (isset($groupData) && !empty($groupData)) {
                    $this->ion_auth->remove_from_group('', $id);

                    foreach ($groupData as $grp) {
                        $this->ion_auth->add_to_group($grp, $id);
                    }
                }
            }

            if ($this->ion_auth->update($user->id, $data)) {
                $response = [
                    'status' => 'success',
                    'message' => $this->ion_auth->messages(),
                    'redirect_url' => base_url('auth')
                ];
                echo json_encode($response);
            }
        } else {
            if ($this->input->is_ajax_request()) {
                $response = [
                    'status' => 'error',
                    'errores' => $this->form_validation->error_array()
                ];
                echo json_encode($response);
            } else {
                // display the edit user form
                $this->data['user'] = $user;
                $this->data['groups'] = $groups;
                $this->data['currentGroups'] = $currentGroups;

                $this->data['first_name'] = [
                    'name' => 'first_name',
                    'id' => 'first_name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('first_name', $user->first_name),
                ];
                $this->data['last_name'] = [
                    'name' => 'last_name',
                    'id' => 'last_name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('last_name', $user->ap1),
                ];
                $this->data['ap2'] = [
                    'name' => 'ap2',
                    'id' => 'ap2',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('ap2', $user->ap2),
                ];
                $this->data['ext'] = [
                    'name' => 'ext',
                    'id' => 'ext',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('ext', $user->ext),
                ];
                $this->data['phone'] = [
                    'name' => 'phone',
                    'id' => 'phone',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('phone', $user->phone),
                ];
                $this->data['fecha'] = [
                    'name' => 'fecha',
                    'id' => 'fecha',
                    'type' => 'date',
                    'value' => $this->form_validation->set_value('fecha', $user->fecha_cargo),
                ];
                $this->data['email'] = [
                    'name' => 'email',
                    'id' => 'email',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('email', $user->email),
                ];
                $this->data['password'] = [
                    'name' => 'password',
                    'id' => 'password',
                    'type' => 'password',
                ];
                $this->data['password_confirm'] = [
                    'name' => 'password_confirm',
                    'id' => 'password_confirm',
                    'type' => 'password',
                ];
                $this->data['cargo'] = [
                    'name' => 'cargo',
                    'id' => 'cargo',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('cargo', $user->cargo),
                ];
                $this->data['titulo'] = [
                    'name' => 'titulo',
                    'id' => 'titulo',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('titulo', $user->titulo),
                ];
                $this->data['clave_empleado'] = [
                    'name' => 'clave_empleado',
                    'id' => 'clave_empleado',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('clave_empleado', $user->clave_empleado),
                ];

                //$this->data['tipos'] = $this->UsuarioModel->getTipoSujetoObligado();
                $this->data['sujetos'] = $this->UsuarioModel->getSujetosObligados();
                $this->data['unidades'] = $this->UsuarioModel->getUnidadesAdministrativas();
                $this->data['users'] = $this->UsuarioModel->getPorUsuario($user->id);
                $this->data['archivo'] = $user->file_path;

                $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'edit_user', $this->data);
            }
        }
    }

    public function edit_user_pendiente($encoded_id)
    {
        $id = base64_decode($encoded_id);

        if (!is_numeric($id)) {
            // Redirige a la página de autenticación si el ID no es un número
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();

        // validate form input
        $this->form_validation->set_rules(
            'first_name',
            'nombre',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'last_name',
            'primer apellido',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'ap2',
            'segundo apellido',
            'trim|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'phone',
            'telefono',
            'trim|required|regex_match[/^\(\d{3}\) \d{3}-\d{4}$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no tiene el formato correcto. Ejemplo: (123) 456-7890'
            )
        );
        $this->form_validation->set_rules(
            'ext',
            'extension',
            'trim|numeric|max_length[6]|min_length[2]',
            array(
                'numeric' => 'El campo %s debe ser numérico.',
                'max_length' => 'El campo %s no debe exceder los 6 caracteres.',
                'min_length' => 'El campo %s debe tener al menos 2 caracteres.'
            )
        );
        $this->form_validation->set_rules(
            'cargo',
            'cargo',
            'trim|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'titulo',
            'titulo',
            'trim|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'clave',
            'clave',
            'trim|numeric',
            array(
                'numeric' => 'El campo %s debe ser numérico.'
            )
        );
        $this->form_validation->set_rules('sujetos', 'sujeto obligado', 'trim|required');
        $this->form_validation->set_rules('unidades', 'unidad administrativa', 'trim|required');
        $this->form_validation->set_rules('fecha', 'fecha alta en el cargo', 'trim|required');

        $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[' .
            $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'confirmar contraseña', 'required');


        if ($this->form_validation->run() === TRUE) {
            $upload_result = $this->uploadFile($_FILES['userfile'], $id);

            if ($upload_result['status'] === 'error') {
                if ($this->input->is_ajax_request()) {
                    echo json_encode($upload_result);
                    return;
                } else {
                    $this->data['file_error'] = $upload_result['file_error'];
                    $this->_render_page('auth/edit_user', $this->data);
                    return;
                }
            }

            $file_path = isset($upload_result['file_path']) ? $upload_result['file_path'] : null;

            // Eliminar el archivo anterior si existe en el servidor FTP, no es el mismo que el nuevo archivo y si el archivo nuevo no es nulo
            if (!empty($user->file_path) && $user->file_path !== $file_path && $file_path !== null) {
                $this->connectFTP();
                $this->ftp->delete_file($user->file_path);
                $this->disconnectFTP();
            }

            $data = [
                'first_name' => $this->input->post('first_name', true),
                'ap1' => $this->input->post('last_name', true),
                'ap2' => $this->input->post('ap2', true),
                'ext' => $this->input->post('ext'),
                'phone' => $this->input->post('phone'),
                'id_sujeto' => $this->input->post('sujetos'),
                'id_unidad' => $this->input->post('unidades'),
                'fecha_cargo' => $this->input->post('fecha'),
                'cargo' => $this->input->post('cargo', true),
                'titulo' => $this->input->post('titulo', true),
                'clave_empleado' => $this->input->post('clave')
            ];

            if ($file_path) {
                $data['file_path'] = $file_path;
            }

            if ($this->input->post('password')) {
                $data['password'] = $this->input->post('password');
            }

            //Notificar a administrador
            $notificacion = [
                'titulo' => 'Usuario pendiente de aprobación',
                'mensaje' => 'El usuario ' . $data['first_name'] . ' ' . $data['ap1'] . ' ' . ' ha completado su registro y está pendiente de aprobación.',
                'usuario_destino' => 'sedeco,admin',
                'id_regulacion' => null,
                'leido' => 0,
                'fecha_envio' => date('Y-m-d')
            ];

            $this->NotificacionesModel->crearNotificacion($notificacion);

            if ($this->ion_auth->update($user->id, $data)) {
                $response = [
                    'status' => 'success',
                    'message' => $this->ion_auth->messages(),
                    'redirect_url' => base_url('auth')
                ];
                echo json_encode($response);
            }
        } else {
            if ($this->input->is_ajax_request()) {
                $response = [
                    'status' => 'error',
                    'errores' => $this->form_validation->error_array()
                ];
                echo json_encode($response);
            }
        }
    }


    /**
     * Create a new group
     */
    public function create_group()
    {
        $this->data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('sedeco')) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'No está autorizado para realizar esta acción.']);
                return;
            } else {
                redirect('auth', 'refresh');
            }
        }

        $this->load->model('NotificacionesModel');
        $usuarios = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($usuarios->id)->row();
        $groupName = $group->name;
        $notifications = $this->NotificacionesModel->getNotifications($groupName);
        $this->data['notificaciones'] = $notifications;
        $this->data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotifications($groupName);

        // validate form input
        $this->form_validation->set_rules('group_name', 'nombre del grupo', 'required|alpha_dash');
        $this->form_validation->set_rules('description', 'descripción', 'required');

        if ($this->form_validation->run() === TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
// redirect them back to the admin page
                $response = [
                    'status' => 'success',
                    'message' => $this->ion_auth->messages(),
                    'redirect_url' => base_url('auth')
                ];
                echo json_encode($response);
            }
        } else {
            if ($this->input->is_ajax_request()) {
                $response = [
                    'status' => 'error',
                    'errores' => $this->form_validation->error_array()
                ];
                echo json_encode($response);
            } else {
                $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ?
                    $this->ion_auth->errors() : $this->session->flashdata('message')));

                $this->data['group_name'] = [
                    'name' => 'group_name',
                    'id' => 'group_name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('group_name'),
                ];
                $this->data['description'] = [
                    'name' => 'description',
                    'id' => 'description',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('description'),
                ];

                $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'create_group', $this->data);
            }
        }
    }


    /**
     * Edit a group
     *
     * @param int|string $id
     */
    public function edit_group($encoded_id)
    {
        $id = base64_decode($encoded_id);

        if (!is_numeric($id)) {
            redirect('auth', 'refresh');
        }
        // Verificar si se proporcionó un ID de grupo
        if (!$id || empty($id)) {
            redirect('auth', 'refresh');
        }

        // Verificar permisos de administrador
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $this->load->model('NotificacionesModel');
        $usuarios = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($usuarios->id)->row();
        $groupName = $group->name;
        $notifications = $this->NotificacionesModel->getNotifications($groupName);
        $this->data['notificaciones'] = $notifications;
        $this->data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        $group = $this->ion_auth->group($id)->row();

        // Validar entrada del formulario
        $this->form_validation->set_rules('group_name', 'nombre del grupo', 'trim|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_name = isset($_POST['group_name']) ? $_POST['group_name'] : '';
                $group_description = isset($_POST['group_description']) ? $_POST['group_description'] : '';

                $group_update = $this->ion_auth->update_group(
                    $id,
                    $group_name,
                    array(
                        'description' => $group_description
                    )
                );

                if ($group_update) {
                    if ($this->input->is_ajax_request()) {
                        $response = [
                            'status' => 'success',
                            'message' => $this->lang->line('edit_group_saved'),
                            'redirect_url' => base_url('auth')
                        ];
                        echo json_encode($response);
                        return;
                    } else {
                        $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                        redirect("auth", 'refresh');
                    }
                } else {
                    if ($this->input->is_ajax_request()) {
                        $response = [
                            'status' => 'error',
                            'message' => $this->ion_auth->errors()
                        ];
                        echo json_encode($response);
                        return;
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                    }
                }
            } else {
                if ($this->input->is_ajax_request()) {
                    $response = [
                        'status' => 'error',
                        'errores' => $this->form_validation->error_array()
                    ];
                    echo json_encode($response);
                    return;
                }
            }
        }

        // Definir el mensaje de error flash
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ?
            $this->ion_auth->errors() : $this->session->flashdata('message')));

        // Pasar el grupo a la vista
        $this->data['group'] = $group;

        $this->data['group_name'] = [
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
        ];
        if ($this->config->item('admin_group', 'ion_auth') === $group->name) {
            $this->data['group_name']['readonly'] = 'readonly';
        }

        $this->data['group_description'] = [
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        ];

        $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'edit_group', $this->data);
    }

    public function create_temporary_link($user_id = null)
    {
        // Generar un token único
        $token = bin2hex(random_bytes(16));
        // Definir la fecha de caducidad
        $expiration = date('Y-m-d H:i:s', strtotime('+3 days'));

        // Almacenar el token y la fecha de caducidad en la base de datos
        $data = [
            'id' => $user_id,
            'token' => $token,
            'expiration' => $expiration
        ];

        $this->db->insert('temporary_links', $data);

        // Crear el enlace temporal
        $link = base_url("auth/temporary_form/{$token}");

        return $link;
    }


    //Funcion para crear un link temporal
    /*
    public function send_temporary_link($user_id)
    {
        // Generar un token único
        $token = bin2hex(random_bytes(16));
        // Definir la fecha de caducidad (por ejemplo, 3 días a partir de ahora)
        $expiration = date('Y-m-d H:i:s', strtotime('+3 days'));

        // Almacenar el token y la fecha de caducidad en la base de datos
        $data = [
            'user_id' => $user_id,
            'token' => $token,
            'expiration' => $expiration
        ];

        $this->db->insert('temporary_links', $data);

        // Obtener la información del usuario
        $user = $this->ion_auth->user($user_id)->row();
        $email = $user->email;
        $name = $user->first_name;

        // Crear el enlace temporal
        $link = base_url("auth/temporary_form/{$token}");

        // Contenido del correo electrónico
        $titulo = 'Enlace temporal';
        $contenido = "Hola $name, has solicitado un enlace temporal para restablecer tu contraseña. 
        Haz clic en el siguiente enlace para continuar: $link";

        // Enviar el correo electrónico
        $response = enviaCorreo($email, $titulo, $contenido);

        if (strpos($response, "cURL Error") === false) {
            // Correo enviado exitosamente
            $result = ['status' => 'success'];
        } else {
            // Error al enviar el correo
            $result = ['status' => 'error'];
        }

        echo json_encode($result);
    }
        */

    public function temporary_form($token)
    {
        // Verificar si el token es válido
        $query = $this->db->get_where('temporary_links', ['token' => $token]);
        $link = $query->row();

        if ($link) {
            // Verificar si el token ha caducado
            if (strtotime($link->expiration) > time()) {
                // Obtener la información del usuario
                $user = $this->ion_auth->user($link->id)->row();

                $this->data['first_name'] = [
                    'name' => 'first_name',
                    'id' => 'first_name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('first_name', $user->first_name),
                ];
                $this->data['last_name'] = [
                    'name' => 'last_name',
                    'id' => 'last_name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('last_name', $user->ap1),
                ];
                $this->data['ap2'] = [
                    'name' => 'ap2',
                    'id' => 'ap2',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('ap2', $user->ap2),
                ];
                $this->data['ext'] = [
                    'name' => 'ext',
                    'id' => 'ext',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('ext', $user->ext),
                ];
                $this->data['phone'] = [
                    'name' => 'phone',
                    'id' => 'phone',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('phone', $user->phone),
                ];
                $this->data['fecha'] = [
                    'name' => 'fecha',
                    'id' => 'fecha',
                    'type' => 'date',
                    'value' => $this->form_validation->set_value('fecha', $user->fecha_cargo),
                ];
                $this->data['password'] = [
                    'name' => 'password',
                    'id' => 'password',
                    'type' => 'password',
                ];
                $this->data['password_confirm'] = [
                    'name' => 'password_confirm',
                    'id' => 'password_confirm',
                    'type' => 'password',
                ];

                // Mostrar el formulario
                $this->data['user'] = $this->UsuarioModel->getPorUsuario($user->id);
                $this->data['sujetos'] = $this->UsuarioModel->getSujetosObligados();
                $this->data['unidades'] = $this->UsuarioModel->getUnidadesAdministrativas();
                $this->data['archivo'] = $user->file_path;

                $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'temporary_form', $this->data);

            } else {
                // El token ha caducado
                echo 'El enlace temporal ha caducado.';
            }
        } else {
            // El token no es válido
            echo 'Enlace temporal no válido.';
        }
    }


    public function solicitar()
    {
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        // Reglas de validación
        $this->form_validation->set_rules(
            'first_name',
            'Nombre',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'last_name',
            'Primer apellido',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules(
            'ap2',
            'Segundo apellido',
            'trim|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'regex_match' => 'El campo %s no debe contener números ni caracteres especiales.'
            )
        );
        $this->form_validation->set_rules('sujetos', 'sujeto obligado', 'trim|required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', 'correo electrónico', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', 'correo electrónico', 'trim|required|valid_email');
        } else {
            $this->form_validation->set_rules('email', 'correo electrónico', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules(
            'phone',
            'número de teléfono',
            'required|regex_match[/^\(\d{3}\) \d{3}-\d{4}$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no tiene el formato correcto. Ejemplo: (123) 456-7890'
            )
        );

        // Validación de formulario
        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = '12345678';
            $additional_data = [
                'first_name' => $this->input->post('first_name', true),
                'ap1' => $this->input->post('last_name', true),
                'ap2' => $this->input->post('ap2', true),
                'phone' => $this->input->post('phone'),
                'created_on' => time(),
                'active' => 0,
                'status' => 1,
                'fecha_cargo' => date('Y-m-d'),
                'id_sujeto' => $this->input->post('sujetos'),
                'id_unidad' => $this->input->post('unidades'),
            ];

            $this->ion_auth->register($identity, $password, $email, $additional_data);

            // Enviar correo de notificación
            $titulo = "Solicitud de registro recibida";
            $contenido = "Hola " . $this->input->post('first_name') . ",\n\nHemos recibido tu solicitud de registro. Pronto revisaremos tu información y te notificaremos una vez que tu cuenta esté activada.\n\nGracias.";
            $correo_response = enviaCorreo($email, $titulo, $contenido);

            // Comprobar si el correo se envió con éxito
            if (strpos($correo_response, 'cURL Error #:') !== false) {
                log_message('error', 'Error al enviar el correo: ' . $correo_response);
            }

            //notificar al administrador
            $data = [
                'titulo' => 'Solicitud de registro',
                'mensaje' => 'Se ha recibido una solicitud de registro de ' . $this->input->post('first_name') . ' ' . $this->input->post('last_name') . '.',
                'usuario_destino' => 'sedeco,admin',
                'id_regulacion' => null,
                'leido' => 0,
                'fecha_envio' => date('Y-m-d')
            ];

            $this->NotificacionesModel->crearNotificacion($data);

            $response = [
                'status' => 'success',
                'message' => $this->ion_auth->messages(),
                'redirect_url' => base_url('auth')
            ];
            echo json_encode($response);
            return;
        } else {
            if ($this->input->is_ajax_request()) {
                $response = [
                    'status' => 'error',
                    'errores' => $this->form_validation->error_array()
                ];
                echo json_encode($response);
            } else {
                //$this->data['tipos'] = $this->UsuarioModel->getTipoSujetoObligado();
                $this->data['sujetos'] = $this->UsuarioModel->getSujetosObligados();
                //Trea las unidades administrativas que estan escondidas en el formulario de la solicitud
                $this->data['unidades'] = $this->UsuarioModel->getUnidadesAdministrativasSolicitud();
                $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'solicitud', $this->data);
            }
        }
    }

    //fincion para ocultar usuario
    public function ocultar($id)
    {
        // Verificar si el usuario existe
        $user = $this->ion_auth->user($id)->row();

        if ($user) {
            // Actualizar el estado de status a 2 (oculto)
            $this->deactivate($id);
            $data = [
                'status' => 2,
                'email' => null
            ];
            $this->db->where('id', $id);
            $this->db->update('users', $data);

            // Redirigir con un mensaje de éxito
            $response = [
                'status' => 'success',
                'message' => $this->ion_auth->messages(),
            ];
            echo json_encode($response);
        } else {
            // Redirigir con un mensaje de error
            $response = [
                'status' => 'error',
                'errores' => $this->form_validation->error_array()
            ];
            echo json_encode($response);
        }

        redirect('auth');
    }


    /**
     * @return array A CSRF key-value pair
     */
    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return [$key => $value];
    }

    /**
     * @return bool Whether the posted CSRF token matches
     */
    public function _valid_csrf_nonce()
    {
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @param string $view
     * @param array|null $data
     * @param bool $returnhtml
     *
     * @return mixed
     */

    public function _render_page($view, $data = NULL, $returnhtml = FALSE)
    {

        $viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $viewdata, $returnhtml);

        if ($returnhtml) {
            return $view_html;
        }
    }

}