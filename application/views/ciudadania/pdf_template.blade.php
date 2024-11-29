<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/pdf.css'); ?>">
    <title>Gobierno del Estado de Colima </title>
    <link rel="SHORTCUT ICON" href="https://openapis.col.gob.mx/API_PU/img/favicon.ico" rel="icon" type="image/x-icon">
</head>

<body>
    <div class="header">
        <img src="<?php echo base_url('assets/img/logo_transparente.png'); ?>" alt="Logo" height="50">
        <h1>Decreto que crea el Organismo Público Descentralizado de la Administración Pública Estatal denominado
            Secretaría de Desarrollo Económico (SEDECO)</h1>

    </div>
    <?php 
        date_default_timezone_set('America/Mexico_City'); 
        ?>
    <div class="section">
        <h4 class="inline-title">Fecha de creación de la regulación:</h4>
        <p class="inline-content">
            <?php echo !empty($regulacion->Fecha_Cre_Sys) ? $regulacion->Fecha_Cre_Sys : 'No disponible'; ?>
        </p>
    </div>
    <div class="section">
        <h4 class="inline-title">Fecha de ultima actualización de la regulacion:</h4>
        <p class="inline-content">
            <?php echo !empty($regulacion->Fecha_Act_Sys) ? $regulacion->Fecha_Act_Sys : 'No disponible'; ?>
        </p>
    </div>

    <div class="subheader">
        <h3>Acerca de la resolución</h3>
    </div>
    <div class="content">

        <div class="section">
            <h4 class="inline-title">Tipo de Ordenamiento jurídico:</h4>
            <p class="inline-content">
                <?php echo !empty($regulacionCaracteristicas->Tipo_Ordenamiento) ? $regulacionCaracteristicas->Tipo_Ordenamiento : 'No disponible'; ?>
            </p>
        </div>

        <div class="section">
            <h4 class="inline-title">Fecha de publicación:</h4>
            <p class="inline-content">
                <?php echo !empty($regulacionCaracteristicas->Fecha_Publi) ? $regulacionCaracteristicas->Fecha_Publi : 'No disponible'; ?>
            </p>
        </div>

        <div class="section">
            <h4 class="inline-title">Vigencia:</h4>
            <p class="inline-content">
                <?php echo !empty($regulacionCaracteristicas->Vigencia) ? $regulacionCaracteristicas->Vigencia : 'No disponible'; ?>
            </p>
        </div>

        <div class="section">
            <h4 class="inline-title">Fecha de actualización:</h4>
            <p class="inline-content">
                <?php echo !empty($regulacionCaracteristicas->Fecha_Act) ? $regulacionCaracteristicas->Fecha_Act : 'No disponible'; ?>
            </p>
        </div>

        <div class="section">
            <h4 class="inline-title">Ámbito de Aplicación:</h4>
            <p class="inline-content">
                <?php echo !empty($regulacionCaracteristicas->Ambito_Aplicacion) ? $regulacionCaracteristicas->Ambito_Aplicacion : 'No disponible'; ?>
            </p>
        </div>
        <br>
        <div class="section">
            <h4 class="inline-title">Sujetos regulados:</h4>
            <p class="inline-content">
                <?php if (!empty($de_mat_sec_suj)): ?>
                <?php 
                        $sujetosRegulados = array_map(function ($sujeto) {
        return $sujeto->SujetosRegulados;
    }, $de_mat_sec_suj);
    echo implode(', ', $sujetosRegulados);
                    ?>
                <?php else: ?>
                No hay sujetos regulados
                <?php endif; ?>
            </p>
        </div>

        <div class="section">
            <h4 class="inline-title">Materias reguladas:</h4>
            <p class="inline-content">
                <?php if (!empty($de_mat_sec_suj)): ?>
                <?php 
                        $materiasReguladas = array_map(function ($materia) {
        return $materia->Materias;
    }, $de_mat_sec_suj);
    echo implode(', ', $materiasReguladas);
                    ?>
                <?php else: ?>
                No hay materias reguladas
                <?php endif; ?>
            </p>
        </div>

        <div class="section">
            <h4 class="inline-title">Sectores regulados:</h4>
            <p class="inline-content">
                <?php if (!empty($de_mat_sec_suj)): ?>
                <?php 
                        $sectoresRegulados = array_map(function ($sector) {
        return $sector->Sectores;
    }, $de_mat_sec_suj);
    echo implode(', ', $sectoresRegulados);
                    ?>
                <?php else: ?>
                No hay sectores regulados
                <?php endif; ?>
            </p>
        </div>
    </div>

    <div class="subheader">
        <h3>Índice de la Regulación</h3>
    </div>
    <div class="content">
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

    <div class="subheader">
        <h3>Objeto de la regulacion</h3>
    </div>
    <div class="content">
        <p><?php echo !empty($regulacion->Objetivo_Reg) ? $regulacion->Objetivo_Reg : 'No disponible'; ?></p>
    </div>

    <div class="subheader">
        <h3>Autoridades</h3>
    </div>
    <div class="content">
        @if (!empty($autoridades))
            @foreach ($autoridades as $autoridad)
                <p><strong>Autoridad que la emite:</strong> {{ $autoridad->Autoridad_Emiten }}</p>
                <p><strong>Autoridad que la aplica:</strong> {{ $autoridad->Autoridad_Aplican }}</p>
            @endforeach
        @else
            <p>No hay autoridades disponibles.</p>
        @endif
    </div>

    <div class="subheader">
        <h3>Regulaciones Vinculadas</h3>
    </div>
    <div class="content">
        @if (!empty($regulacionesVinculadas))
            <ul>
                @foreach ($regulacionesVinculadas as $vinculada)
                    <li>{{ $vinculada->Nombre_Regulacion }}</li>
                @endforeach
            </ul>
        @else
            <p>No existen regulaciones vinculadas</p>
        @endif
    </div>

    <div class="content">
        @if (!empty($regulacionesManuales))
            <ul>
                @foreach ($regulacionesManuales as $manual)
                    <li>{{ $manual->Nombre_Manual }}</li>
                @endforeach
            </ul>
        @else
            <p>No existen regulaciones manuales</p>
        @endif
    </div>




    <div class="subheader">
        <h3>Trámites y Servicios Relacionados</h3>
    </div>
    <div class="content">
        <?php if (!empty($tramites)): ?>
        <ul>
            <?php    foreach ($tramites as $tramite): ?>
            <li>
                <strong><?php        echo $tramite->Tramite; ?></strong><br>
                <a href="<?php        echo $tramite->url; ?>" target="_blank"><?php        echo $tramite->url; ?></a>
            </li>
            <?php    endforeach; ?>
        </ul>
        <?php else: ?>
        <p>No hay información disponible sobre trámites y servicios vinculados.</p>
        <?php endif; ?>
    </div>

    <div class="subheader">
        <h3>Identificación de fundamentos jurídicos para la realización de inspecciones, verificaciones y visitas
            domiciliarias</h3>
    </div>
    <div class="content">
        <?php if (!empty($fundamentos)): ?>
        <ul>
            <?php    foreach ($fundamentos as $fundamento): ?>
            <li>
                <strong>Nombre:</strong> <?php        echo $fundamento->Nombre; ?><br>
                <strong>Artículo:</strong> <?php        echo $fundamento->Articulo; ?><br>
                <strong>Link:</strong> <a href="<?php        echo $fundamento->Link; ?>"
                    target="_blank"><?php        echo $fundamento->Link; ?></a>
            </li>
            <?php    endforeach; ?>
        </ul>
        <?php else: ?>
        <p>No existen fundamentos jurídicos para la realización de inspecciones, verificaciones y visitas domiciliarias
            relacionados a esta regulación</p>
        <?php endif; ?>
    </div>
</body>

</html>