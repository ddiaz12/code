<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class step1_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cargar el modelo del step 1
        $this->load->model('steps_inspecciones_models/step1_Model');
        // Cargar helper y librería de formulario si es necesario
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session']);
    }

    // Método para guardar datos del Step 1
    public function guardar() {
        // Validación mínima de campos obligatorios (se puede ampliar)
        $this->form_validation->set_rules('Nombre_Inspeccion', 'Nombre de la Inspección', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('ruta/del/formulario'); // Ajusta la ruta del formulario
        } else {
            // Mapear los datos recibidos a los nombres de las columnas de la tabla
            $datos = [
                'ID_tipo_inspeccion'          => $this->input->post('Tipo_Inspeccion'),
                'Ley_Fomento'                 => $this->input->post('Ley_Fomento'),
                'Justificacion_Ley_Fomento'   => $this->input->post('Justificacion_Ley_Fomento'),
                'ID_destinatario'             => $this->input->post('Destinatario'),
                'ID_lugar_realizacion'        => $this->input->post('Realizada_En'),
                'Lugar_Realizacion_Otro'      => $this->input->post('Especificar_Realizada_En'),
                'ID_inspeccion_es'            => $this->input->post('Caracter_Inspeccion'),
                'Objetivo'                    => $this->input->post('Objetivo'),
                'Palabras_Clave'              => $this->input->post('Palabras_Clave'),
                'ID_periodicidad'             => $this->input->post('Periodicidad'),
                'ID_motivo_inspeccion'        => $this->input->post('Motivo_Inspeccion'),
                'Motivo_Inspeccion_Otro'      => $this->input->post('Especificar_Motivo_Inspeccion'),
                'Fundamento_Juridico'         => $this->input->post('Fundamento_Juridico'),
                'Fundamento_Juridico_Otro'    => $this->input->post('Fundamento_Juridico_Otro'),
                'Nombre_Servicio_Tramite'     => $this->input->post('Nombre_Tramite_Servicio'),
                'URL_Relacionado'             => $this->input->post('URL_Tramite_Servicio'),
                'ID_Tramites'                 => $this->input->post('ID_Tramite'),
                'ID_Fun'                      => $this->input->post('ID_Fundamento')
            ];
            // Obtener el id de la inspección; este valor puede venir de la sesión o del formulario
            $id_inspeccion = $this->input->post('ID_inspeccion');
            // Llamar al método del modelo
            $resultado = $this->step1_Model->guardarDatosIdentificacion($id_inspeccion, $datos);

            // Nuevo: Guardar fundamentos jurídicos (se espera un arreglo enviado desde el formulario)
            $fundamentos = $this->input->post('fundamentos_juridicos'); // Asegúrate de enviar este campo como array
            if (!empty($fundamentos) && is_array($fundamentos)) {
                $this->step1_Model->guardarFundamentosJuridicos($id_inspeccion, $fundamentos);
            }

            if($resultado) {
                $this->session->set_flashdata('success', 'Datos del Step 1 guardados correctamente.');
                // Redirigir al siguiente step o a la vista deseada
                redirect('ruta/al/next_step'); // Ajusta la ruta según corresponda
            } else {
                $this->session->set_flashdata('error', 'Error al guardar los datos.');
                redirect('ruta/del/formulario');
            }
        }
    }
}
