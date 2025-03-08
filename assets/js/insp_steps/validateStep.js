var currentStep = 1;
var totalSteps = 9; // O el número de steps que tengas

function validateStep(step) {
    // Step 1: Datos de Identificación
    if (step === 1) {
        return validateDatosIdentificacion();
    }
    // Step 2: Autoridad Pública (sin campos obligatorios)
    else if (step === 2) {
        let formData = {};
        $('#step-2 :input').each(function() {
            let fieldName = $(this).attr('name');
            if (fieldName) {
                formData[fieldName] = $(this).val();
            }
        });
        console.log('Datos del Step 2 guardados:', formData);
        return true;
    }
    // Step 3: Información sobre la Inspección
    else if (step === 3) {
        return validateInfSobreInspeccion();
    }
    // Step 4: Más detalles
    else if (step === 4) {
        return validateMasdetalleStep();
    }
    // Step 5: Información de la Autoridad Pública y Contacto
    else if (step === 5) {
        return validateInfAutPubContacto();
    }
    // Step 6: Estadísticas
    else if (step === 6) {
        let valid = true;
        $('#step-estadisticas [required]:visible').each(function() {
            if (!$(this).val() || $(this).val().trim() === "") {
                $(this).addClass('is-invalid');
                valid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        if (!valid) {
            Swal.fire({
                icon: 'error',
                title: 'Campos requeridos',
                text: 'Por favor complete todos los campos obligatorios.',
                confirmButtonColor: '#8E354A'
            });
        }
        return valid;
    }
    // Step 7: Información adicional (sin campos obligatorios)
    else if (step === 7) {
        let formData = {};
        $('#step-7 :input').each(function() {
            let fieldName = $(this).attr('name');
            if (fieldName) {
                formData[fieldName] = $(this).val();
            }
        });
        console.log('Datos del Step 7 guardados:', formData);
        return true;
    }
    // Step 8: No Publicidad
    else if (step === 8) {
        let valid = true;
        $('#step-no_publicidad [required]:visible').each(function() {
            if (!$(this).val() || $(this).val().trim() === "") {
                $(this).addClass('is-invalid');
                valid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        if (!valid) {
            Swal.fire({
                icon: 'error',
                title: 'Campos requeridos',
                text: 'Por favor complete todos los campos obligatorios.',
                confirmButtonColor: '#8E354A'
            });
        }
        return valid;
    }
    // Step 9: Emergencias (sin campos obligatorios)
    else if (step === 9) {
        let formData = {};
        $('#step-emergencias :input').each(function() {
            let fieldName = $(this).attr('name');
            if (fieldName) {
                formData[fieldName] = $(this).val();
            }
        });
        console.log('Datos del Step 9 guardados:', formData);
        return true;
    }
    else {
        let valid = true;
        $('#step-' + step + ' [required]:visible').each(function() {
            if (!$(this).val() || $(this).val().trim() === "") {
                $(this).addClass('is-invalid');
                valid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        return valid;
    }
}

function navigateStep(direction) {
    if (!validateStep(currentStep)) {
        return;
    }
    
    let formData = {};
    $('#' + getStepContainer(currentStep) + ' :input').each(function() {
        let fieldName = $(this).attr('name');
        if (fieldName) {
            formData[fieldName] = $(this).val();
        }
    });
    console.log('Datos del Step ' + currentStep + ' guardados:', formData);
    
    const newStep = currentStep + direction;
    if (newStep >= 1 && newStep <= totalSteps) {
        showStep(newStep);
    }
}

function getStepContainer(step) {
    if (step === 3) return 'step-inf_sobre_inspeccion';
    else if (step === 6) return 'step-estadisticas';
    else if (step === 7) return 'step-7';
    else if (step === 8) return 'step-no_publicidad';
    else if (step === 9) return 'step-emergencias';
    else return 'step-' + step;
}

$('form').off('submit').on('submit', function(e) {
    if (!validateStep(currentStep)) {
        e.preventDefault();
    }
});
