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
					<h3 class="titulo-login my-4">Restablecer contraseña</h3>
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
					<?php echo form_open('auth/reset_password/' . $code);?>

					<div class="form-floating mb-3">
						<input class="form-control" type="password" name="new" id="new" value=""
							placeholder="Nueva contraseña"/>
						<label
							for="new">Nueva contraseña</label>
					</div>

					<div class="form-floating mb-3">
						<input class="form-control" type="password" name="new_confirm" id="new_confirm" value=""
							placeholder="Confirmar nueva contraseña"/>
						<label
							for="new_confirm">Confirmar contraseña</label>
					</div>

					<?php echo form_input($user_id);?>
					<?php echo form_hidden($csrf); ?>

					<div class="d-flex align-items-center justify-content-end mt-4 mb-0">
						<button type="submit"
							class="btn btn-primary">Cambiar</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection