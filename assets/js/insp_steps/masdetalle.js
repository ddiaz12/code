$(document).ready(function () {
     // Mostrar/ocultar detalles de costo según "Tiene_Costo"
     $('select[name="Tiene_Costo"]').change(function () {
        if ($(this).val() === 'si') {
            $('#costoDetails').show();
            $('input[name="Monto_Costo"]').attr('required', true);
            $('select[name="Monto_Fundamentado"]').attr('required', true);
        } else {
            $('#costoDetails').hide();
            $('input[name="Monto_Costo"]').removeAttr('required');
            $('select[name="Monto_Fundamentado"]').removeAttr('required');
            $('#fundamentoDetails').hide();
        }
    }).trigger('change');

    // Mostrar/ocultar detalles de fundamento según "Monto_Fundamentado"
    $('select[name="Monto_Fundamentado"]').change(function () {
        if ($(this).val() === 'si') {
            $('#fundamentoDetails').show();
        } else {
            $('#fundamentoDetails').hide();
        }
    }).trigger('change');

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

    // Validar campos obligatorios al guardar el step
    $('#guardarMasdetalleBtn').click(function (e) {
        e.preventDefault();

        // Validar "Tiene_Costo"
        var tieneCosto = $('select[name="Tiene_Costo"]').val();
        if (!tieneCosto) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El campo "¿Tiene algún costo o pago de derechos, productos y aprovechamientos aplicables?" es obligatorio.'
            });
            return;
        }

        // Si tiene costo, validar monto y fundamentación
        if (tieneCosto === 'si') {
            var monto = $('input[name="Monto_Costo"]').val();
            if (monto === '' || parseFloat(monto) < 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Debe indicar un monto válido.'
                });
                return;
            }

            var montoFundamentado = $('select[name="Monto_Fundamentado"]').val();
            if (!montoFundamentado) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El campo "¿El monto se encuentra fundamentado jurídicamente?" es obligatorio.'
                });
                return;
            }
        }

        // Si la validación es exitosa, opcionalmente se pueden enviar los datos vía AJAX o continuar al siguiente step
        console.log('Step masdetalle validado correctamente.');
        // Ejemplo: enviar formulario
        // $('#formMasdetalle').submit();
    });

    // Evitar duplicidad en los manejadores de envío
    $('form').off('submit').on('submit', function(e) {
        if (!validateAllSteps()) {
            e.preventDefault();
        }
    });
});
