<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspectores_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_inspectores() {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function agregarInspector($data) {
        return $this->db->insert('users', $data);
    }

    public function obtenerInspectorPorId($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row();
    }

    public function actualizarInspector($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
 
    public function eliminarInspector($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}
?>