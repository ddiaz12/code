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
    <li class="breadcrumb-item active"><i class="fa-solid fa-plus-circle"></i>Inscripción al Registro Estatal de
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
                                <li class="iconos-regulacion active-view">
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
                <!-- Existing card -->
                <div class="card flex-grow-1">
                    <div class="card">
                        <div class="card-header text-white">Inscripción al Registro Estatal de Regulaciones (RER)</div>
                        <div class="card-body">

                            <!-- Formulario de agregar regulaciones -->
                            <form class="row g-3" id="form-regulacion">
                                <div class="form-group">
                                    <label for="inputNombre">Nombre <span style="color: gray;">(usar mayúsculas y
                                            minúsculas en la escritura)</span><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputNombre" name="nombre"
                                        placeholder="Nombre de la regulación" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selectSujeto">Ámbito de aplicación</label>
                                        <select class="form-control" id="selectSujeto" name="sujeto" required>
                                            <option disabled selected>Selecciona una opción</option>
                                            <option value="Estatal">Estatal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selectUnidad">Tipo de ordenamiento jurídico</label>
                                        <select class="form-control" id="selectUnidad" name="unidad" required>
                                            <option disabled selected>Selecciona una opción</option>
                                            <?php foreach ($tipos_ordenamiento as $tipo): ?>
                                            <option value="<?php    echo $tipo->ID_tOrdJur;?>">
                                                <?php    echo $tipo->Tipo_Ordenamiento;?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFecha">Fecha de expedición de la regulación<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="inputFecha" name="fecha_expedicion"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFecha">Fecha de publicación de la regulación</label>
                                    <input type="date" class="form-control" id="inputFecha" name="fecha_publicacion"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFecha">Fecha de entrada en vigor de la regulación</label>
                                    <input type="date" class="form-control" id="inputFecha" name="fecha_vigor" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFecha">Fecha de última actualización de la regulación</label>
                                    <input type="date" class="form-control" id="inputFecha" name="fecha_act" required>
                                </div>

                                <form>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div id="selectVigencia">
                                            <p>¿La regulación tiene vigencia definida?</p>
                                            <div class="d-flex justify-content-start mb-3">
                                                <label>
                                                    <input type="radio" name="opcion" id="si" onclick="mostrarCampo()">
                                                    Sí
                                                </label>
                                                <label class="ms-2">
                                                    <input type="radio" name="opcion" id="no" onclick="mostrarCampo()"
                                                        checked>
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="otroCampo">
                                            <label for="campoExtra">Vigencia de la regulación<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="campoExtra" name="campoExtra"
                                                required disabled>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputVialidad">Orden de gobierno que la emite:</label>
                                            <select class="form-control" id="selectUnidad" name="orden" required>
                                                <option disabled selected>Selecciona una opción</option>
                                                <option value="Poder Ejecutivo">Poder Ejecutivo</option>
                                                <option value="Poder Legistativo">Poder Legistativo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="AutoridadesEmiten">Autoridades que emiten la
                                                regulación</label>
                                            <input type="text" class="form-control" id="AutoridadesEmiten"
                                                name="aut_emiten" required>
                                            <div id="searchResults" class="list-group"></div>
                                        </div>
                                    </div>
                                    <div id="apTContainer">
                                        <table id="emitenTable" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="hidden-column">ID_Dependencia</th>
                                                    <th>Tipo dependencia</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Las filas se agregarán dinámicamente aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <style>
                                    .hidden-column {
                                        display: none;
                                    }
                                </style>
                                <form>
                                    <div class="d-flex justify-content-align-items mb-3 ">
                                        <div id="selectAplican">
                                            <p>¿Están obligadas todas las autoridades a cumplir con la
                                                regulación?</p>
                                            <div class="d-flex justify-content-start mb-3">
                                                <label>
                                                    <input type="radio" name="opcion" id="apsi"
                                                        onclick="mostrarCampo2()"> Sí
                                                </label>
                                                <label class="ms-2">
                                                    <input type="radio" name="opcion" id="apno"
                                                        onclick="mostrarCampo2()"> No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="opcAplican">
                                        <div class="col-md-6" id="selectUnidad2Container">
                                            <div class="form-group">
                                                <label for="selectUnidad2">Orden de gobierno que la
                                                    emite:<span class="text-danger">*</span></label>
                                                <select class="form-control" id="selectUnidad2" name="selectUnidad2"
                                                    required>
                                                    <option disabled selected>Selecciona una opción
                                                    </option>
                                                    <option value="Poder Ejecutivo">Poder Ejecutivo</option>
                                                    <option value="Poder Legistativo">Poder Legistativo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="AutoridadesAplicanContainer">
                                            <div class="form-group">
                                                <label for="AutoridadesAplican">Autoridades que aplican
                                                    la regulación<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="AutoridadesAplican"
                                                    name="AutoridadesAplican" required>
                                                <div id="searchResults2" class="list-group"></div>
                                            </div>
                                        </div>
                                        <div id="apTContainer">
                                            <table id="aplicanTable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="hidden-column">ID_Dependencia</th>
                                                        <th>Tipo dependencia</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Las filas se agregarán dinámicamente aquí -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                                <div class="header-container mb-0">
                                    <p class="mb-0">Índice de la regulación</p>
                                    <button type="button" id="botonIndice" class="btn btn-indice" data-toggle="modal"
                                        data-target="#myModal">Agregar</button>
                                </div>

                                <!-- Tabla de Índices -->
                                <table id="resultTable" class="table table-spacing">
                                    <thead>
                                        <tr>
                                            <th class="hidden-column">ID_Indice</th>
                                            <th></th>
                                            <th>Texto</th>
                                            <th>Orden</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Las filas se agregarán dinámicamente aquí -->
                                    </tbody>
                                </table>
                                <!-- Modal para Agregar Índices -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Índice</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="inputTexto">Texto</label>
                                                        <input type="text" class="form-control" id="inputTexto"
                                                            placeholder="Ingrese texto" name="texto">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="selectIndicePadre">Índice Padre</label>
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


                                <div class="form-group">
                                    <label for="inputObjetivo">Objeto de la regulación</label>
                                    <textarea class="form-control" id="inputObjetivo" name="objetivoReg"></textarea>
                                </div>
                                <p></p>
                                <div class="header-container mb-0">
                                    <p id="matText" class="mb-0">Materias, Sectores y Sujetos Regulados<span
                                            class="text-danger">*</span></p>
                                    <button type="button" id="botonMaterias"
                                        class="btn btn-tinto btn-materias" data-toggle="modal"
                                        data-target="#matModal">Agregar</button>
                                </div>

                                <!-- Tabla con los datos -->
                                <table id="materiasTable" class="table table-spacing">
                                    <thead>
                                        <tr>
                                            <th class="hidden-column">ID_MatSec</th>
                                            <th>Materias</th>
                                            <th>Sectores</th>
                                            <th>Sujetos Regulados</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Las filas se agregarán dinámicamente aquí -->
                                    </tbody>
                                </table>

                                <!-- Modal para Agregar Materias, Sectores y Sujetos Regulados -->
                                <div class="modal fade" id="matModal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Materias, Sectores y Sujetos
                                                    Regulados</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="inputMat">Materias</label>
                                                        <input type="text" class="form-control" id="inputMat"
                                                            placeholder="Ingrese la(s) materia(s)" name="NombreTram">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSec">Sectores</label>
                                                        <input type="text" class="form-control" id="inputSec"
                                                            placeholder="Ingrese el sector(es)" name="NombreSec">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSuj">Sujetos Regulados</label>
                                                        <input type="text" class="form-control" id="inputSuj"
                                                            placeholder="Ingrese sujeto(s)" name="NombreSuj">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    onclick="closeModal()">Cerrar</button>
                                                <button type="button" id="guardarMat" class="btn btn-tinto">Guardar
                                                    cambios</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <p></p>
                                <div class="header-container mb-0">
                                    <p id="funText" class="mb-0">Fundamentos Jurídicos<span class="text-danger">*</span>
                                    </p>
                                    <button type="button" id="botofundamentos"
                                        class="btn btn-tinto btn-fundamentos" data-toggle="modal"
                                        data-target="#funModal">Agregar</button>
                                </div>

                                <!-- Tabla de Fundamentos Jurídicos -->
                                <table id="fundamentoTable" class="table table-spacing">
                                    <thead>
                                        <tr>
                                            <th class="hidden-column">ID_Fun</th>
                                            <th>Nombre Regulacion</th>
                                            <th>Articulo</th>
                                            <th>Link</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Las filas se agregarán dinámicamente aquí -->
                                    </tbody>
                                </table>

                                <!-- Modal para Agregar Fundamentos Jurídicos -->
                                <div class="modal fade" id="funModal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Fundamentos Jurídicos</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="inputNomReg">Nombre de la Regulacion</label>
                                                        <input type="text" class="form-control" id="inputNomReg"
                                                            placeholder="Ingrese el Nombre" name="NombreReg">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputArt">Articulo, párrafo, numeral, etc.</label>
                                                        <input type="text" class="form-control" id="inputArt"
                                                            placeholder="Ingrese el Articulo" name="NombreArt">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputLink">Link</label>
                                                        <input type="text" class="form-control" id="inputLink"
                                                            placeholder="http://" name="NombreLink">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    onclick="closeModal()">Cerrar</button>
                                                <button type="button" id="guardarFun" class="btn btn-tinto">Guardar
                                                    cambios</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p></p>
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="<?php echo base_url('RegulacionController'); ?>"
                                        class="btn btn-secondary me-2">Cancelar</a>
                                    <button type="button" class="btn btn-success btn-tinto"
                                        id="botonGuardar">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function mostrarCampo() {
        var siSeleccionado = document.getElementById("si").checked;
        var otroCampo = document.getElementById("otroCampo");
        var campoExtra = document.getElementById("campoExtra");

        if (siSeleccionado) {
            otroCampo.disabled = false; // Habilitar el campo
            campoExtra.disabled = false; // Habilitar el campo de fecha
        } else {
            otroCampo.disabled = true; // Bloquear el campo
            campoExtra.disabled = true; // Bloquear el campo de fecha
        }
    }
