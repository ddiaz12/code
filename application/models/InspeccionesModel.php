<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InspeccionesModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Obtener todas las inspecciones
    public function get_inspecciones() {
        $this->db->select('*');
        $query = $this->db->get('ma_inspeccion'); // Nombre de la tabla en la base de datos
        return $query->result_array();
    }

    // Obtener una inspección por su ID
    public function get_inspeccion_by_id($id) {
        $this->db->where('id_inspeccion', $id);
        $query = $this->db->get('ma_inspeccion');
        return $query->row_array();
    }

    // Insertar una nueva inspección
    public function insert_inspeccion($data) {
        return $this->db->insert('ma_inspeccion', $data);
    }

    // Actualizar una inspección existente
    public function update_inspeccion($id, $data) {
        $this->db->where('id_inspeccion', $id);
        return $this->db->update('ma_inspeccion', $data);
    }

    // Eliminar una inspección
    public function delete_inspeccion($id) {
        $this->db->where('id_inspeccion', $id);
        return $this->db->delete('ma_inspeccion');
    }
    
    // Obtener sujetos obligados para la vista
    public function get_sujetos_obligados() {
        // Cambiar el nombre de la tabla a "cat_sujeto_obligado"
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }
    
    // Obtener tipos de ordenamiento para la vista usando la tabla catalogo
    public function get_tipo_ord_jur() {
        $query = $this->db->get('cat_tipo_ord_jur');
        return $query->result();
    }

    // Guardar fundamentos jurídicos
    public function guardar_fundamentos_juridicos($id_inspeccion, $fundamentos) {
        // Eliminar fundamentos existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('fundamentos_juridicos');

        // Insertar nuevos fundamentos
        foreach ($fundamentos as $fundamento) {
            $fundamento['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('fundamentos_juridicos', $fundamento);
        }
    }

    // Guardar oficinas seleccionadas
    public function guardar_oficinas($id_inspeccion, $oficinas) {
        // Eliminar oficinas existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('oficinas_seleccionadas');

        // Insertar nuevas oficinas
        foreach ($oficinas as $oficina) {
            $oficina['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('oficinas_seleccionadas', $oficina);
        }
    }

    // Guardar sujetos obligados seleccionados
    public function guardar_sujetos_obligados($id_inspeccion, $sujetos) {
        // Eliminar sujetos obligados existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('sujetos_obligados_seleccionados');

        // Insertar nuevos sujetos obligados
        foreach ($sujetos as $sujeto) {
            $sujeto['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('sujetos_obligados_seleccionados', $sujeto);
        }
    }

    // Guardar derechos del sujeto regulado
    public function guardar_derechos($id_inspeccion, $derechos) {
        // Eliminar derechos existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('derechos_sujeto_regulado');

        // Insertar nuevos derechos
        foreach ($derechos as $derecho) {
            $derecho['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('derechos_sujeto_regulado', $derecho);
        }
    }

    // Guardar obligaciones del sujeto regulado
    public function guardar_obligaciones($id_inspeccion, $obligaciones) {
        // Eliminar obligaciones existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('obligaciones_sujeto_regulado');

        // Insertar nuevas obligaciones
        foreach ($obligaciones as $obligacion) {
            $obligacion['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('obligaciones_sujeto_regulado', $obligacion);
        }
    }

    // Guardar facultades del sujeto obligado
    public function guardar_facultades($id_inspeccion, $facultades) {
        // Eliminar facultades existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('facultades_sujeto_obligado');

        // Insertar nuevas facultades
        foreach ($facultades as $facultad) {
            $facultad['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('facultades_sujeto_obligado', $facultad);
        }
    }

    // Obtener todos los tipos de inspección
    public function get_tipos_inspeccion() {
        $this->db->select('ID, Tipo');
        $query = $this->db->get('cat_ins_tipo_inspeccion');
        return $query->result();
    }

    // Obtener destinatarios para la vista
    public function get_destinatarios() {
        $query = $this->db->get('cat_ins_destinatario');
        return $query->result();
    }

    // Obtener caracteres de inspección para la vista
    public function get_caracteres_inspeccion() {
        $query = $this->db->get('cat_ins_inspeccion_es');
        return $query->result();
    }

    // Obtener lugares de realización para la vista
    public function get_lugares_realizacion() {
        $query = $this->db->get('cat_ins_lugar_realizacion');
        return $query->result();
    }

    // Obtener periodicidades para la vista
    public function get_periodicidades() {
        $query = $this->db->get('cat_ins_periodicidad');
        return $query->result();
    }

    // Obtener motivos de inspección para la vista
    public function get_motivos_inspeccion() {
        $query = $this->db->get('cat_ins_motivo_inspeccion');
        return $query->result();
    }

    // Obtener secciones no públicas para la vista
    public function get_cat_ins_secciones_no_publicas() {
        $query = $this->db->get('cat_ins_secciones_no_publicas');
        return $query->result();
    }

    // Unidades Administrativas. Obtener todas las unidades administrativas
    public function getUnidadesAdministrativas() {
        $this->db->select('ID_unidad, nombre'); // Asegúrate de seleccionar las columnas correctas
        $query = $this->db->get('cat_unidad_administrativa'); // Nombre exacto de la tabla
        return $query->result();
    }

    // Método para buscar oficinas
    public function buscarOficina($search_term) {
        $this->db->like('nombre', $search_term);
        $query = $this->db->get('cat_unidad_administrativa');
        return $query->result();
    }

    // Obtener sanciones del catálogo
    public function get_sanciones() {
        $query = $this->db->get('cat_ins_sanciones');
        return $query->result();
    }

    // Obtener tipos de tiempo del catálogo
    public function get_tipos_tiempo() {
        $query = $this->db->get('cat_ins_tiempo_tipo');
        return $query->result();
    }

}