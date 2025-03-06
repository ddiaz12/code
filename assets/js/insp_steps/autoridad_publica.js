$(document).ready(function() {

    // Al hacer clic en "Mis oficinas", filtramos la tabla según lo escrito en #buscarOficinasInput y abrimos el modal
    $('#buscarOficinasBtn').click(function() {
        var searchTerm = $('#buscarOficinasInput').val().toLowerCase();
        $('#oficinasTable tbody tr').each(function() {
            var oficinaNombre = $(this).find('td:first').text().toLowerCase();
            if (oficinaNombre.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        $('#oficinasModal').modal('show');
    });

    // Buscar en tiempo real mientras el usuario escribe
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

    // Al hacer clic en un botón "Agregar" dentro de la tabla
    $('#oficinasTable').off('click', '.seleccionarOficinaBtn').on('click', '.seleccionarOficinaBtn', function() {
        var oficina = $(this).data('oficina');
        console.log('Oficina seleccionada:', oficina); // Agregar console.log
        if (!oficina) {
            console.warn('Oficina es undefined. Revisa data-oficina en el HTML.');
            return;
        }
        $('#oficinasSeleccionadas').append(`
            <li class="list-group-item">
                ${oficina}
                <button type="button" class="btn btn-danger btn-sm float-right quitarOficinaBtn">
                    Quitar
                </button>
            </li>
        `);
        $('#oficinasModal').modal('hide');
    });

    // Botón "Aceptar" en el modal (simplemente cierra el modal)
    $('#aceptarOficinaBtn').click(function() {
        $('#oficinasModal').modal('hide');
    });

    // Quitar una oficina de la lista seleccionada
    $('#oficinasSeleccionadas').on('click', '.quitarOficinaBtn', function() {
        $(this).closest('li').remove();
    });

    $('select[name="Unidad_Administrativa"]').change(function() {
        var unidad = $(this).val();
        console.log("Unidad Administrativa seleccionada:", unidad);
        // Agrega lógica adicional si es necesario
    });
});
