<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadisticasModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        // Cargar la base de datos
        $this->load->database();
    }

    // Método para obtener todas las estadísticas
    public function get_all_estadisticas() {
        $query = $this->db->get('estadisticas'); // Ajusta el nombre de la tabla a tus necesidades
        return $query->result_array();
    }

    // Método para obtener una estadística por su ID
    public function get_estadistica_by_id($id) {
        $query = $this->db->get_where('estadisticas', array('Estadistica_ID' => $id));
        return $query->row_array();
    }

    // Método para insertar una nueva estadística
    public function insert_estadistica($data) {
        return $this->db->insert('estadisticas', $data);
    }

    // Método para actualizar una estadística existente
    public function update_estadistica($id, $data) {
        $this->db->where('Estadistica_ID', $id);
        return $this->db->update('estadisticas', $data);
    }

    // Método para eliminar una estadística
    public function delete_estadistica($id) {
        $this->db->where('Estadistica_ID', $id);
        return $this->db->delete('estadisticas');
    }
}