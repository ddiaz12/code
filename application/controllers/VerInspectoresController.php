<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VerInspectoresController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('VerInspectoresModel');
    }

    public function index()
    {
        $this->verInspectores();
    }

    public function verInspectores()
    {
        // Ruta para ver la vista: http://localhost/codediego/ver-inspectores
        $data['inspectores'] = $this->VerInspectoresModel->getInspectores();
        $this->blade->render('ciudadania' . DIRECTORY_SEPARATOR . 'ver_Inspectores', $data);
    }

    public function buscarInspectores()
    {
        $nombre = $this->input->post('nombreInspector');
        $resultados = $this->VerInspectoresModel->buscarInspectores($nombre);

        // Preparar los datos para la vista o devolver como JSON
        $data['inspectores'] = $resultados;
        // Para devolver como JSON
        echo json_encode($data['inspectores']);
    }
}