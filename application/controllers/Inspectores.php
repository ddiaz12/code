<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspectores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, etc.
        $this->load->model('Inspectores_Model');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session', 'upload', 'pdf']);
        $this->load->model('NotificacionesModel');
    }

    public function index() {


        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        // Fetch data from the model
        $data['inspectores'] = $this->Inspectores_Model->get_all_inspectores();

        // Gestiona las vista depende el usuario que este logeado
        $id = $user->id;
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($id);
            $this->blade->render('inspectores/SOindex', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('inspectores/index', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('inspectores/index', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    public function agregarInspector() {
        $this->blade->render('inspector/agregarInspector');
    }

    public function guardar() {
        // Validación básica de ejemplo
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('primer_apellido', 'Primer Apellido', 'required');
        $this->form_validation->set_rules('segundo_apellido', 'Segundo Apellido', 'required');
        $this->form_validation->set_rules('numero_empleado', 'Número de Empleado', 'required');
        $this->form_validation->set_rules('cargo', 'Cargo', 'required');
        $this->form_validation->set_rules('sujeto_obligado', 'Sujeto Obligado', 'required');
        $this->form_validation->set_rules('unidad_administrativa', 'Unidad Administrativa', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->agregarInspector();
        } else {
            // Recopilar los datos del formulario
            $data = [
                'nombre' => $this->input->post('nombre'),
                'Apellido_Paterno' => $this->input->post('primer_apellido'),
                'Apellido_Materno' => $this->input->post('segundo_apellido'),
                'Telefono' => $this->input->post('numero_empleado'), // Cambio de clave a "Telefono"
                'cargo' => $this->input->post('cargo'),
                'sujeto_obligado' => $this->input->post('sujeto_obligado'),
                'unidad_administrativa' => $this->input->post('unidad_administrativa'),
                // Añade más campos según los que hayas agregado en la base de datos
            ];

            // Guardar los datos en la base de datos
            $result = $this->Inspectores_Model->agregarInspector($data);
            if ($result) {
                $this->session->set_flashdata('success', 'Se completó el registro');
            } else {
                $this->session->set_flashdata('error', 'Ocurrió un error al guardar la información.');
            }
            redirect('inspectores');
        }
    }

    public function descargar($tipo) {
        $inspectores = $this->Inspectores_Model->get_all_inspectores();

        if ($tipo == 'pdf') {
            $this->generar_pdf($inspectores);
        } elseif ($tipo == 'excel') {
            $this->generar_excel($inspectores);
        } else {
            show_404();
        }
    }

    private function generar_pdf($inspectores) {
        if (empty($inspectores)) {
            show_error('No hay inspectores disponibles para generar el PDF.');
            return;
        }

        $html = '';
        foreach ($inspectores as $inspector) {
            $html .= $this->blade->render('inspectores/pdf_template', ['inspector' => $inspector], true);
        }

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->render();
        $this->pdf->stream("fichas_inspectores.pdf", array("Attachment" => 1));
    }

    private function generar_excel($inspectores) {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Homoclave');
        $sheet->setCellValue('C1', 'Nombre');
        $sheet->setCellValue('D1', 'Primer Apellido');
        $sheet->setCellValue('E1', 'Segundo Apellido');
        $sheet->setCellValue('F1', 'Sujeto Obligado');
        $sheet->setCellValue('G1', 'Unidad Administrativa');
        $sheet->setCellValue('H1', 'Estatus');
        $sheet->setCellValue('I1', 'Tipo');
        $sheet->setCellValue('J1', 'Vigencia');

        // Set data
        $row = 2;
        foreach ($inspectores as $inspector) {
            $sheet->setCellValue('A' . $row, $inspector->Inspector_ID);
            $sheet->setCellValue('B' . $row, $inspector->Homoclave);
            $sheet->setCellValue('C' . $row, $inspector->Nombre);
            $sheet->setCellValue('D' . $row, $inspector->Apellido_Paterno);
            $sheet->setCellValue('E' . $row, $inspector->Apellido_Materno);
            $sheet->setCellValue('F' . $row, $inspector->Sujeto_Obligado);
            $sheet->setCellValue('G' . $row, $inspector->Unidad_Administrativa);
            $sheet->setCellValue('H' . $row, $inspector->Estatus);
            $sheet->setCellValue('I' . $row, $inspector->Tipo);
            $sheet->setCellValue('J' . $row, $inspector->Vigencia);
            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'fichas_inspectores.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
    }
}
?>