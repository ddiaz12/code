function validateStep(step) {
    let valid = true;
    // Recorre todos los campos requeridos del step actual
    $('#step-' + step + ' [required]').each(function() {
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
