@layout('templates/master')
@section('titulo')
{{ isset($inspeccion) ? 'Editar Inspección' : 'Agregar Inspección' }}
@endsection
@section('navbar')
@include('templates/navbarAdmin')
@endsection
@section('menu')
@include('templates/menuAdmin')
@endsection
@section('contenido')
@if (!empty($success))
    <div class="alert alert-success">
        {{ $success }}
    </div>
@endif
@if (!empty($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif
<div class="container-fluid mt-4">
    <ol class="breadcrumb mb-4 mt-5" style="margin-left: 5px;">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url('home'); ?>" class="text-decoration-none">
                <i class="fas fa-home me-1"></i>Home
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo base_url('visitas'); ?>" class="text-decoration-none">
                <i class="fas fa-file-alt me-1"></i>Inspecciones
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <i class="fas fa-plus-circle me-1"></i>{{ isset($inspeccion) ? 'Editar Inspección' : 'Agregar Inspección' }}
        </li>
    </ol>

    <div class="row">
        <!-- Sidebar Wizard -->
        <div class="col-md-3 sidebar-wizard">
            <div class="list-group">
                <?php
$steps = [
    ["label" => "Datos de identificación", "icon" => "fa-solid fa-id-card"],
    ["label" => "Autoridad Pública", "icon" => "fa-solid fa-user-shield"],
    ["label" => "Información sobre la inspección", "icon" => "fa-solid fa-file-alt"],
    ["label" => "Más detalles", "icon" => "fa-solid fa-info-circle"],
    ["label" => "Información de la Autoridad Pública y Contacto", "icon" => "fa-solid fa-building"],
    ["label" => "Estadísticas", "icon" => "fa-solid fa-chart-bar"],
    ["label" => "Información adicional", "icon" => "fa-solid fa-list"],
    ["label" => "No publicidad", "icon" => "fa fa-user-secret"],
    ["label" => "Emergencias", "icon" => "fa-solid fa-exclamation-triangle"]
];

foreach ($steps as $index => $step) {
    $stepNumber = $index + 1;
    echo '<button class="list-group-item list-group-item-action wizard-step" data-step="' . $stepNumber . '">
            <i class="' . $step["icon"] . ' me-2"></i>' .
        $step["label"] .
        '</button>';
}
                ?>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 main-content">
            <script>
                $(document).ready(function () {
                    $('label').css('font-weight', 'bold');
                });
            </script>

            <div class="form-container">
                <form id="inspeccionForm" method="post" action="<?= base_url('Agregarinspeccion/guardar'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_inspeccion" value="{{ isset($inspeccion) ? $inspeccion->id_inspeccion : '' }}">
                    <!-- Campo oculto para el ID de la inspección -->
                    <input type="hidden" name="id_inspeccion" value="{{ isset($inspeccion) ? $inspeccion->id_inspeccion : '' }}">

                    <div class="form-step" id="step-1">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Datos de identificación</h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <div class="form-group">
                            <label><b>Homoclave</b></label>
                            {{ form_input(['name' => 'Homoclave', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Homoclave : 'I-IPR-CTIH-0-IPR-0002', 'readonly' => true]) }}
                        </div>
                        <div class="form-group">
                            <label><b>Nombre de la Inspección</b><span class="text-danger">*</span></label>
                            {{ form_input(['name' => 'Nombre_Inspeccion', 'class' => 'form-control', 'required' => 'required', 'value' => isset($inspeccion) ? $inspeccion->Nombre_Inspeccion : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Modalidad (si existe)</label>
                            {{ form_input(['name' => 'Modalidad', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Modalidad : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label><b>Sujeto Obligado</b><span class="text-danger">*</span></label>
                            <select name="Sujeto_Obligado_ID" class="form-control" required>
                                <option value="">Selecciona un Sujeto Obligado</option>
                                @foreach($sujetos_obligados as $so)
                                    <option value="{{ $so->ID_sujeto }}" {{ isset($inspeccion) && $inspeccion->Sujeto_Obligado_ID == $so->ID_sujeto ? 'selected' : '' }}>{{ $so->nombre_sujeto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tipo de inspección/verificación/visita</label>
                            {{ form_input(['name' => 'Tipo_Inspeccion', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Tipo_Inspeccion : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>¿La inspección va dirigida a?</label>
                            <select name="Dirigida_A" class="form-control">
                                <option value="">Selecciona</option>
                                <option value="Físicas" {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Físicas' ? 'selected' : '' }}>Personas físicas</option>
                                <option value="Morales" {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Morales' ? 'selected' : '' }}>Personas morales</option>
                                <option value="Ambas" {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Ambas' ? 'selected' : '' }}>Ambas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>La Inspección es (Ordinaria, Extraordinaria, etc.)</label>
                            {{ form_input(['name' => 'Caracter_Inspeccion', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Caracter_Inspeccion : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>¿Dónde se realiza la Inspección?</label>
                            {{ form_input(['name' => 'Realizada_En', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Realizada_En : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Objetivo de la Inspección<span class="text-danger">*</span></label>
                            {{ form_textarea(['name' => 'Objetivo', 'class' => 'form-control', 'rows' => 3, 'required' => true, 'value' => isset($inspeccion) ? $inspeccion->Objetivo : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Palabras Clave</label>
                            {{ form_textarea(['name' => 'Palabras_Clave', 'class' => 'form-control', 'rows' => 2, 'value' => isset($inspeccion) ? $inspeccion->Palabras_Clave : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Periodicidad (Ej. Mensual, Trimestral)</label>
                            {{ form_input(['name' => 'Periodicidad', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Periodicidad : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Especificar qué motiva la Inspección</label>
                            {{ form_textarea(['name' => 'Motivo_Inspeccion', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Motivo_Inspeccion : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Si la inspección es motivada por un Trámite o Servicio, menciona cuáles</label>
                            {{ form_textarea(['name' => 'Tramites_Servicios', 'class' => 'form-control', 'rows' => 2, 'value' => isset($inspeccion) ? $inspeccion->Tramites_Servicios : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Tamaño de empresa (número de trabajadores)</label>
                            {{ form_input(['name' => 'Tamano_Empresa', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Tamano_Empresa : '' ]) }}
                        </div>
                        <div class="form-group" id="criterio-container">
                            <label>¿Existe algún criterio que defina a qué sujeto regulado se aplica?</label>
                            <div>
                                <label>
                                    <input type="radio" name="Existe_Criterio_Radio" id="Existe_Criterio_Si" value="si" 
                                    {{ (isset($inspeccion) && isset($inspeccion->Existe_Criterio_Radio) && $inspeccion->Existe_Criterio_Radio == 'si') ? 'checked' : '' }}> Sí
                                </label>
                                <label>
                                    <input type="radio" name="Existe_Criterio_Radio" id="Existe_Criterio_No" value="no" 
                                    {{ (!isset($inspeccion) || (isset($inspeccion->Existe_Criterio_Radio) && $inspeccion->Existe_Criterio_Radio == 'no')) ? 'checked' : '' }}> No
                                </label>
                            </div>
                            <label>Describir el criterio</label>
                            <textarea name="Criterio_Descripcion" class="form-control" rows="3" id="Criterio_Descripcion">{{ isset($inspeccion) ? $inspeccion->Criterio_Descripcion : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>¿Se inspecciona a sujetos que hayan recibido resolución de algún trámite?</label>
                            <select name="Inspecciona_Sujetos_Resolucion" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Inspecciona_Sujetos_Resolucion == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Inspecciona_Sujetos_Resolucion == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                            <label>Nombre Trámite o Servicio</label>
                            {{ form_input(['name' => 'Nombre_Tramite_Servicio_Resol', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Nombre_Tramite_Servicio_Resol : '' ]) }}
                            <label>Añadir enlace (http)</label>
                            {{ form_input(['name' => 'Enlace_Tramite_Servicio_Resol', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Enlace_Tramite_Servicio_Resol : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>¿Existe un fundamento jurídico?</label>
                            <select name="Fundamento_Juridico" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Fundamento_Juridico == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Fundamento_Juridico == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                            <label>Nombre del trámite/fundamento</label>
                            {{ form_input(['name' => 'Nombre_Tramite_Fundamento', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Nombre_Tramite_Fundamento : '' ]) }}
                            <label>Añadir enlace (http)</label>
                            {{ form_input(['name' => 'Enlace_Fundamento', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Enlace_Fundamento : '' ]) }}
                        </div>
                    </div>
                    <div class="form-step" id="step-2">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Autoridad pública</h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <div class="form-group">
                            <label>Unidades Administrativas (JSON o texto)</label>
                            {{ form_textarea(['name' => 'Unidades_Administrativas', 'class' => 'form-control', 'rows' => 3, 'value' => isset($inspeccion) ? $inspeccion->Unidades_Administrativas : '' ]) }}
                            <small class="form-text text-muted">Podrías listar las IDs separadas por coma, o un
                                JSON.</small>
                        </div>
                    </div>
                    <div class="form-step" id="step-3">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Información sobre la inspección</h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <div class="form-group">
                            <label>Bien, elemento o sujeto de la inspección</label>
                            {{ form_textarea(['name' => 'Bien_Elemento', 'class' => 'form-control', 'rows' => 2, 'value' => isset($inspeccion) ? $inspeccion->Bien_Elemento : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>¿Participan otros Sujetos Obligados?</label>
                            <select name="Otros_Sujetos_Participan" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Otros_Sujetos_Participan == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Otros_Sujetos_Participan == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                            <label>Buscar/Agregar Sujeto Obligado Adicional</label>
                            {{ form_textarea(['name' => 'Sujeto_Obligado_Adicional', 'class' => 'form-control', 'rows' => 2, 'value' => isset($inspeccion) ? $inspeccion->Sujeto_Obligado_Adicional : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Derechos del Sujeto Regulado</label>
                            {{ form_textarea(['name' => 'Derechos_Sujeto_Regulado', 'class' => 'form-control', 'rows' => 2, 'value' => isset($inspeccion) ? $inspeccion->Derechos_Sujeto_Regulado : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Obligaciones del Sujeto Regulado</label>
                            {{ form_textarea(['name' => 'Obligaciones_Sujeto_Regulado', 'class' => 'form-control', 'rows' => 2, 'value' => isset($inspeccion) ? $inspeccion->Obligaciones_Sujeto_Regulado : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Requisitos o documentos a presentar</label>
                            {{ form_textarea(['name' => 'Requisitos_Inspeccion', 'class' => 'form-control', 'rows' => 2, 'value' => isset($inspeccion) ? $inspeccion->Requisitos_Inspeccion : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>¿Debe rellenar o firmar algún formato?</label>
                            <select name="Firmar_Formato" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Firmar_Formato == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Firmar_Formato == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                            <label>Subir formato (jpg, png, pdf)</label>
                            <input type="file" name="Archivo_Formato" class="form-control-file">
                            <label>¿El formato se encuentra fundamentado jurídicamente?</label>
                            <select name="Formato_Fundamento" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Formato_Fundamento == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Formato_Fundamento == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>¿Tiene algún costo?</label>
                            <select name="Tiene_Costo" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Tiene_Costo == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Tiene_Costo == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                            <label>Detalle costo/conceptos</label>
                            {{ form_textarea(['name' => 'Detalle_Costo', 'class' => 'form-control', 'rows' => 2, 'value' => isset($inspeccion) ? $inspeccion->Detalle_Costo : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Pasos a realizar (puedes guardarlos en un JSON o texto)</label>
                            {{ form_textarea(['name' => 'Pasos', 'class' => 'form-control', 'rows' => 3, 'value' => isset($inspeccion) ? $inspeccion->Pasos : '' ]) }}
                        </div>
                    </div>
                    <div class="form-step" id="step-4">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Más detalles</h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <div class="form-group">
                            <label>Materia de la inspección (Ambiental, Laboral, etc.)</label>
                            {{ form_input(['name' => 'Materia_Inspeccion', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Materia_Inspeccion : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Sector / Subsector / Rama / Subrama / Clase</label>
                            {{ form_input(['name' => 'Sector', 'class' => 'form-control mb-2', 'placeholder' => 'Sector', 'value' => isset($inspeccion) ? $inspeccion->Sector : '' ]) }}
                            {{ form_input(['name' => 'Subsector', 'class' => 'form-control mb-2', 'placeholder' => 'Subsector', 'value' => isset($inspeccion) ? $inspeccion->Subsector : '' ]) }}
                            {{ form_input(['name' => 'Rama', 'class' => 'form-control mb-2', 'placeholder' => 'Rama', 'value' => isset($inspeccion) ? $inspeccion->Rama : '' ]) }}
                            {{ form_input(['name' => 'Subrama', 'class' => 'form-control mb-2', 'placeholder' => 'Subrama', 'value' => isset($inspeccion) ? $inspeccion->Subrama : '' ]) }}
                            {{ form_input(['name' => 'Clase', 'class' => 'form-control', 'placeholder' => 'Clase', 'value' => isset($inspeccion) ? $inspeccion->Clase : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>¿Es posible avisar previamente?</label>
                            <select name="Aviso_Previo" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Aviso_Previo == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Aviso_Previo == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                            <label>Valor del plazo</label>
                            {{ form_input(['name' => 'Valor_Plazo', 'type' => 'number', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Valor_Plazo : '' ]) }}
                            <label>Unidad de medida (días, semanas...)</label>
                            {{ form_input(['name' => 'Unidad_Medida_Plazo', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Unidad_Medida_Plazo : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>¿Qué tipo de sanciones pueden derivar?</label>
                            {{ form_input(['name' => 'Tipo_Sancion', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Tipo_Sancion : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>¿Las sanciones están fundamentadas jurídicamente?</label>
                            <select name="Sanciones_Fundamento" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Sanciones_Fundamento == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Sanciones_Fundamento == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-step" id="step-5">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Información de la Autoridad Pública y Contacto</h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <div class="form-group">
                            <label>Facultades, atribuciones y obligaciones del Inspector</label>
                            {{ form_textarea(['name' => 'Facultades_Inspector', 'class' => 'form-control', 'rows' => 3, 'value' => isset($inspeccion) ? $inspeccion->Facultades_Inspector : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Las Inspecciones se realizan a través de:</label>
                            {{ form_textarea(['name' => 'Metodo_Inspecciones', 'class' => 'form-control', 'rows' => 2, 'value' => isset($inspeccion) ? $inspeccion->Metodo_Inspecciones : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>¿Existe un contacto directo para quejas?</label>
                            <select name="Contacto_Quejas" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Contacto_Quejas == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Contacto_Quejas == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                            <label>Datos de contacto (si "Sí")</label>
                            {{ form_input(['name' => 'Contacto_Quejas_Datos', 'class' => 'form-control', 'value' => isset($inspeccion) ? $inspeccion->Contacto_Quejas_Datos : '' ]) }}
                        </div>
                    </div>
                    <div class="form-step" id="step-6">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Estadísticas</h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <h8 class="mb-3">¿Cuántas inspecciones se realizaron en el año anterior por mes?
                            <h8 />
                            <div class="statistics-container">
                                <?php
$meses = [
    ['Enero', 'Febrero', 'Marzo'],
    ['Abril', 'Mayo', 'Junio'],
    ['Julio', 'Agosto', 'Septiembre'],
    ['Octubre', 'Noviembre', 'Diciembre']
];

foreach ($meses as $fila) {
    echo '<div class="statistics-row">';
    foreach ($fila as $mes) {
        echo '<div class="statistics-item">
                            <label class="mes-label">' . $mes . ':</label>
                            <input type="number" name="' . $mes . '_Inspecciones" class="form-control statistics-input" min="0" value="' . (isset($inspeccion) ? $inspeccion->{$mes . '_Inspecciones'} : '0') . '">
                          </div>';
    }
    echo '</div>';
}
            ?>
                            </div>
                    </div>
                    <div class="form-step" id="step-7">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Información adicional</h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <div class="form-group">
                            <label>Información que se considere útil</label>
                            {{ form_textarea(['name' => 'Info_Adicional', 'class' => 'form-control', 'rows' => 3, 'value' => isset($inspeccion) ? $inspeccion->Info_Adicional : '' ]) }}
                        </div>
                    </div>
                    <div class="form-step" id="step-8">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">No publicidad</h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <div class="form-group">
                            <label>¿Permitir que todos los datos sean públicos?</label>
                            <select name="Permitir_Publicidad" class="form-control">
                                <option value="si" {{ !isset($inspeccion) || $inspeccion->Permitir_Publicidad == 'si' ? 'selected' : '' }}>Sí</option>
                                <option value="no" {{ isset($inspeccion) && $inspeccion->Permitir_Publicidad == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Justificante no publicidad (PDF, JPG, PNG)</label>
                            <input type="file" name="Documento_No_Publicidad" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label>Determina la información que NO se puede publicar:</label>
                            <label>Datos de identificación</label>
                            <input type="text" name="No_Publicar_Datos_Identificacion" class="form-control"
                                placeholder="Ej. Homoclave, Nombre..." value="{{ isset($inspeccion) ? $inspeccion->No_Publicar_Datos_Identificacion : '' }}">

                            <label>¿Ocultar contacto de la Autoridad Pública?</label>
                            <select name="No_Publicar_Contacto_Autoridad" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->No_Publicar_Contacto_Autoridad == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->No_Publicar_Contacto_Autoridad == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>

                            <label>Información sobre la inspección</label>
                            <input type="text" name="No_Publicar_Info_Inspeccion" class="form-control" value="{{ isset($inspeccion) ? $inspeccion->No_Publicar_Info_Inspeccion : '' }}">

                            <label>Información de la Autoridad Pública</label>
                            <input type="text" name="No_Publicar_Info_Autoridad" class="form-control" value="{{ isset($inspeccion) ? $inspeccion->No_Publicar_Info_Autoridad : '' }}">

                            <label>Estadísticas</label>
                            <input type="text" name="No_Publicar_Estadisticas" class="form-control" value="{{ isset($inspeccion) ? $inspeccion->No_Publicar_Estadisticas : '' }}">
                        </div>
                    </div>
                    <div class="form-step" id="step-9">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Emergencias</h3>
                        <h5 class="alert alert-warning"
                            style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <div class="form-group"></div>
                            <label>¿La inspección es requerida para atender una situación de emergencia?</label>
                            <select name="Es_Emergencia" class="form-control">
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Es_Emergencia == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Es_Emergencia == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Justificar razones de emergencia</label>
                            {{ form_textarea(['name' => 'Justificacion_Emergencia', 'class' => 'form-control', 'rows' => 3, 'value' => isset($inspeccion) ? $inspeccion->Justificacion_Emergencia : '' ]) }}
                        </div>
                        <div class="form-group">
                            <label>Cargar el oficio o acta de declaración de emergencia (PDF, PNG, JPG)</label>
                            <input type="file" name="Archivo_Declaracion_Emergencia" class="form-control-file">
                        </div>
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="btn" id="prevBtn" onclick="navigateStep(-1)">Anterior</button>
                        <button type="button" class="btn" id="nextBtn" onclick="navigateStep(1)">Siguiente</button>
                        <button type="submit" class="btn" id="submitBtn" style="display:none;">{{ isset($inspeccion) ? 'Actualizar' : 'Guardar' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* --- Global Variables --- */
    :root {
        --primary-color: #8E354A;
        --border-color: #E5E7EB;
        --background-color: #F9FAFB;
        --text-color: #374151;
        --heading-color: #111827;
    }
    
    /* --- General Layout --- */
    .container-fluid {
        background-color: var(--background-color);
        min-height: 100vh;
        padding-top: 1rem;
    }
    .main-content {
        margin-top: 0; /* Cambiado de -100px a 0 */
    }
    .form-container {
        padding: 1.5rem;
        margin-left: 0.5cm;
        margin-right: 0.5cm;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    /* --- Menú / Sidebar Wizard --- */
    .sidebar-wizard {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .wizard-step {
        border: none !important;
        color: var(--text-color);
        padding: 1rem 1.5rem;
        margin-bottom: 0.5rem;
        border-radius: 0.375rem !important;
        transition: all 0.2s;
    }
    .wizard-step:hover {
        background-color: #F3F4F6;
    }
    .wizard-step.active {
        background-color: var(--primary-color) !important;
        color: white;
    }
    
    /* --- Estilos del Formulario --- */
    .form-step {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    .form-step > h3,
    .form-step > h5,
    .form-step > .full-width {
        grid-column: 1 / -1;
    }
    .form-control {
        width: 100%;
        max-width: 500px;
        padding: 0.375rem 0.5rem;
        font-size: 0.9rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    textarea.form-control {
        min-height: 60px;
        max-height: 120px;
        resize: vertical;
    }
    select.form-control {
        width: 100%;
        max-width: 500px;
        padding: 0.375rem 0.5rem;
        font-size: 0.9rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    .form-group {
        margin-bottom: 0.5rem !important;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
        font-weight: bold;
        text-align: left;
        padding-right: 0;
    }
    /* Estilos específicos para el paso 4 */
    #step-4 {
        gap: 0.5rem;
    }
    #step-4 .form-group {
        margin-bottom: 0.2rem !important;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .form-step {
            grid-template-columns: 1fr;
        }
        .statistics-row {
            flex-direction: column;
            gap: 10px;
        }
        .statistics-item {
            width: 100%;
        }
    }
    
    /* --- Botones y Navegación --- */
    .form-navigation {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end; /* Alinea los botones a la derecha */
        gap: 1rem;
        padding-bottom: 1rem; /* Añadir espacio inferior */
    }
    .form-navigation .btn {
        padding: 8px 24px;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.2s;
        border: none;
    }
    #prevBtn {
        background-color: #6B7280;
        color: white;
    }
    #prevBtn:hover {
        background-color: #4B5563;
    }
    #nextBtn {
        background-color: #4A0404;
        color: white;
    }
    #nextBtn:hover {
        background-color: #3A0303;
    }
    #submitBtn {
        background-color: rgb(76, 228, 134);
        color: white;
    }
    #submitBtn:hover {
        background-color: #3A0303;
    }
    .form-navigation .btn:disabled {
        background-color: #D1D5DB;
        cursor: not-allowed;
        opacity: 0.7;
    }
    
    /* --- Sección de Estadísticas --- */
    .statistics-container {
        width: 100%;
        max-width: 800px;
        margin-left: 0;
    }
    .statistics-row {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }
    .statistics-item {
        display: flex;
        align-items: center;
        width: 250px;
        flex-direction: column;
    }
    .mes-label {
        width: 100px;
        text-align: left;
        margin-right: 10px;
    }
    .statistics-input {
        width: 80px !important;
        padding: 0.375rem 0.5rem;
        font-size: 0.9rem;
    }
    
    /* Estilo para resaltar el breadcrumb activo */
    .breadcrumb-item.active {
        color: blue;
    }
    
    /* Establece color para enlaces de breadcrumb no activos */
    .breadcrumb-item a {
        color: #000 !important;
    }
    /* Cambia a azul al pasar el cursor */
    .breadcrumb-item a:hover {
        color: blue !important;
    }
    /* Resalta el breadcrumb activo en azul */
    .breadcrumb-item.active {
        color: blue !important;
    }
    
    /* ...existing other styles... */
</style>

<script>
    let currentStep = 1;
    const totalSteps = 9;

    function showStep(step) {
        $('.form-step').hide();
        $(`#step-${step}`).show(); // Se corrige el selector
        $('.wizard-step').removeClass('active');
        $(`.wizard-step[data-step="${step}"]`).addClass('active'); // Se corrige el selector

        if (step === 1) {
            $('#prevBtn').hide();
        } else {
            $('#prevBtn').show();
        }

        if (step === totalSteps) {
            $('#nextBtn').hide();
            $('#submitBtn').show();
        } else {
            $('#nextBtn').show();
            $('#submitBtn').hide();
        }

        currentStep = step;
    }

    function navigateStep(direction) {
        const newStep = currentStep + direction;
        if (newStep >= 1 && newStep <= totalSteps) {
            showStep(newStep);
        }
    }

    $(document).ready(function () {
        showStep(1);

        $('.wizard-step').click(function () {
            const step = $(this).data('step');
            showStep(step);
        });

        $('#Existe_Criterio').change(function(){
            if ($(this).is(':checked')) {
                $('#Criterio_Descripcion').removeAttr('disabled').css('opacity', '1');
            } else {
                $('#Criterio_Descripcion').attr('disabled', true).css('opacity', '0.5');
            }
        });

        $("input[name='Existe_Criterio_Radio']").change(function(){
            if ($(this).val() === 'si') {
                $('#Criterio_Descripcion').removeAttr('disabled').css('opacity', '1');
            } else {
                $('#Criterio_Descripcion').attr('disabled', true).css('opacity', '0.5');
            }
        });
    });

    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })()
    })()
</script>
<script>
$(document).ready(function(){
    // Mostrar el alert de éxito con efecto fadeIn
    $('#success-alert').fadeIn('slow', function(){
        // Se mantiene visible brevemente y luego se desliza hacia arriba
        $(this).delay(2000).slideUp(500);
    });

    // Habilitar o deshabilitar el textarea según la selección de los botones de radio
    $("input[name='Existe_Criterio_Radio']").change(function(){
        if ($(this).val() === 'si') {
            $('#Criterio_Descripcion').removeAttr('disabled').css('opacity', '1');
        } else {
            $('#Criterio_Descripcion').attr('disabled', true).css('opacity', '0.5');
        }
    });

    // Inicializar el estado del textarea al cargar la página
    if ($("input[name='Existe_Criterio_Radio']:checked").val() === 'no') {
        $('#Criterio_Descripcion').attr('disabled', true).css('opacity', '0.5');
    }

    // Manejar el envío del formulario con AJAX
    $('#inspeccionForm').on('submit', function(e) {
        e.preventDefault();
        
        if (this.checkValidity()) {
            let formData = new FormData(this);
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Solicitud enviada correctamente.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#8E354A',
                        position: 'center'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '<?php echo base_url("visitas"); ?>';
                        }
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al procesar la solicitud.',
                        confirmButtonColor: '#8E354A',
                        position: 'center'
                    });
                }
            });
        } else {
            $(this).addClass('was-validated');
        }
    });
});
</script>
@endsection