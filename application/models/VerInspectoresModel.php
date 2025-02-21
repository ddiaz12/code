<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VerInspectoresModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Obtener todos los inspectores con su foto, nombre y dependencia
    public function getInspectores()
    {
        $this->db->select('Fotografia, Nombre, Apellido_Paterno, Apellido_Materno, Dependencia');
        $query = $this->db->get('inspectores');
        return $query->result_array();
    }

    // Buscar inspectores por nombre o apellido
    public function buscarInspectores($nombre)
    {
        $this->db->select('Fotografia, Nombre, Apellido_Paterno, Apellido_Materno, Dependencia');
        $this->db->like('Nombre', $nombre);
        $this->db->or_like('Apellido_Paterno', $nombre);
        $this->db->or_like('Apellido_Materno', $nombre);
        $query = $this->db->get('inspectores');
        return $query->result_array();
    }
}
