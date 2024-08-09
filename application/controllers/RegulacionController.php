<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegulacionController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('RegulacionModel');
    }

    public function index()
    {
        $this->regulaciones();
    }

    public function regulaciones(){
        $this->blade->render('regulaciones/regulaciones2');
    }

    public function caracteristicas_reg(){
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
    public function mat_exentas(){
        $this->blade->render('regulaciones/materias-exentas');
    }
    public function nat_regulaciones(){
        $this->blade->render('regulaciones/nat-regulacioes');
    }

    public function search() {
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
        $maxValues = $this->RegulacionModel->getMaxValues();
        echo json_encode($maxValues);
    }

    public function insertarRegulacion() {
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

    public function obtenerMaxIDCaract() {
        $this->load->database();
        $query = $this->db->query("SELECT MAX(ID_caract) as maxID FROM de_regulacion_caracteristicas");
        $result = $query->row();
        echo $result->maxID;
    }

    public function insertarCaracteristicas() {
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
            'Vigencia' => $this->input->post('Vigencia')
        );

        $this->db->insert('de_regulacion_caracteristicas', $data);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
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
            $Nombre = $this->input->post('nombre',true);
            $Ambito_Aplicacion = $this->input->post('sujeto');
            $ID_tOrdJur = $this->input->post('unidad');
            $Fecha_Exp = $this->input->post('fecha_expedicion');
            $Fecha_Act = $this->input->post('fecha_act');
            $Vigencia = $this->input->post('campoExtra');
            $Orden_Gob = $this->input->post('orden', true);
            $ID_Aplican = $this->input->post('inputVialidad', true);
            $ID_Emiten  = $this->input->post('Aut_emiten');
            $ID_Indice  = $this->input->post('num_exterior');
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