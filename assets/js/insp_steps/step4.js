$(document).ready(function () {

    // Función genérica para mostrar/ocultar secciones y asignar/quitar "required"
    function toggleSection(selector, inputSelector, show) {
        if (show) {
            $(selector).show();
            if (inputSelector) {
                $(inputSelector).attr('required', true);
            }
        } else {
            $(selector).hide();
            if (inputSelector) {
                $(inputSelector).removeAttr('required');
            }
        }
    }

    // Detalles de costo
    $('select[name="Tiene_Costo"]').change(function () {
        let tieneCosto = $(this).val() === 'si';
        toggleSection('#costoDetails', 'input[name="Monto_Costo"]', tieneCosto);
        toggleSection('#costoDetails', 'select[name="Monto_Fundamentado"]', tieneCosto);
        if (!tieneCosto) {
            $('#fundamentoDetails').hide();
            $('select[name="Monto_Fundamentado"]').removeAttr('required');
        }
    }).trigger('change');

    // Detalles de fundamento según "Monto_Fundamentado"
    $('select[name="Monto_Fundamentado"]').change(function () {
        toggleSection('#fundamentoDetails', null, $(this).val() === 'si');
    }).trigger('change');

    // Facultades: Agregar
    $('#agregarFacultadBtn').click(function() {
        let facultad = $('input[name="Facultades_Obligaciones"]').val().trim();
        if (facultad) {
            $('#facultadesList').append(
                '<li class="list-group-item">' +
                    facultad +
                    '<button type="button" class="btn btn-danger btn-sm float-right quitarFacultadBtn">Quitar</button>' +
                '</li>'
            );
            // Actualizar input hidden con JSON
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

    // Facultades: Quitar
    $('#facultadesList').on('click', '.quitarFacultadBtn', function() {
        let facultad = $(this).parent().text().trim();
        $(this).parent().remove();
        // Actualizar input hidden con JSON
        let currentData = $('#FacultadesJSON').val();
        let arr = currentData ? JSON.parse(currentData) : [];
        arr = arr.filter(item => item !== facultad);
        $('#FacultadesJSON').val(JSON.stringify(arr));
    });

    // Sanciones: Mostrar/Ocultar "Otra" sanción
    $('input[name="Sanciones[]"]').change(function() {
        if ($(this).data('es-otra') === 1) {
            if ($(this).is(':checked')) {
                $('input[name="Otra_Sancion"]').show().attr('required', true);
            } else {
                $('input[name="Otra_Sancion"]').hide().removeAttr('required').val('');
            }
        }
    });

    // Función de validación personalizada para el Step 4: Más detalles
    function validateMasdetalleStep() {
        let errors = [];

        // Validar "Tiene_Costo"
        let tieneCosto = $('select[name="Tiene_Costo"]').val();
        if (!tieneCosto) {
            errors.push('El campo "¿Tiene algún costo o pago de derechos, productos y aprovechamientos aplicables?" es obligatorio.');
        } else if (tieneCosto === 'si') {
            let monto = $('input[name="Monto_Costo"]').val();
            if (monto === '' || parseFloat(monto) < 0) {
                errors.push('Debe indicar un monto válido.');
            }
            let montoFundamentado = $('select[name="Monto_Fundamentado"]').val();
            if (!montoFundamentado) {
                errors.push('El campo "¿El monto se encuentra fundamentado jurídicamente?" es obligatorio.');
            }
        }

        // Validar que la lista de facultades no esté vacía
        if ($('#facultadesList li').length === 0) {
            errors.push('Debe agregar al menos una facultad, atribución u obligación.');
        }

        if (errors.length > 0) {
            Swal.fire({
                icon: 'error',
                title: 'Errores en el formulario',
                html: errors.join("<br>"),
                confirmButtonColor: '#8E354A'
            });
            return false;
        }
        return true;
    }

    // Hacer que la función esté disponible globalmente
    window.validateMasdetalleStep = validateMasdetalleStep;

    // Evento para el botón "Guardar" del Step 4
    $('#guardarMasdetalleBtn').click(function (e) {
        e.preventDefault();
        if (!validateMasdetalleStep()) {
            return;
        }
        // Recopilar datos del formulario (para depuración o envío vía AJAX)
        let formData = {};
        $('form#formMasdetalle').find('input, select, textarea').each(function() {
            let name = $(this).attr('name');
            formData[name] = $(this).val();
        });
        console.log('Form Data:', formData);
        console.log('Step masdetalle validado correctamente.');
        // Aquí puedes proceder a enviar el formulario o avanzar al siguiente step
    });

    // Evitar duplicidad en el manejador de envío global
    $('form').off('submit').on('submit', function(e) {
        if (!validateAllSteps()) {
            e.preventDefault();
        }
    });
});
