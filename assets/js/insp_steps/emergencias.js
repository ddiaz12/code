$(document).ready(function() {
    // Emergencias
    $('select[name="Es_Emergencia"]').change(function() {
        if ($(this).val() == 'si') {
            $('#emergenciaDetails').show();
            Swal.fire({
                title: 'Información',
                text: 'Con fundamento en el artículo 56, de la Ley General de Mejora Regulatoria, se podrá registrar una inspección para atender una emergencia en los 5 días hábiles posteriores a su habilitación.',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            });
        } else {
            $('#emergenciaDetails').hide();
        }
    });

    // Validación de campos obligatorios
    $('form').on('submit', function(e) {
        let valid = true;

        // Validar que los campos obligatorios no estén vacíos
        $('input[required], select[required], textarea[required]').each(function() {
            if ($(this).val() === '') {
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
});
