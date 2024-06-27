@layout('templates/estructuraLogin')
@section('contenido')
@section('css')
<link rel="stylesheet" href="<?php echo site_url('assets/css/login.css'); ?>">
@endsection
<div class="container">
      <div class="row justify-content-center">
            <div class="col-lg-5">
                  <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                              <h3 class="titulo-login my-4">Recuperar contraseña</h3>
                        </div>
                        <div class="card-body">
                              <div class="small mb-3 text-muted">Ingresa tu dirección de correo electrónico y te
                                    enviaremos un enlace para restablecer tu contraseña.</div>
                              @if ($message)
                              <div class="alert alert-danger">
                                    {{ $message }}
                              </div>
                              @endif
                              <?php echo form_open('auth/forgot_password'); ?>
                              <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="identity" id="identity" value="<?php echo set_value('identity'); ?>" placeholder="name@example.com" />
                                    <label for="identity">Correo electronico</label>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="<?php echo base_url('auth/login'); ?>">Regresar a inicio de
                                          sesion</a>
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                              </div>
                              <?php echo form_close(); ?>
                        </div>
                        <div class="card-footer text-center py-3">
                              <div class="small">
                                    <a href="register.html">Need an account? Sign up!</a>
                              </div>
                        </div>
                        <div class="card-footer text-center py-3">
                              <div class="small">
                                    <a href="register_user"><?php echo lang('login_register'); ?></a>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>
@endsection