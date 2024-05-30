@layout('templates/master')
@section('titulo')
    <?php echo lang('index_heading'); ?>
@endsection
@section('navbar')
    @include('templates/navbarAdmin')
@endsection
@section('menu')
    @include('templates/menuAdmin')
@endsection

@section('contenido')
    <!-- Contenido -->
    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?php echo base_url('home/home_admin'); ?>"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active"><i class="fas fa-users me-1"></i><?php echo lang('index_heading'); ?></li>
        </ol>
		<h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>

        <div class="d-flex justify-content-end mb-3">
            <!-- Botón para agregar grupo -->
            <a href="<?php echo base_url('auth/create_group'); ?>" class="btn btn-primary btn-agregarGrupo">
                <i class="fas fa-plus-circle me-1"></i> Crear Grupo
            </a>
            <!-- Botón para agregar usuario -->
            <a href="<?php echo base_url('auth/create_user'); ?>" class="btn btn-primary btn-agregarUsuario">
                <i class="fas fa-plus-circle me-1"></i> Crear Usuario
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="tTabla-color">Nombres</th>
                            <th class="tTabla-color">Apellidos</th>
                            <th class="tTabla-color">Correo electronico</th>
                            <th class="tTabla-color">Grupo</th>
                            <th class="tTabla-color">Estatus</th>
                            <th class="tTabla-color">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($users as $user):?>
                        <tr>
                            <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
								<?php foreach ($user->groups as $group): ?>
								<a href="<?php echo base_url('auth/edit_group/' . $group->id); ?>" class="btn btn-info btn-sm">
									<?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?>
								</a>
							<?php endforeach; ?>
                            </td>
                            <td>
								<?php if ($user->active): ?>
									<a href="<?php echo base_url('auth/deactivate/' . $user->id); ?>" class="btn btn-danger btn-sm">
										<i class="fas fa-times-circle" title="Desactivar usuario"></i>
									</a>
								<?php else: ?>
									<a href="<?php echo base_url('auth/activate/' . $user->id); ?>" class="btn btn-success btn-sm">
										<i class="fas fa-check-circle" title="Activar usuario"></i>
									</a>
								<?php endif; ?>
							</td>
                            <td>
								<a href="<?php echo base_url('auth/edit_user/' . $user->id); ?>" class="btn btn-warning btn-sm">
									<i class="fas fa-edit" title="Editar usuario"></i>
								</a>
							</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Contenido -->
@endsection
@section('js')
    <script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
@endsection
