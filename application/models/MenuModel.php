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
            $this->db->select('cat_sujeto_obligado.*, cat_tipo_sujeto_obligado.tipo_sujeto');
            $this->db->from('cat_sujeto_obligado');
            $this->db->join('cat_tipo_sujeto_obligado', 'cat_tipo_sujeto_obligado.ID_tipoSujeto = cat_sujeto_obligado.ID_tipoSujeto');
            $this->db->where('cat_sujeto_obligado.nombre_sujeto !=', 'No especificado');
            $query = $this->db->get();
            return $query->result();
    }

    public function getSujeto($id){
        $this->db->select('cat_sujeto_obligado.*, cat_tipo_sujeto_obligado.tipo_sujeto');
        $this->db->from('cat_sujeto_obligado');
        $this->db->join('cat_tipo_sujeto_obligado', 'cat_tipo_sujeto_obligado.ID_tipoSujeto = cat_sujeto_obligado.ID_tipoSujeto');
        $this->db->where('cat_sujeto_obligado.ID_sujeto', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getTipoSujetoObligado()
    {
        $this->db->where('tipo_sujeto !=', 'No especificado');
        $query = $this->db->get('cat_tipo_sujeto_obligado');
        return $query->result();
    }

    public function getUnidadesAdministrativas()
    {
        $this->db->select('cat_unidad_administrativa.*, cat_sujeto_obligado.nombre_sujeto, cat_tipo_sujeto_obligado.tipo_sujeto');
        $this->db->from('cat_unidad_administrativa');
        $this->db->join('cat_sujeto_obligado', 'cat_sujeto_obligado.ID_sujeto = cat_unidad_administrativa.ID_sujeto');
        $this->db->join('cat_tipo_sujeto_obligado', 'cat_tipo_sujeto_obligado.ID_tipoSujeto = cat_sujeto_obligado.ID_tipoSujeto');
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
        $this->db->select('cat_unidad_administrativa.*, cat_sujeto_obligado.nombre_sujeto, cat_tipo_sujeto_obligado.tipo_sujeto');
        $this->db->from('cat_unidad_administrativa');
        $this->db->join('cat_sujeto_obligado', 'cat_sujeto_obligado.ID_sujeto = cat_unidad_administrativa.ID_sujeto');
        $this->db->join('cat_tipo_sujeto_obligado', 'cat_tipo_sujeto_obligado.ID_tipoSujeto = cat_sujeto_obligado.ID_tipoSujeto');
        $this->db->where('cat_unidad_administrativa.ID_unidad', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function obtenerHorariosUnidad($id)
    {
        $this->db->select('de_horarios.*');
        $this->db->from('rel_unidad_horario');
        $this->db->join('de_horarios', 'rel_unidad_horario.ID_horario = de_horarios.ID_Horario');
        $this->db->where('rel_unidad_horario.ID_unidad', $id);
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
        $this->db->where('ID_Horario', $idhorario);
        $this->db->delete('de_horarios');
    }

    public function insertarHorario($dias, $aperturas, $cierres)
    {
        $data = array(
            'Dia' => $dias,
            'Apertura' => $aperturas,
            'Cierre' => $cierres
        );

        $this->db->insert('de_horarios', $data);
        return $this->db->insert_id();
    }

    public function insertarRelacionUnidadHorario($id_unidad, $id_horario)
    {
        $data = array(
            'ID_unidad' => $id_unidad,
            'ID_horario' => $id_horario
        );

        $this->db->insert('rel_unidad_horario', $data);
    }

    public function eliminarUnidad($id)
    {
        // Obtener los ID_horario asociados con la unidad
        $this->db->select('ID_Horario');
        $this->db->from('rel_unidad_horario');
        $this->db->where('ID_unidad', $id);
        $query = $this->db->get();
        $horarios = $query->result();

        // Eliminar los horarios relacionados con la unidad
        foreach ($horarios as $horario) {
            $this->db->where('ID_Horario', $horario->ID_horario);
            $this->db->delete('de_horarios');
        }

        // Eliminar las relaciones entre la unidad y los horarios
        $this->db->where('ID_unidad', $id);
        $this->db->delete('rel_unidad_horario');

        // Eliminar la unidad
        $this->db->where('ID_unidad', $id);
        $this->db->delete('cat_unidad_administrativa');
    }

    public function insertar_sujeto($data)
    {
        $this->db->insert('cat_sujeto_obligado', $data);
    }

    public function actualizar_sujeto($id_sujeto, $data)
    {
        $this->db->where('ID_sujeto', $id_sujeto);
        $this->db->update('cat_sujeto_obligado', $data);
    }

    public function eliminarSujeto($id)
    {
        $this->db->where('ID_sujeto', $id);
        $this->db->delete('cat_sujeto_obligado');
    }
}


