document.getElementById('selectLocalidad').addEventListener('change', function () {
    var selectedOption = this.options[this.selectedIndex];
    var clave = selectedOption.getAttribute('data-clave');
    document.getElementById('claveLocalidad').value = clave;
});

document.getElementById('selectAsentamiento').addEventListener('change', function () {
    var selectedOption = this.options[this.selectedIndex];
    var codigoPostal = selectedOption.getAttribute('data-codigo-postal');
    document.getElementById('inputCP').value = codigoPostal;
});