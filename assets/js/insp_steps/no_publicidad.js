$(document).ready(function() {

    // Inicializar la visibilidad de la sección de detalles según la selección inicial
    if ($('select[name="Permitir_Publicidad"]').val() === 'no') {
        $('#noPublicidadDetails').show();
        // Si se muestra, aseguramos que el campo requerido tenga el atributo
        $('input[name="Documento_No_Publicidad"]').attr('required', true);
    } else {
        $('#noPublicidadDetails').hide();
        // Si se oculta, removemos el atributo required
        $('input[name="Documento_No_Publicidad"]').removeAttr('required');
    }

    // Mostrar/ocultar detalles según la selección de publicidad
    $('select[name="Permitir_Publicidad"]').change(function() {
        if ($(this).val() === 'no') {
            $('#noPublicidadDetails').show();
            $('input[name="Documento_No_Publicidad"]').attr('required', true);
            Swal.fire({
                title: 'Información',
                text: 'Conforme a la Estrategia Nacional de Mejora Regulatoria, los sujetos obligados podrán determinar la publicación parcial o total de la información, a fin de mantener la integridad o seguridad del servidor público.',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            });
        } else {
            $('#noPublicidadDetails').hide();
            // Remover el atributo required del input cuando se oculte la sección
            $('input[name="Documento_No_Publicidad"]').removeAttr('required');
        }
    });

    // Validación de campos obligatorios en el Step 8 "No Publicidad"
    // Se asume que el contenedor de este step tiene el id "step-8"
    $('#step-8 form').on('submit', function(e) {
        let valid = true;
        $('#step-8 input[required], #step-8 select[required]').each(function() {
            if ($(this).val().trim() === '') {
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

    console.log("no_publicidad.js iniciado");
});
