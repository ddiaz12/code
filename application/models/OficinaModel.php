<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OficinaModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getOficinas()
    {
        $query = $this->db->get('ma_oficina_administrativa');
        return $query->result();
    }

    public function getCatOficinas()
    {
        $query = $this->db->get('cat_oficinas');
        return $query->result();
    }

    public function getCatVialidades()
    {
        $query = $this->db->get('cat_vialidades');
        return $query->result();
    }

    public function getCatMunicipios()
    {
        $query = $this->db->get('cat_municipios');
        return $query->result();
    }

    public function getCatLocalidades()
    {
        $query = $this->db->get('cat_localidades');
        return $query->result();
    }

    public function insertar_oficina($data)
    {
        $this->db->insert('ma_oficina_administrativa', $data);
    }

    public function eliminar_oficina($id)
    {
        // Eliminar la oficina con el ID proporcionado
        $this->db->where('id_oficina', $id);
        $this->db->delete('ma_oficina_administrativa');
    }

}
