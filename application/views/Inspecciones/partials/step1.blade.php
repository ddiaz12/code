<!-- =================== STEP 1: Datos de identificación =================== -->

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
    <input type="text" name="Modalidad" class="form-control" value="{{ $inspeccion->Modalidad ?? '' }}">
</div>
<!-- Tipo de inspección -->
<div class="form-group">
    <label>
        <b>Tipo de inspección, verificación o visita domiciliaria</b>
        <span class="text-danger">*</span>
    </label>
    <select name="Tipo_Inspeccion" class="form-control" required id="tipoInspeccionSelect">
        <option value="">Selecciona</option>
        @foreach($tipos_inspeccion as $tipo)
            <option value="{{ $tipo->ID }}" {{ isset($inspeccion) && $inspeccion->Tipo_Inspeccion == $tipo->ID ? 'selected' : '' }}>
                {{ $tipo->Tipo }}
            </option>
        @endforeach
    </select>
    <div id="especificarOtra" style="display: none;">
        <label>Especificar otra:</label>
        <input type="text" name="datos_extra[Especificar_Otra]" class="form-control" value="{{ $inspeccion->Especificar_Otra ?? '' }}">
    </div>
</div>

<!-- Sujeto Obligado -->
<div class="form-group">
    <label><b>Sujeto Obligado</b><span class="text-danger">*</span></label>
    <select name="Sujeto_Obligado_ID" class="form-control" required>
        <option value="">Selecciona un Sujeto Obligado</option>
        @foreach($sujetos_obligados as $so)
            <option value="{{ $so->ID_sujeto }}" {{ isset($inspeccion) && $inspeccion->Sujeto_Obligado_ID == $so->ID_sujeto ? 'selected' : '' }}>
                {{ $so->nombre_sujeto }}
            </option>
        @endforeach
    </select>
</div>

<!-- Ley de Fomento -->
<div class="form-group">
    <label><b>Ley de Fomento a la Confianza Ciudadana</b></label>
    <p style="font-size: 14px;">
        ¿La inspección, verificación o visita domiciliaria se encuentra exenta de la Ley de Fomento a la Confianza
        Ciudadana?<span class="text-danger">*</span>
    </p>
    <div>
        <label>
            <input type="radio" name="Ley_Fomento" value="si" {{ isset($inspeccion) && $inspeccion->Ley_Fomento == 'si' ? 'checked' : '' }}> Sí
        </label>
        <label>
            <input type="radio" name="Ley_Fomento" value="no" {{ isset($inspeccion) && $inspeccion->Ley_Fomento == 'no' ? 'checked' : '' }}> No
        </label>
    </div>
    <div id="justificarLeyFomento" style="display: none;">
        <label>
            Justificar si la inspección, verificación o visita domiciliaria son sujetas para todas o algunas de sus
            modalidades a suspensión conforme lo establecido en el artículo 1 y 13 de la Ley de Fomento a la Confianza
            Ciudadana:<span class="text-danger">*</span>
        </label>
        <textarea name="Justificacion_Ley_Fomento" class="form-control" rows="3"
            required>{{ $inspeccion->Justificacion_Ley_Fomento ?? '' }}</textarea>
    </div>
</div>

<!-- Dirigida a -->
<div class="form-group">
    <label><b>¿La inspección, verificación o visita domiciliaria va dirigida a personas físicas, morales o
            ambas?</b><span class="text-danger">*</span></label>
    <select name="Dirigida_A" class="form-control" required>
        <option value="">Selecciona</option>
        @foreach($destinatarios as $destinatario)
            <option value="{{ $destinatario->ID }}" {{ isset($inspeccion) && $inspeccion->Dirigida_A == $destinatario->ID ? 'selected' : '' }}>
                {{ $destinatario->Destinatario }}
            </option>
        @endforeach
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
        @foreach($caracteres_inspeccion as $caracter)
            <option value="{{ $caracter->ID }}" {{ isset($inspeccion) && $inspeccion->Caracter_Inspeccion == $caracter->ID ? 'selected' : '' }}>
                {{ $caracter->Clasificacion }} ({{ $caracter->Descripcion }})
            </option>
        @endforeach
    </select>
</div>

<!-- Realizada en -->
<div class="form-group">
    <label><b>Indique si la verificación, inspección o visita domiciliaria se realiza en:</b><span class="text-danger">*</span></label>
    <select name="Realizada_En" class="form-control" required>
        <option value="">Selecciona</option>
        @foreach($lugares_realizacion as $lugar)
            <option value="{{ $lugar->ID }}" {{ isset($inspeccion) && $inspeccion->Realizada_En == $lugar->ID ? 'selected' : '' }}>
                {{ $lugar->Lugar }}
            </option>
        @endforeach
    </select>
    <div id="especificarRealizadaEn" style="display: none;">
        <label>Otros:</label>
        <input type="text" name="Especificar_Realizada_En" class="form-control"
            value="{{ $inspeccion->Especificar_Realizada_En ?? '' }}">
    </div>
