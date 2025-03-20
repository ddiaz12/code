<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspectores_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Cargar la base de datos
    }

    // Obtener todos los inspectores de la tabla ma_inspectores
    public function get_all_inspectores() {
        $this->db->select('ID, Homoclave, Nombre, Primer_Apellido, Segundo_Apellido, ID_Sujeto, ID_Unidad, Estatus, ID_Tipo, Vigencia');
        $query = $this->db->get('ma_inspectores');
        return $query->result(); // Retorna un array de objetos
    }

    // Método para agregar un nuevo inspector
    public function agregarInspector($data) {
        return $this->db->insert('ma_inspectores', $data);
    }

    // Método para obtener un inspector por su ID
    public function obtenerInspectorPorId($id) {
        $query = $this->db->get_where('inspectores', array('Inspector_ID' => $id));
        return $query->row();
    }

    // Método para actualizar un inspector existente
    public function update_inspector($id_inspector, $data) {
        $this->db->where('Inspector_ID', $id_inspector);
        return $this->db->update('inspectores', $data);
    }

    // Método para obtener los tipos de nombramiento
    public function get_tipos_nombramiento() {
        $this->db->select('ID, Nombre');
        $query = $this->db->get('cat_inspectores_tipo');
        return $query->result();
    }

    // Guardar datos de identificación del Step 1 para el inspector
    public function guardar_identificacion($id_inspector, $datos) {
        // Añadir el ID_inspector al array
        $datos['ID_inspector'] = $id_inspector;
        // Eliminar registro previo si existe
        $this->db->where('ID_inspector', $id_inspector);
        $this->db->delete('rel_inspectores_identificacion');
        // Insertar nuevos datos
        return $this->db->insert('rel_inspectores_identificacion', $datos);
    }

    // Guardar datos del Step 2: Superior Jerárquico
    public function guardar_superior_jerarquico($id_inspector, $datos) {
        // Agregar el ID_inspector al array de datos
        $datos['ID_inspector'] = $id_inspector;
        // Eliminar registro previo para este inspector
        $this->db->where('ID_inspector', $id_inspector);
        $this->db->delete('rel_ins_superior_jerarquico');
        // Insertar nuevos datos
        return $this->db->insert('rel_ins_superior_jerarquico', $datos);
    }

    // Guardar datos de no publicidad (Step 3)
    public function guardar_no_publicidad($id_inspector, $datos) {
        // Agregar el ID del inspector
        $datos['ID_inspector'] = $id_inspector;
        // Eliminar registro previo si existe
        $this->db->where('ID_inspector', $id_inspector);
        $this->db->delete('rel_inspectores_no_publicidad');
        // Insertar nuevos datos
        return $this->db->insert('rel_inspectores_no_publicidad', $datos);
    }

    // Guardar datos de no publicidad detalle (Step 3)
    public function guardar_no_publicidad_detalle($id_inspector, $detalles) {
        // Eliminar registros previos
        $this->db->where('ID_inspector', $id_inspector);
        $this->db->delete('rel_inspectores_no_publicidad_detalle');
        // Insertar cada detalle recibido
        if(is_array($detalles)) {
            foreach($detalles as $dato) {
                $data = [
                    'ID_inspector' => $id_inspector,
                    'Dato'         => $dato
                ];
                $this->db->insert('rel_inspectores_no_publicidad_detalle', $data);
            }
        }
    }

    // Guardar datos de emergencias (Step 4) para el inspector
    public function guardar_emergencias($id_inspector, $datos) {
        // Agregar el ID_inspector al array de datos
        $datos['ID_inspector'] = $id_inspector;
        // Eliminar registros previos para este inspector
        $this->db->where('ID_inspector', $id_inspector);
        $this->db->delete('rel_inspectores_emergencias');
        // Insertar los nuevos datos
        return $this->db->insert('rel_inspectores_emergencias', $datos);
    }
}
?>