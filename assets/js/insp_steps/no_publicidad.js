$(document).ready(function() {

    // Función para actualizar la visibilidad y el atributo "required" del input de archivo
    function updateNoPublicidadVisibility() {
        // Obtener y normalizar el valor del select Permitir_Publicidad
        var permiso = $('select[name="Permitir_Publicidad"]').val().trim().toLowerCase();
        console.log('Valor de Permitir_Publicidad:', permiso);
        if (permiso === 'no') {
            // Si se selecciona "no", se muestra la sección de detalles y se añade required al input
            $('#noPublicidadDetails').show();
            $('input[name="Documento_No_Publicidad"]').attr('required', true);
        } else {
            // Si se selecciona "si" (u otro valor), se oculta la sección de detalles y se remueve el atributo required
            $('#noPublicidadDetails').hide();
            $('input[name="Documento_No_Publicidad"]').removeAttr('required');
        }
    }
    
    // Ejecutar al cargar la página
    updateNoPublicidadVisibility();
    
    // Actualizar la visibilidad cuando cambie el select
    $('select[name="Permitir_Publicidad"]').change(function() {
        updateNoPublicidadVisibility();
        if ($(this).val().trim().toLowerCase() === 'no') {
            Swal.fire({
                title: 'Información',
                text: 'Conforme a la Estrategia Nacional de Mejora Regulatoria, los sujetos obligados podrán determinar la publicación parcial o total de la información, a fin de mantener la integridad o seguridad del servidor público.',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            });
        }
    });

    // Validación de campos obligatorios en el Step 8 "No Publicidad"
    // Se asume que el contenedor de este step tiene el id "step-8"
    $('#step-8 form').on('submit', function(e) {
        let valid = true;
        // Se validan solo los inputs y selects que estén dentro del contenedor step-8
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
