<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Cargar la base de datos
    }

    // Obtener todas las inspecciones
    public function get_all_inspecciones() {
        $this->db->select('id_inspeccion, Homoclave, Nombre_Inspeccion, Modalidad, Sujeto_Obligado_ID, Tipo_Inspeccion, Realizada_En as Unidad_Administrativa, Fundamento_Juridico as Estatus, Periodicidad as Vigencia');
        $query = $this->db->get('inspeccion_detallada');
        return $query->result_array(); // Retorna un array con todas las inspecciones
    }

    // Alias para get_all_inspecciones()
    public function get_all_visitas() {
        return $this->get_all_inspecciones(); // Llama al método existente
    }

    // Obtener una inspección por su ID
    public function get_inspeccion_by_id($id_inspeccion) {
        $query = $this->db->get_where('inspeccion_detallada', array('id_inspeccion' => $id_inspeccion));
        return $query->row_array(); // Retorna un array con los datos de la inspección
    }

    // Agregar una nueva inspección
    public function add_inspeccion($data) {
        return $this->db->insert('inspeccion_detallada', $data); // Inserta los datos en la tabla
    }

    // Actualizar una inspección existente
    public function update_inspeccion($id_inspeccion, $data) {
        $this->db->where('id_inspeccion', $id_inspeccion);
        return $this->db->update('inspeccion_detallada', $data); // Actualiza los datos de la inspección
    }

    // Eliminar una inspección
    public function delete_inspeccion($id_inspeccion) {
        $this->db->where('id_inspeccion', $id_inspeccion);
        return $this->db->delete('inspeccion_detallada'); // Elimina la inspección
    }
}
?>