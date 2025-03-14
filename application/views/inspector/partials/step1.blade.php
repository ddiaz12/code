<div id="step-1" class="form-step">
    <!-- Contenido del Step 1 -->
    <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Datos de
        identificación de Inspector(a), Verificador(a) y Visitador(a) Domiciliario(a)</h3>
    <h5 class="alert alert-warning"
        style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
        Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
    </h5>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre(s) de servidor(a) público(a) <span class="text-danger">*</span></label>
                <?php echo form_input([
    'name' => 'nombre',
    'id' => 'nombre',
    'class' => 'form-control',
    'required' => 'required',
    'value' => isset($inspector->nombre) ? $inspector->nombre : ''
]); ?>
            </div>

            <div class="form-group">
                <label for="primer_apellido">Primer Apellido <span class="text-danger">*</span></label>
                <?php echo form_input([
    'name' => 'primer_apellido',
    'id' => 'primer_apellido',
    'class' => 'form-control',
    'required' => 'required',
    'value' => isset($inspector->primer_apellido) ? $inspector->primer_apellido : ''
]); ?>
            </div>

            <div class="form-group">
                <label for="segundo_apellido">Segundo Apellido <span class="text-danger">*</span></label>
                <?php echo form_input([
    'name' => 'segundo_apellido',
    'id' => 'segundo_apellido',
    'class' => 'form-control',
    'required' => 'required',
    'value' => isset($inspector->segundo_apellido) ? $inspector->segundo_apellido : ''
]); ?>
            </div>

            <div class="form-group">
                <label for="fotografia">Fotografía (JPG, PDF o PNG) <span class="text-danger">*</span></label>
                <?php echo form_upload(['name' => 'fotografia', 'id' => 'fotografia', 'class' => 'form-control-file', 'required' => 'required']); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="numero_empleado">Número o clase del empleado <span class="text-danger">*</span></label>
                <?php echo form_input([
    'name' => 'numero_empleado',
    'id' => 'numero_empleado',
    'class' => 'form-control',
    'required' => 'required',
    'value' => isset($inspector->numero_empleado) ? $inspector->numero_empleado : ''
]); ?>
            </div>

            <div class="form-group">
                <label for="cargo">Cargo del servidor público <span class="text-danger">*</span></label>
                <?php echo form_input([
    'name' => 'cargo',
    'id' => 'cargo',
    'class' => 'form-control',
    'required' => 'required',
    'value' => isset($inspector->cargo) ? $inspector->cargo : ''
]); ?>
            </div>

            <div class="form-group">
                <label for="sujeto_obligado">Sujeto Obligado <span class="text-danger">*</span></label>
                <?php
                    // Se asume que $sujetos contiene los registros de "cat_sujeto_obligado"
                    $options = ['' => 'Seleccione un sujeto obligatorio'];
                    if(isset($sujetos)) {
                        foreach($sujetos as $sujeto) {
                            $options[$sujeto->ID_sujeto] = $sujeto->nombre_sujeto;
                        }
                    }
                    echo form_dropdown('sujeto_obligado', $options, isset($inspector->sujeto_obligado) ? $inspector->sujeto_obligado : '', 'class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <label for="unidad_administrativa">Unidad administrativa <span class="text-danger">*</span></label>
                <?php
                    $options = ['' => 'Seleccione una unidad administrativa'];
                    if(isset($unidades)) {
                        foreach($unidades as $unidad) {
                            // Mostrar el campo "nombre" en vez del ID_unidad
                            $options[$unidad->ID_unidad] = $unidad->nombre;
                        }
                    }
                    echo form_dropdown('unidad_administrativa', $options, isset($inspector->unidad_administrativa) ? $inspector->unidad_administrativa : '', 'class="form-control"');
                ?>
            </div>
        </div>
    </div>

    <!-- Nuevo campo: Tipo de nombramiento (obligatorio) -->
    <div class="form-group">
        <label>Tipo de nombramiento <span class="text-danger">*</span></label>
        @if(isset($tipos_nombramiento) && count($tipos_nombramiento) > 0)
            @foreach($tipos_nombramiento as $key => $tipo)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tipo_nombramiento[]" value="{{ $tipo->ID ?? '' }}" @if($key === 0) required @endif>
                    <label class="form-check-label">{{ $tipo->Nombre ?? 'Sin nombre' }}</label>
                </div>
            @endforeach
        @else
            <p class="text-muted">No hay nombramientos disponibles</p>
        @endif
    </div>
</div>