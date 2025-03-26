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
                                <li class="iconos-regulacion active-view">
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
                        <div class="card-header text-white">Edición al RER</div>
                        <div class="card-body div-card-body">
                            <!-- Mensaje de atención -->
                            <div class="alert alert-warning" role="alert">
                                Atención: Esta ficha debe ser requisitada
                                con el uso de mayúsculas y minúsculas.
                            </div>
                            <!-- Formulario de agregar regulaciones -->
                            <form class="row g-3" id="form-regulacion">
                                <div class="form-group">
                                    <label for="inputNombre">Nombre<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputNombre" name="nombre"
                                        value="<?php echo $regulacion['Nombre_Regulacion']; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selectSujeto">Ámbito de aplicación<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="selectSujeto" name="sujeto" required>
                                            <!-- <option disabled selected>
                                                <?php echo $caracteristicas['Ambito_Aplicacion']; ?>
                                            </option> -->
                                            <option value="Estatal">Estatal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
                                    <label for="Fecha_Exp">Fecha de expedición de la regulación<span
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
                                    <label for="Fecha_Vigor">Fecha de entrada en vigor de la regulación<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="Fecha_Vigor" name="fecha_vigor"
                                        value="<?php echo isset($caracteristicas['Fecha_Vigor']) ? date('Y-m-d', strtotime($caracteristicas['Fecha_Vigor'])) : ''; ?>"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Fecha_Act">Fecha de última actualización de la regulación</label>
                                    <input type="date" class="form-control" id="Fecha_Act" name="fecha_act" required
                                        readonly>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var Fecha_Act = document.getElementById('Fecha_Act');
                                        var today = new Date().toISOString().split('T')[0];
                                        Fecha_Act.value = today;
                                    });
                                </script>

                                <form>
                                    <div class="col-md-6" id="selectVigencia">
                                        <p>¿La regulación tiene vigencia definida?</p>
                                        <div class="d-flex justify-content-start mb-3">
                                            <label>
                                                <input type="radio" name="opcion" id="si" onclick="mostrarCampo()" <?php echo ($regulacion['Vigencia'] != '0000-00-00') ? 'checked' : ''; ?>>
                                                Sí
                                            </label>
                                            <label class="ms-2">
                                                <input type="radio" name="opcion" id="no" onclick="mostrarCampo()" <?php echo ($regulacion['Vigencia'] == '0000-00-00') ? 'checked' : ''; ?>
                                                    checked>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 hidden-column" id="otroCampo"
                                        style="display: <?php echo ($regulacion['Vigencia'] != '0000-00-00'); ?>;">
                                        <label for="campoExtra">Vigencia de la regulación</label>
                                        <input type="date" class="form-control" id="campoExtra" name="campoExtra"
                                            value="<?php echo ($regulacion['Vigencia'] != '0000-00-00') ? $regulacion['Vigencia'] : ''; ?>"
                                            required>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputVialidad">Orden de gobierno que la emite</label>
                                            <select class="form-control" id="selectUnidad2" name="orden" required>
                                                <option disabled selected><?php echo $caracteristicas['Orden_Gob']; ?>
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
                                    <div id="emTContainer">
                                        <table id="emitenTable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Tipo dependencia</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dependencias as $dependencia): ?>

                                                <td class="hidden-column">
                                                    <?php    echo $dependencia['ID_Dependencia']; ?>
                                                </td>
                                                <td><?php    echo $dependencia['nombre_sujeto']; ?></td>
                                                <td class="text-end">
                                                    <button class="btn btn-danger btn-sm delete-row" title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i></button>
                                                </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <form>
                                    <div class="col-md-12" id="selectAplican">
                                        <p>¿Están obligadas todas las autoridades a cumplir con la regulación?</p>
                                        <div>
                                            <label>
                                                <input type="radio" name="opcion" id="apsi" checked> Sí
                                            </label>
                                            <label>
                                                <input type="radio" name="opcion" id="apno">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div id="AutoridadesAplicanContainer" class="col-md-6">
                                        <div class="form-group">
                                            <label for="AutoridadesAplican">Autoridades que aplican la
                                                regulación</label>
                                            <input type="text" class="form-control" id="AutoridadesAplican"
                                                name="AutoridadesAplican" required>
                                            <div id="searchResults2" class="list-group"></div>
                                        </div>
                                    </div>
                                    <div id="opcAplican">
                                        <div id="apTContainer">
                                            <table id="aplicanTable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo dependencia</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (is_array($dependenciasAp)): ?>
                                                    <?php    foreach ($dependenciasAp as $dependenciaAp): ?>
                                                    <?php        if (is_array($dependenciaAp) && isset($dependenciaAp['ID_sujeto']) && isset($dependenciaAp['nombre_sujeto'])): ?>
                                                    <tr>
                                                        <td class="hidden-column">
                                                            <?php            echo $dependenciaAp['ID_sujeto']; ?>
                                                        </td>
                                                        <td><?php            echo $dependenciaAp['nombre_sujeto']; ?>
                                                        </td>
                                                        <td class="text-end">
                                                            <button class="btn btn-danger btn-sm delete-row" title="Eliminar">
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
                                <div class="header-container mb-0">
                                    <p class="mb-0">Índice de la regulación</p>
                                    <button type="button" id="botonIndice" class="btn btn-indice" data-toggle="modal"
                                        data-target="#myModal">Agregar</button>
                                </div>
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
                                                        <label for="inputTexto">Texto<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="inputTexto"
                                                            placeholder="Ingrese texto" name="texto">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputOrden">Orden<span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" id="inputOrden" placeholder="Ingrese orden" name="orden" min="0">
                                                    </div>
                                                    <script>
                                                        document.getElementById('inputOrden').addEventListener('input', function() {
                                                            if (this.value < 0) {
                                                                this.value = 0;
                                                            }
                                                        });
                                                    </script>
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
                                            <script>
                                                $(document).ready(function() {
                                                    $('#botonIndice').click(function() {
                                                        // Limpiar los campos del formulario en el modal
                                                        $('#inputTexto').val('');
                                                        $('#inputOrden').val('');
                                                        $('#selectIndicePadre').val('Seleccione un índice padre');
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <table id="resultTable" class="table table-spacing">
                                    <thead>
                                        <tr>
                                            <th class="hidden-column">ID_Indice</th>
                                            <th>Texto</th>
                                            <th>Orden</th>
                                            <th class="hidden-column">Indice_Padre</th>
                                            <th class="hidden-column">ID_IndicePadre</th>
                                            <th></th>
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
                                                            console.log(response); // Verificar la respuesta en la consola
                                                            var tbody = $('#resultTable tbody');
                                                            tbody.empty(); // Limpiar el contenido existente

                                                            if (response.length > 0) {
                                                                response.forEach(function (row) {
                                                                    var rowClass = row.ID_Padre && row.ID_Padre != '0' ? 'child-row' : 'parent-row';
                                                                    var newRow = `<tr class="${rowClass}">
                                                                    <td class="hidden-column">${row.ID_Indice}</td>
                                                                    <td class="texto">${row.Texto}</td>
                                                                    <td>${row.Orden}</td>
                                                                    <td class="hidden-column">${row.ID_Padre || ''}</td>
                                                                    <td class="hidden-column indice-padre">${row.ID_Padre || ''}</td>
                                                                    <td class="text-end">
                                                                        <button class="btn btn-gris btn-sm edit-row me-2" title="Editar"><i class="fas fa-edit"></i></button>
                                                                        <button class="btn btn-danger btn-sm delete-row" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                                                    </td>
                                                                </tr>`;

                                                                    if (row.ID_Padre && row.ID_Padre != '0') {
                                                                        var parentRow = tbody.find('tr').filter(function () {
                                                                            return $(this).find('td').eq(0).text() == row.ID_Padre;
                                                                        });
                                                                        parentRow.after(newRow);
                                                                    } else {
                                                                        tbody.append(newRow);
                                                                    }
                                                                });
                                                            } else {
                                                                // Manejar el caso en que no haya datos
                                                            }
                                                        },
                                                        error: function () {
                                                            Swal.fire({
                                                                title: 'Error',
                                                                text: 'Error al obtener los índices.',
                                                                icon: 'error',
                                                                confirmButtonText: 'Aceptar'
                                                            });
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
                                                                                Swal.fire({
                                                                                    title: 'Éxito',
                                                                                    text: 'Registro eliminado exitosamente de la base de datos.',
                                                                                    icon: 'success',
                                                                                    confirmButtonText: 'Aceptar'
                                                                                });
                                                                            } else {
                                                                                Swal.fire({
                                                                                    title: 'Error',
                                                                                    text: 'Error al eliminar el registro de la base de datos: ' +
                                                                                        result
                                                                                            .message,
                                                                                    icon: 'error',
                                                                                    confirmButtonText: 'Aceptar'
                                                                                });
                                                                            }
                                                                        },
                                                                        error: function () {
                                                                            Swal.fire({
                                                                                title: 'Error',
                                                                                text: 'Error en la solicitud AJAX para eliminar el registro de la base de datos.',
                                                                                icon: 'error',
                                                                                confirmButtonText: 'Aceptar'
                                                                            });
                                                                        }
                                                                    });
                                                                },
                                                                error: function () {
                                                                    Swal.fire({
                                                                        title: 'Error',
                                                                        text: 'Error en la solicitud AJAX para eliminar registros en rel_indice.',
                                                                        icon: 'error',
                                                                        confirmButtonText: 'Aceptar'
                                                                    });
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
                                                                        Swal.fire({
                                                                            title: 'Éxito',
                                                                            text: 'Registro eliminado exitosamente de la base de datos.',
                                                                            icon: 'success',
                                                                            confirmButtonText: 'Aceptar'
                                                                        });
                                                                    } else {
                                                                        Swal.fire({
                                                                            title: 'Error',
                                                                            text: 'Error al eliminar el registro de la base de datos: ' +
                                                                                result
                                                                                    .message,
                                                                            icon: 'error',
                                                                            confirmButtonText: 'Aceptar'
                                                                        });
                                                                    }
                                                                },
                                                                error: function () {
                                                                    Swal.fire({
                                                                        title: 'Error',
                                                                        text: 'Error en la solicitud AJAX para eliminar el registro de la base de datos.',
                                                                        icon: 'error',
                                                                        confirmButtonText: 'Aceptar'
                                                                    });
                                                                }
                                                            });
                                                        }
                                                    },
                                                    error: function () {
                                                        Swal.fire({
                                                            title: 'Error',
                                                            text: 'Error en la solicitud AJAX para buscar el índice en rel_indice.',
                                                            icon: 'error',
                                                            confirmButtonText: 'Aceptar'
                                                        });
                                                    }
                                                });
                                            }
                                        });
                                    });
                                </script>

                                <div class="form-group my-5">
                                    <label for="inputObjetivo">Objeto de la regulación</label><span
                                    class="text-danger">*</span>
                                    <textarea class="form-control" id="inputObjetivo" name="objetivoReg"
                                        rows="5"><?php echo htmlspecialchars($regulacion['Objetivo_Reg'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>
                                <p></p>
                                <div class="header-container mb-0">
                                    <p id="matText" class="mb-0">Materias, Sectores y Sujetos Regulados<span
                                            class="text-danger">*</span></p>
                                    <button type="button" id="botonMaterias" class="btn btn-tinto btn-materias"
                                        data-toggle="modal" data-target="#matModal">Agregar</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="matModal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Materias, Sectores y
                                                    Sujetos Regulados
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="inputMat">Materias</label>
                                                        <input type="text" class="form-control" id="inputMat"
                                                            placeholder="Ingrese la Materia" name="NombreTram">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSec">Sectores</label>
                                                        <input type="text" class="form-control" id="inputSec"
                                                            placeholder="Ingrese el Sector" name="NombreSec">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSuj">Sujetos Regulados</label>
                                                        <input type="text" class="form-control" id="inputSuj"
                                                            placeholder="Ingrese el Sujeto" name="NombreSuj">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    onclick="closeModal()">Cerrar</button>
                                                <button type="button" id="guardarMat" class="btn btn-tinto">Guardar cambios</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#botonMaterias').click(function() {
                                            // Limpiar los campos del formulario en el modal
                                            $('#inputMat').val('');
                                            $('#inputSec').val('');
                                            $('#inputSuj').val('');
                                        });
                                    });
                                </script>
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
                                        <?php if (!empty($mat_sec)): ?>
                                        <?php    foreach ($mat_sec as $mater): ?>
                                        <tr>
                                            <td class="hidden-column"><?php        echo $mater['ID_MatSec']; ?></td>
                                            <td><?php        echo $mater['Materias']; ?></td>
                                            <td><?php        echo $mater['Sectores']; ?></td>
                                            <td><?php        echo $mater['SujetosRegulados']; ?></td>
                                            <td class="text-end"><button class="btn btn-gris btn-sm edit-row me-2">
                                                    <i class="fas fa-edit"></i></button><button
                                                    class="btn btn-danger btn-sm delete-row" title="Eliminar"><i
                                                        class="fas fa-trash-alt"></i></button></td>
                                            <!-- Agrega más celdas según sea necesario -->
                                        </tr>
                                        <?php    endforeach; ?>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <style>
                                    .hidden-column {
                                        display: none;
                                    }
                                </style>
                                <p></p>
                                <p></p>
                                <div class="header-container mb-0">
                                    <p id="funText" class="mb-0"> Identificación de fundamentos jurídicos para la
                                        realización de Inspecciones, Verificaciones y Visitas
                                        Domiciliarias (REVID)
                                    </p>
                                    <button type="button" id="botofundamentos" class="btn btn-tinto btn-fundamentos"
                                        data-toggle="modal" data-target="#funModal">Agregar</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="funModal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel"> Identificación de fundamentos
                                                    jurídicos para la realización de Inspecciones, Verificaciones y
                                                    Visitas
                                                    Domiciliarias</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="inputNomReg">Nombre de la regulación</label>
                                                        <input type="text" class="form-control" id="inputNomReg"
                                                            placeholder="Ingrese el Nombre" name="NombreReg">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputArt">Articulo, párrafo, numeral,
                                                            etc.</label>
                                                        <input type="text" class="form-control" id="inputArt"
                                                            placeholder="Ingrese el Articulo" name="NombreArt">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputLink">Dirección web</label>
                                                        <input type="text" class="form-control" id="inputLink"
                                                            placeholder="http://" name="NombreLink">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    onclick="closeModal()">Cerrar</button>
                                                <button type="button" id="guardarFun" class="btn btn-tinto">Guardar cambios</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#botofundamentos').click(function() {
                                            // Limpiar los campos del formulario en el modal
                                            $('#inputNomReg').val('');
                                            $('#inputArt').val('');
                                            $('#inputLink').val('');
                                        });
                                    });
                                </script>
                                <table id="fundamentoTable" class="table table-spacing">
                                    <thead>
                                        <tr>
                                            <th class="hidden-column">ID_Fun</th>
                                            <th>Nombre Regulacion</th>
                                            <th>Articulo</th>
                                            <th>Dirección web</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Las filas se agregarán dinámicamente aquí -->
                                        <?php if (!empty($fundamentos)): ?>
                                        <?php    foreach ($fundamentos as $fundamento): ?>
                                        <tr>
                                            <td class="hidden-column"><?php        echo $fundamento['ID_Fun']; ?></td>
                                            <td><?php        echo $fundamento['Nombre']; ?></td>
                                            <td><?php        echo $fundamento['Articulo']; ?></td>
                                            <td><?php        echo $fundamento['Link']; ?></td>
                                            <td class="text-end"><button class="btn btn-gris btn-sm edit-row me-2">
                                                    <i class="fas fa-edit"></i></button><button
                                                    class="btn btn-danger btn-sm delete-row" title="Eliminar"><i
                                                        class="fas fa-trash-alt"></i></button></td>
                                            <!-- Agrega más celdas según sea necesario -->
                                        </tr>
                                        <?php    endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="3">No se encontraron registros.</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <p></p>
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="<?php echo base_url('RegulacionController'); ?>"
                                    id="cancelButton" class="btn btn-secondary me-2">Cancelar</a>
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
                window.location.href = '<?php echo base_url('RegulacionController'); ?>';
            }
        });
    });
});
</script>

