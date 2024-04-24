<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oficinas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OficinaModel');
    }

    public function oficina()
    {
        $data["oficinas"] = $this->OficinaModel->getOficinas();
        $this->blade->render('sujeto/oficinas', $data);
    }

    public function agregar_oficina()
    {
        $data['sujetos'] = $this->OficinaModel->getCatOficinas();
        $data['vialidades'] = $this->OficinaModel->getCatVialidades();
        $data['municipios'] = $this->OficinaModel->getCatMunicipios();
        $data['localidades'] = $this->OficinaModel->getCatLocalidades();
        $this->blade->render('sujeto/agregar-oficina', $data);
    }

    public function insertar()
    {
        // Obtener los datos del formulario
        $oficina_data = array(
            'Nombre_Sujeto' => $this->input->post('sujeto'),
            'Unidad_Admin' => $this->input->post('unidad'),
            'nombre' => $this->input->post('nombre'),
            'Siglas' => $this->input->post('siglas'),
            'tipo_vialidad' => $this->input->post('tipo_vialidad'),
            'Nombre_Vialidad' => $this->input->post('nombre_vialidad'),
            'Num_interior' => $this->input->post('num_interior'),
            'Num_Exterior' => $this->input->post('num_exterior'),
            'municipio' => $this->input->post('municipio'),
            'localidad' => $this->input->post('localidad'),
            'clave_localidad' => $this->input->post('clave_localidad'),
            'tipo_asentamiento' => $this->input->post('tipo_asentamiento'),
            'nombre_asentamiento' => $this->input->post('nombre_asentamiento'),
            'c_p' => $this->input->post('codigo_postal'),
            'NumTel_Oficial' => $this->input->post('inputNumTel'),
            'Extension' => $this->input->post('extension'),
            'Correo_Elec' => $this->input->post('email'),
            'Notas' => $this->input->post('notas'),
            // Aquí puedes agregar los demás campos del formulario
        );

        $this->OficinaModel->insertar_oficina($oficina_data);
        // Obtener el ID de la oficina recién insertada
        $id_oficina = $this->db->insert_id();

        // Obtener los datos del formulario
        $horario_data = array(
            'Dia' => $this->input->post('dia'),
            'Apertura' => $this->input->post('apertura'),
            'Cierre' => $this->input->post('cierre'),
        );
        $this->OficinaModel->insertar_horario($horario_data);
        // Obtener el ID del horario de atención recién insertado
        $id_horario = $this->db->insert_id();

        // Asociar la oficina con el horario de atención en la tabla rel_oficina_horario
        $this->OficinaModel->asociar_oficina_horario($id_oficina, $id_horario);

        redirect('oficinas/oficina');
    }


    public function eliminar($id)
    {
        $this->OficinaModel->eliminar_oficina($id);
        redirect('oficinas/oficina');
    }
}