</script>
<script>
    $(document).ready(function () {
        $('.btn-materias').click(function () {
            $('#matModal').modal('show');
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn-fundamentos').click(function () {
            $('#funModal').modal('show');
        });
    });
</script>
<script>
    $(document).ready(function () {
        var idCounter = 1; // Inicializa el contador de ID_MatSec

        // Realiza una solicitud AJAX para verificar si existen registros en la base de datos
        $.ajax({
            url: '<?= base_url('RegulacionController/verificarRegistros') ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.existenRegistros) {
                    idCounter = parseInt(response.ultimoID, 10) + 1; // Inicializa el contador con el último ID + 1
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al verificar los registros en la base de datos.'
                });
            }
        });

        $('#guardarMat').click(function () {
            // Obtiene los valores de los inputs
            var inputMat = $('#inputMat').val();
            var inputSec = $('#inputSec').val();
            var inputSuj = $('#inputSuj').val();

            // Crea una nueva fila con los datos
            var newRow = '<tr>' +
                '<td class="hidden-column">' + idCounter + '</td>' +
                '<td>' + inputMat + '</td>' +
                '<td>' + inputSec + '</td>' +
                '<td>' + inputSuj + '</td>' +
                '<td><button class="btn btn-danger btn-sm delete-row">' +
                '<i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>';

            // Agrega la nueva fila a la tabla
            $('#materiasTable tbody').append(newRow);

            // Incrementa el contador de ID_MatSec
            idCounter++;

            // Limpia los valores de los inputs
            $('#inputMat').val('');
            $('#inputSec').val('');
            $('#inputSuj').val('');
        });

        // Maneja el evento de clic para eliminar una fila
        $('#materiasTable').on('click', '.delete-row', function () {
            $(this).closest('tr').remove();
            idCounter--;
        });
    });
