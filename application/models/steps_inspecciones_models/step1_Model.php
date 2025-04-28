<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step1_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Guarda los datos de identificación en rel_ins_datos_identificacion.
     */
    public function guardarDatosIdentificacion($id_inspeccion, $datos) {
        // Añado el ID_inspeccion
        $datos['ID_inspeccion'] = $id_inspeccion;

        // Elimino registros previos
        $this->db->where('ID_inspeccion', $id_inspeccion)
                 ->delete('rel_ins_datos_identificacion');

        // Inserto nuevos datos
        if (!empty($datos)) {
            return $this->db->insert('rel_ins_datos_identificacion', $datos);
        }
        return false;
    }

    /**
     * Guarda cada fundamento jurídico en rel_ins_fundamento_juridico.
     */
    public function guardarFundamentosJuridicos($id_inspeccion, $fundamentos) {
        // Elimino los anteriores
        $this->db->where('ID_inspeccion', $id_inspeccion)
                 ->delete('rel_ins_fundamento_juridico');

        // Inserto los nuevos
        foreach ($fundamentos as $f) {
            $fila = [
                'ID_inspeccion'       => $id_inspeccion,
                'ID_tOrdJur'          => $f['ID_tOrdJur']           ?? null,
                'Nombre_Ordenamiento' => $f['Nombre_Ordenamiento']  ?? '',
                'Articulo'            => $f['Articulo']             ?? null,
                'Fraccion'            => $f['Fraccion']             ?? null,
                'Inciso'              => $f['Inciso']               ?? null,
                'Parrafo'             => $f['Parrafo']              ?? null,
                'Numero'              => $f['Numero']               ?? null,
                'Letra'               => $f['Letra']                ?? null,
                'Otro'                => $f['Otro']                 ?? null,
            ];
            $this->db->insert('rel_ins_fundamento_juridico', $fila);
        }
    }
}
