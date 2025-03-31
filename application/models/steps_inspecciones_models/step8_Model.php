<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step8_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Guarda los datos en la tabla rel_ins_no_publicidad
    public function guardar_no_publicidad($id_inspeccion, $publico, $justificacion) {
        // Eliminar registro previo para este ID_inspeccion
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_no_publicidad');
        
        $data = [
            'ID_inspeccion'         => $id_inspeccion,
            'Publico'               => $publico,
            'Justificacion_Archivo' => $justificacion
        ];
        
        return $this->db->insert('rel_ins_no_publicidad', $data);
    }
    
    // Nuevo: Guardar secciones de no publicidad (tabla rel_ins_no_publicidad_secciones)
    public function guardar_no_publicidad_secciones($id_inspeccion, $secciones) {
        // Eliminar registros previos para este ID_inspeccion
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_no_publicidad_secciones');
        
        foreach ($secciones as $ID_Seccion) {
            $data = [
                'ID_inspeccion' => $id_inspeccion,
                'ID_Seccion' => $ID_Seccion
            ];
            $this->db->insert('rel_ins_no_publicidad_secciones', $data);
        }
    }
}
