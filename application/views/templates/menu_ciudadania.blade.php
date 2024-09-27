<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


    <nav class="sb-sidenav sb-sidenav-black" id="sidenavAccordion">
        <div class="sb-sidenav-menu menu-custom">
            <div class="nav">
                <a class="nav-link" href="https://www.col.gob.mx//economico/contenido/MzEwNTU=" data-toggle="tooltip"
                    data-placement="right" title="Visitas Domiciliarias">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-person-shelter"></i>
                    </div>
                    <span class="nav-text">Registro Estatal de Visitas Domiciliarias</span>
                </a>
            </div>
            <div class="nav">
                <a class="nav-link" href="https://www.col.gob.mx/Portal/Tramites" data-toggle="tooltip"
                    data-placement="right" title="Tramites y Servicios">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                    <span class="nav-text">Registro Estatal Trámites Servicios</span>
                </a>
            </div>
            <div class="nav">
                <a class="nav-link" href="https://protestaciudadana.col.gob.mx/" data-toggle="tooltip"
                    data-placement="right" title="Protesta Ciudadana">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-person-circle-exclamation"></i>
                    </div>
                    <span class="nav-text">Protesta Ciudadana y Buzón de Sugerencias</span>
                </a>
            </div>
            <div class="nav">
                <a class="nav-link" href="https://catalogonacional.gob.mx/" data-toggle="tooltip"
                    data-placement="right" title="CNARTyS">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-landmark"></i>
                    </div>
                    <span class="nav-text">(CNARTyS)</span>
                </a>
            </div>
            <!--
            <div class="nav">
                <a class="nav-link" href="#" data-toggle="tooltip" data-placement="right" title="Accesibilidad"
                    onclick="showAccessibilityMenu()">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-universal-access"></i>
                    </div>
                    <span class="nav-text">Accesibilidad</span>
                </a>
            </div>
            -->
        </div>
    </nav>




<style>
    .high-contrast {
        background-color: #000;
        color: #fff;
    }
</style>

<div id="accessibilityMenu">
    <ul>
        <li><a href="#" onclick="hideAccessibilityMenu()"><i class="fas fa-times"></i> Cerrar</a></li>
        <li><a href="#" onclick="increaseFontSize()"><i class="fa-solid fa-a"></i><i class="fas fa-plus"></i></i>
                Aumentar Tamaño</a></li>
        <li><a href="#" onclick="decreaseFontSize()"><i class="fa-solid fa-a"></i><i class="fas fa-minus"></i> Disminuir
                Tamaño</a></li>
        <li><a href="#" onclick="toggleHighContrast()"><i class="fas fa-adjust"></i> Alto Contraste</a></li>
        <li><a href="#" onclick="toggleNarrator()"><i class="fas fa-volume-up"></i><span id="narratorStatus"> Narrador
                    Desactivado</span></a></li>
        <li><a href="#" onclick="increaseImageSize()"><i class="fas fa-expand"></i> Ampliar Imagen</a></li>
        <li><a href="#" onclick="resetPage()"><i class="fas fa-sync"></i> Restablecer</a></li>
    </ul>
</div>

<script>
    var defaultFontSize;
    var defaultImagesSize;
    var narratorEnabled = false;

    window.onload = function () {
        defaultFontSize = parseFloat(window.getComputedStyle(document.body, null).getPropertyValue('font-size'));
        defaultImagesSize = Array.from(document.getElementsByTagName('img')).map(img => img.offsetWidth);
    }
    function showAccessibilityMenu() {
        document.getElementById('accessibilityMenu').style.display = 'block';
    }
    function hideAccessibilityMenu() {
        document.getElementById('accessibilityMenu').style.display = 'none';
    }
    function increaseFontSize() {
        var body = document.body;
        var style = window.getComputedStyle(body, null).getPropertyValue('font-size');
        var currentSize = parseFloat(style);
        body.style.fontSize = (currentSize + 1) + 'px';
    }
    function decreaseFontSize() {
        var body = document.body;
        var style = window.getComputedStyle(body, null).getPropertyValue('font-size');
        var currentSize = parseFloat(style);
        body.style.fontSize = (currentSize - 1) + 'px';
    }
    function toggleHighContrast() {
        var body = document.body;
        body.classList.toggle('high-contrast');
    }
    function increaseImageSize() {
        var images = document.getElementsByTagName('img');
        for (var i = 0; i < images.length; i++) {
            images[i].style.width = (images[i].offsetWidth + 10) + 'px';
            images[i].style.height = 'auto';
        }
    }
    function toggleNarrator() {
        narratorEnabled = !narratorEnabled;
        document.getElementById('narratorStatus').innerText = narratorEnabled ? 'Narrador Activado' : 'Narrador Desactivado';
        if (narratorEnabled) {
            var msg = new SpeechSynthesisUtterance('Narrador activado');
            window.speechSynthesis.speak(msg);
        }
    }
    function resetPage() {
        var body = document.body;
        body.style.fontSize = defaultFontSize + 'px';
        body.classList.remove('high-contrast');
        var images = document.getElementsByTagName('img');
        for (var i = 0; i < images.length; i++) {
            images[i].style.width = defaultImagesSize[i] + 'px';
            images[i].style.height = 'auto';
        }
        document.getElementById('narratorStatus').innerText = 'Narrador Desactivado';
        narratorEnabled = false;
    }
</script>