<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ciudadania extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RegulacionModel');
        $this->load->library('pdf');
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
        error_log(print_r($regulaciones, true));

        $data['tiposOrdenamiento'] = $this->desplegarTipos();
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
    public function buscarRegulaciones()
    {
        // Obtiene los datos JSON del cuerpo de la solicitud
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        // Accede a cada uno de los valores
        $desdeFecha = $data->desde;
        $hastaFecha = $data->hasta;
        $dependencia = $data->dependencia;

        $resultados = $this->RegulacionModel->buscarRegulaciones($desdeFecha, $hastaFecha, $dependencia);

        echo json_encode($resultados);
    }

    public function verRegulacion($id)
    {
        $data['regulacion'] = $this->RegulacionModel->obtenerRegulacionPorId($id);
        $this->blade->render('ciudadania' . DIRECTORY_SEPARATOR . 'ver_regulacion', $data);
    }

    public function descargarPdf($id)
    {
        $regulacion = $this->RegulacionModel->obtenerRegulacionPorId($id);

        // Crear una nueva instancia de mPDF
        $mpdf = new \Mpdf\Mpdf();

        // Definir la fuente personalizada
        $mpdf->fontdata['geomanist'] = [
            'R' => 'Geomanist-Regular.otf', // Regular
        ];

        // Establecer la fuente predeterminada
        $mpdf->default_font = 'geomanist';

        // Cargar una vista de Blade
        $html = $this->blade->render('ciudadania' . DIRECTORY_SEPARATOR . 'pdf_template', ['regulacion' => $regulacion]);

        // Escribir el contenido HTML en el PDF
        $mpdf->WriteHTML($html);

        // Descargar el PDF generado
        $mpdf->Output('Regulacion_' . $regulacion->ID_Regulacion . '.pdf', 'D');
    }

}