<script>
    $(document).ready(function () {
        $('#myModal').on('show.bs.modal', function () {
            // Limpiar las opciones del select y agregar la opción por defecto
            $('#selectIndicePadre').empty().append('<option>Seleccione un índice padre</option>');



            // Agregar las opciones de la tabla
            $('#resultTable tbody tr').each(function () {
                var idIndice = $(this).find('.hidden-column').first().text();
                var textoIndice = $(this).find('.texto').text();
                $('#selectIndicePadre').append('<option value="' + idIndice + '">' + textoIndice + '</option>');
            });
        });
    });
</script>
<script>
    function mostrarCampo() {
        var siSeleccionado = document.getElementById("si").checked;
        var otroCampo = document.getElementById("otroCampo");
        var campoExtra = document.getElementById("campoExtra");

        if (siSeleccionado) {
            otroCampo.style.display = "block"; // Mostrar el campo
            campoExtra.style.display = "block"; // Mostrar el campo de fecha
        } else {
            otroCampo.style.display = "none"; // Ocultar el campo
            campoExtra.style.display = "none"; // Ocultar el campo de fecha
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
                    title: 'Error',
                    text: 'Error al verificar los registros en la base de datos.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });

        $('#guardarMat').click(function () {
            // Obtiene los valores de los inputs
            var inputMat = $('#inputMat').val();
            var inputSec = $('#inputSec').val();
            var inputSuj = $('#inputSuj').val();

            if (inputMat.trim() === '' || inputSec.trim() === '' || inputSuj.trim() === '') {
                if (inputMat.trim() === '') {
                    
                    $('#inputMat').after(
                        '<span class="error-message" style="color: red;">El campo "Materias" es obligatorio.</span>'
                    );
                }
                if (inputSec.trim() === '') {
                    
                    $('#inputSec').after(
                        '<span class="error-message" style="color: red;">El campo "Sectores" es obligatorio.</span>'
                    );
                }
                if (inputSuj.trim() === '') {
                    
                    $('#inputSuj').after(
                        '<span class="error-message" style="color: red;">El campo "Sujetos Regulados" es obligatorio.</span>'
                    );
                }
                // Prevenir el cierre del modal
                $('#matModal').modal('show');
                return;
            } else {
                // Eliminar los mensajes de error
                $('.error-message').remove();
                
                $('#matModal').modal('hide');
                // Crea una nueva fila con los datos
                var newRow = '<tr>' +
                    '<td class="hidden-column">' + idCounter + '</td>' +
                    '<td>' + inputMat + '</td>' +
                    '<td>' + inputSec + '</td>' +
                    '<td>' + inputSuj + '</td>' +
                    '<td><button class="btn btn-danger btn-sm edit-row" title="Editar" >' +
                    '<i class="fas fa-edit"></i></button></td>' +
                    '<td><button class="btn btn-danger btn-sm delete-row" title="Eliminar" >' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>';

                // Agrega la nueva fila a la tabla
                $('#materiasTable tbody').append(newRow);

                // Inicializar tooltips para los nuevos elementos
                $('[]').tooltip();

                // Incrementa el contador de ID_MatSec
                idCounter++;

                // Limpia los valores de los inputs
                $('#inputMat').val('');
                $('#inputSec').val('');
                $('#inputSuj').val('');
            }
        });

        // Maneja el evento de clic para eliminar una fila
        $('#materiasTable').on('click', '.delete-row', function () {
            var row = $(this).closest('tr');
            var idMatSec = row.find('td').eq(0).text();

            // Mostrar ventana de confirmación
            if (confirm('¿Estás seguro de que quieres eliminar este registro?')) {
                // Realiza una solicitud AJAX para eliminar el registro de la base de datos
                $.ajax({
                    url: '<?= base_url('RegulacionController/eliminarRegistro') ?>',
                    type: 'POST',
                    data: { ID_MatSec: idMatSec },
                    success: function (response) {
                        if (response.status === 'success') {
                            // Elimina la fila de la tabla
                            row.remove();
                            idCounter--;
                        } else {
                            //es un registro nuevo que no se ha guardado en la base de datos
                            row.remove();
                            idCounter--;
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al eliminar el registro de la base de datos.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            }
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
                    title: 'Error',
                    text: 'Error al verificar los registros en la base de datos.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });

        $('#guardarFun').click(function () {
            // Obtiene los valores de los inputs
            var inputNomReg = $('#inputNomReg').val();
            var inputArt = $('#inputArt').val();
            var inputLink = $('#inputLink').val();

            if (inputNomReg.trim() === '' || inputArt.trim() === '' || inputLink.trim() === '') {
                if (inputNomReg.trim() === '') {
                    
                    $('#inputNomReg').after(
                        '<span class="error-message" style="color: red;">El campo "Nombre de la Regulación" es obligatorio.</span>'
                    );
                }
                if (inputArt.trim() === '') {
                    
                    $('#inputArt').after(
                        '<span class="error-message" style="color: red;">El campo "Artículo" es obligatorio.</span>'
                    );
                }
                if (inputLink.trim() === '') {
                    
                    $('#inputLink').after(
                        '<span class="error-message" style="color: red;">El campo "Link" es obligatorio.</span>'
                    );
                }
                $('#funModal').modal('show');
                return;
            } else {
                $('#funModal').modal('hide');
                // Crea una nueva fila con los datos
                var newRow = '<tr>' +
                    '<td class="hidden-column">' + idCounter2 + '</td>' +
                    '<td>' + inputNomReg + '</td>' +
                    '<td>' + inputArt + '</td>' +
                    '<td>' + inputLink + '</td>' +
                    '<td><button class="btn btn-danger btn-sm edit-row" title="Editar" >' +
                    '<i class="fas fa-edit"></i></button></td>' +
                    '<td><button class="btn btn-danger btn-sm delete-row" title="Eliminar" >' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>';

                // Agrega la nueva fila a la tabla
                $('#fundamentoTable tbody').append(newRow);

                // Inicializar tooltips para los nuevos elementos
                $('[]').tooltip();

                // Incrementa el contador de ID_Fun
                idCounter2++;

                // Limpia los valores de los inputs
                $('#inputNomReg').val('');
                $('#inputArt').val('');
                $('#inputLink').val('');
            }
        });

        // Maneja el evento de clic para eliminar una fila
        $('#fundamentoTable').on('click', '.delete-row', function () {
            var row = $(this).closest('tr');
            var idFun = row.find('td').eq(0).text();

            // Mostrar ventana de confirmación
            if (confirm('¿Estás seguro de que quieres eliminar este registro?')) {
                // Realiza una solicitud AJAX para eliminar el registro de la base de datos
                $.ajax({
                    url: '<?= base_url('RegulacionController/eliminarFundamento') ?>',
                    type: 'POST',
                    data: { ID_Fun: idFun },
                    success: function (response) {
                        if (response.status === 'success') {
                            // Elimina la fila de la tabla
                            row.remove();
                            idCounter2--;
                        } else {
                            //es un registro nuevo que no se ha guardado en la base de datos
                            row.remove();
                            idCounter2--;
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al eliminar el registro de la base de datos.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            }
        });
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
                                    item.ID_sujeto + '">' + item
                                        .nombre_sujeto + '</a>');
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
                                    item.ID_sujeto + '">' + item
                                        .nombre_sujeto + '</a>');
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
        $(document).on('click', '#searchResults .list-group-item', function (event) {
            event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace
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
        $(document).on('click', '#searchResults2 .list-group-item', function (event) {
            event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace
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
                // Verificar si la fila ya existe
                if (tableBody.find('tr[data-id="' + item.ID_Dependencia + '"]').length === 0) {
                    var row = '<tr data-id="' + item.ID_Dependencia + '">' +
                        '<td class="hidden-column">' + item.ID_Dependencia + '</td>' +
                        '<td>' + item.Tipo_Dependencia + '</td>' +
                        '<td class="text-end"><button class="btn btn-danger btn-sm delete-row" title="Eliminar">' +
                        '<i class="fas fa-trash-alt"></i></button></td>' +
                        '</tr>';
                    tableBody.append(row);
                }
            });
        }

        function updateAplicanTable() {
            var tableBody = $('#aplicanTable tbody');
            //tableBody.empty();

            aplicanArray.forEach(function (item) {
                // Verificar si la fila ya existe
                if (tableBody.find('tr[data-id="' + item.ID_Dependencia + '"]').length === 0) {
                    var row = '<tr data-id="' + item.ID_Dependencia + '">' +
                        '<td class="hidden-column">' + item.ID_Dependencia + '</td>' +
                        '<td>' + item.Tipo_Dependencia + '</td>' +
                        '<td class="text-end"><button class="btn btn-danger btn-sm delete-row" title="Eliminar">' +
                        '<i class="fas fa-trash-alt"></i></button></td>' +
                        '</tr>';
                    tableBody.append(row);
                }
            });
        }

        // Manejar el evento de clic en el botón de eliminar
        $('#emitenTable').on('click', '.delete-row', function () {
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
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Registro eliminado exitosamente de la base de datos.',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Error al eliminar el registro de la base de datos: ' + result
                                    .message,
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error en la solicitud AJAX para eliminar el registro de la base de datos.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            }
        });

        // Manejar el evento de clic en el botón de eliminar para la tabla aplicanTable
        $('#aplicanTable').on('click', '.delete-row', function () {
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
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Registro eliminado exitosamente de la base de datos.',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Error al eliminar el registro de la base de datos: ' + result
                                    .message,
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error en la solicitud AJAX para eliminar el registro de la base de datos.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#botonGuardar').on('click', function () {
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
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        // Enviar la solicitud AJAX para modificar las características
                        $.ajax({
                            url: '<?= base_url("RegulacionController/modificarCaracteristicas") ?>',
                            type: 'POST',
                            data: formData,
                            success: function (response) {
                                var result = JSON.parse(response);
                                if (result.status === 'success') {
                                    // Verificar si hay registros en rel_autoridades_emiten con el ID_caract
                                    Swal.fire({
                                        title: 'Éxito',
                                        text: 'Regulación, características y relación de autoridades modificadas exitosamente.',
                                        icon: 'success',
                                        confirmButtonText: 'Aceptar'
                                    });

                                    $.ajax({
                                        url: '<?= base_url("RegulacionController/verificarRelAutoridadesEmiten") ?>',
                                        type: 'POST',
                                        data: {
                                            ID_caract: formData.ID_caract
                                        },
                                        success: function (response) {
                                            var result = JSON.parse(
                                                response);
                                            if (result.status ===
                                                'empty') {
                                                // No hay registros, insertar los datos
                                                // Obtener todos los ID_Dependencia de la tabla emitenTable
                                                var
                                                    ID_DependenciasEmiten = [];
                                                $('#emitenTable tbody tr')
                                                    .each(function () {
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
                                                    .forEach(function (
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
                                                                    // alert
                                                                    //     (
                                                                    //         'Regulación, características y relación de autoridades modificadas exitosamente.'
                                                                    //     );
                                                                    // Opcional: Redirigir o actualizar la página
                                                                    location
                                                                        .reload();
                                                                } else {
                                                                    // alert
                                                                    //     ('Error al insertar la relación de autoridades: ' +
                                                                    //         result
                                                                    //         .message
                                                                    //     );
                                                                }
                                                            },

                                                            error: function () {
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
                                                    .each(function () {
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
                                                    success: function (
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
                                                                        function (
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
                                                                        function (
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
                                                                                success: function (
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
                                                                                error: function (
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
                                                    error: function (
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
                                        error: function () {
                                            // alert(
                                            //     'Error en la solicitud AJAX para verificar la relación de autoridades.'
                                            // );
                                        }
                                    });

                                    // Repetir el mismo proceso para insertarRelAutoridadesAplican
                                    $.ajax({
                                        url: '<?= base_url("RegulacionController/verificarRelAutoridadesAplican") ?>',
                                        type: 'POST',
                                        data: {
                                            ID_caract: formData.ID_caract
                                        },
                                        success: function (response) {
                                            var result = JSON.parse(
                                                response);
                                            if (result.status ===
                                                'empty') {
                                                // No hay registros, insertar los datos
                                                // Obtener todos los ID_Dependencia de la tabla aplicanTable
                                                var
                                                    ID_DependenciasAplican = [];
                                                $('#aplicanTable tbody tr')
                                                    .each(function () {
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
                                                    .forEach(function (
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
                                                                    // alert
                                                                    //     (
                                                                    //         'Regulación, características y relación de autoridades modificadas exitosamente.'
                                                                    //     );
                                                                    // Opcional: Redirigir o actualizar la página
                                                                    location
                                                                        .reload();
                                                                } else {
                                                                    // alert
                                                                    //     ('Error al insertar la relación de autoridades: ' +
                                                                    //         result
                                                                    //         .message
                                                                    //     );
                                                                }
                                                            },
                                                            error: function () {
                                                                // alert
                                                                //     (
                                                                //         'Error en la solicitud AJAX para insertar la relación de autoridades.'
                                                                //     );
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
                                                    .each(function () {
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
                                                    success: function (
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
                                                                        function (
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
                                                                        function (
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
                                                                                success: function (
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
                                                                                error: function (
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
                                                    error: function (
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
                                        error: function () {
                                            // alert(
                                            //     'Error en la solicitud AJAX para verificar la relación de autoridades.'
                                            // );
                                        }
                                    });

                                    var registrosExistentes3 = []; // Array para almacenar los registros existentes
                                    // Realiza una solicitud AJAX para obtener los registros existentes en la base de datos
                                    $.ajax({
                                        url: '<?php echo base_url('RegulacionController/verificarRegistros2'); ?>', // Cambia esta URL a la ruta de tu controlador
                                        type: 'GET',
                                        data: { ID_caract: formData.ID_caract }, // Asegúrate de que caracteristicasData esté definido
                                        dataType: 'json',
                                        success: function (response) {
                                            if (response.existenRegistros) {
                                                registrosExistentes3 = response.registrosExistentes; // Almacena los registros existentes
                                            }
                                            var registros = [];
                                            $('#materiasTable tbody tr').each(function () {
                                                var idMatSec = $(this).find('td').eq(0).text();
                                                var materias = $(this).find('td').eq(1).text();
                                                var sectores = $(this).find('td').eq(2).text();
                                                var sujetosRegulados = $(this).find('td').eq(3).text();

                                                // Verifica si el registro ya existe en la base de datos
                                                var existe = registrosExistentes3.some(function (registro) {
                                                    return parseInt(registro.ID_MatSec, 10) === parseInt(idMatSec, 10);
                                                });

                                                if (!existe) {
                                                    registros.push({
                                                        ID_MatSec: parseInt(idMatSec, 10),
                                                        Materias: materias,
                                                        Sectores: sectores,
                                                        SujetosRegulados: sujetosRegulados
                                                    });
                                                }
                                            });
                                            console.log('Registros a insertar:', registros);
                                            console.log('ID_caract: a insertar', formData.ID_caract);

                                            $.ajax({
                                                url: '<?php echo base_url('RegulacionController/guardarRegistros'); ?>', // Cambia esta URL a la ruta de tu controlador
                                                type: 'POST',
                                                data: {
                                                    registros: registros,
                                                    ID_caract: parseInt(formData.ID_caract, 10) // Asegúrate de que caracteristicasData esté definido
                                                },

                                                success: function (response) {
                                                    Swal.fire({
                                                        title: 'Éxito',
                                                        text: 'Materias Registros guardados exitosamente.',
                                                        icon: 'success',
                                                        confirmButtonText: 'Aceptar'
                                                    });
                                                },
                                                error: function () {
                                                    Swal.fire({
                                                        title: 'Error',
                                                        text: 'Error al guardar los registros Materias.',
                                                        icon: 'error',
                                                        confirmButtonText: 'Aceptar'
                                                    });
                                                }
                                            });
                                        },
                                        error: function () {
                                            // Verificar que los datos no estén vacíos
                                            if (registros.length === 0 || !formData.ID_caract) {
                                                Swal.fire({
                                                    title: 'Error',
                                                    text: 'Datos incompletos. Por favor, verifica los datos antes de enviar.',
                                                    icon: 'error',
                                                    confirmButtonText: 'Aceptar'
                                                });
                                                return;
                                            } else {
                                                Swal.fire({
                                                    title: 'Error',
                                                    text: 'Error al verificar los registros en la base de datos.',
                                                    icon: 'error',
                                                    confirmButtonText: 'Aceptar'
                                                });
                                            }
                                        }
                                    });

                                    var registrosExistentes2 = []; // Array para almacenar los registros existentes
                                    $.ajax({
                                        url: '<?php echo base_url('RegulacionController/verificarFundamentos2'); ?>', // Cambia esta URL a la ruta de tu controlador
                                        type: 'GET',
                                        data: { ID_caract: formData.ID_caract }, // Asegúrate de que caracteristicasData esté definido
                                        dataType: 'json',
                                        success: function (response) {
                                            if (response.existenRegistros) {
                                                registrosExistentes2 = response.registrosExistentes; // Almacena los registros existentes
                                            }
                                            var fundamentos = [];
                                            $('#fundamentoTable tbody tr').each(function () {
                                                var idFun = $(this).find('td').eq(0).text();
                                                var nombre = $(this).find('td').eq(1).text();
                                                var articulo = $(this).find('td').eq(2).text();
                                                var link = $(this).find('td').eq(3).text();

                                                // Verifica si el registro ya existe en la base de datos
                                                var existe = registrosExistentes2.some(function (registro) {
                                                    return registro.ID_Fun === idFun;
                                                });

                                                if (!existe) {
                                                    fundamentos.push({
                                                        ID_Fun: idFun,
                                                        Nombre: nombre,
                                                        Articulo: articulo,
                                                        Link: link
                                                    });
                                                }
                                            });
                                            $.ajax({
                                                url: '<?php echo base_url('RegulacionController/InsertarFundamentos'); ?>', // Cambia esta URL a la ruta de tu controlador
                                                type: 'POST',
                                                data: {
                                                    fundamentos: fundamentos,
                                                    ID_caract: formData.ID_caract // Asegúrate de que caracteristicasData esté definido
                                                },
                                                success: function (response) {
                                                    //alert('Fundamentos Registros guardados exitosamente.');
                                                },
                                                error: function () {
                                                    //alert('Error al guardar los registros Fundamentos.');
                                                }
                                            });
                                        },
                                        error: function () {
                                            //alert('Error al verificar los registros en la base de datos.');
                                        }
                                    });

                                    $.ajax({
                                        url: '<?= base_url("RegulacionController/verificarRegistrosEnDeIndice") ?>',
                                        type: 'POST',
                                        data: {
                                            ID_caract: formData.ID_caract
                                        },
                                        dataType: 'json',
                                        success: function (response) {
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
                                                    .each(function () {
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
                                                            // alert
                                                            //     (
                                                            //         'Datos de la tabla insertados correctamente'
                                                            //     );
                                                        } else {
                                                            // alert
                                                            //     (
                                                            //         'Error al insertar los datos de la tabla'
                                                            //     );
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
                                                                        var ID_Padre =
                                                                            $(
                                                                                '#selectIndicePadre'
                                                                            )
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
                                                                            ID_Padre
                                                                        ) {
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
                                                                        // alert
                                                                        //     (
                                                                        //         'Datos de rel_indice insertados correctamente'
                                                                        //     );
                                                                        // Redirigir a la página especificada
                                                                        var idRegulacion =
                                                                            formData
                                                                                .ID_Regulacion;
                                                                        window
                                                                            .location
                                                                            .href =
                                                                            '<?= base_url("RegulacionController/edit_mat/"); ?>' +
                                                                            idRegulacion;
                                                                    } else {
                                                                        // alert
                                                                        //     (
                                                                        //         'Error al insertar los datos de rel_indice'
                                                                        //     );
                                                                        // Redirigir a la página especificada
                                                                        var idRegulacion =
                                                                            formData
                                                                                .ID_Regulacion;
                                                                        window
                                                                            .location
                                                                            .href =
                                                                            '<?= base_url("RegulacionController/edit_mat/"); ?>' +
                                                                            idRegulacion;
                                                                    }
                                                                }
                                                            });
                                                        } else {
                                                            // alert
                                                            //     ('Error al obtener el nuevo ID_Jerarquia: ' +
                                                            //         result
                                                            //         .message
                                                            //     );
                                                        }
                                                    },
                                                    error: function () {
                                                        // alert
                                                        //     (
                                                        //         'Error en la solicitud AJAX para obtener el nuevo ID_Jerarquia.'
                                                        //     );
                                                    }
                                                });
                                            } else {
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
                                                            // alert
                                                            //     (
                                                            //         'Datos de la tabla insertados correctamente'
                                                            //     );
                                                        } else {
                                                            // alert
                                                            //     (
                                                            //         'Error al insertar los datos de la tabla'
                                                            //     );
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
                                                                            var ID_Padre = $(this).find('td').eq(4).text();
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
                                                                        // alert
                                                                        //     (
                                                                        //         'Datos de rel_indice insertados correctamente'
                                                                        //     );
                                                                        // Redirigir a la página especificada
                                                                        var idRegulacion =
                                                                            formData
                                                                                .ID_Regulacion;
                                                                        window
                                                                            .location
                                                                            .href =
                                                                            '<?= base_url("RegulacionController/edit_mat/"); ?>' +
                                                                            idRegulacion;
                                                                    } else {
                                                                        // alert
                                                                        //     (
                                                                        //         'Error al insertar los datos de rel_indice'
                                                                        //     );
                                                                        // Redirigir a la página especificada
                                                                        var idRegulacion =
                                                                            formData
                                                                                .ID_Regulacion;
                                                                        window
                                                                            .location
                                                                            .href =
                                                                            '<?= base_url("RegulacionController/edit_mat/"); ?>' +
                                                                            idRegulacion;
                                                                    }
                                                                }
                                                            });
                                                        } else {
                                                            // alert
                                                            //     ('Error al obtener el nuevo ID_Jerarquia: ' +
                                                            //         result
                                                            //         .message
                                                            //     );
                                                        }
                                                    },
                                                    error: function () {
                                                        // alert
                                                        //     (
                                                        //         'Error en la solicitud AJAX para obtener el nuevo ID_Jerarquia.'
                                                        //     );
                                                    }
                                                });
                                            }
                                        },
                                        error: function () {
                                            // alert(
                                            //     'Error en la solicitud AJAX para verificar registros en de_indice.'
                                            // );
                                        }
                                    });


                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Error al modificar las características: ' + result.message,
                                        icon: 'error',
                                        confirmButtonText: 'Aceptar'
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Error en la solicitud AJAX para modificar las características',
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                });
                            }
                        });
                    } else {
                        // alert('Error al modificar la regulación: ' + result.message);
                    }
                },
                error: function () {
                    // alert('Error en la solicitud AJAX para modificar la regulación');
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
        var lastInsertedIDIndicePadre =
            null; // Variable para almacenar el último ID_IndicePadre insertado
        var lastInsertedIndicePadre =
            null; // Variable para almacenar el último ID_IndicePadre insertado

        $('#guardarIbtn').on('click', function () {
            var inputTexto = $('#inputTexto').val();
            lastInsertedIndicePadre = $('#selectIndicePadre option:selected').text();
            lastInsertedIDIndicePadre = $('#selectIndicePadre').val();
            lastInsertedOrden = $('#inputOrden').val();
            console.log('lastInsetedOrden:', lastInsertedOrden);
            if (inputTexto.trim() === '' || lastInsertedOrden.trim() === '' || lastInsertedOrden == null ) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, complete el campo de texto.'
                });
                return;
            } else {
                $.ajax({
                    url: '<?= base_url('RegulacionController/getMaxValues') ?>',
                    method: 'GET',
                    success: function (data) {
                        var maxValues = JSON.parse(data);

                        if (maxValues.ID_Indice == null || maxValues.Orden == null) {
                            lastInsertedID_Indice = 1;
                            // Verificar si la tabla con id resultTable no está vacía
                            if ($('#resultTable tbody tr').length > 0) {
                                lastInsertedID_Indice = $('#resultTable tbody tr').length + 1;
                            }
                        } else {
                            lastInsertedID_Indice = parseInt(maxValues.ID_Indice) + 1;
                            // Verificar si la tabla con id resultTable no está vacía
                            if ($('#resultTable tbody tr').length > 0) {
                                lastInsertedID_Indice = parseInt(maxValues.ID_Indice) + $(
                                    '#resultTable tbody tr').length + 1;
                            }
                        }
                        if (lastInsertedIndicePadre == 'Seleccione un índice padre') {
                            lastInsertedIndicePadre = null;
                        }
                        
                        var rowClass = lastInsertedIndicePadre ? 'child-row' : 'parent-row';

                        var newRow = `<tr class="${rowClass}">
                        <td class="hidden-column">${lastInsertedID_Indice}</td>
                        <td class="texto">${inputTexto}</td>
                        <td class="orden">${lastInsertedOrden}</td>
                        <td class="hidden-column">${lastInsertedIndicePadre || ''}</td>
                        <td class="hidden-column indice-padre">${lastInsertedIDIndicePadre || ''}</td>
                        <td class="text-end">
                            <button class="btn btn-gris btn-sm edit-row me-2" title="Editar"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm delete-row" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                        </td>
                        </tr>`;
                        $('#resultTable tbody').append(newRow);
                        // Cerrar el modal
                        $('#myModal').modal('hide');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                    }
                });
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
                // alert('Por favor, seleccione un índice padre.');
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        var isEditing = false;
        var editingRow = null;
        var other = null;
        var idPadre = null;

        $('#resultTable').on('click', '.edit-row', function () {
            // Establecer el modo de edición
            isEditing = true;
            editingRow = $(this).closest('tr');
            console.log(editingRow);

            // Obtener los datos de la fila
            var texto = editingRow.find('.texto').text();
            var orden = editingRow.find('.orden').text();
            var indicePadre = editingRow.find('.indice-padre').text();
            other = editingRow.find('td').eq(4).text().trim();
            console.log('other:', other);

            // Asignar los datos al modal
            $('#inputTexto').val(texto);
            $('#inputOrden').val(orden);
            $('#selectIndicePadre').val(indicePadre);

            if (indicePadre === '' || indicePadre === 'null') {
                $('#selectIndicePadre').val(other);
                if (other === 'null' || other === '' || other === 'Seleccione un índice padre') {
                    $.ajax({
                        url: '<?= base_url('RegulacionController/get_id_padre') ?>',
                        method: 'POST',
                        data: { texto: texto },
                        success: function (response) {
                            if (response === 'null') {
                                idPadre = null;
                            } else {
                                var data = JSON.parse(response);
                                idPadre = data.ID_Padre;
                                // Seleccionar la opción correspondiente en el select
                                if (idPadre !== null) {
                                    $('#selectIndicePadre').val(idPadre);
                                }
                            }

                            // Abrir el modal
                            $('#myModal').modal('show');
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('AJAX error:', textStatus, errorThrown);
                        }
                    });
                }
            }

            // Abrir el modal
            $('#myModal').modal('show');
            $('#guardarIbtn').off('click').on('click', function () {
                var inputTexto = $('#inputTexto').val();
                var inputOrden = $('#inputOrden').val();
                var selectedIndicePadre = $('#selectIndicePadre').val();

                if (inputTexto.trim() === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor, complete el campo de texto.'
                    });
                    return;
                }
                if (isEditing) {
                    // Actualizar los datos en la base de datos
                    $.ajax({
                        url: '<?= base_url('RegulacionController/updateIndice') ?>',
                        method: 'POST',
                        data: {
                            id: editingRow.find('.hidden-column').first().text(),
                            texto: inputTexto,
                            orden: inputOrden,
                            indicePadre: selectedIndicePadre
                        },
                        success: function (response) {
                            // Actualizar los datos de la fila en modo de edición
                            editingRow.find('.texto').text(inputTexto);
                            editingRow.find('.orden').text(inputOrden);
                            editingRow.find('.indice-padre').text(selectedIndicePadre);

                            // Resetear el modo de edición
                            isEditing = false;
                            editingRow = null;
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('AJAX error:', textStatus, errorThrown);
                        }
                    });
                } else {
                    var inputTexto = $('#inputTexto').val();
                    var lastInsertedIndicePadre = $('#selectIndicePadre option:selected').text();
                    var lastInsertedIDIndicePadre = $('#selectIndicePadre').val();
                    var lastInsertedOrden = $('#inputOrden').val();
                    // Agregar un nuevo índice en modo de creación
                    var inputTexto = $('#inputTexto').val();
                    lastInsertedIndicePadre = $('#selectIndicePadre option:selected').text();
                    lastInsertedIDIndicePadre = $('#selectIndicePadre').val();
                    if (inputTexto.trim() === '' || lastInsertedOrden.trim() === '' || lastInsertedOrden == null) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Por favor, complete el campo de texto. y/o el campo de orden.'
                        });
                        return;
                    } else {
                        $.ajax({
                            url: '<?= base_url('RegulacionController/getMaxValues') ?>',
                            method: 'GET',
                            success: function (data) {
                                var maxValues = JSON.parse(data);

                                if (maxValues.ID_Indice == null || maxValues.Orden == null) {
                                    lastInsertedID_Indice = 1;
                                    // Verificar si la tabla con id resultTable no está vacía
                                    if ($('#resultTable tbody tr').length > 0) {
                                        lastInsertedID_Indice = $('#resultTable tbody tr').length + 1;
                                    }
                                } else {
                                    lastInsertedID_Indice = parseInt(maxValues.ID_Indice) + 1;
                                    // Verificar si la tabla con id resultTable no está vacía
                                    if ($('#resultTable tbody tr').length > 0) {
                                        lastInsertedID_Indice = parseInt(maxValues.ID_Indice) + $(
                                            '#resultTable tbody tr').length + 1;
                                    }
                                }
                                if (lastInsertedIndicePadre == 'Seleccione un índice padre') {
                                    lastInsertedIndicePadre = null;
                                }

                                var rowClass = lastInsertedIndicePadre ? 'child-row' : 'parent-row';

                                var newRow = `<tr class="${rowClass}">
                                <td class="hidden-column">${lastInsertedID_Indice}</td>
                                <td class="texto">${inputTexto}</td>
                                <td class="orden">${lastInsertedOrden}</td>
                                <td class="hidden-column">${lastInsertedIndicePadre || ''}</td>
                                <td class="hidden-column indice-padre">${lastInsertedIDIndicePadre || ''}</td>
                                <td class="text-end">
                                    <button class="btn btn-gris btn-sm edit-row me-2" title="Editar"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm delete-row" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                </td>
                                </tr>`;

                                if (lastInsertedIndicePadre) {
                                    var parentRow = $('#resultTable tbody tr').filter(function () {
                                        return $(this).find('td').eq(0).text() == lastInsertedIDIndicePadre;
                                    });
                                    parentRow.after(newRow);
                                } else {
                                    $('#resultTable tbody').append(newRow);
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.error('AJAX error:', textStatus, errorThrown);
                            }
                        });
                    }
                }

                // Cerrar el modal
                $('#myModal').modal('hide');
            });
        });

        
    });
</script>
<script>
    $(document).ready(function () {
        var isEditing = false;
        var editingRow = null;

        $('#materiasTable').on('click', '.edit-row', function () {
            // Establecer el modo de edición
            isEditing = true;
            // Obtener la fila del botón clicado
            editingRow = $(this).closest('tr');

            // Obtener los datos de la fila
            var materias = editingRow.find('td').eq(1).text();
            var sectores = editingRow.find('td').eq(2).text();
            var sujetosRegulados = editingRow.find('td').eq(3).text();

            // Asignar los datos al modal
            $('#inputMat').val(materias);
            $('#inputSec').val(sectores);
            $('#inputSuj').val(sujetosRegulados);

            // Abrir el modal
            $('#matModal').modal('show');
        });
        // Agregar el nuevo evento click para guardar los cambios
        $('#guardarMat').off('click').on('click', function () {
            var inputMat = $('#inputMat').val();
            var inputSec = $('#inputSec').val();
            var inputSuj = $('#inputSuj').val();

            if (inputMat.trim() === '' || inputSec.trim() === '' || inputSuj.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, complete todos los campos.'
                });
                return;
            }

            if (isEditing) {
                $.ajax({
                    url: '<?= base_url('RegulacionController/updateMatSecSuj') ?>',
                    method: 'POST',
                    data: {
                        id: editingRow.find('.hidden-column').first().text(),
                        mat: inputMat,
                        sec: inputSec,
                        suj: inputSuj
                    },
                    success: function (response) {
                        // Actualizar los datos de la fila en modo de edición
                        editingRow.find('td').eq(1).text(inputMat);
                        editingRow.find('td').eq(2).text(inputSec);
                        editingRow.find('td').eq(3).text(inputSuj);

                        // Resetear el modo de edición
                        isEditing = false;
                        editingRow = null;

                        // Cerrar el modal
                        $('#myModal').modal('hide');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                    }
                });
            } else {
                // Agregar un nuevo registro en modo de creación
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
                // Obtiene los valores de los inputs
                var inputMat = $('#inputMat').val();
                var inputSec = $('#inputSec').val();
                var inputSuj = $('#inputSuj').val();

                if (inputMat.trim() === '' || inputSec.trim() === '' || inputSuj.trim() === '') {
                    if (inputMat.trim() === '') {
                        if ($('#inputMat').next('.error-message').length === 0) {
                            $('#inputMat').after(
                                '<span class="error-message" style="color: red;">El campo "Materias" es obligatorio.</span>'
                            );
                        }
                    }
                    if (inputSec.trim() === '') {
                        if ($('#inputSec').next('.error-message').length === 0) {
                            $('#inputSec').after(
                                '<span class="error-message" style="color: red;">El campo "Sectores" es obligatorio.</span>'
                            );
                        }
                    }
                    if (inputSuj.trim() === '') {
                        if ($('#inputSuj').next('.error-message').length === 0) {
                            $('#inputSuj').after(
                                '<span class="error-message" style="color: red;">El campo "Sujetos Regulados" es obligatorio.</span>'
                            );
                        }
                    }
                    // Prevenir el cierre del modal
                    $('#matModal').modal('show');
                    return;
                } else {
                    // Eliminar los mensajes de error
                    $('.error-message').remove();

                    $('#matModal').modal('hide');
                    // Crea una nueva fila con los datos
                    var newRow = '<tr>' +
                        '<td class="hidden-column">' + idCounter + '</td>' +
                        '<td>' + inputMat + '</td>' +
                        '<td>' + inputSec + '</td>' +
                        '<td>' + inputSuj + '</td>' +
                        '<td class="text-end"><button class="btn btn-gris btn-sm edit-row me-2">' +
                        '<i class="fas fa-edit"></i></button><button class="btn btn-danger btn-sm delete-row" title="Eliminar">' +
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
                }
            }
            // Cerrar el modal
            $('#matModal').modal('hide');
        });
    });
</script>
<script>
    $(document).ready(function () {
        var isEditing = false;
        var editingRow = null;

        $('#fundamentoTable').on('click', '.edit-row', function () {
            // Establecer el modo de edición
            isEditing = true;
            // Obtener la fila del botón clicado
            editingRow = $(this).closest('tr');

            // Obtener los datos de la fila
            var nombre = editingRow.find('td').eq(1).text();
            var articulo = editingRow.find('td').eq(2).text();
            var link = editingRow.find('td').eq(3).text();

            // Asignar los datos al modal
            $('#inputNomReg').val(nombre);
            $('#inputArt').val(articulo);
            $('#inputLink').val(link);

            // Abrir el modal
            $('#funModal').modal('show');
        });
        // Agregar el nuevo evento click para guardar los cambios
        $('#guardarFun').off('click').on('click', function () {
            var inputNomReg = $('#inputNomReg').val();
            var inputArt = $('#inputArt').val();
            var inputLink = $('#inputLink').val();

            if (inputNomReg.trim() === '' || inputArt.trim() === '' || inputLink.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, complete todos los campos.'
                });
                return;
            }
            if (isEditing) {
                $.ajax({
                    url: '<?= base_url('RegulacionController/updateNomRegArtLink') ?>',
                    method: 'POST',
                    data: {
                        id: editingRow.find('.hidden-column').first().text(),
                        nomReg: inputNomReg,
                        art: inputArt,
                        link: inputLink
                    },
                    success: function (response) {
                        // Actualizar los datos de la fila en modo de edición
                        editingRow.find('td').eq(1).text(inputNomReg);
                        editingRow.find('td').eq(2).text(inputArt);
                        editingRow.find('td').eq(3).text(inputLink);

                        // Resetear el modo de edición
                        isEditing = false;
                        editingRow = null;

                        // Cerrar el modal
                        $('#myModal').modal('hide');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                    }
                });
            } else {
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
                // Obtiene los valores de los inputs
                var inputNomReg = $('#inputNomReg').val();
                var inputArt = $('#inputArt').val();
                var inputLink = $('#inputLink').val();

                // Expresión regular para validar URLs
                var urlRegex = /^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-._~:\/?#[\]@!$&'()*+,;=]*)?$/;

                if (inputNomReg.trim() === '' || inputArt.trim() === '' || inputLink.trim() === '') {
                    if (inputNomReg.trim() === '') {
                        
                        $('#inputNomReg').after(
                            '<span class="error-message" style="color: red;">El campo "Nombre de la Regulación" es obligatorio.</span>'
                        );
                    }
                    if (inputArt.trim() === '') {
                        
                        $('#inputArt').after(
                            '<span class="error-message" style="color: red;">El campo "Artículo" es obligatorio.</span>'
                        );
                    }
                    if (inputLink.trim() === '') {
                        
                        $('#inputLink').after(
                            '<span class="error-message" style="color: red;">El campo "Dirección web" es obligatorio.</span>'
                        );
                    }
                    return;
                } else if (!urlRegex.test(inputLink.trim())) {
                    // Validar que el link sea una URL válida
                    
                    $('#inputLink').after(
                        '<span class="error-message" style="color: red;">El campo "Dirección web" debe ser una dirección web válida.</span>'
                    );
                    return;
                } else {
                    // Crea una nueva fila con los datos
                    var newRow = '<tr>' +
                        '<td class="hidden-column">' + idCounter2 + '</td>' +
                        '<td>' + inputNomReg + '</td>' +
                        '<td>' + inputArt + '</td>' +
                        '<td>' + inputLink + '</td>' +
                        '<td class="text-end"><button class="btn btn-gris btn-sm edit-row me-2">' +
                        '<i class="fas fa-edit"></i></button><button class="btn btn-danger btn-sm delete-row" title="Eliminar">' +
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
                }
            }
            // Cerrar el modal
            $('#funModal').modal('hide');
        });
    });
</script>
@endsection