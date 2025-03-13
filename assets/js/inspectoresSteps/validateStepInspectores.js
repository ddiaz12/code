// validateStepInspectores.js

// Variables globales para los pasos
var currentStep = 1;
var totalSteps = 4; // Asegurar que totalSteps incluya el Step 4

function validateStep(step) {
    // Step 1: Datos de Identificación
    if (step === 1) {
        return (typeof validateDatosBasicos === 'function') ? validateDatosBasicos() : true;
    }
    // Step 2: Autoridad Pública
    else if (step === 2) {
        return (typeof validateStep2 === 'function') ? validateStep2() : true;
    }
    // Step 3: No publicidad
    else if (step === 3) {
        return (typeof validateNoPublicidad === 'function') ? validateNoPublicidad() : true;
    }
    // Step 4: Emergencias
    else if (step === 4) {
        return (typeof validateEmergencias === 'function') ? validateEmergencias() : true;
    }
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

function showStep(step) {
    // Oculta todos los steps y muestra solo el actual
    $('.form-step').removeClass('active');
    $('#step-' + step).addClass('active');
    
    // Actualiza la sidebar de navegación
    $('.wizard-step').removeClass('active');
    $('.wizard-step[data-step="' + step + '"]').addClass('active');
    
    // Actualiza la visibilidad de los botones de navegación
    if (step === 1) {
        $('#prevBtn').hide();
    } else {
        $('#prevBtn').show();
    }
    if (step === totalSteps) {
        $('#nextBtn').hide();
        $('#submitBtn').show();
    } else {
        $('#nextBtn').show();
        $('#submitBtn').hide();
    }
    
    currentStep = step;
}

function navigateStep(direction) {
    if (!validateStep(currentStep)) {
        return;
    }
    
    // (Opcional) Recopilar datos del step actual para depuración
    let formData = {};
    $('#step-' + currentStep + ' :input').each(function() {
        let name = $(this).attr('name');
        if (name) {
            formData[name] = $(this).val();
        }
    });
    console.log("Datos del Step " + currentStep + " guardados:", formData);
    
    const newStep = currentStep + direction;
    if (newStep >= 1 && newStep <= totalSteps) {
        showStep(newStep);
    }
}

// Validación global al enviar el formulario
$('form').off('submit').on('submit', function(e) {
    if (!validateStep(currentStep)) {
        e.preventDefault();
    }
});

$(document).ready(function() {
    showStep(1);
    // La navegación por sidebar se ha deshabilitado
});
