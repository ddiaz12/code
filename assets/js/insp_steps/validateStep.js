function validateStep(step) {
    let valid = true;
    // Recorre todos los campos requeridos del step actual
    $('#step-' + step + ' [required]').each(function() {
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
    return valid;
}

// Asegurarse de que no haya duplicidad en los manejadores de validación
$('form').off('submit').on('submit', function(e) {
    if (!validateStep(currentStep)) {
        e.preventDefault();
    }
});
