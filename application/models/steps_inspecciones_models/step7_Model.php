<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step7_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Guarda la información adicional del step7 en la tabla rel_ins_info_adicional
    public function guardar_info_adicional($id_inspeccion, $informacion) {
        // Eliminar registro previo para este ID_inspeccion
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_info_adicional');
        
        $data = [
            'ID_inspeccion'       => $id_inspeccion,
            'Informacion_Adicional' => $informacion
        ];
        return $this->db->insert('rel_ins_info_adicional', $data);
    }

    // Nuevo: Guardar datos de derechos (tabla rel_ins_info_derechos)
    public function guardar_info_derechos($id_inspeccion, $derechos) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_info_derechos');
        foreach ($derechos as $derecho) {
            $data = [
                'ID_inspeccion' => $id_inspeccion,
                'Derecho'       => $derecho
            ];
            $this->db->insert('rel_ins_info_derechos', $data);
        }
    }

    // Nuevo: Guardar datos de fundamentos (tabla rel_ins_info_fundamento)
    public function guardar_info_fundamento($id_inspeccion, $fundamentos) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_info_fundamento');
        foreach ($fundamentos as $fund) {
            $data = [
                'ID_inspeccion' => $id_inspeccion,
                'Nombre'        => isset($fund['Nombre']) ? $fund['Nombre'] : '',
                'Articulo'      => isset($fund['Articulo']) ? $fund['Articulo'] : '',
                'URL'           => isset($fund['URL']) ? $fund['URL'] : null
            ];
            $this->db->insert('rel_ins_info_fundamento', $data);
        }
    }

    // Nuevo: Guardar datos de obligaciones (tabla rel_ins_info_obligaciones)
    public function guardar_info_obligaciones($id_inspeccion, $obligaciones) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_info_obligaciones');
        foreach ($obligaciones as $obligacion) {
            $data = [
                'ID_inspeccion' => $id_inspeccion,
                'Obligacion'    => $obligacion
            ];
            $this->db->insert('rel_ins_info_obligaciones', $data);
        }
    }

    // Nuevo: Guardar sujetos obligados (tabla rel_ins_info_sujetos_obligados)
    public function guardar_info_sujetos_obligados($id_inspeccion, $sujetos) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_info_sujetos_obligados');
        foreach ($sujetos as $sujeto) {
            $data = [
                'ID_inspeccion' => $id_inspeccion,
                'ID_sujeto'     => $sujeto
            ];
            $this->db->insert('rel_ins_info_sujetos_obligados', $data);
        }
    }
}
