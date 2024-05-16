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
        $data = array(
            'Nombre_Suejto' => $this->input->post('sujeto'),
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
            'C.P' => $this->input->post('codigo_postal'),
            'NumTel_Oficial' => $this->input->post('num_tel_oficial'),
            'Extension' => $this->input->post('extension'),
            'Correo_Elec' => $this->input->post('email'),
            'Notas' => $this->input->post('notas'),
            // Aquí puedes agregar los demás campos del formulario
        );

        $this->OficinaModel->insertar_oficina($data);
        redirect('oficinas/oficina');
    }

    public function eliminar($id)
    {
        $this->OficinaModel->eliminar_oficina($id);
        redirect('oficinas/oficina');
    }
}
