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
        $datosFormulario = $this->input->post('json1');

        if ($datosFormulario != null) {
            foreach ($datosFormulario as $dato) {
                $datos[$dato['name']] = $dato['value'];
            }

            // Recoge los datos del formulario
            $data = array(
                'ID_rol' => isset($datos['selectRoles']) ? $datos['selectRoles'] : null,
                'ID_sujeto' => isset($datos['selectTipoSujeto']) ? $datos['selectTipoSujeto'] : null,
                'ID_unidad' => isset($datos['selectUnidades']) ? $datos['selectUnidades'] : null,
                'Apellido_Paterno' => isset($datos['inputApellidoPaterno']) ? $datos['inputApellidoPaterno'] : null,
                'Apellido_Materno' => isset($datos['inputApellidoMaterno']) ? $datos['inputApellidoMaterno'] : null,
                'Nombre' => isset($datos['inputNombreUsuario']) ? $datos['inputNombreUsuario'] : null,
                'Correo_Electronico' => isset($datos['inputCorreo']) ? $datos['inputCorreo'] : null,
                'Fecha_Cargo_ROM' => isset($datos['inputFechaAlto']) ? $datos['inputFechaAlto'] : null,
                'Num_Tel' => isset($datos['inputNumTel']) ? $datos['inputNumTel'] : null,
                'Extension' => isset($datos['inputExtension']) ? $datos['inputExtension'] : null,
                'cargo' => isset($datos['inputCargoServidorPublico']) ? $datos['inputCargoServidorPublico'] : null,
                'titulo' => isset($datos['inputTitulo']) ? $datos['inputTitulo'] : null,
                'clave_Empleado' => isset($datos['inputNumeroEmpleado']) ? $datos['inputNumeroEmpleado'] : null,
                'Estatus' => 1
            );

            // Inserta los datos en la base de datos
            $this->UsuarioModel->insertar($data);

            $response = array('status' => 'success', 'redirect_url' => 'usuario');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'message' => 'No se han recibido datos');
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
        $id = $this->input->post('ID_Usuario');
        $estatus = $this->input->post('selectEstatus') === 'Activo' ? true : false;
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
        redirect('usuarios/usuario');
    }

}