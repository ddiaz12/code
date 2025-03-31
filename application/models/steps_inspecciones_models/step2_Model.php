<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step2_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Guarda la información del step2 en la tabla rel_ins_autoridad_publica
    public function guardar_autoridad_publica($id_inspeccion, $ID_unidad) {
        // Eliminar registros previos de esta inspección
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_autoridad_publica');
        
        // Insertar el nuevo registro
        $data = [
            'ID_inspeccion' => $id_inspeccion,
            'ID_unidad'     => $ID_unidad
        ];
        return $this->db->insert('rel_ins_autoridad_publica', $data);
    }
}
