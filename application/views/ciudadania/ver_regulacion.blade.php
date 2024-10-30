<!DOCTYPE html>
<html>

<head>
    <title>Detalles de la Regulación</title>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/vista_regulacion.css'); ?>">
    <link rel="stylesheet" href="https://openapis.col.gob.mx/API_PU/css/bs4/bootstrap.min.css">

    <meta name="google-site-verification" content="vgE7xTPnRDI9JNHuGHmNQeU55Yr58j9hwq9Wk06R8qk" />
    <title>
        Gobierno del Estado de Colima </title>
    <link rel="SHORTCUT ICON" href="https://openapis.col.gob.mx/API_PU/img/favicon.ico" rel="icon" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?php echo base_url("assets/css/styles.css") ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/ciudadania.css") ?>">
    <script src="https://use.fontawesome.com/releases/v6.6.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Customcss -->

    <!--<link rel="stylesheet" href="https://openapis.col.gob.mx/API_PU/css/bs4/layout.css">-->
    <script type="text/javascript" src="https://openapis.col.gob.mx/API_PU/js/b4/jquery-3.2.1.js"></script>

    <script src='http://localhost:8090/PORTALUNICO/ICSIC/assets/js/customjs.js' type='text/javascript'></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121812210-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-121812210-1');
    </script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    @include('templates/navbarCiudadania')

    <div class="container regulation-container">
        <h1 class="regulation-title">
            <?php echo !empty($regulacion->Nombre_Regulacion) ? $regulacion->Nombre_Regulacion : 'No disponible'; ?>
        </h1>
        <?php if (!empty($regulacion->Estatus) && $regulacion->Estatus == 5): ?>
        <p clase="msg-emergencia"><strong class="text-danger">Esta es una regulación de emergencia</strong></p>
        <?php endif; ?>
        <div class="regulation-info">
            <p><strong>Tipo de ordenamiento jurídico:</strong>
                <?php echo !empty($regulacionCaracteristicas->Tipo_Ordenamiento) ? $regulacionCaracteristicas->Tipo_Ordenamiento : 'No disponible'; ?>
            </p>
            <p><strong>Fecha de expedición de la regulación:</strong>
                <?php echo !empty($regulacionCaracteristicas->Fecha_Exp) ? $regulacionCaracteristicas->Fecha_Exp : 'No disponible'; ?>
            </p>
            <p><strong>Fecha de publicación de la regulación:</strong>
                <?php echo !empty($regulacionCaracteristicas->Fecha_Publi) ? $regulacionCaracteristicas->Fecha_Publi : 'No disponible'; ?>
            </p>
            <p><strong>Fecha de vigor:</strong>
                <?php echo !empty($regulacionCaracteristicas->Fecha_Vigor) ? $regulacionCaracteristicas->Fecha_Vigor : 'No disponible'; ?>
            </p>
            <p><strong>Fecha de última actualización:</strong>
                <?php echo !empty($regulacionCaracteristicas->Fecha_Act) ? $regulacionCaracteristicas->Fecha_Act : 'No disponible'; ?>
            </p>
            <p><strong>Vigencia de la regulación:</strong>
                <?php echo !empty($regulacionCaracteristicas->Vigencia) ? $regulacionCaracteristicas->Vigencia : 'No disponible'; ?>
            </p>
            <p><strong>Orden de gobierno que la emite:</strong>
                <?php echo !empty($regulacionCaracteristicas->Orden_Gob) ? $regulacionCaracteristicas->Orden_Gob : 'No disponible'; ?>
            </p>
            <p><strong>Ámbito de la aplicación:</strong> <span
                    class="application-badge"><?php echo !empty($regulacionCaracteristicas->Ambito_Aplicacion) ? $regulacionCaracteristicas->Ambito_Aplicacion : 'No disponible'; ?></span>
                <span class="application-badge"><i class="fas fa-map-marker-alt"></i> Colima</span>
            </p>
            <p><a href="<?php echo !empty($enlace_oficial->Enlace_Oficial) ? $enlace_oficial->Enlace_Oficial : '#'; ?>">Enlace
                    de la regulación</a></p>
        </div>

        <p><?php echo !empty($regulacion->Objetivo_Reg) ? $regulacion->Objetivo_Reg : 'No disponible'; ?></p>

        <div class="related-sections">
            <button class="btn-accordion"><i class="fas fa-list"></i> Índice</button>
            <div class="content">
                <?php if (!empty($indice)): ?>
                <ul>
                    <?php    foreach ($indice as $item): ?>
                    <li><?php        echo $item->Orden . '. ' . $item->Texto; ?></li>
                    <?php    endforeach; ?>
                </ul>
                <?php else: ?>
                <p>No hay información disponible sobre el Índice.</p>
                <?php endif; ?>
            </div>

            <button class="btn-accordion"><i class="fas fa-user-tie"></i> Autoridades</button>
            <div class="content">
                <?php if (!empty($autoridades)): ?>
                <ul>
                    <?php    foreach ($autoridades as $autoridad): ?>
                    <li>Aplican: <?php        echo $autoridad->Autoridad_Aplican; ?></li>
                    <li>Emiten: <?php        echo $autoridad->Autoridad_Emiten; ?></li>
                    <?php    endforeach; ?>
                </ul>
                <?php else: ?>
                <p>No hay información disponible sobre las autoridades.</p>
                <?php endif; ?>
            </div>

            <button class="btn-accordion"><i class="fas fa-book"></i> Materias Exentas</button>
            <div class="content">
                <?php if (!empty($materias)): ?>
                <ul>
                    <?php    foreach ($materias as $materia): ?>
                    <li><?php        echo $materia->Materia; ?></li>
                    <?php    endforeach; ?>
                </ul>
                <?php else: ?>
                <p>No hay información disponible sobre materias exentas.</p>
                <?php endif; ?>
            </div>

            <button class="btn-accordion"><i class="fas fa-link"></i> Regulaciones vinculadas</button>
            <div class="content">
                <?php if (!empty($regulacionesVinculadas)): ?>
                <ul>
                    <?php    foreach ($regulacionesVinculadas as $vinculada): ?>
                    <li><?php        echo $vinculada->Nombre_Regulacion; ?></li>
                    <?php    endforeach; ?>
                </ul>
                <?php else: ?>
                <p>No hay regulaciones vinculadas.</p>
                <?php endif; ?>
            </div>

            <button class="btn-accordion"><i class="fas fa-tasks"></i> Trámites y servicios vinculados</button>
            <div class="content">
                <p>Información sobre Trámites y servicios vinculados...</p>
            </div>

            <button class="btn-accordion"><i class="fas fa-tasks"></i> Sector/actividad económica</button>
            <div class="content">
                <?php if (!empty($sectores)): ?>
                <ul>
                    <?php    foreach ($sectores as $sector): ?>
                    <li><?php        echo $sector->Sector; ?></li>
                    <?php    endforeach; ?>
                </ul>
                <?php else: ?>
                <p>No hay información disponible sobre el sector/actividad económica.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-md-3">
                <a href="<?php echo base_url('ciudadania'); ?>" class="btn btn-secondary btn-block btn-custom">Regresar<i></i></a>
            </div>
            <div class="col-md-3">
                <a href="<?php echo base_url('ciudadania/descargarPdf/' . $regulacion->ID_Regulacion); ?>"
                    class="btn-download btn-custom">Descargar regulación <i class="fas fa-download"></i></a>
            </div>
        </div>

    </div>
    @include('templates/footerCiudadania')  

    <script>
        const accordions = document.querySelectorAll('.btn-accordion');

        accordions.forEach(accordion => {
            accordion.addEventListener('click', function () {
                const content = this.nextElementSibling;
                const isActive = content.classList.contains('active');
                // Cierra todos los contenidos
                const allContents = document.querySelectorAll('.content');
                allContents.forEach(content => {
                    content.classList.remove('active');
                });

                // Elimina la clase activa de todos los botones
                accordions.forEach(acc => {
                    acc.classList.remove('active');
                });

                // Si no estaba activo, ábrelo. Si estaba activo, se cerrará
                if (!isActive) {
                    content.classList.add('active');
                    this.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>