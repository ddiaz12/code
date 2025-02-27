<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadisticasModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        // Cargar la base de datos
        $this->load->database();
    }

    // Método para obtener todas las estadísticas
    public function get_all_estadisticas() {
        $query = $this->db->get('estadisticas'); // Ajusta el nombre de la tabla a tus necesidades
        return $query->result_array();
    }

    // Método para obtener una estadística por su ID
    public function get_estadistica_by_id($id) {
        $query = $this->db->get_where('estadisticas', array('Estadistica_ID' => $id));
        return $query->row_array();
    }

    // Método para insertar una nueva estadística
    public function insert_estadistica($data) {
        $data['ultima_actualizacion'] = date('Y-m-d H:i:s');
        $data['Ficha_ID'] = $data['Ficha_ID'];
        $data['Fecha_Estadistica'] = $data['Fecha_Estadistica'];
        $data['Inspector_ID'] = $data['Inspector_ID'];
        $data['Sujeto_Obligado_ID'] = $data['Sujeto_Obligado_ID'];
        $data['Tipo_Inspeccion'] = $data['Tipo_Inspeccion'];
        $data['Resultado'] = $data['Resultado'];
        return $this->db->insert('estadisticas', $data);
    }

    // Método para actualizar una estadística existente
    public function update_estadistica($id, $data) {
        $data['ultima_actualizacion'] = date('Y-m-d H:i:s');
        $data['Ficha_ID'] = $data['Ficha_ID'];
        $data['Fecha_Estadistica'] = $data['Fecha_Estadistica'];
        $data['Inspector_ID'] = $data['Inspector_ID'];
        $data['Sujeto_Obligado_ID'] = $data['Sujeto_Obligado_ID'];
        $data['Tipo_Inspeccion'] = $data['Tipo_Inspeccion'];
        $data['Resultado'] = $data['Resultado'];
        $this->db->where('Estadistica_ID', $id);
        return $this->db->update('estadisticas', $data);
    }

    // Método para eliminar una estadística
    public function delete_estadistica($id) {
        $this->db->where('Estadistica_ID', $id);
        return $this->db->delete('estadisticas');
    }
}