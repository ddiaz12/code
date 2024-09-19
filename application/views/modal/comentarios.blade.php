<div class="modal fade" id="comentariosModal" tabindex="-1" aria-labelledby="comentariosModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="comentariosModalLabel">Comentarios</h5>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="comentarioNuevo" placeholder="Comentario"></textarea>
                    <div class="input-group my-2">
                        <input type="text" id="buscarComentario" class="form-control" placeholder="Buscar comentario">
                        <div class="input-group-append">
                            <button class="btn btn-dorado" id="buscarBtn">Buscar</button>
                        </div>
                    </div>

                    <!-- Aquí se mostrarán los comentarios -->
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Comentario</th>
                                <th>Usuario</th>
                                <th>Fecha y hora de creación</th>
                            </tr>
                        </thead>
                        <tbody id="comentariosContent">
                            <!-- Aquí se insertarán los comentarios via AJAX -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-tinto"
                        id="guardarComentarioBtn">Guardar</button>
                </div>
            </div>
        </div>
    </div>