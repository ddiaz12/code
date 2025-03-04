$(document).ready(function() {
    // Inicializar visibilidad de la sección de detalles
    if ($('select[name="Permitir_Publicidad"]').val() === 'no') {
        $('#noPublicidadDetails').show();
    } else {
        $('#noPublicidadDetails').hide();
    }

    // Mostrar/ocultar detalles según selección de publicidad
    $('select[name="Permitir_Publicidad"]').change(function() {
        if ($(this).val() == 'no') {
            $('#noPublicidadDetails').show();
            Swal.fire({
                title: 'Información',
                text: 'Conforme a la Estrategia Nacional de Mejora Regulatoria, los sujetos obligados podrán determinar la publicación parcial o total de la información, a fin de mantener la integridad o seguridad del servidor público.',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            });
        } else {
            $('#noPublicidadDetails').hide();
        }
    });

    // Validación de campos obligatorios
    $('form').on('submit', function(e) {
        let valid = true;

        // Validar que los campos obligatorios no estén vacíos
        $('input[required], select[required]').each(function() {
            if ($(this).val() === '') {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!valid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos requeridos',
                text: 'Por favor complete todos los campos obligatorios.',
                confirmButtonColor: '#8E354A'
            });
        }
    });
});
