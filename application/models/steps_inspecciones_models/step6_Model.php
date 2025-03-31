<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step6_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Actualiza las estadísticas usando el procedimiento almacenado
    public function actualizar_estadisticas($id_inspeccion, $ID_dependencia, $datos) {
        // Extraer valores con valor predeterminado 0 si no existen
        $Enero = isset($datos['Enero']) ? (int)$datos['Enero'] : 0;
        $Febrero = isset($datos['Febrero']) ? (int)$datos['Febrero'] : 0;
        $Marzo = isset($datos['Marzo']) ? (int)$datos['Marzo'] : 0;
        $Abril = isset($datos['Abril']) ? (int)$datos['Abril'] : 0;
        $Mayo = isset($datos['Mayo']) ? (int)$datos['Mayo'] : 0;
        $Junio = isset($datos['Junio']) ? (int)$datos['Junio'] : 0;
        $Julio = isset($datos['Julio']) ? (int)$datos['Julio'] : 0;
        $Agosto = isset($datos['Agosto']) ? (int)$datos['Agosto'] : 0;
        $Septiembre = isset($datos['Septiembre']) ? (int)$datos['Septiembre'] : 0;
        $Octubre = isset($datos['Octubre']) ? (int)$datos['Octubre'] : 0;
        $Noviembre = isset($datos['Noviembre']) ? (int)$datos['Noviembre'] : 0;
        $Diciembre = isset($datos['Diciembre']) ? (int)$datos['Diciembre'] : 0;
        $Inspecciones_Sancionadas = isset($datos['Inspecciones_Sancionadas']) ? (int)$datos['Inspecciones_Sancionadas'] : 0;

        $params = [
            'p_ID_inspeccion' => $id_inspeccion,
            'p_Enero' => $Enero,
            'p_Febrero' => $Febrero,
            'p_Marzo' => $Marzo,
            'p_Abril' => $Abril,
            'p_Mayo' => $Mayo,
            'p_Junio' => $Junio,
            'p_Julio' => $Julio,
            'p_Agosto' => $Agosto,
            'p_Septiembre' => $Septiembre,
            'p_Octubre' => $Octubre,
            'p_Noviembre' => $Noviembre,
            'p_Diciembre' => $Diciembre,
            'p_Inspecciones_Sancionadas' => $Inspecciones_Sancionadas
        ];

        // Llamada al procedimiento almacenado
        $sql = "CALL actualizar_estadisticas(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->db->query($sql, array_values($params));
    }
}
