<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VerInspeccionesController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('VerInspeccionesModel');
    }

    public function index()
    {
        $this->verInspecciones();
    }

    public function verInspecciones()
    {
        // Ruta para ver la vista: http://localhost/codediego/ver-inspecciones
        $data['inspecciones'] = $this->VerInspeccionesModel->getInspecciones();
        $data['numeroResultados'] = count($data['inspecciones']);
        $this->blade->render('ciudadania' . DIRECTORY_SEPARATOR . 'Ver_Inspecciones', $data);
    }

    public function buscarInspecciones()
    {
        $criterio = $this->input->post('criterioBusqueda');
        $resultados = $this->VerInspeccionesModel->buscarInspecciones($criterio);

        // Preparar los datos para la vista o devolver como JSON
        $data['inspecciones'] = $resultados;
        $data['numeroResultados'] = count($resultados);
        // Para devolver como JSON
        echo json_encode($data['inspecciones']);
    }
}