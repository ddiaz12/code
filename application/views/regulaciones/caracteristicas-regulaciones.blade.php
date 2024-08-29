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
                <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i
                            class="fas fa-home me-1"></i>Home</a>
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
                            <!-- Existing card -->
                            <div class="card flex-grow-1">
                                <div class="card">
                                    <div class="card-header text-white">Agregar Regulacion</div>
                                    <div class="card-body">

                                        <!-- Formulario de agregar regulaciones -->
                                        <form class="row g-3" id="form-regulacion">
                                            <div class="form-group">
                                                <label for="inputNombre">Nombre<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputNombre" name="nombre"
                                                    placeholder="Nombre de la regulacion" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="selectSujeto">Ambito de Aplicacion<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="selectSujeto" name="sujeto" required>
                                                    <option disabled selected>Selecciona una opción</option>
                                                    <option value="Estatal">Estatal</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="selectUnidad">Tipo de ordenamiento jurídico<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="selectUnidad" name="unidad" required>
                                                    <option disabled selected>Selecciona una opción</option>
                                                    <?php foreach ($tipos_ordenamiento as $tipo): ?>
                                                    <option value="<?php    echo $tipo->ID_tOrdJur;?>">
                                                        <?php    echo $tipo->Tipo_Ordenamiento;?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFecha">Fecha de Expedición de la regulación<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="inputFecha"
                                                    name="fecha_expedicion" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFecha">Fecha de publicación de la regulación<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="inputFecha"
                                                    name="fecha_publicacion" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFecha">Fecha de Vigor<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="inputFecha"
                                                    name="fecha_vigor" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFecha">Fecha de última actualización<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="inputFecha" name="fecha_act"
                                                    required>
                                            </div>

                                            <form>
                                                <div class="d-flex justify-content-between mb-3">
                                                    <div id="selectVigencia">
                                                        <p>¿La regulación tiene vigencia definida?</p>
                                                        <div class="d-flex justify-content-start mb-3">
                                                            <label>
                                                                <input type="radio" name="opcion" id="si"
                                                                    onclick="mostrarCampo()"> Sí
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="opcion" id="no"
                                                                    onclick="mostrarCampo()"> No
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" id="otroCampo" style="display:none;">
                                                        <label for="campoExtra">Vigencia de la regulación</label>
                                                        <input type="date" class="form-control" id="campoExtra"
                                                            name="campoExtra" required>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="form-group">
                                                <label for="inputVialidad">Orden de gobierno que la emite:<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="selectUnidad" name="orden" required>
                                                    <option disabled selected>Selecciona una opción</option>
                                                    <option value="Estatal">Colima</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="AutoridadesEmiten">Autoridades que emiten la
                                                        regulación<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="AutoridadesEmiten"
                                                        name="aut_emiten" required>
                                                    <div id="searchResults" class="list-group"></div>
                                                </div>
                                            </div>
                                            <h5>Autoridades que emiten la regulación</h5>
                                            <table id="emitenTable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID_Dependencia</th>
                                                        <th>Tipo_Dependencia</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Las filas se agregarán dinámicamente aquí -->
                                                </tbody>
                                            </table>

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
                                                            <label>
                                                                <input type="radio" name="opcion" id="apno"
                                                                    onclick="mostrarCampo2()"> No
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row col-md-12" id="opcAplican">
                                                    <div class="col-md-6" id="selectUnidad2Container">
                                                        <div class="form-group">
                                                            <label for="selectUnidad2">Orden de gobierno que la
                                                                emite:<span class="text-danger">*</span></label>
                                                            <select class="form-control" id="selectUnidad2"
                                                                name="selectUnidad2" required>
                                                                <option disabled selected>Selecciona una opción
                                                                </option>
                                                                <option value="Estatal">Colima</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" id="AutoridadesAplicanContainer">
                                                        <div class="form-group">
                                                            <label for="AutoridadesAplican">Autoridades que aplican
                                                                la regulación<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="AutoridadesAplican" name="AutoridadesAplican"
                                                                required>
                                                            <div id="searchResults2" class="list-group"></div>
                                                        </div>
                                                    </div>

                                                    <div id="apTContainer">
                                                        <h5>Autoridades que aplican la regulación</h5>
                                                        <table id="aplicanTable" class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID_Dependencia</th>
                                                                    <th>Tipo_Dependencia</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Las filas se agregarán dinámicamente aquí -->
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </form>

                                            <div class="d-flex justify-content-between mb-3">
                                                <p>Índice de regulación</p>
                                                <button type="submit" id="botonIndice"
                                                    class="btn btn-success btn-indice">Indice</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel">Índice
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <div class="form-group">
                                                                        <label for="inputTexto">Texto</label>
                                                                        <input type="text" class="form-control"
                                                                            id="inputTexto" placeholder="Ingrese texto"
                                                                            name="texto">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="selectIndicePadre">Índice
                                                                            Padre</label>
                                                                        <select class="form-control"
                                                                            id="selectIndicePadre" name="indicePadre">
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
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal"
                                                                    onclick="closeModal()">Cerrar</button>
                                                                <button type="button" id="guardarIbtn"
                                                                    class="btn btn-primary">Guardar
                                                                    cambios</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table id="resultTable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID_Indice</th>
                                                        <th>Texto</th>
                                                        <th>Orden</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Las filas se agregarán dinámicamente aquí -->
                                                </tbody>
                                            </table>

                                            <div class="form-group">
                                                <label for="inputObjetivo">Describa el objetivo de la regulación</label>
                                                <textarea class="form-control" id="inputObjetivo"
                                                    name="objetivoReg"></textarea>
                                            </div>
                                            <p></p>
                                            <div class="d-flex justify-content-end mb-3">
                                                <button type="button" class="btn btn-success btn-guardar"
                                                    id="botonGuardar">Guardar</button>
                                                <a href="<?php echo base_url('oficinas/oficina'); ?>"
                                                    class="btn btn-secondary me-2">Cancelar</a>
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

        if (siSeleccionado) {
            otroCampo.style.display = "block";
        } else {
            otroCampo.style.display = "none";
        }
    }
