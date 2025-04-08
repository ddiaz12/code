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

    // Nuevo método para guardar derechos del Step 3
    public function guardar_info_derechos($id_inspeccion, $derechos) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_info_derechos');
        foreach ($derechos as $derecho) {
            $data = [
                'ID_inspeccion'        => $id_inspeccion,
                'Derecho'              => $derecho['texto'], // Campo del texto del derecho
                'ID_tOrdJur'           => $derecho['ID_tOrdJur'],
                'Nombre_Ordenamiento'  => $derecho['TipoOrdenamiento']
                // Agregar más campos si es necesario.
            ];
            $this->db->insert('rel_ins_info_derechos', $data);
        }
    }
}
