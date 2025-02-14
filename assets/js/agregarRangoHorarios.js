var horarios = [];
document.addEventListener("DOMContentLoaded", function () {
    var tablaHorarios = document.getElementById("tablaHorarios");
    var btnGuardarRangoHorario = document.getElementById("btnGuardarRangoHorario");

    var dias = [
        "Domingo",
        "Lunes",
        "Martes",
        "Miércoles",
        "Jueves",
        "Viernes",
        "Sabado",
    ];
    
    // Función para limpiar el modal
    function limpiarModalRangoHorario() {
        document.getElementById("diaDesde").selectedIndex = 0; // Restablecer el select
        document.getElementById("diaHasta").selectedIndex = 0; // Restablecer el select
        document.getElementById("aperturaRango").value = ""; // Limpiar campo de apertura
        document.getElementById("cierreRango").value = ""; // Limpiar campo de cierre
    }

    // Limpiar el modal cada vez que se abre
    document
        .getElementById("modalAgregarRangoHorario")
        .addEventListener("show.bs.modal", function () {
            limpiarModalRangoHorario();
        });
        

    btnGuardarRangoHorario.addEventListener("click", function () {
        var diaDesde = document.getElementById("diaDesde").value;
        var diaHasta = document.getElementById("diaHasta").value;
        var aperturaRango = document.getElementById("aperturaRango").value;
        var cierreRango = document.getElementById("cierreRango").value;

        // Validar campos vacíos
        if (!diaDesde || !diaHasta || !aperturaRango || !cierreRango) {
            alert("Por favor, complete todos los campos.");
            return;
        }

        // Convertir los días a índices
        var diaDesdeIndex = dias.indexOf(diaDesde);
        var diaHastaIndex = dias.indexOf(diaHasta);

        // Validar días duplicados
        for (var i = diaDesdeIndex; i <= diaHastaIndex; i++) {
            let diaDuplicado = horarios.some(h => h.dia === dias[i]);
            if (diaDuplicado) {
                alert(`El día ${dias[i]} ya existe en la lista de horarios.`);
                return;
            }
        }

        // Agregar horarios
        for (var i = diaDesdeIndex; i <= diaHastaIndex; i++) {
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

        // Cerrar el modal
        var modal = document.getElementById("modalAgregarRangoHorario");
        var modalBootstrap = bootstrap.Modal.getInstance(modal);
        modalBootstrap.hide();
    });
});