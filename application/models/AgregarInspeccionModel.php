<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgregarInspeccionModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Cargar la base de datos
    }

    // Inserta una nueva inspección en la tabla inspeccion_detallada
    public function guardarInspeccion($data) {
        return $this->db->insert('inspeccion_detallada', $data);
    }

    // Método para actualizar una inspección existente
    public function update_inspeccion($id_inspeccion, $data) {
        $this->db->where('id_inspeccion', $id_inspeccion);
        return $this->db->update('inspeccion_detallada', $data);
    }

    // Método para obtener la lista de sujetos obligados
    public function getSujetosObligados()
    {
        $this->db->where('nombre_sujeto !=', 'No especificado');
        $this->db->where('status !=', 0);
        
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }

}
