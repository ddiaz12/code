@layout('templates/master')
@section('titulo')
    {{ isset($inspeccion) ? 'Editar Inspección' : 'Agregar Inspección' }}
@endsection
@section('navbar')
    @include('templates/navbarSujeto')
@endsection
@section('menu')
    @include('templates/menuSujeto')
@endsection
@section('contenido')

<!-- Mostrar alertas de éxito o error si existen (Flashdata) -->
@if($this->session->flashdata('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ $this->session->flashdata('success') }}',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#8E354A'
        });
    </script>
@endif

@if($this->session->flashdata('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $this->session->flashdata('error') }}',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#8E354A'
        });
    </script>
@endif

<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4 mt-5" style="margin-left: 5px;">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url('home'); ?>" class="text-decoration-none">
                <i class="fas fa-home me-1"></i>Home
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo base_url('inspecciones'); ?>" class="text-decoration-none">
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
                <!-- Formulario principal -->
                <form id="inspeccionForm" method="post" action="<?= base_url('InspeccionesController/guardar'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_inspeccion" value="{{ isset($inspeccion) ? $inspeccion->id_inspeccion : '' }}">

                    <!-- =================== STEP 1: Datos de identificación =================== -->
                    <div class="form-step" id="step-1">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
                            Datos de identificación
                        </h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>
                        <!-- Homoclave -->
                        <div class="form-group">
                            <label><b>Homoclave</b></label>
                            <input type="text" name="Homoclave" class="form-control"
                                   value="{{ $inspeccion->Homoclave ?? 'I-IPR-CTIH-0-IPR-0002' }}" readonly>
                        </div>
                        <!-- Nombre de la Inspección -->
                        <div class="form-group">
                            <label><b>Nombre de la Inspección</b><span class="text-danger">*</span></label>
                            <input type="text" name="Nombre_Inspeccion" class="form-control" required
                                   value="{{ $inspeccion->Nombre_Inspeccion ?? '' }}">
                        </div>
                        <!-- Modalidad -->
                        <div class="form-group">
                            <label>Modalidad (si existe)</label>
                            <input type="text" name="Modalidad" class="form-control"
                                   value="{{ $inspeccion->Modalidad ?? '' }}">
                        </div>
                        <!-- Tipo de inspección -->
                        <div class="form-group">
                            <label><b>Tipo de inspección, verificación o visita domiciliaria</b><span class="text-danger">*</span></label>
                            <select name="Tipo_Inspeccion" class="form-control" required>
                                <option value="">Selecciona</option>
                                <option value="Asesoria"       {{ isset($inspeccion) && $inspeccion->Tipo_Inspeccion == 'Asesoria' ? 'selected' : '' }}>Asesoria</option>
                                <option value="Asistencia"     {{ isset($inspeccion) && $inspeccion->Tipo_Inspeccion == 'Asistencia' ? 'selected' : '' }}>Asistencia</option>
                                <option value="Control"        {{ isset($inspeccion) && $inspeccion->Tipo_Inspeccion == 'Control' ? 'selected' : '' }}>Control</option>
                                <option value="Corroboración"  {{ isset($inspeccion) && $inspeccion->Tipo_Inspeccion == 'Corroboración' ? 'selected' : '' }}>Corroboración</option>
                                <option value="Otra"           {{ isset($inspeccion) && $inspeccion->Tipo_Inspeccion == 'Otra' ? 'selected' : '' }}>Otra</option>
                                <option value="Promoción"      {{ isset($inspeccion) && $inspeccion->Tipo_Inspeccion == 'Promoción' ? 'selected' : '' }}>Promoción</option>
                                <option value="Supervisión"    {{ isset($inspeccion) && $inspeccion->Tipo_Inspeccion == 'Supervisión' ? 'selected' : '' }}>Supervisión</option>
                                <option value="Vigilancia"     {{ isset($inspeccion) && $inspeccion->Tipo_Inspeccion == 'Vigilancia' ? 'selected' : '' }}>Vigilancia</option>
                            </select>
                            <div id="especificarOtra" style="display: none;">
                                <label>Especificar otra:</label>
                                <input type="text" name="Especificar_Otra" class="form-control"
                                       value="{{ $inspeccion->Especificar_Otra ?? '' }}">
                            </div>
                        </div>
                        <!-- Sujeto Obligado -->
                        <div class="form-group">
                            <label><b>Sujeto Obligado</b><span class="text-danger">*</span></label>
                            <select name="Sujeto_Obligado_ID" class="form-control" required>
                                <option value="">Selecciona un Sujeto Obligado</option>
                                @foreach($sujetos_obligados as $so)
                                    <option value="{{ $so->ID_sujeto }}"
                                        {{ isset($inspeccion) && $inspeccion->Sujeto_Obligado_ID == $so->ID_sujeto ? 'selected' : '' }}>
                                        {{ $so->nombre_sujeto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Ley de Fomento -->
                        <div class="form-group">
                            <label><b>Ley de Fomento a la Confianza Ciudadana</b></label>
                            <p style="font-size: 14px;">
                                ¿La inspección, verificación o visita domiciliaria se encuentra exenta de la Ley de Fomento a la Confianza Ciudadana?<span class="text-danger">*</span>
                            </p>
                            <div>
                                <label>
                                    <input type="radio" name="Ley_Fomento" value="si"
                                        {{ isset($inspeccion) && $inspeccion->Ley_Fomento == 'si' ? 'checked' : '' }}> Sí
                                </label>
                                <label>
                                    <input type="radio" name="Ley_Fomento" value="no"
                                        {{ isset($inspeccion) && $inspeccion->Ley_Fomento == 'no' ? 'checked' : '' }}> No
                                </label>
                            </div>
                            <div id="justificarLeyFomento" style="display: none;">
                                <label>
                                    Justificar si la inspección, verificación o visita domiciliaria son sujetas para todas o algunas de sus modalidades a suspensión conforme lo establecido en el artículo 1 y 13 de la Ley de Fomento a la Confianza Ciudadana:<span class="text-danger">*</span>
                                </label>
                                <textarea name="Justificacion_Ley_Fomento" class="form-control" rows="3" required>{{ $inspeccion->Justificacion_Ley_Fomento ?? '' }}</textarea>
                            </div>
                        </div>
                        <!-- Dirigida a -->
                        <div class="form-group">
                            <label><b>¿La inspección, verificación o visita domiciliaria va dirigida a personas físicas, morales o ambas?</b><span class="text-danger">*</span></label>
                            <select name="Dirigida_A" class="form-control" required>
                                <option value="">Selecciona</option>
                                <option value="Físicas"                              {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Físicas' ? 'selected' : '' }}>Personas físicas</option>
                                <option value="Físicas con actividad empresarial"    {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Físicas con actividad empresarial' ? 'selected' : '' }}>Personas físicas con actividad empresarial</option>
                                <option value="Morales"                              {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Morales' ? 'selected' : '' }}>Personas morales</option>
                                <option value="Otras"                                {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Otras' ? 'selected' : '' }}>Otras</option>
                            </select>
                            <div id="especificarDirigidaA" style="display: none;">
                                <label>Indicar a quién va dirigida la inspección, verificación o visita domiciliaria:</label>
                                <input type="text" name="Especificar_Dirigida_A" class="form-control"
                                       value="{{ $inspeccion->Especificar_Dirigida_A ?? '' }}">
                            </div>
                        </div>
                        <!-- Caracter de la inspección -->
                        <div class="form-group">
                            <label><b>La inspección, verificación o visita domiciliaria es:</b><span class="text-danger">*</span></label>
                            <select name="Caracter_Inspeccion" class="form-control" required>
                                <option value="">Selecciona</option>
                                <option value="PREVENTIVA"   {{ isset($inspeccion) && $inspeccion->Caracter_Inspeccion == 'PREVENTIVA' ? 'selected' : '' }}>PREVENTIVA (se realiza para prevenir algún impacto negativo)</option>
                                <option value="REACTIVA"     {{ isset($inspeccion) && $inspeccion->Caracter_Inspeccion == 'REACTIVA' ? 'selected' : '' }}>REACTIVA (como respuesta a un accidente o amenaza particular)</option>
                                <option value="SEGUIMIENTO"  {{ isset($inspeccion) && $inspeccion->Caracter_Inspeccion == 'SEGUIMIENTO' ? 'selected' : '' }}>SEGUIMIENTO (se da seguimiento al cumplimiento de alguna obligación en particular)</option>
                            </select>
                        </div>
                        <!-- Realizada en -->
                        <div class="form-group">
                            <label><b>Indique si la verificación, inspección o visita domiciliaria se realiza en:</b><span class="text-danger">*</span></label>
                            <select name="Realizada_En" class="form-control" required>
                                <option value="">Selecciona</option>
                                <option value="Domicilio"    {{ isset($inspeccion) && $inspeccion->Realizada_En == 'Domicilio' ? 'selected' : '' }}>En el domicilio o establecimientos de los Sujetos Regulados</option>
                                <option value="Oficinas"     {{ isset($inspeccion) && $inspeccion->Realizada_En == 'Oficinas' ? 'selected' : '' }}>En las oficinas del Sujeto Obligado</option>
                                <option value="Electronicos" {{ isset($inspeccion) && $inspeccion->Realizada_En == 'Electronicos' ? 'selected' : '' }}>Medios electrónicos</option>
                                <option value="Otro"         {{ isset($inspeccion) && $inspeccion->Realizada_En == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            <div id="especificarRealizadaEn" style="display: none;">
                                <label>Otros:</label>
                                <input type="text" name="Especificar_Realizada_En" class="form-control"
                                       value="{{ $inspeccion->Especificar_Realizada_En ?? '' }}">
                            </div>
                        </div>
                        <!-- Objetivo -->
                        <div class="form-group">
                            <label><b>¿Cuál es el objetivo de la inspección, verificación o visita domiciliaria?</b><span class="text-danger">*</span></label>
                            <textarea name="Objetivo" class="form-control" rows="3" required>{{ $inspeccion->Objetivo ?? '' }}</textarea>
                        </div>
                        <!-- Palabras clave -->
                        <div class="form-group">
                            <label><b>Palabras clave que describan o identifiquen las inspecciones, verificaciones y visitas domiciliarias:</b><span class="text-danger">*</span></label>
                            <textarea name="Palabras_Clave" class="form-control" rows="2" required>{{ $inspeccion->Palabras_Clave ?? '' }}</textarea>
                        </div>
                        <!-- Periodicidad -->
                        <div class="form-group">
                            <label><b>Periodicidad en la que se realiza:</b><span class="text-danger">*</span></label>
                            <select name="Periodicidad" class="form-control" required>
                                <option value="">Selecciona</option>
                                <option value="Anual"           {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Anual' ? 'selected' : '' }}>Anual</option>
                                <option value="Bienal"          {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Bienal' ? 'selected' : '' }}>Bienal</option>
                                <option value="Diaria"          {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Diaria' ? 'selected' : '' }}>Diaria</option>
                                <option value="Mensual"         {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Mensual' ? 'selected' : '' }}>Mensual</option>
                                <option value="No aplica"       {{ isset($inspeccion) && $inspeccion->Periodicidad == 'No aplica' ? 'selected' : '' }}>No aplica</option>
                                <option value="Semanal"         {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Semanal' ? 'selected' : '' }}>Semanal</option>
                                <option value="Semestral"       {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Semestral' ? 'selected' : '' }}>Semestral</option>
                                <option value="Trineal o más"    {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Trineal o más' ? 'selected' : '' }}>Trineal o más</option>
                                <option value="Trimestral"      {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Trimestral' ? 'selected' : '' }}>Trimestral</option>
                            </select>
                        </div>
                        <!-- Motivo de la inspección -->
                        <div class="form-group">
                            <label><b>Especificar qué motiva la inspección, verificación o visita domiciliaria:</b><span class="text-danger">*</span></label>
                            <select name="Motivo_Inspeccion" class="form-control" required>
                                <option value="">Selecciona</option>
                                <option value="Ordinaria"                      {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'Ordinaria' ? 'selected' : '' }}>Ordinaria</option>
                                <option value="Extraordinaria"                 {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'Extraordinaria' ? 'selected' : '' }}>Extraordinaria</option>
                                <option value="De oficio"                      {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'De oficio' ? 'selected' : '' }}>De oficio</option>
                                <option value="A solicitud de parte"           {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'A solicitud de parte' ? 'selected' : '' }}>A solicitud de parte</option>
                                <option value="Forma parte de un trámite o servicio" {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'Forma parte de un trámite o servicio' ? 'selected' : '' }}>Forma parte de un trámite o servicio</option>
                                <option value="Otro"                            {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            <div id="especificarMotivoInspeccion" style="display: none;">
                                <label>Especificar otro:</label>
                                <input type="text" name="Especificar_Motivo_Inspeccion" class="form-control"
                                       value="{{ $inspeccion->Especificar_Motivo_Inspeccion ?? '' }}">
                            </div>
                        </div>
                        <!-- Nombre de trámite o servicio -->
                        <div class="form-group">
                            <label><b>Nombre de trámite o servicio asociado en esta inspección, verificación o visita domiciliaria:</b><span class="text-danger">*</span></label>
                            <div>
                                <label>Nombre del servicio o trámite:</label>
                                <input type="text" name="Nombre_Tramite_Servicio" class="form-control" required
                                       value="{{ $inspeccion->Nombre_Tramite_Servicio ?? '' }}">
                            </div>
                            <div>
                                <label>URL relacionado:</label>
                                <input type="url" name="URL_Tramite_Servicio" class="form-control" required
                                       value="{{ $inspeccion->URL_Tramite_Servicio ?? '' }}">
                            </div>
                        </div>
                        <!-- ========== Fundamento jurídico ========== -->
                        <div class="form-group">
                            <label><b>¿Existe un fundamento jurídico que dé origen a la inspección, verificación o visita domiciliaria?</b><span class="text-danger">*</span></label>
                            <div>
                                <label>
                                    <input type="radio" name="Fundamento_Juridico" value="si"
                                           {{ isset($inspeccion) && $inspeccion->Fundamento_Juridico == 'si' ? 'checked' : '' }}>
                                    Sí
                                </label>
                                <label>
                                    <input type="radio" name="Fundamento_Juridico" value="no"
                                           {{ isset($inspeccion) && $inspeccion->Fundamento_Juridico == 'no' ? 'checked' : '' }}>
                                    No
                                </label>
                            </div>

                            <!-- Botón para abrir el modal (solo cuando se seleccione "sí") -->
                            <button type="button" class="btn btn-link" id="btnAddFundamento" style="display:none;" onclick="mostrarModalFundamento()">
                                <i class="fas fa-plus-circle"></i> Añadir Fundamento
                            </button>
                        </div>

<!-- ===================== Sección de Fundamentos (se muestra solo si la respuesta es "Sí") ===================== -->
<div id="fundamentosContainer" style="display: none; margin-top: 20px;">
  <h5 id="tituloFundamentos" style="display: none;">Fundamentos jurídicos</h5>
  <!-- Tabla donde se mostrarán los fundamentos añadidos -->
  <table class="table table-bordered mt-3" id="tablaFundamentos">
    <thead>
      <tr>
        <th style="width: 30%">Tipo de ordenamiento</th>
        <th style="width: 50%">Nombre del ordenamiento</th>
        <th style="width: 20%">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Se agregarán filas dinámicamente con JS -->
    </tbody>
  </table>
</div>

<!-- ===================== Modal de Fundamentos Jurídicos ===================== -->
<div class="modal fade" id="modalFundamento" tabindex="-1" role="dialog" aria-labelledby="modalFundamentoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #8E354A;">
        <h5 class="modal-title" style="color: white;" id="modalFundamentoLabel">Fundamentos jurídicos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrarModalFundamento()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Tipo de ordenamiento -->
        <div class="form-group">
          <label><b>Tipo de ordenamiento:</b><span class="text-danger">*</span></label>
          <select id="tipoOrdenamiento" class="form-control">
            <option value="">Selecciona una opción</option>
            @foreach($cat_tipo_ord_jur as $tipo)
              <option value="{{ $tipo->ID_tOrdJur }}">{{ $tipo->Tipo_Ordenamiento }}</option>
            @endforeach
          </select>
        </div>

        <!-- Nombre del ordenamiento -->
        <div class="form-group">
          <label><b>Nombre del ordenamiento:</b><span class="text-danger">*</span></label>
          <input type="text" id="nombreOrdenamiento" class="form-control" required>
        </div>

        <!-- Otros campos: Artículo, Fracción, Inciso, etc. -->
        <div class="form-row">
          <div class="col">
            <label>Artículo:</label>
            <input type="text" id="articulo" class="form-control">
          </div>
          <div class="col">
            <label>Fracción:</label>
            <input type="text" id="fraccion" class="form-control">
          </div>
          <div class="col">
            <label>Inciso:</label>
            <input type="text" id="inciso" class="form-control">
          </div>
        </div>
        <div class="form-row mt-3">
          <div class="col">
            <label>Párrafo:</label>
            <input type="text" id="parrafo" class="form-control">
          </div>
          <div class="col">
            <label>Número:</label>
            <input type="text" id="numero" class="form-control">
          </div>
          <div class="col">
            <label>Letra:</label>
            <input type="text" id="letra" class="form-control">
          </div>
        </div>
        <div class="form-group mt-3">
          <label>Otro:</label>
          <input type="text" id="otro" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <!-- Botón para cerrar sin guardar -->
        <button type="button" class="btn btn-secondary" onclick="cerrarModalFundamento()">Cerrar</button>
        <!-- Botón para guardar -->
        <button type="button" class="btn btn-primary" id="btnGuardarFundamento">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- ===================== Script con la lógica ===================== -->
<script>
$(document).ready(function() {
  // Inicialmente oculta la tabla de fundamentos y el título
  $('#tablaFundamentos').hide();
  $('#tituloFundamentos').hide();
  // 1. Mostrar/ocultar la sección de fundamentos según "Sí" o "No"
  $('input[name="Fundamento_Juridico"]').change(function() {
    if ($(this).val() === 'si') {
      $('#fundamentosContainer').show();
    } else {
      $('#fundamentosContainer').hide();
    }
  });

  // 2. Abrir el modal al dar clic en "Añadir Fundamento"
  $('#btnAddFundamento').click(function() {
    $('#modalFundamento').modal('show'); // Abre el modal
  });

  // 3. Guardar el fundamento al dar clic en "Guardar" del modal
  $('#btnGuardarFundamento').click(function() {
    // Validar campos obligatorios
    let tipo = $('#tipoOrdenamiento').val().trim();
    let nombre = $('#nombreOrdenamiento').val().trim();

    if (!tipo || !nombre) {
      Swal.fire({
        icon: 'error',
        title: 'Campos requeridos',
        text: 'Debes seleccionar el Tipo de ordenamiento y capturar el Nombre',
        confirmButtonColor: '#8E354A'
      });
      return;
    }

    // Agregar una fila a la tabla con el Tipo y Nombre
    let fila = `
      <tr>
        <td>${tipo}</td>
        <td>${nombre}</td>
        <td>
          <button type="button" class="btn btn-danger btn-sm btnBorrarFundamento">
            <i class="fas fa-trash-alt"></i>
          </button>
        </td>
      </tr>
    `;
    $('#tablaFundamentos tbody').append(fila);

    // Si es el primer registro, muestra la tabla y el título
    if ($('#tablaFundamentos tbody tr').length > 0) {
        $('#tablaFundamentos').show();
        $('#tituloFundamentos').show();
    }

    // Cerrar el modal
    $('#modalFundamento').modal('hide');

    // Limpia campos del modal (opcional)
    $('#tipoOrdenamiento').val('');
    $('#nombreOrdenamiento').val('');
    $('#articulo').val('');
    $('#fraccion').val('');
    $('#inciso').val('');
    $('#parrafo').val('');
    $('#numero').val('');
    $('#letra').val('');
    $('#otro').val('');

    // Opcional: mostrar alerta de éxito
    Swal.fire({
      icon: 'success',
      title: 'Fundamento agregado',
      text: 'Se ha agregado un fundamento jurídico a la lista.',
      confirmButtonColor: '#8E354A',
      timer: 1500
    });
  });

  // 4. Eliminar fila de la tabla si dan clic en el botón de basura
  $('#tablaFundamentos').on('click', '.btnBorrarFundamento', function() {
    $(this).closest('tr').remove();
    // Si ya no hay filas, oculta la tabla y el título
    if ($('#tablaFundamentos tbody tr').length === 0) {
        $('#tablaFundamentos').hide();
        $('#tituloFundamentos').hide();
    }
  });
});

// Función para cerrar el modal con confirmación (si quieres)
function cerrarModalFundamento() {
  Swal.fire({
    title: '¿Estás seguro?',
    text: "Los cambios no guardados se perderán",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#8E354A',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Sí, cerrar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      $('#modalFundamento').modal('hide');
    }
  });
}
</script>
                     <!-- =================== STEP 2: Autoridad Pública =================== -->
                     <div class="form-step" id="step-2">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
                            Autoridad pública
                        </h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>
                        <div class="form-group">
                            <label>Información de las autoridades competentes</label>
                            <div class="input-group">
                                <input type="text" name="Oficina_Administrativa" class="form-control"
                                       placeholder="Buscar oficinas" id="buscarOficinasInput">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="buscarOficinasBtn">
                                        <i class="fas fa-search"></i> Mis oficinas
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Selecciona una oficina de la lista.</small>
                        </div>

                        <ul id="oficinasSeleccionadas" class="list-group mt-2"></ul>

                        <!-- Modal para seleccionar oficinas -->
                        <div id="oficinasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="oficinasModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="oficinasModalLabel">Seleccionar Oficina Administrativa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered" id="oficinasTable">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($oficinas) && count($oficinas) > 0)
                                                    @foreach($oficinas as $oficina)
                                                        <tr>
                                                            <td>{{ $oficina->nombre }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary seleccionarOficinaBtn"
                                                                        data-oficina="{{ $oficina->nombre }}">
                                                                    Seleccionar
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="2">No se encontraron oficinas registradas.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                                        <button type="button" class="btn btn-primary" id="aceptarOficinaBtn">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =================== STEP 3: Información sobre la inspección =================== -->
                    <div class="form-step" id="step-3">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
                            Información sobre la inspección
                        </h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <div class="form-group">
                            <label>Bien, elemento, objeto o sujeto de inspección, verificación o visita domiciliaria:<span class="text-danger">*</span></label>
                            <textarea name="Bien_Elemento" class="form-control" rows="2" required>{{ $inspeccion->Bien_Elemento ?? '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Indicar si otros Sujetos Obligados participan en la realización de las inspecciones, verificaciones y visitas domiciliarias:<span class="text-danger">*</span></label>
                            <select name="Otros_Sujetos_Participan" class="form-control" required>
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Otros_Sujetos_Participan == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Otros_Sujetos_Participan == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>

                        <div class="form-group" id="sujetosObligados" style="display: none;">
                            <label>¿Cuáles Sujetos Obligados?</label>
                            <div class="input-group">
                                <input type="text" name="Buscar_Sujeto_Obligado" class="form-control"
                                       placeholder="Buscar Sujeto Obligado" id="buscarSujetosInput">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="buscarSujetosBtn">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Selecciona un sujeto obligado de la lista.</small>
                        </div>

                        <!-- Modal para seleccionar Sujetos Obligados -->
                        <div id="sujetosModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="sujetosModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sujetosModalLabel">Seleccionar Sujeto Obligado</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered" id="sujetosTable">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($sujetos_obligados) && count($sujetos_obligados) > 0)
                                                    @foreach($sujetos_obligados as $sujeto)
                                                        <tr>
                                                            <td>{{ $sujeto->nombre_sujeto }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary seleccionarSujetoBtn"
                                                                        data-sujeto="{{ $sujeto->nombre_sujeto }}">
                                                                    Seleccionar
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="2">No se encontraron Sujetos Obligados.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                                        <button type="button" class="btn btn-primary" id="aceptarSujetoBtn">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Derechos y obligaciones -->
                        <div class="form-group">
                            <label>Derechos del sujeto regulado durante la inspección, verificación o visita domiciliaria</label>
                            <div class="input-group">
                                <input type="text" name="Derecho_Sujeto_Regulado" class="form-control"
                                       placeholder="Agregar derecho del sujeto regulado">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="agregarDerechoBtn">
                                        <i class="fas fa-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                            <ul id="derechosList" class="list-group mt-2"></ul>
                        </div>

                        <div class="form-group">
                            <label>Obligaciones que debe cumplir el sujeto regulado</label>
                            <div class="input-group">
                                <input type="text" name="Obligacion_Sujeto_Regulado" class="form-control"
                                       placeholder="Agregar obligaciones">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="agregarObligacionBtn">
                                        <i class="fas fa-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                            <ul id="obligacionesList" class="list-group mt-2"></ul>
                        </div>

                        <!-- Fundamento Jurídico "Genérico" (puedes omitir si ya usas el modal) -->
                        <div class="form-group">
                            <label>Fundamento Jurídico de la existencia de la inspección, verificación o visita domiciliaria:<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="Nombre_Fundamento" class="form-control"
                                       placeholder="Nombre" required>
                                <input type="text" name="Articulo_Fundamento" class="form-control"
                                       placeholder="Artículo" required>
                                <input type="url" name="Url_Fundamento" class="form-control"
                                       placeholder="URL" required>
                            </div>
                        </div>

                        <!-- Firmar Formato -->
                        <div class="form-group">
                            <label>Especificar si el sujeto regulado debe llenar o firmar algún formato para la inspección, verificación o visita domiciliaria:<span class="text-danger">*</span></label>
                            <select name="Firmar_Formato" class="form-control" required>
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Firmar_Formato == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Firmar_Formato == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                        <div class="form-group" id="formatoUpload" style="display: none;">
                            <label>Subir formato (PDF, JPG, PNG)</label>
                            <input type="file" name="Archivo_Formato" class="form-control-file" accept=".pdf,.jpg,.png">
                        </div>
                    </div>

                    <!-- =================== STEP 4: Más detalles =================== -->
                    <div class="form-step" id="step-4">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Más detalles</h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <!-- Tiene costo -->
                        <div class="form-group">
                            <label>¿Tiene algún costo o pago de derechos, productos y aprovechamientos aplicables?<span class="text-danger">*</span></label>
                            <select name="Tiene_Costo" class="form-control" required>
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Tiene_Costo == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Tiene_Costo == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                        <div class="form-group" id="costoDetails" style="display: none;">
                            <label>Indicar monto<span class="text-danger">*</span></label>
                            <input type="number" name="Monto_Costo" class="form-control" placeholder="Monto" min="0">
                            <label>¿El monto se encuentra fundamentado jurídicamente?<span class="text-danger">*</span></label>
                            <select name="Monto_Fundamentado" class="form-control" required>
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Monto_Fundamentado == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Monto_Fundamentado == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                            <div id="fundamentoDetails" style="display: none;">
                                <label>Nombre del fundamento</label>
                                <input type="text" name="Nombre_Fundamento_Costo" class="form-control" placeholder="Nombre">
                                <label>URL del fundamento</label>
                                <input type="url" name="Url_Fundamento_Costo" class="form-control" placeholder="URL">
                            </div>
                        </div>

                        <!-- Pasos a realizar -->
                        <div class="form-group">
                            <label><b>Pasos a realizar por el inspector o verificador durante la inspección, verificación o visita domiciliaria:</b></label>
                            <p style="color: grey;">
                                Aproximadamente, ¿Cuánto tiempo lleva la verificación en todas sus etapas –orden, diligencia y resolución-? Indique y desglose lo más posible los pasos realizados:
                            </p>
                            <textarea name="Pasos_Inspector" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Tramites vinculados -->
                        <div class="form-group">
                            <label>Tramites vinculados a la inspección, verificación o visita domiciliaria<span class="text-danger">*</span></label>
                            <input type="text" name="Nombre_Tramite_Vinculado" class="form-control" placeholder="Nombre del tramite">
                            <input type="url" name="Url_Tramite_Vinculado" class="form-control" placeholder="URL del tramite">
                        </div>

                        <!-- Regulaciones que debe cumplir -->
                        <div class="form-group">
                            <label>Regulaciones que debe cumplir el sujeto obligado</label>
                            <input type="text" name="Nombre_Regulacion" class="form-control" placeholder="Nombre de la regulación">
                            <input type="url" name="Url_Regulacion" class="form-control" placeholder="URL de la regulación">
                        </div>

                        <!-- Requisitos o documentos -->
                        <div class="form-group">
                            <label>Requisitos o documentos que debe presentar el interesado</label>
                            <input type="file" name="Requisitos_Documentos" class="form-control-file" accept=".pdf,.jpg,.png">
                        </div>

                        <!-- Sanciones -->
                        <div class="form-group">
                            <label>¿Qué tipo de sanciones pueden derivar a partir de esta inspección?<span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="Sanciones[]" value="Clausura definitiva">
                                <label class="form-check-label">Clausura definitiva</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="Sanciones[]" value="Clausura temporal">
                                <label class="form-check-label">Clausura temporal</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="Sanciones[]" value="Multa">
                                <label class="form-check-label">Multa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="Sanciones[]" value="Otra">
                                <label class="form-check-label">Otra</label>
                                <input type="text" name="Otra_Sancion" class="form-control mt-2" placeholder="Especificar otra sanción">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="Sanciones[]" value="Revocación de licencia, permiso, autorización u otro">
                                <label class="form-check-label">Revocación de licencia, permiso, autorización u otro</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="Sanciones[]" value="Suspensión definitiva de actividades">
                                <label class="form-check-label">Suspensión definitiva de actividades</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="Sanciones[]" value="Suspensión temporal de actividades">
                                <label class="form-check-label">Suspensión temporal de actividades</label>
                            </div>
                            <label>URL de la sanción</label>
                            <input type="url" name="Url_Sancion" class="form-control" placeholder="URL de la sanción">
                        </div>

                        <!-- Tiempo aproximado -->
                        <div class="form-group">
                            <label>Tiempo aproximado de la inspección, verificación o visita domiciliaria<span class="text-danger">*</span></label>
                            <input type="number" name="Valor_Plazo" class="form-control" placeholder="Valor del plazo" min="1">
                            <select name="Unidad_Medida_Plazo" class="form-control">
                                <option value="Días naturales">Días naturales</option>
                                <option value="Días hábiles">Días hábiles</option>
                                <option value="Meses">Meses</option>
                                <option value="Años">Años</option>
                                <option value="No aplica">No aplica</option>
                            </select>
                        </div>

                        <!-- Formato o formulario -->
                        <div class="form-group">
                            <label>Formato o formulario, en su caso, que el Sujeto Obligado utiliza</label>
                            <input type="text" name="Nombre_Formato" class="form-control" placeholder="Nombre">
                            <input type="file" name="Archivo_Formato" class="form-control-file" accept=".pdf,.jpg,.png">
                        </div>

                        <!-- Facultades, atribuciones y obligaciones -->
                        <div class="form-group">
                            <label>Facultades, atribuciones y obligaciones del Sujeto Obligado que la realiza<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="Facultades_Obligaciones" class="form-control"
                                       placeholder="Agregar Facultades, atribuciones y obligaciones">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="agregarFacultadBtn">
                                        <i class="fas fa-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                            <ul id="facultadesList" class="list-group mt-2"></ul>
                        </div>

                        <!-- Servidores públicos -->
                        <div class="form-group">
                            <label>Servidores públicos facultados para realizar la inspección, verificación o visita domiciliaria</label>
                            <input type="text" name="Nombre_Servidor_Publico" class="form-control" placeholder="Nombre">
                            <input type="url" name="Url_Servidor_Publico" class="form-control" placeholder="URL directo a su ficha">
                        </div>
                    </div>

                    <!-- =================== STEP 5: Información de la Autoridad Pública y Contacto =================== -->
                    <div class="form-step" id="step-5">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
                            Información de la Autoridad Pública y Contacto
                        </h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <div class="form-group">
                            <label>Números telefónicos</label>
                            <input type="text" name="Numeros_Telefonicos" class="form-control" placeholder="Números telefónicos">
                        </div>
                        <div class="form-group">
                            <label>Dirección y correo electrónico de los órganos internos de control o equivalentes para realizar denuncias</label>
                            <input type="text" name="Direccion_Organos_Control" class="form-control" placeholder="Dirección">
                            <input type="email" name="Correo_Organos_Control" class="form-control" placeholder="Correo electrónico">
                        </div>
                        <div class="form-group">
                            <label>
                                Señalamiento de los medios de impugnación con los que cuenta el interesado que se inconforme con la inspección, verificación o visita domiciliaria:<span class="text-danger">*</span>
                            </label>
                            <input type="text" name="Nombre_Regulacion_Impugnacion" class="form-control" placeholder="Nombre de la regulación">
                            <input type="text" name="Articulo_Regulacion_Impugnacion" class="form-control" placeholder="Artículo">
                            <input type="text" name="Parrafo_Regulacion_Impugnacion" class="form-control" placeholder="Párrafo, número o numeral">
                            <input type="url" name="Url_Regulacion_Impugnacion" class="form-control" placeholder="URL de la regulación">
                        </div>
                    </div>

                    <!-- =================== STEP 6: Estadísticas =================== -->
                    <div class="form-step" id="step-6">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Estadísticas</h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>

                        <h8 class="mb-3">¿Cuántas inspecciones se realizaron en el año anterior por mes?<span class="text-danger">*</span></h8>
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
                                    $valor = isset($inspeccion) ? $inspeccion->{$mes . '_Inspecciones'} : '0';
                                    echo '<div class="statistics-item">
                                            <label class="mes-label">' . $mes . ':</label>
                                            <input type="number" name="' . $mes . '_Inspecciones" class="form-control statistics-input" min="0" value="' . $valor . '">
                                          </div>';
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-4">
                            <label>¿Cuántas inspecciones derivaron en sanción en el año inmediato anterior?<span class="text-danger">*</span></label>
                            <input type="number" name="Inspecciones_Con_Sancion" class="form-control" min="0"
                                   value="{{ isset($inspeccion) ? $inspeccion->Inspecciones_Con_Sancion : '0' }}">
                        </div>
                    </div>

                    <!-- =================== STEP 7: Información adicional =================== -->
                    <div class="form-step" id="step-7">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
                            Información adicional
                        </h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>
                        <div class="form-group">
                            <label>Información que se considere útil para que el interesado realice la inspección, verificación o visita domiciliaria:</label>
                            <textarea name="Info_Adicional" class="form-control" rows="3">{{ $inspeccion->Info_Adicional ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- =================== STEP 8: No publicidad =================== -->
                    <div class="form-step" id="step-8">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
                            No publicidad
                        </h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>
                        <div class="form-group">
                            <label>¿Permitir que todos los datos de la inspección, verificación o visita domiciliaria sea pública?<span class="text-danger">*</span></label>
                            <select name="Permitir_Publicidad" class="form-control" required>
                                <option value="si" {{ !isset($inspeccion) || $inspeccion->Permitir_Publicidad == 'si' ? 'selected' : '' }}>Sí</option>
                                <option value="no" {{ isset($inspeccion) && $inspeccion->Permitir_Publicidad == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div id="noPublicidadDetails" style="display: none;">
                            <div class="form-group">
                                <label>
                                    Cargar un documento por medio del cual el sujeto obligado justifique que no se puede publicar la información de sus inspectores, verificadores y visitadores y/o inspecciones, verificaciones y visitas domiciliarias.<span class="text-danger">*</span>
                                </label>
                                <input type="file" name="Documento_No_Publicidad" class="form-control-file" accept=".pdf,.jpg,.png">
                            </div>
                            <div class="form-group">
                                <label>
                                    Determina la información de la ficha de la inspección, verificación o visita domiciliaria que no se puede publicar en el portal ciudadano:
                                </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="No_Publicar[]" value="Datos de identificación de la inspección">
                                    <label class="form-check-label">Datos de identificación de la inspección</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="No_Publicar[]" value="Contacto de la Autoridad Pública">
                                    <label class="form-check-label">Contacto de la Autoridad Pública</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="No_Publicar[]" value="Información sobre la inspección">
                                    <label class="form-check-label">Información sobre la inspección</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="No_Publicar[]" value="Más detalles">
                                    <label class="form-check-label">Más detalles</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="No_Publicar[]" value="Información de la Autoridad Pública">
                                    <label class="form-check-label">Información de la Autoridad Pública</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="No_Publicar[]" value="Estadística">
                                    <label class="form-check-label">Estadística</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =================== STEP 9: Emergencias =================== -->
                    <div class="form-step" id="step-9">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
                            Emergencias
                        </h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>
                        <div class="form-group">
                            <label>¿La inspección es requerida para atender una situación de emergencia?</label>
                            <select name="Es_Emergencia" class="form-control" required>
                                <option value="no" {{ !isset($inspeccion) || $inspeccion->Es_Emergencia == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($inspeccion) && $inspeccion->Es_Emergencia == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                        <div id="emergenciaDetails" style="display: none;">
                            <div class="alert alert-info">
                                <div class="form-group">
                                    <label>Justificar las razones por las cuales se habilita una inspección para atender una situación de emergencia</label>
                                    <textarea name="Justificacion_Emergencia" class="form-control" rows="3">{{ $inspeccion->Justificacion_Emergencia ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Cargar el oficio o acta de declaración de emergencia (PDF, PNG, JPG)<span class="text-danger">*</span></label>
                                    <input type="file" name="Archivo_Declaracion_Emergencia" class="form-control-file" accept=".pdf,.jpg,.png">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de navegación -->
                    <div class="form-navigation">
                        <button type="button" class="btn" id="prevBtn" onclick="navigateStep(-1)">Anterior</button>
                        <button type="button" class="btn" id="nextBtn" onclick="navigateStep(1)">Siguiente</button>
                        <button type="submit" class="btn" id="submitBtn" style="display:none;">
                            {{ isset($inspeccion) ? 'Actualizar' : 'Guardar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- ========================= ESTILOS ========================= -->
<style>
    :root {
        --primary-color: #8E354A;
        --border-color: #E5E7EB;
        --background-color: #F9FAFB;
        --text-color: #374151;
        --heading-color: #111827;
    }
    .container-fluid {
        background-color: var(--background-color);
        min-height: 100vh;
        padding-top: 1rem;
    }
    .main-content {
        margin-top: 0;
    }
    .form-container {
        padding: 1.5rem;
        margin: 0 0.5cm;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
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
    .form-step {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    /* Los steps que no sean el 1 se muestran en 1 columna */
    .form-step:not(#step-1) {
        grid-template-columns: 1fr;
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
    }
    /* Responsive */
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
    /* Navegación */
    .form-navigation {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding-bottom: 1rem;
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
    /* Sección de Estadísticas */
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
</style>

<!-- ========================= SCRIPTS ========================= -->
<script>
let currentStep = 1;
const totalSteps = 9;

function showStep(step) {
    // Oculta todos los steps y muestra solo el actual asignándole display grid
    $('.form-step').hide();
    $('#step-' + step).css('display','grid');
    
    // Actualiza la clase "active" en el sidebar
    $('.wizard-step').removeClass('active');
    $('.wizard-step[data-step="'+step+'"]').addClass('active');

    // Control de botones de navegación
    if (step === 1) {
        $('#prevBtn').hide();
    } else {
        $('#prevBtn').show();
    }
    if (step === totalSteps) {
        $('#nextBtn').hide();
        $('#submitBtn').show();  // Se muestra el botón de guardado en el último step
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

$(document).ready(function() {
    // Inicializa el primer step
    showStep(1);
    // Navegación por clic en el sidebar
    $('.wizard-step').click(function() {
        const step = $(this).data('step');
        showStep(step);
    });

    // Tipo de inspección -> "Otra"
    $('select[name="Tipo_Inspeccion"]').change(function(){
        if ($(this).val() === 'Otra') {
            $('#especificarOtra').show();
        } else {
            $('#especificarOtra').hide();
        }
    });

    // Ley de Fomento
    $('input[name="Ley_Fomento"]').change(function(){
        if ($(this).val() === 'si') {
            $('#justificarLeyFomento').show();
        } else {
            $('#justificarLeyFomento').hide();
        }
    });

    // Dirigida a
    $('select[name="Dirigida_A"]').change(function(){
        if ($(this).val() === 'Otras') {
            $('#especificarDirigidaA').show();
        } else {
            $('#especificarDirigidaA').hide();
        }
    });

    // Realizada en
    $('select[name="Realizada_En"]').change(function(){
        if ($(this).val() === 'Otro') {
            $('#especificarRealizadaEn').show();
        } else {
            $('#especificarRealizadaEn').hide();
        }
    });

    // Motivo de Inspección
    $('select[name="Motivo_Inspeccion"]').change(function(){
        if ($(this).val() === 'Otro') {
            $('#especificarMotivoInspeccion').show();
        } else {
            $('#especificarMotivoInspeccion').hide();
        }
    });

    // Firmar Formato
    $('select[name="Firmar_Formato"]').change(function() {
        if ($(this).val() == 'si') {
            $('#formatoUpload').show();
        } else {
            $('#formatoUpload').hide();
        }
    });

    // Tiene Costo
    $('select[name="Tiene_Costo"]').change(function() {
        if ($(this).val() == 'si') {
            $('#costoDetails').show();
        } else {
            $('#costoDetails').hide();
        }
    });

    // Monto Fundamentado
    $('select[name="Monto_Fundamentado"]').change(function() {
        if ($(this).val() == 'si') {
            $('#fundamentoDetails').show();
        } else {
            $('#fundamentoDetails').hide();
        }
    });

    // Permitir Publicidad
    $('select[name="Permitir_Publicidad"]').change(function() {
        if ($(this).val() == 'no') {
            $('#noPublicidadDetails').show();
            Swal.fire({
                title: 'Información',
                text: 'Conforme a la Estrategia Nacional de Mejora Regulatoria, los sujetos obligados podrán determinar la publicación parcial o total de la información, a fin de mantener la integridad o seguridad del servidor público.',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            });
        } else {
            $('#noPublicidadDetails').hide();
        }
    });

    // Emergencias
    $('select[name="Es_Emergencia"]').change(function() {
        if ($(this).val() == 'si') {
            $('#emergenciaDetails').show();
            Swal.fire({
                title: 'Información',
                text: 'Con fundamento en el artículo 56, de la Ley General de Mejora Regulatoria, se podrá registrar una inspección para atender una emergencia en los 5 días hábiles posteriores a su habilitación.',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            });
        } else {
            $('#emergenciaDetails').hide();
        }
    });

    // Otros Sujetos Participan
    $('select[name="Otros_Sujetos_Participan"]').change(function () {
        if ($(this).val() == 'si') {
            $('#sujetosObligados').show();
        } else {
            $('#sujetosObligados').hide();
        }
    });

    // Modal "Buscar Sujetos"
    $('#buscarSujetosBtn').click(function() {
        $('#sujetosModal').modal('show');
    });
    $('.seleccionarSujetoBtn').click(function() {
        var sujeto = $(this).data('sujeto');
        $('input[name="Buscar_Sujeto_Obligado"]').val(sujeto);
        $('#sujetosModal').modal('hide');
    });
    $('#aceptarSujetoBtn').click(function() {
        $('#sujetosModal').modal('hide');
    });
    $('#buscarSujetosInput').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        $('#sujetosTable tbody tr').each(function() {
            var sujetoNombre = $(this).find('td:first').text().toLowerCase();
            if (sujetoNombre.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Modal "Buscar Oficinas"
    $('#buscarOficinasBtn').click(function() {
        $('#oficinasModal').modal('show');
    });
    $('.seleccionarOficinaBtn').click(function() {
        var oficina = $(this).data('oficina');
        $('#oficinasSeleccionadas').append(
            '<li class="list-group-item">'
                + oficina +
                '<button type="button" class="btn btn-danger btn-sm float-right quitarOficinaBtn">Quitar</button>'
            + '</li>'
        );
        $('#oficinasModal').modal('hide');
    });
    $('#aceptarOficinaBtn').click(function() {
        $('#oficinasModal').modal('hide');
    });
    $('#buscarOficinasInput').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        $('#oficinasTable tbody tr').each(function() {
            var oficinaNombre = $(this).find('td:first').text().toLowerCase();
            if (oficinaNombre.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    $('#oficinasSeleccionadas').on('click', '.quitarOficinaBtn', function() {
        $(this).parent().remove();
    });

    // Derechos
    $('#agregarDerechoBtn').click(function() {
        var derecho = $('input[name="Derecho_Sujeto_Regulado"]').val();
        if (derecho) {
            $('#derechosList').append(
                '<li class="list-group-item">'
                    + derecho +
                    '<button type="button" class="btn btn-danger btn-sm float-right quitarDerechoBtn">Quitar</button>'
                + '</li>'
            );
            $('input[name="Derecho_Sujeto_Regulado"]').val('');
        }
    });
    $('#derechosList').on('click', '.quitarDerechoBtn', function() {
        $(this).parent().remove();
    });

    // Obligaciones
    $('#agregarObligacionBtn').click(function() {
        var obligacion = $('input[name="Obligacion_Sujeto_Regulado"]').val();
        if (obligacion) {
            $('#obligacionesList').append(
                '<li class="list-group-item">'
                    + obligacion +
                    '<button type="button" class="btn btn-danger btn-sm float-right quitarObligacionBtn">Quitar</button>'
                + '</li>'
            );
            $('input[name="Obligacion_Sujeto_Regulado"]').val('');
        }
    });
    $('#obligacionesList').on('click', '.quitarObligacionBtn', function() {
        $(this).parent().remove();
    });

    // Facultades
    $('#agregarFacultadBtn').click(function() {
        var facultad = $('input[name="Facultades_Obligaciones"]').val();
        if (facultad) {
            $('#facultadesList').append(
                '<li class="list-group-item">'
                    + facultad +
                    '<button type="button" class="btn btn-danger btn-sm float-right quitarFacultadBtn">Quitar</button>'
                + '</li>'
            );
            $('input[name="Facultades_Obligaciones"]').val('');
        }
    });
    $('#facultadesList').on('click', '.quitarFacultadBtn', function() {
        $(this).parent().remove();
    });

    // Mostrar/ocultar el botón "Añadir Fundamento"
    if ($('input[name="Fundamento_Juridico"]:checked').val() === 'si') {
        $('#btnAddFundamento').show();
    } else {
        $('#btnAddFundamento').hide();
    }
    $('input[name="Fundamento_Juridico"]').change(function() {
        if ($(this).val() === 'si') {
            $('#btnAddFundamento').show();
        } else {
            $('#btnAddFundamento').hide();
        }
    });

    // Envío del formulario vía AJAX (opcional)
    $('#inspeccionForm').on('submit', function(e) {
        // Si quieres usar AJAX, descomenta esto y maneja la respuesta
        // e.preventDefault();
        // ...
    });
});

/* ================== Funciones para el modal de Fundamento ================== */
function mostrarModalFundamento() {
    $('#modalFundamento').modal({
        backdrop: 'static',
        keyboard: false
    });
}

function cerrarModal() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Los cambios no guardados se perderán",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#8E354A',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, cerrar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#modalFundamento').modal('hide');
            // Limpiar campos del modal
            $('#modalFundamento select, #modalFundamento input[type="text"]').val('');
        }
    });
}

function validarYGuardar() {
    const tipoOrdenamiento = $('select[name="ID_tOrdJur"]').val();
    const nombreOrdenamiento = $('input[name="Nombre_Ordenamiento"]').val();

    if (!tipoOrdenamiento || tipoOrdenamiento === '' || !nombreOrdenamiento) {
        Swal.fire({
            icon: 'error',
            title: 'Campos requeridos',
            text: 'Por favor complete todos los campos marcados con *',
            confirmButtonColor: '#8E354A'
        });
        return;
    }
    guardarFundamento();
}

function guardarFundamento() {
    let nombreOrdenamiento = $('input[name="Nombre_Ordenamiento"]').val();
    let tipoOrdenamiento = $('select[name="ID_tOrdJur"] option:selected').text();

    let resumen = `
        <div class="alert alert-info">
            <strong>Tipo de Ordenamiento:</strong> ${tipoOrdenamiento} <br>
            <strong>Nombre del Ordenamiento:</strong> ${nombreOrdenamiento}
        </div>
    `;
    $('#listaFundamentos').append(resumen);

    // Guardar en el input hidden (JSON)
    let fundamentos = $('#fundamentos').val() ? JSON.parse($('#fundamentos').val()) : [];
    fundamentos.push({
        ID_tOrdJur: $('select[name="ID_tOrdJur"]').val(),
        Nombre_Ordenamiento: $('input[name="Nombre_Ordenamiento"]').val(),
        Articulo: $('input[name="Articulo"]').val(),
        Fraccion: $('input[name="Fraccion"]').val(),
        Inciso: $('input[name="Inciso"]').val(),
        Parrafo: $('input[name="Parrafo"]').val(),
        Numero: $('input[name="Numero"]').val(),
        Letra: $('input[name="Letra"]').val(),
        Otro: $('input[name="Otro"]').val()
    });
    $('#fundamentos').val(JSON.stringify(fundamentos));

    $('#modalFundamento').modal('hide');
    Swal.fire({
        icon: 'success',
        title: 'Guardado exitoso',
        text: 'El fundamento jurídico ha sido guardado',
        confirmButtonColor: '#8E354A',
        timer: 1500
    });

    // Limpiar campos
    $('#modalFundamento select, #modalFundamento input[type="text"]').val('');
}
</script>
@endsection