$(document).ready(function() {
    // Validación de campos obligatorios
    $('form').on('submit', function(e) {
        let valid = true;

        // Validar que los campos obligatorios no estén vacíos
        $('input[required], select[required]').each(function() {
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
