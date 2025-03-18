$(document).ready(function() {

    // Validación para el Step 7: Información adicional
    // Este step no cuenta con campos obligatorios, pero si en el futuro se agregan, se validan solo dentro del contenedor "#step-7"
    $('#formInfAdicional').on('submit', function(e) {
        let valid = true;

        // Validar que los campos obligatorios dentro de #step-7 no estén vacíos (si existen)
        $('#step-7 [required]:visible').each(function() {
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
        } else {
            let formData = {};
            $('#step-7 :input').each(function() {
                let fieldName = $(this).attr('name');
                if (fieldName) {
                    formData[fieldName] = $(this).val();
                }
            });
            console.log('Datos del Step 7 guardados:', formData);
        }
    });

    console.log("inf_adicional.js iniciado");
});
