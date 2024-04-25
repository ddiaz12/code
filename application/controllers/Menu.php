<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel');
    }

    public function index()
    {
        $this->load->view('inicio');
    }

    public function menu_enviadas()
    {
        $this->blade->render('menu/enviadas');
    }

    public function menu_sujeto()
    {
        $data['sujetos'] = $this->MenuModel->getSujetosObligados();
        $this->blade->render('menu/sujeto-obligado', $data);
    }

    public function menu_unidades()
    {
        $data['unidades'] = $this->MenuModel->getUnidadesAdministrativas();
        $this->blade->render('menu/unidades-administrativas', $data);
    }

    public function menu_guia()
    {
        $this->blade->render('menu/guia');
    }

    public function menu_log()
    {
        $this->blade->render('menu/log');
    }

    public function agregar_unidades()
    {
        $data['sujetos'] = $this->MenuModel->getSujetosObligados();
        $data['vialidades'] = $this->MenuModel->getCatVialidades();
        $data['municipios'] = $this->MenuModel->getCatMunicipios();
        $data['localidades'] = $this->MenuModel->getCatLocalidades();
        $this->blade->render('menu/agregar-unidad', $data);
    }

    public function insertar_unidad()
    {
        //print_r($this->input->post('sujeto'));
        // Obtener los datos del formulario
        //print_r($this->input->post('json1'));
        //print_r($this->input->post('json2'));
        //$datos = array();

        $datosFormulario = $this->input->post('json1');
        $horarios = $this->input->post('json2');
        if ($datosFormulario != null) {
            foreach ($datosFormulario as $dato) {
                $datos[$dato['name']] = $dato['value'];
            }

            $data = array(
                'ID_sujeto' => isset($datos['sujeto']) ? $datos['sujeto'] : null,
                'nombre' => isset($datos['nombre']) ? $datos['nombre'] : null,
                'siglas' => isset($datos['siglas']) ? $datos['siglas'] : null,
                'ID_vialidad' => isset($datos['tipo_vialidad']) ? $datos['tipo_vialidad'] : null,
                'nombre_vialidad' => isset($datos['nombre_vialidad']) ? $datos['nombre_vialidad'] : null,
                'Num_interior' => isset($datos['num_interior']) ? $datos['num_interior'] : null,
                'Num_Exterior' => isset($datos['num_exterior']) ? $datos['num_exterior'] : null,
                'ID_municipio' => isset($datos['municipio']) ? $datos['municipio'] : null,
                'ID_localidad' => isset($datos['localidad']) ? $datos['localidad'] : null,
                'clave_localidad' => isset($datos['clave_localidad']) ? $datos['clave_localidad'] : null,
                'ID_asentamiento' => isset($datos['tipo_asentamiento']) ? $datos['tipo_asentamiento'] : null,
                'nombre_asentamiento' => isset($datos['nombre_asentamiento']) ? $datos['nombre_asentamiento'] : null,
                'c_p' => isset($datos['codigo_postal']) ? $datos['codigo_postal'] : null,
                'NumTel_Oficial' => isset($datos['inputNumTel']) ? $datos['inputNumTel'] : null,
                'extension' => isset($datos['extension']) ? $datos['extension'] : null,
                'Correo_Elec' => isset($datos['email']) ? $datos['email'] : null,
                'Notas' => isset($datos['notas']) ? $datos['notas'] : null,
            );

            $id_unidad = $this->MenuModel->insertar_unidad($data);

            // Insertar los horarios de la unidad administrativa
            foreach ($horarios as $horario) {
                $dias = $horario['dia'];
                $aperturas = $horario['apertura'];
                $cierres = $horario['cierre'];
                $this->MenuModel->guardarHorario($id_unidad, $dias, $aperturas, $cierres);
            }

            $response = array('status' => 'success', 'redirect_url' => 'menu_unidades');
            echo json_encode($response);

        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function eliminar_unidad($id)
    {
        $this->MenuModel->eliminarUnidad($id);

    }

    public function editar_unidad($id)
    {
        $data['sujetos'] = $this->MenuModel->getSujetosObligados();
        $data['vialidades'] = $this->MenuModel->getCatVialidades();
        $data['municipios'] = $this->MenuModel->getCatMunicipios();
        $data['localidades'] = $this->MenuModel->getCatLocalidades();
        $data['unidad'] = $this->MenuModel->getUnidad($id);
        $data['horarios'] = $this->MenuModel->getHorarios($id);
        $this->blade->render('menu/editar-unidad', $data);
    }

    public function actualizar_unidad()
    {
        $datosFormulario = $this->input->post('json1');
        $horarios = $this->input->post('json2');
        $horariosEliminados = $this->input->post('json3');

        if ($datosFormulario != null) {
            foreach ($datosFormulario as $dato) {
                $datos[$dato['name']] = $dato['value'];
            }

            $id_unidad = $datos['id_unidad'];

            $data = array(
                'ID_sujeto' => isset($datos['sujeto']) ? $datos['sujeto'] : null,
                'nombre' => isset($datos['nombre']) ? $datos['nombre'] : null,
                'siglas' => isset($datos['siglas']) ? $datos['siglas'] : null,
                'ID_vialidad' => isset($datos['tipo_vialidad']) ? $datos['tipo_vialidad'] : null,
                'nombre_vialidad' => isset($datos['nombre_vialidad']) ? $datos['nombre_vialidad'] : null,
                'Num_interior' => isset($datos['num_interior']) ? $datos['num_interior'] : null,
                'Num_Exterior' => isset($datos['num_exterior']) ? $datos['num_exterior'] : null,
                'ID_municipio' => isset($datos['municipio']) ? $datos['municipio'] : null,
                'ID_localidad' => isset($datos['localidad']) ? $datos['localidad'] : null,
                'clave_localidad' => isset($datos['clave_localidad']) ? $datos['clave_localidad'] : null,
                'ID_asentamiento' => isset($datos['tipo_asentamiento']) ? $datos['tipo_asentamiento'] : null,
                'nombre_asentamiento' => isset($datos['nombre_asentamiento']) ? $datos['nombre_asentamiento'] : null,
                'c_p' => isset($datos['codigo_postal']) ? $datos['codigo_postal'] : null,
                'NumTel_Oficial' => isset($datos['inputNumTel']) ? $datos['inputNumTel'] : null,
                'extension' => isset($datos['extension']) ? $datos['extension'] : null,
                'Correo_Elec' => isset($datos['email']) ? $datos['email'] : null,
                'Notas' => isset($datos['notas']) ? $datos['notas'] : null,
            );

            $this->MenuModel->actualizar_unidad($id_unidad, $data);

            // Eliminar los horarios de la unidad administrativa
            if ($horariosEliminados != null) {
                foreach ($horariosEliminados as $idhorario) {
                    $this->MenuModel->eliminarHorarios($idhorario);
                }
            }

            // Insertar los horarios de la unidad administrativa
            if ($horarios != null) {
                foreach ($horarios as $horario) {
                    $dias = $horario['dia'];
                    $aperturas = $horario['apertura'];
                    $cierres = $horario['cierre'];
                    $this->MenuModel->guardarHorario($id_unidad, $dias, $aperturas, $cierres);
                }
            }

            $response = array('status' => 'success');
            echo json_encode($response);

        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
}