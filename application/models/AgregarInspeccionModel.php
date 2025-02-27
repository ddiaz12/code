<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgregarInspeccionModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function guardarInspeccion($data) {
        return $this->db->insert('inspeccion_detallada', $data);
    }

    public function update_inspeccion($id_inspeccion, $data) {
        $this->db->where('id_inspeccion', $id_inspeccion);
        return $this->db->update('inspeccion_detallada', $data);
    }

    public function getSujetosObligados() {
        $this->db->where('nombre_sujeto !=', 'No especificado');
        $this->db->where('status !=', 0);
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }

    public function getFundamentosJuridicos() {
        $query = $this->db->get('cat_tipo_ord_jur');
        return $query->result();
    }

    public function getOficinasAdministrativas() {
        $this->db->select('nombre');
        $query = $this->db->get('ma_oficina_administrativa');
        return $query->result();
    }
}