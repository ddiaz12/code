<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
class Comentarios extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ComentariosModel');
    }

    public function index()
    {
    }

    public function guardarComentario() {
        $comentario = $this->input->post('comentario');
        $idRegulacion = $this->input->post('idRegulacion');
        $idUsuario = $this->ion_auth->user()->row()->id; // Obtener el ID del usuario autenticado

        if (!empty($comentario) && !empty($idRegulacion)) {
            $data = [
                'ID_Regulacion' => $idRegulacion,
                'comentario' => $comentario,
                'id' => $idUsuario,
                'fecha_creacion' => date('Y-m-d H:i:s')
            ];

            $this->ComentariosModel->insertarComentario($data);
            echo json_encode(['status' => 'success', 'message' => 'Comentario guardado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar el comentario']);
        }
    }


    public function obtenerComentarios() {
        $idRegulacion = $this->input->post('id');
        $comentarios = $this->ComentariosModel->obtenerComentariosPorRegulacion($idRegulacion);
    
        // Generar el HTML para los comentarios
        if (!empty($comentarios)) {
            foreach ($comentarios as $comentario) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($comentario->comentario) . '</td>';
                echo '<td>' . htmlspecialchars($comentario->usuario) . '</td>';
                echo '<td>' . date('Y-m-d H:i:s', strtotime($comentario->fecha_creacion)) . '</td>';
                echo '<td>';
                echo '<button class="btn btn-danger btn-sm btn-eliminar-comentario" data-id="' . $comentario->ID_comentario . '">Eliminar</button>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="3">No se encontraron comentarios.</td></tr>';
        }
    }
    
    public function eliminarComentario() {
        $idComentario = $this->input->post('id');
        $this->ComentariosModel->eliminarComentario($idComentario);
        echo json_encode(['status' => 'success', 'message' => 'Comentario eliminado correctamente']);
    }

}