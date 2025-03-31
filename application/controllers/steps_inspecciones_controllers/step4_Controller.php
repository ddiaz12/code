<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class step4_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cargar el modelo específico para el step 4
        $this->load->model('steps_inspecciones_models/step4_Model');
        // Cargar librerías y helpers si es necesario
        $this->load->helper(['form', 'url']);
    }

    // Función para guardar los datos del Step 4
    public function guardar() {
        // Recoger el ID de la inspección (por ejemplo, vía POST)
        $id_inspeccion = $this->input->post('ID_inspeccion');
        
        // Preparar los datos principales para la tabla rel_ins_mas_detalles
        $dataMasDetalles = [
            'Costo_Inspeccion' => $this->input->post('Costo_Inspeccion'),
            'ID_Tramite'       => $this->input->post('ID_Tramite'),
            'Requisitos_Archivo'=> $this->input->post('Requisitos_Archivo'),
            'Tiempo_Valor'     => $this->input->post('Tiempo_Valor'),
            'ID_Tipo_Tiempo'   => $this->input->post('ID_Tipo_Tiempo'),
            'Pasos_Inspector'  => $this->input->post('Pasos_Inspector'),
            'Formato_Sujeto_Obligado_Nombre' => $this->input->post('Formato_Sujeto_Obligado_Nombre'),
            'Formato_Sujeto_Obligado_Archivo'=> $this->input->post('Formato_Sujeto_Obligado_Archivo')
        ];
        
        // Guardar datos principales
        $this->step4_Model->guardar_mas_detalles($id_inspeccion, $dataMasDetalles);

        // Guardar facultades (se espera que se envíen como un arreglo)
        $facultades = $this->input->post('Facultades'); // Nombre del campo de facultades
        if(!empty($facultades) && is_array($facultades)){
            $this->step4_Model->guardar_facultades($id_inspeccion, $facultades);
        }
        
        // Guardar regulaciones (arreglo de arreglos: ['Nombre_Regulacion' => ..., 'URL_Regulacion' => ...])
        $regulaciones = $this->input->post('Regulaciones');
        if(!empty($regulaciones) && is_array($regulaciones)){
            $this->step4_Model->guardar_regulaciones($id_inspeccion, $regulaciones);
        }
        
        // Guardar sanciones (arreglo de arreglos con ID_Sancion, Otra_Sancion y URL_Sancion)
        $sanciones = $this->input->post('Sanciones');
        if(!empty($sanciones) && is_array($sanciones)){
            $this->step4_Model->guardar_sanciones($id_inspeccion, $sanciones);
        }
        
        // Guardar servidores (arreglo de arreglos con Nombre_Servidor y URL_Ficha)
        $servidores = $this->input->post('Servidores');
        if(!empty($servidores) && is_array($servidores)){
            $this->step4_Model->guardar_servidores($id_inspeccion, $servidores);
        }
        
        // Redirigir o responder con mensaje de éxito
        $this->session->set_flashdata('success', 'Datos del Step 4 guardados correctamente.');
        redirect('InspeccionesController/form/'.$id_inspeccion);
    }
}