</script>
<script>
    $(document).ready(function () {
        var idCounter2 = 1; // Inicializa el contador de ID_MatSec

        // Realiza una solicitud AJAX para verificar si existen registros en la base de datos
        $.ajax({
            url: '<?= base_url('RegulacionController/verificarFundamentos') ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.existenRegistros) {
                    idCounter2 = parseInt(response.ultimoID, 10) + 1; // Inicializa el contador con el último ID + 1
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al verificar los registros en la base de datos.'
                });
            }
        });

        $('#guardarFun').click(function () {
            // Obtiene los valores de los inputs
            var inputNomReg = $('#inputNomReg').val();
            var inputArt = $('#inputArt').val();
            var inputLink = $('#inputLink').val();

            // Crea una nueva fila con los datos
            var newRow = '<tr>' +
                '<td class="hidden-column">' + idCounter2 + '</td>' +
                '<td>' + inputNomReg + '</td>' +
                '<td>' + inputArt + '</td>' +
                '<td>' + inputLink + '</td>' +
                '<td><button class="btn btn-danger btn-sm delete-row">' +
                '<i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>';

            // Agrega la nueva fila a la tabla
            $('#fundamentoTable tbody').append(newRow);

            // Incrementa el contador de ID_Fun
            idCounter2++;

            // Limpia los valores de los inputs
            $('#inputNomReg').val('');
            $('#inputArt').val('');
            $('#inputLink').val('');
        });
        // Maneja el evento de clic para eliminar una fila
        $('#fundamentoTable').on('click', '.delete-row', function () {
            $(this).closest('tr').remove();
            idCounter2--;
        });
    });
</script>
<script>
    function mostrarCampo2() {
        var si = document.getElementById('apsi');
        var no = document.getElementById('apno');
        var selectUnidad2Container = document.getElementById('selectUnidad2Container');
        var autoridadesAplicanContainer = document.getElementById('AutoridadesAplicanContainer');
        var apTContainer = document.getElementById('apTContainer');
        var selectUnidad2 = document.getElementById('selectUnidad2');
        var AutoridadesAplican = document.getElementById('AutoridadesAplican');

        if (no.checked) {
            selectUnidad2.disabled = false;
            AutoridadesAplican.disabled = false;
        } else if (si.checked) {
            selectUnidad2.disabled = true;
            AutoridadesAplican.disabled = true;
        } else {
            selectUnidad2.disabled = true;
            AutoridadesAplican.disabled = true;
        }
    }

    // Inicializar la visibilidad de los campos al cargar la página
    document.addEventListener('DOMContentLoaded', function () {
        mostrarCampo2();
    });