</div>

<!-- Objetivo -->
<div class="form-group">
    <label><b>¿Cuál es el objetivo de la inspección, verificación o visita domiciliaria?</b><span
            class="text-danger">*</span></label>
    <textarea name="Objetivo" class="form-control" rows="3" required>{{ $inspeccion->Objetivo ?? '' }}</textarea>
</div>

<!-- Palabras clave -->
<div class="form-group">
    <label><b>Palabras clave que describan o identifiquen las inspecciones, verificaciones y visitas
            domiciliarias:</b><span class="text-danger">*</span></label>
    <textarea name="Palabras_Clave" class="form-control" rows="2"
        required>{{ $inspeccion->Palabras_Clave ?? '' }}</textarea>
</div>

<!-- Periodicidad -->
<div class="form-group">
    <label><b>Periodicidad en la que se realiza:</b><span class="text-danger">*</span></label>
    <select name="Periodicidad" class="form-control" required>
        <option value="">Selecciona</option>
        @foreach($periodicidades as $periodicidad)
            <option value="{{ $periodicidad->ID }}" {{ isset($inspeccion) && $inspeccion->Periodicidad == $periodicidad->ID ? 'selected' : '' }}>
                {{ $periodicidad->Periodicidad }}
            </option>
        @endforeach
    </select>
</div>

<!-- Motivo de la inspección -->
<div class="form-group">
    <label><b>Especificar qué motiva la inspección, verificación o visita domiciliaria:</b><span class="text-danger">*</span></label>
    <select name="Motivo_Inspeccion" class="form-control" required>
        <option value="">Selecciona</option>
        @foreach($motivos_inspeccion as $motivo)
            <option value="{{ $motivo->ID }}" {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == $motivo->ID ? 'selected' : '' }}>
                {{ $motivo->Motivo }}
            </option>
        @endforeach
    </select>
    <div id="especificarMotivoInspeccion" style="display: none;">
        <label>Especificar otro:</label>
        <input type="text" name="Especificar_Motivo_Inspeccion" class="form-control" value="{{ $inspeccion->Especificar_Motivo_Inspeccion ?? '' }}">
    </div>
</div>

<!-- Nombre de trámite o servicio -->
<div class="form-group">
    <label><b>Nombre de trámite o servicio asociado en esta inspección, verificación o visita domiciliaria:</b><span
            class="text-danger">*</span></label>
    <div>
        <label>Nombre del servicio o trámite:</label>
        <input type="text" name="Nombre_Tramite_Servicio" class="form-control" required
            value="{{ $inspeccion->Nombre_Tramite_Servicio ?? '' }}">
    </div>
    <div>
        <label>URL relacionado:</label>
        <input type="url" name="URL_Tramite_Servicio" class="form-control" required pattern="^https?:\/\/.*\.com(\b|\/|$)"
            value="{{ $inspeccion->URL_Tramite_Servicio ?? '' }}">
    </div>
</div>

<!-- ========== Fundamento jurídico ========== -->
<div class="form-group">
    <label><b>¿Existe un fundamento jurídico que dé origen a la inspección, verificación o visita domiciliaria?</b><span
            class="text-danger">*</span></label>
    <div>
        <label>
            <input type="radio" name="Fundamento_Juridico" value="si" {{ isset($inspeccion) && $inspeccion->Fundamento_Juridico == 'si' ? 'checked' : '' }}>
            Sí
        </label>
        <label>
            <input type="radio" name="Fundamento_Juridico" value="no" {{ isset($inspeccion) && $inspeccion->Fundamento_Juridico == 'no' ? 'checked' : '' }}>
            No
        </label>
    </div>

    <!-- Botón para abrir el modal (solo cuando se seleccione "sí") -->
    <button type="button" class="btn btn-link" id="btnAddFundamento" style="display:none;"
        onclick="mostrarModalFundamento()">
        <i class="fas fa-plus-circle"></i> Añadir Fundamento
    </button>
</div>
<!-- ===================== Sección de Fundamentos (se muestra solo si la respuesta es "Sí") ===================== -->
<div id="fundamentosContainer" style="display: none; margin-top: 20px;">
    <h5>Fundamentos jurídicos</h5>

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
            @foreach($tipos_ordenamiento as $tipo)
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
            <input type="number" id="numero" class="form-control" max="9999999999" oninput="if(this.value.length > 10) this.value = this.value.slice(0,10);">
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

<!-- Incluir el archivo JavaScript solo una vez al final del step -->
<script src="{{ base_url('assets/js/insp_steps/step1.js') }}"></script>