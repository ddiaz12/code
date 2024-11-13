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
        <h1>FICHA DE LA REGULACIÓN</h1>
        <p>Decreto que crea el Organismo Público Descentralizado de la Administración Pública Estatal denominado
            Secretaría de Desarrollo Económico (SEDECO)</p>

    </div>        
    <?php 
        date_default_timezone_set('America/Mexico_City'); 
        ?>
        <p>Fecha de creación de la regulación:
            <?php echo !empty($regulacion->Fecha_Cre_Sys) ? $regulacion->Fecha_Cre_Sys : 'No disponible'; ?>
        </p>
        <p>Fecha de ultima actualización de la regulacion:
            <?php echo !empty($regulacion->Fecha_Act_Sys) ? $regulacion->Fecha_Act_Sys : 'No disponible'; ?>
        </p>
    <div class="subheader">
        <h3>Acerca de la resolución</h3>
    </div>
    <div class="content">
        <p><strong>Tipo de Ordenamiento jurídico:</strong>
            <?php echo !empty($regulacionCaracteristicas->Tipo_Ordenamiento) ? $regulacionCaracteristicas->Tipo_Ordenamiento : 'No disponible'; ?>
        </p>
        <p><strong>Fecha de publicación:</strong>
            <?php echo !empty($regulacionCaracteristicas->Fecha_Publi) ? $regulacionCaracteristicas->Fecha_Publi : 'No disponible'; ?>
        </p>
        <p><strong>Vigencia:</strong>
            <?php echo !empty($regulacionCaracteristicas->Vigencia) ? $regulacionCaracteristicas->Vigencia : 'No disponible'; ?>
        </p>

        <div class="section">
            <p><strong>Fecha de actualización:</strong>
                <?php echo !empty($regulacionCaracteristicas->Fecha_Act) ? $regulacionCaracteristicas->Fecha_Act : 'No disponible'; ?>
            </p>
        </div>

        <div class="section">
        <p>Ámbito de Aplicación: <?php echo !empty($regulacionCaracteristicas->Ambito_Aplicacion) ? $regulacionCaracteristicas->Ambito_Aplicacion : 'No disponible'; ?>
            </p>
        </div>

        <div class="section">
            <h4>Sujetos regulados:</h4>
            <ul>
                <?php if (!empty($de_mat_sec_suj)): ?>
                <?php    foreach ($de_mat_sec_suj as $sujeto): ?>
                <li><?php        echo $sujeto->SujetosRegulados; ?></li>
                <?php    endforeach; ?>
                <?php else: ?>
                <p>No hay sujetos regulados</p>
                <?php endif; ?>
            </ul>
        </div>

        <div class="section">
            <h4>Materias reguladas:</h4>
            <ul>
                <?php if (!empty($de_mat_sec_suj)): ?>
                <?php    foreach ($de_mat_sec_suj as $materia): ?>
                <li><?php        echo $materia->Materias; ?></li>
                <?php    endforeach; ?>
                <?php else: ?>
                <p>No hay materias reguladas</p>
                <?php endif; ?>
            </ul>
        </div>

        <div class="section">
            <h4>Sectores regulados:</h4>
            <ul>
                <?php if (!empty($de_mat_sec_suj)): ?>
                <?php    foreach ($de_mat_sec_suj as $sector): ?>
                <li><?php        echo $sector->Sectores; ?></li>
                <?php    endforeach; ?>
                <?php else: ?>
                <p>No hay sectores regulados</p>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="subheader">
        <h3>Índice de la Regulación</h3>
    </div>
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
            <p>No existen relaciones</p>
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

    <div class="subheader">
        <h3>Inspecciones Relacionadas</h3>
    </div>
    <div class="content">
        <p>No existen inspecciones relacionadas a esta regulación</p>
    </div>

    <div class="subheader">
        <h3>Inspectores Relacionados</h3>
    </div>
    <div class="content">
        <p>No existen inspectores relacionados a esta regulación</p>
    </div>
</body>

</html>