<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step3_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Guarda o actualiza la información del Step 3
    public function guardar_informacion($id_inspeccion, $data) {
        // Agregar la llave foránea
        $data['ID_inspeccion'] = $id_inspeccion;
        // Eliminar registro previo (si existe)
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_informacion');
        // Insertar nuevos datos
        return $this->db->insert('rel_ins_informacion', $data);
    }
}
