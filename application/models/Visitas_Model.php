<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Fetch all visitas
    public function get_all_visitas() {
        $query = $this->db->get('users');
        return $query->result_array();
    }

    // Add a new visita
    public function add_visita($data) {
        return $this->db->insert('users', $data);
    }

    // Fetch a single visita by ID
    public function get_visita_by_id($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    // Update a visita
    public function update_visita($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    // Delete a visita
    public function delete_visita($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}
?>