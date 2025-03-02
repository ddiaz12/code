<!DOCTYPE html>
<html>
<head>
    <title>Ficha de Inspección</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .container { width: 100%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px; border: 1px solid #000; vertical-align: top; text-align: left; }
        th { width: 30%; background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Detalle de Inspección</h2>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <td>{{ $inspeccion['id_inspeccion'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Homoclave</th>
                <td>{{ $inspeccion['Homoclave'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Nombre de Inspección</th>
                <td>{{ $inspeccion['Nombre_Inspeccion'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Modalidad</th>
                <td>{{ $inspeccion['Modalidad'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Sujeto Obligado</th>
                <td>{{ $inspeccion['Sujeto_Obligado_ID'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Unidad Administrativa</th>
                <td>{{ $inspeccion['Unidad_Administrativa'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Estatus</th>
                <td>{{ $inspeccion['Estatus'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Tipo de Inspección</th>
                <td>{{ $inspeccion['Tipo_Inspeccion'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Vigencia</th>
                <td>{{ $inspeccion['Vigencia'] ?? '' }}</td>
            </tr>
            <!-- ...otros campos principales si se requieren... -->
        </table>
        
        <h3>Detalles adicionales</h3>
        @foreach ($inspeccion as $key => $value)
            @if (!in_array($key, ['id_inspeccion', 'Homoclave', 'Nombre_Inspeccion', 'Modalidad', 'Sujeto_Obligado_ID', 'Unidad_Administrativa', 'Estatus', 'Tipo_Inspeccion', 'Vigencia']))
                <p><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</p>
            @endif
        @endforeach
    </div>
</body>
</html>
