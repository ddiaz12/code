$(document).ready(function() {

    // Verificación inicial para Es_Emergencia
    if ($('select[name="Es_Emergencia"]').val() === 'si') {
        $('#emergenciaDetails').show();
        $('input[name="Archivo_Declaracion_Emergencia"]').attr('required', true);
    } else {
        $('#emergenciaDetails').hide();
        $('input[name="Archivo_Declaracion_Emergencia"]').removeAttr('required');
    }

    // Cambio de estado en el select Es_Emergencia
    $('select[name="Es_Emergencia"]').change(function() {
        if ($(this).val() === 'si') {
            $('#emergenciaDetails').show();
            $('input[name="Archivo_Declaracion_Emergencia"]').attr('required', true);
            Swal.fire({
                title: 'Información',
                text: 'Con fundamento en el artículo 56, de la Ley General de Mejora Regulatoria, se podrá registrar una inspección para atender una emergencia en los 5 días hábiles posteriores a su habilitación.',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            });
        } else {
            $('#emergenciaDetails').hide();
            $('input[name="Archivo_Declaracion_Emergencia"]').removeAttr('required');
        }
    });

    // Validación de campos obligatorios dentro del contenedor del Step 9 usando "#step-9 form"
    $('#step-9 form').on('submit', function(e) {
        let valid = true;
        $('#step-9 input[required], #step-9 select[required], #step-9 textarea[required]').each(function() {
            if ($(this).val().trim() === '') {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        if (!valid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos requeridos',
                text: 'Por favor complete todos los campos obligatorios.',
                confirmButtonColor: '#8E354A'
            });
        }
    });

    console.log("emergencias.js actualizado");
});
