<div class="form-step" id="step-6"></div>
    <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Estadísticas</h3>
    <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;"></h5>
        Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
    </h5>

    <h8 class="mb-3">¿Cuántas inspecciones se realizaron en el año anterior por mes?<span class="text-danger">*</span></h8>
    <div class="statistics-container">
        <?php
        $meses = [
            ['Enero', 'Febrero', 'Marzo'],
            ['Abril', 'Mayo', 'Junio'],
            ['Julio', 'Agosto', 'Septiembre'],
            ['Octubre', 'Noviembre', 'Diciembre']
        ];
        foreach ($meses as $fila) {
            echo '<div class="statistics-row">';
            foreach ($fila as $mes) {
                $valor = isset($inspeccion) ? $inspeccion->{$mes . '_Inspecciones'} : '0';
                echo '<div class="statistics-item">
                        <label class="mes-label">' . $mes . ':</label>
                        <input type="number" name="' . $mes . '_Inspecciones" class="form-control statistics-input" min="0" value="' . $valor . '">
                      </div>';
            }
            echo '</div>';
        }
        ?>
    </div>
    <div class="form-group mt-4">
        <label>¿Cuántas inspecciones derivaron en sanción en el año inmediato anterior?<span class="text-danger">*</span></label>
        <input type="number" name="Inspecciones_Con_Sancion" class="form-control" min="0"
               value="{{ isset($inspeccion) ? $inspeccion->Inspecciones_Con_Sancion : '0' }}">
    </div>
</div>
