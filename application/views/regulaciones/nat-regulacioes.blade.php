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
                <div class="card flex-grow-1">
                    <div class="card" style="border: none;">
                        <div class="card-body" style="border: none;">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="http://localhost/code/RegulacionController/caracteristicas_reg"
                                        class="custom-link">
                                        <i class="fa-solid fa-list-check"></i>
                                        <label for="image_1">Características de la Regulación</label>
                                    </a>
                                </li>
                                <p></p>
                                <li>
                                    <a href="http://localhost/code/RegulacionController/mat_exentas"
                                        class="custom-link">
                                        <i class="fa-solid fa-table-list"></i>
                                        <label for="image_2">Materias Exentas</label>
                                    </a>
                                </li>
                                <p></p>
                                <li>
                                    <a href="http://localhost/code/RegulacionController/nat_regulaciones"
                                        class="custom-link">
                                        <i class="fa-solid fa-book"></i>
                                        <label for="image_3">Naturaleza de la Regulación</label>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 p-0">
                <div class="card">
                    <div class="card-header text-white">Naturaleza de la regulación</div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="row justify-content-center">
                            <label for="radioGroup">¿La regulación está asociada a una actividad
                                económica?</label>
                            <div id="radioGroup">
                                <input type="radio" id="si" name="opcion" value="si">
                                <label for="si">Sí</label>
                                <input type="radio" id="no" name="opcion" value="no">
                                <label for="no">No</label>
                            </div>
                        </div>
                        <div class="form-group" id="inputs" style="display: none;">
                            <!-- Generar 5 inputs -->
                            <div class="form-group row justify-content-center">
                                <label for="SectorInput">Sector<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="SectorInput" name="SectorInput"
                                    placeholder="Selecciona una opcion" required>

                            </div>
                            <ul id="sectorResults"></ul>
                            <table id="selectedSectorsTable" class="table table-striped mt-4">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre Sector</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas se agregarán aquí -->
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                <label for="SubsectorInput">Subsector<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="SubsectorInput" name="SubsectorInput"
                                    placeholder="Selecciona una opcion" required>
                            </div>
                            <ul id="subsectorResults" class="list-group mt-2"></ul>
                            <table id="selectedSubsectorsTable" class="table table-striped mt-4" style="display: none;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre Subsector</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas se agregarán aquí -->
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                <label for="RamaInput">Rama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="RamaInput" name="RamaInput"
                                    placeholder="Selecciona una opcion" required>
                            </div>
                            <ul id="ramaResults" class="list-group mt-2"></ul>
                            <table id="selectedRamasTable" class="table table-striped mt-4" style="display: none;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre Rama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas se agregarán aquí -->
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                <label for="SubramaInput">Subrama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="SubramaInput" name="SubramaInput"
                                    placeholder="Selecciona una opcion" required>
                            </div>
                            <ul id="subramaResults" class="list-group mt-2"></ul>
                            <table id="selectedSubramasTable" class="table table-striped mt-4" style="display: none;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre Subrama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas se agregarán aquí -->
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                <label for="ClaseInput">Clase<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ClaseInput" name="ClaseInput"
                                    placeholder="Selecciona una opcion" required>
                            </div>
                            <ul id="claseResults" class="list-group mt-2"></ul>
                            <table id="selectedClasesTable" class="table table-striped mt-4" style="display: none;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre Clase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas se agregarán aquí -->
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="inputVinculadas">Regulaciones vinculadas o derivadas de esta
                                regulación<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputVinculadas" name="vinculadas"
                                placeholder="Regulaciones Vinculadas" required>
                        </div>
                        <ul id="vinculadasResults" class="list-group mt-2"></ul>
                        <table id="selectedRegulacionesTable" class="table table-striped mt-4" style="display: none;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre Regulacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Las filas se agregarán aquí -->
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label for="inputEnlace">Enlace oficial de la regulación<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEnlace" name="EnlaceOficial"
                                placeholder="http://" required>
                        </div>
                        <div class="form-group">
                            <label for="radioGroup">Tipo de documento:</label>
                            <div id="radioGroup">
                                <input type="radio" id="documento" name="opcion" value="documento">
                                <label for="documento">Documento</label>
                                <input type="radio" id="liga" name="opcion" value="liga">
                                <label for="liga">Liga de Documento</label>
                            </div>
                        </div>
                        <div id="fileInput" class="form-group" style="display: none;">
                            <label for="file">Subir Documento:</label>
                            <input type="file" class="form-control-file" id="file">
                        </div>
                        <div id="urlInput" class="form-group" style="display: none;">
                            <label for="url">URL del Documento:</label>
                            <input type="text" class="form-control" id="url" placeholder="http://">
                        </div>


                        <script>
                        $(document).ready(function() {
                            $('input[type=radio][name=opcion]').change(function() {
                                if (this.value == 'documento') {
                                    $('#fileInput').show();
                                    $('#urlInput').hide();
                                } else if (this.value == 'liga') {
                                    $('#urlInput').show();
                                    $('#fileInput').hide();
                                }
                            });
                        });
                        </script>
                        <script>
                        $(document).ready(function() {
                            let iNormativo = null;

                            $('input[name="opcion"]').on('change', function() {
                                if ($('#documento').is(':checked')) {
                                    iNormativo = 0;
                                } else if ($('#liga').is(':checked')) {
                                    iNormativo = 1;
                                }
                                console.log('iNormativo:', iNormativo);
                            });

                            $('#btnGnat').on('click', function() {
                                if ($('#no').is(':checked')) {
                                    let inputEnlace = $('#inputEnlace').val();
                                    $.ajax({
                                        url: '<?= base_url('RegulacionController/save_naturaleza_regulacion') ?>',
                                        type: 'POST',
                                        data: {
                                            btn_clicked: true,
                                            radio_no_selected: true,
                                            inputEnlace: inputEnlace,
                                            iNormativo: iNormativo
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response.status === 'success') {
                                                alert('Datos guardados exitosamente');
                                            } else {
                                                alert('Error al guardar los datos: ' +
                                                    response.message);
                                            }
                                        }
                                    });
                                }
                            });
                        });
                        </script>
                    </div>

                    <script>
                    $(document).ready(function() {
                        $('input[type=radio][name=opcion]').change(function() {
                            if (this.value == 'si') {
                                $('#inputs').show();
                            } else if (this.value == 'no') {
                                $('#inputs').hide();
                            }
                        });
                    });
                    </script>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" id="btnGnat" class="btn btn-success btn-guardar">Guardar</button>
                        <a href="<?php echo base_url('oficinas/oficina'); ?>"
                            class="btn btn-secondary me-2">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('input[type=radio][name=opcion]').change(function() {
        if (this.value == 'si') {
            $('#checkboxes').show();
        } else if (this.value == 'no') {
            $('#checkboxes').hide();
        }
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let selectedSectors = [];
    let selectedSubsectors = [];
    let selectedRamas = [];
    let selectedSubramas = [];
    let selectedClases = [];

    $('#SectorInput').on('keyup', function() {
        let searchTerm = $(this).val();
        $.ajax({
            url: '<?= base_url('RegulacionController/search_sector') ?>',
            type: 'POST',
            data: {
                search_term: searchTerm
            },
            dataType: 'json',
            success: function(data) {
                $('#sectorResults').empty();
                data.forEach(function(sector) {
                    $('#sectorResults').append('<li data-id="' + sector
                        .ID_sector + '">' + sector.Nombre_Sector +
                        '</li>');
                });
            }
        });
    });

    $('#sectorResults').on('click', 'li', function() {
        let sectorId = $(this).data('id');
        let sectorName = $(this).text();
        selectedSectors.push({
            ID_sector: sectorId,
            Nombre_Sector: sectorName
        });
        console.log(selectedSectors);
        // Ocultar la lista y borrar el texto del input
        $('#sectorResults').empty();
        $('#SectorInput').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedSectorsTable').show();
        $('#selectedSectorsTable tbody').append('<tr><td>' + sectorName + '</td></tr>');
    });

    $('#SubsectorInput').on('keyup', function() {
        let searchTerm = $(this).val();
        $.ajax({
            url: '<?= base_url('RegulacionController/search_subsector') ?>',
            type: 'POST',
            data: {
                search_term: searchTerm
            },
            dataType: 'json',
            success: function(data) {
                $('#subsectorResults').empty();
                data.forEach(function(subsector) {
                    $('#subsectorResults').append(
                        '<li class="list-group-item" data-id="' +
                        subsector.ID_subsector + '">' + subsector
                        .Nombre_Subsector + '</li>');
                });
            }
        });
    });

    $('#subsectorResults').on('click', 'li', function() {
        let subsectorId = $(this).data('id');
        let subsectorName = $(this).text();
        selectedSubsectors.push({
            ID_subsector: subsectorId,
            Nombre_Subsector: subsectorName
        });
        console.log(selectedSubsectors);

        // Ocultar la lista y borrar el texto del input
        $('#subsectorResults').empty();
        $('#SubsectorInput').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedSubsectorsTable').show();
        $('#selectedSubsectorsTable tbody').append('<tr><td>' + subsectorName + '</td></tr>');
    });

    $('#RamaInput').on('keyup', function() {
        let searchTerm = $(this).val();
        $.ajax({
            url: '<?= base_url('RegulacionController/search_rama') ?>',
            type: 'POST',
            data: {
                search_term: searchTerm
            },
            dataType: 'json',
            success: function(data) {
                $('#ramaResults').empty();
                data.forEach(function(rama) {
                    $('#ramaResults').append(
                        '<li class="list-group-item" data-id="' + rama
                        .ID_Rama + '">' + rama.Nombre_Rama + '</li>');
                });
            }
        });
    });
    $('#ramaResults').on('click', 'li', function() {
        let ramaId = $(this).data('id');
        let ramaName = $(this).text();
        selectedRamas.push({
            ID_Rama: ramaId,
            Nombre_Rama: ramaName
        });
        console.log(selectedRamas);

        // Ocultar la lista y borrar el texto del input
        $('#ramaResults').empty();
        $('#RamaInput').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedRamasTable').show();
        $('#selectedRamasTable tbody').append('<tr><td>' + ramaName + '</td></tr>');
    });
    $('#SubramaInput').on('keyup', function() {
        let searchTerm = $(this).val();
        $.ajax({
            url: '<?= base_url('RegulacionController/search_subrama') ?>',
            type: 'POST',
            data: {
                search_term: searchTerm
            },
            dataType: 'json',
            success: function(data) {
                $('#subramaResults').empty();
                data.forEach(function(subrama) {
                    $('#subramaResults').append(
                        '<li class="list-group-item" data-id="' + subrama
                        .ID_Subrama + '">' + subrama.Nombre_Subrama + '</li>');
                });
            }
        });
    });
    $('#subramaResults').on('click', 'li', function() {
        let subramaId = $(this).data('id');
        let subramaName = $(this).text();
        selectedSubramas.push({
            ID_Subrama: subramaId,
            Nombre_Subrama: subramaName
        });
        console.log(selectedSubramas);

        // Ocultar la lista y borrar el texto del input
        $('#subramaResults').empty();
        $('#SubramaInput').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedSubramasTable').show();
        $('#selectedSubramasTable tbody').append('<tr><td>' + subramaName + '</td></tr>');
    });
    $('#ClaseInput').on('keyup', function() {
        let searchTerm = $(this).val();
        $.ajax({
            url: '<?= base_url('RegulacionController/search_clase') ?>',
            type: 'POST',
            data: {
                search_term: searchTerm
            },
            dataType: 'json',
            success: function(data) {
                $('#claseResults').empty();
                data.forEach(function(clase) {
                    $('#claseResults').append(
                        '<li class="list-group-item" data-id="' + clase
                        .ID_clase + '">' + clase.Nombre_Clase + '</li>');
                });
            }
        });
    });

    $('#claseResults').on('click', 'li', function() {
        let claseId = $(this).data('id');
        let claseName = $(this).text();
        selectedClases.push({
            ID_clase: claseId,
            Nombre_Clase: claseName
        });
        console.log(selectedClases);

        // Ocultar la lista y borrar el texto del input
        $('#claseResults').empty();
        $('#ClaseInput').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedClasesTable').show();
        $('#selectedClasesTable tbody').append('<tr><td>' + claseName + '</td></tr>');
    });
});
</script>
<script>
$(document).ready(function() {
    let selectedRegulaciones = [];

    $('#inputVinculadas').on('keyup', function() {
        let searchTerm = $(this).val();
        $.ajax({
            url: '<?= base_url('RegulacionController/search_regulacion') ?>',
            type: 'POST',
            data: {
                search_term: searchTerm
            },
            dataType: 'json',
            success: function(data) {
                $('#vinculadasResults').empty();
                data.forEach(function(regulacion) {
                    $('#vinculadasResults').append(
                        '<li class="list-group-item" data-id="' + regulacion
                        .ID_Regulacion + '">' + regulacion.Nombre_Regulacion +
                        '</li>');
                });
            }
        });
    });

    $('#vinculadasResults').on('click', 'li', function() {
        let regulacionId = $(this).data('id');
        let regulacionName = $(this).text();
        selectedRegulaciones.push({
            ID_Regulacion: regulacionId,
            Nombre_Regulacion: regulacionName
        });
        console.log(selectedRegulaciones);

        // Ocultar la lista y borrar el texto del input
        $('#vinculadasResults').empty();
        $('#inputVinculadas').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedRegulacionesTable').show();
        $('#selectedRegulacionesTable tbody').append('<tr><td>' + regulacionName + '</td></tr>');
    });
});
</script>

@endsection
</body>