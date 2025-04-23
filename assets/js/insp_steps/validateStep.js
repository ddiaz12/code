var currentStep = 1;
var totalSteps = 9; // El número total de pasos

function validateStep(step) {
    // Step 1: Datos de Identificación
    if (step === 1) {
        return validateDatosIdentificacion();
    }
    // Step 2: Autoridad Pública (sin validación extra)
    else if (step === 2) {
        return true;
    }
    // Step 3: Información sobre la inspección
    else if (step === 3) {
        return validateInfSobreInspeccion();
    }
    // Step 4: Más detalles
    else if (step === 4) {
        return validateMasdetalleStep();
    }
    // Step 5: Autoridad Pública y Contacto
    else if (step === 5) {
        return validateInfAutPubContacto();
    }
    // Step 6: Estadísticas
    else if (step === 6) {
        let valid = true;
        $('#step-6 [required]:visible').each(function() {
            if (!$(this).val().trim()) {
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
                text: 'Por favor completa todos los campos obligatorios.',
                confirmButtonColor: '#8E354A'
            });
        }
        return valid;
    }
    // Step 7: Información adicional (sin validación extra)
    else if (step === 7) {
        return true;
    }
    // Step 8: No publicidad
    else if (step === 8) {
        let valid = true;
        $('#step-8 [required]:visible').each(function() {
            if (!$(this).val().trim()) {
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
                text: 'Por favor completa todos los campos obligatorios.',
                confirmButtonColor: '#8E354A'
            });
        }
        return valid;
    }
    // Step 9: Emergencias (sin validación extra)
    else if (step === 9) {
        return true;
    }
    // Por defecto si añadieras más pasos
    else {
        let valid = true;
        $('#step-' + step + ' [required]:visible').each(function() {
            if (!$(this).val().trim()) {
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
    if (!validateStep(currentStep)) return;

    // avanzar o retroceder
    const newStep = currentStep + direction;
    if (newStep >= 1 && newStep <= totalSteps) {
        showStep(newStep);
    }
}

// Ajuste para que recoja inputs del paso correcto
function getStepContainer(step) {
    // usamos siempre el mismo id="step-#"
    return 'step-' + step;
}

// Enlace con el formulario (para bloqueo de submit)
$('form').off('submit').on('submit', function(e) {
    if (!validateStep(currentStep)) e.preventDefault();
});
