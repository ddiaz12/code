<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('EstadisticasModel');
        $this->load->model('NotificacionesModel');
        $this->load->model('InspeccionDetalladaModel');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session', 'upload', 'ion_auth']);
    }

    public function index() {
        // Verificar si el usuario está logueado (Ion Auth)
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        // Ejemplo de obtener usuario y grupo
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;

        // Notificaciones no leídas, si aplica
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        // Definir el arreglo de meses para pasarlo a la vista
        $data['months'] = [
            'Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
        ];

        // Obtener datos de inspeccion_detallada
        $inspecciones_detalladas = $this->InspeccionDetalladaModel->get_all_inspecciones();

        // Calcular el total de inspecciones desde enero hasta diciembre
        foreach ($inspecciones_detalladas as &$inspeccion) {
            $inspeccion['Total'] = $inspeccion['Enero_Inspecciones'] + $inspeccion['Febrero_Inspecciones'] + $inspeccion['Marzo_Inspecciones'] +
                                   $inspeccion['Abril_Inspecciones'] + $inspeccion['Mayo_Inspecciones'] + $inspeccion['Junio_Inspecciones'] +
                                   $inspeccion['Julio_Inspecciones'] + $inspeccion['Agosto_Inspecciones'] + $inspeccion['Septiembre_Inspecciones'] +
                                   $inspeccion['Octubre_Inspecciones'] + $inspeccion['Noviembre_Inspecciones'] + $inspeccion['Diciembre_Inspecciones'];
        }

        // Obtener datos de estadisticas
        $estadisticas = $this->EstadisticasModel->get_all_estadisticas();

        // Combinar datos de inspeccion_detallada y estadisticas
        foreach ($estadisticas as &$estadistica) {
            foreach ($inspecciones_detalladas as $inspeccion) {
                if (isset($inspeccion['Fecha_Estadistica']) && $estadistica['Fecha_Estadistica'] == $inspeccion['Fecha_Estadistica']) {
                    $estadistica['updated_at'] = $inspeccion['updated_at'];
                    break;
                }
            }
        }

        $data['inspecciones_detalladas'] = $estadisticas;

        // Obtener la última actualización
        $ultima_actualizacion = $this->EstadisticasModel->get_ultima_actualizacion();
        $data['ultima_actualizacion'] = $ultima_actualizacion;

        // Renderizar la vista usando Blade
        $this->blade->render('estadisticas/estadisticas', $data);
    }

    public function guardar() {
        // Verificar si el usuario está logueado (Ion Auth)
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        // Validar los datos del formulario
        $this->form_validation->set_rules('enero', 'Enero', 'required|integer');
        $this->form_validation->set_rules('febrero', 'Febrero', 'required|integer');
        $this->form_validation->set_rules('marzo', 'Marzo', 'required|integer');
        $this->form_validation->set_rules('abril', 'Abril', 'required|integer');
        $this->form_validation->set_rules('mayo', 'Mayo', 'required|integer');
        $this->form_validation->set_rules('junio', 'Junio', 'required|integer');
        $this->form_validation->set_rules('julio', 'Julio', 'required|integer');
        $this->form_validation->set_rules('agosto', 'Agosto', 'required|integer');
        $this->form_validation->set_rules('septiembre', 'Septiembre', 'required|integer');
        $this->form_validation->set_rules('octubre', 'Octubre', 'required|integer');
        $this->form_validation->set_rules('noviembre', 'Noviembre', 'required|integer');
        $this->form_validation->set_rules('diciembre', 'Diciembre', 'required|integer');
        $this->form_validation->set_rules('sanciones', 'Sanciones', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            // Si hay errores de validación, establecer mensaje de error
            $this->session->set_flashdata('error', 'Por favor, complete todos los campos requeridos.');
            $this->index();
        } else {
            // Tomar los datos del POST
            $data = [
                'Fecha_Estadistica' => date('Y-m-d'),
                'Enero_Inspecciones' => $this->input->post('enero'),
                'Febrero_Inspecciones' => $this->input->post('febrero'),
                'Marzo_Inspecciones' => $this->input->post('marzo'),
                'Abril_Inspecciones' => $this->input->post('abril'),
                'Mayo_Inspecciones' => $this->input->post('mayo'),
                'Junio_Inspecciones' => $this->input->post('junio'),
                'Julio_Inspecciones' => $this->input->post('julio'),
                'Agosto_Inspecciones' => $this->input->post('agosto'),
                'Septiembre_Inspecciones' => $this->input->post('septiembre'),
                'Octubre_Inspecciones' => $this->input->post('octubre'),
                'Noviembre_Inspecciones' => $this->input->post('noviembre'),
                'Diciembre_Inspecciones' => $this->input->post('diciembre'),
                'Ultima_Actualizacion' => date('Y-m-d H:i:s'),
                'Sanciones' => $this->input->post('sanciones'),
                'Total' => $this->input->post('enero') + $this->input->post('febrero') + $this->input->post('marzo') +
                           $this->input->post('abril') + $this->input->post('mayo') + $this->input->post('junio') +
                           $this->input->post('julio') + $this->input->post('agosto') + $this->input->post('septiembre') +
                           $this->input->post('octubre') + $this->input->post('noviembre') + $this->input->post('diciembre')
            ];

            // Llamamos al modelo para guardar
            if ($this->EstadisticasModel->insert_estadistica($data)) {
                $this->session->set_flashdata('success', 'Estadísticas guardadas correctamente.');
            } else {
                $this->session->set_flashdata('error', 'Hubo un error al guardar las estadísticas.');
            }
            // Redirigir a la vista principal de estadísticas o a donde quieras
            redirect('estadisticas');
        }
    }
}