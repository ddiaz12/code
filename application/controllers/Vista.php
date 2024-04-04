<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vista extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        $this->load->model('OficinaModel');
    }

    public function oficina()
    {
        $data["oficinas"] = $this->OficinaModel->getOficinas();
        $this->load->view('header');
        $this->load->view('sujeto/oficinas', $data);
    }

    public function agregar_oficina()
    {
        // Obtener los datos del formulario
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'tipo' => $this->input->post('tipo'),
            // Agrega aquí los demás campos del formulario
        );

        // Insertar los datos en la base de datos
        $this->OficinaModel->insertar_oficina($data);

        // Redireccionar a la página principal o mostrar un mensaje de éxito
        redirect('vista/oficina');
    }

    public function eliminar_oficina($id)
    {
        // Llamar al método del modelo para eliminar la oficina
        $this->OficinaModel->eliminar_oficina($id);

        // Redireccionar a la página principal o mostrar un mensaje de éxito
        redirect('vista/oficina');
    }
}
