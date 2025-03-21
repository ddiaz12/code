<!-- =================== STEP 7: Información adicional =================== -->
 
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
                            Información adicional
                        </h3>
                        <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
                            Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                        </h5>
                        <div class="form-group">
                            <label><b>Información adicional</b></label>
                            <textarea name="info_adicional" class="form-control" placeholder="Ingresa cualquier información adicional">{{ isset($inspeccion->Informacion_Adicional) ? $inspeccion->Informacion_Adicional : '' }}</textarea>
                        </div>
