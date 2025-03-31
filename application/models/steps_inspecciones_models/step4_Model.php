<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class step4_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Guardar o actualizar datos principales del Step4
    public function guardar_mas_detalles($id_inspeccion, $data) {
        $data['ID_inspeccion'] = $id_inspeccion;
        // Verificar si existe ya un registro
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $query = $this->db->get('rel_ins_mas_detalles');
        if($query->num_rows() > 0){
            return $this->db->where('ID_inspeccion', $id_inspeccion)->update('rel_ins_mas_detalles', $data);
        } else {
            return $this->db->insert('rel_ins_mas_detalles', $data);
        }
    }

    // Guardar facultades: elimina las existentes y luego inserta las nuevas
    public function guardar_facultades($id_inspeccion, $facultades) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_mas_detalles_facultades');
        foreach ($facultades as $facultad) {
            $this->db->insert('rel_ins_mas_detalles_facultades', [
                'ID_inspeccion' => $id_inspeccion,
                'Facultad'      => $facultad
            ]);
        }
    }

    // Guardar regulaciones
    public function guardar_regulaciones($id_inspeccion, $regulaciones) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_mas_detalles_regulaciones');
        foreach ($regulaciones as $reg) {
            $this->db->insert('rel_ins_mas_detalles_regulaciones', [
                'ID_inspeccion'  => $id_inspeccion,
                'Nombre_Regulacion' => $reg['Nombre_Regulacion'],
                'URL_Regulacion' => isset($reg['URL_Regulacion']) ? $reg['URL_Regulacion'] : null
            ]);
        }
    }

    // Guardar sanciones
    public function guardar_sanciones($id_inspeccion, $sanciones) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_mas_detalles_sanciones');
        foreach ($sanciones as $sancion) {
            $this->db->insert('rel_ins_mas_detalles_sanciones', [
                'ID_inspeccion' => $id_inspeccion,
                'ID_Sancion'    => $sancion['ID_Sancion'],
                'Otra_Sancion'  => isset($sancion['Otra_Sancion']) ? $sancion['Otra_Sancion'] : null,
                'URL_Sancion'   => isset($sancion['URL_Sancion']) ? $sancion['URL_Sancion'] : null
            ]);
        }
    }

    // Guardar servidores
    public function guardar_servidores($id_inspeccion, $servidores) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_mas_detalles_servidores');
        foreach ($servidores as $servidor) {
            $this->db->insert('rel_ins_mas_detalles_servidores', [
                'ID_inspeccion' => $id_inspeccion,
                'Nombre_Servidor' => $servidor['Nombre_Servidor'],
                'URL_Ficha'       => isset($servidor['URL_Ficha']) ? $servidor['URL_Ficha'] : null
            ]);
        }
    }
}
