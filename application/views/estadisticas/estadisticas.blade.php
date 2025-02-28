@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones y Visitas Domiciliarias
@endsection
@section('navbar')
@include('templates/navbarAdmin')
@endsection
@section('menu')
@include('templates/menuAdmin')
@endsection
@section('contenido')

<div class="container-fluid" style="margin-top: 20px;">
    <!-- Breadcrumb -->
    <nav class="breadcrumb-container" style="margin-left: -180px; margin-right: 20px; margin-top: 2px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ base_url('home') }}">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">Inspecciones</li>
            <li class="breadcrumb-item">Inspectores(as)</li>
        </ol>
    </nav>

    <div class="content-wrapper">
        <!-- Título -->
        <h1 class="main-title">Registro Estatal de Visitas Domiciliarias (REVID)</h1>
        <h2 class="subtitle">Inspecciones, Verificaciones y Visitas Domiciliarias</h2>

        <!-- Sección de Estadísticas -->
        <div class="statistics-section">
            <div class="header-actions">
                <h3>Estadísticas</h3>
                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ base_url('home-sujeto') }}'">Regresar</button>
                </div>
            </div>

            <p class="question-text">¿Cuántas inspecciones se realizaron en el año anterior durante los siguientes Meses?</p>

            <form action="{{ base_url('estadisticas/guardar') }}" method="post">
                <div class="months-grid">
                    <?php
                    $months = [
                        ['Enero', 'Febrero', 'Marzo'],
                        ['Abril', 'Mayo', 'Junio'],
                        ['Julio', 'Agosto', 'Septiembre'],
                        ['Octubre', 'Noviembre', 'Diciembre']
                    ];

                    foreach ($months as $row) {
                        echo '<div class="month-row">';
                        foreach ($row as $month) {
                            echo '<div class="month-item">
                                    <label>' . $month . ':</label>
                                    <input type="number" name="' . strtolower($month) . '" class="form-control" min="0" value="0">
                                  </div>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div>

                <div class="additional-questions">
                    <p>¿Cuántas Inspecciones, Verificaciones o Visitas Domiciliaras derivaron en sanción en el año inmediato anterior?</p>
                    <input type="number" name="sanciones" class="form-control sanctions-input" min="0" value="1">
                </div>

                <input type="hidden" name="ultima_actualizacion" value="{{ date('Y-m-d H:i:s') }}">
                <input type="hidden" name="Fecha_Estadistica" value="{{ date('Y-m-d') }}">

                <p class="update-date">
                    Fecha de última actualización de la ficha de inspección: {{ $ultima_actualizacion ?? '' }}
                </p>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>

        <!-- Tabla de Inspecciones Detalladas -->
        <div class="inspecciones-detalladas-section">
            <h3>Estadisticas ingresadas</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Homoclave</th>
                        <th>Nombre de la Inspección</th>
                        <th>Inspecciones Sancionadas</th>
                        <th>Total</th>
                        <th>Última Actualización</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inspecciones_detalladas as $inspeccion)
                        <tr>
                            <td>{{ $inspeccion['Homoclave'] }}</td>
                            <td>{{ $inspeccion['Nombre_Inspeccion'] }}</td>
                            <td>{{ $inspeccion['Inspecciones_Sancionadas'] }}</td>
                            <td>{{ $inspeccion['Total'] }}</td>
                            <td>{{ $inspeccion['Ultima_Actualizacion'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .container-fluid {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .breadcrumb-container {
        margin-bottom: 20px;
    }

    .main-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
    }

    .subtitle {
        font-size: 18px;
        font-style: italic;
        text-align: center;
        margin-bottom: 30px;
    }

    .statistics-section {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .button-group {
        display: flex;
        gap: 10px;
    }

    .btn-primary {
        background-color: #8E354A;
        border-color: #8E354A;
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }

    .question-text {
        margin-bottom: 20px;
    }

    .months-grid {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 30px;
    }

    .month-row {
        display: flex;
        gap: 20px;
    }

    .month-item {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .month-item label {
        min-width: 80px;
    }

    .month-item input {
        width: 100%;
        padding: 5px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .additional-questions {
        margin-bottom: 20px;
    }

    .sanctions-input {
        width: 100px !important;
        margin-top: 10px;
    }

    .update-date {
        font-size: 14px;
        color: #666;
    }

    .form-group {
        text-align: center;
        margin-top: 20px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .inspecciones-detalladas-section {
        margin-top: 40px;
    }

    .inspecciones-detalladas-section h3 {
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .month-row {
            flex-direction: column;
        }

        .month-item {
            margin-bottom: 10px;
        }

        .header-actions {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

@endsection
@section('footer')
@include('templates/footer')
@endsection