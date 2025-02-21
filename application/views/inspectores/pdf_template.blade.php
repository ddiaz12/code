<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha de Inspector</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Ficha de Inspector</h2>
        </div>
        <div class="content">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ $inspector->Inspector_ID }}</td>
                </tr>
                <tr>
                    <th>Homoclave</th>
                    <td>{{ $inspector->Homoclave }}</td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td>{{ $inspector->Nombre }}</td>
                </tr>
                <tr>
                    <th>Primer Apellido</th>
                    <td>{{ $inspector->Apellido_Paterno }}</td>
                </tr>
                <tr>
                    <th>Segundo Apellido</th>
                    <td>{{ $inspector->Apellido_Materno }}</td>
                </tr>
                <tr>
                    <th>Sujeto Obligado</th>
                    <td>{{ $inspector->Sujeto_Obligado }}</td>
                </tr>
                <tr>
                    <th>Unidad Administrativa</th>
                    <td>{{ $inspector->Unidad_Administrativa }}</td>
                </tr>
                <tr>
                    <th>Estatus</th>
                    <td>{{ $inspector->Estatus }}</td>
                </tr>
                <tr>
                    <th>Tipo</th>
                    <td>{{ $inspector->Tipo }}</td>
                </tr>
                <tr>
                    <th>Vigencia</th>
                    <td>{{ $inspector->Vigencia }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Generado por el sistema de Registro Estatal de Regulaciones y Visitas Domiciliarias</p>
        </div>
    </div>
</body>
</html>
