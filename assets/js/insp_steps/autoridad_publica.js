$(document).ready(function() {
    // Modal "Buscar Oficinas"
    $('#buscarOficinasBtn').click(function() {
        $('#oficinasModal').modal('show');
    });

    $('.seleccionarOficinaBtn').click(function() {
        var oficina = $(this).data('oficina');
        $('#oficinasSeleccionadas').append(
            '<li class="list-group-item">'
                + oficina +
                '<button type="button" class="btn btn-danger btn-sm float-right quitarOficinaBtn">Quitar</button>'
            + '</li>'
        );
        $('#oficinasModal').modal('hide');
    });

    $('#aceptarOficinaBtn').click(function() {
        $('#oficinasModal').modal('hide');
    });

    $('#buscarOficinasInput').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        $('#oficinasTable tbody tr').each(function() {
            var oficinaNombre = $(this).find('td:first').text().toLowerCase();
            if (oficinaNombre.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $('#oficinasSeleccionadas').on('click', '.quitarOficinaBtn', function() {
        $(this).parent().remove();
    });
});
