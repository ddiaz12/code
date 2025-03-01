<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotificacionesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getNotifications($userId)
    {
        $this->db->select('notificaciones.*');
        $this->db->from('notificaciones');
        $this->db->where('notificaciones.id_usuario', $userId);
        $query = $this->db->get();
        return $query->result();
    }

    public function getNotificationsGrupos($GroupName){
        $this->db->select('notificaciones.*');
        $this->db->from('notificaciones');
        $this->db->like('notificaciones.usuario_destino', $GroupName);
        $query = $this->db->get();
        return $query->result();
    }

    public function crearNotificacion($data)
    {
        $this->db->insert('notificaciones', $data);
    }

    public function getNotificacionPorRegulacion($id_regulacion)
    {
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get('notificaciones');
        return $query->row();
    }

    public function marcarComoLeido($id_notificacion)
    {
        $this->db->set('leido', 1);
        $this->db->where('id_notificacion', $id_notificacion);
        return $this->db->update('notificaciones');
    }

    public function countUnreadNotificationsgroups($rol)
    {
        $this->db->where('leido', 0);
        $this->db->like('usuario_destino', $rol);
        return $this->db->count_all_results('notificaciones');
    }

    public function countUnreadNotificationsId($id){
        $this->db->where('leido', 0);
        $this->db->where('id_usuario', $id);
        return $this->db->count_all_results('notificaciones');
    }

    public function eliminarNotificacion($id_notificacion)
    {
        $this->db->where('id_notificacion', $id_notificacion);
        return $this->db->delete('notificaciones');
    }

}