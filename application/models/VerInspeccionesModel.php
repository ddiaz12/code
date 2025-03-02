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
        $this->db->select(
            'i.Nombre AS Nombre_Inspeccion, 
            d.Costo_Inspeccion AS Detalle_Costo, 
            u.Nombre AS Dependencia, 
            insp.Nombre AS Nombre_Inspector, 
            insp.Apellido_Paterno, 
            insp.Apellido_Materno'
        );
        $this->db->from('ma_inspeccion i');
        $this->db->join('rel_ins_mas_detalles d', 'i.ID = d.ID_inspeccion', 'left');
        $this->db->join('cat_unidad_administrativa u', 'i.ID_unidad = u.ID_unidad', 'left');
        $this->db->join('ma_inspectores insp', 'i.ID = insp.ID_inspeccion', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarInspecciones($criterio)
    {
        $this->db->select(
            'i.Nombre AS Nombre_Inspeccion, 
            d.Costo_Inspeccion AS Detalle_Costo, 
            u.Nombre AS Dependencia, 
            insp.Nombre AS Nombre_Inspector, 
            insp.Apellido_Paterno, 
            insp.Apellido_Materno'
        );
        $this->db->from('ma_inspeccion i');
        $this->db->join('rel_ins_mas_detalles d', 'i.ID = d.ID_inspeccion', 'left');
        $this->db->join('cat_unidad_administrativa u', 'i.ID_unidad = u.ID_unidad', 'left');
        $this->db->join('ma_inspectores insp', 'i.ID = insp.ID_inspeccion', 'left');
        $this->db->like('i.Nombre', $criterio);
        $query = $this->db->get();
        return $query->result();
    }
}
