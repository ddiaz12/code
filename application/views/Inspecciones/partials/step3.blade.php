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
        <input type="text" name="Buscar_Sujeto_Obligado" class="form-control" placeholder="Buscar Sujeto Obligado" id="buscarSujetosInput">
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
                                        <button type="button" class="btn btn-primary seleccionarSujetoBtn" data-sujeto="{{ $sujeto->nombre_sujeto }}">
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

<!-- Sección Derechos -->
<div class="form-group">
    <label>Derechos del sujeto regulado durante la inspección, verificación o visita domiciliaria</label>
    <div class="input-group">
        <input type="text" id="derechoInput" class="form-control" placeholder="Agregar derecho del sujeto regulado">
        <div class="input-group-append">
            <button type="button" id="agregarDerechoBtn" class="btn btn-outline-secondary"></button>
                <i class="fas fa-plus"></i> Agregar
            </button>
        </div>
    </div>
    <ul id="derechosList" class="list-group mt-2"></ul>
</div>

<div class="table-responsive mt-3" id="tablaDerechosContainer" style="display: none;">
    <table class="table table-bordered" id="tablaDerechos">
        <thead>
            <tr>
                <th>Derecho</th>
                <th>Tipo de ordenamiento</th>
                <th>Nombre del Ordenamiento</th>
                <th>Artículo</th>
                <th>Inciso</th>
                <th>Párrafo</th>
                <th>Número</th>
                <th>Letra</th>
                <th>Otros</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Filas agregadas dinámicamente -->
        </tbody>
    </table>
</div>
<input type="hidden" name="step3[derechos]" id="inputDerechosOculto">

<!-- Modal para seleccionar Tipo de ordenamiento -->
<div id="modalAgregarDerecho" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAgregarDerechoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarDerechoLabel">Seleccionar Tipo de Ordenamiento</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="selectTipoOrdenamiento">Tipo de ordenamiento:</label>
          <select id="selectTipoOrdenamiento" class="form-control">
            <option value="">Seleccione...</option>
            @if(isset($cat_tipo_ord_jur) && count($cat_tipo_ord_jur) > 0)
              @foreach($cat_tipo_ord_jur as $tipo)
                <option value="{{ $tipo->ID_tOrdJur }}">{{ $tipo->Tipo_Ordenamiento }}</option>
              @endforeach
            @endif
          </select>
        </div>
        <!-- Campos opcionales -->
        <div class="form-group">
          <label for="nombreOrdenamiento">Nombre del Ordenamiento:</label>
          <input type="text" id="nombreOrdenamiento" class="form-control" placeholder="Nombre del Ordenamiento">
        </div>
        <div class="form-group">
          <label for="articulo">Artículo:</label>
          <input type="text" id="articulo" class="form-control" placeholder="Artículo">
        </div>
        <div class="form-group">
          <label for="fraccion">Fracción:</label>
          <input type="text" id="fraccion" class="form-control" placeholder="Fracción">
        </div>
        <div class="form-group">
          <label for="incisio">Inciso:</label>
          <input type="text" id="incisio" class="form-control" placeholder="Inciso">
        </div>
        <div class="form-group">
          <label for="parrafo">Párrafo:</label>
          <input type="text" id="parrafo" class="form-control" placeholder="Párrafo">
        </div>
        <div class="form-group">
          <label for="numero">Número:</label>
          <input type="number" id="numero" class="form-control" placeholder="Número">
        </div>
        <div class="form-group">
          <label for="letra">Letra:</label>
          <input type="text" id="letra" class="form-control" placeholder="Letra">
        </div>
        <div class="form-group">
          <label for="otros">Otros:</label>
          <input type="text" id="otros" class="form-control" placeholder="Otros">
        </div>
        <!-- Fin campos opcionales -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="guardarModalBtn" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin sección Derechos -->

<!-- Sección Obligaciones -->
<div class="form-group">
    <label>Obligaciones que debe cumplir el sujeto regulado</label>
    <div class="input-group">
        <input type="text" id="obligacionInput" class="form-control" placeholder="Escribe la obligación">
        <button type="button" id="agregarObligacionBtn" class="btn btn-primary mt-2" disabled>Agregar Obligación</button>
    </div>
