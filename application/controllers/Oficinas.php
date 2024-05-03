<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
class Oficinas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OficinaModel');
        $this->load->library('form_validation');
    }

    public function oficina()
    {
        $data["oficinas"] = $this->OficinaModel->getOficinas();
        $this->blade->render('sujeto/oficinas', $data);
    }

    public function agregar_oficina()
    {
        $data['sujetos'] = $this->OficinaModel->getSujetosObligados();
        $data['unidades'] = $this->OficinaModel->getUnidadAdministrativa();
        $data['vialidades'] = $this->OficinaModel->getCatVialidades();
        $data['municipios'] = $this->OficinaModel->getCatMunicipios();
        $data['localidades'] = $this->OficinaModel->getCatLocalidades();
        $this->blade->render('sujeto/agregar-oficina', $data);
    }

    public function insertar()
    {
        $this->form_validation->set_rules(
            'inputNombre',
            'Nombre',
            'required|regex_match[/^[a-zA-Z ]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras.'
            )
        );
        $this->form_validation->set_rules(
            'siglas',
            'Siglas',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras y no puede tener espacios ni caracteres numéricos.'
            )
        );
        $this->form_validation->set_rules('num_exterior', 'Número exterior', 'required');
        $this->form_validation->set_rules('codigo_postal', 'Código postal', 'required');
        $this->form_validation->set_rules('inputNumTel', 'Número de teléfono', 'required');
        $this->form_validation->set_rules('email', 'Correo electrónico', 'trim|required|valid_email');
        $this->form_validation->set_rules('sujeto', 'Sujeto obligado', 'required');
        $this->form_validation->set_rules('unidad', 'Unidad administrativa', 'required');
        $this->form_validation->set_rules('tipo_vialidad', 'Tipo de vialidad', 'required');
        $this->form_validation->set_rules(
            'inputVialidad',
            'Nombre de vialidad',
            'required | regex_match[/^[a-zA-Z ]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras.'
            )
        );

        if ($this->form_validation->run() != FALSE) {
            $sujeto = $this->input->post('sujeto');
            $unidad = $this->input->post('unidad');
            $localidad = $this->input->post('localidad');
            $tipo_asentamiento = $this->input->post('tipo_asentamiento');
            $nombre_asentamiento = $this->input->post('nombre_asentamiento');
            $tipo_vialidad = $this->input->post('tipo_vialidad');
            $municipio = $this->input->post('municipio');
            $nombre = $this->input->post('inputNombre');
            $siglas = $this->input->post('siglas');
            $nombre_vialidad = $this->input->post('inputVialidad');
            $num_interior = $this->input->post('num_interior');
            $num_exterior = $this->input->post('num_exterior');
            $codigo_postal = $this->input->post('codigo_postal');
            $inputNumTel = $this->input->post('inputNumTel');
            $extension = $this->input->post('extension');
            $email = $this->input->post('email');
            $notas = $this->input->post('notas');
            $horarios_ = $this->input->post('horarios');

            $data = array(
                'ID_sujeto' => $sujeto,
                'ID_unidad' => $unidad,
                'ID_localidad' => $localidad,
                'ID_asentamiento' => $tipo_asentamiento,
                'ID_nAsentamiento' => $nombre_asentamiento,
                'ID_vialidad' => $tipo_vialidad,
                'ID_municipio' => $municipio,
                'nombre' => $nombre,
                'Siglas' => $siglas,
                'Nombre_Vialidad' => $nombre_vialidad,
                'Num_interior' => $num_interior,
                'Num_Exterior' => $num_exterior,
                'c_p' => $codigo_postal,
                'NumTel_Oficial' => $inputNumTel,
                'Extension' => $extension,
                'Correo_Elec' => $email,
                'Notas' => $notas,
            );

            $id_oficina = $this->OficinaModel->insertar_oficina($data);

            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                foreach ($horarios as $horario) {
                    $dias = $horario->dia;
                    $aperturas = $horario->apertura;
                    $cierres = $horario->cierre;

                    $id_horario = $this->OficinaModel->insertar_horario($dias, $aperturas, $cierres);

                    // Asociar la oficina con el horario de atención en la tabla rel_oficina_horario
                    $this->OficinaModel->asociar_oficina_horario($id_oficina, $id_horario);
                }
            }
            $response = array('status' => 'success', 'redirect_url' => 'oficina');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }

    public function editar($id)
    {
        $data['oficinas'] = $this->OficinaModel->getOficinaEditar($id);
        $data['horarios'] = $this->OficinaModel->getHorariosOficina($id);
        $data['sujetos'] = $this->OficinaModel->getSujetosObligados();
        $data['unidades'] = $this->OficinaModel->getUnidadAdministrativa();
        $data['vialidades'] = $this->OficinaModel->getCatVialidades();
        $data['municipios'] = $this->OficinaModel->getCatMunicipios();
        $data['localidades'] = $this->OficinaModel->getCatLocalidades();
        $this->blade->render('sujeto/editar-oficina', $data);
    }


    public function eliminar($id)
    {
        $this->OficinaModel->eliminarOficina($id);
        redirect('oficinas/oficina');
    }

    public function actualizar()
    {
        $this->form_validation->set_rules(
            'inputNombre',
            'Nombre',
            'required|regex_match[/^[a-zA-Z ]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras.'
            )
        );
        $this->form_validation->set_rules(
            'siglas',
            'Siglas',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras y no puede tener espacios ni caracteres numéricos.'
            )
        );
        $this->form_validation->set_rules('num_exterior', 'Número exterior', 'required');
        $this->form_validation->set_rules('codigo_postal', 'Código postal', 'required');
        $this->form_validation->set_rules('inputNumTel', 'Número de teléfono', 'required');
        $this->form_validation->set_rules('email', 'Correo electrónico', 'trim|required|valid_email');
        $this->form_validation->set_rules('sujeto', 'Sujeto obligado', 'required');
        $this->form_validation->set_rules('unidad', 'Unidad administrativa', 'required');
        $this->form_validation->set_rules('tipo_vialidad', 'Tipo de vialidad', 'required');
        $this->form_validation->set_rules(
            'inputVialidad',
            'Nombre de vialidad',
            'required | regex_match[/^[a-zA-Z ]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras.'
            )
        );


        if ($this->form_validation->run() != FALSE) {
            $sujeto = $this->input->post('sujeto');
            $unidad = $this->input->post('unidad');
            $localidad = $this->input->post('localidad');
            $tipo_asentamiento = $this->input->post('tipo_asentamiento');
            $nombre_asentamiento = $this->input->post('nombre_asentamiento');
            $tipo_vialidad = $this->input->post('tipo_vialidad');
            $municipio = $this->input->post('municipio');
            $nombre = $this->input->post('inputNombre');
            $siglas = $this->input->post('siglas');
            $nombre_vialidad = $this->input->post('inputVialidad');
            $num_interior = $this->input->post('num_interior');
            $num_exterior = $this->input->post('num_exterior');
            $codigo_postal = $this->input->post('codigo_postal');
            $inputNumTel = $this->input->post('inputNumTel');
            $extension = $this->input->post('extension');
            $email = $this->input->post('email');
            $notas = $this->input->post('notas');

            $horarios_ = ($this->input->post('horarios'));
            $horariosEliminados_ = $this->input->post('horariosEliminados');
            $id_oficina = $this->input->post('id_oficina');

            $data = array(
                'ID_sujeto' => $sujeto,
                'ID_unidad' => $unidad,
                'ID_localidad' => $localidad,
                'ID_asentamiento' => $tipo_asentamiento,
                'ID_nAsentamiento' => $nombre_asentamiento,
                'ID_vialidad' => $tipo_vialidad,
                'ID_municipio' => $municipio,
                'nombre' => $nombre,
                'Siglas' => $siglas,
                'Nombre_Vialidad' => $nombre_vialidad,
                'Num_interior' => $num_interior,
                'Num_Exterior' => $num_exterior,
                'c_p' => $codigo_postal,
                'NumTel_Oficial' => $inputNumTel,
                'Extension' => $extension,
                'Correo_Elec' => $email,
                'Notas' => $notas,
            );

            $this->OficinaModel->actualizar_oficina($id_oficina, $data);

            // Eliminar los horarios de la oficina
            if (!empty($horariosEliminados_)) {
                $horariosEliminados = json_decode($horariosEliminados_);
                if ($horariosEliminados != null) {
                    foreach ($horariosEliminados as $idhorario) {
                        $this->OficinaModel->eliminarHorarios($idhorario);
                    }
                }
            }

            // Insertar los horarios de la oficina
            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                if ($horarios != null) {
                    foreach ($horarios as $horario) {
                        $dias = $horario->dia;
                        $aperturas = $horario->apertura;
                        $cierres = $horario->cierre;

                        $id_horario = $this->OficinaModel->insertar_horario($dias, $aperturas, $cierres);

                        // Asociar la oficina con el horario de atención en la tabla rel_oficina_horario
                        $this->OficinaModel->asociar_oficina_horario($id_oficina, $id_horario);
                    }
                }
            }

            $response = array('status' => 'success');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }
}
