<!-- =================== STEP 9: Emergencias =================== -->

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
            <label>Justificar las razones por las cuales se habilita una inspección para atender una situación de
                emergencia</label>
            <textarea name="Justificacion_Emergencia" class="form-control"
                rows="3">{{ $inspeccion->Justificacion_Emergencia ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <label>Cargar el oficio o acta de declaración de emergencia (PDF, PNG, JPG)<span
                    class="text-danger">*</span></label>
            <input type="file" name="Archivo_Declaracion_Emergencia" class="form-control-file" accept=".pdf,.jpg,.png">
        </div>
    </div>
</div>
