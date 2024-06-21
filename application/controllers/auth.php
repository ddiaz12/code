<?php defined('BASEPATH') or exit('No direct script access allowed');

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
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);
        $this->load->model('UsuarioModel');
        $this->load->helper('form');
        $this->load->library('ftp');

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    /**
     * Redirect if needed, otherwise display the user list
     */
    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // Redirige a la página de login
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            show_error('You must be an administrator to view this page.');
        } else {
            $this->data['title'] = $this->lang->line('index_heading');

            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            // Obtén los usuarios desde Ion Auth
            $users = $this->ion_auth->users()->result();

            // Para cada usuario, obtén la información adicional y agrégala
            foreach ($users as $k => $user) {
                // Agrega grupos al usuario
                $user->groups = $this->ion_auth->get_users_groups($user->id)->result();
                // Agrega información adicional al usuario
                $additionalInfo = $this->UsuarioModel->getPorUsuario($user->id);

                if ($additionalInfo) {
                    $user->tipo_sujeto = $additionalInfo->tipo_sujeto;
                    $user->sujeto = $additionalInfo->nombre_sujeto;
                    $user->unidad = $additionalInfo->nombre;
                } else {
                    $user->tipo_sujeto = 'No especificado';
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
                //if the login is successful
                //redirect them back to the home page

                // check user role and redirect accordingly
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('home', 'refresh');

            } else {
                // if the login was un-successful
                // redirect them back to the login page

                $this->session->set_flashdata('message', 'Correo o contraseña incorrectos');
                $this->data['message'] = $this->session->flashdata('message');
                $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
                // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

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
        $this->data['title'] = $this->lang->line('forgot_password_heading');

        // setting validation rules by checking whether identity is username or email
        if ($this->config->item('identity', 'ion_auth') != 'email') {
            $this->form_validation->set_rules('identity', 'correo electronico', 'required');
        } else {
            $this->form_validation->set_rules('identity', 'correo electronico', 'required|valid_email');
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
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'forgot_password', $this->data);
        } else {
            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

            if (empty($identity)) {
                // Email does not exist in the system
                $this->session->set_flashdata('message', 'El correo no esta registrado.');
                redirect("auth/forgot_password");
            }

            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                // if there were no errors
                $this->session->set_flashdata('message', 'Se ha enviado un correo con tu nueva contraseña.');
                redirect("auth/login"); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
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

        $this->data['title'] = $this->lang->line('reset_password_heading');

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            // if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() === FALSE) {
                // display the form

                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

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
                $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'reset_password', $this->data);
            } else {
                $identity = $user->{$this->config->item('identity', 'ion_auth')};

                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($identity);

                    show_error($this->lang->line('error_csrf'));

                } else {
                    // finally change the password
                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        // if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/login", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
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
                    $this->output->set_output(json_encode(['success' => true]));
                    return;
                }
            }
            // Si no se proporciona un ID válido o no se confirma la desactivación, enviar respuesta de error
            $this->output->set_output(json_encode(['error' => 'Invalid request']));
            return;
        }
    }


    /**
     * Create a new user
     */
    public function create_user() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'No está autorizado para realizar esta acción.']);
                return;
            } else {
                redirect('auth', 'refresh');
            }
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // Validación del formulario
        $this->form_validation->set_rules('first_name', 'nombre', 'trim|required');
        $this->form_validation->set_rules('last_name', 'primer apellido', 'trim|required');
        $this->form_validation->set_rules('tipoSujeto', 'tipo de sujeto obligado', 'trim|required');
        $this->form_validation->set_rules('sujetos', 'sujeto obligado', 'trim|required');
        $this->form_validation->set_rules('unidades', 'unidad administrativa', 'trim|required');
        $this->form_validation->set_rules('fecha', 'fecha alta en el cargo', 'trim|required');

        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', 'correo', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', 'correo', 'trim|required|valid_email');
        } else {
            $this->form_validation->set_rules('email', 'correo', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', 'telefono', 'trim|required');
        $this->form_validation->set_rules('ext', 'extension', 'trim');
        $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'confirmar contraseña', 'required');

        // Validación de formulario
        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = [
                'first_name' => $this->input->post('first_name'),
                'ap1' => $this->input->post('last_name'),
                'ap2' => $this->input->post('ap2'),
                'id_tipoSujeto' => $this->input->post('tipoSujeto'),
                'id_sujeto' => $this->input->post('sujetos'),
                'id_unidad' => $this->input->post('unidades'),
                'ext' => $this->input->post('ext'),
                'phone' => $this->input->post('phone'),
                'fecha_cargo' => $this->input->post('fecha'),
            ];

            // Intentar registrar al usuario
            if ($this->ion_auth->register($identity, $password, $email, $additional_data)) {
                // Subir el archivo por FTP
                $config['hostname'] = '192.168.31.18'; // Configura tu hostname de FTP
                $config['username'] = 'test-site'; // Configura tu nombre de usuario de FTP
                $config['password'] = '*2JMjM7-IQ'; // Configura tu contraseña de FTP

                $this->ftp->connect($config);

                // Directorio de destino en el servidor FTP
                $upload_path = 'assets/ftp/';

                // Nombre del archivo en el servidor
                $file_name = $_FILES['userfile']['name'];
                $file_tmp = $_FILES['userfile']['tmp_name'];

                // Subir el archivo al servidor FTP
                if ($this->ftp->upload($file_tmp, $upload_path . $file_name, 'auto')) {
                    // Archivo subido exitosamente, devuelve respuesta JSON de éxito
                    $response = [
                        'status' => 'success',
                        'message' => $this->ion_auth->messages(),
                        'redirect_url' => base_url('auth')
                    ];
                    echo json_encode($response);
                } else {
                    // Error al subir archivo por FTP
                    $response = [
                        'status' => 'error',
                        'message' => 'Error al subir el archivo por FTP.'
                    ];
                    echo json_encode($response);
                }

                $this->ftp->close(); // Cierra la conexión FTP
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
                $this->data['tipos'] = $this->UsuarioModel->getTipoSujetoObligado();
                $this->data['unidades'] = $this->UsuarioModel->getUnidadesAdministrativas();
                $this->data['sujetos'] = $this->UsuarioModel->getSujetosObligados();

                // Mostrar vista con errores de validación
                $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'create_user', $this->data);
            }
        }
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
        $this->data['title'] = $this->lang->line('edit_user_heading');

        if (!is_numeric($id)) {
            // Redirige a la página de autenticación si el ID no es un número
            redirect('auth', 'refresh');
        }

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'No está autorizado para realizar esta acción.']);
                return;
            } else {
                redirect('auth', 'refresh');
            }
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', 'nombre', 'trim|required');
        $this->form_validation->set_rules('last_name', 'primer apellido', 'trim|required');
        $this->form_validation->set_rules('phone', 'telefono', 'trim|required');
        $this->form_validation->set_rules('ext', 'extension', 'trim');
        $this->form_validation->set_rules('tipoSujeto', 'tipo de sujeto obligado', 'trim|required');
        $this->form_validation->set_rules('sujetos', 'sujeto obligado', 'trim|required');
        $this->form_validation->set_rules('unidades', 'unidad administrativa', 'trim|required');
        $this->form_validation->set_rules('fecha', 'fecha alta en el cargo', 'trim|required');

        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', 'confirmar contraseña', 'required');
        }

        if ($this->form_validation->run() === TRUE) {
            $data = [
                'first_name' => $this->input->post('first_name'),
                'ap1' => $this->input->post('last_name'),
                'ap2' => $this->input->post('ap2'),
                'ext' => $this->input->post('ext'),
                'phone' => $this->input->post('phone'),
                'id_tipoSujeto' => $this->input->post('tipoSujeto'),
                'id_sujeto' => $this->input->post('sujetos'),
                'id_unidad' => $this->input->post('unidades'),
                'fecha_cargo' => $this->input->post('fecha')
            ];

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
                    'id' => 'inputNumTel',
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

                $this->data['tipos'] = $this->UsuarioModel->getTipoSujetoObligado();
                $this->data['sujetos'] = $this->UsuarioModel->getSujetosObligados();
                $this->data['unidades'] = $this->UsuarioModel->getUnidadesAdministrativas();
                $this->data['users'] = $this->UsuarioModel->getPorUsuario($user->id);


                $this->blade->render('auth' . DIRECTORY_SEPARATOR . 'edit_user', $this->data);
            }
        }
    }

    /**
     * Create a new group
     */
    public function create_group()
    {
        $this->data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'No está autorizado para realizar esta acción.']);
                return;
            } else {
                redirect('auth', 'refresh');
            }
        }

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
                $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

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
            // Redirige a la página de autenticación si el ID no es un número
            redirect('auth', 'refresh');
        }
        // Verificar si se proporcionó un ID de grupo
        if (!$id || empty($id)) {
            redirect('auth', 'refresh');
        }

        $this->data['title'] = $this->lang->line('edit_group_title');

        // Verificar permisos de administrador
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        // Validar entrada del formulario
        $this->form_validation->set_rules('group_name', 'nombre del grupo', 'trim|required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group(
                    $id,
                    $_POST['group_name'],
                    array(
                        'description' => $_POST['group_description']
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
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

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
     * @param string     $view
     * @param array|null $data
     * @param bool       $returnhtml
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
