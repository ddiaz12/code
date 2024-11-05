@layout('templates/masterVerRegulacion')
@section('titulo')
Registro Estatal de Regulaciones
@endsection
@section('navbar')
@include('templates/navbarCiudadania')
@endsection
@section('menu')
@include('templates/menu_ciudadania')
@endsection

@section('contenido')

<div class="container">
    <div class="row">
        <div class="col-md-9 offset-md-2 regulation-container">
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
                <p><a
                        href="<?php echo !empty($enlace_oficial->Enlace_Oficial) ? $enlace_oficial->Enlace_Oficial : '#'; ?>">Enlace
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
                    <?php if (!empty($tramites)): ?>
                    <ul>
                        <?php    foreach ($tramites as $tramite): ?>
                        <li>
                            <strong><?php        echo $tramite->Tramite; ?></strong><br>
                            <a href="<?php        echo $tramite->url; ?>"
                                target="_blank"><?php        echo $tramite->url; ?></a>
                        </li>
                        <?php    endforeach; ?>
                    </ul>
                    <?php else: ?>
                    <p>No hay información disponible sobre trámites y servicios vinculados.</p>
                    <?php endif; ?>
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
                <div class="col-md-3 btn-verRegulacion1">
                    <a href="<?php echo base_url('ciudadania'); ?>"
                        class="btn btn-secondary btn-block btn-custom">Regresar<i></i></a>
                </div>
                <div class="col-md-3 btn-verRegulacion2">
                    <a href="<?php echo base_url('ciudadania/descargarPdf/' . $regulacion->ID_Regulacion); ?>"
                        class="btn-download btn-custom">Descargar regulación <i class="fas fa-download"></i></a>
                </div>
            </div>
            @include('templates/footerCiudadania')  
        </div>
    </div>
</div>

@endsection

@section('js')
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
@endsection