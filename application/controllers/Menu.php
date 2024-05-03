<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel');
        $this->load->library('form_validation');
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
        $this->form_validation->set_rules('inputNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('siglas', 'Siglas', 'required');
        $this->form_validation->set_rules('num_exterior', 'Número exterior', 'required');
        $this->form_validation->set_rules('codigo_postal', 'Código postal', 'required');
        $this->form_validation->set_rules('inputNumTel', 'Número de teléfono', 'required');
        $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
        $this->form_validation->set_rules('sujeto', 'Sujeto obligado', 'required');
        $this->form_validation->set_rules('tipo_vialidad', 'Tipo de vialidad', 'required');
        $this->form_validation->set_rules('nombre_vialidad', 'Nombre de vialidad', 'required');

        if ($this->form_validation->run() != FALSE) {

            $sujeto = $this->input->post('sujeto');
            $municipio = $this->input->post('municipio');
            $localidad = $this->input->post('localidad');
            $tipo_asentamiento = $this->input->post('tipo_asentamiento');
            $nombre_asentamiento = $this->input->post('nombre_asentamiento');
            $nombre = $this->input->post('inputNombre');
            $siglas = $this->input->post('siglas');
            $tipo_vialidad = $this->input->post('tipo_vialidad');
            $nombre_vialidad = $this->input->post('nombre_vialidad');
            $num_interior = $this->input->post('num_interior');
            $num_exterior = $this->input->post('num_exterior');
            $codigo_postal = $this->input->post('codigo_postal');
            $inputNumTel = $this->input->post('inputNumTel');
            $extension = $this->input->post('extension');
            $email = $this->input->post('email');
            $notas = $this->input->post('notas');
            $checkboxOficina = $this->input->post('checkboxOficina');

            $data = array(
                'ID_sujeto' => $sujeto,
                'ID_municipio' => $municipio,
                'ID_localidad' => $localidad,
                'ID_asentamiento' => $tipo_asentamiento,
                'ID_nAsentamiento' => $nombre_asentamiento,
                'nombre' => $nombre,
                'siglas' => $siglas,
                'ID_vialidad' => $tipo_vialidad,
                'nombre_vialidad' => $nombre_vialidad,
                'Num_interior' => $num_interior,
                'Num_Exterior' => $num_exterior,
                'c_p' => $codigo_postal,
                'NumTel_Oficial' => $inputNumTel,
                'extension' => $extension,
                'Correo_Elec' => $email,
                'Notas' => $notas,
                'checkOficina' => $checkboxOficina == 'on' ? '1' : '0',
            );

            $id_unidad = $this->MenuModel->insertar_unidad($data);

            // Insertar los horarios de la unidad administrativa
            $horarios_ = $this->input->post('horarios');
            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                foreach ($horarios as $horario) {
                    $dias = $horario->dia;
                    $aperturas = $horario->apertura;
                    $cierres = $horario->cierre;

                    // Insertar el horario en la tabla de_horarios y obtener el ID insertado
                    $id_horario = $this->MenuModel->insertarHorario($dias, $aperturas, $cierres);

                    // Insertar una nueva fila en la tabla rel_unidad_horario
                    $this->MenuModel->insertarRelacionUnidadHorario($id_unidad, $id_horario);
                }
            }


            $response = array('status' => 'success', 'redirect_url' => 'menu_unidades');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
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
        $data['unidades'] = $this->MenuModel->getUnidad($id);
        $data['horarios'] = $this->MenuModel->obtenerHorariosUnidad($id);
        $this->blade->render('menu/editar-unidad', $data);
    }

    public function actualizar_unidad()
    {
        $this->form_validation->set_rules('inputNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('siglas', 'Siglas', 'required');
        $this->form_validation->set_rules('num_exterior', 'Número exterior', 'required');
        $this->form_validation->set_rules('codigo_postal', 'Código postal', 'required');
        $this->form_validation->set_rules('inputNumTel', 'Número de teléfono', 'required');
        $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
        $this->form_validation->set_rules('sujeto', 'Sujeto obligado', 'required');
        $this->form_validation->set_rules('tipo_vialidad', 'Tipo de vialidad', 'required');
        $this->form_validation->set_rules('nombre_vialidad', 'Nombre de vialidad', 'required');

        if ($this->form_validation->run() != FALSE) {

            $id_unidad = $this->input->post('id_unidad');
            $sujeto = $this->input->post('sujeto');
            $municipio = $this->input->post('municipio');
            $localidad = $this->input->post('localidad');
            $tipo_asentamiento = $this->input->post('tipo_asentamiento');
            $nombre_asentamiento = $this->input->post('nombre_asentamiento');
            $nombre = $this->input->post('inputNombre');
            $siglas = $this->input->post('siglas');
            $tipo_vialidad = $this->input->post('tipo_vialidad');
            $nombre_vialidad = $this->input->post('nombre_vialidad');
            $num_interior = $this->input->post('num_interior');
            $num_exterior = $this->input->post('num_exterior');
            $codigo_postal = $this->input->post('codigo_postal');
            $inputNumTel = $this->input->post('inputNumTel');
            $extension = $this->input->post('extension');
            $email = $this->input->post('email');
            $notas = $this->input->post('notas');
            $checkboxOficina = $this->input->post('checkboxOficina');

            $data = array(
                'ID_sujeto' => $sujeto,
                'ID_municipio' => $municipio,
                'ID_localidad' => $localidad,
                'ID_asentamiento' => $tipo_asentamiento,
                'ID_nAsentamiento' => $nombre_asentamiento,
                'nombre' => $nombre,
                'siglas' => $siglas,
                'ID_vialidad' => $tipo_vialidad,
                'nombre_vialidad' => $nombre_vialidad,
                'Num_interior' => $num_interior,
                'Num_Exterior' => $num_exterior,
                'c_p' => $codigo_postal,
                'NumTel_Oficial' => $inputNumTel,
                'extension' => $extension,
                'Correo_Elec' => $email,
                'Notas' => $notas,
                'checkOficina' => $checkboxOficina == 'on' ? '1' : '0',
            );

            $this->MenuModel->actualizar_unidad($id_unidad, $data);

            // Eliminar los horarios de la unidad administrativa
            $horariosEliminados_ = $this->input->post('horariosEliminados');
            if (!empty($horariosEliminados_)) {
                $horariosEliminados_ = json_decode($horariosEliminados_);
                foreach ($horariosEliminados_ as $idhorario) {
                    $this->MenuModel->eliminarHorarios($idhorario);
                }
            }


            $horarios_ = $this->input->post('horarios');
            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                foreach ($horarios as $horario) {
                    $dias = $horario->dia;
                    $aperturas = $horario->apertura;
                    $cierres = $horario->cierre;

                    // Insertar el horario en la tabla de_horarios y obtener el ID insertado
                    $id_horario = $this->MenuModel->insertarHorario($dias, $aperturas, $cierres);

                    // Insertar una nueva fila en la tabla rel_unidad_horario
                    $this->MenuModel->insertarRelacionUnidadHorario($id_unidad, $id_horario);
                }
            }

            $response = array('status' => 'success');
            echo json_encode($response);

        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }

    public function agregar_sujeto()
    {
        $this->blade->render('menu/agregar-sujeto');
    }
}