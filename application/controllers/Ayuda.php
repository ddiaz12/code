<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayuda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session', 'upload', 'ion_auth']);
        $this->load->model('NotificacionesModel');
        $this->load->model('AyudaModel');

        // Verificar si el usuario está autenticado
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }

    // Mostrar la lista de incidencias
    public function index() {
        // Obtener usuario autenticado
        $user = $this->ion_auth->user()->row();

        // Verificar si el usuario es válido
        if (!$user) {
            $this->session->set_flashdata('error', 'Error al obtener el usuario. Inicia sesión nuevamente.');
            redirect('auth/login');
            return;
        }

        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group ? $group->name : '';

        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['incidents'] = $this->AyudaModel->get_incidents() ?? [];
        $data['projects'] = $this->AyudaModel->get_projects() ?? [];
        $data['reproducibles'] = $this->AyudaModel->get_reproducibles() ?? [];
        $data['severities'] = $this->AyudaModel->get_severities() ?? [];
        $data['classifications'] = $this->AyudaModel->get_classifications() ?? [];
        $data['statuses'] = $this->AyudaModel->get_statuses() ?? [];

        $this->blade->render('ayuda/ayuda', $data);
    }

    // Mostrar el formulario para agregar una nueva incidencia
    public function create() {
        $data['projects'] = $this->AyudaModel->get_projects() ?? [];
        $data['reproducibles'] = $this->AyudaModel->get_reproducibles() ?? [];
        $data['severities'] = $this->AyudaModel->get_severities() ?? [];
        $data['classifications'] = $this->AyudaModel->get_classifications() ?? [];

        $this->blade->render('ayuda/AgregarIncidencia', $data);
    }

    // Guardar una nueva incidencia
    public function store() {
        $this->form_validation->set_rules('title', 'Título', 'required');
        $this->form_validation->set_rules('project', 'Proyecto', 'required');
        $this->form_validation->set_rules('reproducible', 'Reproducible', 'required');
        $this->form_validation->set_rules('severity', 'Gravedad', 'required');
        $this->form_validation->set_rules('classification', 'Clasificación', 'required');

        if (empty($_FILES['files']['name'][0])) {
            echo json_encode(['status' => 'error', 'message' => 'Archivos Anexos es obligatorio.']);
            return;
        }

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $user = $this->ion_auth->user()->row();

        $data = [
            'Titulo'              => $this->input->post('title'),
            'Descripcion'         => $this->input->post('description'),
            'ID_Proyecto'         => $this->input->post('project'),
            'ID_Estatus'          => 1, // Abrir Incidencia por defecto
            'ID_Gravedad'         => $this->input->post('severity'),
            // Asegúrate de que el campo reproducible envíe el ID correspondiente de la tabla cat_incidencias_reproducibilidad
            'ID_Reproducibilidad' => $this->input->post('reproducible'),
            'ID_Clasificacion'    => $this->input->post('classification'),
            'Usuario_Reporte'     => $user ? $user->username : 'Anónimo'
        ];

        if ($this->AyudaModel->create_incident($data)) {
            $incident_id = $this->db->insert_id();
            $this->upload_files($incident_id);
            echo json_encode(['status' => 'success', 'message' => 'Incidencia agregada correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar la incidencia']);
        }
    }

    private function upload_files($incident_id) {
        // Configuración para guardar en la carpeta "uploads"
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'png|jpg|jpeg|pdf|doc|docx';
        $config['max_size']      = 2048; // 2MB

        // Inicializar la librería de subida con la configuración indicada
        $this->load->library('upload', $config);

        $files = $_FILES;
        $count = count($_FILES['files']['name']);

        for ($i = 0; $i < $count; $i++) {
            $_FILES['file']['name']     = $files['files']['name'][$i];
            $_FILES['file']['type']     = $files['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $files['files']['tmp_name'][$i];
            $_FILES['file']['error']    = $files['files']['error'][$i];
            $_FILES['file']['size']     = $files['files']['size'][$i];

            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
                $file_data = [
                    'incident_id'   => $incident_id,
                    'Nombre_Archivo'=> $upload_data['file_name'],
                    'Ruta_Archivo'  => $upload_data['full_path']
                ];
                $this->AyudaModel->save_file($file_data);
            } else {
                // Registrar el error de subida
                log_message('error', $this->upload->display_errors());
            }
        }
    }
}