</script>
<script>
    function mostrarCampo2() {
        var si = document.getElementById('apsi');
        var no = document.getElementById('apno');
        var selectUnidad2Container = document.getElementById('selectUnidad2Container');
        var autoridadesAplicanContainer = document.getElementById('AutoridadesAplicanContainer');
        var apTContainer = document.getElementById('apTContainer');

        if (no.checked) {
            selectUnidad2Container.style.display = 'block';
            autoridadesAplicanContainer.style.display = 'block';
            apTContainer.style.display = 'block';
        } else if (si.checked) {
            selectUnidad2Container.style.display = 'none';
            autoridadesAplicanContainer.style.display = 'none';
            apTContainer.style.display = 'none';
        } else {
            selectUnidad2Container.style.display = 'none';
            autoridadesAplicanContainer.style.display = 'none';
            apTContainer.style.display = 'none';
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
                tableBody.append('<tr><td>' + item.ID_Dependencia + '</td><td>' + item.Tipo_Dependencia +
                    '</td></tr>');
            });
        }

        function updateAplicanTable() {
            var tableBody = $('#aplicanTable tbody');
            tableBody.empty();

            aplicanArray.forEach(function (item) {
                tableBody.append('<tr><td>' + item.ID_Dependencia + '</td><td>' + item.Tipo_Dependencia +
                    '</td></tr>');
            });
        }
    });