</div>

<div class="table-responsive mt-3">
    <table class="table table-bordered" id="tablaObligaciones">
        <thead>
            <tr>
                <th>Obligación</th>
                <th>Tipo de ordenamiento</th>
                <th>Nombre del ordenamiento</th> <!-- Nueva columna -->
                <th>Artículo</th>
                <th>Inciso</th>
                <th>Párrafo</th>
                <th>Número</th>
                <th>Letra</th>
                <th>Otros</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Filas agregadas dinámicamente -->
        </tbody>
    </table>
</div>
<input type="hidden" name="step3[obligaciones]" id="inputObligacionesOculto">

<!-- Modal para capturar datos de la Obligación -->
<div class="modal fade" id="modalAgregarObligacion" tabindex="-1" role="dialog" aria-labelledby="modalAgregarObligacionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarObligacionLabel">Datos de la Obligación</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Tipo de ordenamiento -->
        <div class="form-group">
          <label for="selectTipoOrdenamientoObligacion">Tipo de ordenamiento:</label>
          <select id="selectTipoOrdenamientoObligacion" class="form-control">
            <option value="">Seleccione...</option>
            @if(isset($cat_tipo_ord_jur) && count($cat_tipo_ord_jur) > 0)
              @foreach($cat_tipo_ord_jur as $tipo)
                <option value="{{ $tipo->ID_tOrdJur }}">{{ $tipo->Tipo_Ordenamiento }}</option>
              @endforeach
            @endif
          </select>
        </div>
        <!-- Campo: Nombre del ordenamiento -->
        <div class="form-group">
          <label for="nombreOrdenamientoObligacion">Nombre del Ordenamiento:</label>
          <input type="text" id="nombreOrdenamientoObligacion" class="form-control" placeholder="Nombre del Ordenamiento">
        </div>
        <!-- Opcionales: Artículo, Fracción, Inciso, Párrafo, Número, Letra, Otros -->
        <div class="form-group">
          <label for="inputArticuloObligacion">Artículo:</label>
          <input type="text" id="inputArticuloObligacion" class="form-control" placeholder="Artículo">
        </div>
        <div class="form-group">
          <label for="inputFraccionObligacion">Fracción:</label>
          <input type="text" id="inputFraccionObligacion" class="form-control" placeholder="Fracción">
        </div>
        <div class="form-group">
          <label for="inputIncisoObligacion">Inciso:</label>
          <input type="text" id="inputIncisoObligacion" class="form-control" placeholder="Inciso">
        </div>
        <div class="form-group">
          <label for="inputParrafoObligacion">Párrafo:</label>
          <input type="text" id="inputParrafoObligacion" class="form-control" placeholder="Párrafo">
        </div>
        <div class="form-group">
          <label for="inputNumeroObligacion">Número:</label>
          <input type="number" id="inputNumeroObligacion" class="form-control" placeholder="Número">
        </div>
        <div class="form-group">
          <label for="inputLetraObligacion">Letra:</label>
          <input type="text" id="inputLetraObligacion" class="form-control" placeholder="Letra">
        </div>
        <div class="form-group">
          <label for="inputOtrosObligacion">Otros:</label>
          <input type="text" id="inputOtrosObligacion" class="form-control" placeholder="Otros">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="guardarObligacionModalBtn" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Fundamento Jurídico -->
<div class="form-group">
    <label>Fundamento Jurídico de la existencia de la inspección, verificación o visita domiciliaria:<span class="text-danger">*</span></label>
    <div class="input-group">
        <input type="text" name="Nombre_Fundamento" class="form-control" placeholder="Nombre" required>
        <input type="text" name="Articulo_Fundamento" class="form-control" placeholder="Artículo" required>
        <input type="url" name="Url_Fundamento" class="form-control" placeholder="URL" required>
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
    <label>Subir formato (PDF, JPG, PNG):</label>
    <input type="file" name="Archivo_Formato" class="form-control-file" accept=".pdf,.jpg,.png">
</div>