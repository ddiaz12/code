@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones y Visitas Domiciliarias
@endsection
@section('navbar')
@include('templates/navbarAdmin')
@endsection
@section('menu')
@include('templates/menuAdmin')
@endsection
@section('contenido')

<div class="container-fluid" style="margin-top: 20px;">
    <!-- Breadcrumb -->
    <nav class="breadcrumb-container" style="margin-left: -180px; margin-right: 20px; margin-top: 2px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ base_url('home') }}">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">Ayuda</li>
            <li class="breadcrumb-item">Buzón de incidencias</li>
        </ol>
    </nav>

    <div class="content-wrapper" style="margin-top: 20px;">
        <!-- Título -->
        <h1 class="main-title">Registro Estatal de Regulaciones y Visitas Domiciliarias</h1>
        <h2 class="subtitle">Buzón de incidencias</h2>

        <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
            <div class="kt-grid kt-grid--hor kt-grid--root">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                    <div class="kt-content kt-grid__item kt-grid__item--fluid">
                        <div class="kt-portlet mx-auto" style="max-width: 800px; margin-top: 20px;">
                            <div class="kt-portlet__body">
                                <p class="text-muted mb-4 text-center" style="margin-top: 20px;">
                                    Esta Mesa de Ayuda es el recurso principal para obtener apoyo técnico y asistencia por parte del equipo informático de la CONAMER
                                </p>

                                <div class="kt-form kt-form--label-right" style="margin-top: 20px;">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-md-3">
                                            <input type="text" 
                                                class="form-control" 
                                                placeholder="Título de la incidencia">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control">
                                                <option>Todos los estatus</option>
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status }}">{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control">
                                                <option>Todos los proyectos</option>
                                                @foreach($projects as $project)
                                                    <option value="{{ $project }}">{{ $project }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-icon">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg my-4" style="margin-top: 20px;"></div>

                                <!-- Botón Agregar Incidencia -->
                                <div class="text-center text-muted" style="margin-top: 20px;">
                                    <button onclick="showModal()" class="btn" style="background-color: #8E354A; color: white;">
                                        <i class="fa fa-plus"></i> Agregar Incidencia
                                    </button>
                                </div>

                                @if(count($incidents ?? []) === 0)
                                    <div class="text-center text-muted mt-4" style="margin-top: 20px;">
                                        Sin registros
                                    </div>
                                @else
                                    <div class="table-responsive mt-4">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Título</th>
                                                    <th>Proyecto</th>
                                                    <th>Gravedad</th>
                                                    <th>Clasificación</th>
                                                    <th>Fecha de Creación</th>
                                                    <th>Usuario Reporte</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($incidents as $incident)
                                                    @if($incident->ID > 10)
                                                        <tr>
                                                            <td>{{ $incident->Titulo }}</td>
                                                            <td>{{ $incident->Proyectos }}</td>
                                                            <td>{{ $incident->Gravedad }}</td>
                                                            <td>{{ $incident->Clasificación }}</td>
                                                            <td>{{ $incident->Fecha_Creacion }}</td>
                                                            <td>{{ $incident->Usuario_Reporte }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Agregar Incidencia -->
<div id="AgregarIncidencia" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Incidencia</h5>
                <button type="button" class="close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="incidenceForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Título de la incidencia <span class="text-danger">*</span></label>
                        <input type="text" name="title" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Proyecto <span class="text-danger">*</span></label>
                        <select name="project" required class="form-control">
                            <option>Selecciona una opción</option>
                            @foreach($projects as $project)
                                <option value="{{ $project }}">{{ $project }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Reproducible <span class="text-danger">*</span></label>
                        <select name="reproducible" required class="form-control">
                            <option>No aplicable</option>
                            @foreach($reproducibles as $reproducible)
                                <option value="{{ $reproducible }}">{{ $reproducible }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Gravedad <span class="text-danger">*</span></label>
                        <select name="severity" required class="form-control">
                            <option>Selecciona una opción</option>
                            @foreach($severities as $severity)
                                <option value="{{ $severity }}">{{ $severity }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Clasificación <span class="text-danger">*</span></label>
                        <select name="classification" required class="form-control">
                        <option>Selecciona una opción</option>
                            @foreach($classifications as $clasificacion)
                                <option value="{{ $clasificacion }}">{{ $clasificacion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Archivos Anexos <span class="text-danger">*</span></label>
                        <div class="file-upload-area border rounded p-4">
                            <div class="upload-box" style="border: 2px dashed #ccc; padding: 20px;">
                                <div class="text-center">
                                    <p class="text-muted mb-3">Arrastra y suelta tus archivos aquí...</p>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-light" id="selectFilesBtn">
                                            Seleccionar archivos...
                                        </button>
                                        <input type="file" id="fileInput" name="files[]" multiple required accept=".png,.jpg,.jpeg,.pdf,.doc,.docx" style="display: none;">
                                    </div>
                                </div>
                            </div>
                            <div id="fileList" class="mt-3"></div>
                        </div>
                    </div>
                </form>
                <div id="message" class="mt-4"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancelar</button>
                <button type="button" class="btn" style="background-color: #8E354A; color: white;" onclick="submitForm()">
                    Enviar Incidencia
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .container-fluid {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .breadcrumb-container {
        margin-bottom: 20px;
    }

    .main-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
    }

    .subtitle {
        font-size: 18px;
        font-style: italic;
        text-align: center;
        margin-bottom: 30px;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .upload-box {
        background-color: #fff;
        transition: all 0.3s ease;
        cursor: pointer;
        min-height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .upload-box:hover {
        border-color: #8E354A !important;
    }

    .upload-box.dragover {
        background-color: rgba(142, 53, 74, 0.05);
        border-color: #8E354A !important;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
    }

    .badge {
        padding: 0.4em 0.8em;
        font-weight: 500;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(142, 53, 74, 0.05);
    }
</style>

<script>
function showModal() {
    $('#AgregarIncidencia').modal('show');
}

function closeModal() {
    $('#AgregarIncidencia').modal('hide');
}

function submitForm() {
    const form = $('#incidenceForm')[0];
    const formData = new FormData(form);

    $.ajax({
        url: '{{ base_url("ayuda/store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            const res = JSON.parse(response);
            const messageDiv = $('#message');
            if (res.status === 'success') {
                messageDiv.html('<div class="alert alert-success">' + res.message + '</div>');
                form.reset();
                setTimeout(() => {
                    closeModal();
                    messageDiv.html('');
                    location.reload(); // Recargar la página para mostrar la nueva incidencia
                }, 2000);
            } else {
                messageDiv.html('<div class="alert alert-danger">' + res.message + '</div>');
            }
        },
        error: function() {
            $('#message').html('<div class="alert alert-danger">Error al enviar el formulario.</div>');
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const uploadBox = document.querySelector('.upload-box');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');
    const selectFilesBtn = document.getElementById('selectFilesBtn');

    selectFilesBtn.addEventListener('click', () => fileInput.click());

    uploadBox.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadBox.classList.add('dragover');
    });

    uploadBox.addEventListener('dragleave', () => {
        uploadBox.classList.remove('dragover');
    });

    uploadBox.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadBox.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        fileList.innerHTML = '';
        Array.from(files).forEach(file => {
            const item = document.createElement('div');
            item.className = 'alert alert-light d-flex align-items-center mt-2';
            item.innerHTML = `
                <i class="fas fa-file mr-2"></i>
                <span>${file.name}</span>
                <small class="ml-auto">${(file.size/1024).toFixed(1)} KB</small>
            `;
            fileList.appendChild(item);
        });
    }
});
</script>

@endsection
@section('footer')
@include('templates/footer')
@endsection