<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step1_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('steps_inspecciones_models/step1_Model');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session']);
    }

    public function guardar() {
        // Reglas de validación
        $this->form_validation->set_rules('Tipo_Inspeccion', 'Tipo de Inspección', 'required');
        $this->form_validation->set_rules('Objetivo', 'Objetivo', 'required');
        $this->form_validation->set_rules('Palabras_Clave', 'Palabras Clave', 'required');
        $this->form_validation->set_rules('Periodicidad', 'Periodicidad', 'required');
        $this->form_validation->set_rules('Motivo_Inspeccion', 'Motivo de Inspección', 'required');
        $this->form_validation->set_rules('URL_Tramite_Servicio', 'URL Relacionado', 'valid_url');

        $id_inspeccion = $this->input->post('id_inspeccion');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect("inspecciones/form/{$id_inspeccion}#step-1");
            return;
        }

        // 1) Armo el array de Datos de Identificación
        $datos = [
            'ID_tipo_inspeccion'       => $this->input->post('Tipo_Inspeccion'),
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
        $this->Step1_Model->guardarDatosIdentificacion($id_inspeccion, $datos);

        // 3) Fundamentos jurídicos
        $fundJson    = $this->input->post('fundamentos');
        $fundamentos = $fundJson ? json_decode($fundJson, true) : [];
        if (!empty($fundamentos)) {
            $this->Step1_Model->guardarFundamentosJuridicos($id_inspeccion, $fundamentos);
        }

        // 4) Redirigir al paso 2
        $this->session->set_flashdata('success', 'Step 1 guardado correctamente.');
        redirect("inspecciones/form/{$id_inspeccion}#step-2");
    }
}
