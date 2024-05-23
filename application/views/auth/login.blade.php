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
                    <h3 class="titulo-login my-4">Registro Estatal de Regulaciones</h3>
                </div>
                <div class="card-body">
                    <?php echo form_open('auth/login'); ?>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="identity" id="identity"
                            value="<?php echo set_value('identity'); ?>" placeholder="name@example.com" />
                        <label for="identity">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" id="password" class="form-control"
                            value="<?php echo set_value('password'); ?>" placeholder="Password" />
                        <label for="password">Password</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1"
                            <?php echo set_checkbox('remember', '1'); ?> />
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                      <a class="small" href="forgot_password">Forgot Password?</a>
                      <button type="submit" class="btn btn-primary">Login</button>
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
