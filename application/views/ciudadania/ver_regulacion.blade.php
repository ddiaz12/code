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
            <?php if (!empty($regulacion->Estatus)): ?>
            <?php    if ($regulacion->Estatus == 5): ?>
            <p class="msg-emergencia"><strong class="text-danger">Esta es una regulación de emergencia</strong></p>
            <?php    elseif ($regulacion->Estatus == 4): ?>
            <p class="msg-abrogada"><strong class="text-danger">Esta es una regulación abrogada</strong></p>
            <?php    endif; ?>
            <?php endif; ?>
            <div class="regulation-info d-flex justify-content-between align-items-start" style="position: relative;">
                <div>
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
                        <span class="application-badge">Colima</span>
                    </p>
                    <p><a
                            href="<?php echo !empty($enlace_oficial->Enlace_Oficial) ? $enlace_oficial->Enlace_Oficial : '#'; ?>">Enlace
                            de la regulación</a></p>
                </div>
                <div class="div-protesta text-center">
                    <a class="nav-link d-flex flex-column align-items-center"
                        href="https://protestaciudadana.col.gob.mx/"  data-placement="right"
                        title="Protesta Ciudadana">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-person-circle-exclamation icon-protesta"></i>
                        </div>
                        <span class="small">Protesta <br> Ciudadana</span>
                    </a>
                </div>
            </div>

            <p><?php echo !empty($regulacion->Objetivo_Reg) ? $regulacion->Objetivo_Reg : 'No disponible'; ?></p>

            <div class="related-sections">
                <button class="btn-accordion" data-target="#indiceContent"><i class="fas fa-list"></i> Índice</button>
                <button class="btn-accordion" data-target="#autoridadesContent"><i class="fas fa-user-tie"></i>
                    Autoridades</button>
                <button class="btn-accordion" data-target="#materiasContent"><i class="fas fa-book"></i> Materias
                    Exentas</button>
                <button class="btn-accordion" data-target="#regulacionesVinculadasContent"><i class="fas fa-link"></i>
                    Regulaciones vinculadas</button>
                <button class="btn-accordion" data-target="#tramitesContent"><i class="fas fa-tasks"></i> Trámites y
                    servicios vinculados</button>
                <button class="btn-accordion" data-target="#sectoresContent"><i class="fas fa-tasks"></i>
                    Sector/actividad económica</button>
                <button class="btn-accordion" data-target="#fundamentosContent"><i class="fas fa-tasks"></i>
                    Inspecciones, Verificaciones y Visitas Domiciliarias</button>
            </div>

            <div class="content-sections">
                <div id="indiceContent" class="content">
                    <?php if (!empty($indice)): ?>
                    <ul>
                        <?php    foreach ($indice as $padre): ?>
                        <li>
                            <?php        echo $padre['Orden'] . '. ' . $padre['Texto']; ?>
                            <?php        if (!empty($padre['Hijos'])): ?>
                            <ul>
                                <?php            foreach ($padre['Hijos'] as $hijo): ?>
                                <li><?php                echo $hijo['Orden'] . '. ' . $hijo['Texto']; ?></li>
                                <?php            endforeach; ?>
                            </ul>
                            <?php        endif; ?>
                        </li>
                        <?php    endforeach; ?>
                    </ul>
                    <?php else: ?>
                    <p>No hay información disponible sobre el Índice.</p>
                    <?php endif; ?>
                </div>

                <div id="autoridadesContent" class="content">
                    <?php if (!empty($autoridades)): ?>
                    <ul>
                        <?php    foreach ($autoridades as $autoridad): ?>
                        <li><strong>Aplican: </strong><?php        echo $autoridad->Autoridad_Aplican; ?></li>
                        <li><strong>Emiten: </strong><?php        echo $autoridad->Autoridad_Emiten; ?></li>
                        <?php    endforeach; ?>
                    </ul>
                    <?php else: ?>
                    <p>No hay información disponible sobre las autoridades.</p>
                    <?php endif; ?>
                </div>

                <div id="materiasContent" class="content">
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

                <div id="regulacionesVinculadasContent" class="content">
                    @if (!empty($regulacionesCombinadas))
                        <ul>
                            @foreach ($regulacionesCombinadas as $regulacion)
                                <li>
                                    @if (isset($regulacion->Nombre_Regulacion))
                                        <a href="{{ base_url('ciudadania/verRegulacion/' . $regulacion->ID_Regulacion) }}">
                                            {{ $regulacion->Nombre_Regulacion }}
                                        </a>
                                    @else
                                        @if (isset($regulacion->Enlace) && !empty($regulacion->Enlace))
                                            <a href="{{ $regulacion->Enlace }}" target="_blank">
                                                {{ $regulacion->Nombre_Manual }}
                                            </a>
                                        @else
                                            {{ $regulacion->Nombre_Manual }}
                                        @endif
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No existen regulaciones vinculadas</p>
                    @endif
                </div>

                <div id="tramitesContent" class="content">
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

                <div id="sectoresContent" class="content">
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

                <div id="fundamentosContent" class="content">
                    <?php if (!empty($fundamentos)): ?>
                    <ul>
                        <?php    foreach ($fundamentos as $fundamento): ?>
                        <li>
                            <strong>Nombre:</strong> <?php        echo $fundamento->Nombre; ?><br>
                            <strong>Artículo:</strong> <?php        echo $fundamento->Articulo; ?><br>
                            <strong>Dirección web:</strong> <a href="<?php        echo $fundamento->Link; ?>"
                                target="_blank"><?php        echo $fundamento->Link; ?></a>
                        </li>
                        <?php    endforeach; ?>
                    </ul>
                    <?php else: ?>
                    <p>No hay información disponible sobre los fundamentos jurídicos.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row mt-4 justify-content-center">
                <div class="col-md-3 btn-verRegulacion3">
                    <a href="<?php echo !empty($enlace_oficial->file_path) ? base_url($enlace_oficial->file_path) : 'javascript:void(0);'; ?>"
                        class="btn-download btn-custom"
                        onclick="<?php echo empty($enlace_oficial->file_path) ? 'showNoDocumentAlert()' : ''; ?>">
                        Descargar documento <br><i class="fas fa-download"></i>
                    </a>
                </div>
                <div class="col-md-3 btn-verRegulacion2">
                    <a href="<?php echo base_url('ciudadania/descargarPdf/' . $regulacion->ID_Regulacion); ?>"
                        class="btn-download btn-custom">Descargar ficha<br><i class="fas fa-download"></i></a>
                </div>
            </div>
            <div class="row mt-4 justify-content-center">
                <div class="col-md-3 btn-verRegulacion1">
                    <a href="<?php echo base_url('ciudadania'); ?>"
                        class="btn-block btn-custom-regresar">Regresar<i></i></a>
                </div>
            </div>
            @include('templates/footerCiudadania')  
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.btn-accordion');
        const contents = document.querySelectorAll('.content');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const target = document.querySelector(this.getAttribute('data-target'));

                contents.forEach(content => {
                    if (content !== target) {
                        content.classList.remove('active');
                    }
                });

                target.classList.toggle('active');
            });
        });
    });

    // Función para mostrar un mensaje cuando no hay un documento disponible
    function showNoDocumentAlert() {
        Swal.fire({
            title: 'Documento no disponible',
            text: 'No hay un documento para descargar en este momento.',
            icon: 'info',
            confirmButtonColor: '#923244',
            confirmButtonText: 'Entendido'
        });
    }
</script>
@endsection