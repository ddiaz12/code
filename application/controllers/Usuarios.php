<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsuarioModel');
        $this->load->library('form_validation');
        /*$config = array(
            array(
                'field' => 'inputCorreo',
                'label' => 'Correo electrónico',
                'rules' => 'required|valid_email',
                'errors' => array('required' => 'El campo %s es obligatorio', 'valid_email' => 'El campo %s debe ser un correo electrónico válido')
            ),
        );
        $this->form_validation->set_rules($config);*/
    }

    public function index()
    {
        $this->load->view('inicio');
    }

    public function usuario()
    {
        $data['usuarios'] = $this->UsuarioModel->getUsuarios($id = null);
        $this->blade->render('sujeto/usuarios', $data);
    }

    public function agregar_usuario()
    {
        $data['roles'] = $this->UsuarioModel->getRoles();
        $data['sujetos'] = $this->UsuarioModel->getSujetosObligados();
        $data['unidades'] = $this->UsuarioModel->getUnidadesAdministrativas();
        $this->blade->render('sujeto/agregar-usuario', $data);
    }

    public function getTipoSujetoObligado($tipo_sujeto)
    {
        // Obtiene el nombre del sujeto del modelo
        $nombre_sujeto = $this->UsuarioModel->getSujetosObligadosPorTipo($tipo_sujeto);
        echo json_encode($nombre_sujeto);
    }


    public function insertar()
    {
        // Define las reglas de validación
        $this->form_validation->set_rules(
            'inputNombreUsuario',
            'Nombre',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'inputApellidoPaterno',
            'Apellido Paterno',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'inputApellidoMaterno',
            'Apellido Materno',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'inputCorreo',
            'Correo Electrónico',
            'required|valid_email|trim|is_unique[ma_usuario.Correo_Electronico]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'valid_email' => 'Por favor, introduce una dirección de correo electrónico válida.',
                'is_unique' => 'El correo electrónico ya está registrado.'
            )
        );
        $this->form_validation->set_rules('inputFechaAlto', 'Fecha de alta', 'required');
        $this->form_validation->set_rules('inputNumTel', 'Número de teléfono', 'required');
        $this->form_validation->set_rules('selectRoles', 'Rol', 'required');
        $this->form_validation->set_rules('selectTipoSujeto', 'Tipo de sujeto', 'required');
        $this->form_validation->set_rules('selectUnidades', 'Unidad administrativa', 'required');

        if ($this->form_validation->run() != FALSE) {
            $selectRoles = $this->input->post('selectRoles');
            $selectTipoSujeto = $this->input->post('selectTipoSujeto');
            $selectUnidades = $this->input->post('selectUnidades');
            $inputApellidoPaterno = $this->input->post('inputApellidoPaterno');
            $inputApellidoMaterno = $this->input->post('inputApellidoMaterno');
            $inputNombreUsuario = $this->input->post('inputNombreUsuario');
            $inputCorreo = $this->input->post('inputCorreo');
            $inputFechaAlto = $this->input->post('inputFechaAlto');
            $inputNumTel = $this->input->post('inputNumTel');
            $inputExtension = $this->input->post('inputExtension');
            $inputCargoServidorPublico = $this->input->post('inputCargoServidorPublico');
            $inputTitulo = $this->input->post('inputTitulo');
            $inputNumeroEmpleado = $this->input->post('inputNumeroEmpleado');

            // Recoge los datos del formulario
            $data = array(
                'ID_rol' => $selectRoles,
                'ID_sujeto' => $selectTipoSujeto,
                'ID_unidad' => $selectUnidades,
                'Apellido_Paterno' => $inputApellidoPaterno,
                'Apellido_Materno' => $inputApellidoMaterno,
                'Nombre' => $inputNombreUsuario,
                'Correo_Electronico' => $inputCorreo,
                'Fecha_Cargo_ROM' => $inputFechaAlto,
                'Num_Tel' => $inputNumTel,
                'Extension' => $inputExtension,
                'cargo' => $inputCargoServidorPublico,
                'titulo' => $inputTitulo,
                'clave_Empleado' => $inputNumeroEmpleado,
                'Estatus' => 1
            );

            // Inserta los datos en la base de datos
            $this->UsuarioModel->insertar($data);
            $response = array('status' => 'success', 'redirect_url' => 'usuario');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }


    public function editar($id)
    {
        $usuario = $this->UsuarioModel->getUsuarios($id);
        $roles = $this->UsuarioModel->getRoles();
        $unidad = $this->UsuarioModel->getUnidadesAdministrativas();
        $sujeto = $this->UsuarioModel->getSujetosObligados();
        $this->blade->render('sujeto/editar-usuario', ['usuario' => $usuario, 'roles' => $roles, 'unidades' => $unidad, 'sujetos' => $sujeto]);
    }

    public function eliminar($id)
    {
        $this->UsuarioModel->eliminar($id);
        redirect('usuarios/usuario');
    }

    public function actualizar()
    {

        // Define las reglas de validación
        $this->form_validation->set_rules(
            'inputNombreUsuario',
            'Nombre',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'inputApellidoPaterno',
            'Apellido Paterno',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'inputApellidoMaterno',
            'Apellido Materno',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'inputCorreo',
            'Correo Electrónico',
            'required|valid_email|trim|is_unique[ma_usuario.Correo_Electronico]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'valid_email' => 'Por favor, introduce una dirección de correo electrónico válida.',
                'is_unique' => 'El correo electrónico ya está registrado.'
            )
        );
        $this->form_validation->set_rules('inputFechaAlto', 'Fecha de alta', 'required');
        $this->form_validation->set_rules('inputNumTel', 'Número de teléfono', 'required');
        $this->form_validation->set_rules('selectRoles', 'Rol', 'required');
        $this->form_validation->set_rules('selectTipoSujeto', 'Tipo de sujeto', 'required');
        $estatus = $this->input->post('selectEstatus') === 'Activo' ? true : false;
        $id = $this->input->post('ID_Usuario');

        if ($this->form_validation->run() != FALSE) {
            $data = array(
                'ID_rol' => $this->input->post('selectRoles'),
                'ID_sujeto' => $this->input->post('selectTipoSujeto'),
                'ID_unidad' => $this->input->post('selectUnidad'),
                'Apellido_Paterno' => $this->input->post('inputApellidoPaterno'),
                'Apellido_Materno' => $this->input->post('inputApellidoMaterno'),
                'Nombre' => $this->input->post('inputNombreUsuario'),
                'Correo_Electronico' => $this->input->post('inputCorreo'),
                'Fecha_Cargo_ROM' => $this->input->post('inputFechaAlto'),
                'Num_Tel' => $this->input->post('inputNumTel'),
                'Extension' => $this->input->post('inputExtension'),
                'cargo' => $this->input->post('inputCargoServidorPublico'),
                'titulo' => $this->input->post('inputTitulo'),
                'clave_Empleado' => $this->input->post('inputClave'),
                'Estatus' => $estatus
            );

            $this->UsuarioModel->actualizar($id, $data);

            $response = array('status' => 'success');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }
}
