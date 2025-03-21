<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->config('ftp_config');
    }


    private function connectFTP()
    {
        $config = $this->config->item('ftp');
        $this->ftp->connect($config);
    }

    private function disconnectFTP()
    {
        $this->ftp->close();
    }

    public function list()
    {
        // Obtener la lista de archivos desde el directorio
        $files = glob('./assets/guias/*.pdf');
        $fileData = [];

        foreach ($files as $file) {
            $fileData[] = [
                'nombre' => basename($file),
                'url' => base_url('assets/guias/' . basename($file)),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $fileData]);
    }

    public function upload_pdf()
    {
        header('Content-Type: application/json');
        $user = $this->ion_auth->user()->row();
        $userId = $user->id;
        try {
            if (!empty($_FILES['userfile'])) {
                // Llama a tu método de subida de archivos por FTP
                $uploadResult = $this->uploadFile($_FILES['userfile'], $userId); // Reemplaza con el ID del usuario real

                if ($uploadResult['status'] === 'success') {
                    $filePath = base_url($uploadResult['file_path']); // URL del archivo para mostrarlo o descargarlo

                    // Responder con datos del archivo
                    echo json_encode([
                        'success' => true,
                        'data' => [
                            'nombre' => $_FILES['userfile']['name'],
                            'url' => $filePath,
                        ],
                    ]);
                } else {
                    throw new Exception($uploadResult['file_error']);
                }
            } else {
                throw new Exception('No se seleccionó ningún archivo para subir.');
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function uploadFile($file, $userId)
    {
        // Validación y subida del archivo
        try {
            if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) {
                $allowed_types = ['application/pdf']; // Define los tipos de archivos permitidos
                $max_size = 4096; // Define el tamaño máximo del archivo en KB

                if ($_FILES['userfile']['error'] !== UPLOAD_ERR_OK) {
                    switch ($_FILES['userfile']['error']) {
                        case UPLOAD_ERR_INI_SIZE:
                            throw new Exception('El archivo excede el tamaño máximo permitido por el servidor.');
                        case UPLOAD_ERR_FORM_SIZE:
                            throw new Exception('El archivo excede el tamaño máximo permitido por el formulario.');
                        case UPLOAD_ERR_PARTIAL:
                            throw new Exception('El archivo solo se subió parcialmente.');
                        case UPLOAD_ERR_NO_FILE:
                            throw new Exception('No se seleccionó ningún archivo.');
                        case UPLOAD_ERR_NO_TMP_DIR:
                            throw new Exception('No se encontró la carpeta temporal.');
                        case UPLOAD_ERR_CANT_WRITE:
                            throw new Exception('No se pudo escribir el archivo en el disco.');
                        case UPLOAD_ERR_EXTENSION:
                            throw new Exception('Una extensión de PHP detuvo la subida del archivo.');
                        default:
                            throw new Exception('Error desconocido al subir el archivo.');
                    }
                }

                if ($_FILES['userfile']['size'] > $max_size * 1024) {
                    throw new Exception('El tamaño del archivo no debe exceder los 4 MB.');
                }
                if (!in_array($_FILES['userfile']['type'], $allowed_types)) {
                    throw new Exception('Archivo no permitido. Solo se permiten archivos PDFs y que el tamaño del archivo 
                    no sea mayor a 4MB.');
                }

                // Subir el archivo por FTP antes de registrar el usuario
                $this->connectFTP();

                // Directorio de destino en el servidor FTP
                $upload_path = 'assets/guias/';

                // Nombre del archivo en el servidor
                $file_name = $this->formatFileName($file['name'], $userId);
                $file_tmp = $file['tmp_name'];

                // Subir el archivo al servidor FTP
                if ($this->ftp->upload($file_tmp, $upload_path . $file_name, 'auto')) {
                    $file_path = $upload_path . $file_name;
                    $this->disconnectFTP();
                    return ['status' => 'success', 'file_path' => $file_path];
                } else {
                    throw new Exception('Error al subir el archivo por FTP.');
                }
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'file_error' => $e->getMessage()];
        }
        return ['status' => 'success'];
    }

    private function formatFileName($name, $userId)
    {
        // Obtener la extensión del archivo
        $extension = pathinfo($name, PATHINFO_EXTENSION);

        // Obtener el nombre sin la extensión
        $nameWithoutExtension = pathinfo($name, PATHINFO_FILENAME);

        // Reemplazar espacios y caracteres no alfanuméricos por guiones bajos
        $nameWithoutExtension = preg_replace('/[^a-zA-Z0-9]/', '_', $nameWithoutExtension);

        // Convertir a minúsculas
        $nameWithoutExtension = strtolower($nameWithoutExtension);

        // Obtener fecha actual sin la hora
        $date = date('Ymd');

        // Añadir la fecha y id al nombre del archivo
        $newName = $nameWithoutExtension . '_' . $userId . '_' . $date . '.' . $extension;

        return $newName;
    }

    public function delete()
    {
        header('Content-Type: application/json');
    
        $fileName = $this->input->post('nombre');
        $filePath = 'assets/guias/' . $fileName; // Ruta relativa en el servidor FTP
    
        try {
            $this->connectFTP();
    
            if ($this->ftp->delete_file($filePath)) {
                $this->disconnectFTP();
                echo json_encode(['success' => true, 'message' => 'Archivo eliminado correctamente.']);
            } else {
                $this->disconnectFTP();
                echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el archivo. Verifique los permisos del servidor.']);
            }
        } catch (Exception $e) {
            $this->disconnectFTP();
            echo json_encode(['success' => false, 'message' => 'Error al conectar con el servidor FTP: ' . $e->getMessage()]);
        }
    }

}