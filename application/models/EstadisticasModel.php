<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadisticasModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Obtener todas las estadísticas
    public function get_all_estadisticas() {
        // Seleccionar las columnas definidas (ajusta si se requiere alias)
        $this->db->select('ID, ID_inspeccion, ID_dependencia, Inspecciones_Sancionadas, Enero, Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre, Diciembre, Total_Inspecciones, Fecha_Creacion, Fecha_Actualizacion');
        $query = $this->db->get('rel_ins_estadisticas');
        return $query->result_array();
    }

    // Obtener una estadística por su ID
    public function get_estadistica_by_id($id) {
        $this->db->where('ID', $id);
        $query = $this->db->get('rel_ins_estadisticas');
        return $query->row_array();
    }

    // Insertar una nueva estadística
    public function insert_estadistica($data) {
        // Asignar automáticamente las fechas de creación y actualización
        $data['Fecha_Creacion'] = date('Y-m-d H:i:s');
        $data['Fecha_Actualizacion'] = date('Y-m-d H:i:s');
        // Guarda los datos en la tabla rel_ins_estadisticas
        return $this->db->insert('rel_ins_estadisticas', $data);
    }

    // Actualizar una estadística existente
    public function update_estadistica($id, $data) {
        $data['Fecha_Actualizacion'] = date('Y-m-d H:i:s');
        $this->db->where('ID', $id);
        return $this->db->update('rel_ins_estadisticas', $data);
    }

    // Eliminar una estadística
    public function delete_estadistica($id) {
        $this->db->where('ID', $id);
        return $this->db->delete('rel_ins_estadisticas');
    }

    // Obtener la última actualización
    public function get_ultima_actualizacion() {
        $this->db->select_max('Fecha_Actualizacion');
        $query = $this->db->get('rel_ins_estadisticas');
        return $query->row()->Fecha_Actualizacion;
    }
}