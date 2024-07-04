$(document).ready(function () {
	$("#phone").on("input", function () {
		let num = $(this).val().replace(/\D/g, ""); // Elimina todos los caracteres que no sean dígitos
		num = num.substring(0, 10); // Limita el número a 10 dígitos

		// Formatea el número
		let formattedNum = "";
		for (let i = 0; i < num.length; i++) {
			if (i === 0) {
				formattedNum += "(" + num[i];
			} else if (i === 3) {
				formattedNum += ") " + num[i];
			} else if (i === 6) {
				formattedNum += "-" + num[i];
			} else {
				formattedNum += num[i];
			}
		}

		// Valida la longitud mínima del número formateado
		if (formattedNum.length >= 14) {
			$(this).val(formattedNum);
			$("#msg_phone").text(""); // Limpia el mensaje de error si el número es válido
		} else {
			// Muestra un mensaje de error al usuario
			$("#msg_phone").text("El número de teléfono es demasiado corto.");
		}
	});
});
