<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegulacionController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('RegulacionModel');
    }

    public function index()
    {
        $this->regulaciones();
    }

    public function regulaciones()
    {
        $this->blade->render('regulaciones/regulaciones2');
    }

    public function caracteristicas_reg()
    {
        $data['tipos_ordenamiento'] = $this->RegulacionModel->getTiposOrdenamiento2();
        $data['indices'] = $this->RegulacionModel->getIndices();
        // Imprime los datos en la consola
        echo '<script>';
        echo 'console.log(' . json_encode($data['tipos_ordenamiento']) . ');';
        echo 'console.log(' . json_encode($data['indices']) . ');';
        echo '</script>';
        // Depura el contenido de $data['tipos_ordenamiento']


        $this->blade->render('regulaciones/caracteristicas-regulaciones', $data);
    }

    public function mat_exentas()
    {
        $this->blade->render('regulaciones/materias-exentas');
    }
    
    public function nat_regulaciones()
    {
        $this->blade->render('regulaciones/nat-regulacioes');
    }

    public function search()
    {
        $query = $this->input->get('query');
        $results = $this->RegulacionModel->search_tipo_dependencia($query);
        echo json_encode($results);
    }

    /*
    public function index()
    {
        $regulaciones = $this->RegulacionModel->get_regulaciones();
        // Asegurarse de que $regulaciones siempre sea un array.
        if (!is_array($regulaciones)) {
            $regulaciones = [];
        }
        $data['regulaciones'] = $regulaciones;
        // Depuración: Imprimir el contenido de $regulaciones
        error_log(print_r($regulaciones, true));
        return view('consulta-regulaciones', ['regulaciones' => $regulaciones]);
        $this->load->view('ciudadania/consulta-regulaciones', $data);
    }
    */
    public function getMaxValues() {
        $this->load->model('RegulacionModel');
        $maxValues = $this->RegulacionModel->getMaxValues();
        echo json_encode($maxValues);
    }

    public function insertarRegulacion()
    {
        $formData = $this->input->post();


        // Verificar que los índices existan en formData
        if (!isset($formData['nombre']) || !isset($formData['campoExtra']) || !isset($formData['objetivoReg'])) {
            echo json_encode(array('status' => 'error', 'message' => 'Datos incompletos'));
            return;
        }

        // Obtener el ID más grande y sumar 1
        $maxID = $this->RegulacionModel->getMaxID();
        $newID = $maxID + 1;

        // Preparar los datos para insertar
        $data = array(
            'ID_Regulacion' => $newID,
            'ID_tRegulacion' => NULL,
            'Nombre_Regulacion' => $formData['nombre'],
            'Homoclave' => 'R-IPR-CHH-0-IPR-001',
            'Estatus' => 1,
            'Vigencia' => $formData['campoExtra'],
            'Objetivo_Reg' => $formData['objetivoReg']
        );

        // Insertar los datos
        $this->RegulacionModel->insertRegulacion($data);

        // Responder a la solicitud AJAX
        echo json_encode(array('status' => 'success'));
    }

    public function obtenerMaxIDRegulacion() {
        $maxID = $this->RegulacionModel->getMaxID();
        $newID = $maxID;
        echo $newID;
    }

    public function obtenerMaxIDCaract()
    {
        $this->load->database();
        $query = $this->db->query("SELECT MAX(ID_caract) as maxID FROM de_regulacion_caracteristicas");
        $result = $query->row();
        echo $result->maxID;
    }

    public function insertarCaracteristicas()
    {
        $this->load->database();
        $data = array(
            'ID_caract' => $this->input->post('ID_caract'),
            'ID_Regulacion' => $this->input->post('ID_Regulacion'),
            'ID_tOrdJur' => $this->input->post('ID_tOrdJur'),
            'Nombre' => $this->input->post('Nombre'),
            'Ambito_Aplicacion' => $this->input->post('Ambito_Aplicacion'),
            'Fecha_Exp' => $this->input->post('Fecha_Exp'),
            'Fecha_Publi' => $this->input->post('Fecha_Publi'),
            'Fecha_Vigor' => $this->input->post('Fecha_Vigor'),
            'Fecha_Act' => $this->input->post('Fecha_Act'),
            'Vigencia' => $this->input->post('Vigencia'),
            'Orden_Gob' => $this->input->post('Orden_Gob')
        );

        $this->db->insert('de_regulacion_caracteristicas', $data);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function insertarRelAutoridadesEmiten() {
        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los datos de la solicitud POST
        $ID_Emiten = $this->input->post('ID_Emiten');
        $ID_Caract = $this->input->post('ID_Caract');

        // Validar los datos
        if (empty($ID_Emiten) || empty($ID_Caract)) {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
            return;
        }

        // Preparar los datos para la inserción
        $data = [
            'ID_Emiten' => $ID_Emiten,
            'ID_Caract' => $ID_Caract
        ];

        // Insertar en la base de datos
        $inserted = $this->RegulacionModel->insertarRelAutoridadesEmiten($data);

        // Devolver una respuesta
        if ($inserted) {
            echo json_encode(['status' => 'success', 'message' => 'Relación insertada correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al insertar la relación']);
        }
    }

    public function insertarRelAutoridadesAplican() {
        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los datos de la solicitud POST
        $ID_Aplican = $this->input->post('ID_Aplican');
        $ID_Caract = $this->input->post('ID_Caract');

        // Validar los datos
        if (empty($ID_Aplican) || empty($ID_Caract)) {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
            return;
        }

        // Preparar los datos para la inserción
        $data = [
            'ID_Aplican' => $ID_Aplican,
            'ID_Caract' => $ID_Caract
        ];

        // Insertar en la base de datos
        $inserted = $this->RegulacionModel->insertarRelAutoridadesAplican($data);

        // Devolver una respuesta
        if ($inserted) {
            echo json_encode(['status' => 'success', 'message' => 'Relación insertada correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al insertar la relación']);
        }
    }

    public function insertarDatosTabla() {
        // Obtener los datos enviados por POST
        $datosTabla = $this->input->post('datosTabla');

        // Verificar que los datos no estén vacíos
        if (!empty($datosTabla)) {
            // Insertar cada fila de datos en la base de datos
            foreach ($datosTabla as $fila) {
                $data = array(
                    'ID_Indice' => $fila['ID_Indice'],
                    'ID_caract' => $fila['ID_caract'],
                    'Texto' => $fila['Texto'],
                    'Orden' => $fila['Orden']
                );

                // Llamar al modelo para insertar los datos
                $this->RegulacionModel->insertarDatosTabla($data);
            }

            // Responder con éxito
            echo json_encode(array('status' => 'success'));
        } else {
            // Responder con error si los datos están vacíos
            echo json_encode(array('status' => 'error', 'message' => 'No data provided'));
        }
    }

    public function obtenerMaxIDJerarquia() {
        $maxIDJerarquia = $this->RegulacionModel->obtenerMaxIDJerarquia();
        echo $maxIDJerarquia;
    }

    public function guardarRelIndice() {
        $data = $this->input->post('data');
        
        if (!empty($data)) {
            foreach ($data as $entry) {
                $this->db->insert('rel_indice', [
                    'ID_Jerarquia' => $entry['ID_Jerarquia'],
                    'ID_Indice' => $entry['ID_Indice'],
                    'ID_Padre' => $entry['ID_Padre']
                ]);
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data to save']);
        }
    }

    public function verificarIDIndice() {
        $ID_Indice = $this->input->post('ID_Indice');
        $this->load->model('RegulacionModel');
        $exists = $this->RegulacionModel->verificarIDIndice($ID_Indice);
        echo json_encode(['exists' => $exists]);
    }

    public function insertarRelIndice() {
        // Obtener los datos enviados desde el cliente
        $relIndiceData = $this->input->post('relIndiceData');

        // Verificar que los datos no estén vacíos
        if (!empty($relIndiceData)) {
            // Insertar los datos en la tabla rel_indice
            foreach ($relIndiceData as $data) {
                $insertData = array(
                    'ID_Jerarquia' => $data['ID_Jerarquia'],
                    'ID_Indice' => $data['ID_Indice'],
                    'ID_Padre' => $data['ID_Padre']
                );

                $this->db->insert('rel_indice', $insertData);
            }

            // Enviar una respuesta de éxito
            echo json_encode(array('status' => 'success'));
        } else {
            // Enviar una respuesta de error
            echo json_encode(array('status' => 'error', 'message' => 'No data provided'));
        }
    }

    public function obtenerMateriasYUltimoIDRegulacion() {
        // Obtener los labels enviados desde el cliente
        $labels = $this->input->post('labels');

        // Verificar que los labels no estén vacíos
        if (!empty($labels)) {
            // Buscar los ID_materia correspondientes en la tabla cat_regulacion_materias_gub
            $this->db->select('ID_materia');
            $this->db->from('cat_regulacion_materias_gub');
            $this->db->where_in('Nombre_Materia', $labels);
            $query = $this->db->get();
            $idMaterias = $query->result_array();

            // Buscar el último ID_Regulacion en la tabla ma_regulacion
            $this->db->select_max('ID_Regulacion');
            $query = $this->db->get('ma_regulacion');
            $ultimoIDRegulacion = $query->row()->ID_Regulacion;

            // Enviar una respuesta de éxito con los datos
            echo json_encode(array(
                'status' => 'success',
                'idMaterias' => $idMaterias,
                'ultimoIDRegulacion' => $ultimoIDRegulacion
            ));
        } else {
            // Enviar una respuesta de error
            echo json_encode(array('status' => 'error', 'message' => 'No labels provided'));
        }
    }

    public function insertarRelRegulacionesMaterias() {
        // Obtener los datos enviados desde el cliente
        $idMaterias = $this->input->post('idMaterias');
        $ultimoIDRegulacion = $this->input->post('ultimoIDRegulacion');

        // Verificar que los datos no estén vacíos
        if (!empty($idMaterias) && !empty($ultimoIDRegulacion)) {
            // Insertar los datos en la tabla rel_regulaciones_materias
            foreach ($idMaterias as $materia) {
                $insertData = array(
                    'ID_Regulacion' => $ultimoIDRegulacion,
                    'ID_Materias' => $materia['ID_materia']
                );

                $this->db->insert('rel_regulaciones_materias', $insertData);
            }

            // Enviar una respuesta de éxito
            echo json_encode(array('status' => 'success'));
        } else {
            // Enviar una respuesta de error
            echo json_encode(array('status' => 'error', 'message' => 'No data provided'));
        }
    }

    public function guardar_regulacion()
    {
        $this->form_validation->set_rules(
            'nombre',
            'Nombre',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras.'
            )
        );
        $this->form_validation->set_rules('sujeto', 'Ambito de Aplicacion', 'required');
        $this->form_validation->set_rules('unidad', 'Tipo de ordenamiento jurídico', 'required');
        $this->form_validation->set_rules('fecha_expedicion', 'Fecha de publicación de la regulación', 'required');
        $this->form_validation->set_rules('fecha_act', 'Fecha de última actualización', 'required');
        $this->form_validation->set_rules('orden', 'Orden de gobierno que la emite', 'required');
        $this->form_validation->set_rules('aut_emiten', 'Orden de gobierno que la emite', 'required');
        $this->form_validation->set_rules('objetivoReg', 'Describa el objetivo de la regulación', 'required');


        if ($this->form_validation->run() != FALSE) {
            $ID_caract = $this->input->post('sujeto');
            $ID_Regulacion = $this->input->post('fecha_expedicion');
            $Nombre = $this->input->post('nombre', true);
            $Ambito_Aplicacion = $this->input->post('sujeto');
            $ID_tOrdJur = $this->input->post('unidad');
            $Fecha_Exp = $this->input->post('fecha_expedicion');
            $Fecha_Act = $this->input->post('fecha_act');
            $Vigencia = $this->input->post('campoExtra');
            $Orden_Gob = $this->input->post('orden', true);
            $ID_Aplican = $this->input->post('inputVialidad', true);
            $ID_Emiten = $this->input->post('Aut_emiten');
            $ID_Indice = $this->input->post('num_exterior');
            $Texto = $this->input->post('texto');
            $ID_Jerarquia = $this->input->post('extension');
            $ID_Padre = $this->input->post('indicePadre', true);
            $ID_Hijo = $this->input->post('notas', true);
            $Objetivo_Reg = $this->input->post('objetivoReg');

            $data = array(
                'ID_caract' => $ID_caract,
                'ID_Regulacion' => $ID_Regulacion,
                'Nombre' => $Nombre,
                'Ambito_Aplicacion' => $Ambito_Aplicacion,
                'ID_tOrdJur' => $ID_tOrdJur,
                'Fecha_Exp' => $Fecha_Exp,
                'Fecha_Act' => $Fecha_Act,
                'Vigencia' => $Vigencia,
                'Orden_Gob' => $Orden_Gob,
                'ID_Aplican' => $ID_Aplican,
                'ID_Emiten' => $ID_Emiten,
                'ID_Indice' => $ID_Indice,
                'Texto' => $Texto,
                'ID_Jerarquia' => $ID_Jerarquia,
                'ID_Padre' => $ID_Padre,
                'ID_Hijo' => $ID_Hijo,
                'Objetivo_Reg' => $Objetivo_Reg,
            );

            // Verificar que los horarios estén completos antes de insertar la oficina
            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                foreach ($horarios as $horario) {
                    $aperturas = $horario->apertura;
                    $cierres = $horario->cierre;

                    // Si falta algún dato de apertura o cierre, mostrar mensaje de error
                    if (empty($aperturas) || empty($cierres)) {
                        $response = array('status' => 'error', 'message' => 'Falta información en los campos de apertura o cierre.');
                        echo json_encode($response);
                        return;
                    }
                }
            }

            // Insertar la oficina después de validar los horarios
            $id_oficina = $this->RegulacionModel->insertar_caractRegulacion($data);

            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                foreach ($horarios as $horario) {
                    $dias = $horario->dia;
                    $aperturas = $horario->apertura;
                    $cierres = $horario->cierre;

                    $id_horario = $this->RegulacionModel->insertar_horario($dias, $aperturas, $cierres);

                    // Asociar la oficina con el horario de atención en la tabla rel_oficina_horario
                    $this->RegulacionModel->asociar_oficina_horario($id_oficina, $id_horario);
                }
            }

            $response = array('status' => 'success', 'redirect_url' => 'index');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }
}