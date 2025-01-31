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
<!-- Contenido -->
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4 mt-5">
        <li class="breadcrumb-item"><a href="<?php echo base_url("home") ?>"><i class="fas fa-home me-1"></i>Inicio</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-file-alt me-1"></i>Guías</li>
    </ol>
    <h1 class="mt-4 titulo-menu">Guías</h1>

    <!-- Formulario para subir archivos PDF -->
    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <div class="row justify-content-start">
                <form id="uploadForm" class="col-md-12 mb-4" enctype="multipart/form-data">
                    <div class="input-group">
                        <input type="file" name="userfile" class="form-control" accept="application/pdf" required>
                        <button type="submit" class="btn btn-tinto">Subir</button>
                    </div>
                </form>
            </div>

            <!-- Tabla para mostrar PDFs -->
            <table id="datatablesSimple" class="table-striped">
                <thead>
                    <tr>
                        <th class="tTabla-color text-center">Nombre</th>
                        <th class="tTabla-color text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Filas generadas dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para visualizar PDF -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Visualizar PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfViewer" src="" width="100%" height="500px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>


@endsection
@section('footer')
@include('templates/footer')
@endsection

@section('js')
<script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/buscarComentario.js'); ?>"></script>
<script>
    $(document).ready(function () {
        // Inicializar DataTable
        var table = $('#datatablesSimple').DataTable();

        // Cargar la lista de archivos al cargar la página
        mostrarPantallaDeCarga();
        $.ajax({
            url: '<?= base_url("Guia/list") ?>', // Cambia por tu ruta
            type: 'GET',
            success: function (response) {
                ocultarPantallaDeCarga();
                if (response.success) {
                    response.data.forEach(function (file) {
                        agregarFila(file);
                    });
                } else {
                    Swal.fire('Error', response.message || 'Ocurrió un error al cargar los archivos.', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'No se pudo cargar la lista de archivos.', 'error');
            }
        });
        // Manejar la carga de archivos
        $('#uploadForm').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            mostrarPantallaDeCarga();
            $.ajax({
                url: '<?= base_url("Guia/upload_pdf") ?>', // Cambia por tu ruta
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    ocultarPantallaDeCarga();
                    if (response.success) {
                        Swal.fire('Éxito', 'Archivo subido correctamente.', 'success').then(() => {
                            location.reload(); // Recargar la página
                        });
                    } else {
                        Swal.fire('Error', response.message || 'Ocurrió un error.', 'error');
                    }
                },
                error: function () {
                    ocultarPantallaDeCarga();
                    Swal.fire('Error', 'No se pudo subir el archivo.', 'error');
                }
            });
        });

        
        // Función para agregar una fila en la tabla
        function agregarFila(data) {
            table.row.add([
                data.nombre,
                `<div class="text-end">
                <button class="btn btn-tinto btn-sm ver-pdf" data-url="${data.url}"><i class="fas fa-eye"></i> Ver</button>
                <a href="${data.url}" class="btn btn-gris btn-sm" target="_blank"><i class="fas fa-download"></i> Descargar</a>
                <button class="btn btn-danger btn-sm eliminar-pdf" data-nombre="${data.nombre}"><i class="fas fa-trash"></i> Eliminar</button>
                </div>`
            ]).draw(false);
        }

        // Manejar el evento para visualizar PDFs
        $('#datatablesSimple').on('click', '.ver-pdf', function () {
            var pdfUrl = $(this).data('url');
            $('#pdfViewer').attr('src', pdfUrl);
            $('#pdfModal').modal('show');
        });

        // Manejar el evento para eliminar PDFs
        $('#datatablesSimple').on('click', '.eliminar-pdf', function () {
            var fileName = $(this).data('nombre');
            var row = $(this).closest('tr');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("Guia/delete") ?>', // Cambia por tu ruta
                        type: 'POST',
                        data: { nombre: fileName },
                        success: function (response) {
                            if (typeof response === 'string') {
                                response = JSON.parse(response);
                            }

                            if (response.success) {
                                Swal.fire('Eliminado', response.message, 'success');
                                table.row(row).remove().draw();
                            } else {
                                Swal.fire('Error', response.message || 'Ocurrió un error.', 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error', 'No se pudo eliminar el archivo.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection