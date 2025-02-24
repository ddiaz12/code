<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VerEstadisticasModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getEstadisticas()
    {
        $this->db->select('inspeccion_detallada.Sujeto_Obligado_ID, cat_sujeto_obligado.nombre_sujeto, inspeccion_detallada.Nombre_Inspeccion, inspeccion_detallada.Modalidad');
        $this->db->from('inspeccion_detallada');
        $this->db->join('cat_sujeto_obligado', 'inspeccion_detallada.Sujeto_Obligado_ID = cat_sujeto_obligado.ID_sujeto');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function buscarEstadisticas($criterio)
    {
        $this->db->select('inspeccion_detallada.Sujeto_Obligado_ID, cat_sujeto_obligado.nombre_sujeto, inspeccion_detallada.Nombre_Inspeccion, inspeccion_detallada.Modalidad');
        $this->db->from('inspeccion_detallada');
        $this->db->join('cat_sujeto_obligado', 'inspeccion_detallada.Sujeto_Obligado_ID = cat_sujeto_obligado.ID_sujeto');
        $this->db->like('inspeccion_detallada.Nombre_Inspeccion', $criterio);
        $query = $this->db->get();
        return $query->result_array();
    }
}
