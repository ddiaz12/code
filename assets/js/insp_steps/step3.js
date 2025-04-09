$(document).ready(function() {
    /**
     * Función para mostrar u ocultar un contenedor y asignar o quitar el atributo "required"
     * @param {string} selectorContenedor - Selector del contenedor a mostrar u ocultar
     * @param {string} selectorInput - Selector del input al cual se le asigna o quita "required"
     * @param {boolean} show - Si es true, se muestra el contenedor y se asigna "required"; de lo contrario, se oculta y se quita.
     */
    function toggleContainer(selectorContenedor, selectorInput, show) {
        if(show) {
            $(selectorContenedor).show();
            $(selectorInput).attr('required', true);
        } else {
            $(selectorContenedor).hide();
            $(selectorInput).removeAttr('required');
        }
    }

    // Declarar el arreglo global para almacenar las obligaciones
    let obligacionesArray = [];

    /**********************
     * Sujetos Obligados
     **********************/
    // Toggle para "Otros_Sujetos_Participan"
    $('select[name="Otros_Sujetos_Participan"]').change(function () {
        let show = $(this).val() === 'si';
        toggleContainer('#sujetosObligados', 'input[name="Buscar_Sujeto_Obligado"]', show);
    });
    // Ejecutar al cargar la página
    if ($('select[name="Otros_Sujetos_Participan"]').val() === 'si') {
        toggleContainer('#sujetosObligados', 'input[name="Buscar_Sujeto_Obligado"]', true);
    }

    // Modal "Buscar Sujetos"
    $('#buscarSujetosBtn').click(function() {
        $('#sujetosModal').modal('show');
    });

    // Seleccionar un sujeto desde el modal
    $(document).on('click', '.seleccionarSujetoBtn', function() {
        let sujeto = $(this).data('sujeto');
        console.log('Sujeto seleccionado:', sujeto);
        if (!sujeto) {
            console.warn('El dato "sujeto" es undefined. Revisa el atributo data-sujeto en el HTML.');
            return;
        }
        $('input[name="Buscar_Sujeto_Obligado"]').val(sujeto);
        $('#sujetosModal').modal('hide');
    });

    // Botón Aceptar en el modal simplemente cierra el mismo
    $('#aceptarSujetoBtn').click(function() {
        $('#sujetosModal').modal('hide');
    });

    // Búsqueda dinámica de sujetos obligados con AJAX
    $('#buscarSujetosInput').on('input', function() {
        let searchTerm = $(this).val().toLowerCase();
        $.ajax({
            url: '<?= base_url("InspeccionesController/buscarSujetosObligados") ?>',
            type: 'POST',
            data: { search_term: searchTerm },
            dataType: 'json',
            success: function(data) {
                console.log('Datos de sujetos obligados:', data);
                $('#sujetosTable tbody').empty();
                if (data.length > 0) {
                    data.forEach(function(sujeto) {
                        $('#sujetosTable tbody').append(
                            `<tr>
                                <td>${sujeto.nombre_sujeto}</td>
                                <td>
                                    <button type="button" class="btn btn-primary seleccionarSujetoBtn" data-sujeto="${sujeto.nombre_sujeto}">
                                        Seleccionar
                                    </button>
                                </td>
                            </tr>`
                        );
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Sujeto Obligado no encontrado',
                        confirmButtonColor: '#8E354A'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la búsqueda de sujetos:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al buscar los sujetos obligados.',
                    confirmButtonColor: '#8E354A'
                });
            }
        });
    });

    /**********************
     * Derechos y Obligaciones
     **********************/
    // Inicialmente deshabilitar el botón "Agregar Derecho"
    $('input[name="Derecho_Sujeto_Regulado"]').prop('disabled', false); // Aseguramos que el input esté disponible
    $('#agregarDerechoBtn').prop('disabled', true);

    // Activar/desactivar el botón "Agregar Derecho" según el contenido del input
    $('input[name="Derecho_Sujeto_Regulado"]').on('input', function() {
        let valor = $(this).val().trim();
        if (valor !== "") {
            $('#agregarDerechoBtn').prop('disabled', false);
        } else {
            $('#agregarDerechoBtn').prop('disabled', true);
        }
    });

    // Quitar Derecho
    $('#derechosList').on('click', '.quitarDerechoBtn', function() {
        $(this).parent().remove();
    });

    // Inicialmente deshabilitar el botón "Agregar Obligación"
    $('#agregarObligacionBtn').prop('disabled', true);

    // Activar/desactivar el botón "Agregar Obligación" según el contenido del input
    $('#obligacionInput').on('input', function() {
        let obligacionTexto = $(this).val().trim();
        if (obligacionTexto !== "") {
            $('#agregarObligacionBtn').prop('disabled', false);
        } else {
            $('#agregarObligacionBtn').prop('disabled', true);
        }
    });

    // Función para actualizar la visibilidad de la tabla de obligaciones
    function actualizarVisibilidadTablaObligaciones() {
        if ($('#tablaObligaciones tbody tr').length === 0) {
            $('#tablaObligaciones').hide(); // Oculta la tabla si no hay filas
        } else {
            $('#tablaObligaciones').show(); // Muestra la tabla si hay filas
        }
    }

    // Al hacer clic en "Agregar Obligación"
    $('#agregarObligacionBtn').click(function() {
        let obligacionTexto = $('#obligacionInput').val();
        if (!obligacionTexto || obligacionTexto.trim() === '') {
            alert('Por favor, escribe una obligación.');
            return;
        }
        $('#modalAgregarObligacion').modal('show');
    });

    // En el modal, al confirmar "Guardar"
    $('#guardarObligacionModalBtn').click(function() {
        let obligacionTexto = $('#obligacionInput').val().trim();
        let idTipoOrd = $('#selectTipoOrdenamientoObligacion').val();
        let tipoOrdTexto = $('#selectTipoOrdenamientoObligacion option:selected').text();
        let articulo = $('#inputArticuloObligacion').val().trim();
        let inciso = $('#inputIncisoObligacion').val().trim();
        let parrafo = $('#inputParrafoObligacion').val().trim();
        let numero = $('#inputNumeroObligacion').val().trim();
        let letra = $('#inputLetraObligacion').val().trim();
        let otros = $('#inputOtrosObligacion').val().trim();

        if (!idTipoOrd) {
            alert('Seleccione un tipo de ordenamiento.');
            return;
        }

        let obligacionObj = {
            obligacion: obligacionTexto,
            ID_tOrdJur: idTipoOrd,
            TipoOrdenamiento: tipoOrdTexto,
            NombreOrdenamiento: $('#nombreOrdenamientoObligacion').val(),
            Articulo: articulo,
            Inciso: inciso,
            Parrafo: parrafo,
            Numero: numero,
            Letra: letra,
            Otros: otros
        };

        obligacionesArray.push(obligacionObj);
        $('#inputObligacionesOculto').val(JSON.stringify(obligacionesArray));

        let nuevaFila = `
            <tr>
                <td>${obligacionTexto}</td>
                <td>${tipoOrdTexto}</td>
                <td>${$('#nombreOrdenamientoObligacion').val()}</td>
                <td>${articulo}</td>
                <td>${inciso}</td>
                <td>${parrafo}</td>
                <td>${numero}</td>
                <td>${letra}</td>
                <td>${otros}</td>
                <td><button type="button" class="btn btn-danger btn-sm eliminarObligacion">Eliminar</button></td>
            </tr>
        `;
        $('#tablaObligaciones tbody').append(nuevaFila);

        // Actualiza la visibilidad de la tabla
        actualizarVisibilidadTablaObligaciones();

        $('#selectTipoOrdenamientoObligacion').val('');
        $('#inputArticuloObligacion').val('');
        $('#inputIncisoObligacion').val('');
        $('#inputParrafoObligacion').val('');
        $('#inputNumeroObligacion').val('');
        $('#inputLetraObligacion').val('');
        $('#inputOtrosObligacion').val('');
        $('#modalAgregarObligacion').modal('hide');
        $('#obligacionInput').val('');
    });

    // Eliminar fila de la tabla y actualizar el arreglo
    $('#tablaObligaciones').on('click', '.eliminarObligacion', function() {
        let rowIndex = $(this).closest('tr').index();
        obligacionesArray.splice(rowIndex, 1);
        $('#inputObligacionesOculto').val(JSON.stringify(obligacionesArray));
        $(this).closest('tr').remove();

        // Actualiza la visibilidad de la tabla
        actualizarVisibilidadTablaObligaciones();
    });

    // Inicializa la visibilidad de la tabla al cargar la página
    actualizarVisibilidadTablaObligaciones();

    /**********************
     * Firmar Formato y Validación de Archivo
     **********************/
    // Toggle para "Firmar_Formato"
    $('select[name="Firmar_Formato"]').change(function() {
        let show = $(this).val() === 'si';
        toggleContainer('#formatoUpload', 'input[name="Archivo_Formato"]', show);
    });

    // Ejecutar al cargar la página para establecer el estado inicial
    if ($('select[name="Firmar_Formato"]').val() === 'si') {
        toggleContainer('#formatoUpload', 'input[name="Archivo_Formato"]', true);
    } else {
        toggleContainer('#formatoUpload', 'input[name="Archivo_Formato"]', false);
    }

    // Validar el tipo de archivo al cargar el input
    $('input[name="Archivo_Formato"]').on('change', function() {
        let file = this.files[0];
        if (file) {
            let allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
            if (allowedTypes.indexOf(file.type) === -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Formato inválido',
                    text: 'Solo se permiten archivos JPG, PNG o PDF.',
                    confirmButtonColor: '#8E354A'
                });
                $(this).val(''); // Reinicia el input
            }
        }
    });

    /**********************
     * Mensaje de inicio y depuración
     **********************/
    console.log("inf_sobre_inspeccion.js iniciado");

    // Verificar e imprimir en consola los valores iniciales de los campos requeridos y visibles en este step
    $('#step-inf_sobre_inspeccion [required]:visible').each(function() {
        console.log('inf_sobre_inspeccion: Validating field:', $(this).attr('name'), 'Value:', $(this).val());
    });

    // ===============================
    // Función de validación para el Step 3
    // ===============================
    function validateInfSobreInspeccion() {
        let valid = true;
        // Solo validar los campos requeridos que estén visibles en el contenedor del step 3
        $('#step-inf_sobre_inspeccion input[required]:visible, #step-inf_sobre_inspeccion select[required]:visible, #step-inf_sobre_inspeccion textarea[required]:visible').each(function() {
            if ($(this).val().trim() === "") {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        return valid;
    }

    // Hacer que la función esté disponible globalmente
    window.validateInfSobreInspeccion = validateInfSobreInspeccion;

    // Arreglo para almacenar los derechos agregados
    let derechosArray = [];

    // Habilitar/deshabilitar el botón "Agregar Derecho" según el contenido del campo "derechoInput"
    $('#derechoInput').on('input', function() {
        let texto = $(this).val().trim();
        if (texto === "") {
            $('#agregarDerechoBtn').prop('disabled', true).css('background-color', 'grey');
        } else {
            $('#agregarDerechoBtn').prop('disabled', false).css('background-color', '');
        }
    });

    // Asegurarse de que el botón inicie deshabilitado si el campo está vacío
    if ($('#derechoInput').val().trim() === "") {
        $('#agregarDerechoBtn').prop('disabled', true).css('background-color', 'grey');
    }
    
    // Al hacer clic en el botón "Agregar Derecho"
    $('#agregarDerechoBtn').click(function() {
        let derechoTexto = $('#derechoInput').val();
        // Si el valor es undefined, asignar cadena vacía y usar trim
        derechoTexto = (typeof derechoTexto === 'string' ? derechoTexto.trim() : '');
        if (derechoTexto === '') {
            alert('Por favor, escribe un derecho.');
            return;
        }
        // Abrir el modal para seleccionar el tipo de ordenamiento
        $('#modalAgregarDerecho').modal('show');
    });

    // Al confirmar en el modal
    $('#guardarModalBtn').click(function() {
        let derechoTexto = $('#derechoInput').val();
        derechoTexto = (typeof derechoTexto === 'string' ? derechoTexto.trim() : '');
        
        let tipoOrdenamiento = $('#selectTipoOrdenamiento').val();
        if (tipoOrdenamiento === '') {
            alert('Por favor, seleccione un Tipo de ordenamiento.');
            return;
        }
        
        // Verificar que el input exista dentro del modal
        let nombreOrdenamientoElem = $('#modalAgregarDerecho').find('#nombreOrdenamiento');
        if(nombreOrdenamientoElem.length === 0) {
            alert('El campo "Nombre del ordenamiento" no se encuentra en el modal.');
            return;
        }
        let nombreOrdenamiento = nombreOrdenamientoElem.val();
        if (typeof nombreOrdenamiento !== 'string') {
            nombreOrdenamiento = "";
        } else {
            nombreOrdenamiento = nombreOrdenamiento.trim();
        }
        if (nombreOrdenamiento === "") {
            alert('Por favor, ingrese el Nombre del ordenamiento.');
            return;
        }
                let tipoOrdenamientoTexto = $('#selectTipoOrdenamiento option:selected').text();
        
        let articulo = $('#modalAgregarDerecho').find('#articulo').val() || '';
        let fraccion = $('#modalAgregarDerecho').find('#fraccion').val() || '';
        let incisio = $('#modalAgregarDerecho').find('#incisio').val() || '';
        let parrafo = $('#modalAgregarDerecho').find('#parrafo').val() || '';
        let numero = $('#modalAgregarDerecho').find('#numero').val() || '';
        let letra = $('#modalAgregarDerecho').find('#letra').val() || '';
        let otros = $('#modalAgregarDerecho').find('#otros').val() || '';
        
        let derechoObj = {
            texto: derechoTexto,
            ID_tOrdJur: tipoOrdenamiento,
            TipoOrdenamiento: tipoOrdenamientoTexto,
            NombreOrdenamiento: nombreOrdenamiento,
            Articulo: articulo,
            Fraccion: fraccion,
            Incisio: incisio,
            Parrafo: parrafo,
            Numero: numero,
            Letra: letra,
            Otros: otros
        };
        
        derechosArray.push(derechoObj);
        $('#inputDerechosOculto').val(JSON.stringify(derechosArray));
        
        let nuevaFila = `
            <tr>
                <td>${derechoTexto}</td>
                <td>${tipoOrdenamientoTexto}</td>
                <td>${nombreOrdenamiento}</td>
                <td>${articulo}</td>
                <td>${incisio}</td>
                <td>${parrafo}</td>
                <td>${numero}</td>
                <td>${letra}</td>
                <td>${otros}</td>
                <td><button type="button" class="btn btn-danger btn-sm eliminarFila">Eliminar</button></td>
            </tr>
        `;
        $('#tablaDerechos tbody').append(nuevaFila);
        
        $("#tablaDerechosContainer").show();

        // Limpiar campos y cerrar modal
        $('#derechoInput').val('');
        $('#selectTipoOrdenamiento').val('');
        $('#modalAgregarDerecho').find('#nombreOrdenamiento').val('');
        $('#modalAgregarDerecho').find('#articulo').val('');
        $('#modalAgregarDerecho').find('#fraccion').val('');
        $('#modalAgregarDerecho').find('#incisio').val('');
        $('#modalAgregarDerecho').find('#parrafo').val('');
        $('#modalAgregarDerecho').find('#numero').val('');
        $('#modalAgregarDerecho').find('#letra').val('');
        $('#modalAgregarDerecho').find('#otros').val('');
        $('#modalAgregarDerecho').modal('hide');
    });

    // Permitir eliminar una fila y quitar el derecho del array
    $('#tablaDerechos').on('click', '.eliminarFila', function() {
        let rowIndex = $(this).closest('tr').index();
        // Eliminar del array
        derechosArray.splice(rowIndex, 1);
        // Actualizar el input oculto
        $('#inputDerechosOculto').val(JSON.stringify(derechosArray));
        // Eliminar la fila de la tabla
        $(this).closest('tr').remove();
    });
});