</script>
<script>
    $(document).ready(function () {
        var emitenArray = [];
        var aplicanArray = [];

        // Método para AutoridadesEmiten
        $('#AutoridadesEmiten').on('input', function () {
            var query = $(this).val();
            console.log('Query:', query); // Verifica que la consulta esté bien
            if (query.length > 0) {
                $.ajax({
                    url: '<?= base_url('RegulacionController/search') ?>',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function (data) {
                        console.log('Response data:',
                            data); // Verifica que la respuesta sea la esperada
                        try {
                            var results = JSON.parse(data);
                            var resultsContainer = $('#searchResults');
                            resultsContainer.empty();
                            results.forEach(function (item) {
                                resultsContainer.append(
                                    '<a href="#" class="list-group-item list-group-item-action" data-id="' +
                                    item.ID_Dependencia + '">' + item
                                        .Tipo_Dependencia + '</a>');
                            });
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                    }
                });
            } else {
                $('#searchResults').empty();
            }
        });

        // Método para AutoridadesAplican
        $('#AutoridadesAplican').on('input', function () {
            var query = $(this).val();
            console.log('Query:', query); // Verifica que la consulta esté bien
            if (query.length > 0) {
                $.ajax({
                    url: '<?= base_url('RegulacionController/search') ?>',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function (data) {
                        console.log('Response data:',
                            data); // Verifica que la respuesta sea la esperada
                        try {
                            var results = JSON.parse(data);
                            var resultsContainer = $('#searchResults2');
                            resultsContainer.empty();
                            results.forEach(function (item) {
                                resultsContainer.append(
                                    '<a href="#" class="list-group-item list-group-item-action" data-id="' +
                                    item.ID_Dependencia + '">' + item
                                        .Tipo_Dependencia + '</a>');
                            });
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                    }
                });
            } else {
                $('#searchResults2').empty();
            }
        });

        // Handle click on search result for AutoridadesEmiten
        $(document).on('click', '#searchResults .list-group-item', function () {
            var id = $(this).data('id');
            var text = $(this).text();
            emitenArray.push({
                ID_Dependencia: id,
                Tipo_Dependencia: text
            });
            $('#AutoridadesEmiten').val('');
            $('#searchResults').empty();
            updateEmitenTable();
        });

        // Handle click on search result for AutoridadesAplican
        $(document).on('click', '#searchResults2 .list-group-item', function () {
            var id = $(this).data('id');
            var text = $(this).text();
            aplicanArray.push({
                ID_Dependencia: id,
                Tipo_Dependencia: text
            });
            $('#AutoridadesAplican').val('');
            $('#searchResults2').empty();
            updateAplicanTable();
        });

        function updateEmitenTable() {
            var tableBody = $('#emitenTable tbody');
            tableBody.empty();

            emitenArray.forEach(function (item) {
                var row = '<tr data-id="' + item.ID_Dependencia + '">' +
                    '<td class="hidden-column">' + item.ID_Dependencia + '</td>' +
                    '<td>' + item.Tipo_Dependencia + '</td>' +
                    '<td><button class="btn btn-danger btn-sm delete-row">' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>';
                tableBody.append(row);
            });
        }

        function updateAplicanTable() {
            var tableBody = $('#aplicanTable tbody');
            tableBody.empty();

            aplicanArray.forEach(function (item) {
                var row = '<tr data-id="' + item.ID_Dependencia + '">' +
                    '<td class="hidden-column">' + item.ID_Dependencia + '</td>' +
                    '<td>' + item.Tipo_Dependencia + '</td>' +
                    '<td><button class="btn btn-danger btn-sm delete-row">' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>';
                tableBody.append(row);
            });
        }

        // Manejar el evento de clic en el botón de eliminar
        $('#emitenTable').on('click', '.delete-row', function () {
            var row = $(this).closest('tr');
            var id = row.data('id');

            // Eliminar la fila de la tabla
            row.remove();

            // Eliminar el registro del array
            emitenArray = emitenArray.filter(function (item) {
                return item.ID_Dependencia !== id;
            });

            console.log('Registro eliminado. Array actualizado:', emitenArray);
        });

        $('#aplicanTable').on('click', '.delete-row', function () {
            var row = $(this).closest('tr');
            var id = row.data('id');

            // Eliminar la fila de la tabla
            row.remove();

            // Eliminar el registro del array
            aplicanArray = aplicanArray.filter(function (item) {
                return item.ID_Dependencia !== id;
            });

            console.log('Registro eliminado. Array actualizado:', aplicanArray);
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var caracteristicasData = {}; // Declaración global
    var reIndice = []; // Declaración global

    $(document).ready(function () {
        $('#botonGuardar').on('click', function () {

            var formData = {
                nombre: '',
                campoExtra: '',
                objetivoReg: '',
                unidad: '',
                sujeto: '',
                fecha_expedicion: '',
                fecha_publicacion: '',
                fecha_vigor: '',
                fecha_act: ''
            };
            var maxID = 0;

            $('input, input[type="date"], select, textarea').each(function () {
                var id = $(this).attr('id');
                if (id !== 'AutoridadesEmiten' && id !== 'AutoridadesAplican' && id !==
                    'inputTexto' && id !== 'selectIndicePadre' && id !== 'selectAplican' &&
                    id !== 'selectVigencia' && !id.includes('si') && !id.includes('no') && !id
                        .includes('apsi') && !id.includes('apno')) {
                    var name = $(this).attr('name');
                    var value = $(this).val();
                    formData[name] = value;
                }
            });



            // Imprimir formData en consola
            console.log(formData);
            if (formData.nombre === '' || formData.fecha_expedicion === '' || ($('#si').is(':checked') &&
                formData.campoExtra === '') || $('#materiasTable tbody tr').length === 0 || $('#fundamentoTable tbody tr').length === 0) {
                if (formData.nombre === '') {
                    $('#inputNombre').css('color', 'red');
                    $('#inputNombre').after(
                        '<span class="error-message" style="color: red;">El campo "Nombre" es obligatorio.</span>'
                    );
                }
                if (formData.fecha_expedicion === '') {
                    $('#inputFecha').css('color', 'red');
                    $('#inputFecha').after(
                        '<span class="error-message" style="color: red;">El campo "Fecha de Expedición de la regulación" es obligatorio.</span>'
                    );
                }
                if ($('#si').is(':checked') && formData.campoExtra === '') {
                    $('#campoExtra').css('color', 'red');
                    $('#campoExtra').after(
                        '<span class="error-message" style="color: red;">El campo "Vigencia de la regulación" es obligatorio cuando se selecciona "Sí".</span>'
                    );
                }
                if ($('#materiasTable tbody tr').length === 0) {
                    $('#matText').css('color', 'red');
                    $('#matText').after(
                        '<span class="error-message" style="color: red;">Debe agregar al menos un registro en la tabla "Materias, Sectores y Sujetos Regulados".</span>'
                    );
                }
                if ($('#fundamentoTable tbody tr').length === 0) {
                    $('#funText').css('color', 'red');
                    $('#funText').after(
                        '<span class="error-message" style="color: red;">Debe agregar al menos un registro en la tabla "Fundamentos Jurídicos".</span>'
                    );
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, complete los campos obligatorios.'
                });
                return;
            } else {
                $.ajax({
                    url: '<?php echo base_url('RegulacionController/insertarRegulacion'); ?>',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            // alert('Datos insertados correctamente');
                            // console.log('result', result);
                            // Swal.fire({
                            //     icon: 'success',
                            //     title: 'Éxito',
                            //     text: 'Datos insertados correctamente.'
                            // });

                            // Obtener el ID_Regulacion devuelto en la respuesta
                            var ID_Regulacion = result.ID_Regulacion;
                            console.log('ID_Regulacion', ID_Regulacion);

                            $.ajax({
                                url: '<?php echo base_url('RegulacionController/obtenerMaxIDCaract'); ?>',
                                type: 'GET',
                                success: function (maxIDResponse) {
                                    maxID = parseInt(maxIDResponse) + 1;
                                    console.log('maxID: ', maxID);

                                    $.ajax({
                                        url: '<?php echo base_url('RegulacionController/obtenerMaxIDRegulacion'); ?>',
                                        type: 'GET',
                                        success: function (
                                            maxIDRegResponse) {
                                            var maxIDReg = parseInt(
                                                maxIDRegResponse);

                                            // Asignar valores a la variable global caracteristicasData
                                            caracteristicasData = {
                                                ID_caract: maxID,
                                                ID_Regulacion: maxIDReg,
                                                ID_tOrdJur: formData
                                                    .unidad,
                                                Nombre: formData
                                                    .nombre,
                                                Ambito_Aplicacion: formData
                                                    .sujeto,
                                                Fecha_Exp: formData
                                                    .fecha_expedicion,
                                                Fecha_Publi: formData
                                                    .fecha_publicacion,
                                                Fecha_Vigor: formData
                                                    .fecha_vigor,
                                                Fecha_Act: formData
                                                    .fecha_act,
                                                Vigencia: formData
                                                    .campoExtra,
                                                Orden_Gob: formData
                                                    .orden
                                            };

                                            // Imprimir caracteristicasData en consola
                                            console.log(
                                                caracteristicasData);

                                            $.ajax({
                                                url: '<?php echo base_url('RegulacionController/insertarCaracteristicas'); ?>',
                                                type: 'POST',
                                                data: caracteristicasData,
                                                success: function (
                                                    caractResponse
                                                ) {
                                                    var caractResult =
                                                        JSON
                                                            .parse(
                                                                caractResponse
                                                            );
                                                    if (caractResult
                                                        .status ===
                                                        'success'
                                                    ) {
                                                        Swal
                                                            .fire({
                                                                icon: 'success',
                                                                title: 'Éxito',
                                                                text: 'Características insertadas correctamente.'
                                                            });

                                                        // Obtener todos los ID_Dependencia de la tabla emitenTable
                                                        var
                                                            ID_DependenciasEmiten = [];
                                                        $('#emitenTable tbody tr')
                                                            .each(
                                                                function () {
                                                                    var ID_Dependencia =
                                                                        $(
                                                                            this
                                                                        )
                                                                            .find(
                                                                                'td'
                                                                            )
                                                                            .eq(
                                                                                0
                                                                            )
                                                                            .text();
                                                                    ID_DependenciasEmiten
                                                                        .push(
                                                                            ID_Dependencia
                                                                        );
                                                                }
                                                            );

                                                        // Insertar en la tabla rel_autoridades_emiten
                                                        ID_DependenciasEmiten
                                                            .forEach(
                                                                function (
                                                                    ID_Dependencia
                                                                ) {
                                                                    var relDataEmiten = {
                                                                        ID_Emiten: ID_Dependencia,
                                                                        ID_Caract: maxID
                                                                    };

                                                                    $.ajax({
                                                                        url: '<?php echo base_url('RegulacionController/insertarRelAutoridadesEmiten'); ?>',
                                                                        type: 'POST',
                                                                        data: relDataEmiten,
                                                                        success: function (
                                                                            relResponse
                                                                        ) {
                                                                            var relResult =
                                                                                JSON
                                                                                    .parse(
                                                                                        relResponse
                                                                                    );
                                                                            if (relResult
                                                                                .status ===
                                                                                'success'
                                                                            ) {
                                                                                console
                                                                                    .log(
                                                                                        'Relación Emiten insertada correctamente'
                                                                                    );
                                                                            } else {
                                                                                console
                                                                                    .log(
                                                                                        'Error al insertar la relación'
                                                                                    );
                                                                            }
                                                                        }
                                                                    });
                                                                }
                                                            );

                                                        // Obtener todos los ID_Dependencia de la tabla aplicanTable
                                                        var
                                                            ID_DependenciasAplican = [];
                                                        $('#aplicanTable tbody tr')
                                                            .each(
                                                                function () {
                                                                    var ID_Dependencia =
                                                                        $(
                                                                            this
                                                                        )
                                                                            .find(
                                                                                'td'
                                                                            )
                                                                            .eq(
                                                                                0
                                                                            )
                                                                            .text();
                                                                    ID_DependenciasAplican
                                                                        .push(
                                                                            ID_Dependencia
                                                                        );
                                                                }
                                                            );

                                                        // Insertar en la tabla rel_autoridades_aplican
                                                        ID_DependenciasAplican
                                                            .forEach(
                                                                function (
                                                                    ID_Dependencia
                                                                ) {
                                                                    var relDataAplican = {
                                                                        ID_Aplican: ID_Dependencia,
                                                                        ID_Caract: maxID
                                                                    };

                                                                    $.ajax({
                                                                        url: '<?php echo base_url('RegulacionController/insertarRelAutoridadesAplican'); ?>',
                                                                        type: 'POST',
                                                                        data: relDataAplican,
                                                                        success: function (
                                                                            relResponse
                                                                        ) {
                                                                            var relResult =
                                                                                JSON
                                                                                    .parse(
                                                                                        relResponse
                                                                                    );
                                                                            if (relResult
                                                                                .status ===
                                                                                'success'
                                                                            ) {
                                                                                console
                                                                                    .log(
                                                                                        'Relación Aplican insertada correctamente'
                                                                                    );
                                                                            } else {
                                                                                console
                                                                                    .log(
                                                                                        'Error al insertar la relación'
                                                                                    );
                                                                            }
                                                                        }
                                                                    });
                                                                }
                                                            );

                                                        // Lógica de insertarDatosTabla directamente aquí
                                                        var
                                                            datosTabla = [];
                                                        $('#resultTable tbody tr')
                                                            .each(
                                                                function () {
                                                                    var ID_Indice =
                                                                        $(
                                                                            this
                                                                        )
                                                                            .find(
                                                                                'td'
                                                                            )
                                                                            .eq(
                                                                                0
                                                                            )
                                                                            .text();
                                                                    var Texto =
                                                                        $(
                                                                            this
                                                                        )
                                                                            .find(
                                                                                'td'
                                                                            )
                                                                            .eq(
                                                                                1
                                                                            )
                                                                            .text();
                                                                    var Orden =
                                                                        $(
                                                                            this
                                                                        )
                                                                            .find(
                                                                                'td'
                                                                            )
                                                                            .eq(
                                                                                2
                                                                            )
                                                                            .text();

                                                                    var filaDatos = {
                                                                        ID_Indice: ID_Indice,
                                                                        ID_caract: maxID,
                                                                        Texto: Texto,
                                                                        Orden: Orden
                                                                    };

                                                                    datosTabla
                                                                        .push(
                                                                            filaDatos
                                                                        );
                                                                }
                                                            );

                                                        // Imprimir datosTabla en consola
                                                        console
                                                            .log(
                                                                datosTabla
                                                            );

                                                        var registros = [];
                                                        $('#materiasTable tbody tr').each(function () {
                                                            var idMatSec = $(this).find('td').eq(0).text();
                                                            var materias = $(this).find('td').eq(1).text();
                                                            var sectores = $(this).find('td').eq(2).text();
                                                            var sujetosRegulados = $(this).find('td').eq(3).text();

                                                            registros.push({
                                                                ID_MatSec: idMatSec,
                                                                Materias: materias,
                                                                Sectores: sectores,
                                                                SujetosRegulados: sujetosRegulados
                                                            });
                                                        });

                                                        $.ajax({
                                                            url: '<?php echo base_url('RegulacionController/guardarRegistros'); ?>', // Cambia esta URL a la ruta de tu controlador
                                                            type: 'POST',
                                                            data: {
                                                                registros: registros
                                                            },
                                                            success: function (response) {
                                                                console.log('Materias Registros guardados exitosamente.');
                                                            },
                                                            error: function () {
                                                                console.log('Error al guardar los registros Materias.');
                                                            }
                                                        });

                                                        var fundamentos = [];
                                                        $('#fundamentoTable tbody tr').each(function () {
                                                            var ID_Fun = $(this).find('td').eq(0).text();
                                                            var Nombre = $(this).find('td').eq(1).text();
                                                            var Articulo = $(this).find('td').eq(2).text();
                                                            var Link = $(this).find('td').eq(3).text();

                                                            fundamentos.push({
                                                                ID_Fun: ID_Fun,
                                                                Nombre: Nombre,
                                                                Articulo: Articulo,
                                                                Link: Link
                                                            });
                                                        });

                                                        $.ajax({
                                                            url: '<?php echo base_url('RegulacionController/InsertarFundamentos'); ?>', // Cambia esta URL a la ruta de tu controlador
                                                            type: 'POST',
                                                            data: {
                                                                fundamentos: fundamentos
                                                            },
                                                            success: function (response) {
                                                                console.log('Fundamentoa Registros guardados exitosamente.');
                                                            },
                                                            error: function () {
                                                                console.log('Error al guardar los registros fundamentos');
                                                            }
                                                        });

                                                        // Insertar los datos en la base de datos
                                                        $.ajax({
                                                            url: '<?php echo base_url('RegulacionController/insertarDatosTabla'); ?>',
                                                            type: 'POST',
                                                            data: {
                                                                datosTabla: datosTabla
                                                            },
                                                            success: function (
                                                                response
                                                            ) {
                                                                var result =
                                                                    JSON
                                                                        .parse(
                                                                            response
                                                                        );
                                                                if (result
                                                                    .status ===
                                                                    'success'
                                                                ) {

                                                                    console
                                                                        .log(
                                                                            'Datos de la tabla insertados correctamente'
                                                                        );
                                                                } else {
                                                                    console
                                                                        .log(
                                                                            'Error al insertar los datos de la tabla'
                                                                        );
                                                                }
                                                            }
                                                        });

                                                        // Obtener el nuevo ID_Jerarquia
                                                        $.ajax({
                                                            url: '<?= base_url("RegulacionController/obtenerNuevoIdJerarquia") ?>',
                                                            type: 'GET',
                                                            success: function (
                                                                response
                                                            ) {
                                                                var result =
                                                                    JSON
                                                                        .parse(
                                                                            response
                                                                        );
                                                                if (result
                                                                    .status ===
                                                                    'success'
                                                                ) {
                                                                    var nuevoIdJerarquia =
                                                                        result
                                                                            .nuevoIdJerarquia;
                                                                    console
                                                                        .log(
                                                                            'Nuevo ID_Jerarquia:',
                                                                            nuevoIdJerarquia
                                                                        ); // Verificar el nuevo ID_Jerarquia

                                                                    // Insertar datos en la tabla rel_indice
                                                                    var
                                                                        relIndiceData = [];
                                                                    $('#resultTable tbody tr')
                                                                        .each(
                                                                            function (
                                                                                index
                                                                            ) {
                                                                                var ID_Indice =
                                                                                    $(
                                                                                        this
                                                                                    )
                                                                                        .find(
                                                                                            'td'
                                                                                        )
                                                                                        .eq(
                                                                                            0
                                                                                        )
                                                                                        .text()
                                                                                        .trim();
                                                                                console
                                                                                    .log(
                                                                                        'ID_Indice:',
                                                                                        ID_Indice
                                                                                    ); // Verificar que ID_Indice se obtenga correctamente

                                                                                var ID_Jerarquia =
                                                                                    nuevoIdJerarquia +
                                                                                    index; // Incrementar el ID_Jerarquia para cada fila
                                                                                if ($('#selectIndicePadre').val() == 'Seleccione un índice padre' || $('#selectIndicePadre').val() == '') {
                                                                                    var ID_Padre = null;
                                                                                } else {
                                                                                    var ID_Padre =
                                                                                        $(
                                                                                            '#selectIndicePadre'
                                                                                        )
                                                                                            .val();
                                                                                }

                                                                                console
                                                                                    .log(
                                                                                        'ID_Jerarquia:',
                                                                                        ID_Jerarquia
                                                                                    ); // Verificar que ID_Jerarquia se obtenga correctamente
                                                                                console
                                                                                    .log(
                                                                                        'ID_Padre:',
                                                                                        ID_Padre
                                                                                    ); // Verificar que ID_Padre se obtenga correctamente

                                                                                if (
                                                                                    ID_Padre
                                                                                ) {
                                                                                    var filaRelIndice = {
                                                                                        ID_Jerarquia: ID_Jerarquia,
                                                                                        ID_Indice: ID_Indice,
                                                                                        ID_Padre: ID_Padre
                                                                                    };

                                                                                    relIndiceData
                                                                                        .push(
                                                                                            filaRelIndice
                                                                                        );
                                                                                }
                                                                            }
                                                                        );

                                                                    console
                                                                        .log(
                                                                            'relIndiceData:',
                                                                            relIndiceData
                                                                        ); // Verificar el contenido final de relIndiceData

                                                                    // Insertar los datos en la base de datos
                                                                    $.ajax({
                                                                        url: '<?php echo base_url('RegulacionController/insertarRelIndice'); ?>',
                                                                        type: 'POST',
                                                                        data: {
                                                                            relIndiceData: relIndiceData
                                                                        },
                                                                        success: function (
                                                                            response
                                                                        ) {
                                                                            var result =
                                                                                JSON
                                                                                    .parse(
                                                                                        response
                                                                                    );
                                                                            if (result
                                                                                .status ===
                                                                                'success'
                                                                            ) {
                                                                                console
                                                                                    .log(
                                                                                        'Datos de rel_indice insertados correctamente'
                                                                                    );
                                                                                //Redirigir a la página especificada
                                                                                window
                                                                                    .location
                                                                                    .href =
                                                                                    '<?php echo base_url('RegulacionController/mat_exentas'); ?>';
                                                                            } else {
                                                                                console
                                                                                    .log(
                                                                                        'Error al insertar los datos de rel_indice'
                                                                                    );
                                                                                //Redirigir a la página especificada
                                                                                window
                                                                                    .location
                                                                                    .href =
                                                                                    '<?php echo base_url('RegulacionController/mat_exentas'); ?>';
                                                                            }
                                                                        }
                                                                    });
                                                                } else {
                                                                    console.log
                                                                        ('Error al obtener el nuevo ID_Jerarquia: ' +
                                                                            result
                                                                                .message
                                                                        );
                                                                }
                                                            },
                                                            error: function () {
                                                                console.log
                                                                    (
                                                                        'Error en la solicitud AJAX para obtener el nuevo ID_Jerarquia.'
                                                                    );
                                                            }
                                                        });
                                                    } else {
                                                        console.log
                                                            (
                                                                'Error al insertar las características'
                                                            );
                                                    }
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        } else {
                            console.log('Error al insertar los datos');
                        }
                    }
                });
            }
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
        $('.btn-indice').click(function () {
            $('#myModal').modal('show');
        });
    });
</script>
<script>
    $(document).ready(function () {
        var lastInsertedID_Indice =
            null; // Variable para almacenar el último ID_Indice insertado
        var lastInsertedOrden =
            null; // Variable para almacenar el último Orden insertado

        $('#guardarIbtn').on('click', function () {
            var inputTexto = $('#inputTexto').val();

            $.ajax({
                url: '<?= base_url('RegulacionController/getMaxValues') ?>',
                method: 'GET',
                success: function (data) {
                    var maxValues = JSON.parse(data);

                    if (maxValues.ID_Indice == null || maxValues.Orden == null) {
                        lastInsertedID_Indice = 1;
                        lastInsertedOrden = 1;
                        // Verificar si la tabla con id resultTable no está vacía
                        if ($('#resultTable tbody tr').length > 0) {
                            lastInsertedID_Indice = $('#resultTable tbody tr').length + 1;
                            lastInsertedOrden = $('#resultTable tbody tr').length + 1;
                        }
                    } else {
                        lastInsertedID_Indice = parseInt(maxValues.ID_Indice) + 1;
                        lastInsertedOrden = parseInt(maxValues.Orden) + 1;
                        // Verificar si la tabla con id resultTable no está vacía
                        if ($('#resultTable tbody tr').length > 0) {
                            lastInsertedID_Indice = parseInt(maxValues.ID_Indice) + $(
                                '#resultTable tbody tr').length + 1;
                            lastInsertedOrden = parseInt(maxValues.Orden) + $(
                                '#resultTable tbody tr').length + 1;
                        }
                    }

                    var newRow = '<tr><td>' + lastInsertedID_Indice + '</td><td>' + inputTexto +
                        '</td><td>' + lastInsertedOrden + '</td>' +
                        '<td><button class="btn btn-danger btn-sm delete-row">' +
                        '<i class="fas fa-trash-alt"></i></button></td>' +
                        '</tr>';
                    $('#resultTable tbody').append(newRow);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Manejar el evento de clic en el botón de eliminar
        $('#resultTable').on('click', '.delete-row', function () {
            var row = $(this).closest('tr');
            var rowIndex = row.index();
            var table = $('#resultTable tbody');

            // Eliminar la fila seleccionada
            row.remove();

            // Reducir "ID_Indice" y "Orden" de las filas siguientes
            table.find('tr').each(function (index) {
                if (index >= rowIndex) {
                    var idIndiceCell = $(this).find('td').eq(0);
                    var ordenCell = $(this).find('td').eq(2);

                    var newIdIndice = parseInt(idIndiceCell.text()) - 1;
                    var newOrden = parseInt(ordenCell.text()) - 1;

                    idIndiceCell.text(newIdIndice);
                    ordenCell.text(newOrden);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        var reIndice = [];
        var currentIDJerarquia = 0;

        // Obtener el valor máximo de ID_Jerarquia al cargar la página
        $.ajax({
            url: '<?php echo base_url('RegulacionController/obtenerMaxIDJerarquia'); ?>',
            type: 'GET',
            success: function (response) {
                currentIDJerarquia = parseInt(response);
            }
        });

        $('#guardarIbtn').on('click', function () {
            var selectedIDIndice = $('#selectIndicePadre')
                .val();

            if (selectedIDIndice !==
                'Seleccione un índice padre') {
                currentIDJerarquia += 1;

                var newEntry = {
                    ID_Indice: selectedIDIndice,
                    ID_Jerarquia: currentIDJerarquia
                };

                reIndice.push(newEntry);

                // Imprimir reIndice en consola
                console.log(reIndice);
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Obtener el valor seleccionado en el select con id "selectIndicePadre"
        $('#selectIndicePadre').on('change', function () {
            var selectedValue = $(this).val();
            console.log('Valor seleccionado:',
                selectedValue); // Imprimir el valor seleccionado en la consola
        });
    });
</script>
@endsection