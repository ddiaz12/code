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
            // Recopilar los datos del formulario usando los nombres de columna correctos:
            $data = [
                'nombre'           => $this->input->post('nombre'),
                'Primer_Apellido'  => $this->input->post('primer_apellido'),
                'Segundo_Apellido' => $this->input->post('segundo_apellido'),
                'Numero_Empleado'  => $this->input->post('numero_empleado'), // Se usa 'Numero_Empleado' en vez de 'Telefono'
                'cargo'            => $this->input->post('cargo'),
                'ID_Sujeto'        => $this->input->post('sujeto_obligado'),
                'ID_Unidad'        => $this->input->post('unidad_administrativa'),
            ];

            // Procesar carga de imagen y asignar al campo "Foto_Archivo"
            if (isset($_FILES['fotografia']) && !empty($_FILES['fotografia']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size']      = 2048;
                
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('fotografia')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('inspectores');
                    return;
                } else {
                    $upload_data = $this->upload->data();
                    $data['Foto_Archivo'] = $upload_data['file_name'];
                }
            }

            // Guardar los datos usando el modelo (asegúrate de que en el modelo se use la misma tabla)
            $result = $this->Inspectores_Model->agregarInspector($data);
            if ($result) {
                $this->session->set_flashdata('success', 'Se completó el registro');
            } else {
                $this->session->set_flashdata('error', 'Ocurrió un error al guardar la información.');
            }
            // Guardar datos de identificación (Step 1) en rel_inspectores_identificacion
            $data_identificacion = [
                'Nombre'           => $this->input->post('nombre'),
                'Numero_Empleado'  => $this->input->post('numero_empleado'),
                'Primer_Apellido'  => $this->input->post('primer_apellido'),
                'Segundo_Apellido' => $this->input->post('segundo_apellido'),
                'Cargo'            => $this->input->post('cargo'),
                'ID_Sujeto'        => $this->input->post('sujeto_obligado'),
                'ID_Unidad'        => $this->input->post('unidad_administrativa'),
                'Foto_Archivo'     => isset($upload_data['file_name']) ? $upload_data['file_name'] : ''
            ];
            $this->Inspectores_Model->guardar_identificacion($id_inspector, $data_identificacion);

            // Guardar datos del Step 2: Superior Jerárquico
            if($this->input->post('ID_superior')) {
                $data_superior = [
                    'ID_superior' => $this->input->post('ID_superior'),
                    'Telefono'    => $this->input->post('Telefono'),
                    'Extension'   => $this->input->post('Extension')
                ];
                $this->Inspectores_Model->guardar_superior_jerarquico($id_inspector, $data_superior);
            }

            // Guardar datos del Step 3: No publicidad
            if(isset($_POST['no_publicidad'])) {
                $no_pub_data = [
                    'Publico' => $this->input->post('no_publicidad'), // Valor 'Si' o 'No'
                    // Procesar archivo si se envió
                    'Justificante_Archivo' => ''
                ];
                if(!empty($_FILES['Justificante_Archivo']['name'])) {
                    $config['upload_path']   = './uploads/';
                    $config['allowed_types'] = 'pdf|jpg|png';
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('Justificante_Archivo')){
                        $uploadData = $this->upload->data();
                        $no_pub_data['Justificante_Archivo'] = $uploadData['file_name'];
                    }
                }
                $this->Inspectores_Model->guardar_no_publicidad($id_inspector, $no_pub_data);

                // Guardar detalles de no publicidad (campo "no_publicidad_detalle" debe ser un arreglo)
                if($this->input->post('no_publicidad_detalle')) {
                    $detalles = $this->input->post('no_publicidad_detalle');
                    $this->Inspectores_Model->guardar_no_publicidad_detalle($id_inspector, $detalles);
                }
            }

            // Guardar datos del Step 4: Emergencias
            if(isset($_POST['emergencias'])) {
                $emerg_data = $this->input->post('emergencias');
                // Procesar archivo si se envió
                if(isset($_FILES['emergencias']['name']['Archivo_Oficio']) && !empty($_FILES['emergencias']['name']['Archivo_Oficio'])) {
                    $config['upload_path']   = './uploads/';
                    $config['allowed_types'] = 'pdf|jpg|png';
                    $this->load->library('upload', $config);
                    // Configurar el arreglo $_FILES para este input
                    $_FILES['Archivo_Oficio']['name']     = $_FILES['emergencias']['name']['Archivo_Oficio'];
                    $_FILES['Archivo_Oficio']['type']     = $_FILES['emergencias']['type']['Archivo_Oficio'];
                    $_FILES['Archivo_Oficio']['tmp_name'] = $_FILES['emergencias']['tmp_name']['Archivo_Oficio'];
                    $_FILES['Archivo_Oficio']['error']    = $_FILES['emergencias']['error']['Archivo_Oficio'];
                    $_FILES['Archivo_Oficio']['size']     = $_FILES['emergencias']['size']['Archivo_Oficio'];

                    if($this->upload->do_upload('Archivo_Oficio')) {
                        $uploadData = $this->upload->data();
                        $emerg_data['Archivo_Oficio'] = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('inspectores');
                        return;
                    }
                }
                $this->Inspectores_Model->guardar_emergencias($id_inspector, $emerg_data);
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
            $html .= $this->blade->render('inspectores/pdf_template', [
                'inspector' => [
                    'ID' => $inspector->ID,
                    'Homoclave' => $inspector->Homoclave,
                    'Nombre' => $inspector->Nombre,
                    'Primer_Apellido' => $inspector->Primer_Apellido,
                    'Segundo_Apellido' => $inspector->Segundo_Apellido,
                    'ID_Sujeto' => $inspector->ID_Sujeto,
                    'ID_Unidad' => $inspector->ID_Unidad,
                    'Estatus' => $inspector->Estatus,
                    'ID_Tipo' => $inspector->ID_Tipo,
                    'Vigencia' => $inspector->Vigencia
                ]
            ], true);
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
        $sheet->setCellValue('F1', 'ID_Sujeto');
        $sheet->setCellValue('G1', 'ID_Unidad');
        $sheet->setCellValue('H1', 'Estatus');
        $sheet->setCellValue('I1', 'ID_Tipo');
        $sheet->setCellValue('J1', 'Vigencia');

        // Set data
        $row = 2;
        foreach ($inspectores as $inspector) {
            $sheet->setCellValue('A' . $row, $inspector->ID);
            $sheet->setCellValue('B' . $row, $inspector->Homoclave);
            $sheet->setCellValue('C' . $row, $inspector->Nombre);
            $sheet->setCellValue('D' . $row, $inspector->Primer_Apellido);
            $sheet->setCellValue('E' . $row, $inspector->Segundo_Apellido);
            $sheet->setCellValue('F' . $row, $inspector->ID_Sujeto);
            $sheet->setCellValue('G' . $row, $inspector->ID_Unidad);
            $sheet->setCellValue('H' . $row, $inspector->Estatus);
            $sheet->setCellValue('I' . $row, $inspector->ID_Tipo);
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