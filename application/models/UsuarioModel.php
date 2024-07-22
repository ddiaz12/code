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
            $this->db->select('ma_usuario.*, cat_rol.Roles, cat_tipo_sujeto_obligado.tipo_sujeto, cat_sujeto_obligado.nombre_sujeto, cat_unidad_administrativa.nombre');
            $this->db->from('ma_usuario');
            $this->db->join('cat_rol', 'ma_usuario.ID_rol = cat_rol.ID_rol');
            $this->db->join('cat_sujeto_obligado', 'ma_usuario.ID_sujeto = cat_sujeto_obligado.ID_sujeto');
            $this->db->join('cat_tipo_sujeto_obligado', 'cat_sujeto_obligado.ID_tipoSujeto = cat_tipo_sujeto_obligado.ID_tipoSujeto');
            $this->db->join('cat_unidad_administrativa', 'ma_usuario.ID_unidad = cat_unidad_administrativa.ID_unidad');
            $this->db->where('ma_usuario.ID_Usuario', $id);
            $query = $this->db->get();
            return $query->row(); // Devuelve un solo objeto
        } else {
            $this->db->select('ma_usuario.*, cat_rol.Roles, cat_tipo_sujeto_obligado.tipo_sujeto, cat_sujeto_obligado.nombre_sujeto, cat_unidad_administrativa.nombre');
            $this->db->from('ma_usuario');
            $this->db->join('cat_rol', 'ma_usuario.ID_rol = cat_rol.ID_rol');
            $this->db->join('cat_sujeto_obligado', 'ma_usuario.ID_sujeto = cat_sujeto_obligado.ID_sujeto');
            $this->db->join('cat_tipo_sujeto_obligado', 'cat_sujeto_obligado.ID_tipoSujeto = cat_tipo_sujeto_obligado.ID_tipoSujeto');
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
        $this->db->where('nombre_sujeto !=', 'No especificado');
        $this->db->where('status !=', 0);
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }

    public function getTipoSujetoObligado()
    {
        $this->db->where('tipo_sujeto !=', 'No especificado');
        $query = $this->db->get('cat_tipo_sujeto_obligado');
        return $query->result();
    }

    public function getPorUsuario($user)
    {
        $this->db->select('users.*, cat_sujeto_obligado.nombre_sujeto, cat_unidad_administrativa.nombre');
        $this->db->from('users');
        $this->db->join('cat_sujeto_obligado', 'users.id_sujeto = cat_sujeto_obligado.ID_sujeto');
        $this->db->join('cat_unidad_administrativa', 'users.id_unidad = cat_unidad_administrativa.ID_unidad');
        $this->db->where('users.id', $user);
        $query = $this->db->get();
        return $query->row();
    }

    public function getUnidadesAdministrativas()
    {
        $this->db->where('nombre !=', 'No especificado');
        $this->db->where('status', 1);
        $query = $this->db->get('cat_unidad_administrativa');
        return $query->result();
    }

    //Trea las unidades administrativas que estan escondidas en el formulario de la solicitud
    public function getUnidadesAdministrativasSolicitud()
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
