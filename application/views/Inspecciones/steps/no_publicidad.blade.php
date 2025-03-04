<!-- =================== STEP 8: No publicidad =================== -->

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
                