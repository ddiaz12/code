<!-- =================== STEP 4: Más detalles =================== -->

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

<!-- Pasos a realizar por el inspector o verificador -->
<div class="form-group">
    <label>Pasos a realizar por el inspector o verificador durante la inspección, verificación o visita domiciliaria:</label>
    <textarea name="Pasos_Inspector" class="form-control" rows="3"></textarea>
</div>

<!-- Tramites vinculados -->
<div class="form-group">
    <label>Tramites vinculados a la inspección, verificación o visita domiciliaria<span class="text-danger">*</span></label>
    <input type="text" name="Nombre_Tramite" class="form-control" placeholder="Nombre del trámite" required>
    <input type="url" name="Url_Tramite" class="form-control" placeholder="URL del trámite" required>
</div>

<!-- Regulaciones que debe cumplir el sujeto obligado -->
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
    @foreach($sanciones as $sancion)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="Sanciones[]" value="{{ $sancion->Nombre }}">
            <label class="form-check-label">{{ $sancion->Nombre }}</label>
        </div>
    @endforeach
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="Sanciones[]" value="Otra">
        <label class="form-check-label">Otra: Especificar otra sanción</label>
        <input type="text" name="Otra_Sancion" class="form-control" placeholder="Especificar otra sanción">
    </div>
</div>

<!-- URL de la sanción -->
<div class="form-group">
    <label>URL de la sanción</label>
    <input type="url" name="Url_Sancion" class="form-control" placeholder="URL">
</div>

<!-- Tiempo aproximado de la inspección -->
<div class="form-group">
    <label>Tiempo aproximado de la inspección, verificación o visita domiciliaria<span class="text-danger">*</span></label>
    <input type="number" name="Valor_Plazo" class="form-control" placeholder="Valor del plazo" min="1" required>
    <select name="Unidad_Medida_Plazo" class="form-control" required>
        @foreach($tipos_tiempo as $tipo)
            <option value="{{ $tipo->ID }}">{{ $tipo->Tipo }}</option>
        @endforeach
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
        <input type="text" name="Facultades_Obligaciones" class="form-control" placeholder="Agregar Facultades, atribuciones y obligaciones" required>
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
