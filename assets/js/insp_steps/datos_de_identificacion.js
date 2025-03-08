var currentStep = 1;
var totalSteps = 9; // Ajusta este valor según la cantidad total de steps

$(document).ready(function() {

    /*************************************************
     * Funciones de toggle para mostrar/ocultar campos
     *************************************************/
    function toggleEspecificarOtra() {
        var selectedText = $('#tipoInspeccionSelect option:selected').text().trim();
        if (selectedText.toLowerCase() === 'otra') {
            $('#especificarOtra').show();
            $('input[name="Especificar_Otra"]').attr('required', true);
        } else {
            $('#especificarOtra').hide();
            $('input[name="Especificar_Otra"]').removeAttr('required');
        }
    }
    
    toggleEspecificarOtra();
    $('#tipoInspeccionSelect, select[name="Tipo_Inspeccion"]').change(function(){
        toggleEspecificarOtra();
    });

    function toggleLeyFomento() {
        if ($('input[name="Ley_Fomento"]:checked').val() === 'si') {
            $('#justificarLeyFomento').show();
            $('textarea[name="Justificacion_Ley_Fomento"]').attr('required', true);
        } else {
            $('#justificarLeyFomento').hide();
            $('textarea[name="Justificacion_Ley_Fomento"]').removeAttr('required');
        }
    }
    toggleLeyFomento();
    $('input[name="Ley_Fomento"]').change(function() {
        toggleLeyFomento();
    });

    function toggleEspecificarDirigidaA() {
        const selectedText = $('select[name="Dirigida_A"] option:selected').text().trim();
        if (selectedText.toLowerCase() === 'otras') {
            $('#especificarDirigidaA').show();
            $('input[name="Especificar_Dirigida_A"]').attr('required', true);
        } else {
            $('#especificarDirigidaA').hide();
            $('input[name="Especificar_Dirigida_A"]').removeAttr('required');
        }
    }
    toggleEspecificarDirigidaA();
    $('select[name="Dirigida_A"]').change(function() {
        toggleEspecificarDirigidaA();
    });

    function toggleEspecificarRealizadaEn() {
        const selectedText = $('select[name="Realizada_En"] option:selected').text().trim();
        if (selectedText.toLowerCase() === 'otro') {
            $('#especificarRealizadaEn').show();
            $('input[name="Especificar_Realizada_En"]').attr('required', true);
        } else {
            $('#especificarRealizadaEn').hide();
            $('input[name="Especificar_Realizada_En"]').removeAttr('required');
        }
    }
    toggleEspecificarRealizadaEn();
    $('select[name="Realizada_En"]').change(function() {
        toggleEspecificarRealizadaEn();
    });

    function toggleEspecificarMotivoInspeccion() {
        const selectedText = $('select[name="Motivo_Inspeccion"] option:selected').text().trim();
        if (selectedText.toLowerCase() === 'otro') {
            $('#especificarMotivoInspeccion').show();
            $('input[name="Especificar_Motivo_Inspeccion"]').attr('required', true);
        } else {
            $('#especificarMotivoInspeccion').hide();
            $('input[name="Especificar_Motivo_Inspeccion"]').removeAttr('required');
        }
    }
    toggleEspecificarMotivoInspeccion();
    $('select[name="Motivo_Inspeccion"]').change(function() {
        toggleEspecificarMotivoInspeccion();
    });

    /*************************************************
     * Mostrar/ocultar botón y contenedor de Fundamento
     *************************************************/
    $('#btnAddFundamento, #fundamentosContainer').toggle($('input[name="Fundamento_Juridico"]:checked').val() === 'si');
    $('input[name="Fundamento_Juridico"]').change(function() {
        $('#btnAddFundamento, #fundamentosContainer').toggle($(this).val() === 'si');
    });

    /*************************************************
     * Modal de Fundamento: agregar y eliminar filas
     *************************************************/
    $('#btnAddFundamento').click(function() {
        $('#modalFundamento').modal('show'); 
    });
    
    $('#btnGuardarFundamento').off('click').on('click', function() {
        console.log('Evento #btnGuardarFundamento disparado');
        let tipo = $('#tipoOrdenamiento').val().trim();
        let nombre = $('#nombreOrdenamiento').val().trim();
        let tipoTexto = $('#tipoOrdenamiento option:selected').text().trim();
        console.log('tipo:', tipo, 'nombre:', nombre);

        if (tipo === "" || tipo === "0" || nombre === "") {
            Swal.fire({
                icon: 'error',
                title: 'Campos requeridos',
                text: 'Debes seleccionar el Tipo de ordenamiento y capturar el Nombre',
                confirmButtonColor: '#8E354A'
            });
            return;
        }
        let fila = `
            <tr>
                <td>${tipoTexto}</td>
                <td>${nombre}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm btnBorrarFundamento">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#tablaFundamentos tbody').append(fila);
        $('#modalFundamento').modal('hide');
        $('#tipoOrdenamiento, #nombreOrdenamiento, #articulo, #fraccion, #inciso, #parrafo, #numero, #letra, #otro').val('');
        Swal.fire({
            icon: 'success',
            title: 'Fundamento agregado',
            text: 'Se ha agregado un fundamento jurídico a la lista.',
            confirmButtonColor: '#8E354A',
            timer: 1500
        });
    });
    
    $('#tablaFundamentos').on('click', '.btnBorrarFundamento', function() {
        $(this).closest('tr').remove();
    });
    
    // Validación en tiempo real para campos tipo URL
    $('input[type="url"]').on('input', function() {
        if (!this.checkValidity()) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    /*************************************************
     * Función para validar el formulario de Datos de Identificación
     *************************************************/
    function validateInspeccion() {
        let valid = true;
        let errorFields = [];

        // Validar Nombre de Inspección
        let nombre = $('input[name="Nombre_Inspeccion"]').val().trim();
        if (nombre === "") {
            valid = false;
            errorFields.push("El campo Nombre de la Inspección es obligatorio.");
            $('input[name="Nombre_Inspeccion"]').addClass('is-invalid');
        } else {
            $('input[name="Nombre_Inspeccion"]').removeClass('is-invalid');
        }

        // Validar Sujeto Obligado
        let sujeto = $('select[name="Sujeto_Obligado_ID"]').val();
        if (!sujeto || sujeto === "") {
            valid = false;
            errorFields.push("El campo Sujeto Obligado es obligatorio.");
            $('select[name="Sujeto_Obligado_ID"]').addClass('is-invalid');
        } else {
            $('select[name="Sujeto_Obligado_ID"]').removeClass('is-invalid');
        }

        // Validar Tipo de Inspección
        let tipo = $('select[name="Tipo_Inspeccion"]').val().trim();
        if (tipo === "0" || tipo === "") {
            valid = false;
            errorFields.push("El campo Tipo de Inspección es obligatorio.");
            $('select[name="Tipo_Inspeccion"]').addClass('is-invalid');
        } else {
            $('select[name="Tipo_Inspeccion"]').removeClass('is-invalid');
        }
        
        // Si se seleccionó “Otra”, validar el campo Especificar Otra
        let tipoText = $('#tipoInspeccionSelect option:selected').text().trim().toLowerCase();
        if (tipoText === "otra") {
            let especificarOtra = $('input[name="Especificar_Otra"]').val().trim();
            if (especificarOtra === "") {
                valid = false;
                errorFields.push("Debe especificar el Tipo de Inspección cuando se selecciona 'Otra'.");
                $('input[name="Especificar_Otra"]').addClass('is-invalid');
            } else {
                $('input[name="Especificar_Otra"]').removeClass('is-invalid');
            }
        }

        // Validar Justificación de Ley de Fomento si se selecciona “si”
        let leyFomento = $('input[name="Ley_Fomento"]:checked').val();
        if (leyFomento === 'si') {
            let justificacion = $('textarea[name="Justificacion_Ley_Fomento"]').val().trim();
            if (justificacion === "") {
                valid = false;
                errorFields.push("Debe proporcionar la Justificación de la Ley de Fomento.");
                $('textarea[name="Justificacion_Ley_Fomento"]').addClass('is-invalid');
            } else {
                $('textarea[name="Justificacion_Ley_Fomento"]').removeClass('is-invalid');
            }
        }
        
        // Validar campo "Dirigida A" si se selecciona “Otras”
        let dirigidaText = $('select[name="Dirigida_A"] option:selected').text().trim().toLowerCase();
        if (dirigidaText === "otras") {
            let especificarDirigida = $('input[name="Especificar_Dirigida_A"]').val().trim();
            if (especificarDirigida === "") {
                valid = false;
                errorFields.push("Debe especificar a quién se dirige la inspección.");
                $('input[name="Especificar_Dirigida_A"]').addClass('is-invalid');
            } else {
                $('input[name="Especificar_Dirigida_A"]').removeClass('is-invalid');
            }
        }

        // Validar Realizada en si se selecciona “Otro”
        let realizadaText = $('select[name="Realizada_En"] option:selected').text().trim().toLowerCase();
        if (realizadaText === "otro") {
            let especificarRealizada = $('input[name="Especificar_Realizada_En"]').val().trim();
            if (especificarRealizada === "") {
                valid = false;
                errorFields.push("Debe especificar dónde se realizó la inspección.");
                $('input[name="Especificar_Realizada_En"]').addClass('is-invalid');
            } else {
                $('input[name="Especificar_Realizada_En"]').removeClass('is-invalid');
            }
        }

        // Validar Motivo de Inspección si se selecciona “Otro”
        let motivoText = $('select[name="Motivo_Inspeccion"] option:selected').text().trim().toLowerCase();
        if (motivoText === "otro") {
            let especificarMotivo = $('input[name="Especificar_Motivo_Inspeccion"]').val().trim();
            if (especificarMotivo === "") {
                valid = false;
                errorFields.push("Debe especificar el Motivo de la Inspección.");
                $('input[name="Especificar_Motivo_Inspeccion"]').addClass('is-invalid');
            } else {
                $('input[name="Especificar_Motivo_Inspeccion"]').removeClass('is-invalid');
            }
        }

        // Validar URL de Trámite, si se ingresa
        let urlTramite = $('input[name="URL_Tramite_Servicio"]').val().trim();
        if (urlTramite !== "") {
            const urlPattern = /^https?:\/\/([\w\-]+\.)+[\w\-]{2,}(\/[\w\-._~:\/?#[\]@!$&'()*+,;=]*)?$/i;
            if (!urlPattern.test(urlTramite)) {
                valid = false;
                errorFields.push("El campo URL de Trámite debe contener una URL válida (con http:// o https://).");
                $('input[name="URL_Tramite_Servicio"]').addClass('is-invalid');
            } else {
                $('input[name="URL_Tramite_Servicio"]').removeClass('is-invalid');
            }
        }

        if (!valid) {
            Swal.fire({
                icon: 'error',
                title: 'Errores en el formulario',
                html: errorFields.join("<br>"),
                confirmButtonColor: '#8E354A'
            });
        }
        return valid;
    }

    $('form').on('submit', function(e){
        if (!validateInspeccion()){
            e.preventDefault();
        }
    });
});

function cerrarModalFundamento() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Los cambios no guardados se perderán",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#8E354A',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, cerrar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#modalFundamento').modal('hide');
        }
    });
}

function mostrarModalFundamento() {
    $('#modalFundamento').modal('show');
}

/*************************************************
     * Función para validar el formulario de Datos de Identificación
     *************************************************/
function validateDatosIdentificacion() {
    let valid = true;
    // Ahora se validan solo los campos visibles
    $('#step-1 input[required]:visible, #step-1 select[required]:visible, #step-1 textarea[required]:visible').each(function() {
        if ($(this).val().trim() === "") {
            valid = false;
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    return valid;
}

window.validateDatosIdentificacion = validateDatosIdentificacion;