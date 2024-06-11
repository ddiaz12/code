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
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
        </li>
        <li class="breadcrumb-item"><a href="<?php echo base_url('regulaciones'); ?>"><i class="fas fa-file-alt me-1"></i>Regulaciones</a>
        </li>
        <li class="breadcrumb-item active"><i class="fa-solid fa-plus-circle"></i>Agregar regulación
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
                                        <a href="<?php echo base_url('regulaciones/caracteristicas_reg'); ?>" class="custom-link">
                                            <i class="fa-solid fa-list-check"></i>
                                            <label for="image_1">Características de la Regulación</label>
                                        </a>
                                    </li>
                                    <p></p>
                                    <li>
                                        <a href="<?php echo base_url('regulaciones/mat_exentas'); ?>" class="custom-link">
                                            <i class="fa-solid fa-table-list"></i>
                                            <label for="image_2">Materias Exentas</label>
                                        </a>
                                    </li>
                                    <p></p>
                                    <li>
                                        <a href="<?php echo base_url('regulaciones/nat_regulaciones'); ?>" class="custom-link">
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

                                <!-- Formulario de agregar oficina -->
                                <form class="row g-3" action="<?php echo base_url('ofincinas/insertar'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="inputNombre">Nombre<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputNombre" name="nombre"
                                            placeholder="Nombre de la regulacion" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="selectSujeto">Ambito de Aplicacion<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="selectSujeto" name="sujeto" required>
                                            <option disabled selected>Selecciona una opción</option>
                                            @foreach ($sujetos as $sujeto)
                                                <option value="{{ $sujeto->ID_ofic }}">{{ $sujeto->Nombre_Sujeto }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="selectUnidad">Tipo de ordenamiento jurídico<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="selectUnidad" name="unidad" required>
                                            <option disabled selected>Selecciona una opción</option>
                                            @foreach ($sujetos as $sujeto)
                                                <option value="{{ $sujeto->ID_ofic }}">
                                                    {{ $sujeto->unidad_Administrativa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputFecha">Fecha de publicación de la regulación<span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="inputFecha" name="fecha_expedicion"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputFecha">Fecha de última actualización<span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="inputFecha" name="fecha_expedicion"
                                            required>
                                    </div>

                                    <form>
                                        <div class="d-flex justify-content-between mb-3">
                                            <div>
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
                                                <input type="date" class="form-control" id="campoExtra" name="campoExtra"
                                                    required>
                                            </div>
                                        </div>


                                    </form>

                                    <div class="form-group">
                                        <label for="inputVialidad">Orden de gobierno que la emite:<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="selectUnidad" name="unidad" required>
                                            <option disabled selected>Selecciona una opción</option>
                                            @foreach ($sujetos as $sujeto)
                                                <option value="{{ $sujeto->ID_ofic }}">
                                                    {{ $sujeto->unidad_Administrativa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="AutoridadesEmiten">Autoridades que emiten la
                                                regulación<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="AutoridadesEmiten"
                                                name="aut_emiten" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <p>Índice de regulación</p>
                                        <button type="submit" class="btn btn-success btn-indice">Indice</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Modal title
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
                                                                    id="inputTexto" placeholder="Ingrese texto">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="selectIndicePadre">Índice
                                                                    Padre</label>
                                                                <select class="form-control" id="selectIndicePadre">
                                                                    <option>Seleccione un índice padre</option>
                                                                    <!-- Opciones de índice padre aquí -->
                                                                </select>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                        <button type="button" class="btn btn-primary">Guardar
                                                            cambios</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- jQuery y Bootstrap JS -->
                                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

                                    <script>
                                        $(document).ready(function() {
                                            $('.btn-indice').click(function() {
                                                $('#myModal').modal('show');
                                            });
                                        });
                                    </script>
                                    <div class="form-group">
                                        <label for="inputObjetivo">Describa el objetivo de la regulación</label>
                                        <textarea class="form-control" id="inputObjetivo" name="objetivoReg"></textarea>
                                    </div>
                                    <p></p>
                                    <div class="d-flex justify-content-end mb-3">
                                        <a href="<?php echo base_url('regulaciones'); ?>" class="btn btn-secondary me-2">Cancelar</a>
                                        <button type="submit" class="btn btn-success btn-guardar">Guardar</button>
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
@endsection
