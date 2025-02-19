<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspector_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getInspectorById($id) {
        $query = $this->db->get_where('inspectores', ['Inspector_ID' => $id]);
        return $query->row();
    }
}
