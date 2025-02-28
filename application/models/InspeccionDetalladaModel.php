<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InspeccionDetalladaModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_inspecciones() {
        $this->db->select('Homoclave, Nombre_Inspeccion, Inspecciones_Sancionadas, Enero_Inspecciones, Febrero_Inspecciones, Marzo_Inspecciones, Abril_Inspecciones, Mayo_Inspecciones, Junio_Inspecciones, Julio_Inspecciones, Agosto_Inspecciones, Septiembre_Inspecciones, Octubre_Inspecciones, Noviembre_Inspecciones, Diciembre_Inspecciones');
        $query = $this->db->get('inspeccion_detallada');
        return $query->result_array();
    }
}
