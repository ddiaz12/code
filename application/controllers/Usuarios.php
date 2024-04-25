<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsuarioModel');
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
        $this->blade->render('sujeto/agregar-usuario', $data);
    }


    public function insertar()
    {
        
        // Recoge los datos del formulario
        $data = array(
            'ID_rol' => $this->input->post('selectRoles'),
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
            'Estatus' => 1
        );

        // Inserta los datos en la base de datos
        $this->UsuarioModel->insertar($data);

        // Redirige al usuario a la página de usuarios
        redirect('usuarios/usuario');
    }

    public function editar($id)
    {
        $usuario = $this->UsuarioModel->getUsuarios($id);
        $roles = $this->UsuarioModel->getRoles();
        $this->blade->render('sujeto/editar-usuario', ['usuario' => $usuario, 'roles' => $roles]);
    }

    public function eliminar($id)
    {
        $this->UsuarioModel->eliminar($id);
        redirect('usuarios/usuario');
    }

    public function actualizar()
    {
        $id = $this->input->post('ID_Usuario');
        $estatus = $this->input->post('selectEstatus') === 'Activo' ? true : false;
        $data = array(
            'ID_rol' => $this->input->post('selectRoles'),
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
        redirect('usuarios/usuario');
    }

}