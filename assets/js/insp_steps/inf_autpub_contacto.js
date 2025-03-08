$(document).ready(function() {

    function validateRequiredFields() {
        let valid = true;
        $('#step-5 input[required], #step-5 select[required], #step-5 textarea[required]').each(function() {
            if ($(this).val().trim() === '') {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        return valid;
    }

    function validateEmailFields() {
        let valid = true;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        $('#step-5 input[type="email"]').each(function() {
            let val = $(this).val().trim();
            if (val !== '' && !emailPattern.test(val)) {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        return valid;
    }

    function validateURLFields() {
        let valid = true;
        const urlPattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
        $('#step-5 input[type="url"]').each(function() {
            let val = $(this).val().trim();
            if (val !== '' && !urlPattern.test(val)) {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        return valid;
    }

    function validateInfAutPubContacto() {
        let valid = true;
        valid = validateRequiredFields() && valid;
        valid = validateEmailFields() && valid;
        valid = validateURLFields() && valid;
        return valid;
    }

    $('#formAutoridadContacto').on('submit', function(e) {
        if (!validateInfAutPubContacto()) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos requeridos',
                text: 'Por favor complete los campos obligatorios con el formato correcto.',
                confirmButtonColor: '#8E354A'
            });
        } else {
            let formData = {};
            $('#step-5 :input').each(function() {
                let fieldName = $(this).attr('name');
                if (fieldName) {
                    formData[fieldName] = $(this).val();
                }
            });
            console.log('Datos del Step 5 guardados:', formData);
        }
    });

    console.log("inf_autpub_contacto.js iniciado");

    // Hacer que la función de validación esté disponible globalmente
    window.validateInfAutPubContacto = validateInfAutPubContacto;
});
