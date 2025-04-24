<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step3_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('steps_inspecciones_models/Step3_Model');
        $this->load->library('upload');
        $this->load->library('session');
    }

    /**
     * Recibe el POST de step3, guarda info básica, después derechos y obligaciones.
     */
    public function guardar() {
        $id_inspeccion = $this->input->post('ID_inspeccion');

        // 1) Datos básicos
        $info = [
            'Elemento_Inspeccionado'  => $this->input->post('Bien_Elemento'),
            'Otros_Sujetos_Obligados' => $this->input->post('Otros_Sujetos_Participan'),
            'Formato_Firma'           => $this->input->post('Firmar_Formato'),
        ];

        // 2) Subida opcional de Archivo_Formato
        if (!empty($_FILES['Archivo_Formato']['name'])) {
            $config = [
                'upload_path'   => './uploads/inspecciones/step3/',
                'allowed_types' => 'pdf|jpg|png'
            ];
            $this->upload->initialize($config);
            if ($this->upload->do_upload('Archivo_Formato')) {
                $info['Formato_Archivo'] = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                return redirect("InspeccionesController/form/{$id_inspeccion}");
            }
        }

        // 3) Guardar info principal
        $ok = $this->Step3_Model->guardar_informacion($id_inspeccion, $info);

        // 4) Derechos y obligaciones si vienen
        $step3 = $this->input->post('step3');
        if (!empty($step3['derechos'])) {
            $arr = json_decode($step3['derechos'], true);
            $this->Step3_Model->guardar_info_derechos($id_inspeccion, $arr);
        }
        if (!empty($step3['obligaciones'])) {
            $arr = json_decode($step3['obligaciones'], true);
            $this->Step3_Model->guardar_info_obligaciones($id_inspeccion, $arr);
        }

        // 5) Feedback y redirección
        if ($ok) {
            $this->session->set_flashdata('success','Step 3 guardado correctamente.');
        } else {
            $this->session->set_flashdata('error','Error al guardar Step 3.');
        }
        redirect("InspeccionesController/form/{$id_inspeccion}");
    }
}
