$(document).ready(function() {
    function validateNoPublicidad() {
        let valid = true;
        // Obtener el valor del dropdown y normalizar
        let permiso = $('select[name="permitir_publicidad"]').val().trim().toLowerCase();
        
        // Recopilar datos para depuración
        let formData = {};
        $('#step-3 :input, #step-3 select, #step-3 textarea').each(function() {
            let name = $(this).attr('name');
            if (name) {
                formData[name] = $(this).val();
            }
        });
        console.log("Datos del Step 3 guardados:", formData);
        
        // Si el permiso es "no", se exige que se suba el justificante
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
    
    // Nueva función para controlar la visibilidad de los campos
    function toggleNoPublicidadFields() {
        let permiso = $('select[name="permitir_publicidad"]').val().trim().toLowerCase();
        console.log("Valor de permitir_publicidad:", permiso);
        if (permiso === 'si') {
            $('#justificante_no_publicidad_container').hide();
            $('#datos_no_publicar_container').hide();
        } else if (permiso === 'no') {
            $('#justificante_no_publicidad_container').show();
            $('#datos_no_publicar_container').show();
        }
    }
    
    // Ejecutar al cargar con logs de depuración
    console.log("Ejecutando toggleNoPublicidadFields en document.ready...");
    toggleNoPublicidadFields();
    $('select[name="permitir_publicidad"]').on('change', function() {
        console.log("Cambio detectado en permitir_publicidad:", $(this).val());
        toggleNoPublicidadFields();
    });
    
    // Hacer que la función de validación esté disponible globalmente
    window.validateNoPublicidad = validateNoPublicidad;
});
