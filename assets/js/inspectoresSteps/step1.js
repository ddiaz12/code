$(document).ready(function() {
    function validateDatosBasicos() {
        let valid = true;
        
        // Validar todos los campos requeridos y visibles dentro del Step 1
        $('#step-1 input[required]:visible, #step-1 select[required]:visible, #step-1 textarea[required]:visible').each(function() {
            if ($(this).val().trim() === "") {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        // Validar que al menos un checkbox de "tipo_nombramiento[]" esté seleccionado
        let tiposNom = $("input[name='tipo_nombramiento[]']:checked").map(function() {
            return $(this).val();
        }).get();
        // Se busca el contenedor de checkboxes; se asume que todos están dentro de la misma .form-group
        let checkboxContainer = $("input[name='tipo_nombramiento[]']").closest('.form-group');
        if (tiposNom.length === 0) {
            valid = false;
            checkboxContainer.addClass('is-invalid');
            Swal.fire({
                icon: 'error',
                title: 'Campos obligatorios',
                text: 'Seleccione al menos un Tipo de nombramiento.',
                confirmButtonColor: '#8E354A'
            });
        } else {
            checkboxContainer.removeClass('is-invalid');
        }
        
        // Validar que el select "sujeto_obligado" no tenga el valor vacío
        if ($("select[name='sujeto_obligado']").val().trim() === "") {
            valid = false;
            $("select[name='sujeto_obligado']").addClass('is-invalid');
            Swal.fire({
                icon: 'error',
                title: 'Campos obligatorios',
                text: 'Seleccione un Sujeto Obligado.',
                confirmButtonColor: '#8E354A'
            });
        } else {
            $("select[name='sujeto_obligado']").removeClass('is-invalid');
        }
        
        // Recopilar datos del Step 1 para depuración, incluyendo los checkboxes
        let formData = {};
        $('#step-1 :input').each(function() {
            let name = $(this).attr('name');
            if (name) {
                // Si es el campo de checkboxes, omitir para luego asignarlos manualmente
                if(name === 'tipo_nombramiento[]') return;
                formData[name] = $(this).val();
            }
        });
        formData['tipo_nombramiento'] = tiposNom;
        console.log("Datos del Step 1 guardados:", formData);
        
        return valid;
    }
    
    // Exponer la función globalmente para que el script global de validación pueda llamarla
    window.validateDatosBasicos = validateDatosBasicos;
});
