$(document).ready(function() {
    function validateEmergencias() {
        let valid = true;
        
        // Recopilar datos para depuración (todos los inputs, selects y textareas dentro de #step-4)
        let formData = {};
        $('#step-4 :input, #step-4 select, #step-4 textarea').each(function() {
            let name = $(this).attr('name');
            if (name) {
                formData[name] = $(this).val();
            }
        });
        console.log('Datos del Step 4 guardados:', formData);
        
        // Verificar si se marcó la casilla "es_emergencia"
        let isEmergencia = $('#es_emergencia').is(':checked');
        
        // Si se requiere atender una emergencia, exigir que se justifique
        if (isEmergencia) {
            if ($('#justificacion_emergencia').val().trim() === "") {
                valid = false;
                $('#justificacion_emergencia').addClass('is-invalid');
            } else {
                $('#justificacion_emergencia').removeClass('is-invalid');
            }
            // Si se desea, se puede validar también el input de oficio, pero normalmente el archivo se valida de forma distinta.
            // Ejemplo (opcional):
            // if ($('#oficio_emergencia').val().trim() === "") {
            //     valid = false;
            //     $('#oficio_emergencia').addClass('is-invalid');
            // } else {
            //     $('#oficio_emergencia').removeClass('is-invalid');
            // }
        } else {
            // Si no es emergencia, se quitan clases de error en los campos relacionados
            $('#justificacion_emergencia').removeClass('is-invalid');
            // $('#oficio_emergencia').removeClass('is-invalid');
        }
        
        return valid;
    }
    
    // Hacer la función de validación globalmente accesible
    window.validateEmergencias = validateEmergencias;
});
