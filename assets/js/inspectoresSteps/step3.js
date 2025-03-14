$(document).ready(function() {
    function validateNoPublicidad() {
        let valid = true;
        let permiso = $('select[name="permitir_publicidad"]').val().trim().toLowerCase();
        // Recopilar datos para depuración
        let formData = {};
        $('#step-3 :input, #step-3 select, #step-3 textarea').each(function() {
            let name = $(this).attr('name');
            if (name) { formData[name] = $(this).val(); }
        });
        console.log("Datos del Step 3 guardados:", formData);
        if (permiso === "no") {
            let fileVal = $('input[name="justificante_no_publicidad"]').val();
            if (fileVal.trim() === "") {
                valid = false;
                $('input[name="justificante_no_publicidad"]').addClass("is-invalid");
            } else {
                $('input[name="justificante_no_publicidad"]').removeClass("is-invalid");
            }
        }
        return valid;
    }
    
    function toggleNoPublicidadFields() {
        // Usar el ID del select para mayor precisión
        let permiso = $('#permitir_publicidad').val().trim().toLowerCase();
        console.log("Valor de permitir_publicidad:", permiso);
        if (permiso === 'si') {
            $('#justificante_no_publicidad_container').hide();
            $('#datos_no_publicar_container').hide();
        } else {
            $('#justificante_no_publicidad_container').show();
            $('#datos_no_publicar_container').show();
        }
    }
    
    console.log("Ejecutando toggleNoPublicidadFields en document.ready...");
    toggleNoPublicidadFields();
    $('#permitir_publicidad').on('change', function() {
        console.log("Cambio detectado en permitir_publicidad:", $(this).val());
        toggleNoPublicidadFields();
    });
    
    window.validateNoPublicidad = validateNoPublicidad;
});
