<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oficinas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OficinaModel');
    }

    public function oficina()
    {
        $data["oficinas"] = $this->OficinaModel->getOficinas();
        $this->blade->render('sujeto/oficinas', $data);
    }

    public function agregar_oficina()
    {
        $data['sujetos'] = $this->OficinaModel->getSujetosObligados();
        $data['unidades'] = $this->OficinaModel->getUnidadAdministrativa();
        $data['vialidades'] = $this->OficinaModel->getCatVialidades();
        $data['municipios'] = $this->OficinaModel->getCatMunicipios();
        $data['localidades'] = $this->OficinaModel->getCatLocalidades();
        $this->blade->render('sujeto/agregar-oficina', $data);
    }

    public function insertar()
    {
        $datosFormulario = $this->input->post('json1');
        $horarios = $this->input->post('json2');

        if ($datosFormulario != null) {
            foreach ($datosFormulario as $dato) {
                $datos[$dato['name']] = $dato['value'];
            }

            // Recoge los datos del formulario
            $data = array(
                'ID_sujeto' => isset($datos['sujeto']) ? $datos['sujeto'] : null,
                'ID_unidad' => isset($datos['unidad']) ? $datos['unidad'] : null,
                'ID_localidad' => isset($datos['localidad']) ? $datos['localidad'] : null,
                'ID_asentamiento' => isset($datos['tipo_asentamiento']) ? $datos['tipo_asentamiento'] : null,
                'ID_nAsentamiento' => isset($datos['nombre_asentamiento']) ? $datos['nombre_asentamiento'] : null,
                'ID_vialidad' => isset($datos['tipo_vialidad']) ? $datos['tipo_vialidad'] : null,
                'ID_municipio' => isset($datos['municipio']) ? $datos['municipio'] : null,
                'nombre' => isset($datos['nombre']) ? $datos['nombre'] : null,
                'Siglas' => isset($datos['siglas']) ? $datos['siglas'] : null,
                'Nombre_Vialidad' => isset($datos['nombre_vialidad']) ? $datos['nombre_vialidad'] : null,
                'Num_interior' => isset($datos['num_interior']) ? $datos['num_interior'] : null,
                'Num_Exterior' => isset($datos['num_exterior']) ? $datos['num_exterior'] : null,
                'c_p' => isset($datos['codigo_postal']) ? $datos['codigo_postal'] : null,
                'NumTel_Oficial' => isset($datos['inputNumTel']) ? $datos['inputNumTel'] : null,
                'Extension' => isset($datos['extension']) ? $datos['extension'] : null,
                'Correo_Elec' => isset($datos['email']) ? $datos['email'] : null,
                'Notas' => isset($datos['notas']) ? $datos['notas'] : null,
            );

            $id_oficina = $this->OficinaModel->insertar_oficina($data);

            // Obtener los datos del formulario
            foreach ($horarios as $horario) {
                $dias = $horario['dia'];
                $aperturas = $horario['apertura'];
                $cierres = $horario['cierre'];

                $id_horario = $this->OficinaModel->insertar_horario($dias, $aperturas, $cierres);

                // Asociar la oficina con el horario de atención en la tabla rel_oficina_horario
                $this->OficinaModel->asociar_oficina_horario($id_oficina, $id_horario);
            }
            $response = array('status' => 'success', 'redirect_url' => 'oficina');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'message' => 'No se han recibido datos del formulario');
            echo json_encode($response);
        }
    }

    public function editar($id)
    {
        $data['oficinas'] = $this->OficinaModel->getOficinaEditar($id);
        $data['horarios'] = $this->OficinaModel->getHorariosOficina($id);
        $data['sujetos'] = $this->OficinaModel->getSujetosObligados();
        $data['unidades'] = $this->OficinaModel->getUnidadAdministrativa();
        $data['vialidades'] = $this->OficinaModel->getCatVialidades();
        $data['municipios'] = $this->OficinaModel->getCatMunicipios();
        $data['localidades'] = $this->OficinaModel->getCatLocalidades();
        $this->blade->render('sujeto/editar-oficina', $data);
    }


    public function eliminar($id)
    {
        $this->OficinaModel->eliminarOficina($id);
        redirect('oficinas/oficina');
    }

    public function actualizar()
    {
        $datosFormulario = $this->input->post('json1');
        $horarios = $this->input->post('json2');
        $horariosEliminados = $this->input->post('json3');

        if ($datosFormulario != null) {
            foreach ($datosFormulario as $dato) {
                $datos[$dato['name']] = $dato['value'];
            }

            $id_oficina = $datos['id_oficina'];

            // Recoge los datos del formulario
            $data = array(
                'ID_sujeto' => isset($datos['sujeto']) ? $datos['sujeto'] : null,
                'ID_unidad' => isset($datos['unidad']) ? $datos['unidad'] : null,
                'ID_localidad' => isset($datos['localidad']) ? $datos['localidad'] : null,
                'ID_asentamiento' => isset($datos['tipo_asentamiento']) ? $datos['tipo_asentamiento'] : null,
                'ID_nAsentamiento' => isset($datos['nombre_asentamiento']) ? $datos['nombre_asentamiento'] : null,
                'ID_vialidad' => isset($datos['tipo_vialidad']) ? $datos['tipo_vialidad'] : null,
                'ID_municipio' => isset($datos['municipio']) ? $datos['municipio'] : null,
                'nombre' => isset($datos['nombre']) ? $datos['nombre'] : null,
                'Siglas' => isset($datos['siglas']) ? $datos['siglas'] : null,
                'Nombre_Vialidad' => isset($datos['nombre_vialidad']) ? $datos['nombre_vialidad'] : null,
                'Num_interior' => isset($datos['num_interior']) ? $datos['num_interior'] : null,
                'Num_Exterior' => isset($datos['num_exterior']) ? $datos['num_exterior'] : null,
                'c_p' => isset($datos['codigo_postal']) ? $datos['codigo_postal'] : null,
                'NumTel_Oficial' => isset($datos['inputNumTel']) ? $datos['inputNumTel'] : null,
                'Extension' => isset($datos['extension']) ? $datos['extension'] : null,
                'Correo_Elec' => isset($datos['email']) ? $datos['email'] : null,
                'Notas' => isset($datos['notas']) ? $datos['notas'] : null,
            );

            $this->OficinaModel->actualizar_oficina($id_oficina, $data);

            // Eliminar los horarios de la oficina
            if ($horariosEliminados != null) {
                foreach ($horariosEliminados as $idhorario) {
                    $this->OficinaModel->eliminarHorarios($idhorario);
                }
            }

            // Insertar los horarios de la oficina
            if ($horarios != null) {
                foreach ($horarios as $horario) {
                    $dias = $horario['dia'];
                    $aperturas = $horario['apertura'];
                    $cierres = $horario['cierre'];

                    $id_horario = $this->OficinaModel->insertar_horario($dias, $aperturas, $cierres);

                    // Asociar la oficina con el horario de atención en la tabla rel_oficina_horario
                    $this->OficinaModel->asociar_oficina_horario($id_oficina, $id_horario);
                }
            }

            $response = array('status' => 'success');
            echo json_encode($response);
        }else{
            $response = array('status' => 'error', 'message' => 'No se han recibido datos del formulario');
            echo json_encode($response);
        }
    }
}
