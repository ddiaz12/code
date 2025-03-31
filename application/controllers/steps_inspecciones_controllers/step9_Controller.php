<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step9_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('steps_inspecciones_models/step9_Model', 'step9Model');
        $this->load->helper(['form','url']);
    }

    // Método para guardar datos del Step 9: Emergencias
    public function guardar() {
        $id_inspeccion = $this->input->post('ID_inspeccion');
        $datos = [
            'Es_Emergencia' => $this->input->post('Es_Emergencia'),
            'Justificacion_Emergencia' => $this->input->post('Justificacion_Emergencia')
        ];
        
        $result = $this->step9Model->guardar_emergencias($id_inspeccion, $datos);
        
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Emergencias guardadas correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar emergencias.']);
        }
    }
}
