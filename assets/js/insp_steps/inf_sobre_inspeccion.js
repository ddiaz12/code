$(document).ready(function() {
    // Mostrar/ocultar "¿Cuáles Sujetos Obligados?"
    $('select[name="Otros_Sujetos_Participan"]').change(function () {
        if ($(this).val() == 'si') {
            $('#sujetosObligados').show();
        } else {
            $('#sujetosObligados').hide();
        }
    });

    // Ejecutar al cargar la página
    if ($('select[name="Otros_Sujetos_Participan"]').val() == 'si') {
        $('#sujetosObligados').show();
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
        $('#sujetosTable tbody tr').each(function() {
            var sujetoNombre = $(this).find('td:first').text().toLowerCase();
            if (sujetoNombre.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
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
        } else {
            $('#formatoUpload').hide();
        }
    });

    // Ejecutar al cargar la página
    if ($('select[name="Firmar_Formato"]').val() == 'si') {
        $('#formatoUpload').show();
    }

    console.log("inf_sobre_inspeccion.js iniciado");

    // Verificar e imprimir en consola los valores iniciales de los campos requeridos y visibles en este step
    $('#step-inf_sobre_inspeccion [required]:visible').each(function() {
        console.log('Inf_Sobre_Inspeccion: Validating field:', $(this).attr('name'), 'Value:', $(this).val());
    });
});
