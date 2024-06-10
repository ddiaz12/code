<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Regulaciones extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            print_r($this->ion_auth->logged_in());
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $this->regulaciones();
    }

    public function regulaciones()
    {
        // Verifica el grupo del usuario y redirige a la vista correspondiente
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/regulaciones');
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('admin/regulaciones');
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/regulaciones');
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }

    public function caracteristicas_reg()
    {
        // Verifica el grupo del usuario y redirige a la vista correspondiente
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/caracteristicas-regulaciones');
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('admin/caracteristicas-regulaciones');
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/caracteristicas-regulaciones');
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }
    public function mat_exentas()
    {
        // Verifica el grupo del usuario y redirige a la vista correspondiente
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/materias-exentas');
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('admin/materias-exentas');
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/materias-exentas');
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }
    public function nat_regulaciones()
    {
        // Verifica el grupo del usuario y redirige a la vista correspondiente
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/nat-regulacioes');
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('admin/nat-regulacioes');
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/nat-regulacioes');
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }

}