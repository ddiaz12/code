<?php
defined('BASEPATH') OR exit('No direct script access allowed'); // Seguridad: evita acceso directo al archivo

class Step1_Controller extends CI_Controller { // Define la clase del controlador

    public function __construct() { // Constructor de la clase
        parent::__construct(); // Llama al constructor padre de CI_Controller
        $this->load->model('steps_inspecciones_models/step1_Model'); // Carga el modelo Step1_Model
        $this->load->helper(['form', 'url']); // Carga los helpers de formularios y URLs
        $this->load->library(['form_validation', 'session']); // Carga las librerías de validación de formularios y sesiones
    }

    public function guardar() { // Método para guardar los datos del formulario Step 1
        // Reglas de validación
        $this->form_validation->set_rules('Tipo_Inspeccion', 'Tipo de Inspección', 'required'); // Campo obligatorio
        $this->form_validation->set_rules('Objetivo', 'Objetivo', 'required'); // Campo obligatorio
        $this->form_validation->set_rules('Palabras_Clave', 'Palabras Clave', 'required'); // Campo obligatorio
        $this->form_validation->set_rules('Periodicidad', 'Periodicidad', 'required'); // Campo obligatorio
        $this->form_validation->set_rules('Motivo_Inspeccion', 'Motivo de Inspección', 'required'); // Campo obligatorio
        $this->form_validation->set_rules('URL_Tramite_Servicio', 'URL Relacionado', 'valid_url'); // Debe ser una URL válida

        $id_inspeccion = $this->input->post('id_inspeccion'); // Obtiene el ID de inspección del formulario

        if ($this->form_validation->run() === FALSE) { // Si la validación falla
            $this->session->set_flashdata('error', validation_errors()); // Guarda los errores en la sesión
            redirect("inspecciones/form/{$id_inspeccion}#step-1"); // Redirige al usuario al paso 1 del formulario
            return; // Termina la ejecución del método
        }

        // 1) Armo el array de Datos de Identificación
        $datos = [
            'ID_tipo_inspeccion'       => $this->input->post('Tipo_Inspeccion'), // Obtiene el valor del formulario
            'ID_destinatario'          => $this->input->post('Dirigida_A'),
            'ID_lugar_realizacion'     => $this->input->post('Realizada_En'),
            'Lugar_Realizacion_Otro'   => $this->input->post('Especificar_Realizada_En'),
            'ID_inspeccion_es'         => $this->input->post('Caracter_Inspeccion'),
            'Objetivo'                 => $this->input->post('Objetivo'),
            'Palabras_Clave'           => $this->input->post('Palabras_Clave'),
            'ID_periodicidad'          => $this->input->post('Periodicidad'),
            'ID_motivo_inspeccion'     => $this->input->post('Motivo_Inspeccion'),
            'Motivo_Inspeccion_Otro'   => $this->input->post('Especificar_Motivo_Inspeccion'),
            'Fundamento_Juridico'      => $this->input->post('Fundamento_Juridico'),
            'Fundamento_Juridico_Otro' => $this->input->post('Fundamento_Juridico_Otro'),
            'Nombre_Servicio_Tramite'  => $this->input->post('Nombre_Tramite_Servicio'),
            'URL_Relacionado'          => $this->input->post('URL_Tramite_Servicio'),
            'ID_Tramites'              => $this->input->post('ID_Tramites'),
            'ID_Fun'                   => $this->input->post('ID_Fun'),
        ];

        // 2) Guardar en rel_ins_datos_identificacion
        $this->Step1_Model->guardarDatosIdentificacion($id_inspeccion, $datos); // Llama al modelo para guardar los datos

        // 3) Fundamentos jurídicos
        $fundJson    = $this->input->post('fundamentos'); // Obtiene los fundamentos jurídicos en formato JSON
        $fundamentos = $fundJson ? json_decode($fundJson, true) : []; // Decodifica el JSON a un array
        if (!empty($fundamentos)) { // Si hay fundamentos jurídicos
            $this->Step1_Model->guardarFundamentosJuridicos($id_inspeccion, $fundamentos); // Llama al modelo para guardarlos
        }

        // 4) Redirigir al paso 2
        $this->session->set_flashdata('success', 'Step 1 guardado correctamente.'); // Mensaje de éxito en la sesión
        redirect("inspecciones/form/{$id_inspeccion}#step-2"); // Redirige al usuario al paso 2 del formulario
    }
}
