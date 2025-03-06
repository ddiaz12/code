$(document).ready(function() {
    // Mostrar/ocultar "¿Cuáles Sujetos Obligados?"
    $('select[name="Otros_Sujetos_Participan"]').change(function () {
        if ($(this).val() == 'si') {
            $('#sujetosObligados').show();
            $('input[name="Buscar_Sujeto_Obligado"]').attr('required', true);
        } else {
            $('#sujetosObligados').hide();
            $('input[name="Buscar_Sujeto_Obligado"]').removeAttr('required');
        }
    });

    // Ejecutar al cargar la página
    if ($('select[name="Otros_Sujetos_Participan"]').val() == 'si') {
        $('#sujetosObligados').show();
        $('input[name="Buscar_Sujeto_Obligado"]').attr('required', true);
    }

    // Modal "Buscar Sujetos"
    $('#buscarSujetosBtn').click(function() {
        $('#sujetosModal').modal('show');
    });

    $('.seleccionarSujetoBtn').click(function() {
        var sujeto = $(this).data('sujeto');
        $('input[name="Buscar_Sujeto_Obligado"]').val(sujeto);
        $('#sujetosModal').modal('hide');
    });

    $('#aceptarSujetoBtn').click(function() {
        $('#sujetosModal').modal('hide');
    });

    $('#buscarSujetosInput').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        $.ajax({
            url: '<?= base_url("InspeccionesController/buscarSujetosObligados") ?>',
            type: 'POST',
            data: { search_term: searchTerm },
            dataType: 'json',
            success: function(data) {
                console.log('Datos de sujetos obligados:', data); // Verificar la respuesta en la consola
                $('#sujetosTable tbody').empty();
                if (data.length > 0) {
                    data.forEach(function(sujeto) {
                        $('#sujetosTable tbody').append(
                            '<tr>' +
                                '<td>' + sujeto.nombre_sujeto + '</td>' +
                                '<td>' +
                                    '<button type="button" class="btn btn-primary seleccionarSujetoBtn" data-sujeto="' + sujeto.nombre_sujeto + '">Seleccionar</button>' +
                                '</td>' +
                            '</tr>'
                        );
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Sujeto Obligado no encontrado',
                        confirmButtonColor: '#8E354A'
                    });
                }
            }
        });
    });

    // Derechos
    $('#agregarDerechoBtn').click(function() {
        var derecho = $('input[name="Derecho_Sujeto_Regulado"]').val();
        if (derecho) {
            $('#derechosList').append(
                '<li class="list-group-item">'
                    + derecho +
                    '<button type="button" class="btn btn-danger btn-sm float-right quitarDerechoBtn">Quitar</button>'
                + '</li>'
            );
            $('input[name="Derecho_Sujeto_Regulado"]').val('');
        }
    });

    $('#derechosList').on('click', '.quitarDerechoBtn', function() {
        $(this).parent().remove();
    });

    // Obligaciones
    $('#agregarObligacionBtn').click(function() {
        var obligacion = $('input[name="Obligacion_Sujeto_Regulado"]').val();
        if (obligacion) {
            $('#obligacionesList').append(
                '<li class="list-group-item">'
                    + obligacion +
                    '<button type="button" class="btn btn-danger btn-sm float-right quitarObligacionBtn">Quitar</button>'
                + '</li>'
            );
            $('input[name="Obligacion_Sujeto_Regulado"]').val('');
        }
    });

    $('#obligacionesList').on('click', '.quitarObligacionBtn', function() {
        $(this).parent().remove();
    });

    // Firmar Formato
    $('select[name="Firmar_Formato"]').change(function() {
        if ($(this).val() == 'si') {
            $('#formatoUpload').show();
            $('input[name="Archivo_Formato"]').attr('required', true);
        } else {
            $('#formatoUpload').hide();
            $('input[name="Archivo_Formato"]').removeAttr('required');
        }
    });

    // Ejecutar al cargar la página
    if ($('select[name="Firmar_Formato"]').val() == 'si') {
        $('#formatoUpload').show();
        $('input[name="Archivo_Formato"]').attr('required', true);
    }

    // Validar tipo de archivo
    $('input[name="Archivo_Formato"]').on('change', function() {
        let file = this.files[0];
        if (file) {
            let allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
            if (allowedTypes.indexOf(file.type) === -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Formato inválido',
                    text: 'Solo se permiten archivos JPG, PNG o PDF.',
                    confirmButtonColor: '#8E354A'
                });
                $(this).val(''); // Reinicia el input
            }
        }
    });

    console.log("inf_sobre_inspeccion.js iniciado");

    // Verificar e imprimir en consola los valores iniciales de los campos requeridos y visibles en este step
    $('#step-inf_sobre_inspeccion [required]:visible').each(function() {
        console.log('Inf_Sobre_Inspeccion: Validating field:', $(this).attr('name'), 'Value:', $(this).val());
    });
});
