$(document).ready(function () {
    cargarAsentamientos();

    function cargarAsentamientos() {
        $.ajax({
            type: 'GET',
            url: "https://gaia.inegi.org.mx/wscatgeo/catasentamientos",
            cache: false,
            async: true,
            dataType: "json",
            success: function (data) {
                var tipoAsentamientoSelect = $("#selectTipoAsentamiento");

                tipoAsentamientoSelect.empty();

                tipoAsentamientoSelect.append("<option disabled selected>Selecciona una opción</option>");

                data.datos.forEach(function (item) {
                    tipoAsentamientoSelect.append(`<option value="${item.descripcion}">${item.descripcion}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error al cargar los datos: ", status, error);
            }
        });
    }
});