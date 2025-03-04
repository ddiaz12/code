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
    <label><b>Tipo de inspección, verificación o visita domiciliaria</b><span class="text-danger">*</span></label>
    <select name="Tipo_Inspeccion" class="form-control" required>
        <option value="">Selecciona</option>
        @foreach($tipos_inspeccion as $tipo)
            <option value="{{ $tipo->ID }}" {{ isset($inspeccion) && $inspeccion->Tipo_Inspeccion == $tipo->ID ? 'selected' : '' }}>
                {{ $tipo->Tipo }}
            </option>
        @endforeach
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
        <option value="Físicas" {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Físicas' ? 'selected' : '' }}>
            Personas físicas</option>
        <option value="Físicas con actividad empresarial" {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Físicas con actividad empresarial' ? 'selected' : '' }}>Personas físicas con actividad empresarial</option>
        <option value="Morales" {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Morales' ? 'selected' : '' }}>
            Personas morales</option>
        <option value="Otras" {{ isset($inspeccion) && $inspeccion->Dirigida_A == 'Otras' ? 'selected' : '' }}>Otras
        </option>
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
        <option value="PREVENTIVA" {{ isset($inspeccion) && $inspeccion->Caracter_Inspeccion == 'PREVENTIVA' ? 'selected' : '' }}>PREVENTIVA (se realiza para prevenir algún impacto negativo)</option>
        <option value="REACTIVA" {{ isset($inspeccion) && $inspeccion->Caracter_Inspeccion == 'REACTIVA' ? 'selected' : '' }}>REACTIVA (como respuesta a un accidente o amenaza particular)</option>
        <option value="SEGUIMIENTO" {{ isset($inspeccion) && $inspeccion->Caracter_Inspeccion == 'SEGUIMIENTO' ? 'selected' : '' }}>SEGUIMIENTO (se da seguimiento al cumplimiento de alguna obligación en particular)
        </option>
    </select>
</div>

<!-- Realizada en -->
<div class="form-group">
    <label><b>Indique si la verificación, inspección o visita domiciliaria se realiza en:</b><span
            class="text-danger">*</span></label>
    <select name="Realizada_En" class="form-control" required>
        <option value="">Selecciona</option>
        <option value="Domicilio" {{ isset($inspeccion) && $inspeccion->Realizada_En == 'Domicilio' ? 'selected' : '' }}>
            En el domicilio o establecimientos de los Sujetos Regulados</option>
        <option value="Oficinas" {{ isset($inspeccion) && $inspeccion->Realizada_En == 'Oficinas' ? 'selected' : '' }}>En
            las oficinas del Sujeto Obligado</option>
        <option value="Electronicos" {{ isset($inspeccion) && $inspeccion->Realizada_En == 'Electronicos' ? 'selected' : '' }}>Medios electrónicos</option>
        <option value="Otro" {{ isset($inspeccion) && $inspeccion->Realizada_En == 'Otro' ? 'selected' : '' }}>Otro
        </option>
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
        <option value="Anual" {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Anual' ? 'selected' : '' }}>Anual
        </option>
        <option value="Bienal" {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Bienal' ? 'selected' : '' }}>Bienal
        </option>
        <option value="Diaria" {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Diaria' ? 'selected' : '' }}>Diaria
        </option>
        <option value="Mensual" {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Mensual' ? 'selected' : '' }}>
            Mensual</option>
        <option value="No aplica" {{ isset($inspeccion) && $inspeccion->Periodicidad == 'No aplica' ? 'selected' : '' }}>
            No aplica</option>
        <option value="Semanal" {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Semanal' ? 'selected' : '' }}>
            Semanal</option>
        <option value="Semestral" {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Semestral' ? 'selected' : '' }}>
            Semestral</option>
        <option value="Trineal o más" {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Trineal o más' ? 'selected' : '' }}>Trineal o más</option>
        <option value="Trimestral" {{ isset($inspeccion) && $inspeccion->Periodicidad == 'Trimestral' ? 'selected' : '' }}>Trimestral</option>
    </select>
</div>

<!-- Motivo de la inspección -->
<div class="form-group">
    <label><b>Especificar qué motiva la inspección, verificación o visita domiciliaria:</b><span
            class="text-danger">*</span></label>
    <select name="Motivo_Inspeccion" class="form-control" required>
        <option value="">Selecciona</option>
        <option value="Ordinaria" {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'Ordinaria' ? 'selected' : '' }}>Ordinaria</option>
        <option value="Extraordinaria" {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'Extraordinaria' ? 'selected' : '' }}>Extraordinaria</option>
        <option value="De oficio" {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'De oficio' ? 'selected' : '' }}>De oficio</option>
        <option value="A solicitud de parte" {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'A solicitud de parte' ? 'selected' : '' }}>A solicitud de parte</option>
        <option value="Forma parte de un trámite o servicio" {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'Forma parte de un trámite o servicio' ? 'selected' : '' }}>Forma parte de
            un trámite o servicio</option>
        <option value="Otro" {{ isset($inspeccion) && $inspeccion->Motivo_Inspeccion == 'Otro' ? 'selected' : '' }}>Otro
        </option>
    </select>
    <div id="especificarMotivoInspeccion" style="display: none;">
        <label>Especificar otro:</label>
        <input type="text" name="Especificar_Motivo_Inspeccion" class="form-control"
            value="{{ $inspeccion->Especificar_Motivo_Inspeccion ?? '' }}">
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
        <input type="url" name="URL_Tramite_Servicio" class="form-control" required
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
            <option value="Ley">Ley</option>
            <option value="Reglamento">Reglamento</option>
            <option value="Norma Oficial Mexicana">Norma Oficial Mexicana</option>
            <option value="Acuerdo">Acuerdo</option>
            <!-- etc. O llénalo dinámicamente con tu cat_tipo_ord_jur -->
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