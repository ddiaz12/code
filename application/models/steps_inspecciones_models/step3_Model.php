<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step3_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Inserta o reemplaza la info principal en rel_ins_informacion
     *
     * @param int   $id_inspeccion
     * @param array $data  Claves: Elemento_Inspeccionado, Otros_Sujetos_Obligados, Formato_Firma, Formato_Archivo
     * @return bool
     */
    public function guardar_informacion($id_inspeccion, $data) {
        $insert = [
            'ID_inspeccion'          => $id_inspeccion,
            'Elemento_Inspeccionado' => $data['Elemento_Inspeccionado']    ?? '',
            'Otros_Sujetos_Obligados'=> $data['Otros_Sujetos_Obligados']   ?? 'No',
            'Formato_Firma'          => $data['Formato_Firma']             ?? 'No',
            'Formato_Archivo'        => $data['Formato_Archivo']           ?? null,
        ];

        // Borra la fila previa
        $this->db->where('ID_inspeccion', $id_inspeccion)
                 ->delete('rel_ins_informacion');

        // Inserta la nueva
        return $this->db->insert('rel_ins_informacion', $insert);
    }

    /**
     * Inserta array de derechos en rel_ins_info_derechos
     *
     * @param int   $id_inspeccion
     * @param array $derechos  Cada item con claves texto, ID_tOrdJur, TipoOrdenamiento, Articulo, Fraccion, Inciso, Parrafo, Numero, Letra, Otros
     */
    public function guardar_info_derechos($id_inspeccion, array $derechos) {
        // Borra viejos
        $this->db->where('ID_inspeccion', $id_inspeccion)
                 ->delete('rel_ins_info_derechos');

        // Inserta cada uno
        foreach ($derechos as $d) {
            $this->db->insert('rel_ins_info_derechos', [
                'ID_inspeccion'       => $id_inspeccion,
                'ID_tOrdJur'          => $d['ID_tOrdJur']           ?? null,
                'Derecho'             => $d['texto']                ?? '',
                'Nombre_Ordenamiento' => $d['TipoOrdenamiento']     ?? '',
                'Articulo'            => $d['Articulo']             ?? '',
                'Fraccion'            => $d['Fraccion']             ?? '',
                'Inciso'              => $d['Inciso']               ?? '',
                'Parrafo'             => $d['Parrafo']              ?? '',
                'Numero'              => $d['Numero']               ?? null,
                'Letra'               => $d['Letra']                ?? '',
                'Otro'                => $d['Otros']                ?? ''
            ]);
        }
    }

    /**
     * Inserta array de obligaciones en rel_ins_info_obligaciones
     *
     * @param int   $id_inspeccion
     * @param array $obligaciones  Cada item con claves obligacion, ID_tOrdJur, TipoOrdenamiento, Articulo, Fraccion, Inciso, Parrafo, Numero, Letra, Otros
     */
    public function guardar_info_obligaciones($id_inspeccion, array $obligaciones) {
        // Borra viejos
        $this->db->where('ID_inspeccion', $id_inspeccion)
                 ->delete('rel_ins_info_obligaciones');

        // Inserta cada uno
        foreach ($obligaciones as $o) {
            $this->db->insert('rel_ins_info_obligaciones', [
                'ID_inspeccion'       => $id_inspeccion,
                'ID_tOrdJur'          => $o['ID_tOrdJur']           ?? null,
                'Obligacion'          => $o['obligacion']           ?? '',
                'Nombre_Ordenamiento' => $o['TipoOrdenamiento']     ?? '',
                'Articulo'            => $o['Articulo']             ?? '',
                'Fraccion'            => $o['Fraccion']             ?? '',
                'Inciso'              => $o['Inciso']               ?? '',
                'Parrafo'             => $o['Parrafo']              ?? '',
                'Numero'              => $o['Numero']               ?? null,
                'Letra'               => $o['Letra']                ?? '',
                'Otro'                => $o['Otros']                ?? ''
            ]);
        }
    }
}
