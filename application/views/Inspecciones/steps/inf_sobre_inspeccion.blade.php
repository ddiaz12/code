 
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
                    