<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step6_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('steps_inspecciones_models/step6_Model', 'step6Model');
        $this->load->helper(['form', 'url']);
    }
    
    // Método para guardar estadísticas del Step 6
    public function guardar() {
        $id_inspeccion = $this->input->post('ID_inspeccion');
        $ID_dependencia = $this->input->post('ID_dependencia'); // proveniente del formulario o de la sesión
        
        // Extraer datos mensuales y de sanciones
        $datos = [
            'Enero' => $this->input->post('Enero'),
            'Febrero' => $this->input->post('Febrero'),
            'Marzo' => $this->input->post('Marzo'),
            'Abril' => $this->input->post('Abril'),
            'Mayo' => $this->input->post('Mayo'),
            'Junio' => $this->input->post('Junio'),
            'Julio' => $this->input->post('Julio'),
            'Agosto' => $this->input->post('Agosto'),
            'Septiembre' => $this->input->post('Septiembre'),
            'Octubre' => $this->input->post('Octubre'),
            'Noviembre' => $this->input->post('Noviembre'),
            'Diciembre' => $this->input->post('Diciembre'),
            'Inspecciones_Sancionadas' => $this->input->post('Inspecciones_Sancionadas')
        ];

        $result = $this->step6Model->actualizar_estadisticas($id_inspeccion, $ID_dependencia, $datos);
        
        if($result) {
            echo json_encode(['status' => 'success', 'message' => 'Estadísticas actualizadas correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar estadísticas.']);
        }
    }
}
