<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InspeccionesModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Obtener todas las inspecciones
    public function get_inspecciones() {
        $this->db->select('*');
        $query = $this->db->get('ma_inspeccion'); // Nombre de la tabla en la base de datos
        return $query->result_array();
    }

    // Obtener una inspección por su ID
    public function get_inspeccion_by_id($id) {
        $this->db->where('ID', $id);
        $query = $this->db->get('ma_inspeccion');
        return $query->row_array();
    }

    // Insertar una nueva inspección
    public function insert_inspeccion($data) {
        return $this->db->insert('ma_inspeccion', $data);
    }

    // Actualizar una inspección existente
    public function update_inspeccion($id, $data) {
        if (empty($data)) {
            log_message('error', 'NO HAY DATOS PARA UPDATE en update_inspeccion para ID: ' . $id);
            return false;
        }
        // Usar set() para definir los campos a actualizar
        $this->db->set($data);
        $this->db->where('ID', $id);
        return $this->db->update('ma_inspeccion');
    }

    // Eliminar una inspección
    public function delete_inspeccion($id) {
        $this->db->where('ID', $id);
        return $this->db->delete('ma_inspeccion');
    }
    
    // Obtener sujetos obligados para la vista
    public function get_sujetos_obligados() {
        // Cambiar el nombre de la tabla a "cat_sujeto_obligado"
        $query = $this->db->get('cat_sujeto_obligado');
        return $query->result();
    }
    
    // Obtener tipos de ordenamiento para la vista usando la tabla catalogo
    public function get_tipo_ord_jur() {
        $query = $this->db->get('cat_tipo_ord_jur');
        return $query->result();
    }

    // Guardar fundamentos jurídicos
    public function guardar_fundamentos_juridicos($id_inspeccion, $fundamentos) {
        // Eliminar fundamentos existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('fundamentos_juridicos');

        // Insertar nuevos fundamentos
        foreach ($fundamentos as $fundamento) {
            $fundamento['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('fundamentos_juridicos', $fundamento);
        }
    }

    // Guardar oficinas seleccionadas
    public function guardar_oficinas($id_inspeccion, $oficinas) {
        // Eliminar oficinas existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('oficinas_seleccionadas');

        // Insertar nuevas oficinas
        foreach ($oficinas as $oficina) {
            $oficina['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('oficinas_seleccionadas', $oficina);
        }
    }

    // Guardar sujetos obligados seleccionados
    public function guardar_sujetos_obligados($id_inspeccion, $sujetos) {
        // Eliminar sujetos obligados existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('sujetos_obligados_seleccionados');

        // Insertar nuevos sujetos obligados
        foreach ($sujetos as $sujeto) {
            $sujeto['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('sujetos_obligados_seleccionados', $sujeto);
        }
    }

    // Guardar derechos del sujeto regulado
    public function guardar_derechos($id_inspeccion, $derechos) {
        // Eliminar derechos existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('derechos_sujeto_regulado');

        // Insertar nuevos derechos
        foreach ($derechos as $derecho) {
            $derecho['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('derechos_sujeto_regulado', $derecho);
        }
    }

    // Guardar obligaciones del sujeto regulado
    public function guardar_obligaciones($id_inspeccion, $obligaciones) {
        // Eliminar obligaciones existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('obligaciones_sujeto_regulado');

        // Insertar nuevas obligaciones
        foreach ($obligaciones as $obligacion) {
            $obligacion['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('obligaciones_sujeto_regulado', $obligacion);
        }
    }

    // Guardar facultades del sujeto obligado
    public function guardar_facultades($id_inspeccion, $facultades) {
        // Eliminar facultades existentes para esta inspección
        $this->db->where('id_inspeccion', $id_inspeccion);
        $this->db->delete('facultades_sujeto_obligado');

        // Insertar nuevas facultades
        foreach ($facultades as $facultad) {
            $facultad['id_inspeccion'] = $id_inspeccion;
            $this->db->insert('facultades_sujeto_obligado', $facultad);
        }
    }

    // Obtener todos los tipos de inspección
    public function get_tipos_inspeccion() {
        $this->db->select('ID, Tipo');
        $query = $this->db->get('cat_ins_tipo_inspeccion');
        return $query->result();
    }

    // Obtener destinatarios para la vista
    public function get_destinatarios() {
        $query = $this->db->get('cat_ins_destinatario');
        return $query->result();
    }

    // Obtener caracteres de inspección para la vista
    public function get_caracteres_inspeccion() {
        $query = $this->db->get('cat_ins_inspeccion_es');
        return $query->result();
    }

    // Obtener lugares de realización para la vista
    public function get_lugares_realizacion() {
        $query = $this->db->get('cat_ins_lugar_realizacion');
        return $query->result();
    }

    // Obtener periodicidades para la vista
    public function get_periodicidades() {
        $query = $this->db->get('cat_ins_periodicidad');
        return $query->result();
    }

    // Obtener motivos de inspección para la vista
    public function get_motivos_inspeccion() {
        $query = $this->db->get('cat_ins_motivo_inspeccion');
        return $query->result();
    }

    // Obtener secciones no públicas para la vista
    public function get_cat_ins_secciones_no_publicas() {
        $query = $this->db->get('cat_ins_secciones_no_publicas');
        return $query->result();
    }

    // Unidades Administrativas. Obtener todas las unidades administrativas
    public function getUnidadesAdministrativas() {
        $this->db->select('ID_unidad, nombre'); // Asegúrate de seleccionar las columnas correctas
        $query = $this->db->get('cat_unidad_administrativa'); // Nombre exacto de la tabla
        return $query->result();
    }

    // Método para buscar oficinas
    public function buscarOficina($search_term) {
        $this->db->like('nombre', $search_term);
        $query = $this->db->get('cat_unidad_administrativa');
        return $query->result();
    }

    // Obtener sanciones del catálogo
    public function get_sanciones() {
        $query = $this->db->get('cat_ins_sanciones');
        return $query->result();
    }

    // Obtener tipos de tiempo del catálogo
    public function get_tipos_tiempo() {
        $query = $this->db->get('cat_ins_tiempo_tipo');
        return $query->result();
    }

    public function get_all_inspecciones() {
        // Seleccionar las columnas correctas de la tabla ma_inspeccion
        $this->db->select('ID, Homoclave, Nombre, Modalidad, ID_sujeto, ID_unidad, Estatus, Tipo, Vigencia');
        $query = $this->db->get('ma_inspeccion');
        return $query->result_array();
    }

    // Guardar datos de identificación del Step 1
    public function guardar_datos_identificacion($id_inspeccion, $datos) {
        // Mapeo de claves del formulario a las columnas de la tabla
        $mapping = [
            'Tipo_Inspeccion'          => 'ID_tipo_inspeccion',
            'Ley_Fomento'              => 'Ley_Fomento',
            'Justificacion_Ley_Fomento'=> 'Justificacion_Ley_Fomento',
            'Destinatario'             => 'ID_destinatario',
            'Lugar_Realizacion'        => 'ID_lugar_realizacion',
            'Lugar_Realizacion_Otro'   => 'Lugar_Realizacion_Otro',
            'InspeccionES'             => 'ID_inspeccion_es',
            'Objetivo'                 => 'Objetivo',
            'Palabras_Clave'           => 'Palabras_Clave',
            'Periodicidad'             => 'ID_periodicidad',
            'Motivo_Inspeccion'        => 'ID_motivo_inspeccion',
            'Motivo_Inspeccion_Otro'   => 'Motivo_Inspeccion_Otro',
            'Fundamento_Juridico'      => 'Fundamento_Juridico',
            'Fundamento_Juridico_Otro' => 'Fundamento_Juridico_Otro',
            'Nombre_Servicio_Tramite'  => 'Nombre_Servicio_Tramite',
            'URL_Relacionado'          => 'URL_Relacionado',
            'Tramites'                 => 'ID_Tramites',
            'Fundamento'               => 'ID_Fun'
        ];

        $datosFiltrados = [];
        foreach ($mapping as $formKey => $dbKey) {
            if (isset($datos[$formKey])) {
                $datosFiltrados[$dbKey] = $datos[$formKey];
            }
        }

        // Agregar ID_inspeccion
        $datosFiltrados['ID_inspeccion'] = $id_inspeccion;

        // Eliminar registros previos para este ID_inspeccion
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_datos_identificacion');

        // Insertar el nuevo registro
        return $this->db->insert('rel_ins_datos_identificacion', $datosFiltrados);
    }

    // Guardar datos de la tabla rel_ins_informacion (Step 3)
    public function guardar_info_informacion($id_inspeccion, $info) {
        // Eliminar registros previos para este ID_inspeccion
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_informacion');

        // Mapear campos del formulario a las columnas de la tabla
        $data = [
            'ID_inspeccion'             => $id_inspeccion,
            'Elemento_Inspeccionado'      => isset($info['Elemento_Inspeccionado']) ? $info['Elemento_Inspeccionado'] : '',
            'Otros_Sujetos_Obligados'     => isset($info['Otros_Sujetos_Obligados']) ? $info['Otros_Sujetos_Obligados'] : 'No',
            'Formato_Firma'               => isset($info['Formato_Firma']) ? $info['Formato_Firma'] : 'No',
            'Formato_Archivo'             => isset($info['Formato_Archivo']) ? $info['Formato_Archivo'] : null,
        ];
        return $this->db->insert('rel_ins_informacion', $data);
    }

    // Guardar datos del Step 2: Autoridad Pública
    public function guardar_autoridad_publica($id_inspeccion, $ID_unidad) {
        // Eliminar registros previos para este ID_inspeccion
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_autoridad_publica');
        
        // Insertar el nuevo registro
        $data = [
            'ID_inspeccion' => $id_inspeccion,
            'ID_unidad'     => $ID_unidad
        ];
        return $this->db->insert('rel_ins_autoridad_publica', $data);
    }

    // Guardar datos de la tabla rel_ins_info_derechos
    public function guardar_info_derechos($id_inspeccion, $derechos) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_info_derechos');
        foreach ($derechos as $derecho) {
            $data = [
                'ID_inspeccion' => $id_inspeccion,
                'Derecho'       => $derecho
            ];
            $this->db->insert('rel_ins_info_derechos', $data);
        }
    }

    // Guardar datos de la tabla rel_ins_info_fundamento
    public function guardar_info_fundamento($id_inspeccion, $fundamentos) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_info_fundamento');
        foreach ($fundamentos as $fund) {
            $data = [
                'ID_inspeccion' => $id_inspeccion,
                'Nombre'        => $fund['Nombre'],
                'Articulo'      => $fund['Articulo'],
                'URL'           => isset($fund['URL']) ? $fund['URL'] : null
            ];
            $this->db->insert('rel_ins_info_fundamento', $data);
        }
    }

    // Guardar datos de la tabla rel_ins_info_obligaciones
    public function guardar_info_obligaciones($id_inspeccion, $obligaciones) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_info_obligaciones');
        foreach ($obligaciones as $obligacion) {
            $data = [
                'ID_inspeccion' => $id_inspeccion,
                'Obligacion'    => $obligacion
            ];
            $this->db->insert('rel_ins_info_obligaciones', $data);
        }
    }

    // Guardar datos generales del Step 4: Más detalles
    public function guardar_mas_detalles($id_inspeccion, $data) {
        // Asegurarse de agregar ID_inspeccion al arreglo de datos
        $data['ID_inspeccion'] = $id_inspeccion;
        // Verificar si ya existe un registro para ese ID_inspeccion
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $query = $this->db->get('rel_ins_mas_detalles');
        if ($query->num_rows() > 0) {
            // Actualizar el registro existente
            $this->db->set($data);
            $this->db->where('ID_inspeccion', $id_inspeccion);
            return $this->db->update('rel_ins_mas_detalles');
        } else {
            // Insertar un nuevo registro
            return $this->db->insert('rel_ins_mas_detalles', $data);
        }
    }
    
    // Guardar facultades del Step 4
    public function guardar_mas_detalles_facultades($id_inspeccion, $facultades) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_mas_detalles_facultades');
        foreach ($facultades as $facultad) {
            $this->db->insert('rel_ins_mas_detalles_facultades', [
                'ID_inspeccion' => $id_inspeccion,
                'Facultad' => $facultad
            ]);
        }
    }
    
    // Guardar regulaciones del Step 4
    public function guardar_mas_detalles_regulaciones($id_inspeccion, $regulaciones) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_mas_detalles_regulaciones');
        foreach ($regulaciones as $reg) {
            $this->db->insert('rel_ins_mas_detalles_regulaciones', [
                'ID_inspeccion' => $id_inspeccion,
                'Nombre_Regulacion' => $reg['Nombre_Regulacion'],
                'URL_Regulacion' => isset($reg['URL_Regulacion']) ? $reg['URL_Regulacion'] : null
            ]);
        }
    }
    
    // Guardar sanciones del Step 4
    public function guardar_mas_detalles_sanciones($id_inspeccion, $sanciones) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_mas_detalles_sanciones');
        foreach ($sanciones as $sancion) {
            $this->db->insert('rel_ins_mas_detalles_sanciones', [
                'ID_inspeccion' => $id_inspeccion,
                'ID_Sancion' => $sancion['ID_Sancion'],
                'Otra_Sancion' => isset($sancion['Otra_Sancion']) ? $sancion['Otra_Sancion'] : null,
                'URL_Sancion' => isset($sancion['URL_Sancion']) ? $sancion['URL_Sancion'] : null
            ]);
        }
    }
    
    // Guardar servidores del Step 4
    public function guardar_mas_detalles_servidores($id_inspeccion, $servidores) {
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_mas_detalles_servidores');
        foreach ($servidores as $servidor) {
            $this->db->insert('rel_ins_mas_detalles_servidores', [
                'ID_inspeccion' => $id_inspeccion,
                'Nombre_Servidor' => $servidor['Nombre_Servidor'],
                'URL_Ficha' => isset($servidor['URL_Ficha']) ? $servidor['URL_Ficha'] : null
            ]);
        }
    }

    // Guardar datos de contacto de la Autoridad Pública
    public function guardar_autoridad_contacto($id_inspeccion, $contacto) {
        // Se espera que $contacto sea un array asociativo con 'Direccion' y 'Correo_Electronico'
        $data = [
            'ID_inspeccion'      => $id_inspeccion,
            'Direccion'          => isset($contacto['Direccion']) ? $contacto['Direccion'] : '',
            'Correo_Electronico' => isset($contacto['Correo_Electronico']) ? $contacto['Correo_Electronico'] : ''
        ];
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_autoridad_contacto');
        return $this->db->insert('rel_ins_autoridad_contacto', $data);
    }
    
    public function guardar_autoridad_contacto_impugnacion($id_inspeccion, $impugnacion) {
        // Se espera que $impugnacion sea un array asociativo con las claves:
        // 'Nombre_Regulacion', 'Articulo', 'Parrafo_Numero_Numeral' y 'URL_Regulacion'
        $data = [
            'ID_inspeccion'           => $id_inspeccion,
            'Nombre_Regulacion'       => isset($impugnacion['Nombre_Regulacion']) ? $impugnacion['Nombre_Regulacion'] : '',
            'Articulo'                => isset($impugnacion['Articulo']) ? $impugnacion['Articulo'] : '',
            'Parrafo_Numero_Numeral'  => isset($impugnacion['Parrafo_Numero_Numeral']) ? $impugnacion['Parrafo_Numero_Numeral'] : '',
            'URL_Regulacion'          => isset($impugnacion['URL_Regulacion']) ? $impugnacion['URL_Regulacion'] : ''
        ];
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_autoridad_contacto_impugnacion');
        return $this->db->insert('rel_ins_autoridad_contacto_impugnacion', $data);
    }
    
    public function guardar_autoridad_contacto_telefonos($id_inspeccion, $telefonos) {
        // Se espera que $telefonos sea un array con los números telefónicos
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_autoridad_contacto_telefonos');
        foreach ($telefonos as $numero) {
            $data = [
                'ID_inspeccion'      => $id_inspeccion,
                'Numero_Telefonico'  => $numero
            ];
            $this->db->insert('rel_ins_autoridad_contacto_telefonos', $data);
        }
    }

    // Guardar estadísticas de la inspección (Step 6)
    public function guardar_estadisticas($id_inspeccion, $estadisticas) {
        // Asegurarse de que se incluya ID_dependencia; se puede obtener del formulario o de la sesión
        if (!isset($estadisticas['ID_dependencia']) || empty($estadisticas['ID_dependencia'])) {
            // Ejemplo: asignar la unidad administrativa del usuario logueado
            $estadisticas['ID_dependencia'] = $this->session->userdata('ID_unidad') ?: 1;
        }
        
        // Agregar el ID_inspeccion al array de estadísticas
        $estadisticas['ID_inspeccion'] = $id_inspeccion;
        
        // Calcular Total_Inspecciones si no está definido
        if (!isset($estadisticas['Total_Inspecciones'])) {
            $total = 0;
            foreach (['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'] as $mes) {
                $total += isset($estadisticas[$mes]) ? (int)$estadisticas[$mes] : 0;
            }
            $estadisticas['Total_Inspecciones'] = $total;
        }
        // Eliminar registro previo
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_estadisticas');
        // Insertar nuevas estadísticas
        return $this->db->insert('rel_ins_estadisticas', $estadisticas);
    }
    
    // Guardar información adicional del Step 7
    public function guardar_info_adicional($id_inspeccion, $info) {
        $data = ['Informacion_Adicional' => $info];
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $query = $this->db->get('rel_ins_info_adicional');
        if ($query->num_rows() > 0) {
            // Usar set() explícitamente antes de update()
            $this->db->set($data);
            $this->db->where('ID_inspeccion', $id_inspeccion);
            return $this->db->update('rel_ins_info_adicional');
        } else {
            $data['ID_inspeccion'] = $id_inspeccion;
            return $this->db->insert('rel_ins_info_adicional', $data);
        }
    }

    // Actualizar función para guardar datos de no publicidad (Step 8)
    public function guardar_no_publicidad($id_inspeccion, $no_publicidad) {
        // Suponiendo que $no_publicidad es un valor escalar ('Sí' o 'No')
        // Se obtiene la justificación, por ejemplo, desde $_POST o del arreglo $no_publicidad si se incluye
        $justificacion = isset($_POST['Justificacion_Archivo']) ? $_POST['Justificacion_Archivo'] : null;
        $insertData = [
            'ID_inspeccion'         => $id_inspeccion,
            'Publico'               => $no_publicidad,
            'Justificacion_Archivo' => $justificacion
        ];
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_no_publicidad');
        return $this->db->insert('rel_ins_no_publicidad', $insertData);
    }
    
    // Actualizar función para guardar secciones de no publicidad
    public function guardar_no_publicidad_secciones($id_inspeccion, $secciones) {
        // Se espera que $secciones sea un arreglo de IDs de secciones
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_no_publicidad_secciones');
        foreach ($secciones as $ID_Seccion) {
            $data = [
                'ID_inspeccion' => $id_inspeccion,
                'ID_Seccion'    => $ID_Seccion
            ];
            $this->db->insert('rel_ins_no_publicidad_secciones', $data);
        }
    }

    // Guardar datos de emergencias (Step 9)
    public function guardar_emergencias($id_inspeccion, $datos) {
        // Procesar archivo de Acta_Emergencia_Archivo si se envía
        if (!empty($_FILES['Acta_Emergencia_Archivo']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'pdf|jpg|png';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('Acta_Emergencia_Archivo')) {
                $uploadData = $this->upload->data();
                $datos['Acta_Emergencia_Archivo'] = $uploadData['file_name'];
            }
        }
        // Armar arreglo con los datos necesarios
        $dataToInsert = [
            'ID_inspeccion'   => $id_inspeccion,
            'Es_Emergencia'   => isset($datos['Es_Emergencia']) ? $datos['Es_Emergencia'] : 'No',
            'Justificacion'   => isset($datos['Justificacion']) ? $datos['Justificacion'] : ''
        ];
        if (isset($datos['Acta_Emergencia_Archivo'])) {
            $dataToInsert['Acta_Emergencia_Archivo'] = $datos['Acta_Emergencia_Archivo'];
        }
        // Eliminar registro previo y guardar nuevos datos
        $this->db->where('ID_inspeccion', $id_inspeccion);
        $this->db->delete('rel_ins_emergencias');
        return $this->db->insert('rel_ins_emergencias', $dataToInsert);
    }

}