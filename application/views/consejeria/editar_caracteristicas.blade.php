@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones
@endsection
@section('navbar')
@include('templates/navbarConsejeria')
@endsection
@section('menu')
@include('templates/menuConsejeria')
@endsection

@section('contenido')
<ol class="breadcrumb mb-4 mt-5">
    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
    </li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('RegulacionController'); ?>"><i
                class="fas fa-file-alt me-1"></i>Regulaciones</a>
    </li>
    <li class="breadcrumb-item active"><i class="fa-solid fa-plus-circle"></i>Editar regulacion
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
                                    <a href="<?php echo base_url('RegulacionController/edit_caract/' . $regulacion['ID_Regulacion']); ?>"
                                        class="custom-link">
                                        <i class="fa-solid fa-list-check fa-sm"></i>
                                        <label class="menu-regulacion" for="image_1">Características de la
                                            Regulación</label>
                                    </a>
                                </li>
                                <p></p>
                                <li class="iconos-regulacion">
                                    <a href="<?php echo base_url('RegulacionController/edit_mat/' . $regulacion['ID_Regulacion']); ?>"
                                        class="custom-link">
                                        <i class="fa-solid fa-table-list fa-sm"></i>
                                        <label class="menu-regulacion" for="image_2">Materias Exentas</label>
                                    </a>
                                </li>
                                <p></p>
                                <li class="iconos-regulacion">
                                    <a href="<?php echo base_url('RegulacionController/edit_nat/' . $regulacion['ID_Regulacion']); ?>"
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
                <!-- Existing card -->
                <div class="card flex-grow-1">
                    <div class="card">
                        <div class="card-header text-white">Editar Regulación</div>
                        <div class="card-body">

                            <!-- Formulario de agregar regulaciones -->
                            <form class="row g-3" id="form-regulacion">
                                <div class="form-group">
                                    <label for="inputNombre">Nombre<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputNombre" name="nombre"
                                        value="<?php echo $regulacion['Nombre_Regulacion']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="selectSujeto">Ámbito de aplicación<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="selectSujeto" name="sujeto" required>
                                        <option disabled selected><?php echo $caracteristicas['Ambito_Aplicacion']; ?>
                                        </option>
                                        <option value="Estatal">Estatal</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="selectUnidad">Tipo de ordenamiento jurídico<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="selectUnidad" name="unidad" required>
                                        <option
                                            value="<?php echo isset($tipo_ordenamiento_guardado['ID_tOrdJur']) ? $tipo_ordenamiento_guardado['ID_tOrdJur'] : ''; ?>"
                                            disabled selected>
                                            <?php echo isset($tipo_ordenamiento_guardado['Tipo_Ordenamiento']) ? $tipo_ordenamiento_guardado['Tipo_Ordenamiento'] : 'Selecciona una opción'; ?>
                                        </option>
                                        <?php foreach ($tipos_ordenamiento as $tipo): ?>
                                        <option value="<?php    echo $tipo->ID_tOrdJur;?>">
                                            <?php    echo $tipo->Tipo_Ordenamiento;?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Fecha_Exp">Fecha de Expedición de la regulación<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="Fecha_Exp" name="fecha_expedicion"
                                        value="<?php echo isset($caracteristicas['Fecha_Exp']) ? date('Y-m-d', strtotime($caracteristicas['Fecha_Exp'])) : ''; ?>"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Fecha_Publi">Fecha de publicación de la regulación<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="Fecha_Publi" name="fecha_publicacion"
                                        value="<?php echo isset($caracteristicas['Fecha_Publi']) ? date('Y-m-d', strtotime($caracteristicas['Fecha_Publi'])) : ''; ?>"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Fecha_Vigor">Fecha de entrada en vigor<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="Fecha_Vigor" name="fecha_vigor"
                                        value="<?php echo isset($caracteristicas['Fecha_Vigor']) ? date('Y-m-d', strtotime($caracteristicas['Fecha_Vigor'])) : ''; ?>"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Fecha_Act">Fecha de última actualización<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="Fecha_Act" name="fecha_act"
                                        value="<?php echo isset($caracteristicas['Fecha_Act']) ? date('Y-m-d', strtotime($caracteristicas['Fecha_Act'])) : ''; ?>"
                                        required>
                                </div>

                                <form>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div id="selectVigencia">
                                            <p>¿La regulación tiene vigencia definida?</p>
                                            <div class="d-flex justify-content-start mb-3">
                                                <label>
                                                    <input type="radio" name="opcion" id="si" onclick="mostrarCampo()"
                                                        <?php echo ($regulacion['Vigencia'] != '0000-00-00') ? 'checked' : ''; ?>>
                                                    Sí
                                                </label>
                                                <label class="ms-2">
                                                    <input type="radio" name="opcion" id="no" onclick="mostrarCampo()"
                                                        <?php echo ($regulacion['Vigencia'] == '0000-00-00') ? 'checked' : ''; ?>>
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="otroCampo"
                                            style="display: <?php echo ($regulacion['Vigencia'] != '0000-00-00') ? 'block' : 'none'; ?>;">
                                            <label for="campoExtra">Vigencia de la regulación</label>
                                            <input type="date" class="form-control" id="campoExtra" name="campoExtra"
                                                value="<?php echo ($regulacion['Vigencia'] != '0000-00-00') ? $regulacion['Vigencia'] : ''; ?>"
                                                required>
                                        </div>
                                    </div>
                                </form>

                                <div class="form-group">
                                    <label for="inputVialidad">Orden de gobierno que la emite:<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="selectUnidad" name="orden" required>
                                        <option disabled selected><?php echo $caracteristicas['Orden_Gob']; ?>
                                        <option value="Estatal">Colima</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="AutoridadesEmiten">Autoridades que emiten la
                                            regulación<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="AutoridadesEmiten" name="aut_emiten"
                                            required>
                                        <div id="searchResults" class="list-group"></div>
                                    </div>
                                </div>
                                <table id="emitenTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID_Dependencia</th>
                                            <th>Tipo_Dependencia</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dependencias as $dependencia): ?>

                                        <td><?php    echo $dependencia['ID_Dependencia']; ?></td>
                                        <td><?php    echo $dependencia['Tipo_Dependencia']; ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm delete-row">
                                                <i class="fas fa-trash-alt"></i></button>
                                        </td>
                                        </tr>
                                        <?php endforeach; ?>
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
                                                <label class="ms-2">
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
                                                <select class="form-control" id="selectUnidad2" name="selectUnidad2"
                                                    required>
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
                                                <input type="text" class="form-control" id="AutoridadesAplican"
                                                    name="AutoridadesAplican" required>
                                                <div id="searchResults2" class="list-group"></div>
                                            </div>
                                        </div>
                                        <div id="apTContainer">
                                            <table id="aplicanTable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID_Dependencia</th>
                                                        <th>Tipo_Dependencia</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (is_array($dependenciasAp)): ?>
                                                    <?php    foreach ($dependenciasAp as $dependenciaAp): ?>
                                                    <?php        if (is_array($dependenciaAp) && isset($dependenciaAp['ID_Dependencia']) && isset($dependenciaAp['Tipo_Dependencia'])): ?>
                                                    <tr>
                                                        <td><?php            echo $dependenciaAp['ID_Dependencia']; ?>
                                                        </td>
                                                        <td><?php            echo $dependenciaAp['Tipo_Dependencia']; ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm delete-row">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php        else: ?>
                                                    <tr>
                                                        <td colspan="3">Datos de dependencia no válidos</td>
                                                    </tr>
                                                    <?php        endif; ?>
                                                    <?php    endforeach; ?>
                                                    <?php else: ?>
                                                    <tr>
                                                        <td colspan="3">No hay dependencias disponibles</td>
                                                    </tr>
                                                    <?php endif; ?>
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
                                <table id="resultTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID_Indice</th>
                                            <th>Texto</th>
                                            <th>Orden</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <script>
                                            $(document).ready(function () {
                                                // Obtener los datos del formulario
                                                var formData = {
                                                    ID_caract: <?= json_encode($caracteristicas['ID_caract']) ?>,
                                                };

                                                // Función para obtener los índices y actualizar la tabla
                                                function obtenerIndicesYActualizarTabla() {
                                                    $.ajax({
                                                        url: '<?= base_url("RegulacionController/get_indices_by_caract_ajax") ?>',
                                                        type: 'POST',
                                                        data: {
                                                            ID_caract: formData.ID_caract
                                                        },
                                                        dataType: 'json',
                                                        success: function (response) {
                                                            var tbody = $('#resultTable tbody');
                                                            tbody
                                                                .empty(); // Limpiar el contenido existente

                                                            if (response.length > 0) {
                                                                response.forEach(function (row) {
                                                                    var tr = $('<tr>');
                                                                    tr.append($('<td>').text(row
                                                                        .ID_Indice));
                                                                    tr.append($('<td>').text(row
                                                                        .Texto));
                                                                    tr.append($('<td>').text(row
                                                                        .Orden));
                                                                    tr.append($('<td><button class="btn btn-danger btn-sm delete-row">' +
                                                                        '<i class="fas fa-trash-alt"></i></button>'
                                                                    ).text(row
                                                                        .Accion));

                                                                    tbody.append(tr);
                                                                });
                                                            } else { }
                                                        },
                                                        error: function () {
                                                            alert('Error al obtener los índices.');
                                                        }
                                                    });
                                                }

                                                // Llamar a la función para obtener los índices y actualizar la tabla
                                                obtenerIndicesYActualizarTabla();
                                            });
                                        </script>
                                    </tbody>
                                </table>

                                <script>
                                    $(document).ready(function () {
                                        // Array para almacenar los índices
                                        var indicesArray = <?= json_encode($indice) ?>;

                                        // Asegurarse de que indicesArray es un array
                                        if (!Array.isArray(indicesArray)) {
                                            indicesArray = [];
                                        }

                                        // Manejar el evento de clic en el botón de eliminar
                                        $('#resultTable').on('click', '.delete-row', function () {
                                            var row = $(this).closest('tr');
                                            var ID_Indice = row.find('td').eq(0).text()
                                                .trim(); // Ajusta el índice según la posición de ID_Indice en la fila
                                            var ID_caract =
                                                <?= json_encode($caracteristicas['ID_caract']) ?>;

                                            console.log('ID del índice a eliminar:', ID_Indice);
                                            console.log('ID de la característica:', ID_caract);
                                            console.log('Array antes de eliminar:', indicesArray);

                                            // Confirmar la eliminación
                                            if (confirm(
                                                '¿Estás seguro de que deseas eliminar este registro?'
                                            )) {
                                                // Buscar el valor de ID_Indice en la tabla rel_indice
                                                $.ajax({
                                                    url: '<?= base_url("RegulacionController/buscarIndiceEnRelIndice") ?>',
                                                    type: 'POST',
                                                    data: {
                                                        ID_Indice: ID_Indice
                                                    },
                                                    dataType: 'json',
                                                    success: function (response) {
                                                        console.log(
                                                            'Resultados de la búsqueda en rel_indice:',
                                                            response);

                                                        // Si hay resultados, eliminar los registros en rel_indice
                                                        if (response.length > 0) {
                                                            $.ajax({
                                                                url: '<?= base_url("RegulacionController/eliminarEnRelIndice") ?>',
                                                                type: 'POST',
                                                                data: {
                                                                    ID_Indice: ID_Indice
                                                                },
                                                                success: function (
                                                                    deleteResponse
                                                                ) {
                                                                    console.log(
                                                                        'Registros eliminados en rel_indice:',
                                                                        deleteResponse
                                                                    );

                                                                    // Eliminar la fila de la tabla
                                                                    row.remove();

                                                                    // Eliminar el registro del array
                                                                    indicesArray =
                                                                        indicesArray
                                                                            .filter(
                                                                                function (
                                                                                    item
                                                                                ) {
                                                                                    return item
                                                                                        .ID_Indice !==
                                                                                        ID_Indice;
                                                                                });

                                                                    console.log(
                                                                        'Registro eliminado. Array actualizado:',
                                                                        indicesArray
                                                                    );

                                                                    // Enviar la solicitud AJAX para eliminar el registro de la base de datos
                                                                    $.ajax({
                                                                        url: '<?= base_url("RegulacionController/eliminarIndice") ?>',
                                                                        type: 'POST',
                                                                        data: {
                                                                            ID_caract: ID_caract,
                                                                            ID_Indice: ID_Indice
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
                                                                                alert
                                                                                    (
                                                                                        'Registro eliminado exitosamente de la base de datos.'
                                                                                    );
                                                                            } else {
                                                                                alert
                                                                                    ('Error al eliminar el registro de la base de datos: ' +
                                                                                        result
                                                                                            .message
                                                                                    );
                                                                            }
                                                                        },
                                                                        error: function () {
                                                                            alert
                                                                                (
                                                                                    'Error en la solicitud AJAX para eliminar el registro de la base de datos.'
                                                                                );
                                                                        }
                                                                    });
                                                                },
                                                                error: function () {
                                                                    alert(
                                                                        'Error en la solicitud AJAX para eliminar registros en rel_indice.'
                                                                    );
                                                                }
                                                            });
                                                        } else {
                                                            // Si no hay resultados en rel_indice, proceder con la eliminación normal
                                                            row.remove();

                                                            // Eliminar el registro del array
                                                            indicesArray = indicesArray.filter(
                                                                function (item) {
                                                                    return item
                                                                        .ID_Indice !==
                                                                        ID_Indice;
                                                                });

                                                            console.log(
                                                                'Registro eliminado. Array actualizado:',
                                                                indicesArray);

                                                            // Enviar la solicitud AJAX para eliminar el registro de la base de datos
                                                            $.ajax({
                                                                url: '<?= base_url("RegulacionController/eliminarIndice") ?>',
                                                                type: 'POST',
                                                                data: {
                                                                    ID_caract: ID_caract,
                                                                    ID_Indice: ID_Indice
                                                                },
                                                                success: function (
                                                                    response) {
                                                                    var result =
                                                                        JSON.parse(
                                                                            response
                                                                        );
                                                                    if (result
                                                                        .status ===
                                                                        'success') {
                                                                        alert(
                                                                            'Registro eliminado exitosamente de la base de datos.'
                                                                        );
                                                                    } else {
                                                                        alert('Error al eliminar el registro de la base de datos: ' +
                                                                            result
                                                                                .message
                                                                        );
                                                                    }
                                                                },
                                                                error: function () {
                                                                    alert(
                                                                        'Error en la solicitud AJAX para eliminar el registro de la base de datos.'
                                                                    );
                                                                }
                                                            });
                                                        }
                                                    },
                                                    error: function () {
                                                        alert(
                                                            'Error en la solicitud AJAX para buscar el índice en rel_indice.'
                                                        );
                                                    }
                                                });
                                            }
                                        });
                                    });
                                </script>

                                <div class="form-group">
                                    <label for="inputObjetivo">Objeto de la regulación</label>
                                    <textarea class="form-control" id="inputObjetivo"
                                        name="objetivoReg"><?php echo htmlspecialchars($regulacion['Objetivo_Reg'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>
                                <p></p>
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="<?php echo base_url('RegulacionController'); ?>"
                                        class="btn btn-secondary me-2">Cancelar</a>
                                    <button type="button" class="btn btn-success btn-guardar"
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
    var aplicanTable = document.getElementById('aplicanTable');

    // Verificar si la tabla no está vacía
    if (aplicanTable && aplicanTable.rows.length > 1) { // Asumiendo que la primera fila es el encabezado
        no.checked = true;
    }

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
        //tableBody.empty();

            emitenArray.forEach(function (item) {
                var row = '<tr data-id="' + item.ID_Dependencia + '">' +
                    '<td>' + item.ID_Dependencia + '</td>' +
                    '<td>' + item.Tipo_Dependencia + '</td>' +
                    '<td><button class="btn btn-danger btn-sm delete-row">' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>';
                tableBody.append(row);
            });
        }

    function updateAplicanTable() {
        var tableBody = $('#aplicanTable tbody');
        //tableBody.empty();

            aplicanArray.forEach(function (item) {
                var row = '<tr data-id="' + item.ID_Dependencia + '">' +
                    '<td>' + item.ID_Dependencia + '</td>' +
                    '<td>' + item.Tipo_Dependencia + '</td>' +
                    '<td><button class="btn btn-danger btn-sm delete-row">' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>';
                tableBody.append(row);
            });
        }

    // Manejar el evento de clic en el botón de eliminar
    $('#emitenTable').on('click', '.delete-row', function() {
        var row = $(this).closest('tr');
        var ID_Dependencia = row.find('td').eq(0).text()
            .trim(); // Ajusta el índice según la posición de ID_Dependencia en la fila
        var ID_caract = <?= json_encode($caracteristicas['ID_caract']) ?>;

            console.log('ID de la dependencia a eliminar:', ID_Dependencia);
            console.log('ID de la característica:', ID_caract);
            console.log('Array antes de eliminar:', emitenArray);

            // Confirmar la eliminación
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                // Eliminar la fila de la tabla
                row.remove();

                // Eliminar el registro del array
                emitenArray = emitenArray.filter(function (item) {
                    return item.ID_Dependencia !== ID_Dependencia;
                });

                console.log('Registro eliminado. Array actualizado:', emitenArray);

            // Enviar la solicitud AJAX para eliminar el registro de la base de datos
            $.ajax({
                url: '<?= base_url("RegulacionController/eliminarEmiten") ?>',
                type: 'POST',
                data: {
                    ID_caract: ID_caract,
                    ID_Dependencia: ID_Dependencia
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Registro eliminado exitosamente de la base de datos.');
                    } else {
                        alert('Error al eliminar el registro de la base de datos: ' + result
                            .message);
                    }
                },
                error: function() {
                    alert(
                        'Error en la solicitud AJAX para eliminar el registro de la base de datos.'
                    );
                }
            });
        }
    });

    // Manejar el evento de clic en el botón de eliminar para la tabla aplicanTable
    $('#aplicanTable').on('click', '.delete-row', function() {
        var row = $(this).closest('tr');
        var ID_Dependencia = row.find('td').eq(0).text()
            .trim(); // Obtener el ID_Dependencia de la primera celda
        var ID_caract = <?= json_encode($caracteristicas['ID_caract']) ?>;

            console.log('ID de la dependencia a eliminar:', ID_Dependencia);
            console.log('ID de la característica:', ID_caract);
            console.log('Array antes de eliminar:', aplicanArray);

            // Confirmar la eliminación
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                // Eliminar la fila de la tabla
                row.remove();

                // Eliminar el registro del array
                aplicanArray = aplicanArray.filter(function (item) {
                    return item.ID_Dependencia !== ID_Dependencia;
                });

                console.log('Registro eliminado. Array actualizado:', aplicanArray);

            // Enviar la solicitud AJAX para eliminar el registro de la base de datos
            $.ajax({
                url: '<?= base_url("RegulacionController/eliminarAplican") ?>',
                type: 'POST',
                data: {
                    ID_caract: ID_caract,
                    ID_Dependencia: ID_Dependencia
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Registro eliminado exitosamente de la base de datos.');
                    } else {
                        alert('Error al eliminar el registro de la base de datos: ' + result
                            .message);
                    }
                },
                error: function() {
                    alert(
                        'Error en la solicitud AJAX para eliminar el registro de la base de datos.'
                    );
                }
            });
        }
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#botonGuardar').on('click', function() {
        // Obtener el valor del select
        var ID_tOrdJur = $('#selectUnidad').val();

        // Si el valor es null o una cadena vacía, obtener el valor de la opción por defecto
        if (!ID_tOrdJur) {
            ID_tOrdJur = $('#selectUnidad option:selected').val();
        }

            // Obtener los datos del formulario
            var formData = {
                ID_Regulacion: <?= json_encode($regulacion['ID_Regulacion']) ?>,
                nombre: $('#inputNombre').val(),
                campoExtra: $('#campoExtra').val(),
                objetivoReg: $('#inputObjetivo').val(),
                ID_caract: <?= json_encode($caracteristicas['ID_caract']) ?>,
                ID_tOrdJur: ID_tOrdJur,
                Nombre: $('#inputNombre').val(),
                Ambito_Aplicacion: <?= json_encode($caracteristicas['Ambito_Aplicacion']) ?>,
                Fecha_Exp: $('#Fecha_Exp').val(),
                Fecha_Publi: $('#Fecha_Publi').val(),
                Fecha_Vigor: $('#Fecha_Vigor').val(),
                Fecha_Act: $('#Fecha_Act').val(),
                Vigencia: $('#campoExtra').val(),
                Orden_Gob: $('#selectUnidad2').val()
            };
            console.log('Datos del formulario:', formData);

        // Enviar la solicitud AJAX para modificar la regulación
        $.ajax({
            url: '<?= base_url("RegulacionController/modificarRegulacion") ?>',
            type: 'POST',
            data: formData,
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    // Enviar la solicitud AJAX para modificar las características
                    $.ajax({
                        url: '<?= base_url("RegulacionController/modificarCaracteristicas") ?>',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            var result = JSON.parse(response);
                            if (result.status === 'success') {
                                // Verificar si hay registros en rel_autoridades_emiten con el ID_caract

                                $.ajax({
                                    url: '<?= base_url("RegulacionController/verificarRelAutoridadesEmiten") ?>',
                                    type: 'POST',
                                    data: {
                                        ID_caract: formData.ID_caract
                                    },
                                    success: function(response) {
                                        var result = JSON.parse(
                                            response);
                                        if (result.status ===
                                            'empty') {
                                            // No hay registros, insertar los datos
                                            // Obtener todos los ID_Dependencia de la tabla emitenTable
                                            var
                                                ID_DependenciasEmiten = [];
                                            $('#emitenTable tbody tr')
                                                .each(function() {
                                                    var ID_Dependencia =
                                                        $(this)
                                                        .find(
                                                            'td'
                                                        )
                                                        .eq(0)
                                                        .text();
                                                    ID_DependenciasEmiten
                                                        .push(
                                                            ID_Dependencia
                                                        );
                                                });
                                            // Insertar en la tabla rel_autoridades_emiten
                                            ID_DependenciasEmiten
                                                .forEach(function(
                                                    ID_Dependencia
                                                ) {
                                                    var relDataEmiten = {
                                                        ID_Emiten: ID_Dependencia,
                                                        ID_Caract: formData
                                                            .ID_caract
                                                    };
                                                    $.ajax({
                                                        url: '<?= base_url("RegulacionController/insertarRelAutoridadesEmiten") ?>',
                                                        type: 'POST',
                                                        data: relDataEmiten,
                                                        success: function(
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
                                                                alert
                                                                    (
                                                                        'Regulación, características y relación de autoridades modificadas exitosamente.'
                                                                    );
                                                                // Opcional: Redirigir o actualizar la página
                                                                location
                                                                    .reload();
                                                            } else {
                                                                alert
                                                                    ('Error al insertar la relación de autoridades: ' +
                                                                        result
                                                                        .message
                                                                    );
                                                            }
                                                        },

                                                        error: function() {
                                                            alert
                                                                (
                                                                    'Error en la solicitud AJAX para insertar la relación de autoridades.'
                                                                );
                                                        }
                                                    });
                                                });
                                        } else {
                                            // Hay registros existentes, insertar solo los nuevos
                                            // Realizar la llamada AJAX al controlador
                                            console.log(
                                                'ID_caract:',
                                                formData
                                                .ID_caract
                                            ); // Verificar el valor de ID_caract
                                            // Obtener todos los ID_Dependencia de la tabla emitenTable
                                            var
                                                ID_DependenciasEmiten = [];
                                            $('#emitenTable tbody tr')
                                                .each(function() {
                                                    var ID_Dependencia =
                                                        $(this)
                                                        .find(
                                                            'td'
                                                        )
                                                        .eq(0)
                                                        .text();
                                                    ID_DependenciasEmiten
                                                        .push(
                                                            ID_Dependencia
                                                        );
                                                });
                                            $.ajax({
                                                url: '<?= base_url("RegulacionController/obtenerExistentesPorCaract") ?>', // Cambia esto a la ruta correcta de tu controlador
                                                type: 'POST',
                                                data: {
                                                    ID_caract: formData
                                                        .ID_caract
                                                },
                                                dataType: 'json',
                                                success: function(
                                                    result
                                                ) {
                                                    if (result
                                                        .status ===
                                                        'success'
                                                    ) {
                                                        var existentes =
                                                            result
                                                            .data; // Suponiendo que result.data contiene los ID_Emiten existentes
                                                        console
                                                            .log(
                                                                'existentes',
                                                                existentes
                                                            ); // Para verificar los datos en la consola
                                                        // Filtrar los nuevos IDs que no están en el array existentes
                                                        var nuevosIDs =
                                                            ID_DependenciasEmiten
                                                            .filter(
                                                                function(
                                                                    id
                                                                ) {
                                                                    return !
                                                                        existentes
                                                                        .includes(
                                                                            id
                                                                        );
                                                                }
                                                            );
                                                        console
                                                            .log(
                                                                'nuevosIDs',
                                                                nuevosIDs
                                                            ); // Para verificar los nuevos IDs en la consola
                                                        // Insertar los nuevos IDs en la base de datos
                                                        console
                                                            .log(
                                                                'ID_caract test:',
                                                                formData
                                                                .ID_caract
                                                            ); // Verificar el valor de ID_caract
                                                        if (nuevosIDs
                                                            .length >
                                                            0
                                                        ) {
                                                            nuevosIDs
                                                                .forEach(
                                                                    function(
                                                                        id
                                                                    ) {
                                                                        console
                                                                            .log(
                                                                                'Enviando ID_Emiten:',
                                                                                id,
                                                                                'ID_caract:',
                                                                                formData
                                                                                .ID_caract
                                                                            ); // Verificar los datos antes de enviarlos
                                                                        $.ajax({
                                                                            url: '<?= base_url("RegulacionController/insertarRelAutoridadesEmiten") ?>', // Cambia esto a la ruta correcta de tu controlador
                                                                            type: 'POST',
                                                                            data: {
                                                                                ID_Emiten: id,
                                                                                ID_Caract: formData
                                                                                    .ID_caract
                                                                            },
                                                                            dataType: 'json',
                                                                            success: function(
                                                                                insertResult
                                                                            ) {
                                                                                if (insertResult
                                                                                    .status ===
                                                                                    'success'
                                                                                ) {
                                                                                    console
                                                                                        .log(
                                                                                            'ID ' +
                                                                                            id +
                                                                                            ' insertado correctamente'
                                                                                        );
                                                                                    // Aquí puedes continuar con cualquier lógica adicional después de la inserción
                                                                                } else {
                                                                                    console
                                                                                        .error(
                                                                                            'Error al insertar ID ' +
                                                                                            id +
                                                                                            ' : ',
                                                                                            insertResult
                                                                                            .message
                                                                                        ); // Manejo de errores
                                                                                }
                                                                            },
                                                                            error: function(
                                                                                xhr,
                                                                                status,
                                                                                error
                                                                            ) {
                                                                                console
                                                                                    .error(
                                                                                        'Error en la llamada AJAX de inserción:',
                                                                                        error
                                                                                    ); // Manejo de errores
                                                                            }
                                                                        });
                                                                    }
                                                                );
                                                        }
                                                    } else {
                                                        console
                                                            .error(
                                                                result
                                                                .message
                                                            ); // Manejo de errores
                                                    }
                                                },
                                                error: function(
                                                    xhr,
                                                    status,
                                                    error
                                                ) {
                                                    console
                                                        .error(
                                                            'Error en la llamada AJAX:',
                                                            error
                                                        ); // Manejo de errores
                                                }
                                            });
                                        }
                                    },
                                    error: function() {
                                        alert(
                                            'Error en la solicitud AJAX para verificar la relación de autoridades.'
                                        );
                                    }
                                });

                                // Repetir el mismo proceso para insertarRelAutoridadesAplican
                                $.ajax({
                                    url: '<?= base_url("RegulacionController/verificarRelAutoridadesAplican") ?>',
                                    type: 'POST',
                                    data: {
                                        ID_caract: formData.ID_caract
                                    },
                                    success: function(response) {
                                        var result = JSON.parse(
                                            response);
                                        if (result.status ===
                                            'empty') {
                                            // No hay registros, insertar los datos
                                            // Obtener todos los ID_Dependencia de la tabla aplicanTable
                                            var
                                                ID_DependenciasAplican = [];
                                            $('#aplicanTable tbody tr')
                                                .each(function() {
                                                    var ID_Dependencia =
                                                        $(this)
                                                        .find(
                                                            'td'
                                                        )
                                                        .eq(0)
                                                        .text();
                                                    ID_DependenciasAplican
                                                        .push(
                                                            ID_Dependencia
                                                        );
                                                });
                                            // Insertar en la tabla rel_autoridades_aplican
                                            ID_DependenciasAplican
                                                .forEach(function(
                                                    ID_Dependencia
                                                ) {
                                                    var relDataAplican = {
                                                        ID_Aplican: ID_Dependencia,
                                                        ID_Caract: formData
                                                            .ID_caract
                                                    };
                                                    $.ajax({
                                                        url: '<?= base_url("RegulacionController/insertarRelAutoridadesAplican") ?>',
                                                        type: 'POST',
                                                        data: relDataAplican,
                                                        success: function(
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
                                                                alert
                                                                    (
                                                                        'Regulación, características y relación de autoridades modificadas exitosamente.'
                                                                    );
                                                                // Opcional: Redirigir o actualizar la página
                                                                location
                                                                    .reload();
                                                            } else {
                                                                alert
                                                                    ('Error al insertar la relación de autoridades: ' +
                                                                        result
                                                                        .message
                                                                    );
                                                            }
                                                        },
                                                        error: function() {
                                                            alert
                                                                (
                                                                    'Error en la solicitud AJAX para insertar la relación de autoridades.'
                                                                );
                                                        }
                                                    });
                                                });
                                        } else {
                                            // Hay registros existentes, insertar solo los nuevos
                                            // Realizar la llamada AJAX al controlador
                                            console.log(
                                                'ID_caract:',
                                                formData
                                                .ID_caract
                                            ); // Verificar el valor de ID_caract
                                            // Obtener todos los ID_Dependencia de la tabla aplicanTable
                                            var
                                                ID_DependenciasAplican = [];
                                            $('#aplicanTable tbody tr')
                                                .each(function() {
                                                    var ID_Dependencia =
                                                        $(this)
                                                        .find(
                                                            'td'
                                                        )
                                                        .eq(0)
                                                        .text();
                                                    ID_DependenciasAplican
                                                        .push(
                                                            ID_Dependencia
                                                        );
                                                });
                                            $.ajax({
                                                url: '<?= base_url("RegulacionController/obtenerExistentesPorCaractAplican") ?>', // Cambia esto a la ruta correcta de tu controlador
                                                type: 'POST',
                                                data: {
                                                    ID_caract: formData
                                                        .ID_caract
                                                },
                                                dataType: 'json',
                                                success: function(
                                                    result
                                                ) {
                                                    if (result
                                                        .status ===
                                                        'success'
                                                    ) {
                                                        var existentes =
                                                            result
                                                            .data; // Suponiendo que result.data contiene los ID_Aplican existentes
                                                        console
                                                            .log(
                                                                'existentes',
                                                                existentes
                                                            ); // Para verificar los datos en la consola
                                                        // Filtrar los nuevos IDs que no están en el array existentes
                                                        var nuevosIDs =
                                                            ID_DependenciasAplican
                                                            .filter(
                                                                function(
                                                                    id
                                                                ) {
                                                                    return !
                                                                        existentes
                                                                        .includes(
                                                                            id
                                                                        );
                                                                }
                                                            );
                                                        console
                                                            .log(
                                                                'nuevosIDs',
                                                                nuevosIDs
                                                            ); // Para verificar los nuevos IDs en la consola
                                                        // Insertar los nuevos IDs en la base de datos
                                                        console
                                                            .log(
                                                                'ID_caract test:',
                                                                formData
                                                                .ID_caract
                                                            ); // Verificar el valor de ID_caract
                                                        if (nuevosIDs
                                                            .length >
                                                            0
                                                        ) {
                                                            nuevosIDs
                                                                .forEach(
                                                                    function(
                                                                        id
                                                                    ) {
                                                                        console
                                                                            .log(
                                                                                'Enviando ID_Aplican:',
                                                                                id,
                                                                                'ID_caract:',
                                                                                formData
                                                                                .ID_caract
                                                                            ); // Verificar los datos antes de enviarlos
                                                                        $.ajax({
                                                                            url: '<?= base_url("RegulacionController/insertarRelAutoridadesAplican") ?>', // Cambia esto a la ruta correcta de tu controlador
                                                                            type: 'POST',
                                                                            data: {
                                                                                ID_Aplican: id,
                                                                                ID_Caract: formData
                                                                                    .ID_caract
                                                                            },
                                                                            dataType: 'json',
                                                                            success: function(
                                                                                insertResult
                                                                            ) {
                                                                                if (insertResult
                                                                                    .status ===
                                                                                    'success'
                                                                                ) {
                                                                                    console
                                                                                        .log(
                                                                                            'ID ' +
                                                                                            id +
                                                                                            ' insertado correctamente'
                                                                                        );
                                                                                    // Aquí puedes continuar con cualquier lógica adicional después de la inserción
                                                                                } else {
                                                                                    console
                                                                                        .error(
                                                                                            'Error al insertar ID ' +
                                                                                            id +
                                                                                            ' : ',
                                                                                            insertResult
                                                                                            .message
                                                                                        ); // Manejo de errores
                                                                                }
                                                                            },
                                                                            error: function(
                                                                                xhr,
                                                                                status,
                                                                                error
                                                                            ) {
                                                                                console
                                                                                    .error(
                                                                                        'Error en la llamada AJAX de inserción:',
                                                                                        error
                                                                                    ); // Manejo de errores
                                                                            }
                                                                        });
                                                                    }
                                                                );
                                                        }
                                                    } else {
                                                        console
                                                            .error(
                                                                result
                                                                .message
                                                            ); // Manejo de errores
                                                    }
                                                },
                                                error: function(
                                                    xhr,
                                                    status,
                                                    error
                                                ) {
                                                    console
                                                        .error(
                                                            'Error en la llamada AJAX:',
                                                            error
                                                        ); // Manejo de errores
                                                }
                                            });
                                        }
                                    },
                                    error: function() {
                                        alert(
                                            'Error en la solicitud AJAX para verificar la relación de autoridades.'
                                        );
                                    }
                                });

                                $.ajax({
                                    url: '<?= base_url("RegulacionController/verificarRegistrosEnDeIndice") ?>',
                                    type: 'POST',
                                    data: {
                                        ID_caract: formData.ID_caract
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.existe) {
                                            var registrosExistentes =
                                                response
                                                .registrosExistentes ||
                                                [];
                                            console.log(
                                                'Registros existentes:',
                                                registrosExistentes
                                                );

                                            // Lógica de insertarDatosTabla directamente aquí
                                            var datosTabla = [];
                                            $('#resultTable tbody tr')
                                                .each(function() {
                                                    var ID_Indice =
                                                        $(this)
                                                        .find(
                                                            'td'
                                                            )
                                                        .eq(0)
                                                        .text();
                                                    var Texto =
                                                        $(this)
                                                        .find(
                                                            'td'
                                                            )
                                                        .eq(1)
                                                        .text();
                                                    var Orden =
                                                        $(this)
                                                        .find(
                                                            'td'
                                                            )
                                                        .eq(2)
                                                        .text();

                                                    // Excluir los registros existentes
                                                    if (!
                                                        registrosExistentes
                                                        .includes(
                                                            ID_Indice
                                                            )) {
                                                        var filaDatos = {
                                                            ID_Indice: ID_Indice,
                                                            ID_caract: formData
                                                                .ID_caract,
                                                            Texto: Texto,
                                                            Orden: Orden
                                                        };

                                                        datosTabla
                                                            .push(
                                                                filaDatos
                                                                );
                                                    }
                                                });

                                            // Imprimir datosTabla en consola
                                            console.log(
                                                'datos indice',
                                                datosTabla);

                                            // Insertar los datos en la base de datos
                                            $.ajax({
                                                url: '<?php echo base_url('RegulacionController/insertarDatosTabla'); ?>',
                                                type: 'POST',
                                                data: {
                                                    datosTabla: datosTabla
                                                },
                                                success: function(
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
                                                        alert
                                                            (
                                                                'Datos de la tabla insertados correctamente');
                                                    } else {
                                                        alert
                                                            (
                                                                'Error al insertar los datos de la tabla');
                                                    }
                                                }
                                            });

                                            // Obtener el nuevo ID_Jerarquia
                                            $.ajax({
                                                url: '<?= base_url("RegulacionController/obtenerNuevoIdJerarquia") ?>',
                                                type: 'GET',
                                                success: function(
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
                                                                function(
                                                                    index
                                                                    ) {
                                                                    var ID_Indice =
                                                                        $(
                                                                            this)
                                                                        .find(
                                                                            'td'
                                                                            )
                                                                        .eq(
                                                                            0)
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
                                                                    var ID_Padre =
                                                                        $(
                                                                            '#selectIndicePadre')
                                                                        .val();

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
                                                                        ID_Padre) {
                                                                        if (!
                                                                            registrosExistentes
                                                                            .includes(
                                                                                ID_Indice
                                                                                )
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
                                                            success: function(
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
                                                                    alert
                                                                        (
                                                                            'Datos de rel_indice insertados correctamente');
                                                                    // Redirigir a la página especificada
                                                                    var idRegulacion = formData.ID_Regulacion;
                                                                    window
                                                                        .location
                                                                        .href =
                                                                        '<?= base_url("RegulacionController/edit_mat/"); ?>'+ idRegulacion;
                                                                } else {
                                                                    alert
                                                                        (
                                                                            'Error al insertar los datos de rel_indice');
                                                                    // Redirigir a la página especificada
                                                                    var idRegulacion = formData.ID_Regulacion;
                                                                    window
                                                                        .location
                                                                        .href =
                                                                        '<?= base_url("RegulacionController/edit_mat/"); ?>'+ idRegulacion;
                                                                }
                                                            }
                                                        });
                                                    } else {
                                                        alert
                                                            ('Error al obtener el nuevo ID_Jerarquia: ' +
                                                                result
                                                                .message
                                                                );
                                                    }
                                                },
                                                error: function() {
                                                    alert
                                                        (
                                                            'Error en la solicitud AJAX para obtener el nuevo ID_Jerarquia.');
                                                }
                                            });
                                        } else {
                                            // Lógica de insertarDatosTabla directamente aquí
                                            var
                                                datosTabla = [];
                                            $('#resultTable tbody tr')
                                                .each(
                                                    function() {
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
                                                            ID_caract: formData
                                                                .ID_caract,
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

                                            // Insertar los datos en la base de datos
                                            $.ajax({
                                                url: '<?php echo base_url('RegulacionController/insertarDatosTabla'); ?>',
                                                type: 'POST',
                                                data: {
                                                    datosTabla: datosTabla
                                                },
                                                success: function(
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
                                                        alert
                                                            (
                                                                'Datos de la tabla insertados correctamente'
                                                            );
                                                    } else {
                                                        alert
                                                            (
                                                                'Error al insertar los datos de la tabla'
                                                            );
                                                    }
                                                }
                                            });

                                            // Obtener el nuevo ID_Jerarquia
                                            $.ajax({
                                                url: '<?= base_url("RegulacionController/obtenerNuevoIdJerarquia") ?>',
                                                type: 'GET',
                                                success: function(
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
                                                                function(
                                                                    index
                                                                    ) {
                                                                    var ID_Indice =
                                                                        $(
                                                                            this)
                                                                        .find(
                                                                            'td'
                                                                            )
                                                                        .eq(
                                                                            0)
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
                                                                    var ID_Padre =
                                                                        $(
                                                                            '#selectIndicePadre')
                                                                        .val();

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
                                                                        ID_Padre) {
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
                                                            success: function(
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
                                                                    alert
                                                                        (
                                                                            'Datos de rel_indice insertados correctamente');
                                                                    // Redirigir a la página especificada
                                                                    var idRegulacion = formData.ID_Regulacion;
                                                                    window
                                                                        .location
                                                                        .href =
                                                                        '<?= base_url("RegulacionController/edit_mat/"); ?>'+ idRegulacion;
                                                                } else {
                                                                    alert
                                                                        (
                                                                            'Error al insertar los datos de rel_indice');
                                                                    // Redirigir a la página especificada
                                                                    var idRegulacion = formData.ID_Regulacion;
                                                                    window
                                                                        .location
                                                                        .href =
                                                                        '<?= base_url("RegulacionController/edit_mat/"); ?>'+ idRegulacion;
                                                                }
                                                            }
                                                        });
                                                    } else {
                                                        alert
                                                            ('Error al obtener el nuevo ID_Jerarquia: ' +
                                                                result
                                                                .message
                                                                );
                                                    }
                                                },
                                                error: function() {
                                                    alert
                                                        (
                                                            'Error en la solicitud AJAX para obtener el nuevo ID_Jerarquia.');
                                                }
                                            });
                                        }
                                    },
                                    error: function() {
                                        alert(
                                            'Error en la solicitud AJAX para verificar registros en de_indice.');
                                    }
                                });


                            } else {
                                alert('Error al modificar las características: ' +
                                    result.message);
                            }
                        },
                        error: function() {
                            alert(
                                'Error en la solicitud AJAX para modificar las características'
                            );
                        }
                    });
                } else {
                    alert('Error al modificar la regulación: ' + result.message);
                }
            },
            error: function() {
                alert('Error en la solicitud AJAX para modificar la regulación');
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
                        '<td><button class="btn btn-danger btn-sm delete-row">' +
                '<i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>';
                    $('#resultTable tbody')
                        .append(newRow);
                },
                error: function(jqXHR, textStatus,
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
                lastInsertedOrden + '<td><button class="btn btn-danger btn-sm delete-row">' +
                '<i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>';
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