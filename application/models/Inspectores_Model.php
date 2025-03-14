<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspectores_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Cargar la base de datos
    }

    // Obtener todos los inspectores de la tabla ma_inspectores
    public function get_all_inspectores() {
        $this->db->select('ID, Homoclave, Nombre, Primer_Apellido, Segundo_Apellido, ID_Sujeto, ID_Unidad, Estatus, ID_Tipo, Vigencia');
        $query = $this->db->get('ma_inspectores');
        return $query->result(); // Retorna un array de objetos
    }

    // Método para agregar un nuevo inspector
    public function agregarInspector($data) {
        return $this->db->insert('ma_inspectores', $data);
    }

    // Método para obtener un inspector por su ID
    public function obtenerInspectorPorId($id) {
        $query = $this->db->get_where('inspectores', array('Inspector_ID' => $id));
        return $query->row();
    }

    // Método para actualizar un inspector existente
    public function update_inspector($id_inspector, $data) {
        $this->db->where('Inspector_ID', $id_inspector);
        return $this->db->update('inspectores', $data);
    }

    // Método para obtener los tipos de nombramiento
    public function get_tipos_nombramiento() {
        $this->db->select('ID, Nombre');
        $query = $this->db->get('cat_inspectores_tipo');
        return $query->result();
    }
}
?>