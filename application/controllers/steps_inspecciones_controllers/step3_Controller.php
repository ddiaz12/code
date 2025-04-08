<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Step3_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cargar el modelo del step3
        $this->load->model('steps_inspecciones_models/step3_Model');
        $this->load->library('upload');
    }

    // Método para guardar datos del Step 3
    public function guardar() {
        $id_inspeccion = $this->input->post('ID_inspeccion'); // asegurarse de enviarlo en el formulario
        // Recolectar datos básicos
        $data = [
            'Elemento_Inspeccionado' => $this->input->post('Elemento_Inspeccionado'),
            'Otros_Sujetos_Obligados' => $this->input->post('Otros_Sujetos_Obligados'),
            'Formato_Firma'         => $this->input->post('Formato_Firma')
        ];

        // Procesar archivo si se envía
        if (!empty($_FILES['Formato_Archivo']['name'])) {
            $config['upload_path']   = './uploads/inspecciones/step3'; // Ruta actualizada
            $config['allowed_types'] = 'pdf|jpg|png';
            $this->upload->initialize($config);
            if ($this->upload->do_upload('Formato_Archivo')) {
                $uploadData = $this->upload->data();
                $data['Formato_Archivo'] = $uploadData['file_name'];
            } else {
                // Opcional: manejar error de carga
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('ruta/del/formulario');
            }
        } else {
            $data['Formato_Archivo'] = null;
        }

        // Guardar la información usando el modelo
        if ($this->step3_Model->guardar_informacion($id_inspeccion, $data)) {
            // Si se envían derechos desde el Step 3
            if (isset($_POST['step3']['derechos'])) {
                $derechosJson = $_POST['step3']['derechos'];
                $derechosArray = json_decode($derechosJson, true);
                $this->step3_Model->guardar_info_derechos($id_inspeccion, $derechosArray);
            }
            $this->session->set_flashdata('success', 'Datos del Step 3 guardados correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Error al guardar los datos del Step 3.');
        }
        // Redirigir al paso o a la vista correspondiente
        redirect('InspeccionesController/form/' . $id_inspeccion);
    }
}
