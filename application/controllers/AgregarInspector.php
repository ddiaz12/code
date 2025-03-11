<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgregarInspector extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AgregarInspectorModel');
        $this->load->model('Inspector_model'); // Asegúrate de cargar el modelo aquí
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session']);
        $this->load->model('NotificacionesModel');
    }

    // Método para mostrar la vista "agregarInspector.blade.php"
    public function agregarInspector()
    {
        $this->load->model('OficinaModel'); // Cargar el modelo para sujetos obligados y unidades
        $data['sujetos'] = $this->OficinaModel->getSujetosObligados();
        $data['unidades'] = $this->OficinaModel->getUnidadAdministrativa(); // Obtener unidades administrativas
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        // Carga la vista Blade con un formulario simple
        $this->blade->render('inspector/agregarInspector', $data);
    }

    // Procesa los datos del formulario
    public function guardar()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->agregarInspector();
        } else {
            // Recoger datos del step 1
            $data = [
                'nombre'           => $this->input->post('nombre'),
                'Primer_Apellido'  => $this->input->post('primer_apellido'),
                'Segundo_Apellido' => $this->input->post('segundo_apellido'),
                'Numero_Empleado'  => $this->input->post('numero_empleado'),
                'cargo'            => $this->input->post('cargo'),
                'ID_Sujeto'        => $this->input->post('sujeto_obligado'),
                'ID_Unidad'        => $this->input->post('unidad_administrativa'),
            ];

            // Procesar la carga de la imagen (fotografía) del step 1
            if (isset($_FILES['fotografia']) && !empty($_FILES['fotografia']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size']      = 2048;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('fotografia')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('AgregarInspector/agregarInspector');
                    return;
                } else {
                    $upload_data = $this->upload->data();
                    $data['fotografia'] = $upload_data['file_name'];
                }
            }
            // Guardar step 1 y obtener el nuevo ID_inspector
            $result = $this->AgregarInspectorModel->guardarInspector($data);
            if ($result) {
                $newInspectorId = $this->db->insert_id();
                // Procesar datos del Step 2 (superior jerárquico)
                $dataSuperior = [
                    'ID_inspector' => $newInspectorId,
                    'ID_superior'  => $this->input->post('buscar_superior'),
                    'Telefono'     => $this->input->post('telefono_superior'),
                    'Extension'    => $this->input->post('extension_superior')
                ];
                $this->db->insert('rel_ins_superior_jerarquico', $dataSuperior);

                // Procesar datos del Step 3: No publicidad
                $publicidad = $this->input->post('permitir_publicidad'); // 'si' o 'no'
                $justificanteArchivo = null;
                if (isset($_FILES['justificante_no_publicidad']) && !empty($_FILES['justificante_no_publicidad']['name'])) {
                    $config['upload_path']   = './uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                    $config['max_size']      = 2048;
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('justificante_no_publicidad')) {
                        $upload_data = $this->upload->data();
                        $justificanteArchivo = $upload_data['file_name'];
                    }
                }
                // Insertar registro principal del step 3
                $dataNoPublicidad = [
                    'ID_inspector'      => $newInspectorId,
                    'Publico'           => $publicidad,
                    'Justificante_Archivo' => $justificanteArchivo
                ];
                $this->db->insert('rel_inspectores_no_publicidad', $dataNoPublicidad);

                // Insertar detalle: datos no a publicar
                $datosNoPublicar = $this->input->post('datos_no_publicar'); // array
                if (is_array($datosNoPublicar)) {
                    foreach ($datosNoPublicar as $dato) {
                        $detalle = [
                            'ID_inspector' => $newInspectorId,
                            'Dato'         => $dato
                        ];
                        $this->db->insert('rel_inspectores_no_publicidad_detalle', $detalle);
                    }
                }

                $this->session->set_flashdata('success', 'Se completó el registro');
            } else {
                $this->session->set_flashdata('error', 'Ocurrió un error al guardar la información.');
            }
            redirect('inspectores');
        }
    }

    public function editarInspector($id) {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        $inspector = $this->Inspector_model->getInspectorById($id);
        if (!$inspector) {
            show_404();
        }
        $data['inspector'] = $inspector;
        // Se carga la misma vista que para agregar, pero ahora en modo edición
        $this->blade->render('inspector/agregarInspector', $data);
    }
}
