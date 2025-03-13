<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AyudaModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Obtener todas las incidencias
    public function get_incidents() {
        $this->db->select("ID, Titulo, Descripcion, ID_Proyecto, ID_Estatus, ID_Gravedad, ID_Reproducibilidad, ID_Clasificacion, Fecha_Creacion, Fecha_Actualizacion");
        $query = $this->db->get('ma_incidencias');
        return $query->result();
    }
    
    // Crear una nueva incidencia
    public function create_incident($data) {
        // Asignar fechas de creación y actualización
        $data['Fecha_Creacion'] = date('Y-m-d H:i:s');
        $data['Fecha_Actualizacion'] = date('Y-m-d H:i:s');
        // Se espera que $data tenga las claves:
        // 'Titulo', 'Descripcion', 'ID_Proyecto', 'ID_Estatus', 'ID_Gravedad', 
        // 'ID_Reproducibilidad', 'ID_Clasificacion', etc.
        return $this->db->insert('ma_incidencias', $data);
    }

    // Guardar archivos subidos
    public function save_file($data) {
        // Se espera que $data tenga las claves: ID_incidencia, Nombre_Archivo, Ruta_Archivo
        return $this->db->insert('rel_incidencias_archivos', $data);
    }

    // Obtener una incidencia por ID
    public function get_incident_by_id($id) {
        return $this->db->get_where('incidents', ['ID' => $id])->row();
    }

    // Actualizar una incidencia
    public function update_incident($id, $data) {
        $this->db->where('ID', $id);
        return $this->db->update('ma_incidencias', $data);
    }

    // Eliminar una incidencia
    public function delete_incident($id) {
        return $this->db->delete('ma_incidencias', ['ID' => $id]);
    }

    public function get_projects() {
        $query = $this->db->get('cat_incidencias_proyectos'); // Consultar la tabla catalogo
        return $query->result_array(); // Retorna un array asociativo con los resultados
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