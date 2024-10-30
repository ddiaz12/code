@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones
@endsection
@section('navbar')
@include('templates/navbarAdmin')
@endsection
@section('menu')
@include('templates/menuAdmin')
@endsection

@section('contenido')
<ol class="breadcrumb mb-4 mt-5">
    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
    </li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('RegulacionController'); ?>"><i
                class="fas fa-file-alt me-1"></i>Regulaciones</a>
    </li>
    <li class="breadcrumb-item active"><i class="fa-solid fa-plus-circle"></i>Agregar regulacion
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
                                        <i class="fa-solid fa-list-check fa-sm"></i>
                                        <label class="menu-regulacion" for="image_1">Características de la
                                            Regulación</label>
                                </li>
                                <p></p>
                                <li class="iconos-regulacion active-view">
                                        <i class="fa-solid fa-table-list fa-sm"></i>
                                        <label class="menu-regulacion" for="image_2">Materias Exentas</label>
                                </li>
                                <p></p>
                                <li class="iconos-regulacion">
                                        <i class="fa-solid fa-book fa-sm"></i>
                                        <label class="menu-regulacion" for="image_3">Naturaleza de la Regulación</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 p-0">
                <div class="card">
                    <div class="card-header text-white">Materias Exentas</div>
                    <div class="card-body align-content-center justify-content-center align-items-center">
                        <div class="align-content-center justify-content-center align-items-center">
                            <div class="d-flex align-content-center  justify-content-center align-items-center">
                                <label for=" radioGroup">¿Existen materias que se exceptúan de la
                                    regulación?</label>
                            </div>
                            <div id="radioGroup"
                                class="d-flex align-content-center  justify-content-center align-items-center">
                                <label for="si"><input type="radio" id="si" name="opcion" value="si">Sí</label>
                                <label class="ms-2" for="no"> <input type="radio" id="no" name="opcion"
                                        value="no" checked>No</label>
                            </div>
                        </div>

                        <div class="align-content-center d-flex justify-content-center align-items-center">
                            <div id="checkboxes" style="flex-wrap: wrap; column-count: 3;">
                                <!-- Generar 29 checkboxes -->
                                <div>
                                    <input type="checkbox" id="checkbox1" name="checkbox1" value="checkbox1">
                                    <label for="checkbox1">Fiscal</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox2" name="checkbox2" value="checkbox2">
                                    <label for="checkbox2">Aduanera</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox3" name="checkbox3" value="checkbox3">
                                    <label for="checkbox3">Armas de fuego y explosivos</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox4" name="checkbox4" value="checkbox4">
                                    <label for="checkbox4">Comercio exterior</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox5" name="checkbox5" value="checkbox5">
                                    <label for="checkbox5">Constatar medidas de protección civil</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox6" name="checkbox6" value="checkbox6">
                                    <label for="checkbox6">Derechos e intereses del consumidor</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox7" name="checkbox7" value="checkbox7">
                                    <label for="checkbox7">Infraestructura y/o construcción</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox8" name="checkbox8" value="checkbox8">
                                    <label for="checkbox8">Medio ambiente</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox9" name="checkbox9" value="checkbox9">
                                    <label for="checkbox9">Operaciones con recursos de procedencia ilícita</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox10" name="checkbox10" value="checkbox10">
                                    <label for="checkbox10">Otra</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox11" name="checkbox11" value="checkbox11">
                                    <label for="checkbox11">Programas sociales</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox12" name="checkbox12" value="checkbox12">
                                    <label for="checkbox12">Protección contra riesgos sanitarios</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox13" name="checkbox13" value="checkbox13">
                                    <label for="checkbox13">Proteger la sanidad y la inocuidad agroalimentaria, animal y
                                        vegetal</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox14" name="checkbox14" value="checkbox14">
                                    <label for="checkbox14">Recursos naturales</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox15" name="checkbox15" value="checkbox15">
                                    <label for="checkbox15">Resguardar la seguridad Nacional</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox16" name="checkbox16" value="checkbox16">
                                    <label for="checkbox16">Revisión de contratos petroleros (art. 37-B-VII y 63
                                        LISH)</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox17" name="checkbox17" value="checkbox17">
                                    <label for="checkbox17">Salud humana</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox18" name="checkbox18" value="checkbox18">
                                    <label for="checkbox18">Salud pública, medicamentos, asistencia sanitaria y/o
                                        sanidad</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox19" name="checkbox19" value="checkbox19">
                                    <label for="checkbox19">Sector financiero</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox20" name="checkbox20" value="checkbox20">
                                    <label for="checkbox20">Seguridad alimentaria</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox21" name="checkbox21" value="checkbox21">
                                    <label for="checkbox21">Seguridad de la población</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox22" name="checkbox22" value="checkbox22">
                                    <label for="checkbox22">Seguridad de los productos no alimentarios y protección del
                                        consumidor</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox23" name="checkbox23" value="checkbox23">
                                    <label for="checkbox23">Seguridad nuclear</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox24" name="checkbox24" value="checkbox24">
                                    <label for="checkbox24">Seguridad social</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox25" name="checkbox25" value="checkbox25">
                                    <label for="checkbox25">Seguridad, protección y/ salud laboral</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox26" name="checkbox26" value="checkbox26">
                                    <label for="checkbox26">Trabajo</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox27" name="checkbox27" value="checkbox27">
                                    <label for="checkbox27">Transporte</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox28" name="checkbox28" value="checkbox28">
                                    <label for="checkbox28">Turismo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" id="btnCheck" class="btn btn-success btn-guardar">Guardar</button>
                        <a href="<?php echo base_url('oficinas/oficina'); ?>"
                            class="btn btn-secondary me-2">Cancelar</a>
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
    $('input[type=radio][name=opcion]').change(function() {
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
    $(document).ready(function () {
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

                // Hacer una solicitud AJAX para obtener los ID_materia y el último ID_Regulacion
                $.ajax({
                    url: '<?php echo base_url('RegulacionController/obtenerMateriasYUltimoIDRegulacion'); ?>',
                    type: 'POST',
                    data: {
                        labels: selectedLabels
                    },
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            var idMaterias = result.idMaterias;
                            var ultimoIDRegulacion = result.ultimoIDRegulacion;

                            // Imprimir los ID_materia y el último ID_Regulacion en la consola
                            console.log('ID_materias:', idMaterias);
                            console.log('Último ID_Regulacion:', ultimoIDRegulacion);

                            // Hacer una solicitud AJAX para insertar los datos en la tabla rel_regulaciones_materias
                            $.ajax({
                                url: '<?php echo base_url('RegulacionController/insertarRelRegulacionesMaterias'); ?>',
                                type: 'POST',
                                data: {
                                    idMaterias: idMaterias,
                                    ultimoIDRegulacion: ultimoIDRegulacion
                                },
                                success: function (insertResponse) {
                                    var insertResult = JSON.parse(insertResponse);
                                    if (insertResult.status === 'success') {
                                        console.log(
                                            'Datos insertados correctamente en rel_regulaciones_materias'
                                        );
                                        // Redirigir al usuario al enlace especificado
                                        window.location.href = '<?php echo base_url('RegulacionController/nat_regulaciones'); ?>';

                                    } else {
                                        console.error('Error al insertar datos:',
                                            insertResult.message);
                                    }
                                },
                                error: function (error) {
                                    console.error('Error en la solicitud AJAX:',
                                        error);
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
            }else{
                // Redirigir al usuario al enlace especificado
                window.location.href = '<?php echo base_url('RegulacionController/nat_regulaciones'); ?>';
            }
        });
    });
</script>
@endsection