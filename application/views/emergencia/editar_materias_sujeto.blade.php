@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones
@endsection
@section('navbar')
@include('templates/navbarSujeto')
@endsection
@section('menu')
@include('templates/menuSujeto')
@endsection

@section('contenido')
<ol class="breadcrumb mb-4 mt-5">
    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
    </li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('emergency'); ?>"><i
                class="fas fa-file-alt me-1"></i>Emergencia</a>
    </li>
    <li class="breadcrumb-item active"><i class="fa-solid fa-plus-circle me-1"></i>Edición al Registro Estatal de
    Regulaciones (RER)
    </li>
</ol>
<div class="container mt-5">
    <div class="row justify-content-center div-formOficina">
        <div class="row d-flex d-flex align-items-stretch">
            <div class="col-md-3 p-0 d-flex flex-column">
                <!-- New card -->
                <style>
                    .custom-link {
                        color: black;
                        cursor: pointer !important;
                        font-size: 19px;
                        /* Adjust as needed */
                    }

                    .custom-link:hover {
                        color: gray;
                        text-decoration: none;
                    }

                    .custom-link i {
                        font-size: 24px;
                        /* Adjust as needed */
                    }
                </style>
                <div class="card flex-grow-1 bordes">
                    <div class="card" style="border: none;">
                        <div class="card-body" style="border: none;">
                            <ul class="list-unstyled lista-regulacion">
                                <li class="iconos-regulacion">
                                    <a href="<?php echo base_url('emergency/edit_caract/' . $regulacion['ID_Regulacion']); ?>"
                                        class="custom-link">
                                        <i class="fa-solid fa-list-check fa-sm"></i>
                                        <label class="menu-regulacion" for="image_1">Características de la
                                            Regulación</label>
                                    </a>
                                </li>
                                <p></p>
                                <li class="iconos-regulacion active-view">
                                    <a href="<?php echo base_url('emergency/edit_mat/' . $regulacion['ID_Regulacion']); ?>"
                                        class="custom-link">
                                        <i class="fa-solid fa-table-list fa-sm"></i>
                                        <label class="menu-regulacion" for="image_2">Materias Exentas</label>
                                    </a>
                                </li>
                                <p></p>
                                <li class="iconos-regulacion">
                                    <a href="<?php echo base_url('emergency/edit_nat/' . $regulacion['ID_Regulacion']); ?>"
                                        class="custom-link">
                                        <i class="fa-solid fa-book fa-sm"></i>
                                        <label class="menu-regulacion" for="image_3">Naturaleza de la Regulación</label>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 p-0">
                <div class="card">
                    <div class="card-header text-white">Materias Exentas</div>
                    <div id="form-regulacion" class="card-body align-content-center justify-content-center align-items-center div-card-body">
                        <div class="align-content-center justify-content-center align-items-center">
                            <div>
                                <label for=" radioGroup">¿Existen materias que se exceptúan de la
                                    regulación?</label>
                            </div>
                            <div id="radioGroup">
                                <input type="radio" id="si" name="opcion" value="si">
                                <label for="si">Sí</label>
                                <input type="radio" id="no" name="opcion" value="no" checked>
                                <label  for="no">No</label>
                            </div>
                        </div>
                        <br>
                        <div class="align-content-center d-flex justify-content-center align-items-center">
                            <div id="checkboxes" style=" flex-wrap: wrap; column-count: 3;">
                                <div>
                                    <input type="checkbox" id="checkbox1" name="Fiscal" value="Fiscal">
                                    <label for="checkbox1" class="text-mat">Fiscal</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox2" name="Aduanera" value="Aduanera">
                                    <label for="checkbox2" class="text-mat">Aduanera</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox3" name="Armas de fuego y explosivos"
                                        value="Armas de fuego y explosivos">
                                    <label for="checkbox3" class="text-mat">Armas de fuego y explosivos</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox4" name="Comercio exterior"
                                        value="Comercio exterior">
                                    <label for="checkbox4" class="text-mat">Comercio exterior</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox5" name="Constatar medidas de protección civil"
                                        value="Constatar medidas de protección civil">
                                    <label for="checkbox5" class="text-mat">Constatar medidas de protección civil</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox6" name="Derechos e intereses del consumidor"
                                        value="Derechos e intereses del consumidor">
                                    <label for="checkbox6" class="text-mat">Derechos e intereses del consumidor</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox7" name="Infraestructura y/o construcción"
                                        value="Infraestructura y/o construcción">
                                    <label for="checkbox7" class="text-mat">Infraestructura y/o construcción</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox8" name="Medio ambiente" value="Medio ambiente">
                                    <label for="checkbox8" class="text-mat">Medio ambiente</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox9"
                                        name="Operaciones con recursos de procedencia ilícita"
                                        value="Operaciones con recursos de procedencia ilícita">
                                    <label for="checkbox9" class="text-mat">Operaciones con recursos de procedencia ilícita</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox10" name="Otra" value="Otra">
                                    <label for="checkbox10" class="text-mat">Otra</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox11" name="Programas sociales"
                                        value="Programas sociales">
                                    <label for="checkbox11" class="text-mat">Programas sociales</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox12" name="Protección contra riesgos sanitarios"
                                        value="Protección contra riesgos sanitarios">
                                    <label for="checkbox12" class="text-mat">Protección contra riesgos sanitarios</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox13"
                                        name="Proteger la sanidad y la inocuidad agroalimentaria, animal y vegetal"
                                        value="Proteger la sanidad y la inocuidad agroalimentaria, animal y vegetal">
                                    <label for="checkbox13" class="text-mat">Proteger la sanidad y la inocuidad agroalimentaria, animal y
                                        vegetal</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox14" name="Recursos naturales"
                                        value="Recursos naturales">
                                    <label for="checkbox14" class="text-mat">Recursos naturales</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox15" name="Resguardar la seguridad Nacional"
                                        value="Resguardar la seguridad Nacional">
                                    <label for="checkbox15" class="text-mat">Resguardar la seguridad Nacional</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox16"
                                        name="Revisión de contratos petroleros (art. 37-B-VII y 63 LISH)"
                                        value="Revisión de contratos petroleros (art. 37-B-VII y 63 LISH)">
                                    <label for="checkbox16" class="text-mat">Revisión de contratos petroleros (art. 37-B-VII y 63
                                        LISH)</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox17" name="Salud humana" value="Salud humana">
                                    <label for="checkbox17" class="text-mat">Salud humana</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox18"
                                        name="Salud pública, medicamentos, asistencia sanitaria y/o sanidad"
                                        value="Salud pública, medicamentos, asistencia sanitaria y/o sanidad">
                                    <label for="checkbox18" class="text-mat">Salud pública, medicamentos, asistencia sanitaria y/o
                                        sanidad</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox19" name="Sector financiero"
                                        value="Sector financiero">
                                    <label for="checkbox19" class="text-mat">Sector financiero</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox20" name="Seguridad alimentaria"
                                        value="Seguridad alimentaria">
                                    <label for="checkbox20" class="text-mat">Seguridad alimentaria</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox21" name="Seguridad de la población"
                                        value="Seguridad de la población">
                                    <label for="checkbox21" class="text-mat">Seguridad de la población</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox22"
                                        name="Seguridad de los productos no alimentarios y protección del consumidor"
                                        value="Seguridad de los productos no alimentarios y protección del consumidor">
                                    <label for="checkbox22" class="text-mat">Seguridad de los productos no alimentarios y protección del
                                        consumidor</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox23" name="Seguridad nuclear"
                                        value="Seguridad nuclear">
                                    <label for="checkbox23" class="text-mat">Seguridad nuclear</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox24" name="Seguridad social"
                                        value="Seguridad social">
                                    <label for="checkbox24" class="text-mat">Seguridad social</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox25" name="Seguridad, protección y salud laboral"
                                        value="Seguridad, protección y salud laboral">
                                    <label for="checkbox25"class="text-mat">Seguridad, protección y salud laboral</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox26" name="Trabajo" value="Trabajo">
                                    <label for="checkbox26" class="text-mat">Trabajo</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox27" name="Transporte" value="Transporte">
                                    <label for="checkbox27"class="text-mat">Transporte</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox28" name="Turismo" value="Turismo">
                                    <label for="checkbox28" class="text-mat">Turismo</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox29" name="checkbox29" value="checkbox29">
                                    <label for="checkbox29" class="text-mat">Todas las anteriores</label>
                                </div>
                                <script>
                                $(document).ready(function() {
                                    $('#checkbox29').change(function() {
                                        var isChecked = $(this).is(':checked');
                                        // Seleccionar todos los checkboxes anteriores a checkbox29
                                        $('#checkbox29').parent().prevAll().find('input[type="checkbox"]').prop('checked', isChecked);
                                    });

                                    // Manejar el evento de cambio en todos los checkboxes anteriores a checkbox29
                                    $('input[type="checkbox"]').not('#checkbox29').change(function() {
                                        if (!$(this).is(':checked')) {
                                            $('#checkbox29').prop('checked', false);
                                        }
                                    });
                                });
                                </script>
                                <div>
                                    <input type="checkbox" id="checkbox30" name="No Aplican" value="checkbox30">
                                    <label for="checkbox30" class="text-mat">No Aplican</label>
                                </div>
                                <script>
                                $(document).ready(function() {
                                    $('#checkbox30').change(function() {
                                        var isChecked = $(this).is(':checked');
                                        if (isChecked) {
                                            // Deseleccionar todos los checkboxes anteriores a checkbox30
                                            $('#checkbox30').parent().prevAll().find('input[type="checkbox"]').prop('checked', false);
                                        }
                                    });
                                });
                                </script>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <a href="<?php echo base_url('emergency'); ?>"
                        id="cancelButton" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" id="btnCheck" class="btn btn-guardar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
        $(document).ready(function() {
            var formModified = false;

            // Detectar cambios en los campos del formulario
            $('#form-regulacion').on('change input', function() {
                formModified = true;
            });

            // Interceptar clics en los enlaces
            $('a').on('click', function(event) {
                if (formModified) {
                    event.preventDefault(); // Prevenir la acción predeterminada del enlace
                    var href = $(this).attr('href');
                    Swal.fire({
                        title: 'Advertencia',
                        text: 'Se perderán los datos ingresados',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, continuar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = href;
                        }
                    });
                }
            });
        });
