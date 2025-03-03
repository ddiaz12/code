$(document).ready(function() {
    // Tipo de inspección -> "Otra"
    $('select[name="Tipo_Inspeccion"]').change(function(){
        if ($(this).val() === 'Otra') {
            $('#especificarOtra').show();
        } else {
            $('#especificarOtra').hide();
        }
    });

    // Ley de Fomento
    $('input[name="Ley_Fomento"]').change(function(){
        if ($(this).val() === 'si') {
            $('#justificarLeyFomento').show();
        } else {
            $('#justificarLeyFomento').hide();
        }
    });

    // Dirigida a
    $('select[name="Dirigida_A"]').change(function(){
        if ($(this).val() === 'Otras') {
            $('#especificarDirigidaA').show();
        } else {
            $('#especificarDirigidaA').hide();
        }
    });

    // Realizada en
    $('select[name="Realizada_En"]').change(function(){
        if ($(this).val() === 'Otro') {
            $('#especificarRealizadaEn').show();
        } else {
            $('#especificarRealizadaEn').hide();
        }
    });

    // Motivo de Inspección
    $('select[name="Motivo_Inspeccion"]').change(function(){
        if ($(this).val() === 'Otro') {
            $('#especificarMotivoInspeccion').show();
        } else {
            $('#especificarMotivoInspeccion').hide();
        }
    });

    // Mostrar/ocultar el botón "Añadir Fundamento"
    if ($('input[name="Fundamento_Juridico"]:checked').val() === 'si') {
        $('#btnAddFundamento').show();
    } else {
        $('#btnAddFundamento').hide();
    }
    $('input[name="Fundamento_Juridico"]').change(function() {
        if ($(this).val() === 'si') {
            $('#btnAddFundamento').show();
        } else {
            $('#btnAddFundamento').hide();
        }
    });
});
