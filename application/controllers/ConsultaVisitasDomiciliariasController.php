<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ConsultaVisitasDomiciliariasController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ConsultaVisitasDomiciliariasModel');
    }

    public function index()
    {
        $this->consulta();
    }

    public function consulta()
    {
        // Ruta para ver la vista: http://localhost/codediego/consulta-visitas-domiciliarias
        $data['dependencias'] = $this->ConsultaVisitasDomiciliariasModel->getDependencias();
        $data['tiposOrdenamiento'] = $this->ConsultaVisitasDomiciliariasModel->getTiposOrdenamiento();
        $data['numeroDeRegulaciones'] = $this->ConsultaVisitasDomiciliariasModel->contarRegulaciones();
        $this->blade->render('ciudadania' . DIRECTORY_SEPARATOR . 'consulta-VisitasDomiciliarias', $data);
    }

    public function buscarVisitas()
    {
        $nombre = $this->input->post('nombreRegulacion');
        $resultados = $this->ConsultaVisitasDomiciliariasModel->buscarPorNombre($nombre);

        // Preparar los datos para la vista o devolver como JSON
        $data['visitas'] = $resultados;
        // Para devolver como JSON
        echo json_encode($data['visitas']);
    }

    public function realizarBusquedaAvanzada()
    {
        // Obtener los datos enviados por POST
        $desde = $this->input->post('desde');
        $hasta = $this->input->post('hasta');
        $dependencia = $this->input->post('dependencia');
        $tipoOrdenamiento = $this->input->post('tipoOrdenamiento');

        // Llamar al modelo para realizar la búsqueda
        $resultados = $this->ConsultaVisitasDomiciliariasModel->buscarVisitas($desde, $hasta, $dependencia, $tipoOrdenamiento);

        // Retornar los resultados en formato JSON
        echo json_encode($resultados);
    }
}