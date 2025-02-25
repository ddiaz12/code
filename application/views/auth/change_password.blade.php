@layout('templates/estructuraLogin')
@section('contenido')
@section('css')
<link rel="stylesheet" href="<?php echo site_url('assets/css/login.css'); ?>">
@endsection

<div class="container mt-5">
      <div class="row justify-content-center">
            <div class="col-md-6">
                  <div class="card">
                        <div class="card-header text-center">
                              <h3 class="titulo-login">Cambiar contraseña</h3>
                        </div>
                        <div class="card-body">
                              
                              <div id="infoMessage">
                                    @if (isset($message) && $message)
                                    <div class="alert alert-success">
                                          {{ $message }}
                                    </div>
                                    @endif
                                    @if (isset($error) && $error)
                                    <div class="alert alert-danger">
                                          {{ $error }}
                                    </div>
                                    @endif
                              </div>

                              <?php echo form_open("auth/change_password", ['class' => 'form-horizontal']); ?>

                              <div class="form-group">
                                    <label
                                          for="old_password"><?php echo lang('change_password_old_password_label', 'old_password'); ?></label>
                                    <?php echo form_input($old_password, '', ['class' => 'form-control']); ?>
                              </div>

                              <div class="form-group">
                                    <label
                                          for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length); ?></label>
                                    <?php echo form_input($new_password, '', ['class' => 'form-control']); ?>
                              </div>

                              <div class="form-group">
                                    <label
                                          for="new_password_confirm"><?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm'); ?></label>
                                    <?php echo form_input($new_password_confirm, '', ['class' => 'form-control']); ?>
                              </div>

                              <?php echo form_input($user_id); ?>

                              <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="<?php echo base_url('home'); ?>">Regresar a inicio</a>
                                    <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                              </div>
                              <?php echo form_close(); ?>
                        </div>
                  </div>
            </div>
      </div>
</div>
@endsection