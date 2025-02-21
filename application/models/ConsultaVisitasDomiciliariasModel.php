<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ConsultaVisitasDomiciliariasModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getDependencias()
    {
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result_array();
    }

    public function getTiposOrdenamiento()
    {
        $query = $this->db->get('cat_tipo_ord_jur');
        return $query->result_array();
    }

    public function contarRegulaciones()
    {
        // Contar las filas en la tabla 'cat_sujeto_obligado'
        return $this->db->count_all('cat_sujeto_obligado');
    }

    public function buscarPorNombre($nombre)
    {
        $this->db->like('nombre', $nombre);
        $query = $this->db->get('visitas_domiciliarias');
        return $query->result_array();
    }

    public function buscarVisitas($desde, $hasta, $dependencia, $tipoOrdenamiento)
    {
        if (!empty($desde)) {
            $this->db->where('fecha >=', $desde);
        }
        if (!empty($hasta)) {
            $this->db->where('fecha <=', $hasta);
        }
        if (!empty($dependencia)) {
            $this->db->where('dependencia', $dependencia);
        }
        if (!empty($tipoOrdenamiento)) {
            $this->db->where('tipo_ordenamiento', $tipoOrdenamiento);
        }
        $query = $this->db->get('visitas_domiciliarias');
        return $query->result_array();
    }
}
