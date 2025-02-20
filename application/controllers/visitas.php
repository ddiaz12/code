<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('NotificacionesModel');// Cargar modelo de notificaciones
        // Load necessary models, libraries, etc.
        $this->load->model('Visitas_Model');
        $this->load->library('pdf'); // Cargar la biblioteca de PDF
    }

    public function index() {

        //Correo y timer
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        // Fetch data from the model
        $data['inspecciones'] = $this->Visitas_Model->get_inspecciones();

        // Load the view and pass the data
        $this->blade->render('visitas/index', $data);
    }

    public function agregar() {
        // Logic for adding a new inspection
        if ($this->input->post()) {
            // Handle form submission
            $this->Visitas_model->add_visita($this->input->post());
            redirect('visitas');
        } else {
            // Obtener el número máximo actual y generar la nueva Homoclave
            $query = $this->db->query("SELECT IFNULL(MAX(CAST(SUBSTRING(Homoclave, LENGTH('I-IPR-CTIH-0-IPR-')+1) AS UNSIGNED)), 0) as max_val FROM inspeccion_detallada");
            $max = (int) $query->row()->max_val;
            $newNumber = $max + 1;
            $homoclaveNuevo = "I-IPR-CTIH-0-IPR-" . str_pad($newNumber, 4, "0", STR_PAD_LEFT);
            $data['homoclaveNuevo'] = $homoclaveNuevo;
            // Renderizar la vista de agregar inspección
            $this->blade->render('inspeccion/agregar_inspeccion', $data);
        }
    }

    // Cambiar la firma para recibir el ID de inspección
    public function descargar($tipo, $id) {
        $inspeccion = $this->Visitas_Model->get_inspeccion_by_id($id);
        if(!$inspeccion) { 
            show_404();
        }
        if ($tipo == 'pdf') {
            $this->generar_pdf($inspeccion);
        } elseif ($tipo == 'excel') {
            $this->generar_excel([$inspeccion]); // o procesar según tu lógica para Excel
        } else {
            show_404();
        }
    }

    // Modificar para recibir una única inspección y pasarla a la vista
    private function generar_pdf($inspeccion) {
        $html = $this->blade->render('visitas/pdf_template', ['inspeccion' => $inspeccion], true);
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->render();
        $this->pdf->stream("ficha_inspeccion.pdf", array("Attachment" => 1));
    }

    private function generar_excel($inspecciones) {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Homoclave');
        $sheet->setCellValue('C1', 'Nombre');
        $sheet->setCellValue('D1', 'Modalidad');
        $sheet->setCellValue('E1', 'Sujeto Obligado');
        $sheet->setCellValue('F1', 'Unidad Administrativa');
        $sheet->setCellValue('G1', 'Estatus');
        $sheet->setCellValue('H1', 'Tipo');
        $sheet->setCellValue('I1', 'Vigencia');

        // Set data
        $row = 2;
        foreach ($inspecciones as $inspeccion) {
            $sheet->setCellValue('A' . $row, $inspeccion['id_inspeccion']);
            $sheet->setCellValue('B' . $row, $inspeccion['Homoclave']);
            $sheet->setCellValue('C' . $row, $inspeccion['Nombre_Inspeccion']);
            $sheet->setCellValue('D' . $row, $inspeccion['Modalidad']);
            $sheet->setCellValue('E' . $row, $inspeccion['Sujeto_Obligado_ID']);
            $sheet->setCellValue('F' . $row, $inspeccion['Unidad_Administrativa']); // corregido
            $sheet->setCellValue('G' . $row, $inspeccion['Estatus']);
            $sheet->setCellValue('H' . $row, $inspeccion['Tipo_Inspeccion']);
            $sheet->setCellValue('I' . $row, $inspeccion['Vigencia']);
            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'fichas_inspecciones.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
    }
}
?>