@layout('templates/estructuraLogin')
@section('contenido')
@section('css')

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
                        <?php echo form_input($password); ?>
                        <label for="password"><?php echo lang('login_password_label', 'password'); ?></label>
                    </div>
                    <div class="form-floating mb-3">
                        <?php echo form_checkbox('remember', '1', false, 'id="remember"'); ?>
                        <label for="remember"><?php echo lang('login_remember_label', 'remember'); ?></label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="forgot_password"><?php echo lang('login_forgot_password'); ?></a>
                        <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary"'); ?>
                    </div>
                    <?php echo form_close(); ?>
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
