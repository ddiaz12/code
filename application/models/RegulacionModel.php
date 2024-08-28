<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegulacionModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database('sedeco');
    }

    public function get_regulaciones()
    {
        $this->db->select('*'); 
        $query = $this->db->get('ma_regulacion');
        return $query->num_rows() > 0 ? $query->result() : [];
    }
    public function contarRegulaciones() {
        return $this->db->count_all('ma_regulacion');
    }
    public function buscarPorNombre($nombre) {
        $this->db->like('Nombre_Regulacion', $nombre);
        $query = $this->db->get('ma_regulacion');
        return $query->result();
    }
    
    // public function getTiposOrdenamiento()
    // {
    //     $this->db->select('Tipo_Ordenamiento');
    //     $query = $this->db->get('cat_tipo_ord_jur');
    //     return $query->result_array();
    // }

    public function getTiposOrdenamiento() {
        $query = $this->db->select('Tipo_Ordenamiento')
                          ->from('cat_tipo_ord_jur')
                          ->get();
        return $query->result_array();
    }

    public function getTiposOrdenamiento2() {
        $query = $this->db->get('cat_tipo_ord_jur');
        return $query->result();
    }

    public function buscarRegulaciones($desdeFecha, $hastaFecha, $dependencia) {
        if (!empty($desdeFecha) && !empty($hastaFecha) && !empty($dependencia)) {
            $this->db->select('Nombre_Regulacion, Objetivo_Reg');
            $this->db->from('ma_regulacion');
            $this->db->join('de_regulacion_caracteristicas', 'ma_regulacion.ID_Regulacion = de_regulacion_caracteristicas.ID_Regulacion', 'inner');
            $this->db->join('cat_tipo_ord_jur', 'de_regulacion_caracteristicas.ID_tOrdJur = cat_tipo_ord_jur.ID_tOrdJur', 'inner');
            $this->db->where('de_regulacion_caracteristicas.Fecha_Exp >=', $desdeFecha);
            $this->db->where('de_regulacion_caracteristicas.Vigencia <=', $hastaFecha);
            $this->db->where('cat_tipo_ord_jur.Tipo_Ordenamiento', $dependencia);
    
            $query = $this->db->get();
            return $query->result_array();
        } else {
            // Considera retornar un valor o manejar el caso donde no todos los parámetros son proporcionados
            return []; // Retorna un arreglo vacío como ejemplo
        }
    }

    public function insertar_caractRegulacion($data)
    {
        $this->db->insert('`de_regulacion_caracteristicas`INNER JOIN rel_autoridades_emiten ON de_regulacion_caracteristicas.ID_caract=rel_autoridades_emiten.ID_caract INNER JOIN rel_autoridades_aplican ON de_regulacion_caracteristicas.ID_caract=rel_autoridades_aplican.ID_caract INNER JOIN de_indice ON de_regulacion_caracteristicas.ID_caract=de_indice.ID_caract INNER JOIN rel_indice ON de_indice.ID_Indice=rel_indice.ID_Indice', $data);
        return $this->db->insert_id();
    }
    public function search_tipo_dependencia($query) {
        $this->db->like('Tipo_Dependencia', $query);
        $this->db->limit(5);
        $query = $this->db->get('cat_tipo_dependencia');
        return $query->result_array();
    }
    public function getIndices() {
        $query = $this->db->get('de_indice');
        return $query->result();
    }
    public function getMaxValues() {
        $this->db->select_max('ID_Indice');
        $this->db->select_max('Orden');
        $query = $this->db->get('de_indice');
        return $query->row_array_array();
    }
    public function getMaxID() {
        $this->db->select_max('ID_Regulacion');
        $query = $this->db->get('ma_regulacion');
        $result = $query->row();
        return $result->ID_Regulacion;
    }
    
    public function obtenerRegulacionPorId($id) {
        $this->db->where('ID_Regulacion', $id);
        $query = $this->db->get('ma_regulacion');
        return $query->row();
    }

    public function insertRegulacion($data) {
        $this->db->insert('ma_regulacion', $data);
    }
    public function obtenerMaxIDCaract() {
        $this->db->select_max('ID_caract');
        $query = $this->db->get('de_regulacion_caracteristicas');
        return $query->row()->ID_caract;
    }

    public function insertarCaracteristicas($data) {
        $this->db->insert('de_regulacion_caracteristicas', $data);
        return $this->db->affected_rows() > 0;
    }

    public function insertarRelAutoridadesEmiten($data) {
        return $this->db->insert('rel_autoridades_emiten', $data);
    }

    public function insertarRelAutoridadesAplican($data) {
        return $this->db->insert('rel_autoridades_aplican', $data);
    }

    public function insertarDatosTabla($data) {
        // Insertar los datos en la tabla 'de_indice'
        $this->db->insert('de_indice', $data);
    }

    public function obtenerMaxIDJerarquia() {
        $this->db->select_max('ID_Jerarquia');
        $query = $this->db->get('rel_indice');
        $result = $query->row();
        return $result->ID_Jerarquia;
    }
    public function verificarIDIndice($ID_Indice) {
        $this->db->where('ID_Indice', $ID_Indice);
        $query = $this->db->get('de_indice');
        return $query->num_rows() > 0;
    }

    public function insertarRelIndice($relIndiceData) {
        return $this->db->insert('rel_indice', $relIndiceData);
    }
    
}