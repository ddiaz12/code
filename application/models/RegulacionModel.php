<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegulacionModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database('sedeco');
    }

    public function get_regulaciones()
    {
        $this->db->select('*');
        $this->db->where('publicada', 1);
        $query = $this->db->get('ma_regulacion');
        return $query->num_rows() > 0 ? $query->result() : [];
    }
    public function contarRegulaciones()
    {
        $this->db->where('publicada', 1);
        return $this->db->count_all_results('ma_regulacion');
    }

    public function buscarPorNombre($nombre)
    {
        // Construir la consulta SQL según el nombre
        $this->db->select('ma_regulacion.ID_Regulacion, ma_regulacion.Nombre_Regulacion, ma_regulacion.Fecha_Act_Sys, GROUP_CONCAT(DISTINCT cat_sujeto_obligado.nombre_sujeto SEPARATOR ", ") as autoridades');
        $this->db->from('ma_regulacion');
        $this->db->join('de_regulacion_caracteristicas', 'ma_regulacion.ID_Regulacion = de_regulacion_caracteristicas.ID_Regulacion', 'left');
        $this->db->join('rel_autoridades_emiten', 'de_regulacion_caracteristicas.ID_caract = rel_autoridades_emiten.ID_caract', 'left');
        $this->db->join('cat_sujeto_obligado', 'rel_autoridades_emiten.ID_Emiten = cat_sujeto_obligado.ID_sujeto', 'left');
        $this->db->where('ma_regulacion.publicada', 1);
        $this->db->like('ma_regulacion.Nombre_Regulacion', $nombre);
        
        // Agrupar por ID_Regulacion para concatenar las autoridades
        $this->db->group_by('ma_regulacion.ID_Regulacion');
        
        // Ejecutar la consulta
        $query = $this->db->get();
        return $query->result();
    }

    // public function getTiposOrdenamiento()
    // {
    //     $this->db->select('Tipo_Ordenamiento');
    //     $query = $this->db->get('cat_tipo_ord_jur');
    //     return $query->result_array();
    // }

    public function getTiposOrdenamiento()
    {
        $query = $this->db->select('Tipo_Ordenamiento')
            ->from('cat_tipo_ord_jur')
            ->get();
        return $query->result_array();
    }

    public function getDependencias()
    {
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result_array();
    }

    public function getTiposOrdenamiento2()
    {
        $query = $this->db->get('cat_tipo_ord_jur');
        return $query->result();
    }

    public function buscarRegulaciones($desdeFecha, $hastaFecha, $dependencia, $tipoOrdenamiento)
    {
        // Construir la consulta SQL según los filtros
        $this->db->select('ma_regulacion.ID_Regulacion, ma_regulacion.Nombre_Regulacion, ma_regulacion.Fecha_Act_Sys, de_regulacion_caracteristicas.Fecha_Exp, cat_sujeto_obligado.nombre_sujeto as autoridad_emiten, GROUP_CONCAT(DISTINCT cat_sujeto_obligado.nombre_sujeto SEPARATOR ", ") as autoridades');
        $this->db->from('ma_regulacion');
        $this->db->join('de_regulacion_caracteristicas', 'ma_regulacion.ID_Regulacion = de_regulacion_caracteristicas.ID_Regulacion', 'inner');
        $this->db->join('rel_autoridades_emiten', 'de_regulacion_caracteristicas.ID_caract = rel_autoridades_emiten.ID_caract', 'inner');
        $this->db->join('cat_sujeto_obligado', 'rel_autoridades_emiten.ID_Emiten = cat_sujeto_obligado.ID_sujeto', 'inner');
        $this->db->join('cat_tipo_ord_jur', 'de_regulacion_caracteristicas.ID_tOrdJur = cat_tipo_ord_jur.ID_tOrdJur', 'inner');
        $this->db->where('ma_regulacion.publicada', 1);
        
        // Filtrar por fecha de expedición si se proporcionan las fechas
        if (!empty($desdeFecha)) {
            $this->db->where('de_regulacion_caracteristicas.Fecha_Exp >=', $desdeFecha);
        }
        if (!empty($hastaFecha)) {
            $this->db->where('de_regulacion_caracteristicas.Fecha_Exp <=', $hastaFecha);
        }
    
        // Filtrar por dependencia si se proporciona
        if (!empty($dependencia)) {
            $this->db->where('cat_sujeto_obligado.nombre_sujeto', $dependencia);
        }
    
        // Filtrar por tipo de ordenamiento si se proporciona
        if (!empty($tipoOrdenamiento)) {
            $this->db->where('cat_tipo_ord_jur.Tipo_Ordenamiento', $tipoOrdenamiento);
        }
    
        // Agrupar por ID_Regulacion para concatenar las autoridades
        $this->db->group_by('ma_regulacion.ID_Regulacion');
    
        // Ejecutar la consulta
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertar_caractRegulacion($data)
    {
        $this->db->insert('`de_regulacion_caracteristicas`INNER JOIN rel_autoridades_emiten ON de_regulacion_caracteristicas.ID_caract=rel_autoridades_emiten.ID_caract INNER JOIN rel_autoridades_aplican ON de_regulacion_caracteristicas.ID_caract=rel_autoridades_aplican.ID_caract INNER JOIN de_indice ON de_regulacion_caracteristicas.ID_caract=de_indice.ID_caract INNER JOIN rel_indice ON de_indice.ID_Indice=rel_indice.ID_Indice', $data);
        return $this->db->insert_id();
    }
    public function search_tipo_dependencia($query)
    {
        $this->db->like('nombre_sujeto', $query);
        $this->db->where('cat_sujeto_obligado.nombre_sujeto !=', 'No especificado');
        $this->db->limit(5);
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result_array();
    }
    public function getIndices()
    {
        $query = $this->db->get('de_indice');
        return $query->result();
    }
    public function getMaxValues()
    {
        $this->db->select_max('ID_Indice');
        $this->db->select_max('Orden');
        $query = $this->db->get('de_indice');
        return $query->row_array();
    }
    public function getMaxID()
    {
        $this->db->select_max('ID_Regulacion');
        $query = $this->db->get('ma_regulacion');
        $result = $query->row();
        return $result->ID_Regulacion;
    }

    public function obtenerRegulacionPorId($id)
    {
        $this->db->where('ID_Regulacion', $id);
        $query = $this->db->get('ma_regulacion');
        return $query->row();
    }

    public function insertRegulacion($data)
    {
        $this->db->insert('ma_regulacion', $data);
        return $this->db->insert_id();
    }
    
    public function obtenerMaxIDCaract() {
        $this->db->select_max('ID_caract');
        $query = $this->db->get('de_regulacion_caracteristicas');
        return $query->row()->ID_caract;
    }

    public function insertarCaracteristicas($data)
    {
        $this->db->insert('de_regulacion_caracteristicas', $data);
        return $this->db->affected_rows() > 0;
    }

    public function get_sectors($search_term)
    {
        $this->db->like('Nombre_Sector', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('cat_sector');
        return $query->result_array();
    }

    public function get_subsectors($search_term)
    {
        $this->db->like('Nombre_Subsector', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('cat_subsector');
        return $query->result_array();
    }

    public function get_ramas($search_term)
    {
        $this->db->like('Nombre_Rama', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('cat_rama');
        return $query->result_array();
    }

    public function get_subramas($search_term)
    {
        $this->db->like('Nombre_Subrama', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('cat_subrama');
        return $query->result_array();
    }

    public function get_clases($search_term)
    {
        $this->db->like('Nombre_Clase', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('cat_clase');
        return $query->result_array();
    }

    public function get_regulaciones2($search_term)
    {
        $this->db->like('Nombre_Regulacion', $search_term);
        $this->db->limit(5);
        $query = $this->db->get('ma_regulacion');
        return $query->result_array();
    }

    public function insertarRelAutoridadesEmiten($data)
    {
        return $this->db->insert('rel_autoridades_emiten', $data);
    }

    public function insertarRelAutoridadesAplican($data)
    {
        return $this->db->insert('rel_autoridades_aplican', $data);
    }

    public function insertarDatosTabla($data)
    {
        // Insertar los datos en la tabla 'de_indice'
        $this->db->insert('de_indice', $data);
    }

    public function obtenerMaxIDJerarquia()
    {
        $this->db->select_max('ID_Jerarquia');
        $query = $this->db->get('rel_indice');
        $result = $query->row();
        return $result->ID_Jerarquia;
    }
    public function verificarIDIndice($ID_Indice)
    {
        $this->db->where('ID_Indice', $ID_Indice);
        $query = $this->db->get('de_indice');
        return $query->num_rows() > 0;
    }

    public function insertarRelIndice($relIndiceData)
    {
        return $this->db->insert('rel_indice', $relIndiceData);
    }

    public function get_max_id_nat()
    {
        $this->db->select_max('ID_Nat');
        $query = $this->db->get('de_naturaleza_regulacion');
        $result = $query->row_array();
        return $result['ID_Nat'] ?? 0; // Retorna 0 si no hay registros
    }

    public function insert_naturaleza_regulacion($data)
    {
        $this->db->insert('de_naturaleza_regulacion', $data);
        return $this->db->insert_id();
    }

    public function update_naturaleza_regulacion($data)
    {
        $this->db->where('ID_Nat', $data['ID_Nat']);
        $this->db->update('de_naturaleza_regulacion', $data);
    }

    public function get_naturaleza_regulacion($id)
    {
        $this->db->where('ID_Nat', $id);
        $query = $this->db->get('de_naturaleza_regulacion');
        return $query->row();
    }

    public function insert_derivada_reg($data)
    {
        $this->db->insert('derivada_reg', $data);
    }
    

    public function insertarRegulacionDerivada($data)
    {
        $this->db->insert('cat_regulacion_derivada_manual', $data);
    }

    public function get_max_id_rel_nat()
    {
        $this->db->select_max('ID_relNaturaleza');
        $query = $this->db->get('rel_nat_reg');
        $result = $query->row_array();

        // Validar si no existe ninguna inserción
        if (empty($result['ID_relNaturaleza'])) {
            return 0; // Valor predeterminado si no hay registros
        }

        return $result['ID_relNaturaleza'];
    }

    public function get_regulaciones_by_id($idRegulacion)
    {
        $this->db->where('ID_Regulacion', $idRegulacion);
        $query = $this->db->get('ma_regulacion');
        return $query->row();

    }

    public function get_last_id_regulacion()
    {
        $this->db->select_max('ID_Regulacion');
        $query = $this->db->get('ma_regulacion');
        $result = $query->row_array();
        return $result['ID_Regulacion'];
    }

    public function insert_rel_nat_reg($data)
    {
        $this->db->insert('rel_nat_reg', $data);
    }

    public function get_all_regulaciones()
    {
        $query = $this->db->get('ma_regulacion');
        return $query->result();
    }
    public function getRegulacionExcel()
    {
        // Seleccionar los campos necesarios de las diferentes tablas
        $this->db->distinct();
        $this->db->select('ma_regulacion.Nombre_Regulacion, ma_regulacion.Fecha_Cre_Sys, ma_regulacion.Fecha_Act_Sys, de_regulacion_caracteristicas.Ambito_Aplicacion, cat_tipo_ord_jur.Tipo_Ordenamiento,
                           de_regulacion_caracteristicas.Fecha_Exp, ma_regulacion.Vigencia, de_regulacion_caracteristicas.Fecha_Publi,
                           de_regulacion_caracteristicas.Fecha_vigor, de_regulacion_caracteristicas.Fecha_Act, de_regulacion_caracteristicas.Orden_Gob,
                           GROUP_CONCAT(DISTINCT ma_regulacion_vinculada.Nombre_Regulacion) as Regulaciones_Vinculadas, de_naturaleza_regulacion.Enlace_Oficial,
                           GROUP_CONCAT(DISTINCT cat_sujeto_obligado.nombre_sujeto) as Autoridades_Aplican');

        // Unir las tablas relacionadas
        $this->db->from('ma_regulacion');
        $this->db->join('rel_nat_reg', 'rel_nat_reg.ID_Regulacion = ma_regulacion.ID_Regulacion', 'left');
        $this->db->join('de_regulacion_caracteristicas', 'de_regulacion_caracteristicas.ID_Regulacion = ma_regulacion.ID_Regulacion', 'left');
        $this->db->join('cat_tipo_ord_jur', 'de_regulacion_caracteristicas.ID_tOrdJur = cat_tipo_ord_jur.ID_tOrdJur', 'left');
        $this->db->join('de_naturaleza_regulacion', 'rel_nat_reg.ID_Nat = de_naturaleza_regulacion.ID_Nat', 'left');
        $this->db->join('derivada_reg', 'derivada_reg.ID_Nat = de_naturaleza_regulacion.ID_Nat', 'left');
        $this->db->join('ma_regulacion as ma_regulacion_vinculada', 'derivada_reg.ID_Regulacion = ma_regulacion_vinculada.ID_Regulacion', 'left');
        $this->db->join('rel_autoridades_aplican', 'rel_autoridades_aplican.ID_caract = de_regulacion_caracteristicas.ID_caract', 'left');
        $this->db->join('cat_sujeto_obligado', 'rel_autoridades_aplican.ID_Aplican = cat_sujeto_obligado.ID_sujeto', 'left');
        $this->db->where('ma_regulacion.publicada', 1);
        // Agrupar por los campos seleccionados
        $this->db->group_by('ma_regulacion.ID_Regulacion, de_regulacion_caracteristicas.Ambito_Aplicacion, cat_tipo_ord_jur.Tipo_Ordenamiento,
                             de_regulacion_caracteristicas.Fecha_Exp, ma_regulacion.Vigencia, de_regulacion_caracteristicas.Fecha_Publi,
                             de_regulacion_caracteristicas.Fecha_vigor, de_regulacion_caracteristicas.Fecha_Act, de_regulacion_caracteristicas.Orden_Gob,
                             de_naturaleza_regulacion.Enlace_Oficial');

        // Obtener los resultados
        $query = $this->db->get();
        return $query->result();
    }

    public function countTipoOrdenamiento()
    {
        // Seleccionar los campos necesarios y contar los tipos de ordenamiento jurídico por dependencia
        $this->db->select('cat_sujeto_obligado.nombre_sujeto, cat_tipo_ord_jur.Tipo_Ordenamiento, COUNT(*) as count');
        $this->db->from('ma_regulacion');
        $this->db->join('de_regulacion_caracteristicas', 'de_regulacion_caracteristicas.ID_Regulacion = ma_regulacion.ID_Regulacion', 'left');
        $this->db->join('rel_autoridades_aplican', 'rel_autoridades_aplican.ID_caract = de_regulacion_caracteristicas.ID_caract', 'left');
        $this->db->join('cat_sujeto_obligado', 'rel_autoridades_aplican.ID_Aplican = cat_sujeto_obligado.ID_sujeto', 'left');
        $this->db->join('cat_tipo_ord_jur', 'de_regulacion_caracteristicas.ID_tOrdJur = cat_tipo_ord_jur.ID_tOrdJur', 'left');
        $this->db->where('ma_regulacion.publicada', 1);
        $this->db->group_by(['cat_sujeto_obligado.nombre_sujeto', 'cat_tipo_ord_jur.Tipo_Ordenamiento']);
        $query = $this->db->get();
        return $query->result();
    }


    public function buscarMovimientoDevolucionConsejeria($id_regulacion)
    {
        $this->db->from('trazabilidad');
        $this->db->where('ID_Regulacion', $id_regulacion);
        $this->db->where('descripcion_movimiento', 'Regulación devuelta por consejería');
        $query = $this->db->get();

        return $query->row(); // Retorna el registro si existe
    }


    public function enviar_regulacion($id_regulacion, $Estatus)
    {
        $this->db->where('ID_Regulacion', $id_regulacion);
        $this->db->update('ma_regulacion', array('Estatus' => $Estatus));
    }

    public function devolver_regulacion($id_regulacion)
    {
        $this->db->where('ID_Regulacion', $id_regulacion);
        $this->db->update('ma_regulacion', array('Estatus' => 0));
    }

    public function actualizar_estatus($id)
    {
        $this->db->set('Estatus', 9);
        $this->db->where('ID_Regulacion', $id);
        $this->db->update('ma_regulacion');
    }

    public function get_regulacion_by_id($id)
    {
        $this->db->where('ID_Regulacion', $id);
        $query = $this->db->get('ma_regulacion');
        return $query->row_array();
    }

    public function get_caracteristicas_by_id($id_regulacion)
    {
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get('de_regulacion_caracteristicas');
        return $query->row_array();
    }

    public function get_tipo_ordenamiento_by_id($id)
    {
        $this->db->where('ID_tOrdJur', $id);
        $query = $this->db->get('cat_tipo_ord_jur');
        return $query->row_array();
    }

    public function get_emiten_by_caract($id_caract)
    {
        $this->db->where('ID_caract', $id_caract);
        $query = $this->db->get('rel_autoridades_emiten');
        return $query->result_array();
    }

    public function get_aplican_by_caract($id_caract)
    {
        $this->db->where('ID_caract', $id_caract);
        $query = $this->db->get('rel_autoridades_aplican');
        return $query->result_array();
    }

    public function get_dependencias_by_emiten($emiten_ids)
    {
        if (!empty($emiten_ids)) {  // Aquí cambiamos de empty a !empty
            if (is_array($emiten_ids)) {
                $this->db->where_in('ID_sujeto', $emiten_ids);
            } else {
                $this->db->where('ID_sujeto', $emiten_ids);
            }
        } else {
            return [];
        }
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result_array();
    }

    public function get_dependencias_by_aplican($aplican_ids)
    {
        if (!empty($aplican_ids)) {  // Aquí cambiamos de empty a !empty
            if (is_array($aplican_ids)) {
                $this->db->where_in('ID_sujeto', $aplican_ids);
            } else {
                $this->db->where('ID_sujeto', $aplican_ids);
            }
        } else {
            return [];
        }
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result_array();
    }

    public function get_indices_by_caract($ID_caract)
    {
        $this->db->select('de_indice.ID_Indice, de_indice.Texto, de_indice.Orden, rel_indice.ID_Padre');
        $this->db->from('de_indice');
        $this->db->join('rel_indice', 'de_indice.ID_Indice = rel_indice.ID_Indice', 'left');
        $this->db->where('de_indice.ID_caract', $ID_caract);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Devuelve un array de registros
        } else {
            return []; // Devuelve un array vacío si no hay registros
        }
    }

    public function get_rel_by_indice($indice_ids)
    {
        if (empty($indice_ids)) {
            return array(); // Retorna un array vacío si no hay IDs
        } else {
            if (is_array($indice_ids)) {
                $this->db->where_in('ID_Indice', $indice_ids);
            } else {
                $this->db->where('ID_Indice', $indice_ids);
            }
        }
        $query = $this->db->get('rel_indice');
        return $query->result_array();
    }

    public function get_materias_by_regulacion($id_regulacion)
    {
        $this->db->select('cat_regulacion_materias_gub.Nombre_Materia');
        $this->db->from('rel_regulaciones_materias');
        $this->db->join('cat_regulacion_materias_gub', 'rel_regulaciones_materias.ID_Materias = cat_regulacion_materias_gub.ID_Materia');
        $this->db->where('rel_regulaciones_materias.ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_naturaleza_regulacion_by_regulacion($id_regulacion)
    {
        $this->db->select('de_naturaleza_regulacion.*');
        $this->db->from('rel_nat_reg');
        $this->db->join('de_naturaleza_regulacion', 'rel_nat_reg.ID_Nat = de_naturaleza_regulacion.ID_Nat');
        $this->db->where('rel_nat_reg.ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->row();
    }

    public function getNaturalezaRegulacionByRegulacion($id_regulacion)
    {
        $this->db->select('de_naturaleza_regulacion.ID_Nat');
        $this->db->from('rel_nat_reg');
        $this->db->join('de_naturaleza_regulacion', 'rel_nat_reg.ID_Nat = de_naturaleza_regulacion.ID_Nat');
        $this->db->where('rel_nat_reg.ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->row();
    }

    public function getNaturalezaRegulacion($id_nat)
    {
        $this->db->where('ID_Nat', $id_nat);
        $query = $this->db->get('de_naturaleza_regulacion');
        return $query->row();
    }

    public function has_materias($id_regulacion)
    {
        $this->db->from('rel_regulaciones_materias');
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->count_all_results() > 0;
    }

    public function updateRegulacion($id, $data)
    {
        $this->db->where('ID_Regulacion', $id);
        return $this->db->update('ma_regulacion', $data);
    }

    public function updateCaracteristicas($id_regulacion, $data)
    {
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->update('de_regulacion_caracteristicas', $data);
    }

    public function deleteEmiten($ID_caract, $ID_Dependencia)
    {
        $this->db->where('ID_caract', $ID_caract);
        $this->db->where('ID_Emiten', $ID_Dependencia);
        return $this->db->delete('rel_autoridades_emiten');
    }

    public function deleteAplican($ID_caract, $ID_Dependencia)
    {
        $this->db->where('ID_caract', $ID_caract);
        $this->db->where('ID_Aplican', $ID_Dependencia);
        return $this->db->delete('rel_autoridades_aplican');
    }

    public function verificarRelAutoridadesEmiten($ID_caract)
    {
        $this->db->select('ID_Emiten');
        $this->db->where('ID_caract', $ID_caract);
        $query = $this->db->get('rel_autoridades_emiten');

        if ($query->num_rows() > 0) {
            return array_column($query->result_array(), 'ID_Emiten'); // Devuelve un array de ID_Emiten
        } else {
            return false; // No existen registros
        }
    }

    public function verificarRelAutoridadesAplican($ID_caract)
    {
        $this->db->select('ID_Aplican');
        $this->db->where('ID_caract', $ID_caract);
        $query = $this->db->get('rel_autoridades_aplican');

        if ($query->num_rows() > 0) {
            return array_column($query->result_array(), 'ID_Aplican'); // Devuelve un array de ID_Aplican
        } else {
            return false; // No existen registros
        }
    }

    public function getDependenciasEmiten($ID_caract)
    {
        $this->db->select('ID_Emiten');
        $this->db->where('ID_caract', $ID_caract);
        $query = $this->db->get('rel_autoridades_emiten');

        if ($query->num_rows() > 0) {
            return array_column($query->result_array(), 'ID_Emiten'); // Devuelve un array de ID_Emiten
        } else {
            return []; // Devuelve un array vacío si no hay registros
        }
    }


    public function get_existentes_by_caract($ID_caract)
    {
        $this->db->select('ID_Emiten');
        $this->db->where('ID_caract', $ID_caract);
        $query = $this->db->get('rel_autoridades_emiten');

        if ($query->num_rows() > 0) {
            return array_column($query->result_array(), 'ID_Emiten'); // Devuelve un array de ID_Emiten
        } else {
            return []; // Devuelve un array vacío si no hay registros
        }
    }

    public function get_existentes_by_caract2($ID_caract)
    {
        $this->db->select('ID_Aplican');
        $this->db->where('ID_caract', $ID_caract);
        $query = $this->db->get('rel_autoridades_aplican');

        if ($query->num_rows() > 0) {
            return array_column($query->result_array(), 'ID_Aplican'); // Devuelve un array de ID_Emiten
        } else {
            return []; // Devuelve un array vacío si no hay registros
        }
    }

    public function obtenerCaracteristicasRegulacion($id)
    {
        $this->db->select('de_regulacion_caracteristicas.*, cat_tipo_ord_jur.Tipo_Ordenamiento');
        $this->db->from('de_regulacion_caracteristicas');
        $this->db->join('cat_tipo_ord_jur', 'de_regulacion_caracteristicas.ID_tOrdJur = cat_tipo_ord_jur.ID_tOrdJur');
        $this->db->where('de_regulacion_caracteristicas.ID_Regulacion', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function obtenerEnlaceOficial($id)
    {
        $this->db->select('Enlace_Oficial, file_path');
        $this->db->from('de_naturaleza_regulacion');
        $this->db->join('rel_nat_reg', 'de_naturaleza_regulacion.ID_Nat = rel_nat_reg.ID_Nat');
        $this->db->where('rel_nat_reg.ID_Regulacion', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function obtenerIndicePorRegulacion($idRegulacion)
    {
        $this->db->select('de_indice.ID_Indice, de_indice.Texto, de_indice.Orden, rel_indice.ID_Padre');
        $this->db->from('de_indice');
        $this->db->join('de_regulacion_caracteristicas', 'de_indice.ID_caract = de_regulacion_caracteristicas.ID_caract');
        $this->db->join('rel_indice', 'de_indice.ID_Indice = rel_indice.ID_Indice', 'left');
        $this->db->where('de_regulacion_caracteristicas.ID_Regulacion', $idRegulacion);
        $this->db->order_by('de_indice.Orden', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
    
        // Organizar los datos en una estructura jerárquica
        $indices = [];
        foreach ($result as $row) {
            if (empty($row->ID_Padre)) {
                // Es un índice padre
                $indices[$row->ID_Indice] = [
                    'Texto' => $row->Texto,
                    'Orden' => $row->Orden,
                    'Hijos' => []
                ];
            } else {
                // Es un índice hijo
                $indices[$row->ID_Padre]['Hijos'][] = [
                    'Texto' => $row->Texto,
                    'Orden' => $row->Orden
                ];
            }
        }
    
        return $indices;
    }
    public function obtenerAutoridadesPorRegulacion($idRegulacion)
    {
        $this->db->distinct();
        $this->db->select('emiten_dep.nombre_sujeto as Autoridad_Emiten, aplican_dep.nombre_sujeto as Autoridad_Aplican');
        $this->db->from('de_regulacion_caracteristicas as caract');
        $this->db->join('rel_autoridades_emiten as emiten', 'caract.ID_caract = emiten.ID_caract', 'left');
        $this->db->join('cat_sujeto_obligado as emiten_dep', 'emiten.ID_Emiten = emiten_dep.ID_sujeto', 'left');
        $this->db->join('rel_autoridades_aplican as aplican', 'caract.ID_caract = aplican.ID_caract', 'left');
        $this->db->join('cat_sujeto_obligado as aplican_dep', 'aplican.ID_Aplican = aplican_dep.ID_sujeto', 'left');
        $this->db->where('caract.ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtenerMateriasExentas($idRegulacion)
    {
        $this->db->select('materias.Nombre_Materia as Materia');
        $this->db->from('rel_regulaciones_materias');
        $this->db->join('cat_regulacion_materias_gub as materias', 'rel_regulaciones_materias.ID_Materias = materias.ID_Materia');
        $this->db->where('rel_regulaciones_materias.ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }
    // Método para obtener las regulaciones vinculadas
    public function obtenerRegulacionesVinculadas($idRegulacion) {
        $this->db->select('regulacion.Nombre_Regulacion, regulacion.ID_Regulacion');
        $this->db->from('derivada_reg');
        $this->db->join('ma_regulacion as regulacion', 'derivada_reg.ID_Regulacion = regulacion.ID_Regulacion');
        $this->db->where('derivada_reg.ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }

    // Método para obtener las regulaciones derivadas manualmente
    public function obtenerRegulacionesManuales($idRegulacion) {
        $this->db->select('manual.nombre as Nombre_Manual, manual.enlace as Enlace, manual.id_regulacion as ID_Regulacion');
        $this->db->from('cat_regulacion_derivada_manual as manual');
        $this->db->where('manual.id_regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }
    

    public function obtenerSectoresPorRegulacion($idRegulacion)
    {
        $this->db->select('sector.Nombre_Sector as Sector');
        $this->db->from('rel_nat_reg');
        $this->db->join('cat_sector as sector', 'rel_nat_reg.ID_sector = sector.ID_sector');
        $this->db->where('rel_nat_reg.ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtenerTramitesPorRegulacion($idRegulacion)
    {
        $this->db->select('tramites.Nombre as Tramite, tramites.Direccion as url');
        $this->db->from('de_tramitesyservicios as tramites');
        $this->db->join('rel_nat_reg as rel', 'tramites.ID_Nat = rel.ID_Nat');
        $this->db->where('rel.ID_Regulacion', $idRegulacion);
        $this->db->group_by('tramites.Nombre, tramites.Direccion');
        $query = $this->db->get();
        return $query->result();
    }
    public function obtenerMateriasSectoresSujetos($idRegulacion)
    {
        $this->db->select('mat_sec_suj.Materias, mat_sec_suj.Sectores, mat_sec_suj.SujetosRegulados');
        $this->db->from('de_mat_sec_suj as mat_sec_suj');
        $this->db->join('de_regulacion_caracteristicas as caract', 'mat_sec_suj.ID_caract = caract.ID_caract');
        $this->db->where('caract.ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    } 

    public function obtenerFundamentos($idRegulacion){
        $this->db->select('fundamentos.Nombre, fundamentos.Articulo, fundamentos.Link');
        $this->db->from('de_fundamento as fundamentos');
        $this->db->join('de_regulacion_caracteristicas as caract', 'fundamentos.ID_caract = caract.ID_caract');
        $this->db->where('caract.ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertar_rel_usuario_regulacion($idUsuario, $idRegulacion)
    {
        $data = array(
            'id' => $idUsuario,
            'ID_Regulacion' => $idRegulacion
        );
        $this->db->insert('rel_usuario_regulacion', $data);
    }

    public function registrarMovimiento($data)
    {
        $this->db->insert('trazabilidad', $data);
    }

    public function obtenerTrazabilidadPorRegulacion($idRegulacion)
    {
        $this->db->select('*');
        $this->db->from('trazabilidad');
        $this->db->where('ID_Regulacion', $idRegulacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function publicar_regulacion($id_regulacion)
    {
        $this->db->where('ID_Regulacion', $id_regulacion);
        $this->db->update('ma_regulacion', array('Estatus' => 3, 'publicada' => 1));
    }

    public function despublicar_regulacion($id_regulacion)
    {
        $this->db->where('ID_Regulacion', $id_regulacion);
        $this->db->update('ma_regulacion', array('Estatus' => 2, 'publicada' => 0));
    }


    public function get_regulaciones_por_usuario($id_usuario)
    {
        $this->db->where('id_usuario_creador', $id_usuario);
        $query = $this->db->get('ma_regulacion');
        return $query->result();
    }

    public function get_last_id_jerarquia()
    {
        $this->db->select_max('ID_Jerarquia');
        $query = $this->db->get('rel_indice');

        if ($query->num_rows() > 0) {
            return $query->row()->ID_Jerarquia;
        } else {
            return 0; // Devuelve 0 si no hay registros
        }
    }
    public function get_materias_by_regulacion2($id_regulacion)
    {
        $this->db->select('*');
        $this->db->from('rel_regulaciones_materias');
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_nombres_materias($idMaterias)
    {
        $this->db->select('Nombre_Materia');
        $this->db->from('cat_regulacion_materias_gub');
        $this->db->where_in('ID_Materia', $idMaterias);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_rel_nat_reg_by_id($id_regulacion)
    {
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get('rel_nat_reg');
        return $query->row_array();
    }
    public function get_de_naturaleza_regulacion_by_id($id_nat)
    {
        $this->db->where('ID_Nat', $id_nat);
        $query = $this->db->get('de_naturaleza_regulacion');
        return $query->row_array();
    }
    public function get_derivada_reg_by_id($id_nat)
    {
        $this->db->where('ID_Nat', $id_nat);
        $query = $this->db->get('derivada_reg');
        return $query->row_array();
    }

    public function get_sectores_by_regulacion($id_regulacion)
    {
        $this->db->select('ID_sector');
        $this->db->from('rel_nat_reg');
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_nombres_sectores($id_sectores)
    {
        $this->db->select('Nombre_Sector');
        $this->db->from('cat_sector');
        $this->db->where_in('ID_Sector', $id_sectores);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_subsectores_by_regulacion($id_regulacion)
    {
        $this->db->select('ID_Subsector');
        $this->db->from('rel_nat_reg');
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_nombres_subsectores($id_subsectores)
    {
        $this->db->select('Nombre_Subsector');
        $this->db->from('cat_subsector');
        $this->db->where_in('ID_Subsector', $id_subsectores);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_ramas_by_regulacion($id_regulacion)
    {
        $this->db->select('ID_Rama');
        $this->db->from('rel_nat_reg');
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_nombres_ramas($id_ramas)
    {
        $this->db->select('Nombre_Rama');
        $this->db->from('cat_rama');
        $this->db->where_in('ID_Rama', $id_ramas);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_subramas_by_regulacion($id_regulacion)
    {
        $this->db->select('ID_Subrama');
        $this->db->from('rel_nat_reg');
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_nombres_subramas($id_subramas)
    {
        $this->db->select('Nombre_Subrama');
        $this->db->from('cat_subrama');
        $this->db->where_in('ID_Subrama', $id_subramas);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_clases_by_regulacion($id_regulacion)
    {
        $this->db->select('ID_Clase');
        $this->db->from('rel_nat_reg');
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_nombres_clases($id_clases)
    {
        $this->db->select('Nombre_Clase');
        $this->db->from('cat_clase');
        $this->db->where_in('ID_Clase', $id_clases);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_nats_by_regulacion($id_regulacion)
    {
        $this->db->select('ID_Nat');
        $this->db->from('rel_nat_reg');
        $this->db->where('ID_Regulacion', $id_regulacion);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_regulaciones_by_nats($id_nats)
    {
        $this->db->select('ID_Regulacion');
        $this->db->from('derivada_reg');
        $this->db->where_in('ID_Nat', $id_nats);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_idRegulacion_by_idNat($id_nat)
    {
        $this->db->select('ID_Regulacion');
        $this->db->from('rel_nat_reg');
        $this->db->where('ID_Nat', $id_nat);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_regulaciones_derivadas($id_nat)
    {
        $this->db->select('ma.ID_Regulacion, ma.Nombre_Regulacion');
        $this->db->from('derivada_reg');
        $this->db->join('ma_regulacion as ma', 'derivada_reg.ID_Regulacion = ma.ID_Regulacion');
        $this->db->where('derivada_reg.ID_Nat', $id_nat); // Filtrando por ID_Nat
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_regulaciones_derivadas_manuales($id_regulaciones)
    {
        $this->db->select('id_regulacion as ID_Regulacion, nombre, enlace');
        $this->db->from('cat_regulacion_derivada_manual');
        $this->db->where_in('id_regulacion', $id_regulaciones);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_nombres_regulaciones($id_regulaciones)
    {
        $this->db->select('Nombre_Regulacion');
        $this->db->from('ma_regulacion');
        $this->db->where_in('ID_Regulacion', $id_regulaciones);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getMaxValuesTram()
    {
        $this->db->select_max('ID_Tramites');
        $query = $this->db->get('de_tramitesyservicios');
        return $query->result();
    }
    public function insert_tramite($data) {
        $this->db->insert('de_tramitesyservicios', $data);
        return $this->db->insert_id(); // Retorna el ID del registro insertado
    }

    public function get_tramite_by_id($id) {
        $query = $this->db->get_where('tramites', ['ID_Tramites' => $id]);
        return $query->row_array(); // Retorna el registro como un array
    }
    public function get_tramites_by_id_nat($id_nat) {
        $query = $this->db->get_where('de_tramitesyservicios', ['ID_Nat' => $id_nat]);
        return $query->result_array(); // Retorna los registros como un array
    }
    public function insertarRegistro($data) {
        $this->db->insert('de_mat_sec_suj', $data);
    }
    public function insertFun($data) {
        $this->db->insert('de_fundamento', $data);
    }
    public function obtenerUltimoIDMatSec() {
        $this->db->select_max('ID_MatSec');
        $query = $this->db->get('de_mat_sec_suj');
        $result = $query->row_array();

        return $result['ID_MatSec'] ?? null;
    }
    public function obtenerUltimoIDFun() {
        $this->db->select_max('ID_Fun');
        $query = $this->db->get('de_fundamento');
        $result = $query->row_array();

        return $result['ID_Fun'] ?? null;
    }
    public function obtenerUltimoIDTram(){
        $this->db->select_max('ID_Tramites');
        $query = $this->db->get('de_tramitesyservicios');
        $result = $query->row_array();

        return $result['ID_Tramites'] ?? null;
    }
    public function get_mat_sec_by_id_caract($id_caract) {
        $query = $this->db->get_where('de_mat_sec_suj', ['ID_caract' => $id_caract]);
        return $query->result_array(); // Retorna los registros como un array
    }
    public function get_fun_by_id_caract($id_caract) {
        $query = $this->db->get_where('de_fundamento', ['ID_caract' => $id_caract]);
        return $query->result_array(); // Retorna los registros como un array
    }
    public function eliminarRegistro($ID_MatSec) {
        $this->db->where('ID_MatSec', $ID_MatSec);
        return $this->db->delete('de_mat_sec_suj');
    }
    public function eliminarFun($ID_Fun) {
        $this->db->where('ID_Fun', $ID_Fun);
        return $this->db->delete('de_fundamento');
    }
    public function eliminarTram($ID_Tramites) {
        $this->db->where('ID_Tramites', $ID_Tramites);
        return $this->db->delete('de_tramitesyservicios');
    }
    public function get_registros_by_id_caract($id_caract) {
        $query = $this->db->get_where('de_mat_sec_suj', ['ID_caract' => $id_caract]);
        return $query->result_array(); // Retorna los registros como un array
    }
    public function get_fundamentos_by_id_caract($id_caract) {
        $query = $this->db->get_where('de_fundamento', ['ID_caract' => $id_caract]);
        return $query->result_array(); // Retorna los registros como un array
    }
    public function get_tramites_by_id_tramites($id_nat) {
        $query = $this->db->get_where('de_tramitesyservicios', ['ID_Nat' => $id_nat]);
        return $query->result_array(); // Retorna los registros como un array
    }
    public function get_indice_by_texto($texto) {
        $this->db->select('ID_Indice');
        $this->db->from('de_indice');
        $this->db->where('Texto', $texto);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_id_padre_by_indice($id_indice) {
        $this->db->select('ID_Padre');
        $this->db->from('rel_indice');
        $this->db->where('ID_Indice', $id_indice);
        $query = $this->db->get();
        return $query->row()->ID_Padre;
    }
    public function update_indice($id, $data) {
        // Iniciar una transacción
        $this->db->trans_start();

        if ($data['Indice_Padre'] == 0 || $data['Indice_Padre'] == 'Seleccione un índice padre' || $data['Indice_Padre'] == null) {
            // Actualizar el registro en la tabla 'de_indice'
            $this->db->where('ID_Indice', $id);
            $this->db->update('de_indice', array('Texto' => $data['Texto'], 'Orden' => $data['Orden']));
        }else{
            // Actualizar el registro en la tabla 'de_indice'
            $this->db->where('ID_Indice', $id);
            $this->db->update('de_indice', array('Texto' => $data['Texto'], 'Orden' => $data['Orden']));

            // Actualizar el registro en la tabla 'rel_indice'
            $this->db->where('ID_Indice', $id);
            $this->db->update('rel_indice', array('ID_Padre' => $data['Indice_Padre']));
        }
    
        // Completar la transacción
        $this->db->trans_complete();
    
        // Verificar si la transacción fue exitosa
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function update_mat_sec_suj($id, $mat, $sec, $suj) {
        $this->db->where('ID_MatSec', $id);
        return $this->db->update('de_mat_sec_suj', [
            'Materias' => $mat,
            'Sectores' => $sec,
            'SujetosRegulados' => $suj
        ]);
    }

    public function update_nom_reg_art_link($id, $nomReg, $art, $link) {
        $this->db->where('ID_Fun', $id);
        return $this->db->update('de_fundamento', [
            'Nombre' => $nomReg,
            'Articulo' => $art,
            'Link' => $link
        ]);
    }

    public function update_sector($id_regulacion) {
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->update('rel_nat_reg', ['ID_sector' => null]);
    }

    public function update_subsector($id_regulacion) {
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->update('rel_nat_reg', ['ID_subsector' => null]);
    }

    public function update_rama($id_regulacion) {
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->update('rel_nat_reg', ['ID_rama' => null]);
    }

    public function update_subrama($id_regulacion) {
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->update('rel_nat_reg', ['ID_subrama' => null]);
    }

    public function update_clase($id_regulacion) {
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->update('rel_nat_reg', ['ID_clase' => null]);
    }

    public function get_id_regulacion_by_name($name_regulacion) {
        $this->db->select('ID_Regulacion');
        $this->db->from('ma_regulacion');
        $this->db->where('Nombre_Regulacion', $name_regulacion);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->ID_Regulacion;
        } else {
            return false;
        }
    }
    public function delete_regulacion_derivada_manual($name_regulacion) {
        $this->db->where('nombre', $name_regulacion);
        return $this->db->delete('cat_regulacion_derivada_manual');
    }
    
    public function delete_derivada_reg($id_regulacion) {
        $this->db->where('ID_Regulacion', $id_regulacion);
        return $this->db->delete('derivada_reg');
    }
    
}