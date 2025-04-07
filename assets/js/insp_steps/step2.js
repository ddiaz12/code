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

    // Evento delegado para el botón "Seleccionar" de la oficina
    $('#oficinasTable').off('click', '.seleccionarOficinaBtn').on('click', '.seleccionarOficinaBtn', function() {
        // Intentar obtener data-nombre usando .data() y, si no existe, usar .attr()
        let nombre = $(this).data('nombre') || $(this).attr('data-nombre');
        if (!nombre) {
            console.error('El atributo data-oficina o data-nombre no está definido. Verifica el HTML del botón.');
            return;
        }
        let nvialidad = $(this).data('nvialidad') || $(this).attr('data-nvialidad');
        let numin    = $(this).data('numin')    || $(this).attr('data-numin');
        let numeext  = $(this).data('numeext')  || $(this).attr('data-numeext');
        let entidad  = $(this).data('entidad')  || $(this).attr('data-entidad');
        let municipio= $(this).data('municipio')|| $(this).attr('data-municipio');
        
        // Formar la cadena de dirección (ajustar formato según necesidad)
        let direccion = nvialidad + ' ' + numin + ' ' + numeext + ' ' + entidad + ' ' + municipio;
        
        // Agregar la fila a la tabla de oficinas seleccionadas
        let fila = `
            <tr>
                <td>${nombre}</td>
                <td>${direccion}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm btnEliminarOficina">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#tablaOficinasSeleccionadas tbody').append(fila);
        // Mostrar el contenedor de la tabla si estaba oculto
        $("#oficinasSeleccionadasContainer").show();
        // Cerrar el modal
        $('#oficinasModal').modal('hide');
    });

    // Evento para eliminar una fila de la tabla de oficinas seleccionadas
    $('#tablaOficinasSeleccionadas').on('click', '.btnEliminarOficina', function() {
        $(this).closest('tr').remove();
        // Si ya no hay filas, ocultar el contenedor
        if ($('#tablaOficinasSeleccionadas tbody tr').length === 0) {
            $("#oficinasSeleccionadasContainer").hide();
        }
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
