<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step7_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('steps_inspecciones_models/step7_Model', 'step7Model');
        $this->load->helper(['form', 'url']);
    }

    // Método para guardar la información adicional del step7
    public function guardar() {
        $id_inspeccion = $this->input->post('ID_inspeccion');
        $info = $this->input->post('info_adicional');
        
        $result = $this->step7Model->guardar_info_adicional($id_inspeccion, $info);
        
        // Nuevo: Guardar derechos si se envían
        $derechos = $this->input->post('info_derechos');
        if ($derechos && is_array($derechos)) {
            $this->step7Model->guardar_info_derechos($id_inspeccion, $derechos);
        }
        
        // Nuevo: Guardar fundamentos si se envían
        $fundamentos = $this->input->post('info_fundamento');
        if ($fundamentos && is_array($fundamentos)) {
            $this->step7Model->guardar_info_fundamento($id_inspeccion, $fundamentos);
        }
        
        // Nuevo: Guardar obligaciones si se envían
        $obligaciones = $this->input->post('info_obligaciones');
        if ($obligaciones && is_array($obligaciones)) {
            $this->step7Model->guardar_info_obligaciones($id_inspeccion, $obligaciones);
        }
        
        // Nuevo: Guardar sujetos obligados si se envían
        $sujetos = $this->input->post('info_sujetos_obligados');
        if ($sujetos && is_array($sujetos)) {
            $this->step7Model->guardar_info_sujetos_obligados($id_inspeccion, $sujetos);
        }
        
        if($result) {
            echo json_encode(['status' => 'success', 'message' => 'Información adicional y complementaria guardada correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar la información adicional.']);
        }
    }
}
