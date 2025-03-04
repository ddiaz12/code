$(document).ready(function() {
    // Aquí puedes agregar cualquier lógica adicional que necesites para este step

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

        // Validar formato de email
        $('input[type="email"]').each(function() {
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test($(this).val())) {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        // Validar formato de URL
        $('input[type="url"]').each(function() {
            const urlPattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
            if (!urlPattern.test($(this).val())) {
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
                text: 'Por favor complete todos los campos obligatorios con el formato correcto.',
                confirmButtonColor: '#8E354A'
            });
        }
    });
});
