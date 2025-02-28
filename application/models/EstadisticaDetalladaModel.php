<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadisticaDetalladaModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_inspecciones() {
        $this->db->select('Homoclave, Nombre_Inspeccion, Inspecciones_Sancionadas');
        $query = $this->db->get('inspeccion_detallada');
        return $query->result_array();
    }
}
