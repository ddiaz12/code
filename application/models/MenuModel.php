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

    public function insertar_unidad($data) {
        $this->db->insert('cat_unidad_administrativa', $data);
        return $this->db->insert_id();
    }

    public function guardarHorario($id_unidad, $dias, $aperturas, $cierres)
    {
        // Preparar los datos para la inserción
        $data = array(
            'id_unidad' => $id_unidad,
            'dia' => $dias,
            'apertura' => $aperturas,
            'cierre' => $cierres
        );

        // Insertar los datos en la base de datos
        $this->db->insert('de_unidad_horarios', $data);
    }
}

