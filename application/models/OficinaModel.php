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
        $this->db->select('ma_oficina_administrativa.*, cat_oficinas.Nombre_Sujeto, cat_oficinas.unidad_Administrativa');
        $this->db->from('ma_oficina_administrativa');
        $this->db->join('cat_oficinas', 'cat_oficinas.ID_ofic = ma_oficina_administrativa.ID_Oficina');
        $query = $this->db->get();
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


    public function insertar_horario($data)
    {
        $this->db->insert('de_oficina_horarios', $data);
    }

    public function asociar_oficina_horario($id_oficina, $id_horario)
    {
        $data = array(
            'ID_Oficina' => $id_oficina,
            'ID_Horario' => $id_horario
        );
        $this->db->insert('rel_oficina_horario', $data);
    }


    public function eliminar_oficina($id)
    {
        // Eliminar la oficina con el ID proporcionado
        $this->db->where('id_oficina', $id);
        $this->db->delete('ma_oficina_administrativa');
    }

}
