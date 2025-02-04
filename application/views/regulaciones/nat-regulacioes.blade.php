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
    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Inicio</a>
    </li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('RegulacionController'); ?>"><i
                class="fas fa-file-alt me-1"></i>Regulaciones</a>
    </li>
    <li class="breadcrumb-item active"><i class="fa-solid fa-plus-circle me-1"></i>Inscripción al RER
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
                                <li class="iconos-regulacion">
                                    <i class="fa-solid fa-table-list fa-sm"></i>
                                    <label class="menu-regulacion" for="image_2">Materias Exentas</label>
                                </li>
                                <p></p>
                                <li class="iconos-regulacion active-view">
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
                    <div class="card-header text-white">Naturaleza de la regulación</div>
                    <form id="formGnat" enctype="multipart/form-data">
                        <div class="card-body d-flex flex-column justify-content-center div-card-body">
                            <div class="row justify-content-center">
                                <label for="radioGroup">¿La regulación está asociada a una actividad
                                    económica?</label>
                                <div id="radioGroup">
                                    <input type="radio" id="si" name="opcion" value="si">
                                    <label for="si">Sí</label>
                                    <input type="radio" id="no" name="opcion" value="no" checked>
                                    <label for="no">No</label>
                                </div>
                            </div>
                            <br>
                            <div class="form-group" id="inputs">
                                <div class="row">
                                    <!-- Generar 5 inputs -->
                                    <div class="col-md-6">
                                        <div>
                                            <label for="SectorInput">Sector<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="SectorInput" name="SectorInput"
                                                placeholder="Selecciona una opción" required>
                                        </div>
                                        <ul id="sectorResults"></ul>
                                        <table id="selectedSectorsTable" class="table table-striped mt-4"
                                            style="display: none;">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nombre Sector</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Las filas se agregarán aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="SubsectorInput">Subsector<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="SubsectorInput"
                                                name="SubsectorInput" placeholder="Selecciona una opción" required>
                                        </div>
                                        <ul id="subsectorResults" class="list-group mt-2"></ul>
                                        <table id="selectedSubsectorsTable" class="table table-striped mt-4"
                                            style="display: none;">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nombre Subsector</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Las filas se agregarán aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="RamaInput">Rama</label>
                                            <input type="text" class="form-control" id="RamaInput" name="RamaInput"
                                                placeholder="Selecciona una opción" required>
                                        </div>
                                        <ul id="ramaResults" class="list-group mt-2"></ul>
                                        <table id="selectedRamasTable" class="table table-striped mt-4"
                                            style="display: none;">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nombre Rama</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Las filas se agregarán aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="SubramaInput">Subrama</label>
                                            <input type="text" class="form-control" id="SubramaInput"
                                                name="SubramaInput" placeholder="Selecciona una opción" required>
                                        </div>
                                        <ul id="subramaResults" class="list-group mt-2"></ul>
                                        <table id="selectedSubramasTable" class="table table-striped mt-4"
                                            style="display: none;">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nombre Subrama</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Las filas se agregarán aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="ClaseInput">Clase</label>
                                            <input type="text" class="form-control" id="ClaseInput" name="ClaseInput"
                                                placeholder="Selecciona una opción" required>
                                        </div>
                                        <ul id="claseResults" class="list-group mt-2"></ul>
                                        <table id="selectedClasesTable" class="table table-striped mt-4"
                                            style="display: none;">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nombre Clase</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Las filas se agregarán aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVinculadas">Regulaciones vinculadas o derivadas de esta
                                    regulación</label>
                                <input type="text" class="form-control" id="inputVinculadas" name="vinculadas"
                                    placeholder="Regulaciones Vinculadas" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="manualEntryCheckbox">
                                <label class="form-check-label" for="manualEntryCheckbox">Agregar manualmente una
                                    regulación vinculada o derivada</label>
                            </div>

                            <div id="manualEntryFields" class="border p-3 rounded"
                                style="display: none; background-color: #f8f9fa;">
                                <div class="form-group">
                                    <label for="manualRegulacionNombre">Nombre de la regulación</label>
                                    <input type="text" class="form-control" id="manualRegulacionNombre"
                                        name="manualRegulacionNombre" placeholder="Nombre de la regulación derivada">
                                </div>
                                <div class="form-group">
                                    <label for="manualRegulacionLink">Enlace de la regulación</label>
                                    <input type="text" class="form-control" id="manualRegulacionLink"
                                        name="manualRegulacionLink" placeholder="Enlace de la regulación derivada">
                                </div>
                                <button type="button" id="addRegulacionButton"
                                    class="btn btn-tinto mt-2">Agregar</button>
                            </div>
                            <ul id="vinculadasResults" class="list-group mt-2"></ul>
                            <table id="selectedRegulacionesTable" class="table table-striped mt-4"
                                style="display: none;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre Regulacion</th>
                                        <th></th>
                                        <th></th>
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
                            <div>
                                <p></p>
                            </div>
                            <div class="header-container mb-0">
                                <p id="tramitesText" class="mb-0">Tramites y servicios<span class="text-danger">*</span>
                                </p>
                                <button type="button" id="botonTramites"
                                    class="btn btn-tinto btn-tramites">Agregar</button>
                            </div>
                            <table id="tramitesTable" class="table table-spacing">
                                <thead>
                                    <tr>
                                        <th class="hidden-column">ID_Tramites</th>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas se agregarán dinámicamente aquí -->
                                </tbody>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Trámites y Servicios
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="inputTram">Nombre</label>
                                                    <input type="text" class="form-control" id="inputTram"
                                                        placeholder="Ingrese el Nombre" name="NombreTram">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDir">Direccion web</label>
                                                    <input type="text" class="form-control" id="inputDir"
                                                        placeholder="http://" name="NombreDir">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                onclick="closeModal()">Cerrar</button>
                                            <button type="button" id="guardarIbtn" class="btn btn-tinto"
                                                onclick="closeModal()">Guardar
                                                cambios</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="fileInput" class="form-group">
                                <p><label for="file">
                                        <h7>Subir documento</h7>
                                    </label></p>
                                    <style>
                                        .file-input-container {
                                            display: flex;
                                            align-items: center;
                                            gap: 2px;
                                            margin-bottom: 15px;
                                        }

                                        .file-input-container input[type="file"] {
                                            display: none;
                                        }

                                        .file-input-label {
                                            background-color: #7f2841;
                                            color: white;
                                            padding: 10px 20px;
                                            border-radius: 5px;
                                            cursor: pointer;
                                            transition: background-color 0.3s ease;
                                        }

                                        .file-input-label:hover {
                                            background-color: #b69664;
                                        }
                                        .file-name {
                                            font-size: 14px;
                                            color: #333333;
                                            background-color: #7f2841;
                                        }

                                        .remove-file-button {
                                            background-color: #7f2841;
                                            color: white;
                                            padding: 10px;
                                            border: none;
                                            border-radius: 5px;
                                            cursor: pointer;
                                            display: none;
                                            transition: background-color 0.3s ease;
                                        }

                                        .remove-file-button:hover {
                                            background-color: #c82333;
                                        }
                                    </style>
                                    <div class="file-input-container">
                                        <label for="file" class="file-input-label">Seleccionar archivo</label>
                                        <input type="file" id="file" name="userfile" accept=".pdf,.doc,.docx,.docm">
                                        <span id="fileName" class="file-name"></span>
                                        <button type="button" id="removeFile" class="remove-file-button">X</button>
                                    </div>
                            </div>
                            <div class="d-flex justify-content-end mb-3">
                                <a href="<?php echo base_url('RegulacionController'); ?>"
                                id="cancelButton" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="button" id="btnGnat" class="btn btn-success btn-guardar">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function() {
            var formModified = false;

            // Detectar cambios en los campos del formulario
            $('#formGnat').on('change input', function() {
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
                window.location.href = '<?php echo base_url('RegulacionController'); ?>';
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    var previousFileName = '';

    $('#file').on('click', function() {
        // Almacenar el nombre del archivo previamente seleccionado
        previousFileName = $('#fileName').text();
    });

    $('#file').change(function() {
        var fileName = $(this).val().split('\\').pop();
        if (fileName) {
            $('#fileName').text(fileName).css({
                'padding': '10px',
                'border-radius': '5px'
            });
            $('#removeFile').show(); // Mostrar el botón de eliminación
        } else {
            // Restaurar el nombre del archivo previamente seleccionado si se cancela la selección
            $('#fileName').text(previousFileName).css({
                'padding': previousFileName ? '10px' : '',
                'border-radius': previousFileName ? '5px' : ''
            });
            if (!previousFileName) {
                $('#removeFile').hide(); // Ocultar el botón de eliminación si no hay archivo previo
            }
        }
    });

    $('#removeFile').click(function() {
        $('#file').val(''); // Restablecer el campo de entrada de archivo
        $('#fileName').text('').css({
            'padding': '',
            'border-radius': ''
        }); // Limpiar el nombre del archivo y los estilos
        $(this).hide(); // Ocultar el botón de eliminación
    });
});
</script>
<script>
    $(document).ready(function () {
        $('.btn-tramites').click(function () {
            $('#myModal').modal('show');
        });
    });
</script>
<script>
    function closeModal() {
        $('.modal').modal('hide'); // Oculta el modal
    }
</script>

<script>
    $(document).ready(function () {
        $('input[type=radio][name=opcion]').change(function () {
            if (this.value == 'si') {
                $('#inputs').show(); // Mostrar los inputs
            } else if (this.value == 'no') {
                $('#inputs').hide(); // Ocultar los inputs
            }
        });

        // Inicializar el estado de los inputs basado en el radio button seleccionado por defecto
        if ($('input[type=radio][name=opcion]:checked').val() == 'no') {
            $('#inputs').hide(); // Ocultar los inputs
        } else {
            $('#inputs').show(); // Mostrar los inputs
        }
    });


    $(document).ready(function () {
        $('input[type=radio][name=opcion]').change(function () {
            if (this.value == 'si') {
                $('#checkboxes').show();
            } else if (this.value == 'no') {
                $('#checkboxes').hide();
            }
        });
    });

    $('#guardarIbtn').on('click', function () {
        var inputTram = $('#inputTram').val();
        var inputDir = $('#inputDir').val();

        // Expresión regular para validar URLs
        var urlRegex = /^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-._~:\/?#[\]@!$&'()*+,;=]*)?$/;

        // Verificar campos obligatorios
        if (inputTram === '' || inputDir === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, complete los campos obligatorios',
            });
            return;
        }

        // Validar que el link sea una URL válida
        if (!urlRegex.test(inputDir.trim())) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El campo "Dirección" debe contener una dirección web válida',
            });
            return;
        }

        // Obtener el último ID_Tramites de la tabla
        var lastIdTramites = $('#tramitesTable tbody tr:last td:first').text();
        var newIdTramites = lastIdTramites ? parseInt(lastIdTramites) + 1 : 1;

        // Insertar el nuevo registro en la tabla
        var newRow = '<tr><td class="hidden-column">' +
            newIdTramites +
            '</td><td>' +
            inputTram +
            '</td><td>' +
            inputDir +
            '</td><td><button class="btn btn-danger btn-sm delete-row" title="Eliminar"><i class="fas fa-trash-alt"></i></button></td></tr>';
        $('#tramitesTable tbody').append(newRow);

        // Limpia los valores de los inputs
        $('#inputTram').val('');
        $('#inputDir').val('');
    });

    // Manejar el evento de clic en el botón de eliminar
    $('#tramitesTable').on('click', '.delete-row', function () {
        var row = $(this).closest('tr');
        var rowIndex = row.index();
        var table = $('#tramitesTable tbody');

        // Eliminar la fila seleccionada
        row.remove();

        // Reducir "ID_Tramites" y "Orden" de las filas siguientes
        table.find('tr').each(function (index) {
            if (index >= rowIndex) {
                var idTramitesCell = $(this).find('td').eq(0);
                var newIdTramites = parseInt(idTramitesCell.text()) - 1;
                idTramitesCell.text(newIdTramites);
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn-tramites').click(function () {
            $('#myModal').modal('show');
        });
    });
</script>
<script>
    function closeModal() {
        $('.modal').modal('hide'); // Oculta el modal
    }
</script>



<script>
    $(document).ready(function () {
        $('input[type=radio][name=opcion]').change(function () {
            if (this.value == 'si') {
                $('#checkboxes').show();
            } else if (this.value == 'no') {
                $('#checkboxes').hide();
            }
        });
    });
</script>

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
    // Aqui se hace la busqueda de los sectores y se muestran en una lista
    $(document).ready(function () {

        $('#SectorInput').on('keyup', function () {
            let searchTerm = $(this).val();
            if (searchTerm.trim() === '') {
                $('#sectorResults').empty();
                return;
            }
            $.ajax({
                url: '<?= base_url('RegulacionController/search_sector') ?>',
                type: 'POST',
                data: {
                    search_term: searchTerm
                },
                dataType: 'json',
                success: function (data) {
                    $('#sectorResults').empty();
                    data.forEach(function (sector) {
                        $('#sectorResults').append('<li data-id="' + sector
                            .ID_sector + '">' + sector.Nombre_Sector +
                            '</li>');
                    });
                }
            });
        });

        // Aqui se selecciona el sector y se agrega a la lista
        $('#sectorResults').on('click', 'li', function () {
            let sectorId = $(this).data('id');
            let sectorName = $(this).text();
            // Verificar si el sector ya está en la lista
            if (selectedSectorsIds.includes(sectorId)) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Este sector ya ha sido agregado.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
            // Verificar si el sector ya está en la tabla
            let sectorExistsInTable = false;
            $('#selectedSectorsTable tbody tr').each(function () {
                if ($(this).find('td:first').text() === sectorName) {
                    sectorExistsInTable = true;
                    return false; // Salir del bucle each
                }
            });
            if (sectorExistsInTable) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Este sector ya ha sido agregado en la tabla.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
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
                '<td><button class="btn btn-danger btn-sm delete-row" title="Eliminar" >' +
                '<i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>');
        });

        // Evento para eliminar sectores
        $('#selectedSectorsTable').on('click', '.delete-row', function () {
            // Obtener el ID del sector de la fila
            let sectorId = $(this).closest('tr').data('id');

            // Eliminar la fila de la tabla
            $(this).closest('tr').remove();

            // Eliminar el sector del array
            selectedSectors = selectedSectors.filter(function (sector) {
                return sector.ID_sector !== sectorId;
            });

            console.log(selectedSectors);

            // Ocultar la tabla si no hay más filas
            if ($('#selectedSectorsTable tbody tr').length === 0) {
                $('#selectedSectorsTable').hide();
            }
        });

        // Aqui se hace la busqueda de los subsectores y se muestran en una lista
        $('#SubsectorInput').on('keyup', function () {
            let searchTerm = $(this).val();
            if (searchTerm.trim() === '') {
                $('#subsectorResults').empty();
                return;
            }
            $.ajax({
                url: '<?= base_url('RegulacionController/search_subsector') ?>',
                type: 'POST',
                data: {
                    search_term: searchTerm
                },
                dataType: 'json',
                success: function (data) {
                    $('#subsectorResults').empty();
                    data.forEach(function (subsector) {
                        $('#subsectorResults').append(
                            '<li class="list-group-item" data-id="' +
                            subsector.ID_subsector + '">' + subsector
                                .Nombre_Subsector + '</li>');
                    });
                }
            });
        });

        // Aqui se selecciona el subsector y se agrega a la lista
        $('#subsectorResults').on('click', 'li', function () {
            let subsectorId = $(this).data('id');
            let subsectorName = $(this).text();
            // Verificar si el subsector ya está en la lista de IDs
            if (selectedSubsectorsIds.includes(subsectorId)) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Este subsector ya ha sido agregado.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
            // Verificar si el subsector ya está en la tabla
            let subsectorExistsInTable = false;
            $('#selectedSubsectorsTable tbody tr').each(function () {
                if ($(this).find('td:first').text() === subsectorName) {
                    subsectorExistsInTable = true;
                    return false; // Salir del bucle each
                }
            });
            if (subsectorExistsInTable) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Este subsector ya ha sido agregado en la tabla.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
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
                '<td><button class="btn btn-danger btn-sm delete-row" title="Eliminar" >' +
                '<i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>');
        });

        // Evento para eliminar subsectores
        $('#selectedSubsectorsTable').on('click', '.delete-row', function () {
            // Obtener el ID del subsector de la fila
            let subsectorId = $(this).closest('tr').data('id');

            // Eliminar la fila de la tabla
            $(this).closest('tr').remove();

            // Eliminar el subsector del array
            selectedSubsectors = selectedSubsectors.filter(function (subsector) {
                return subsector.ID_subsector !== subsectorId;
            });

            console.log(selectedSubsectors);

            // Ocultar la tabla si no hay más filas
            if ($('#selectedSubsectorsTable tbody tr').length === 0) {
                $('#selectedSubsectorsTable').hide();
            }
        });

        // Aqui se hace la busqueda de las ramas y se muestran en una lista
        $('#RamaInput').on('keyup', function () {
            let searchTerm = $(this).val();
            if (searchTerm.trim() === '') {
                $('#ramaResults').empty();
                return;
            }
            $.ajax({
                url: '<?= base_url('RegulacionController/search_rama') ?>',
                type: 'POST',
                data: {
                    search_term: searchTerm
                },
                dataType: 'json',
                success: function (data) {
                    $('#ramaResults').empty();
                    data.forEach(function (rama) {
                        $('#ramaResults').append(
                            '<li class="list-group-item" data-id="' + rama
                                .ID_Rama + '">' + rama.Nombre_Rama + '</li>');
                    });
                }
            });
        });

        // Aqui se selecciona la rama y se agrega a la lista
        $('#ramaResults').on('click', 'li', function () {
            let ramaId = $(this).data('id');
            let ramaName = $(this).text();
            // Verificar si la rama ya está en la lista de IDs
            if (selectedRamasIds.includes(ramaId)) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Esta rama ya ha sido agregada.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
            // Verificar si la rama ya está en la tabla
            let ramaExistsInTable = false;
            $('#selectedRamasTable tbody tr').each(function () {
                if ($(this).find('td:first').text() === ramaName) {
                    ramaExistsInTable = true;
                    return false; // Salir del bucle each
                }
            });
            if (ramaExistsInTable) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Esta rama ya ha sido agregada en la tabla.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
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
                '<td><button class="btn btn-danger btn-sm delete-row" title="Eliminar" >' +
                '<i class="fas fa-trash-alt"></i></button></td>' + '</tr>');
        });

        // Evento para eliminar ramas
        $('#selectedRamasTable').on('click', '.delete-row', function () {
            // Obtener el ID de la rama de la fila
            let ramaId = $(this).closest('tr').data('id');

            // Eliminar la fila de la tabla
            $(this).closest('tr').remove();

            // Eliminar la rama del array
            selectedRamas = selectedRamas.filter(function (rama) {
                return rama.ID_Rama !== ramaId;
            });

            console.log(selectedRamas);

            // Ocultar la tabla si no hay más filas
            if ($('#selectedRamasTable tbody tr').length === 0) {
                $('#selectedRamasTable').hide();
            }
        });

        // Aqui se hace la busqueda de las subramas y se muestran en una lista
        $('#SubramaInput').on('keyup', function () {
            let searchTerm = $(this).val();
            if (searchTerm.trim() === '') {
                $('#subramaResults').empty();
                return;
            }
            $.ajax({
                url: '<?= base_url('RegulacionController/search_subrama') ?>',
                type: 'POST',
                data: {
                    search_term: searchTerm
                },
                dataType: 'json',
                success: function (data) {
                    $('#subramaResults').empty();
                    data.forEach(function (subrama) {
                        $('#subramaResults').append(
                            '<li class="list-group-item" data-id="' + subrama
                                .ID_Subrama + '">' + subrama.Nombre_Subrama + '</li>');
                    });
                }
            });
        });

        // Aqui se selecciona la subrama y se agrega a la lista
        $('#subramaResults').on('click', 'li', function () {
            let subramaId = $(this).data('id');
            let subramaName = $(this).text();
            // Verificar si la subrama ya está en la lista de IDs
            if (selectedSubramasIds.includes(subramaId)) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Esta subrama ya ha sido agregada.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
            // Verificar si la subrama ya está en la tabla
            let subramaExistsInTable = false;
            $('#selectedSubramasTable tbody tr').each(function () {
                if ($(this).find('td:first').text() === subramaName) {
                    subramaExistsInTable = true;
                    return false; // Salir del bucle each
                }
            });
            if (subramaExistsInTable) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Esta subrama ya ha sido agregada en la tabla.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
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
                '<td><button class="btn btn-danger btn-sm delete-row" title="Eliminar" >' +
                '<i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>');
        });

        // Evento para eliminar subramas
        $('#selectedSubramasTable').on('click', '.delete-row', function () {
            // Obtener el ID de la subrama de la fila
            let subramaId = $(this).closest('tr').data('id');

            // Eliminar la fila de la tabla
            $(this).closest('tr').remove();

            // Eliminar la subrama del array
            selectedSubramas = selectedSubramas.filter(function (subrama) {
                return subrama.ID_Subrama !== subramaId;
            });

            console.log(selectedSubramas);

            // Ocultar la tabla si no hay más filas
            if ($('#selectedSubramasTable tbody tr').length === 0) {
                $('#selectedSubramasTable').hide();
            }
        });

        // Aqui se hace la busqueda de las clases y se muestran en una lista
        $('#ClaseInput').on('keyup', function () {
            let searchTerm = $(this).val();
            if (searchTerm.trim() === '') {
                $('#claseResults').empty();
                return;
            }
            $.ajax({
                url: '<?= base_url('RegulacionController/search_clase') ?>',
                type: 'POST',
                data: {
                    search_term: searchTerm
                },
                dataType: 'json',
                success: function (data) {
                    $('#claseResults').empty();
                    data.forEach(function (clase) {
                        $('#claseResults').append(
                            '<li class="list-group-item" data-id="' + clase
                                .ID_clase + '">' + clase.Nombre_Clase + '</li>');
                    });
                }
            });
        });

        // Aqui se selecciona la clase y se agrega a la lista
        $('#claseResults').on('click', 'li', function () {
            let claseId = $(this).data('id');
            let claseName = $(this).text();
            // Verificar si la clase ya está en la lista de IDs
            if (selectedClasesIds.includes(claseId)) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Esta clase ya ha sido agregada.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
            // Verificar si la clase ya está en la tabla
            let claseExistsInTable = false;
            $('#selectedClasesTable tbody tr').each(function () {
                if ($(this).find('td:first').text() === claseName) {
                    claseExistsInTable = true;
                    return false; // Salir del bucle each
                }
            });
            if (claseExistsInTable) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Esta clase ya ha sido agregada en la tabla.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
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
                '<td><button class="btn btn-danger btn-sm delete-row" title="Eliminar" >' +
                '<i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>');
        });

        // Evento para eliminar clases
        $('#selectedClasesTable').on('click', '.delete-row', function () {
            // Obtener el ID de la clase de la fila
            let ClaseId = $(this).closest('tr').data('id');

            // Eliminar la fila de la tabla
            $(this).closest('tr').remove();

            // Eliminar la clase del array
            selectedClases = selectedClases.filter(function (clase) {
                return clase.ID_clase !== ClaseId;
            });

            console.log(selectedClases);

            // Ocultar la tabla si no hay más filas
            if ($('#selectedClasesTable tbody tr').length === 0) {
                $('#selectedClasesTable').hide();
            }
        });

        //aqui busca las regulaciones y las muesta en una lista
        $('#inputVinculadas').on('keyup', function () {
            let searchTerm = $(this).val();
            if (searchTerm.trim() === '') {
                $('#vinculadasResults').empty();
                return;
            }
            $.ajax({
                url: '<?= base_url('RegulacionController/search_regulacion') ?>',
                type: 'POST',
                data: {
                    search_term: searchTerm
                },
                dataType: 'json',
                success: function (data) {
                    $('#vinculadasResults').empty();
                    data.forEach(function (regulacion) {
                        $('#vinculadasResults').append(
                            '<li class="list-group-item" data-id="' + regulacion
                                .ID_Regulacion + '">' + regulacion.Nombre_Regulacion +
                            '</li>');
                    });
                }
            });
        });

        //aqui selecciona la regulacion y la agrega a la lista
        $('#vinculadasResults').on('click', 'li', function () {
            let regulacionId = $(this).data('id');
            let regulacionName = $(this).text();
            // Verificar si la regulación ya está en la lista de IDs
            if (selectedRegulaciones.some(regulacion => regulacion.ID_Regulacion === regulacionId)) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Esta regulación ya ha sido agregada.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
            // Verificar si la regulación ya está en la tabla
            let regulacionExistsInTable = false;
            $('#selectedRegulacionesTable tbody tr').each(function () {
                if ($(this).find('td:first').text().trim() === regulacionName) {
                    regulacionExistsInTable = true;
                    return false; // Salir del bucle each
                }
            });
            if (regulacionExistsInTable) {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Esta regulación ya ha sido agregada en la tabla.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }
            selectedRegulaciones.push({
                ID_Regulacion: regulacionId
            });
            console.log('selected regulaciones', selectedRegulaciones);

            // Ocultar la lista y borrar el texto del input
            $('#vinculadasResults').empty();
            $('#inputVinculadas').val('');

            // Mostrar la tabla y agregar una fila
            $('#selectedRegulacionesTable').show();
            $('#selectedRegulacionesTable tbody').append('<tr><td>' + regulacionName +
                '</td>+<td> </td>+<td><button class="btn btn-danger btn-sm delete-row">' +
                '<i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>');
        });

        let manualRegulaciones = []; // Declaración global
        $(document).ready(function () {
            $('#manualEntryCheckbox').on('change', function () {
                if (this.checked) {
                    $('#manualEntryFields').show();
                    $('#inputVinculadas').prop('disabled', true);
                } else {
                    $('#manualEntryFields').hide();
                    $('#inputVinculadas').prop('disabled', false);
                }
            });

            // Detecta el clic en el botón de agregar regulaciones manuales
            $('#addRegulacionButton').on('click', function () {
                let regulacionName = $('#manualRegulacionNombre').val();
                let regulacionLink = $('#manualRegulacionLink').val();

                if (regulacionName && regulacionLink) {
                    // Agrega la regulación manual a la tabla y a la variable manualRegulaciones
                    $('#selectedRegulacionesTable tbody').append('<tr><td>' + regulacionName + '</td><td>' + regulacionLink + '</td><td><button class="btn btn-danger btn-sm delete-row" title="Eliminar"><i class="fas fa-trash-alt"></i></button></td></tr>');
                    $('#selectedRegulacionesTable').show();

                    // Agrega la regulación manual al array para enviarla a la base de datos
                    manualRegulaciones.push({
                        nombre: regulacionName,
                        enlace: regulacionLink
                    });

                    // Limpia los campos del formulario
                    $('#manualRegulacionNombre').val('');
                    $('#manualRegulacionLink').val('');
                } else {
                    alert('Por favor, complete ambos campos antes de agregar.');
                }
            });

            $('#selectedRegulacionesTable').on('click', '.delete-row', function () {
                $(this).closest('tr').remove();
                if ($('#selectedRegulacionesTable tbody tr').length === 0) {
                    $('#selectedRegulacionesTable').hide();
                }
            });
        });
        //verificamos que se de click en el boton guardar y validamos si es si o no
        //aqui guardamos los datos
        $(document).ready(function () {
            $('#btnGnat').on('click', function () {
                if (!$('#si').is(':checked') && !$('#no').is(':checked') || $('#tramitesTable tbody tr').length === 0 || $('#inputEnlace').val() === '') {
                    if ($('#tramitesTable tbody tr').length === 0) {
                        $('#tramitesText').css('color', 'red');
                        $('#tramitesText').after('<span class="error-message" style="color: red;">Por favor, agregue al menos un trámite.</span>');
                    }
                    if ($('#inputEnlace').val() === '') {
                        $('#inputEnlace').css('border-color', 'red');
                        $('#inputEnlace').after('<span class="error-message" style="color: red;">Por favor, complete este campo.</span>');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor, seleccione una opción y agregue al menos un trámite',
                    });
                    return;
                } else {
                    var formData = new FormData($('#formGnat')[0]);

                    if ($('#no').is(':checked')) {
                        formData.append('btn_clicked', true);
                        formData.append('radio_no_selected', true);
                        formData.append('inputEnlace', $('#inputEnlace').val());
                        formData.append('selectedRegulaciones', JSON.stringify(selectedRegulaciones));
                    } else if ($('#si').is(':checked')) {
                        formData.append('btn_clicked', true);
                        formData.append('radio_si_selected', true);
                        formData.append('inputEnlace', $('#inputEnlace').val());
                        formData.append('selectedRegulaciones', JSON.stringify(selectedRegulaciones));
                        formData.append('selectedSectors', JSON.stringify(selectedSectorsIds));
                        formData.append('selectedSubsectors', JSON.stringify(selectedSubsectorsIds));
                        formData.append('selectedRamas', JSON.stringify(selectedRamasIds));
                        formData.append('selectedSubramas', JSON.stringify(selectedSubramasIds));
                        formData.append('selectedClases', JSON.stringify(selectedClasesIds));
                    }
                    // Extraer registros de la tabla tramitesTable
                    var tramites = [];
                    $('#tramitesTable tbody tr').each(function () {
                        var nombre = $(this).find('td').eq(1).text();
                        var direccion = $(this).find('td').eq(2).text();
                        tramites.push({
                            Nombre: nombre,
                            Direccion: direccion
                        });
                    });

                    formData.append('manualRegulaciones', JSON.stringify(manualRegulaciones));
                    formData.append('tramites', JSON.stringify(tramites));
                    console.log('formData:', formData.get('tramites'));

                    $.ajax({
                        url: '<?= base_url('RegulacionController/save_naturaleza_regulacion') ?>',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function (response) {
                            console.log('Respuesta del servidor:', response);
                            if (response.status === 'success') {
                                // Agregar los registros a la tabla tramitesTable
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: 'Datos guardados exitosamente',
                                }).then(() => {
                                    window.location.href =
                                        '<?= base_url('RegulacionController') ?>';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error al guardar los datos: ' + response
                                        .message,
                                }).then(() => {
                                    window.location.href =
                                        '<?= base_url('RegulacionController') ?>';
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error en la solicitud AJAX:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error en la solicitud AJAX: ' + error,
                            });
                        }
                    });
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('manualEntryCheckbox');
        const inputVinculadas = document.getElementById('inputVinculadas');
        const manualEntryFields = document.getElementById('manualEntryFields');

        checkbox.addEventListener('change', function () {
            if (this.checked) {
                inputVinculadas.disabled = true;
                manualEntryFields.style.display = 'block';
            } else {
                inputVinculadas.disabled = false;
                manualEntryFields.style.display = 'none';
            }
        });
    });
</script>
@endsection