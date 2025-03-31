<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step5_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cargar el modelo del step 5
        $this->load->model('steps_inspecciones_models/step5_Model', 'step5Model');
        $this->load->helper(['form','url']);
    }
    
    // Método para guardar los datos del step5
    public function guardar() {
        $id_inspeccion = $this->input->post('ID_inspeccion');
        $ID_unidad     = $this->input->post('ID_unidad');
        
        // Guardar únicamente la autoridad pública (ya implementado)
        $result = $this->step5Model->guardar_autoridad_publica($id_inspeccion, $ID_unidad);
        
        // Procesar datos de contacto, si existen
        $contacto = $this->input->post('autoridad_contacto');
        if ($contacto) {
            $this->step5Model->guardar_autoridad_contacto($id_inspeccion, $contacto);
        }
        
        // Procesar datos de impugnación, si existen
        $impugnacion = $this->input->post('autoridad_contacto_impugnacion');
        if ($impugnacion) {
            $this->step5Model->guardar_autoridad_contacto_impugnacion($id_inspeccion, $impugnacion);
        }
        
        // Procesar números telefónicos, si se envían como array
        $telefonos = $this->input->post('autoridad_contacto_telefonos');
        if ($telefonos && is_array($telefonos)) {
            $this->step5Model->guardar_autoridad_contacto_telefonos($id_inspeccion, $telefonos);
        }
        
        if($result) {
            echo json_encode(['status' => 'success', 'message' => 'Datos del Step 5 guardados correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar datos del Step 5.']);
        }
    }
}
