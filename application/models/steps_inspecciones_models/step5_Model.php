<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step5_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Guarda los datos del step5 en la tabla rel_ins_autoridad_publica
    public function guardar_autoridad_publica($id_inspeccion, $ID_unidad) {
        // Eliminar registros previos para esta inspección
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_autoridad_publica');
        
        $data = [
            'ID_inspeccion' => $id_inspeccion,
            'ID_unidad'     => $ID_unidad
        ];
        return $this->db->insert('rel_ins_autoridad_publica', $data);
    }

    // Nuevo: guardar datos de contacto de la autoridad pública
    public function guardar_autoridad_contacto($id_inspeccion, $contacto) {
        // Eliminar registro previo para esta inspección
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_autoridad_contacto');

        $data = [
            'ID_inspeccion'     => $id_inspeccion,
            'Direccion'         => isset($contacto['Direccion']) ? $contacto['Direccion'] : null,
            'Correo_Electronico'=> isset($contacto['Correo_Electronico']) ? $contacto['Correo_Electronico'] : null
        ];
        return $this->db->insert('rel_ins_autoridad_contacto', $data);
    }

    // Nuevo: guardar datos de impugnación de la autoridad
    public function guardar_autoridad_contacto_impugnacion($id_inspeccion, $impugnacion) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_autoridad_contacto_impugnacion');

        $data = [
            'ID_inspeccion'      => $id_inspeccion,
            'Nombre_Regulacion'  => isset($impugnacion['Nombre_Regulacion']) ? $impugnacion['Nombre_Regulacion'] : '',
            'Articulo'           => isset($impugnacion['Articulo']) ? $impugnacion['Articulo'] : null,
            'Parrafo_Numero_Numeral' => isset($impugnacion['Parrafo_Numero_Numeral']) ? $impugnacion['Parrafo_Numero_Numeral'] : null,
            'URL_Regulacion'     => isset($impugnacion['URL_Regulacion']) ? $impugnacion['URL_Regulacion'] : null
        ];
        return $this->db->insert('rel_ins_autoridad_contacto_impugnacion', $data);
    }

    // Nuevo: guardar teléfonos de la autoridad
    public function guardar_autoridad_contacto_telefonos($id_inspeccion, $telefonos) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_autoridad_contacto_telefonos');

        foreach ($telefonos as $numero) {
            $data = [
                'ID_inspeccion' => $id_inspeccion,
                'Numero_Telefonico' => $numero
            ];
            $this->db->insert('rel_ins_autoridad_contacto_telefonos', $data);
        }
        return true;
    }
}
