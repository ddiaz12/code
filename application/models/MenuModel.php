<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getSujetosObligados()
    {
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }

    public function getUnidadesAdministrativas()
    {

        $this->db->select('cat_unidad_administrativa.*, cat_sujeto_obligado.nombre_sujeto, cat_sujeto_obligado.tipo_sujeto');
        $this->db->from('cat_unidad_administrativa');
        $this->db->join('cat_sujeto_obligado', 'cat_sujeto_obligado.ID_sujeto = cat_unidad_administrativa.ID_sujeto');
        $query = $this->db->get();
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

    public function getUnidad($id)
    {
        $this->db->select('cat_unidad_administrativa.*, cat_sujeto_obligado.nombre_sujeto, cat_sujeto_obligado.tipo_sujeto');
        $this->db->from('cat_unidad_administrativa');
        $this->db->join('cat_sujeto_obligado', 'cat_sujeto_obligado.ID_sujeto = cat_unidad_administrativa.ID_sujeto');
        $this->db->where('ID_unidad', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getHorarios($id)
    {
        $this->db->select('*');
        $this->db->from('de_unidad_horarios');
        $this->db->where('ID_unidad', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertar_unidad($data)
    {
        $this->db->insert('cat_unidad_administrativa', $data);
        return $this->db->insert_id();
    }

    public function actualizar_unidad($id_unidad, $data)
    {
        $this->db->where('ID_unidad', $id_unidad);
        $this->db->update('cat_unidad_administrativa', $data);
    }

    public function eliminarHorarios($idhorario)
    {
        $this->db->where('ID_horarios', $idhorario);
        $this->db->delete('de_unidad_horarios');
    }

    public function guardarHorario($id_unidad, $dias, $aperturas, $cierres)
    {
        $data = array(
            'id_unidad' => $id_unidad,
            'dia' => $dias,
            'apertura' => $aperturas,
            'cierre' => $cierres
        );

        $this->db->insert('de_unidad_horarios', $data);
    }

    public function eliminarUnidad($id)
    {
        // Eliminar los horarios relacionados con la unidad
        $this->db->where('ID_unidad', $id);
        $this->db->delete('de_unidad_horarios');

        // Eliminar la unidad
        $this->db->where('ID_unidad', $id);
        $this->db->delete('cat_unidad_administrativa');
    }
}

