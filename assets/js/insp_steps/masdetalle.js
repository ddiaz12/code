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
        var facultad = $('input[name="Facultades_Obligaciones"]').val().trim();
        if (facultad) {
            $('#facultadesList').append(
                '<li class="list-group-item">'
                    + facultad +
                    '<button type="button" class="btn btn-danger btn-sm float-right quitarFacultadBtn">Quitar</button>'
                + '</li>'
            );

            // Actualizar el input hidden con JSON
            let currentData = $('#FacultadesJSON').val();
            let arr = currentData ? JSON.parse(currentData) : [];
            arr.push(facultad);
            $('#FacultadesJSON').val(JSON.stringify(arr));

            $('input[name="Facultades_Obligaciones"]').val('');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El campo "Facultades, atribuciones y obligaciones" no puede estar vacío.'
            });
        }
    });

    $('#facultadesList').on('click', '.quitarFacultadBtn', function() {
        let facultad = $(this).parent().text().trim();
        $(this).parent().remove();

        // Actualizar el input hidden con JSON
        let currentData = $('#FacultadesJSON').val();
        let arr = currentData ? JSON.parse(currentData) : [];
        arr = arr.filter(item => item !== facultad);
        $('#FacultadesJSON').val(JSON.stringify(arr));
    });

    // Mostrar/ocultar el campo de texto para "Otra" sanción
    $('input[name="Sanciones[]"]').change(function() {
        if ($(this).data('es-otra') === 1) {
            if ($(this).is(':checked')) {
                $('input[name="Otra_Sancion"]').show().attr('required', true);
            } else {
                $('input[name="Otra_Sancion"]').hide().removeAttr('required').val('');
            }
        }
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

        // Validar que la lista de facultades no esté vacía
        if ($('#facultadesList li').length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debe agregar al menos una facultad, atribución u obligación.'
            });
            return;
        }

        // Capturar todos los campos del formulario
        var formData = {};
        $('form#formMasdetalle').find('input, select, textarea').each(function() {
            var name = $(this).attr('name');
            var value = $(this).val();
            formData[name] = value;
        });

        console.log('Form Data:', formData);

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
