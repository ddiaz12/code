$(document).ready(function() {
    function validateDatosSuperior() {
        let valid = true;

        // Validar todos los campos requeridos visibles dentro del contenedor del Step 2
        $('#step-2 input[required]:visible, #step-2 select[required]:visible, #step-2 textarea[required]:visible').each(function() {
            if ($(this).val().trim() === "") {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        // Recopilar datos para depuración
        let formData = {};
        $('#step-2 :input').each(function() {
            let name = $(this).attr('name');
            if (name) {
                formData[name] = $(this).val();
            }
        });
        console.log('Datos del Step 2 guardados:', formData);

        return valid;
    }

    // Hacer que la función esté disponible globalmente para que el archivo de validación global la pueda llamar
    window.validateDatosSuperior = validateDatosSuperior;
});
