<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ftp extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('ftp');
        $this->load->library('upload');
        $this->load->library('form_validation');
        
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }
    
    public function index() {
        $data['title'] = 'Subir Archivo';
        $this->blade->render('ftp/ftpTest', $data);
    }
    
    public function upload_file() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|pdf|doc|docx';
        $config['max_size'] = 2048; // Tamaño máximo en KB

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('userfile')) {
            $error = $this->upload->display_errors();
            echo $error;
        } else {
            $data = $this->upload->data();

            // Configuración del servidor FTP
            $ftp_config['hostname'] = '192.168.31.19';
            $ftp_config['username'] = 'test-site';
            $ftp_config['password'] = '*2JMjM7-IQ';
            $ftp_config['port'] = 21;
            $ftp_config['debug'] = TRUE;

            // Conectar al servidor FTP
            if ($this->ftp->connect($ftp_config)) {
                $file_path = './uploads/' . $data['file_name'];
                $ftp_path = 'assets/ftp/' . $data['file_name'];

                // Subir el archivo al servidor FTP
                if ($this->ftp->upload($file_path, $ftp_path, 'auto')) {
                    echo "Archivo subido exitosamente.";
                } else {
                    echo "Error al subir el archivo al servidor FTP.";
                }

                // Cerrar la conexión FTP
                $this->ftp->close();

                // Borrar el archivo del servidor local después de subirlo al servidor FTP
                unlink($file_path);
            } else {
                echo "Error al conectar al servidor FTP.";
            }
        }
    }
}
