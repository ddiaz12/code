var horarios = [];
document.addEventListener("DOMContentLoaded", function () {
	var tablaHorarios = document.getElementById("tablaHorarios");
	var btnGuardarRangoHorario = document.getElementById(
		"btnGuardarRangoHorario"
	);

	var dias = [
		"domingo",
		"lunes",
		"martes",
		"miercoles",
		"jueves",
		"viernes",
		"sabado",
	];

	btnGuardarRangoHorario.addEventListener("click", function () {
		var diaDesde = dias.indexOf(document.getElementById("diaDesde").value);
		var diaHasta = dias.indexOf(document.getElementById("diaHasta").value);
		var aperturaRango = document.getElementById("aperturaRango").value;
		var cierreRango = document.getElementById("cierreRango").value;

		for (var i = diaDesde; i <= diaHasta; i++) {
			let horario = {
				id: Date.now() + i, // Identificador único
				dia: dias[i],
				apertura: aperturaRango,
				cierre: cierreRango,
			};

			horarios.push(horario);

			// Crear una nueva fila
			var fila = tablaHorarios.insertRow();

			// Crear celdas y agregar valores
			var celdaDia = fila.insertCell();
			celdaDia.textContent = dias[i];

			var celdaApertura = fila.insertCell();
			celdaApertura.textContent = aperturaRango;

			var celdaCierre = fila.insertCell();
			celdaCierre.textContent = cierreRango;

			// Crear celda para las acciones (eliminar)
			var celdaAcciones = fila.insertCell();
			var btnEliminar = document.createElement("button");
			btnEliminar.textContent = "Eliminar";
			btnEliminar.classList.add("btn", "btn-danger");
			btnEliminar.dataset.id = horario.id; // Agregar el identificador al botón
			btnEliminar.addEventListener("click", function () {
				// Eliminar la fila al hacer clic en el botón Eliminar
				fila.remove();

				// Eliminar el horario del array
				horarios = horarios.filter((h) => h.id != this.dataset.id);
			});
			celdaAcciones.appendChild(btnEliminar);
		}

		// Cerrar el modal
		var modal = document.getElementById("modalAgregarRangoHorario");
		var modalBootstrap = bootstrap.Modal.getInstance(modal);
		modalBootstrap.hide();
	});
});
