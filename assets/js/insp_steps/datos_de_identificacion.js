$(document).ready(function() {
    // Función para mostrar u ocultar el input "Especificar otra"
    function toggleEspecificarOtra() {
        // Suponiendo que el ID para "Otra" es 9 en la base de datos
        if ($('select[name="Tipo_Inspeccion"]').val() === '5') {
            $('#especificarOtra').show();
        } else {
            $('#especificarOtra').hide();
        }
    }

    // Ejecutar al cargar la página (para que si viene seleccionado "Otra", se muestre)
    toggleEspecificarOtra();
    
    // Asignar el evento change para actualizar el estado cuando el usuario cambie el valor
    $('select[name="Tipo_Inspeccion"]').change(function(){
        toggleEspecificarOtra();
    });

    // Ley de Fomento
    $('input[name="Ley_Fomento"]').change(function(){
        $('#justificarLeyFomento').toggle($(this).val() === 'si');
    });

    // Dirigida a
    $('select[name="Dirigida_A"]').change(function(){
        $('#especificarDirigidaA').toggle($(this).val() === 'Otras');
    });

    // Realizada en
    $('select[name="Realizada_En"]').change(function(){
        $('#especificarRealizadaEn').toggle($(this).val() === 'Otro');
    });

    // Motivo de Inspección
    $('select[name="Motivo_Inspeccion"]').change(function(){
        $('#especificarMotivoInspeccion').toggle($(this).val() === 'Otro');
    });

    // Mostrar/ocultar botón y contenedor de Fundamento según la selección
    // Se evalúa inicialmente el estado del input Fundamento_Juridico
    $('#btnAddFundamento, #fundamentosContainer').toggle($('input[name="Fundamento_Juridico"]:checked').val() === 'si');

    // Cada vez que se cambie el valor, se actualiza la visibilidad de ambos elementos
    $('input[name="Fundamento_Juridico"]').change(function() {
        $('#btnAddFundamento, #fundamentosContainer').toggle($(this).val() === 'si');
    });

    // Abrir el modal al dar clic en "Añadir Fundamento"
    $('#btnAddFundamento').click(function() {
        $('#modalFundamento').modal('show'); // Abre el modal
    });

    // Guardar el fundamento al dar clic en "Guardar" del modal
    $('#btnGuardarFundamento').click(function() {
        // Validar campos obligatorios
        let tipo = $('#tipoOrdenamiento').val().trim();
        let tipoTexto = $('#tipoOrdenamiento option:selected').text().trim();
        let nombre = $('#nombreOrdenamiento').val().trim();

        if (!tipo || !nombre) {
            Swal.fire({
                icon: 'error',
                title: 'Campos requeridos',
                text: 'Debes seleccionar el Tipo de ordenamiento y capturar el Nombre',
                confirmButtonColor: '#8E354A'
            });
            return;
        }

        // Agregar una fila a la tabla con el Tipo (texto) y Nombre
        let fila = `
            <tr>
                <td>${tipoTexto}</td>
                <td>${nombre}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm btnBorrarFundamento">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#tablaFundamentos tbody').append(fila);

        // Cerrar el modal
        $('#modalFundamento').modal('hide');

        // Limpiar campos del modal (opcional)
        $('#tipoOrdenamiento').val('');
        $('#nombreOrdenamiento').val('');
        $('#articulo').val('');
        $('#fraccion').val('');
        $('#inciso').val('');
        $('#parrafo').val('');
        $('#numero').val('');
        $('#letra').val('');
        $('#otro').val('');

        // Mostrar alerta de éxito
        Swal.fire({
            icon: 'success',
            title: 'Fundamento agregado',
            text: 'Se ha agregado un fundamento jurídico a la lista.',
            confirmButtonColor: '#8E354A',
            timer: 1500
        });
    });

    // Eliminar fila de la tabla al dar clic en el botón de basura
    $('#tablaFundamentos').on('click', '.btnBorrarFundamento', function() {
        $(this).closest('tr').remove();
    });
});

// Función para cerrar el modal con confirmación (opcional)
function cerrarModalFundamento() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Los cambios no guardados se perderán",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#8E354A',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, cerrar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#modalFundamento').modal('hide');
        }
    });
}




