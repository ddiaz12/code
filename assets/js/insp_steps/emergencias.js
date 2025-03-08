$(document).ready(function() {

    // Toggle de detalles de emergencia basado en la selección de "Es_Emergencia"
    $('select[name="Es_Emergencia"]').change(function() {
        if ($(this).val() === 'si') {
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

    // Validación de campos obligatorios dentro del contenedor del Step 9 ("Emergencias")
    // Se asume que la vista está contenida en un elemento con id "step-emergencias"
    $('#step-emergencias form').on('submit', function(e) {
        let valid = true;
        $('#step-emergencias input[required], #step-emergencias select[required], #step-emergencias textarea[required]').each(function() {
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

    console.log("emergencias.js iniciado");
});