</script>
<script>
$(document).ready(function() {
    $('#cancelButton').click(function(event) {
        event.preventDefault(); // Prevenir la acción predeterminada del enlace
        Swal.fire({
            title: 'Advertencia',
            text: 'Se perderán los datos ingresados',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?php echo base_url('emergency'); ?>';
            }
        });
    });
});
</script>
<script>
    $(document).ready(function () {

    });
</script>
<script>
    $(document).ready(function () {
        $('input[type=radio][name=opcion]').change(function () {
            if (this.value == 'si') {
                $('#checkboxes input[type=checkbox]').prop('disabled', false); // Desbloquear los checkboxes
            } else if (this.value == 'no') {
                $('#checkboxes input[type=checkbox]').prop('disabled', true); // Bloquear los checkboxes
            }
        });

        // Inicializar el estado de los checkboxes basado en el radio button seleccionado por defecto
        if ($('input[type=radio][name=opcion]:checked').val() == 'no') {
            $('#checkboxes input[type=checkbox]').prop('disabled', true); // Bloquear los checkboxes
        }
    });
</script>
<script>
    // Obtener el id_regulacion de la vista
    var id_regulacion = <?= json_encode($regulacion['ID_Regulacion']) ?>;
    var idMaterias = [];
    $(document).ready(function () {
        // Obtener el id_regulacion de la vista
        var id_regulacion = <?= json_encode($regulacion['ID_Regulacion']) ?>;

        // Realizar la solicitud AJAX para obtener los registros
        $.ajax({
            url: '<?= base_url("RegulacionController/getMateriasExentas") ?>',
            type: 'POST',
            data: {
                id_regulacion: id_regulacion
            },
            dataType: 'json',
            success: function (response) {
                console.log('Registros obtenidos:', response);

                // Obtener los ID_Materia de los registros obtenidos
                idMaterias = response.map(function (item) {
                    return item.ID_Materias;
                });
                console.log('ID_Materias:', idMaterias);

                // Si el array idMaterias no está vacío, marcar el input radio con id "si"
                if (idMaterias.length > 0) {
                    $('#si').prop('checked', true);
                    $('#checkboxes').show();
                }

                // Realizar la solicitud AJAX para obtener los nombres de las materias
                $.ajax({
                    url: '<?= base_url("RegulacionController/getNombresMaterias") ?>',
                    type: 'POST',
                    data: {
                        idMaterias: idMaterias
                    },
                    dataType: 'json',
                    success: function (response) {
                        //console.log('Nombres de materias obtenidos:', response);

                        // Comparar los nombres de las materias con los nombres de los checkboxes
                        var nombresMaterias = response.map(function (item) {
                            return item.Nombre_Materia;
                        });
                        console.log('Nombres de materias:', nombresMaterias);

                        $('#checkboxes input[type="checkbox"]').each(function () {
                            var checkboxName = $(this).attr('name');
                            if (nombresMaterias.includes(checkboxName)) {
                                $(this).prop('checked', true);
                            }
                        });
                    },
                    error: function () {
                        console.error(
                            'Error en la solicitud AJAX para obtener los nombres de las materias.'
                        );
                    }
                });
            },
            error: function () {
                console.error('Error en la solicitud AJAX para obtener los registros.');
            }
        });
        $('#btnCheck').on('click', function (event) {
            event.preventDefault(); // Evitar el envío del formulario

            if ($('#si').is(':checked')) {
                var selectedLabels = [];

                $('input[type="checkbox"]').each(function () {
                    if ($(this).is(':checked')) {
                        var label = $('label[for="' + $(this).attr('id') + '"]').text();
                        selectedLabels.push(label);
                    }
                });

                // Imprimir los textos de los labels en la consola
                console.log(selectedLabels);
                if (selectedLabels.length === 0) {
                    alert('Por favor, seleccione al menos una materia.');
                    return;
                } else {
                    if (idMaterias.length === 0) {
                        // Hacer una solicitud AJAX para obtener los ID_materia y el último ID_Regulacion
                        $.ajax({
                            url: '<?= base_url("RegulacionController/obtenerMaterias") ?>',
                            type: 'POST',
                            data: {
                                id_regulacion: id_regulacion,
                                labels: selectedLabels
                            },
                            success: function (response) {
                                var result = JSON.parse(response);
                                if (result.status === 'success') {
                                    var idMaterias = result.idMaterias;
                                    var id_regulacion = result.id_regulacion;

                                    // Imprimir los ID_materia y el último ID_Regulacion en la consola
                                    console.log('ID_materias:', idMaterias);
                                    console.log('id_regulacion:', id_regulacion);

                                    // Hacer una solicitud AJAX para insertar los datos en la tabla rel_regulaciones_materias
                                    $.ajax({
                                        url: '<?= base_url("RegulacionController/insertarRelRegulacionesMaterias") ?>',
                                        type: 'POST',
                                        data: {
                                            idMaterias: idMaterias,
                                            ultimoIDRegulacion: id_regulacion
                                        },
                                        success: function (insertResponse) {
                                            var insertResult = JSON.parse(insertResponse);
                                            if (insertResult.status === 'success') {
                                                console.log('Datos insertados correctamente en rel_regulaciones_materias');
                                                // Redirigir al usuario al enlace especificado
                                                window.location.href = '<?= base_url("emergency/edit_nat/"); ?>' + id_regulacion;
                                            } else {
                                                console.error('Error al insertar datos:', insertResult.message);
                                            }
                                        },
                                        error: function (error) {
                                            console.error('Error en la solicitud AJAX:', error);
                                        }
                                    });
                                } else {
                                    console.error('Error:', result.message);
                                }
                            },
                            error: function (error) {
                                console.error('Error en la solicitud AJAX:', error);
                            }
                        });
                    } else {
                        $.ajax({
                            url: '<?= base_url("RegulacionController/eliminarMateriasExentas") ?>',
                            type: 'POST',
                            data: {
                                id_regulacion: id_regulacion
                            },
                            success: function (deleteResponse) {
                                var deleteResult = JSON.parse(deleteResponse);
                                if (deleteResult.status === 'success') {
                                    console.log('Registros eliminados correctamente.');

                                    // Hacer una solicitud AJAX para obtener los ID_materia y el último ID_Regulacion
                                    $.ajax({
                                        url: '<?= base_url("RegulacionController/obtenerMaterias") ?>',
                                        type: 'POST',
                                        data: {
                                            id_regulacion: id_regulacion,
                                            labels: selectedLabels
                                        },
                                        success: function (response) {
                                            var result = JSON.parse(response);
                                            if (result.status === 'success') {
                                                var idMaterias = result.idMaterias;
                                                var id_regulacion = result.id_regulacion;

                                                // Imprimir los ID_materia y el último ID_Regulacion en la consola
                                                console.log('ID_materias:', idMaterias);
                                                console.log('id_regulacion:', id_regulacion);

                                                // Hacer una solicitud AJAX para insertar los datos en la tabla rel_regulaciones_materias
                                                $.ajax({
                                                    url: '<?= base_url("RegulacionController/insertarRelRegulacionesMaterias") ?>',
                                                    type: 'POST',
                                                    data: {
                                                        idMaterias: idMaterias,
                                                        ultimoIDRegulacion: id_regulacion
                                                    },
                                                    success: function (insertResponse) {
                                                        var insertResult = JSON.parse(insertResponse);
                                                        if (insertResult.status === 'success') {
                                                            console.log('Datos insertados correctamente en rel_regulaciones_materias');
                                                            // Redirigir al usuario al enlace especificado
                                                            window.location.href = '<?= base_url("emergency/edit_nat/"); ?>' + id_regulacion;
                                                        } else {
                                                            console.error('Error al insertar datos:', insertResult.message);
                                                        }
                                                    },
                                                    error: function (error) {
                                                        console.error('Error en la solicitud AJAX:', error);
                                                    }
                                                });
                                            } else {
                                                console.error('Error:', result.message);
                                            }
                                        },
                                        error: function (error) {
                                            console.error('Error en la solicitud AJAX:', error);
                                        }
                                    });
                                } else {
                                    console.error('Error al eliminar registros:', deleteResult.message);
                                }
                            },
                            error: function (error) {
                                console.error('Error en la solicitud AJAX para eliminar registros:', error);
                            }
                        });
                    }
                    // Hacer una solicitud AJAX para eliminar los registros existentes con el id_regulacion

                }


            } else {
                window.location.href = '<?= base_url("emergency/edit_nat/"); ?>' + id_regulacion;
            }
        });
    });
</script>
@endsection