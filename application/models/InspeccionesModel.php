<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InspeccionesModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Obtener todas las inspecciones
    public function get_inspecciones() {
        $this->db->select('*');
        $query = $this->db->get('ma_inspeccion'); // Nombre de la tabla en la base de datos
        return $query->result_array();
    }

    // Obtener una inspección por su ID
    public function get_inspeccion_by_id($id) {
        $this->db->where('id_inspeccion', $id);
        $query = $this->db->get('ma_inspeccion');
        return $query->row_array();
    }

    // Insertar una nueva inspección
    public function insert_inspeccion($data) {
        return $this->db->insert('ma_inspeccion', $data);
    }

    // Actualizar una inspección existente
    public function update_inspeccion($id, $data) {
        $this->db->where('id_inspeccion', $id);
        return $this->db->update('ma_inspeccion', $data);
    }

    // Eliminar una inspección
    public function delete_inspeccion($id) {
        $this->db->where('id_inspeccion', $id);
        return $this->db->delete('ma_inspeccion');
    }
    
    // Obtener sujetos obligados para la vista
    public function get_sujetos_obligados() {
        // Cambiar el nombre de la tabla a "cat_sujeto_obligado"
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }
    
    // Obtener catálogo de tipo de ordenamiento jurídico
    public function get_tipo_ord_jur() {
        $query = $this->db->get('cat_tipo_ord_jur');
        return $query->result();
    }
}