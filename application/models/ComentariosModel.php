<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ComentariosModel extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function insertarComentario($data) {
        $this->db->insert('de_regulacion_usuario_com', $data);
    }

    public function obtenerComentariosPorRegulacion($idRegulacion) {
        $this->db->select('comentario, fecha_creacion, users.email as usuario');
        $this->db->from('de_regulacion_usuario_com');
        $this->db->join('users', 'users.id = de_regulacion_usuario_com.id');
        $this->db->where('ID_Regulacion', $idRegulacion);
        $this->db->order_by('fecha_creacion', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
}