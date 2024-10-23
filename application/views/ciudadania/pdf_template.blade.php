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
        <?php 
        date_default_timezone_set('America/Mexico_City'); 
        ?>
        <p>Fecha de creación de la regulación: <?php echo !empty($regulacion->Fecha_Cre_Sys) ? $regulacion->Fecha_Cre_Sys : 'No disponible'; ?></p>
        <p>Fecha de ultima actualización de la regulacion: <?php echo !empty($regulacion->Fecha_Act_Sys) ? $regulacion->Fecha_Act_Sys : 'No disponible'; ?> </p>
    </div>
    <br>
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
            <h4>Fecha en que ha sido actualizada:</h4>
            <p><strong>Fecha de actualización:</strong>
                <?php echo !empty($regulacionCaracteristicas->Fecha_Act) ? $regulacionCaracteristicas->Fecha_Act : 'No disponible'; ?>
            </p>
        </div>

        <div class="section">
            <h4>Ámbito de Aplicación:</h4>
            <p><?php echo !empty($regulacionCaracteristicas->Ambito_Aplicacion) ? $regulacionCaracteristicas->Ambito_Aplicacion : 'No disponible'; ?>
            </p>
        </div>

        <div class="section">
            <h4>Objeto de la Regulación:</h4>
            <p><?php echo !empty($regulacion->Objetivo_Reg) ? $regulacion->Objetivo_Reg : 'No disponible'; ?></p>
        </div>

        <div class="section">
            <h4>Sujetos Regulados:</h4>
            <ul>
                <p>No hay sujetos regulados</p>
            </ul>
        </div>

        <div class="section">
            <h4>Materias Reguladas:</h4>
            <ul>
                @if (count($materias) > 0)
                    @foreach ($materias as $materia)
                        <li>{{ $materia->Materia }}</li>
                    @endforeach
                @else
                    <li>No hay materias disponibles.</li>
                @endif
            </ul>
        </div>

        <div class="section">
            <h4>Sectores regulados:</h4>
            <ul>
                @if (!empty($sectores))
                    @foreach ($sectores as $sector)
                        <li>{{ $sector->Sector }}</li>
                    @endforeach
                @else
                    <li>No hay sectores disponibles.</li>
                @endif
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
        <p>No existen trámites relacionados</p>
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