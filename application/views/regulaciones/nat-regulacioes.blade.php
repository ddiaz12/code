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
                            <div class="row justify-content-center">
                                <label for="SubsectorInput">Subsector<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="SubsectorInput" name="SubsectorInput"
                                    placeholder="Selecciona una opcion" required>
                            </div>
                            <div class="row justify-content-center">
                                <label for="RamaInput">Rama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="RamaInput" name="RamaInput"
                                    placeholder="Selecciona una opcion" required>
                            </div>
                            <div class="row justify-content-center">
                                <label for="SubramaInput">Subrama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="SubramaInput" name="SubramaInput"
                                    placeholder="Selecciona una opcion" required>
                            </div>
                            <div class="row justify-content-center">
                                <label for="ClaseInput">Clase<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ClaseInput" name="ClaseInput"
                                    placeholder="Selecciona una opcion" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputVinculadas">Regulaciones vinculadas o derivadas de esta
                                regulación<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputVinculadas" name="vinculadas"
                                placeholder="Regulaciones Vinculadas" required>
                        </div>
                        <div class="form-group">
                            <label for="inputEnlace">Enlace oficial de la regulación<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEnlace" name="EnlaceOficial"
                                placeholder="http://" required>
                        </div>
                        <div class="form-group">
                            <label for="radioGroup">Tipo de documento:</label>
                            <div id="radioGroup">
                                <input type="radio" id="documento" name="opcion" value="documento">
                                <label for="documento">Documento</label>
                                <input type="radio" id="liga" name="opcion" value="liga">
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
                            $(document).ready(function () {
                                $('input[type=radio][name=opcion]').change(function () {
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
                        $(document).ready(function () {
                            $('input[type=radio][name=opcion]').change(function () {
                                if (this.value == 'si') {
                                    $('#inputs').show();
                                } else if (this.value == 'no') {
                                    $('#inputs').hide();
                                }
                            });
                        });
                    </script>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" class="btn btn-success btn-guardar">Guardar</button>
                        <a href="<?php echo base_url('oficinas/oficina'); ?>"
                            class="btn btn-secondary me-2">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let selectedSectors = [];

        $('#SectorInput').on('keyup', function () {
            let searchTerm = $(this).val();
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

        $('#sectorResults').on('click', 'li', function () {
            let sectorId = $(this).data('id');
            let sectorName = $(this).text();
            selectedSectors.push({
                ID_sector: sectorId,
                Nombre_Sector: sectorName
            });
            console.log(selectedSectors);
            // Ocultar la lista y borrar el texto del input
            $('#sectorResults').empty();
            $('#SectorInput').val('');
        });
    });
</script>
@endsection