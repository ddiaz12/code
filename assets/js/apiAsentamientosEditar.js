$(document).ready(function() {
    cargarAsentamientos();

    function cargarAsentamientos() {
        $.ajax({
            type: 'GET',
            url: "https://gaia.inegi.org.mx/wscatgeo/catasentamientos",
            cache: false,
            async: true,
            dataType: "json",
            success: function(data) {
                var tipoAsentamientoSelect = $("#selectTipoAsentamiento");
                var selectedValue = tipoAsentamientoSelect.val(); 

                if (!selectedValue) {
                    tipoAsentamientoSelect.empty();
                    tipoAsentamientoSelect.append("<option disabled selected>Selecciona una opción</option>");
                }

                data.datos.forEach(function(item) {
                    if (tipoAsentamientoSelect.find("option[value='" + item.descripcion + "']").length == 0) {
                        tipoAsentamientoSelect.append(`<option value="${item.descripcion}">${item.descripcion}</option>`);
                    }
                });

                if (selectedValue) {
                    tipoAsentamientoSelect.val(selectedValue);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los datos: ", status, error);
            }
        });
    }
});