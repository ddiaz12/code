$(document).ready(function() {

    /**
     * Filtra las filas de la tabla de oficinas según el término de búsqueda.
     */
    function filterOficinas() {
        let searchTerm = $('#buscarOficinasInput').val().toLowerCase();
        $('#oficinasTable tbody tr').each(function() {
            let oficinaNombre = $(this).find('td:first').text().toLowerCase();
            // Se muestra la fila si contiene el término, de lo contrario se oculta.
            if (oficinaNombre.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Evento: al hacer clic en "Mis oficinas", se filtra y se abre el modal.
    $('#buscarOficinasBtn').click(function() {
        filterOficinas();
        $('#oficinasModal').modal('show');
    });

    // Evento: filtrar en tiempo real mientras el usuario escribe.
    $('#buscarOficinasInput').on('input', function() {
        filterOficinas();
    });

    // Evento delegados para el botón "Agregar" en la tabla de oficinas.
    $('#oficinasTable').off('click', '.seleccionarOficinaBtn').on('click', '.seleccionarOficinaBtn', function() {
        // Se espera que el botón tenga un data attribute "data-oficina"
        let oficina = $(this).data('oficina');
        console.log('Oficina seleccionada:', oficina);
        if (!oficina) {
            console.warn('Oficina es undefined. Revisa data-oficina en el HTML.');
            return;
        }
        // Agrega la oficina seleccionada a la lista
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

    // Cerrar modal al hacer clic en "Aceptar"
    $('#aceptarOficinaBtn').click(function() {
        $('#oficinasModal').modal('hide');
    });

    // Evento: quitar una oficina de la lista seleccionada
    $('#oficinasSeleccionadas').on('click', '.quitarOficinaBtn', function() {
        $(this).closest('li').remove();
    });

    // Evento: cambio en Unidad Administrativa para posibles acciones adicionales
    $('select[name="Unidad_Administrativa"]').change(function() {
        let unidad = $(this).val();
        console.log("Unidad Administrativa seleccionada:", unidad);
        // Aquí puedes agregar lógica adicional según la unidad seleccionada
    });
});
