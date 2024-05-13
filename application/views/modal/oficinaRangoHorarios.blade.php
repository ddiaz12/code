<div class="modal fade" id="modalAgregarRangoHorario" tabindex="-1" aria-labelledby="modalAgregarRangoHorarioLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarRangoHorarioLabel">
                    Agregar
                    Rango de Horario de Atención</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Campos para seleccionar rango de días, hora de apertura y cierre -->
                <div class="mb-3">
                    <label for="diaDesde" class="form-label">Desde el
                        día</label>
                    <select class="form-select" id="diaDesde" name="diaDesde">
                        <option value="lunes">Lunes</option>
                        <option value="martes">Martes</option>
                        <option value="miercoles">Miércoles</option>
                        <option value="jueves">Jueves</option>
                        <option value="viernes">Viernes</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="diaHasta" class="form-label">Hasta el
                        día</label>
                    <select class="form-select" id="diaHasta" name="diaHasta">
                        <option value="lunes">Lunes</option>
                        <option value="martes">Martes</option>
                        <option value="miercoles">Miércoles</option>
                        <option value="jueves">Jueves</option>
                        <option value="viernes">Viernes</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="aperturaRango" class="form-label">Hora de
                        Apertura</label>
                    <input type="time" class="form-control" id="aperturaRango" name="aperturaRango">
                </div>
                <div class="mb-3">
                    <label for="cierreRango" class="form-label">Hora de
                        Cierre</label>
                    <input type="time" class="form-control" id="cierreRango" name="cierreRango">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-guardar" id="btnGuardarRangoHorario">Guardar</button>
            </div>
        </div>
    </div>
</div>
