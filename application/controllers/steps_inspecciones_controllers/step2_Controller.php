<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step2_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('steps_inspecciones_models/step2_Model');
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
    }
    
    // Método para guardar los datos del Step 2: Autoridad Pública
    public function guardar() {
        $this->form_validation->set_rules('ID_inspeccion', 'ID Inspección', 'required|integer');
        $this->form_validation->set_rules('ID_unidad', 'Unidad Administrativa', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => false,
                'errors' => validation_errors()
            ];
            echo json_encode($response);
            return;
        }
        
        $id_inspeccion = $this->input->post('ID_inspeccion');
        $ID_unidad     = $this->input->post('ID_unidad');
        
        $result = $this->step2_Model->guardar_autoridad_publica($id_inspeccion, $ID_unidad);
        
        if ($result) {
            $response = [
                'status'  => true,
                'message' => 'Datos guardados correctamente'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Error al guardar los datos'
            ];
        }
        
        echo json_encode($response);
    }
}
