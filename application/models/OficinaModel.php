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
        $this->db->select('ma_oficina_administrativa.*, cat_sujeto_obligado.tipo_sujeto');
        $this->db->from('ma_oficina_administrativa');
        $this->db->join('cat_sujeto_obligado', 'cat_sujeto_obligado.ID_sujeto = ma_oficina_administrativa.ID_sujeto');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDatos($id_oficina) {
        $this->db->where('ID_Oficina', $id_oficina);
        $query = $this->db->get('ma_oficina_administrativa');
        return $query->row_array();
    }

    public function getOficinaEditar($id)
    {
        $this->db->select('ma_oficina_administrativa.*, cat_sujeto_obligado.tipo_sujeto');
        $this->db->from('ma_oficina_administrativa');
        $this->db->join('cat_sujeto_obligado', 'cat_sujeto_obligado.ID_sujeto = ma_oficina_administrativa.ID_sujeto');
        $this->db->where('ma_oficina_administrativa.ID_Oficina', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getHorariosOficina($id)
    {
        $this->db->select('de_horarios.*');
        $this->db->from('rel_oficina_horario');
        $this->db->join('de_horarios', 'rel_oficina_horario.ID_Horario = de_horarios.ID_Horario');
        $this->db->where('rel_oficina_horario.ID_Oficina', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getSujetosObligados()
    {
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }

    public function getUnidadAdministrativa()
    {
        $query = $this->db->get('cat_unidad_administrativa');
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
        return $this->db->insert_id();
    }


    public function insertar_horario($dias, $aperturas, $cierres)
    {
        $data = array(
            'Dia' => $dias,
            'Apertura' => $aperturas,
            'Cierre' => $cierres
        );
        $this->db->insert('de_horarios', $data);
        return $this->db->insert_id();
    }

    public function asociar_oficina_horario($id_oficina, $id_horario)
    {
        $data = array(
            'ID_Oficina' => $id_oficina,
            'ID_Horario' => $id_horario
        );
        $this->db->insert('rel_oficina_horario', $data);
    }

    public function actualizar_oficina($id_oficina, $data)
    {
        $this->db->where('ID_Oficina', $id_oficina);
        $this->db->update('ma_oficina_administrativa', $data);
    }

    public function eliminarOficina($id)
    {
        // Obtener los ID_horario asociados con la oficina
        $this->db->select('ID_Horario');
        $this->db->from('rel_oficina_horario');
        $this->db->where('ID_Oficina', $id);
        $query = $this->db->get();
        $horarios = $query->result();

        // Eliminar los horarios relacionados con la oficina
        foreach ($horarios as $horario) {
            $this->db->where('ID_Horario', $horario->ID_Horario);
            $this->db->delete('de_horarios');
        }

        // Eliminar las relaciones entre la oficina y los horarios
        $this->db->where('ID_Oficina', $id);
        $this->db->delete('rel_oficina_horario');

        // Eliminar la oficina
        $this->db->where('ID_Oficina', $id);
        $this->db->delete('ma_oficina_administrativa');
    }

    public function eliminarHorarios($idhorario)
    {
        $this->db->where('ID_Horario', $idhorario);
        $this->db->delete('de_horarios');
    }


}
