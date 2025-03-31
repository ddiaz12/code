<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step9_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Guarda datos de emergencias en la tabla rel_ins_emergencias
    public function guardar_emergencias($id_inspeccion, $datos) {
        // Procesar archivo si se envía (se guarda en ./uploads/emergencias)
        if (!empty($_FILES['Archivo_Declaracion_Emergencia']['name'])) {
            $config['upload_path']   = './uploads/emergencias';
            $config['allowed_types'] = 'pdf|jpg|png';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('Archivo_Declaracion_Emergencia')) {
                $uploadData = $this->upload->data();
                $datos['Archivo_Declaracion_Emergencia'] = $uploadData['file_name'];
            } else {
                $datos['Archivo_Declaracion_Emergencia'] = null;
            }
        }

        $data = [
            'ID_inspeccion' => $id_inspeccion,
            'Es_Emergencia' => isset($datos['Es_Emergencia']) ? $datos['Es_Emergencia'] : 'No',
            'Justificacion' => isset($datos['Justificacion_Emergencia']) ? $datos['Justificacion_Emergencia'] : ''
        ];
        if (isset($datos['Archivo_Declaracion_Emergencia'])) {
            $data['Acta_Emergencia_Archivo'] = $datos['Archivo_Declaracion_Emergencia'];
        }

        // Eliminar registro previo para este ID_inspeccion y guardar nuevo
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_emergencias');
        return $this->db->insert('rel_ins_emergencias', $data);
    }
}
