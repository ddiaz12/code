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
        $this->db->where('publicada', 1);
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
        return $query->row_array();
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

    public function get_sectors($search_term) {
        $this->db->like('Nombre_Sector', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('cat_sector');
        return $query->result_array();
    }

    public function get_subsectors($search_term) {
        $this->db->like('Nombre_Subsector', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('cat_subsector');
        return $query->result_array();
    }

    public function get_ramas($search_term) {
        $this->db->like('Nombre_Rama', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('cat_rama');
        return $query->result_array();
    }

    public function get_subramas($search_term) {
        $this->db->like('Nombre_Subrama', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('cat_subrama');
        return $query->result_array();
    }

    public function get_clases($search_term) {
        $this->db->like('Nombre_Clase', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('cat_clase');
        return $query->result_array();
    }

    public function get_regulaciones2($search_term) {
        $this->db->like('Nombre_Regulacion', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('ma_regulacion');
        return $query->result_array();
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

    public function get_max_id_nat() {
        $this->db->select_max('ID_Nat');
        $query = $this->db->get('de_naturaleza_regulacion');
        $result = $query->row_array();
        return $result['ID_Nat'];
    }

    public function insert_naturaleza_regulacion($data) {
        $this->db->insert('de_naturaleza_regulacion', $data);
    }

    public function insert_derivada_reg($data) {
        $this->db->insert('derivada_reg', $data);
    }

    public function get_max_id_rel_nat() {
        $this->db->select_max('ID_relNaturaleza');
        $query = $this->db->get('rel_nat_reg');
        $result = $query->row_array();
        
        // Validar si no existe ninguna inserción
        if (empty($result['ID_relNaturaleza'])) {
            return 0; // Valor predeterminado si no hay registros
        }
        
        return $result['ID_relNaturaleza'];
    }

    public function get_last_id_regulacion() {
        $this->db->select_max('ID_Regulacion');
        $query = $this->db->get('ma_regulacion');
        $result = $query->row_array();
        return $result['ID_Regulacion'];
    }

    public function insert_rel_nat_reg($data) {
        $this->db->insert('rel_nat_reg', $data);
    }

    public function get_all_regulaciones() {
        $query = $this->db->get('ma_regulacion');
        return $query->result();
    }

    public function enviar_regulacion($id_regulacion, $Estatus){
        $this->db->where('ID_Regulacion', $id_regulacion);
        $this->db->update('ma_regulacion', array('Estatus' => $Estatus));
    }

    public function devolver_regulacion($id_regulacion){
        $this->db->where('ID_Regulacion', $id_regulacion);
        $this->db->update('ma_regulacion', array('Estatus' => 0));
    }

    public function actualizar_estatus($id) {
        $this->db->set('Estatus', 0);
        $this->db->where('ID_Regulacion', $id);
        $this->db->update('ma_regulacion');
    }

    public function get_regulacion_by_id($id) {
        $this->db->where('ID_Regulacion', $id);
        $query = $this->db->get('ma_regulacion');
        return $query->row_array();
    }

    public function get_caracteristicas_by_id($id_regulacion) {
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get('de_regulacion_caracteristicas');
        return $query->row_array();
    }

    public function get_tipo_ordenamiento_by_id($id) {
        $this->db->where('ID_tOrdJur', $id);
        $query = $this->db->get('cat_tipo_ord_jur');
        return $query->row_array();
    }

    public function get_emiten_by_caract($id_caract) {
        $this->db->where('ID_caract', $id_caract);
        $query = $this->db->get('rel_autoridades_emiten');
        return $query->result_array();
    }

    public function get_aplican_by_caract($id_caract) {
        $this->db->where('ID_caract', $id_caract);
        $query = $this->db->get('rel_autoridades_aplican');
        return $query->result_array();
    }

    public function get_dependencias_by_emiten($emiten_ids) {
        if (is_array($emiten_ids)) {
            $this->db->where_in('ID_Dependencia', $emiten_ids);
        } else {
            $this->db->where('ID_Dependencia', $emiten_ids);
        }
        $query = $this->db->get('cat_tipo_dependencia');
        return $query->result_array();
    }

    public function get_dependencias_by_aplican($aplican_ids) {
        if (is_array($aplican_ids)) {
            $this->db->where_in('ID_Dependencia', $aplican_ids);
        } else {
            $this->db->where('ID_Dependencia', $aplican_ids);
        }
        $query = $this->db->get('cat_tipo_dependencia');
        return $query->result_array();
    }

    public function get_indices_by_caract($id_caract) {
        $this->db->where('ID_caract', $id_caract);
        $query = $this->db->get('de_indice');
        return $query->result_array();
    }

    public function get_rel_by_indice($indice_ids) {
        if (is_array($indice_ids)) {
            $this->db->where_in('ID_Indice', $indice_ids);
        } else {
            $this->db->where('ID_Indice', $indice_ids);
        }
        $query = $this->db->get('rel_indice');
        return $query->result_array();
    }

    public function get_materias_by_regulacion($id_regulacion) {
        $this->db->select('cat_regulacion_materias_gub.Nombre_Materia');
        $this->db->from('rel_regulaciones_materias');
        $this->db->join('cat_regulacion_materias_gub', 'rel_regulaciones_materias.ID_Materia = cat_regulacion_materias_gub.ID_Materia');
        $this->db->where('rel_regulaciones_materias.ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function has_materias($id_regulacion) {
        $this->db->from('rel_regulaciones_materias');
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->count_all_results() > 0;
    }

    public function obtenerCaracteristicasRegulacion($id) {
        $this->db->select('de_regulacion_caracteristicas.*, cat_tipo_ord_jur.Tipo_Ordenamiento');
        $this->db->from('de_regulacion_caracteristicas');
        $this->db->join('cat_tipo_ord_jur', 'de_regulacion_caracteristicas.ID_tOrdJur = cat_tipo_ord_jur.ID_tOrdJur');
        $this->db->where('de_regulacion_caracteristicas.ID_Regulacion', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function obtenerEnlaceOficial($id) {
        $this->db->select('Enlace_Oficial');
        $this->db->from('de_naturaleza_regulacion');
        $this->db->join('rel_nat_reg', 'de_naturaleza_regulacion.ID_Nat = rel_nat_reg.ID_Nat');
        $this->db->where('rel_nat_reg.ID_Regulacion', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function obtenerIndicePorRegulacion($idRegulacion) {
        $this->db->select('Texto, Orden');
        $this->db->from('de_indice');
        $this->db->join('de_regulacion_caracteristicas', 'de_indice.ID_caract = de_regulacion_caracteristicas.ID_caract');
        $this->db->where('de_regulacion_caracteristicas.ID_Regulacion', $idRegulacion);
        $this->db->order_by('Orden', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function obtenerAutoridadesPorRegulacion($idRegulacion) {
        $this->db->select('aplican_dep.Tipo_Dependencia as Autoridad_Aplican, emiten_dep.Tipo_Dependencia as Autoridad_Emiten');
        $this->db->from('rel_autoridades_aplican as aplican');
        $this->db->join('cat_tipo_dependencia as aplican_dep', 'aplican.ID_Aplican = aplican_dep.ID_Dependencia');
        $this->db->join('rel_autoridades_emiten as emiten', 'aplican.ID_caract = emiten.ID_caract');
        $this->db->join('cat_tipo_dependencia as emiten_dep', 'emiten.ID_Emiten = emiten_dep.ID_Dependencia');
        $this->db->where('aplican.ID_caract', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtenerMateriasExentas($idRegulacion) {
        $this->db->select('materias.Nombre_Materia as Materia');
        $this->db->from('rel_regulaciones_materias');
        $this->db->join('cat_regulacion_materias_gub as materias', 'rel_regulaciones_materias.ID_Materias = materias.ID_Materia');
        $this->db->where('rel_regulaciones_materias.ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtenerRegulacionesVinculadas($idRegulacion) {
        $this->db->select('regulacion.Nombre_Regulacion');
        $this->db->from('derivada_reg');
        $this->db->join('ma_regulacion as regulacion', 'derivada_reg.ID_Nat = regulacion.ID_Regulacion');
        $this->db->where('derivada_reg.ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtenerSectoresPorRegulacion($idRegulacion) {
        $this->db->select('sector.Nombre as Sector');
        $this->db->from('rel_nat_reg');
        $this->db->join('sectores as sector', 'rel_nat_reg.ID_sector = sector.ID_sector');
        $this->db->where('rel_nat_reg.ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertar_rel_usuario_regulacion($idUsuario, $idRegulacion) {
        $data = array(
            'id' => $idUsuario,
            'ID_Regulacion' => $idRegulacion
        );
        $this->db->insert('rel_usuario_regulacion', $data);
    }

    public function registrarMovimiento($data){
        $this->db->insert('trazabilidad', $data);
    }

    public function obtenerTrazabilidadPorRegulacion($idRegulacion) {
        $this->db->select ('*');
        $this->db->from('trazabilidad');
        $this->db->where('ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function publicar_regulacion($id_regulacion) {
        $this->db->where('ID_Regulacion', $id_regulacion);
        $this->db->update('ma_regulacion', array('Estatus' => 4, 'publicada' => 1));
    }

    public function despublicar_regulacion($id_regulacion) {
        $this->db->where('ID_Regulacion', $id_regulacion);
        $this->db->update('ma_regulacion', array('Estatus' => 2, 'publicada' => 0));
    }
    

    public function get_regulaciones_por_usuario($id_usuario) {
        $this->db->where('id_usuario_creador', $id_usuario);
        $query = $this->db->get('ma_regulacion');
        return $query->result();
    }
}