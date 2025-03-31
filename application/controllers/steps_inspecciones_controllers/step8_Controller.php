<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step8_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('steps_inspecciones_models/step8_Model', 'step8Model');
        $this->load->helper(['form','url']);
        $this->load->library('upload');
    }
    
    // Método para guardar datos del step8: No publicidad
    public function guardar() {
        $id_inspeccion = $this->input->post('ID_inspeccion');
        // Obtener el valor del select (si es "si" o "no")
        $publico = $this->input->post('Permitir_Publicidad');
        
        // Procesar archivo si se envía (documento de justificación)
        $justificacion = null;
        if (!empty($_FILES['Documento_No_Publicidad']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'pdf|jpg|png';
            $this->upload->initialize($config);
            if ($this->upload->do_upload('Documento_No_Publicidad')) {
                $uploadData = $this->upload->data();
                $justificacion = $uploadData['file_name'];
            } else {
                // Opcional: manejar error de carga
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('InspeccionesController/form/' . $id_inspeccion);
                return;
            }
        }
        
        $result = $this->step8Model->guardar_no_publicidad($id_inspeccion, $publico, $justificacion);
        
        // Nuevo: Procesar y guardar secciones de no publicidad (campo "no_publicidad_secciones")
        $secciones = $this->input->post('no_publicidad_secciones');
        if ($secciones && is_array($secciones)) {
            $this->step8Model->guardar_no_publicidad_secciones($id_inspeccion, $secciones);
        }
        
        if($result) {
            echo json_encode(['status' => 'success', 'message' => 'Datos del Step 8 guardados correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar los datos del Step 8.']);
        }
    }
}
