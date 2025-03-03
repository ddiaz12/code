$(document).ready(function() {
    // Aquí puedes agregar cualquier lógica adicional que necesites para este step

    // Validación de campos obligatorios
    $('form').on('submit', function(e) {
        let valid = true;

        // Validar que los campos obligatorios no estén vacíos
        $('textarea[required]').each(function() {
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
