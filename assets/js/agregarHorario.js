var horarios = [];
var horariosEliminados = [];

document.addEventListener("DOMContentLoaded", function () {
	var tablaHorarios = document.getElementById("tablaHorarios");
	var btnGuardarHorario = document.getElementById("btnGuardarHorario");

	// Función para limpiar el modal
	function limpiarModalHorario() {
		document.getElementById("dia").selectedIndex = 0; // Restablecer el select
		document.getElementById("apertura").value = ""; // Limpiar campo de apertura
		document.getElementById("cierre").value = ""; // Limpiar campo de cierre
	}

	// Limpiar el modal cada vez que se abre
	document
		.getElementById("modalAgregarHorario")
		.addEventListener("show.bs.modal", function () {
			limpiarModalHorario();
		});

	btnGuardarHorario.addEventListener("click", function () {
		var dia = document.getElementById("dia").value;
		var apertura = document.getElementById("apertura").value;
		var cierre = document.getElementById("cierre").value;

		// Validar campos en blanco
		if (!apertura || !cierre) {
			Swal.fire({
				icon: 'warning',
				title: 'Campos incompletos',
				text: 'Por favor, complete todos los campos.'
			});
			return;
		}

		// Validar horarios duplicados
		let horarioDuplicado = horarios.some((h) => h.dia === dia);
		if (horarioDuplicado) {
			Swal.fire({
				icon: 'error',
				title: 'Horario duplicado',
				text: 'Este horario ya existe.'
			});
			return;
		}

		let horario = {
			id: Date.now(), // Identificador único
			dia: dia,
			apertura: apertura,
			cierre: cierre,
		};

		horarios.push(horario);

		// Crear una nueva fila
		var fila = tablaHorarios.insertRow();

		// Crear celdas y agregar valores
		var celdaDia = fila.insertCell();
		celdaDia.textContent = dia;

		var celdaApertura = fila.insertCell();
		celdaApertura.textContent = apertura;

		var celdaCierre = fila.insertCell();
		celdaCierre.textContent = cierre;

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

		// Cerrar el modal
		var modal = document.getElementById("modalAgregarHorario");
		var modalBootstrap = bootstrap.Modal.getInstance(modal);
		modalBootstrap.hide();
	});
});

$("#tablaHorarios").on("click", ".eliminar", function () {
	var idHorario = $(this).data("id");
	horariosEliminados.push(idHorario);
	$(this).closest("tr").remove();
});
