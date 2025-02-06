<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AyudaModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Obtener todas las incidencias
    public function get_incidents() {
        return $this->db->get('incidents')->result();
    }
    
    // Crear una nueva incidencia
    public function create_incident($data) {
        return $this->db->insert('incidents', $data);
    }

    // Guardar archivos subidos
    public function save_file($data) {
        return $this->db->insert('incident_files', $data);
    }

    // Obtener una incidencia por ID
    public function get_incident_by_id($id) {
        return $this->db->get_where('incidents', ['ID' => $id])->row();
    }

    // Actualizar una incidencia
    public function update_incident($id, $data) {
        $this->db->where('ID', $id);
        return $this->db->update('incidents', $data);
    }

    // Eliminar una incidencia
    public function delete_incident($id) {
        return $this->db->delete('incidents', ['ID' => $id]);
    }

    public function get_projects() {
        return [
            'Registro Estatal de Visitas Domiciliarias',
            'Estadísticas',
            'Padrón de inspectores',
            'Padrón de inspecciones',
            'Regulaciones'
        ];
    }

    public function get_reproducibles() {
        return [
            'A veces',
            'Casi nunca',
            'No Aplicable',
            'No se puede',
            'Nunca intentado',
            'Siempre'
        ];
    }

    public function get_severities() {
        return [
            'Crítico',
            'Mayor',
            'Menor',
            'Sistema parado'
        ];
    }

    public function get_classifications() {
        return [
            'Bloqueo',
            'Característica (nueva)',
            'Funcionamiento',
            'IU/Facilidad de uso',
            'Mejora',
            'No aplicable',
            'Otros errores',
            'Pérdida de datos',
            'Seguridad'
        ];
    }

    public function get_statuses() {
        return [
            'Abrir Incidencia',
            'Incidencia enviada',
            'Borrador de incidencia',
            'Incidencia en curso'
        ];
    }
}