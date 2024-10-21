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
    <li class="breadcrumb-item"><a href="<?php echo base_url('PublicadasController'); ?>"><i
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
                <div class="card flex-grow-1">
                    <div class="card" style="border: none;">
                        <div class="card-body" style="border: none;">
                            <ul class="list-unstyled lista-regulacion">
                                <li class="iconos-regulacion">
                                    <a href="<?php echo base_url('PublicadasController/edit_public_caract/' . $regulacion['ID_Regulacion']); ?>"
                                        class="custom-link">
                                        <i class="fa-solid fa-list-check fa-sm"></i>
                                        <label class="menu-regulacion" for="image_1">Características de la
                                            Regulación</label>
                                    </a>
                                </li>
                                <p></p>
                                <li class="iconos-regulacion">
                                    <a href="<?php echo base_url('PublicadasController/edit_nat/' . $regulacion['ID_Regulacion']); ?>"
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
                                placeholder="http://" value="<?= isset($enlace_oficial) ? $enlace_oficial : '' ?>"
                                required>
                        </div>
                        <div>
                            <p></p>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <p id="tramitesText">Tramites y servicios</p>
                            <button type="submit" id="botonTramites"
                                class="btn btn-success btn-tramites">Tramites</button>
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
                                                    <label for="inputTram">Nombre</label>
                                                    <input type="text" class="form-control" id="inputTram"
                                                        placeholder="Ingrese el Nombre" name="NombreTram">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDir">Direccion</label>
                                                    <input type="text" class="form-control" id="inputDir"
                                                        placeholder="http://" name="NombreDir">
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
                        <table id="tramitesTable" class="table">
                            <thead>
                                <tr>
                                    <th>ID_Tramites</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($tramites)): ?>
                                <?php foreach ($tramites as $tramite): ?>
                                <tr>
                                    <td><?php echo $tramite['ID_Tramites']; ?></td>
                                    <td><?php echo $tramite['Nombre']; ?></td>
                                    <td><?php echo $tramite['Direccion']; ?></td>
                                    <td><button class="btn btn-danger btn-sm delete-row"><i class="fas fa-trash-alt"></i></button></td>
                                    <!-- Agrega más celdas según sea necesario -->
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <p><label for="file">
                                    <h7>Subir Documento</h7>
                                </label></p>
                            <input type="file" class="form-control-file" id="userfile" name="userfile">
                            <br>
                            <!-- Mostrar el nombre del archivo actual -->
                            <?php if (!empty($natreg2->file_path)): ?>
                            <small id="current_file" class="form-text text-muted">
                                Archivo actual: <?php    echo basename($natreg2->file_path); ?>
                            </small>
                            <br>
                            <!-- Mostrar el archivo actual (puede ser una imagen o un PDF) -->
                            <?php    if (preg_match('/\.(jpg|jpeg|png)$/i', $natreg2->file_path)): ?>
                            <img src="<?php        echo base_url('assets/ftp/' . basename($natreg2->file_path)); ?>"
                                alt="Imagen actual" class="img-fluid">
                            <?php    elseif (preg_match('/\.(pdf)$/i', $natreg2->file_path)): ?>
                            <a href="<?php        echo base_url('assets/ftp/' . basename($natreg2->file_path)); ?>"
                                target="_blank">Ver documento PDF actual</a>
                            <?php    endif; ?>
                            <?php endif; ?>

                            <br>
                            <small id="msg_file" class="text-danger"></small>
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
    $('.btn-tramites').click(function() {
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
$(document).ready(function() {
    // Obtener el id_regulacion de la vista
    var id_regulacion = <?= json_encode($regulacion['ID_Regulacion']) ?>;
    console.log('ID_Regulacion:', id_regulacion);

    // Realizar la solicitud AJAX para verificar el sector
    $.ajax({
        url: '<?= base_url("PublicadasController/verificarSector") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                // Si el campo ID_sector no es nulo, marcar el radio button con id "si"
                $('#si').prop('checked', true);
                $('#inputs').show();
                $('#selectedSectorsTable').show();
                $('#selectedSubsectorsTable').show();
                $('#selectedRamasTable').show();
                $('#selectedSubramasTable').show();
                $('#selectedClasesTable').show();
            }
        },
        error: function() {
            console.error('Error en la solicitud AJAX para verificar el sector.');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Obtener el id_regulacion de la vista
    var id_regulacion = <?= json_encode($regulacion['ID_Regulacion']) ?>;

    // Realizar la solicitud AJAX para obtener los sectores
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerSectoresPorRegulacion") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('Nombres de sectores obtenidos:', response);

            // Limpiar el tbody de la tabla
            $('#selectedSectorsTable tbody').empty();

            // Agregar los nombres de los sectores a la tabla
            response.forEach(function(sector) {
                $('#selectedSectorsTable tbody').append('<tr><td>' + sector.Nombre_Sector +
                    '<td><button class="btn btn-danger btn-sm delete-row">' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>');
            });
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener los sectores.');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Obtener el id_regulacion de la vista
    var id_regulacion = <?= json_encode($regulacion['ID_Regulacion']) ?>;

    // Realizar la solicitud AJAX para obtener los subsectors
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerSubsectoresPorRegulacion") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('Nombres de subsectors obtenidos:', response);

            // Limpiar el tbody de la tabla
            $('#selectedSubsectorsTable tbody').empty();

            // Agregar los nombres de los subsectors a la tabla
            response.forEach(function(subsector) {
                $('#selectedSubsectorsTable tbody').append('<tr><td>' + subsector
                    .Nombre_Subsector +
                    '<td><button class="btn btn-danger btn-sm delete-row">' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>');
            });

            // Mostrar la tabla si tiene datos
            if (response.length > 0) {
                $('#selectedSubsectorsTable').show();
            }
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener los subsectors.');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Obtener el id_regulacion de la vista
    var id_regulacion = <?= json_encode($regulacion['ID_Regulacion']) ?>;

    // Realizar la solicitud AJAX para obtener las ramas
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerRamasPorRegulacion") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('Nombres de ramas obtenidos:', response);

            // Limpiar el tbody de la tabla
            $('#selectedRamasTable tbody').empty();

            // Agregar los nombres de las ramas a la tabla
            response.forEach(function(rama) {
                $('#selectedRamasTable tbody').append('<tr><td>' + rama.Nombre_Rama +
                    '<td><button class="btn btn-danger btn-sm delete-row">' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>');
            });

            // Mostrar la tabla si tiene datos
            if (response.length > 0) {
                $('#selectedRamasTable').show();
            }
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener las ramas.');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Obtener el id_regulacion de la vista
    var id_regulacion = <?= json_encode($regulacion['ID_Regulacion']) ?>;

    // Realizar la solicitud AJAX para obtener las subramas
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerSubramasPorRegulacion") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('Nombres de subramas obtenidos:', response);

            // Limpiar el tbody de la tabla
            $('#selectedSubramasTable tbody').empty();

            // Agregar los nombres de las subramas a la tabla
            response.forEach(function(subrama) {
                $('#selectedSubramasTable tbody').append('<tr><td>' + subrama
                    .Nombre_Subrama +
                    '<td><button class="btn btn-danger btn-sm delete-row">' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>');
            });

            // Mostrar la tabla si tiene datos
            if (response.length > 0) {
                $('#selectedSubramasTable').show();
            }
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener las subramas.');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Obtener el id_regulacion de la vista
    var id_regulacion = <?= json_encode($regulacion['ID_Regulacion']) ?>;

    // Realizar la solicitud AJAX para obtener las clases
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerClasesPorRegulacion") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('Nombres de clases obtenidos:', response);

            // Limpiar el tbody de la tabla
            $('#selectedClasesTable tbody').empty();

            // Agregar los nombres de las clases a la tabla
            response.forEach(function(clase) {
                $('#selectedClasesTable tbody').append('<tr><td>' + clase.Nombre_Clase +
                    '<td><button class="btn btn-danger btn-sm delete-row">' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>');
            });

            // Mostrar la tabla si tiene datos
            if (response.length > 0) {
                $('#selectedClasesTable').show();
            }
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener las clases.');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Obtener el id_regulacion de la vista
    var id_regulacion = <?= json_encode($regulacion['ID_Regulacion']) ?>;
    var newIdTramites = 1;

    // Realizar la solicitud AJAX para obtener las regulaciones
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerRegulacionesPorNat") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('Nombres de regulaciones obtenidos:', response);

            // Limpiar el tbody de la tabla
            $('#selectedRegulacionesTable tbody').empty();

            // Agregar los nombres de las regulaciones a la tabla
            response.forEach(function(regulacion) {
                $('#selectedRegulacionesTable tbody').append('<tr><td>' + regulacion
                    .Nombre_Regulacion +
                    '<td><button class="btn btn-danger btn-sm delete-row">' +
                    '<i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>');
            });

            // Mostrar la tabla si tiene datos
            if (response.length > 0) {
                $('#selectedRegulacionesTable').show();
            }
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener las regulaciones.');
        }
    });
});
</script>
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
var idSectores = [];
var idSubsectores = [];
var idRamas = [];
var idSubramas = [];
var idClases = [];
var idRegulaciones = [];

// Aqui se hace la busqueda de los sectores y se muestran en una lista
$(document).ready(function() {

    // Obtener el id_regulacion de la vista
    var id_regulacion = <?= json_encode($regulacion['ID_Regulacion']) ?>;
    var id_nat = <?= json_encode($id_nat) ?>;

    // Realizar la solicitud AJAX para obtener los ID de los sectores
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerIdSectoresPorRegulacion") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('ID de sectores obtenidos:', response);

            // Guardar los ID de los sectores en un array
            idSectores = response.map(function(sector) {
                return sector.ID_Sector;
            });

            // Imprimir los ID de los sectores en la consola
            console.log('Array de ID de sectores:', idSectores);
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener los ID de los sectores.');
        }
    });

    // Realizar la solicitud AJAX para obtener los ID de los subsectores
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerIdSubsectoresPorRegulacion") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('ID de subsectores obtenidos:', response);

            // Guardar los ID de los subsectores en un array
            idSubsectores = response.map(function(subsector) {
                return subsector.ID_Subsector;
            });

            // Imprimir los ID de los subsectores en la consola
            console.log('Array de ID de subsectores:', idSubsectores);
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener los ID de los sectores.');
        }
    });

    // Realizar la solicitud AJAX para obtener los ID de las ramas
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerIdRamasPorRegulacion") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('ID de ramas obtenidos:', response);

            // Guardar los ID de las ramas en un array
            idRamas = response.map(function(rama) {
                return rama.ID_Rama;
            });

            // Imprimir los ID de las ramas en la consola
            console.log('Array de ID de ramas:', idRamas);
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener los ID de las ramas.');
        }
    });

    // Realizar la solicitud AJAX para obtener los ID de las subramas
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerIdSubramasPorRegulacion") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('ID de subramas obtenidos:', response);

            // Guardar los ID de las subramas en un array
            idSubramas = response.map(function(subrama) {
                return subrama.ID_Subrama;
            });

            // Imprimir los ID de las subramas en la consola
            console.log('Array de ID de subramas:', idSubramas);
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener los ID de las subramas.');
        }
    });

    // Realizar la solicitud AJAX para obtener los ID de las clases
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerIdClasesPorRegulacion") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('ID de clases obtenidos:', response);

            // Guardar los ID de las clases en un array
            var idClases = response.map(function(clase) {
                return clase.ID_Clase;
            });

            // Imprimir los ID de las clases en la consola
            console.log('Array de ID de clases:', idClases);
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener los ID de las clases.');
        }
    });

    // Realizar la solicitud AJAX para obtener los ID de las regulaciones
    $.ajax({
        url: '<?= base_url("PublicadasController/obtenerIdRegulacionesPorNat") ?>',
        type: 'POST',
        data: {
            id_regulacion: id_regulacion
        },
        dataType: 'json',
        success: function(response) {
            console.log('ID de regulaciones obtenidos:', response);

            // Guardar los ID de las regulaciones en un array
            idRegulaciones = response.map(function(regulacion) {
                return regulacion.ID_Regulacion;
            });

            // Imprimir los ID de las regulaciones en la consola
            console.log('Array de ID de regulaciones por nat:', idRegulaciones);
        },
        error: function() {
            console.error('Error en la solicitud AJAX para obtener los ID de las regulaciones.');
        }
    });

    $('#SectorInput').on('keyup', function() {
        let searchTerm = $(this).val();
        $.ajax({
            url: '<?= base_url('PublicadasController/search_sector') ?>',
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
            url: '<?= base_url('PublicadasController/search_subsector') ?>',
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
            url: '<?= base_url('PublicadasController/search_rama') ?>',
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
            url: '<?= base_url('PublicadasController/search_subrama') ?>',
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
            url: '<?= base_url('PublicadasController/search_clase') ?>',
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
            url: '<?= base_url('PublicadasController/search_regulacion') ?>',
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
        console.log('selected regulaciones', selectedRegulaciones);

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
    // Obtener el último ID_Tramites de la tabla
    var lastIdTramites = $('#tramitesTable tbody tr:last td:first').text();
    var newIdTramites = lastIdTramites ? parseInt(lastIdTramites) + 1 : 1;
    $.ajax({
        url: '<?= base_url('PublicadasController/verificarTramites') ?>',
        type: 'GET',
        data: { ID_Nat : id_nat },
        dataType: 'json',
        success: function(response) {
            if (response.existenRegistros) {
                ID_Tramites = parseInt(response.ultimoID, 10) + 1; // Inicializa el contador con el último ID + 1
                registrosExistentes = response.registrosExistentes;
            }
        },
        error: function() {
            alert('Error al verificar los registros en la base de datos.');
        }
    });

    $('#guardarIbtn').on('click', function() {
        var inputTram = $('#inputTram').val();
        var inputDir = $('#inputDir').val();

        // Verificar campos obligatorios
        if (inputTram === '' || inputDir === '') {
            alert('Por favor, complete los campos obligatorios');
            return;
        }

        // Insertar el nuevo registro en la tabla
        var newRow = '<tr><td>' +
            newIdTramites +
            '</td><td>' +
            inputTram +
            '</td><td>' +
            inputDir +
            '</td><td><button class="btn btn-danger btn-sm delete-row"><i class="fas fa-trash-alt"></i></button></td></tr>';
        $('#tramitesTable tbody').append(newRow);

        // Incrementa el contador de ID_Fun
        newIdTramites++;

        // Limpia los valores de los inputs
        $('#inputTram').val('');
        $('#inputDir').val('');
    });
    // Maneja el evento de clic para eliminar una fila
    $('#tramitesTable').on('click', '.delete-row', function() {
        var row = $(this).closest('tr');
        var idTram = row.find('td').eq(0).text();

        // Mostrar ventana de confirmación
        if (confirm('¿Estás seguro de que quieres eliminar este registro?')) {
            // Realiza una solicitud AJAX para eliminar el registro de la base de datos
            $.ajax({
                url: '<?= base_url('PublicadasController/eliminarTramite') ?>',
                type: 'POST',
                data: { ID_Tramites: idTram },
                success: function(response) {
                    if (response.status === 'success') {
                        // Elimina la fila de la tabla
                        row.remove();
                        newIdTramites--;
                    } else {
                        //es un registro nuevo que no se ha guardado en la base de datos
                        row.remove();
                        newIdTramites--;
                    }
                },
                error: function() {
                    alert('Error al eliminar el registro de la base de datos.');
                }
            });
        }
    });

    //aqui guardamos los datos
    $('#btnGnat').on('click', function() {
        var formData = new FormData($('#formGnat')[0]);

        var filteredSectors = selectedSectorsIds.filter(function(sectorId) {
            return !idSectores.includes(sectorId);
        });
        console.log('sectores filtrados', filteredSectors);

        var filteredSubsectors = selectedSubsectorsIds.filter(function(subsectorId) {
            return !idSubsectores.includes(subsectorId);
        });
        console.log('subsectores filtrados', filteredSubsectors);

        var filteredRamas = selectedRamasIds.filter(function(ramaId) {
            return !idRamas.includes(ramaId);
        });
        console.log('ramas filtradas', filteredRamas);

        var filteredSubramas = selectedSubramasIds.filter(function(subramaId) {
            return !idSubramas.includes(subramaId);
        });
        console.log('subramas filtradas', filteredSubramas);

        var filteredClases = selectedClasesIds.filter(function(claseId) {
            return !idClases.includes(claseId);
        });
        console.log('clases filtradas', filteredClases);

        var filteredRegulaciones = selectedRegulaciones.filter(function(regulacionId) {
            return !idRegulaciones.includes(regulacionId);
        });
        console.log('clases filtradas', filteredRegulaciones);

        // Agregar idRegulacion al formData
       
        formData.append('idRegulacion', id_regulacion);

        formData.append('idNaturaleza', id_nat);

        if ($('#no').is(':checked')) {
            formData.append('btn_clicked', true);
            formData.append('radio_no_selected', true);
            formData.append('inputEnlace', $('#inputEnlace').val());
            formData.append('iNormativo', iNormativo);
            formData.append('selectedRegulaciones', JSON.stringify(selectedRegulaciones));
            formData.append('url', $('#url').val());
        } else if ($('#si').is(':checked')) {
            formData.append('btn_clicked', true);
            formData.append('radio_si_selected', true);
            formData.append('inputEnlace', $('#inputEnlace').val());
            formData.append('iNormativo', iNormativo);
            formData.append('selectedRegulaciones', JSON.stringify(selectedRegulaciones));
            formData.append('selectedSectors', JSON.stringify(selectedSectorsIds));
            formData.append('selectedSubsectors', JSON.stringify(selectedSubsectorsIds));
            formData.append('selectedRamas', JSON.stringify(selectedRamasIds));
            formData.append('selectedSubramas', JSON.stringify(selectedSubramasIds));
            formData.append('selectedClases', JSON.stringify(selectedClasesIds));
            formData.append('url', $('#url').val());
        }
        var registrosExistentes = []; // Array para almacenar los registros existentes
        // Realiza una solicitud AJAX para obtener los registros existentes en la base de datos
        $.ajax({
            url: '<?php echo base_url('PublicadasController/verificarTramites'); ?>', // Cambia esta URL a la ruta de tu controlador
            type: 'GET',
            data: { ID_Nat : id_nat }, // Asegúrate de que caracteristicasData esté definido
            dataType: 'json',
            success: function(response) {
                if (response.existenRegistros) {
                    registrosExistentes = response.registrosExistentes; // Almacena los registros existentes
                }
                // Extraer registros de la tabla tramitesTable
                var tramites = [];
                $('#tramitesTable tbody tr').each(function() {
                    var idTramites = $(this).find('td').eq(0).text();
                    var nombre = $(this).find('td').eq(1).text();
                    var direccion = $(this).find('td').eq(2).text();

                    // Verifica si el registro ya existe en la base de datos
                    var existe = registrosExistentes.some(function(registro) {
                        return registro.ID_Tramites === idTramites;
                    });

                    if (!existe) {
                        tramites.push({
                            Nombre: nombre,
                            Direccion: direccion
                        });
                    }
                });
                // Agregar el array tramites al formData
                formData.append('tramites', JSON.stringify(tramites));
                console.log('formData:', formData.get('tramites'));
                console.log('registrosExistentes:', registrosExistentes);

                $.ajax({
                    url: '<?= base_url('PublicadasController/save_naturaleza_regulacion2') ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        console.log('Respuesta del servidor:', response);
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: 'Datos guardados exitosamente',
                            }).then(() => {
                                window.location.href =
                                    '<?= base_url('PublicadasController') ?>';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al guardar los datos: ' + response.message,
                            }).then(() => {
                                window.location.href =
                                    '<?= base_url('PublicadasController') ?>';
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la solicitud AJAX:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error en la solicitud AJAX: ' + error,
                        });
                    }
                });
            },
            error: function() {
                alert('Error al verificar los registros en la base de datos.');
            }
        });
        
        

        
        
    });
});
</script>
@endsection
</body>