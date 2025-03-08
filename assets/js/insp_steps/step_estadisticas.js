$(document).ready(function() {
    // Validación de campos obligatorios solo dentro del contenedor del Step 6 (asumiendo que el id es "step-estadisticas")
    $('#formEstadisticas').on('submit', function(e) {
        let valid = true;
        $('#step-estadisticas input[required]:visible, #step-estadisticas select[required]:visible').each(function() {
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
});