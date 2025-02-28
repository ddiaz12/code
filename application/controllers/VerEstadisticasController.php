<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VerEstadisticasController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('VerEstadisticasModel');
    }

    public function index()
    {
        $this->verEstadisticas();
    }

    public function verEstadisticas()
    {
        // Ruta para ver la vista: http://localhost/codediego/ver-estadisticas
        $data['estadisticas'] = $this->VerEstadisticasModel->getEstadisticas();
        $data['numeroResultados'] = count($data['estadisticas']);
        $this->blade->render('ciudadania' . DIRECTORY_SEPARATOR . 'Ver_Estadisticas', $data);
    }

    public function buscarEstadisticas()
    {
        $criterio = $this->input->post('criterioBusqueda');
        $resultados = $this->VerEstadisticasModel->buscarEstadisticas($criterio);

        // Preparar los datos para la vista o devolver como JSON
        $data['estadisticas'] = $resultados;
        $data['numeroResultados'] = count($resultados);
        // Para devolver como JSON
        echo json_encode($data['estadisticas']);
    }
}