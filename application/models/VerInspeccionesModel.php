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
        $this->db->select('inspeccion_detallada.Nombre_Inspeccion, inspeccion_detallada.Detalle_Costo, inspectores.Dependencia, inspectores.Nombre, inspectores.Apellido_Paterno, inspectores.Apellido_Materno');
        $this->db->from('inspeccion_detallada');
        $this->db->join('inspectores', 'inspeccion_detallada.id_inspeccion = inspectores.Inspector_ID');
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarInspecciones($criterio)
    {
        $this->db->select('inspeccion_detallada.Nombre_Inspeccion, inspeccion_detallada.Detalle_Costo, inspectores.Dependencia, inspectores.Nombre, inspectores.Apellido_Paterno, inspectores.Apellido_Materno');
        $this->db->from('inspeccion_detallada');
        $this->db->join('inspectores', 'inspeccion_detallada.id_inspeccion = inspectores.Inspector_ID');
        $this->db->like('inspeccion_detallada.Nombre_Inspeccion', $criterio);
        $query = $this->db->get();
        return $query->result();
    }
}