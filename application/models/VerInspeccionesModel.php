<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VerInspeccionesModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getInspecciones()
    {
        $query = $this->db->get('inspeccion_detallada');
        return $query->result_array();
    }

    public function buscarInspecciones($criterio)
    {
        $this->db->like('Nombre_Inspeccion', $criterio);
        $this->db->or_like('Dependencia', $criterio);
        $query = $this->db->get('inspeccion_detallada');
        return $query->result_array();
    }
}
