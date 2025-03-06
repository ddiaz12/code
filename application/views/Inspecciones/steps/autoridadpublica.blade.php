<!-- =================== STEP 2: Autoridad Pública =================== -->

<h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
    Autoridad pública
</h3>
<h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
    Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
</h5>
<div class="form-group">
    <label>Información de las autoridades competentes</label>
    <div class="input-group">
        <input type="text" name="Oficina_Administrativa" class="form-control" placeholder="Buscar oficinas"
            id="buscarOficinasInput">
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
<div id="oficinasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="oficinasModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oficinasModalLabel">Seleccionar Oficina Administrativa</h5>
                <!-- Usa data-bs-dismiss="modal" para Bootstrap 5 -->
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                        @if(isset($unidades_administrativas) && count($unidades_administrativas) > 0)
                            @foreach($unidades_administrativas as $unidad)
                                <tr>
                                    <td>{{ $unidad->nombre }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary seleccionarOficinaBtn"
                                            data-oficina="{{ $unidad->nombre }}">
                                            Seleccionar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2">No se encontraron unidades administrativas registradas.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <!-- Cambia si fuera Bootstrap 5: data-bs-dismiss="modal" -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-primary" id="aceptarOficinaBtn" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ base_url('assets/js/insp_steps/autoridad_publica.js') }}"></script>