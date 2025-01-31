<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgregarInspectorModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        /**
         * Load the database to ensure database operations can be performed.
         * This is necessary for interacting with the 'inspectores' table.
         */
        $this->load->database(); // Asegúrate de cargar la base de datos
    }

    public function guardarInspector($data)
    {
        // Inserta un nuevo registro en la tabla 'inspectores'
        return $this->db->insert('inspectores', $data);
    }

    public function getInspectores()
    {
        // Retorna la lista de inspectores
        $query = $this->db->get('inspectores');
        return $query->result();
    }

    // Agrega más métodos si necesitas editar, eliminar, etc.
}
