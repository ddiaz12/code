<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('EstadisticasModel');
        $this->load->model('NotificacionesModel');
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

        // Renderizar la vista usando Blade
        $this->blade->render('estadisticas/estadisticas', $data);
    }
}