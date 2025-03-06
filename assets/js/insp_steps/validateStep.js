function validateStep(step) {
    let valid = true;
    // Recorre solo los campos requeridos que están visibles en el step actual
    $('#step-' + step + ' [required]:visible').each(function() {
        console.log('Validating field:', $(this).attr('name'), 'Value:', $(this).val());
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
            text: 'Por favor, complete todos los campos obligatorios en este paso.',
            confirmButtonColor: '#8E354A'
        });
    }
    console.log(`Validation for step ${step}: ${valid ? 'valid' : 'invalid'}`);
    return valid;
}

function showStep(step) {
    // Quitar la clase 'active' de todos los steps
    $('.form-step').removeClass('active');
    // Agregar la clase 'active' solo al step a mostrar
    $('#step-' + step).addClass('active');
}

function navigateStep(direction) {
    // Validar el step actual solo si tiene campos obligatorios
    if ($('#step-' + currentStep + ' [required]:visible').length > 0 && !validateStep(currentStep)) {
        return;
    }
    // Calcular el nuevo step
    const newStep = currentStep + direction;
    // Asegurarse de que el nuevo step esté en el rango permitido
    if(newStep >= 1 && newStep <= totalSteps) {
        showStep(newStep);
        currentStep = newStep;
    }
}

// Evitar duplicidad en los manejadores de envío
$('form').off('submit').on('submit', function(e) {
    if (!validateStep(currentStep)) {
        e.preventDefault();
    }
});
