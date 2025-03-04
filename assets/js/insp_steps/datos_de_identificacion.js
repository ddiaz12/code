
$(document).ready(function() {
    // Tipo de inspección -> "Otra"
    $('select[name="Tipo_Inspeccion"]').change(function(){
        if ($(this).val() === 'Otra') {
            $('#especificarOtra').show();
        } else {
            $('#especificarOtra').hide();
        }
    });

    // Ley de Fomento
    $('input[name="Ley_Fomento"]').change(function(){
        if ($(this).val() === 'si') {
            $('#justificarLeyFomento').show();
        } else {
            $('#justificarLeyFomento').hide();
        }
    });

    // Dirigida a
    $('select[name="Dirigida_A"]').change(function(){
        if ($(this).val() === 'Otras') {
            $('#especificarDirigidaA').show();
        } else {
            $('#especificarDirigidaA').hide();
        }
    });

    // Realizada en
    $('select[name="Realizada_En"]').change(function(){
        if ($(this).val() === 'Otro') {
            $('#especificarRealizadaEn').show();
        } else {
            $('#especificarRealizadaEn').hide();
        }
    });

    // Motivo de Inspección
    $('select[name="Motivo_Inspeccion"]').change(function(){
        if ($(this).val() === 'Otro') {
            $('#especificarMotivoInspeccion').show();
        } else {
            $('#especificarMotivoInspeccion').hide();
        }
    });

    // Mostrar/ocultar botón y contenedor de Fundamento según la selección
    // Se evalúa inicialmente el estado del input Fundamento_Juridico
    if ($('input[name="Fundamento_Juridico"]:checked').val() === 'si') {
        $('#btnAddFundamento, #fundamentosContainer').show();
    } else {
        $('#btnAddFundamento, #fundamentosContainer').hide();
    }
    // Cada vez que se cambie el valor, se actualiza la visibilidad de ambos elementos
    $('input[name="Fundamento_Juridico"]').change(function() {
        if ($(this).val() === 'si') {
            $('#btnAddFundamento, #fundamentosContainer').show();
        } else {
            $('#btnAddFundamento, #fundamentosContainer').hide();
        }
    });

    // Abrir el modal al dar clic en "Añadir Fundamento"
    $('#btnAddFundamento').click(function() {
        $('#modalFundamento').modal('show'); // Abre el modal
    });

    // Guardar el fundamento al dar clic en "Guardar" del modal
    $('#btnGuardarFundamento').click(function() {
        // Validar campos obligatorios
        let tipo = $('#tipoOrdenamiento').val().trim();
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

        // Agregar una fila a la tabla con el Tipo y Nombre
        let fila = `
            <tr>
                <td>${tipo}</td>
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

