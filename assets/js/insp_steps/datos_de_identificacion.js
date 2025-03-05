$(document).ready(function() {
    // Función para mostrar u ocultar el input "Especificar otra"
    function toggleEspecificarOtra() {
        var selectedText = $('#tipoInspeccionSelect option:selected').text().trim();
        if(selectedText.toLowerCase() === 'otra'){
            $('#especificarOtra').show();
            $('input[name="Especificar_Otra"]').attr('required', true);
        } else {
            $('#especificarOtra').hide();
            $('input[name="Especificar_Otra"]').removeAttr('required');
        }
    }
    
    toggleEspecificarOtra();
    
    $('#tipoInspeccionSelect').change(function(){
        toggleEspecificarOtra();
    });

    // Ejecutar al cargar la página
    toggleEspecificarOtra();

    // Asignar el evento change para actualizar el estado cuando el usuario cambie el valor
    $('select[name="Tipo_Inspeccion"]').change(function() {
        toggleEspecificarOtra();
    });

    // Función para mostrar/ocultar justificación de Ley de Fomento
    function toggleLeyFomento() {
        if ($('input[name="Ley_Fomento"]:checked').val() === 'si') {
            $('#justificarLeyFomento').show();
            $('textarea[name="Justificacion_Ley_Fomento"]').attr('required', true);
        } else {
            $('#justificarLeyFomento').hide();
            $('textarea[name="Justificacion_Ley_Fomento"]').removeAttr('required');
        }
    }

    // Ejecutar al cargar la página
    toggleLeyFomento();

    // Asignar evento change para actualizar al cambiar la selección
    $('input[name="Ley_Fomento"]').change(function() {
        toggleLeyFomento();
    });

    // Dirigida a
    function toggleEspecificarDirigidaA() {
        const selectedText = $('select[name="Dirigida_A"] option:selected').text().trim();
        if (selectedText === 'Otras') {
            $('#especificarDirigidaA').show();
            $('input[name="Especificar_Dirigida_A"]').attr('required', true);
        } else {
            $('#especificarDirigidaA').hide();
            $('input[name="Especificar_Dirigida_A"]').removeAttr('required');
        }
    }

    // Ejecutar al cargar la página
    toggleEspecificarDirigidaA();

    // Asignar evento change para actualizar al cambiar la selección
    $('select[name="Dirigida_A"]').change(function() {
        toggleEspecificarDirigidaA();
    });

    // Realizada en
    function toggleEspecificarRealizadaEn() {
        const selectedText = $('select[name="Realizada_En"] option:selected').text().trim();
        if (selectedText === 'Otro') {
            $('#especificarRealizadaEn').show();
            $('input[name="Especificar_Realizada_En"]').attr('required', true);
        } else {
            $('#especificarRealizadaEn').hide();
            $('input[name="Especificar_Realizada_En"]').removeAttr('required');
        }
    }

    // Ejecutar al cargar la página
    toggleEspecificarRealizadaEn();

    // Asignar evento change para actualizar al cambiar la selección
    $('select[name="Realizada_En"]').change(function() {
        toggleEspecificarRealizadaEn();
    });

    // Motivo de Inspección
    function toggleEspecificarMotivoInspeccion() {
        const selectedText = $('select[name="Motivo_Inspeccion"] option:selected').text().trim();
        if (selectedText === 'Otro') {
            $('#especificarMotivoInspeccion').show();
            $('input[name="Especificar_Motivo_Inspeccion"]').attr('required', true);
        } else {
            $('#especificarMotivoInspeccion').hide();
            $('input[name="Especificar_Motivo_Inspeccion"]').removeAttr('required');
        }
    }

    // Ejecutar al cargar la página
    toggleEspecificarMotivoInspeccion();

    // Asignar evento change para actualizar la visibilidad al cambiar la selección
    $('select[name="Motivo_Inspeccion"]').change(function() {
        toggleEspecificarMotivoInspeccion();
    });

    // Mostrar/ocultar botón y contenedor de Fundamento según la selección
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
        // Validar campos obligatorios con validación explícita de "0"
        let tipo = $('#tipoOrdenamiento').val().trim();
        let tipoTexto = $('#tipoOrdenamiento option:selected').text().trim();
        let nombre = $('#nombreOrdenamiento').val().trim();

        if (tipo === "0" || tipo === "" || nombre === "") {
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

        // Cerrar el modal, limpiar campos y mostrar alerta de éxito
        $('#modalFundamento').modal('hide');
        $('#tipoOrdenamiento').val('');
        $('#nombreOrdenamiento').val('');
        $('#articulo').val('');
        $('#fraccion').val('');
        $('#inciso').val('');
        $('#parrafo').val('');
        $('#numero').val('');
        $('#letra').val('');
        $('#otro').val('');
        
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

    // Validar que el campo URL tenga un formato válido
    $('input[type="url"]').on('input', function() {
        if (!this.checkValidity()) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
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




