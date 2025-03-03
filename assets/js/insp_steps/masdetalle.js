$(document).ready(function() {
    // Tiene Costo
    $('select[name="Tiene_Costo"]').change(function() {
        if ($(this).val() == 'si') {
            $('#costoDetails').show();
        } else {
            $('#costoDetails').hide();
        }
    });

    // Monto Fundamentado
    $('select[name="Monto_Fundamentado"]').change(function() {
        if ($(this).val() == 'si') {
            $('#fundamentoDetails').show();
        } else {
            $('#fundamentoDetails').hide();
        }
    });

    // Facultades
    $('#agregarFacultadBtn').click(function() {
        var facultad = $('input[name="Facultades_Obligaciones"]').val();
        if (facultad) {
            $('#facultadesList').append(
                '<li class="list-group-item">'
                    + facultad +
                    '<button type="button" class="btn btn-danger btn-sm float-right quitarFacultadBtn">Quitar</button>'
                + '</li>'
            );
            $('input[name="Facultades_Obligaciones"]').val('');
        }
    });

    $('#facultadesList').on('click', '.quitarFacultadBtn', function() {
        $(this).parent().remove();
    });
});
