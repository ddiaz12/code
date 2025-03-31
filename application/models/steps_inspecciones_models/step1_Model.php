<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class step1_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Guarda los datos de identificación del Step 1
    public function guardarDatosIdentificacion($id_inspeccion, $datos) {
        // Añadir el id de inspección al arreglo
        $datos['ID_inspeccion'] = $id_inspeccion;
        // Eliminar registros previos (si se desea un único registro)
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_datos_identificacion');
        // Insertar el nuevo registro
        return $this->db->insert('rel_ins_datos_identificacion', $datos);
    }

    // Nuevo: Guarda los fundamentos jurídicos del Step 1
    public function guardarFundamentosJuridicos($id_inspeccion, $fundamentos) {
        // Elimina los fundamentos existentes para la inspección
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_fundamento_juridico');

        // Inserta cada fundamento enviado
        foreach ($fundamentos as $fund) {
            $data = [
                'ID_inspeccion'        => $id_inspeccion,
                'ID_tOrdJur'           => isset($fund['ID_tOrdJur']) ? $fund['ID_tOrdJur'] : null,
                'Nombre_Ordenamiento'  => isset($fund['Nombre_Ordenamiento']) ? $fund['Nombre_Ordenamiento'] : '',
                'Articulo'             => isset($fund['Articulo']) ? $fund['Articulo'] : null,
                'Fraccion'             => isset($fund['Fraccion']) ? $fund['Fraccion'] : null,
                'Inciso'               => isset($fund['Inciso']) ? $fund['Inciso'] : null,
                'Parrafo'              => isset($fund['Parrafo']) ? $fund['Parrafo'] : null,
                'Numero'               => isset($fund['Numero']) ? $fund['Numero'] : null,
                'Letra'                => isset($fund['Letra']) ? $fund['Letra'] : null,
                'Otro'                 => isset($fund['Otro']) ? $fund['Otro'] : null
            ];
            $this->db->insert('rel_ins_fundamento_juridico', $data);
        }
    }
}