</script>
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

            $.ajax({
                url: '<?php echo base_url('RegulacionController/insertarRegulacion'); ?>',
                type: 'POST',
                data: formData,
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Datos insertados correctamente');
                        console.log('result', result);

                        // Obtener el ID_Regulacion devuelto en la respuesta
                        var ID_Regulacion = result.ID_Regulacion;
                        console.log('ID_Regulacion', ID_Regulacion);

                        $.ajax({
                            url: '<?php echo base_url('RegulacionController/obtenerMaxIDCaract'); ?>',
                            type: 'GET',
                            success: function (maxIDResponse) {
                                var maxID = parseInt(maxIDResponse) + 1;

                                $.ajax({
                                    url: '<?php echo base_url('RegulacionController/obtenerMaxIDRegulacion'); ?>',
                                    type: 'GET',
                                    success: function (maxIDRegResponse) {
                                        var maxIDReg = parseInt(maxIDRegResponse);

                                        // Asignar valores a la variable global caracteristicasData
                                        caracteristicasData = {
                                            ID_caract: maxID,
                                            ID_Regulacion: maxIDReg,
                                            ID_tOrdJur: formData.unidad,
                                            Nombre: formData.nombre,
                                            Ambito_Aplicacion: formData.sujeto,
                                            Fecha_Exp: formData.fecha_expedicion,
                                            Fecha_Publi: formData.fecha_publicacion,
                                            Fecha_Vigor: formData.fecha_vigor,
                                            Fecha_Act: formData.fecha_act,
                                            Vigencia: formData.campoExtra,
                                            Orden_Gob: formData.orden
                                        };

                                        // Imprimir caracteristicasData en consola
                                        console.log(caracteristicasData);

                                        $.ajax({
                                            url: '<?php echo base_url('RegulacionController/insertarCaracteristicas'); ?>',
                                            type: 'POST',
                                            data: caracteristicasData,
                                            success: function (caractResponse) {
                                                var caractResult = JSON.parse(caractResponse);
                                                if (caractResult.status === 'success') {
                                                    alert('Características insertadas correctamente');

                                                    // Obtener todos los ID_Dependencia de la tabla emitenTable
                                                    var ID_DependenciasEmiten = [];
                                                    $('#emitenTable tbody tr').each(function () {
                                                        var ID_Dependencia = $(this).find('td').eq(0).text();
                                                        ID_DependenciasEmiten.push(ID_Dependencia);
                                                    });

                                                    // Insertar en la tabla rel_autoridades_emiten
                                                    ID_DependenciasEmiten.forEach(function (ID_Dependencia) {
                                                        var relDataEmiten = {
                                                            ID_Emiten: ID_Dependencia,
                                                            ID_Caract: caracteristicasData.ID_caract
                                                        };

                                                        $.ajax({
                                                            url: '<?php echo base_url('RegulacionController/insertarRelAutoridadesEmiten'); ?>',
                                                            type: 'POST',
                                                            data: relDataEmiten,
                                                            success: function (relResponse) {
                                                                var relResult = JSON.parse(relResponse);
                                                                if (relResult.status === 'success') {
                                                                    console.log('Relación Emiten insertada correctamente');
                                                                } else {
                                                                    console.log('Error al insertar la relación');
                                                                }
                                                            }
                                                        });
                                                    });

                                                    // Obtener todos los ID_Dependencia de la tabla aplicanTable
                                                    var ID_DependenciasAplican = [];
                                                    $('#aplicanTable tbody tr').each(function () {
                                                        var ID_Dependencia = $(this).find('td').eq(0).text();
                                                        ID_DependenciasAplican.push(ID_Dependencia);
                                                    });

                                                    // Insertar en la tabla rel_autoridades_aplican
                                                    ID_DependenciasAplican.forEach(function (ID_Dependencia) {
                                                        var relDataAplican = {
                                                            ID_Aplican: ID_Dependencia,
                                                            ID_Caract: caracteristicasData.ID_caract
                                                        };

                                                        $.ajax({
                                                            url: '<?php echo base_url('RegulacionController/insertarRelAutoridadesAplican'); ?>',
                                                            type: 'POST',
                                                            data: relDataAplican,
                                                            success: function (relResponse) {
                                                                var relResult = JSON.parse(relResponse);
                                                                if (relResult.status === 'success') {
                                                                    console.log('Relación Aplican insertada correctamente');
                                                                } else {
                                                                    console.log('Error al insertar la relación');
                                                                }
                                                            }
                                                        });
                                                    });

                                                    // Lógica de insertarDatosTabla directamente aquí
                                                    var datosTabla = [];
                                                    $('#resultTable tbody tr').each(function () {
                                                        var ID_Indice = $(this).find('td').eq(0).text();
                                                        var Texto = $(this).find('td').eq(1).text();
                                                        var Orden = $(this).find('td').eq(2).text();

                                                        var filaDatos = {
                                                            ID_Indice: ID_Indice,
                                                            ID_caract: caracteristicasData.ID_caract,
                                                            Texto: Texto,
                                                            Orden: Orden
                                                        };

                                                        datosTabla.push(filaDatos);
                                                    });

                                                    // Imprimir datosTabla en consola
                                                    console.log(datosTabla);

                                                    // Insertar los datos en la base de datos
                                                    $.ajax({
                                                        url: '<?php echo base_url('RegulacionController/insertarDatosTabla'); ?>',
                                                        type: 'POST',
                                                        data: { datosTabla: datosTabla },
                                                        success: function (response) {
                                                            var result = JSON.parse(response);
                                                            if (result.status === 'success') {
                                                                alert('Datos de la tabla insertados correctamente');
                                                            } else {
                                                                alert('Error al insertar los datos de la tabla');
                                                            }
                                                        }
                                                    });

                                                    // Insertar datos en la tabla rel_indice
                                                    var relIndiceData = [];
                                                    $('#resultTable tbody tr').each(function (index) {
                                                        var ID_Indice = $(this).find('td').eq(0).text();
                                                        var ID_Jerarquia = reIndice[index] ? reIndice[index].ID_Jerarquia : null;
                                                        var ID_Padre = reIndice[index] ? reIndice[index].ID_Indice : null;

                                                        if (ID_Jerarquia && ID_Padre) {
                                                            var filaRelIndice = {
                                                                ID_Jerarquia: ID_Jerarquia,
                                                                ID_Indice: ID_Indice,
                                                                ID_Padre: ID_Padre
                                                            };

                                                            relIndiceData.push(filaRelIndice);
                                                        }
                                                    });

                                                    // Imprimir relIndiceData en consola
                                                    console.log(relIndiceData);

                                                    // Insertar los datos en la base de datos
                                                    $.ajax({
                                                        url: '<?php echo base_url('RegulacionController/insertarRelIndice'); ?>',
                                                        type: 'POST',
                                                        data: { relIndiceData: relIndiceData },
                                                        success: function (response) {
                                                            var result = JSON.parse(response);
                                                            if (result.status === 'success') {
                                                                alert('Datos de rel_indice insertados correctamente');
                                                            } else {
                                                                alert('Error al insertar los datos de rel_indice');
                                                            }
                                                        }
                                                    });

                                                } else {
                                                    alert('Error al insertar las características');
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    } else {
                        alert('Error al insertar los datos');
                    }
                }
            });
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

            if (lastInsertedID_Indice === null ||
                lastInsertedOrden === null) {
                // Si es la primera inserción, obtener los valores de la base de datos
                $.ajax({
                    url: '<?= base_url('RegulacionController/getMaxValues') ?>',
                    method: 'GET',
                    success: function (data) {
                        var maxValues = JSON.parse(
                            data);
                        lastInsertedID_Indice =
                            parseInt(maxValues
                                .ID_Indice) + 1;
                        lastInsertedOrden =
                            parseInt(maxValues
                                .Orden) + 1;

                        var newRow = '<tr><td>' +
                            lastInsertedID_Indice +
                            '</td><td>' +
                            inputTexto +
                            '</td><td>' +
                            lastInsertedOrden +
                            '</td></tr>';
                        $('#resultTable tbody')
                            .append(newRow);
                    },
                    error: function (jqXHR, textStatus,
                        errorThrown) {
                        console.error('AJAX error:',
                            textStatus,
                            errorThrown);
                    }
                });
            } else {
                // Si no es la primera inserción, incrementar los últimos valores insertados
                lastInsertedID_Indice++;
                lastInsertedOrden++;

                var newRow = '<tr><td>' +
                    lastInsertedID_Indice + '</td><td>' +
                    inputTexto + '</td><td>' +
                    lastInsertedOrden + '</td></tr>';
                $('#resultTable tbody').append(newRow);
            }
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
            } else {
                alert('Por favor, seleccione un índice padre.');
            }
        });
    });
</script>
@endsection