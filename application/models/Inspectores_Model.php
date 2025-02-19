<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspectores_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Cargar la base de datos
    }

    // Obtener todos los inspectores
    public function get_all_inspectores() {
        $query = $this->db->get('inspectores');
        return $query->result(); // Retorna un array de objetos
    }

    // Método para agregar un nuevo inspector
    public function agregarInspector($data) {
        return $this->db->insert('inspectores', $data);
    }

    // Método para obtener un inspector por su ID
    public function obtenerInspectorPorId($id) {
        $query = $this->db->get_where('inspectores', array('Inspector_ID' => $id));
        return $query->row();
    }

    // Método para actualizar un inspector existente
    public function update_inspector($id_inspector, $data) {
        $this->db->where('Inspector_ID', $id_inspector);
        return $this->db->update('inspectores', $data);
    }
}
?>