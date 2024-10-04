<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getSujetosObligados()
    {
        //$this->db->select('cat_sujeto_obligado.*');
        //$this->db->from('cat_sujeto_obligado');
        $this->db->where('cat_sujeto_obligado.nombre_sujeto !=', 'No especificado');
        $this->db->where('cat_sujeto_obligado.status !=', 0);
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }

    public function getSujeto($id)
    {
        $this->db->select('cat_sujeto_obligado.*');
        $this->db->from('cat_sujeto_obligado');
        $this->db->where('cat_sujeto_obligado.ID_sujeto', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getUnidadesAdministrativas()
    {
        $this->db->select('cat_unidad_administrativa.*, cat_sujeto_obligado.nombre_sujeto');
        $this->db->from('cat_unidad_administrativa');
        $this->db->join('cat_sujeto_obligado', 'cat_sujeto_obligado.ID_sujeto = cat_unidad_administrativa.ID_sujeto');
        $this->db->where('cat_unidad_administrativa.status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCatVialidades()
    {
        $query = $this->db->get('cat_vialidades');
        return $query->result();
    }

    public function getCatMunicipios()
    {
        $query = $this->db->get('cat_municipios');
        return $query->result();
    }

    public function getCatLocalidades()
    {
        $query = $this->db->get('cat_localidades');
        return $query->result();
    }
    public function getCatAsentamientos()
    {
        $query = $this->db->get('cat_nombre_asentamiento');
        return $query->result();
    }

    public function getUnidad($id)
    {
        $this->db->select('cat_unidad_administrativa.*, cat_sujeto_obligado.nombre_sujeto, 
                            cat_localidades.clave, cat_nombre_asentamiento.CP');
        $this->db->from('cat_unidad_administrativa');
        $this->db->join('cat_sujeto_obligado', 'cat_sujeto_obligado.ID_sujeto = cat_unidad_administrativa.ID_sujeto');
        $this->db->join('cat_localidades', 'cat_localidades.ID_localidad = cat_unidad_administrativa.ID_localidad');
        $this->db->join('cat_nombre_asentamiento', 'cat_nombre_asentamiento.ID_nAsentamiento = cat_unidad_administrativa.ID_nAsentamiento');
        $this->db->where('cat_unidad_administrativa.ID_unidad', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getRegulacionesModificadas($id)
    {
        $this->db->select('ma_regulacion.ID_Regulacion, ma_regulacion.Nombre_Regulacion, ma_regulacion.Homoclave, 
        ma_regulacion.Estatus, ma_regulacion.publicada');
        $this->db->from('rel_usuario_regulacion');
        $this->db->join('ma_regulacion', 'rel_usuario_regulacion.ID_Regulacion = ma_regulacion.ID_Regulacion');
        $this->db->where('rel_usuario_regulacion.id', $id);
        $this->db->where('ma_regulacion.Estatus', 4);
        $query = $this->db->get();
        return $query->result();
    }

    public function getRegulacionesAbrogadas(){
        $this->db->select('ma_regulacion.ID_Regulacion, ma_regulacion.Nombre_Regulacion, ma_regulacion.Homoclave, 
        ma_regulacion.Estatus, ma_regulacion.publicada');
        $this->db->from('ma_regulacion');
        $this->db->where('ma_regulacion.Estatus', 4);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtenerHorariosUnidad($id)
    {
        $this->db->select('de_horarios.*');
        $this->db->from('rel_unidad_horario');
        $this->db->join('de_horarios', 'rel_unidad_horario.ID_horario = de_horarios.ID_Horario');
        $this->db->where('rel_unidad_horario.ID_unidad', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertar_unidad($data)
    {
        $this->db->insert('cat_unidad_administrativa', $data);
        return $this->db->insert_id();
    }

    public function actualizar_unidad($id_unidad, $data)
    {
        $this->db->where('ID_unidad', $id_unidad);
        $this->db->update('cat_unidad_administrativa', $data);
    }

    public function eliminarHorarios($idhorario)
    {
        $this->db->where('ID_Horario', $idhorario);
        $this->db->delete('de_horarios');
    }

    public function insertarHorario($dias, $aperturas, $cierres)
    {
        $data = array(
            'Dia' => $dias,
            'Apertura' => $aperturas,
            'Cierre' => $cierres
        );

        $this->db->insert('de_horarios', $data);
        return $this->db->insert_id();
    }

    public function insertarRelacionUnidadHorario($id_unidad, $id_horario)
    {
        $data = array(
            'ID_unidad' => $id_unidad,
            'ID_horario' => $id_horario
        );

        $this->db->insert('rel_unidad_horario', $data);
    }

    public function eliminarUnidad($id)
    {
        // Obtener los ID_horario asociados con la unidad
        $this->db->select('ID_Horario');
        $this->db->from('rel_unidad_horario');
        $this->db->where('ID_unidad', $id);
        $query = $this->db->get();
        $horarios = $query->result();

        // Eliminar los horarios relacionados con la unidad
        foreach ($horarios as $horario) {
            $this->db->where('ID_Horario', $horario->ID_horario);
            $this->db->delete('de_horarios');
        }

        // Eliminar las relaciones entre la unidad y los horarios
        $this->db->where('ID_unidad', $id);
        $this->db->delete('rel_unidad_horario');

        // Eliminar la unidad
        $this->db->where('ID_unidad', $id);
        $this->db->delete('cat_unidad_administrativa');
    }

    public function ocultarUnidad($id)
    {
        $this->db->where('ID_unidad', $id);
        $this->db->update('cat_unidad_administrativa', ['status' => 0]);
    }

    public function insertar_sujeto($data)
    {
        $this->db->insert('cat_sujeto_obligado', $data);
    }

    public function actualizar_sujeto($id_sujeto, $data)
    {
        $this->db->where('ID_sujeto', $id_sujeto);
        $this->db->update('cat_sujeto_obligado', $data);
    }

    public function eliminarSujeto($id)
    {
        $this->db->where('ID_sujeto', $id);
        $this->db->update('cat_sujeto_obligado', array('status' => 0));
    }

    public function obtenerRegulacionesEnviadasPorUsuario($userId, $tipoUsuario)
    {
        $this->db->distinct();
        $this->db->select('ma_regulacion.ID_Regulacion, ma_regulacion.Nombre_Regulacion, ma_regulacion.Homoclave, 
        ma_regulacion.Estatus, ma_regulacion.publicada');
        $this->db->from('rel_usuario_regulacion');
        $this->db->join('ma_regulacion', 'rel_usuario_regulacion.ID_Regulacion = ma_regulacion.ID_Regulacion');
        $this->db->join('users_groups', 'rel_usuario_regulacion.id = users_groups.user_id');
        $this->db->join('groups', 'users_groups.group_id = groups.id');
        $this->db->where('rel_usuario_regulacion.id', $userId);
        $this->db->where('groups.name', $tipoUsuario);
        $query = $this->db->get();
        return $query->result();
    }

    public function getRegulacionesPublicada($id){
        $this->db->select('ma_regulacion.ID_Regulacion, id_usuario_creador, ma_regulacion.Nombre_Regulacion, ma_regulacion.Homoclave, 
        ma_regulacion.Estatus, ma_regulacion.publicada');
        $this->db->from('ma_regulacion');
        $this->db->where('ma_regulacion.publicada', 1);
        $this->db->where('ma_regulacion.Estatus', 3);
        $this->db->where('ma_regulacion.id_usuario_creador', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getRegulacionesPublicadas()
    {
        $this->db->select('ma_regulacion.ID_Regulacion, id_usuario_creador, ma_regulacion.Nombre_Regulacion, ma_regulacion.Homoclave, 
        ma_regulacion.Estatus, ma_regulacion.publicada');
        $this->db->from('ma_regulacion');
        $this->db->where('ma_regulacion.publicada', 1);
        $this->db->where('ma_regulacion.Estatus', 3);
        $query = $this->db->get();
        return $query->result();
    }

    public function modificarRegulacion($id_regulacion)
    {
        // Datos a actualizar
        $data = array(
            'estatus' => 4
        );
    
        // Actualizar la regulación en la base de datos
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->update('ma_regulacion', $data);
    }

    public function modificarRegulacionAbrogada($id_regulacion)
    {
        // Datos a actualizar
        $data = array(
            'estatus' => 3
        );
    
        // Actualizar la regulación en la base de datos
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->update('ma_regulacion', $data);
    }

}


