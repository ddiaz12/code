<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agregarinspeccion extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->model('AgregarInspeccionModel');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session', 'upload']);
        $this->load->model('NotificacionesModel');
        $this->load->model('visitas_model');
    }

    public function agregarinspeccion($id_inspeccion = null)
    {
        $data = [];
        if ($id_inspeccion) {
            $data['inspeccion'] = $this->visitas_model->get_inspeccion_by_id($id_inspeccion);
        }
    
        //Correo y timer
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
    
        $data['meses'] = [
            'Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
        ];
    
        $data['activeSection'] = $this->input->get('section') ?? 'Datos de identificación';
        $data['sujetos_obligados'] = $this->AgregarInspeccionModel->getSujetosObligados();
        $data['fundamentos_juridicos'] = $this->AgregarInspeccionModel->getFundamentosJuridicos();
        $data['oficinas'] = $this->AgregarInspeccionModel->getOficinasAdministrativas();
    
        $data['success'] = $this->session->flashdata('success');
        $data['error']   = $this->session->flashdata('error');
    
        $this->blade->render('agregarInspeccion/agregarinspeccion', $data);
    }
    
    public function guardar()
    {
        $id = $this->input->post('id_inspeccion');
        $this->form_validation->set_rules('Nombre_Inspeccion', 'Nombre de la Inspección', 'required');
        $this->form_validation->set_rules('Sujeto_Obligado_ID', 'Sujeto Obligado', 'required');
        $this->form_validation->set_rules('Tipo_Inspeccion', 'Tipo de Inspección', 'required');
        $this->form_validation->set_rules('Dirigida_A', 'Dirigida A', 'required');
        $this->form_validation->set_rules('Caracter_Inspeccion', 'Caracter de la Inspección', 'required');
        $this->form_validation->set_rules('Realizada_En', 'Realizada En', 'required');
        $this->form_validation->set_rules('Objetivo', 'Objetivo de la Inspección', 'required');
        $this->form_validation->set_rules('Palabras_Clave', 'Palabras Clave', 'required');
        $this->form_validation->set_rules('Periodicidad', 'Periodicidad', 'required');
        $this->form_validation->set_rules('Motivo_Inspeccion', 'Motivo de la Inspección', 'required');
        $this->form_validation->set_rules('Nombre_Tramite', 'Nombre del Trámite', 'required');
        $this->form_validation->set_rules('URL_Tramite', 'URL del Trámite', 'required|valid_url');
        $this->form_validation->set_rules('Fundamento_Juridico', 'Fundamento Jurídico', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
        } else {
            $data = $this->input->post();
    
            // Subir archivos si existen
            $upload_path = FCPATH . 'uploads/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }
    
            $archivo_formato_name = NULL;
            if (!empty($_FILES['Archivo_Formato']['name'])) {
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size'] = 2048;
                $config['file_name'] = 'formato_' . time();
                $this->upload->initialize($config);
                if ($this->upload->do_upload('Archivo_Formato')) {
                    $archivo_formato_name = $this->upload->data('file_name');
                }
            }
    
            $documento_no_publicidad_name = NULL;
            if (!empty($_FILES['Documento_No_Publicidad']['name'])) {
                $config['file_name'] = 'nopublicidad_' . time();
                $this->upload->initialize($config);
                if ($this->upload->do_upload('Documento_No_Publicidad')) {
                    $documento_no_publicidad_name = $this->upload->data('file_name');
                }
            }
    
            $archivo_declaracion_emergencia_name = NULL;
            if (!empty($_FILES['Archivo_Declaracion_Emergencia']['name'])) {
                $config['file_name'] = 'emergencia_' . time();
                $this->upload->initialize($config);
                if ($this->upload->do_upload('Archivo_Declaracion_Emergencia')) {
                    $archivo_declaracion_emergencia_name = $this->upload->data('file_name');
                }
            }
    
            $data['Archivo_Formato'] = $archivo_formato_name;
            $data['Documento_No_Publicidad'] = $documento_no_publicidad_name;
            $data['Archivo_Declaracion_Emergencia'] = $archivo_declaracion_emergencia_name;
    
            if ($id) {
                $this->AgregarInspeccionModel->update_inspeccion($id, $data);
            } else {
                $this->AgregarInspeccionModel->guardarInspeccion($data);
            }
            echo json_encode(['success' => true, 'message' => 'Inspección guardada correctamente.']);
        }
    }
    public function editar($id) {
        $data['inspeccion'] = $this->visitas_model->obtenerInspeccionPorId($id);

        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        $data['meses'] = [
            'Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
        ];

        $data['activeSection'] = $this->input->get('section') ?? 'Datos de identificación';
        $data['sujetos_obligados'] = $this->AgregarInspeccionModel->getSujetosObligados();
        $data['fundamentos_juridicos'] = $this->AgregarInspeccionModel->getFundamentosJuridicos();

        $this->blade->render('agregarInspeccion/agregarinspeccion', $data);
    }
}