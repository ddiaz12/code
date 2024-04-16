<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsuarioModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getUsuarios($id){
        if($id != null) {
            $this->db->select('ma_usuario.*, cat_rol.Roles');
            $this->db->from('ma_usuario');
            $this->db->join('cat_rol', 'ma_usuario.ID_rol = cat_rol.ID_rol');
            $this->db->where('ma_usuario.ID_Usuario', $id);
            $query = $this->db->get();
            return $query->row(); // Devuelve un solo objeto
        }else{
            $this->db->select('ma_usuario.*, cat_rol.Roles');
            $this->db->from('ma_usuario');
            $this->db->join('cat_rol', 'ma_usuario.ID_rol = cat_rol.ID_rol');
            $query = $this->db->get();
            return $query->result(); // Devuelve un array de objetos
        }
    }
    
    public function insertar($data) {
        // Inserta los datos en la tabla de usuarios
        $this->db->insert('ma_usuario', $data);
    }

    public function getRoles() {
        $query = $this->db->get('cat_rol');
        return $query->result();
    }
    
    public function eliminar($id) {
        $this->db->where('ID_Usuario', $id);
        $this->db->delete('ma_usuario');
    }

    public function actualizar($id, $data) {
        $this->db->where('ID_Usuario', $id);
        $this->db->update('ma_usuario', $data);
    }


}
