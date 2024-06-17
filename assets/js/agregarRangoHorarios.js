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
			var horario = {
				id: Date.now() + i,
				dia: dias[i],
				apertura: aperturaRango,
				cierre: cierreRango,
			};

			horarios.push(horario);

			var fila = tablaHorarios.insertRow();
			var celdaDia = fila.insertCell();
			celdaDia.textContent = dias[i];
			var celdaApertura = fila.insertCell();
			celdaApertura.textContent = aperturaRango;
			var celdaCierre = fila.insertCell();
			celdaCierre.textContent = cierreRango;

			var celdaAcciones = fila.insertCell();
			var btnEliminar = document.createElement("button");
			btnEliminar.textContent = "Eliminar";
			btnEliminar.classList.add("btn", "btn-danger");
			btnEliminar.dataset.id = horario.id;
			btnEliminar.type = "button";
			btnEliminar.addEventListener("click", function () {
				var row = this.closest("tr");
				var rowIndex = row.rowIndex;
				row.remove();
				var horarioId = this.dataset.id;
				horarios = horarios.filter(function (horario) {
					return horario.id !== parseInt(horarioId);
				});
			});
			celdaAcciones.appendChild(btnEliminar);
		}

		var modal = document.getElementById("modalAgregarRangoHorario");
		var modalBootstrap = bootstrap.Modal.getInstance(modal);
		modalBootstrap.hide();
	});
});
