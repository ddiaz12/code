<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserActionsLogger
{
    public function log_action()
    {
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->library('ion_auth');

        // Obtener el usuario actual
        $user = $CI->ion_auth->user()->row();
        $current_user_email = null;

        if ($user) {
            $current_user_email = $user->email;
        } else {
            // Registrar el error si el usuario no se encuentra
            log_message('error', 'No se pudo obtener el usuario actual.');
        }

        // Verificar que el email del usuario actual no sea nulo
        if ($current_user_email) {
            // Obtener el controlador y método actuales
            $controller = $CI->router->class;
            $method = $CI->router->method;

            // Definir la tabla afectada y operación en función del controlador y método
            $tabla_afectada = '';
            $operacion = '';

            if ($controller === 'auth') {
                switch ($method) {
                    case 'edit_user':
                        $tabla_afectada = 'users';
                        $operacion = 'UPDATE';
                        break;
                    case 'create_user':
                        $tabla_afectada = 'users';
                        $operacion = 'INSERT';
                        break;
                    case 'ocultar':
                        $tabla_afectada = 'users';
                        $operacion = 'DELETE';
                        break;
                    case 'edit_group':
                        $tabla_afectada = 'groups';
                        $operacion = 'UPDATE';
                        break;
                    case 'create_group':
                        $tabla_afectada = 'groups';
                        $operacion = 'INSERT';
                        break;

                }
            }

            // Monitorear el controlador 'oficinas'
            if ($controller === 'oficinas') {
                switch ($method) {
                    case 'insertar':
                        $tabla_afectada = 'ma_oficinas_administrativa';
                        $operacion = 'INSERT';
                        break;
                    case 'editar':
                        $tabla_afectada = 'ma_oficinas_administrativa';
                        $operacion = 'UPDATE';
                        break;
                    case 'eliminar':
                        $tabla_afectada = 'ma_oficinas_administrativa';
                        $operacion = 'DELETE';
                        break;
                }
            }

            // Insertar en la tabla logs si hay una operación registrada
            if ($tabla_afectada !== '' && $operacion !== '') {
                $CI->db->insert('senecolog.log', [
                    'Usuario' => $current_user_email,
                    'Tabla_afectada' => $tabla_afectada,
                    'Operacion' => $operacion
                ]);
            }
        } else {
            // Registrar el error si el email del usuario actual es nulo
            log_message('error', 'El email del usuario actual es nulo.');
        }
    }
}
