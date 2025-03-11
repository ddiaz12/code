$(document).ready(function() {
    function validateDatosBasicos() {
        let valid = true;
        
        // Validar todos los campos requeridos y visibles dentro del contenedor del Step 1
        $('#step-1 input[required]:visible, #step-1 select[required]:visible, #step-1 textarea[required]:visible').each(function() {
            if ($(this).val().trim() === "") {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        // Si algún campo obligatorio está vacío, mostrar alerta
        if (!valid) {
            Swal.fire({
                icon: 'error',
                title: 'Campos obligatorios',
                text: 'Por favor, complete todos los campos obligatorios en este paso.',
                confirmButtonColor: '#8E354A'
            });
        }
        
        // Recopilar datos del Step 1 para depuración
        let formData = {};
        $('#step-1 :input').each(function() {
            let name = $(this).attr('name');
            if (name) {
                formData[name] = $(this).val();
            }
        });
        console.log("Datos del Step 1 guardados:", formData);
        
        return valid;
    }
    
    // Exponer la función globalmente para que el script global de validación pueda llamarla
    window.validateDatosBasicos = validateDatosBasicos;
});
