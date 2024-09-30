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
                                    <a href="<?php echo base_url('RegulacionController/caracteristicas_reg'); ?>"
                                        class="custom-link">
                                        <i class="fa-solid fa-list-check"></i>
                                        <label for="image_1">Características de la Regulación</label>
                                    </a>
                                </li>
                                <p></p>
                                <li>
                                    <a href="<?php echo base_url('RegulacionController/mat_exentas'); ?>"
                                        class="custom-link">
                                        <i class="fa-solid fa-table-list"></i>
                                        <label for="image_2">Materias Exentas</label>
                                    </a>
                                </li>
                                <p></p>
                                <li>
                                    <a href="<?php echo base_url('RegulacionController/nat_regulaciones'); ?>"
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
                        <div class="d-flex justify-content-between mb-3">
                            <p>Tramites y servicios</p>
                            <button type="submit" id="botonIndice" class="btn btn-success btn-indice">Indice</button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Índice
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="inputTexto">Texto</label>
                                                    <input type="text" class="form-control" id="inputTexto"
                                                        placeholder="Ingrese texto" name="texto">
                                                </div>
                                                <div class="form-group">
                                                    <label for="selectIndicePadre">Índice
                                                        Padre</label>
                                                    <select class="form-control" id="selectIndicePadre"
                                                        name="indicePadre">
                                                        <option>Seleccione un índice padre</option>
                                                        <?php if (!empty($indices)): ?>
                                                        <?php    foreach ($indices as $indice): ?>
                                                        <option value="<?= $indice->ID_Indice ?>">
                                                            <?= $indice->Texto ?>
                                                        </option>
                                                        <?php    endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                onclick="closeModal()">Cerrar</button>
                                            <button type="button" id="guardarIbtn" class="btn btn-tinto">Guardar
                                                cambios</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="radioGroup">Tipo de documento:</label>
                            <div id="radioGroup">
                                <input type="radio" id="documento" name="opcion2" value="documento">
                                <label for="documento">Documento</label>
                                <input type="radio" id="liga" name="opcion2" value="liga">
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
                            $('input[type=radio][name=opcion2]').change(function() {
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
let selectedSectors = []; // Declaración global
let selectedSubsectors = []; // Declaración global
let selectedRamas = []; // Declaración global
let selectedSubramas = []; // Declaración global
let selectedClases = []; // Declaración global
let selectedSectorsIds = []; // Declaración global
let selectedSubsectorsIds = []; // Declaración global
let selectedRamasIds = []; // Declaración global
let selectedSubramasIds = []; // Declaración global
let selectedClasesIds = []; // Declaración global
let selectedRegulaciones = []; // Declaración global
let iNormativo = null; // Declaración global
// Aqui se hace la busqueda de los sectores y se muestran en una lista
$(document).ready(function() {

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

    // Aqui se selecciona el sector y se agrega a la lista
    $('#sectorResults').on('click', 'li', function() {
        let sectorId = $(this).data('id');
        let sectorName = $(this).text();
        selectedSectors.push({
            ID_sector: sectorId,
            Nombre_Sector: sectorName
        });
        selectedSectorsIds.push(sectorId); // Guardar solo el valor numérico
        console.log(selectedSectors);
        // Ocultar la lista y borrar el texto del input
        $('#sectorResults').empty();
        $('#SectorInput').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedSectorsTable').show();
        $('#selectedSectorsTable tbody').append('<tr><td>' + sectorName +
            '<td><button class="btn btn-danger btn-sm delete-row">' +
            '<i class="fas fa-trash-alt"></i></button></td>' +
            '</tr>');
    });

    // Evento para eliminar sectores
    $('#selectedSectorsTable').on('click', '.delete-row', function() {
        // Obtener el ID del sector de la fila
        let sectorId = $(this).closest('tr').data('id');

        // Eliminar la fila de la tabla
        $(this).closest('tr').remove();

        // Eliminar el sector del array
        selectedSectors = selectedSectors.filter(function(sector) {
            return sector.ID_sector !== sectorId;
        });

        console.log(selectedSectors);

        // Ocultar la tabla si no hay más filas
        if ($('#selectedSectorsTable tbody tr').length === 0) {
            $('#selectedSectorsTable').hide();
        }
    });

    // Aqui se hace la busqueda de los subsectores y se muestran en una lista
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

    // Aqui se selecciona el subsector y se agrega a la lista
    $('#subsectorResults').on('click', 'li', function() {
        let subsectorId = $(this).data('id');
        let subsectorName = $(this).text();
        selectedSubsectors.push({
            ID_subsector: subsectorId,
            Nombre_Subsector: subsectorName
        });
        selectedSubsectorsIds.push(subsectorId); // Guardar solo el valor numérico
        console.log(selectedSubsectors);

        // Ocultar la lista y borrar el texto del input
        $('#subsectorResults').empty();
        $('#SubsectorInput').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedSubsectorsTable').show();
        $('#selectedSubsectorsTable tbody').append('<tr><td>' + subsectorName +
            '<td><button class="btn btn-danger btn-sm delete-row">' +
            '<i class="fas fa-trash-alt"></i></button></td>' +
            '</tr>');
    });

    // Evento para eliminar subsectores
    $('#selectedSubsectorsTable').on('click', '.delete-row', function() {
        // Obtener el ID del subsector de la fila
        let subsectorId = $(this).closest('tr').data('id');

        // Eliminar la fila de la tabla
        $(this).closest('tr').remove();

        // Eliminar el subsector del array
        selectedSubsectors = selectedSubsectors.filter(function(subsector) {
            return subsector.ID_subsector !== subsectorId;
        });

        console.log(selectedSubsectors);

        // Ocultar la tabla si no hay más filas
        if ($('#selectedSubsectorsTable tbody tr').length === 0) {
            $('#selectedSubsectorsTable').hide();
        }
    });

    // Aqui se hace la busqueda de las ramas y se muestran en una lista
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

    // Aqui se selecciona la rama y se agrega a la lista
    $('#ramaResults').on('click', 'li', function() {
        let ramaId = $(this).data('id');
        let ramaName = $(this).text();
        selectedRamas.push({
            ID_Rama: ramaId,
            Nombre_Rama: ramaName
        });
        selectedRamasIds.push(ramaId); // Guardar solo el valor numérico
        console.log(selectedRamas);

        // Ocultar la lista y borrar el texto del input
        $('#ramaResults').empty();
        $('#RamaInput').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedRamasTable').show();
        $('#selectedRamasTable tbody').append('<tr><td>' + ramaName +
            '<td><button class="btn btn-danger btn-sm delete-row">' +
            '<i class="fas fa-trash-alt"></i></button></td>' + '</tr>');
    });

    // Evento para eliminar ramas
    $('#selectedRamasTable').on('click', '.delete-row', function() {
        // Obtener el ID de la rama de la fila
        let ramaId = $(this).closest('tr').data('id');

        // Eliminar la fila de la tabla
        $(this).closest('tr').remove();

        // Eliminar la rama del array
        selectedRamas = selectedRamas.filter(function(rama) {
            return rama.ID_Rama !== ramaId;
        });

        console.log(selectedRamas);

        // Ocultar la tabla si no hay más filas
        if ($('#selectedRamasTable tbody tr').length === 0) {
            $('#selectedRamasTable').hide();
        }
    });

    // Aqui se hace la busqueda de las subramas y se muestran en una lista
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

    // Aqui se selecciona la subrama y se agrega a la lista
    $('#subramaResults').on('click', 'li', function() {
        let subramaId = $(this).data('id');
        let subramaName = $(this).text();
        selectedSubramas.push({
            ID_Subrama: subramaId,
            Nombre_Subrama: subramaName
        });
        selectedSubramasIds.push(subramaId); // Guardar solo el valor numérico
        console.log(selectedSubramas);

        // Ocultar la lista y borrar el texto del input
        $('#subramaResults').empty();
        $('#SubramaInput').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedSubramasTable').show();
        $('#selectedSubramasTable tbody').append('<tr><td>' + subramaName +
            '<td><button class="btn btn-danger btn-sm delete-row">' +
            '<i class="fas fa-trash-alt"></i></button></td>' +
            '</tr>');
    });

    // Evento para eliminar subramas
    $('#selectedSubramasTable').on('click', '.delete-row', function() {
        // Obtener el ID de la subrama de la fila
        let subramaId = $(this).closest('tr').data('id');

        // Eliminar la fila de la tabla
        $(this).closest('tr').remove();

        // Eliminar la subrama del array
        selectedSubramas = selectedSubramas.filter(function(subrama) {
            return subrama.ID_Subrama !== subramaId;
        });

        console.log(selectedSubramas);

        // Ocultar la tabla si no hay más filas
        if ($('#selectedSubramasTable tbody tr').length === 0) {
            $('#selectedSubramasTable').hide();
        }
    });

    // Aqui se hace la busqueda de las clases y se muestran en una lista
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

    // Aqui se selecciona la clase y se agrega a la lista
    $('#claseResults').on('click', 'li', function() {
        let claseId = $(this).data('id');
        let claseName = $(this).text();
        selectedClases.push({
            ID_clase: claseId,
            Nombre_Clase: claseName
        });
        selectedClasesIds.push(claseId); // Guardar solo el valor numérico
        console.log(selectedClases);

        // Ocultar la lista y borrar el texto del input
        $('#claseResults').empty();
        $('#ClaseInput').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedClasesTable').show();
        $('#selectedClasesTable tbody').append('<tr><td>' + claseName +
            '<td><button class="btn btn-danger btn-sm delete-row">' +
            '<i class="fas fa-trash-alt"></i></button></td>' +
            '</tr>');
    });

    // Evento para eliminar clases
    $('#selectedClasesTable').on('click', '.delete-row', function() {
        // Obtener el ID de la clase de la fila
        let ClaseId = $(this).closest('tr').data('id');

        // Eliminar la fila de la tabla
        $(this).closest('tr').remove();

        // Eliminar la clase del array
        selectedClases = selectedClases.filter(function(clase) {
            return clase.ID_clase !== ClaseId;
        });

        console.log(selectedClases);

        // Ocultar la tabla si no hay más filas
        if ($('#selectedClasesTable tbody tr').length === 0) {
            $('#selectedClasesTable').hide();
        }
    });

    //aqui busca las regulaciones y las muesta en una lista
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

    //aqui selecciona la regulacion y la agrega a la lista
    $('#vinculadasResults').on('click', 'li', function() {
        let regulacionId = $(this).data('id');
        let regulacionName = $(this).text();
        selectedRegulaciones.push({
            ID_Regulacion: regulacionId
        });
        console.log('regulaciones', selectedRegulaciones);

        // Ocultar la lista y borrar el texto del input
        $('#vinculadasResults').empty();
        $('#inputVinculadas').val('');

        // Mostrar la tabla y agregar una fila
        $('#selectedRegulacionesTable').show();
        $('#selectedRegulacionesTable tbody').append('<tr><td>' + regulacionName +
            '<td><button class="btn btn-danger btn-sm delete-row">' +
            '<i class="fas fa-trash-alt"></i></button></td>' +
            '</tr>');
    });

    //aqui validamos si es documento o liga
    // 0 = documento, 1 = liga
    $('input[name="opcion2"]').on('change', function() {
        if ($('#documento').is(':checked')) {
            iNormativo = 0;
        } else if ($('#liga').is(':checked')) {
            iNormativo = 1;
        }
        console.log('iNormativo:', iNormativo);
    });

    //verificamos que se de click en el boton guardar y validamos si es si o no
    //aqui guardamos los datos
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
                    iNormativo: iNormativo,
                    selectedRegulaciones: selectedRegulaciones
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Datos guardados exitosamente');
                        window.location.href = 'http://localhost/code/RegulacionController';
                    } else {
                        alert('Error al guardar los datos: ' + response.message);
                        window.location.href = 'http://localhost/code/RegulacionController';
                    }
                }
            });
        } else if ($('#si').is(':checked')) {
            let inputEnlace = $('#inputEnlace').val();
            $.ajax({
                url: '<?= base_url('RegulacionController/save_naturaleza_regulacion') ?>',
                type: 'POST',
                data: {
                    btn_clicked: true,
                    radio_si_selected: true,
                    inputEnlace: inputEnlace,
                    iNormativo: iNormativo,
                    selectedRegulaciones: selectedRegulaciones,
                    selectedSectors: selectedSectorsIds,
                    selectedSubsectors: selectedSubsectorsIds,
                    selectedRamas: selectedRamasIds,
                    selectedSubramas: selectedSubramasIds,
                    selectedClases: selectedClasesIds
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Datos guardados exitosamente');
                        window.location.href = 'http://localhost/code/RegulacionController';
                    } else {
                        alert('Error al guardar los datos: ' + response.message);
                        window.location.href = 'http://localhost/code/RegulacionController';
                    }
                }
            });
        }
        window.location.href = 'http://localhost/code/RegulacionController';
    });
});
</script>
@endsection
</body>