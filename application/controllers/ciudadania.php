<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Dompdf\Dompdf;
use Dompdf\Options;

class Ciudadania extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RegulacionModel');
    }

    public function index()
    {
        $this->consulta();
    }

    public function consulta()
    {
        $regulaciones = $this->RegulacionModel->get_regulaciones();
        // Asegurarse de que $regulaciones siempre sea un array.
        if (!is_array($regulaciones)) {
            $regulaciones = [];
        }
        $numeroDeRegulaciones = $this->RegulacionModel->contarRegulaciones(); // Contar regulaciones
        $data['regulaciones'] = $regulaciones;
        $data['numeroDeRegulaciones'] = $numeroDeRegulaciones;
        $data['tiposOrdenamiento'] = $this->desplegarTipos();
        $data['dependencias'] = $this->RegulacionModel->getDependencias();
        $this->blade->render('ciudadania' . DIRECTORY_SEPARATOR . 'consulta-regulaciones', $data);
    }

    public function buscarRegulacion()
    {
        $nombre = $this->input->post('nombreRegulacion');
        $resultados = $this->RegulacionModel->buscarPorNombre($nombre);

        // Preparar los datos para la vista o devolver como JSON
        $data['regulaciones'] = $resultados;
        // Para devolver como JSON
        echo json_encode($data['regulaciones']);
    }

    public function desplegarTipos()
    {
        $this->load->model('RegulacionModel');
        $ArrDep = array();
        if ($ArrDep = $this->RegulacionModel->getTiposOrdenamiento()) {
            return $ArrDep;
        } else {
            return $ArrDep;

        }
    }
    // public function buscarRegulaciones() {
    //     $desdeFecha = $this->input->post('desde');
    //     $hastaFecha = $this->input->post('hasta');
    //     $dependencia = $this->input->post('dependencia');

    //     $resultados = $this->RegulacionModel->buscarRegulaciones($desdeFecha, $hastaFecha, $dependencia);

    //     echo json_encode($resultados);
    // }
    public function realizarBusquedaAvanzada()
    {
        // Obtener los datos enviados por POST
        $desde = $this->input->post('desde');
        $hasta = $this->input->post('hasta');
        $dependencia = $this->input->post('dependencia');
        $tipoOrdenamiento = $this->input->post('tipoOrdenamiento');

        // Llamar al modelo para realizar la búsqueda
        $resultados = $this->RegulacionModel->buscarRegulaciones($desde, $hasta, $dependencia, $tipoOrdenamiento);

        // Retornar los resultados en formato JSON
        echo json_encode($resultados);
    }

    public function verRegulacion($id)
    {
        $data['regulacion'] = $this->RegulacionModel->obtenerRegulacionPorId($id);
        $data['regulacionCaracteristicas'] = $this->RegulacionModel->obtenerCaracteristicasRegulacion($id);
        $data['enlace_oficial'] = $this->RegulacionModel->obtenerEnlaceOficial($id);
        $data['indice'] = $this->RegulacionModel->obtenerIndicePorRegulacion($id);
        $data['autoridades'] = $this->RegulacionModel->obtenerAutoridadesPorRegulacion($id);
        $data['materias'] = $this->RegulacionModel->obtenerMateriasExentas($id);
        $data['regulacionesVinculadas'] = $this->RegulacionModel->obtenerRegulacionesVinculadas($id);
        $data['sectores'] = $this->RegulacionModel->obtenerSectoresPorRegulacion($id);
        $data['tramites'] = $this->RegulacionModel->obtenerTramitesPorRegulacion($id);
        $this->blade->render('ciudadania' . DIRECTORY_SEPARATOR . 'ver_regulacion', $data);
    }

    public function descargarPdf($id)
    {
        require_once 'vendor/autoload.php';
        // Obtener todos los datos necesarios
        $data['regulacion'] = $this->RegulacionModel->obtenerRegulacionPorId($id);
        $data['regulacionCaracteristicas'] = $this->RegulacionModel->obtenerCaracteristicasRegulacion($id);
        $data['enlace_oficial'] = $this->RegulacionModel->obtenerEnlaceOficial($id);
        $data['indice'] = $this->RegulacionModel->obtenerIndicePorRegulacion($id);
        $data['autoridades'] = $this->RegulacionModel->obtenerAutoridadesPorRegulacion($id);
        $data['materias'] = $this->RegulacionModel->obtenerMateriasExentas($id);
        $data['regulacionesVinculadas'] = $this->RegulacionModel->obtenerRegulacionesVinculadas($id);
        $data['sectores'] = $this->RegulacionModel->obtenerSectoresPorRegulacion($id);
        $data['tramites'] = $this->RegulacionModel->obtenerTramitesPorRegulacion($id);


        // Configurar opciones de Dompdf
        $options = new Options();
        $options->set('defaultFont', 'geomanist');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Crear una nueva instancia de Dompdf
        $dompdf = new Dompdf($options);

        // Cargar una vista de Blade
        $html = $this->blade->render('ciudadania' . DIRECTORY_SEPARATOR . 'pdf_template', $data);

        // Cargar el contenido HTML en Dompdf
        $dompdf->loadHtml($html);

        // Renderizar el PDF
        $dompdf->render();

        // Descargar el PDF generado
        $dompdf->stream('Regulacion_' . $data['regulacion']->ID_Regulacion . '.pdf', ['Attachment' => 0]);
    }

}