<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsuarioModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getUsuarios($id)
    {
        if ($id != null) {
            $this->db->select('ma_usuario.*, cat_rol.Roles, cat_sujeto_obligado.tipo_sujeto, cat_sujeto_obligado.nombre_sujeto, cat_unidad_administrativa.nombre');
            $this->db->from('ma_usuario');
            $this->db->join('cat_rol', 'ma_usuario.ID_rol = cat_rol.ID_rol');
            $this->db->join('cat_sujeto_obligado', 'ma_usuario.ID_sujeto = cat_sujeto_obligado.ID_sujeto');
            $this->db->join('cat_unidad_administrativa', 'ma_usuario.ID_unidad = cat_unidad_administrativa.ID_unidad');
            $this->db->where('ma_usuario.ID_Usuario', $id);
            $query = $this->db->get();
            return $query->row(); // Devuelve un solo objeto
        } else {
            $this->db->select('ma_usuario.*, cat_rol.Roles, cat_sujeto_obligado.tipo_sujeto, cat_sujeto_obligado.nombre_sujeto, cat_unidad_administrativa.nombre');
            $this->db->from('ma_usuario');
            $this->db->join('cat_rol', 'ma_usuario.ID_rol = cat_rol.ID_rol');
            $this->db->join('cat_sujeto_obligado', 'ma_usuario.ID_sujeto = cat_sujeto_obligado.ID_sujeto');
            $this->db->join('cat_unidad_administrativa', 'ma_usuario.ID_unidad = cat_unidad_administrativa.ID_unidad');
            $query = $this->db->get();
            return $query->result(); // Devuelve un array de objetos
        }
    }

    public function getRoles()
    {
        $query = $this->db->get('cat_rol');
        return $query->result();
    }

    public function getSujetosObligados()
    {
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }

    public function getSujetosObligadosPorTipo($tipo_sujeto)
    {
        $this->db->where('ID_sujeto', $tipo_sujeto);
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }

    public function getUnidadesAdministrativas()
    {
        $query = $this->db->get('cat_unidad_administrativa');
        return $query->result();
    }

    public function insertar($data)
    {
        $this->db->insert('ma_usuario', $data);
    }

    public function eliminar($id)
    {
        $this->db->where('ID_Usuario', $id);
        $this->db->delete('ma_usuario');
    }

    public function actualizar($id, $data)
    {
        $this->db->where('ID_Usuario', $id);
        $this->db->update('ma_usuario', $data);
    }


}
