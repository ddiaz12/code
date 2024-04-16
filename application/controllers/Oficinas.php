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
        $this->blade->render('sujeto/agregar-oficina');
    }

    public function insertar()
    {
        // Obtener los datos del formulario
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'tipo' => $this->input->post('tipo'),
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
