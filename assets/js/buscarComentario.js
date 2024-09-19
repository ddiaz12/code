document.addEventListener('DOMContentLoaded', function() {
    // Capturar el evento del botón de buscar
    document.getElementById('buscarBtn').addEventListener('click', function() {
        // Obtener el valor ingresado en el campo de búsqueda
        var buscarTexto = document.getElementById('buscarComentario').value.toLowerCase();

        // Obtener todas las filas de la tabla de comentarios
        var filas = document.querySelectorAll('#comentariosContent tr');

        // Recorrer cada fila y comprobar si coincide con el texto buscado
        filas.forEach(function(fila) {
            // Obtener el texto del comentario en la fila
            var comentario = fila.querySelector('td:first-child').innerText.toLowerCase();

            // Si el comentario incluye el texto buscado, mostrar la fila, de lo contrario, ocultarla
            if (comentario.includes(buscarTexto)) {
                fila.style.display = '';  // Mostrar la fila
            } else {
                fila.style.display = 'none';  // Ocultar la fila
            }
        });
    });
});


