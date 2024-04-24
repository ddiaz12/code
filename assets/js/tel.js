$(document).ready(function() {
    $('#inputNumTel').on('input', function() {
        let num = $(this).val().replace(/\D/g,
            ''); // Elimina todos los caracteres que no sean dígitos
        num = num.substring(0, 10); // Limita el número a 10 dígitos

        // Formatea el número
        let formattedNum = '';
        for (let i = 0; i < num.length; i++) {
            if (i === 0) {
                formattedNum += '(' + num[i];
            } else if (i === 3) {
                formattedNum += ') ' + num[i];
            } else if (i === 6) {
                formattedNum += '-' + num[i];
            } else {
                formattedNum += num[i];
            }
        }

        $(this).val(
            formattedNum); 
    });
});