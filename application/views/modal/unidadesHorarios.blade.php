<div class="modal fade" id="modalAgregarHorario" tabindex="-1" aria-labelledby="modalAgregarHorarioLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarHorarioLabel">Agregar
                    Horario de Atención</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Campos para seleccionar día, hora de apertura y cierre -->
                <div class="mb-3">
                    <label for="selectDia" class="form-label">Día</label>
                    <select class="form-select" id="dia" name="dia">
                        <option value="lunes">Lunes</option>
                        <option value="martes">Martes</option>
                        <option value="miercoles">Miércoles</option>
                        <option value="jueves">Jueves</option>
                        <option value="viernes">Viernes</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputApertura" class="form-label">Hora de
                        Apertura</label>
                    <input type="time" class="form-control" id="apertura" name="apertura" required>
                </div>
                <div class="mb-3">
                    <label for="inputCierre" class="form-label">Hora de
                        Cierre</label>
                    <input type="time" class="form-control" id="cierre" name="cierre" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-guardar" id="btnGuardarHorario">Guardar</button>
            </div>
        </div>
    </div>
</div>
