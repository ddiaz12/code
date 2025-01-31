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
<div class="container-fluid mt-4">


    <ol class="breadcrumb mb-4 mt-5" style="margin-left: 5px;">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url('home'); ?>" class="text-decoration-none">
                <i class="fas fa-home me-1"></i>Home
            </a>
        </li>
        <li class="breadcrumb-item"><i class="fas fa-file-alt me-1"></i>Inspecciones</li>
        <li class="breadcrumb-item"><i class="fas fa-plus-circle me-1"></i>Agregar</li>
    </ol>

    <div class="row">



        <!-- Sidebar Wizard -->
        <div class="col-md-3 sidebar-wizard">
            <div class="list-group">
                <?php
$steps = [
    ["label" => "Datos de identificación", "icon" => "fa-solid fa-id-card"],
    ["label" => "Autoridad Pública", "icon" => "fa-solid fa-user-shield"],
    ["label" => "Información sobre la inspección", "icon" => "fa-solid fa-file-alt"],
    ["label" => "Más detalles", "icon" => "fa-solid fa-info-circle"],
    ["label" => "Información de la Autoridad Pública y Contacto", "icon" => "fa-solid fa-building"],
    ["label" => "Estadísticas", "icon" => "fa-solid fa-chart-bar"],
    ["label" => "Información adicional", "icon" => "fa-solid fa-list"],
    ["label" => "No publicidad", "icon" => "fa fa-user-secret"],
    ["label" => "Emergencias", "icon" => "fa-solid fa-exclamation-triangle"]
];

foreach ($steps as $index => $step) {
    $stepNumber = $index + 1;
    echo '<button class="list-group-item list-group-item-action wizard-step" data-step="' . $stepNumber . '">
            <i class="' . $step["icon"] . ' me-2"></i>' .
        $step["label"] .
        '</button>';
}

                ?>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 main-content">
            <script>
                $(document).ready(function () {
                    $('label').css('font-weight', 'bold');
                });
            </script>

            <div class="form-container">
                {{ form_open_multipart('agregarinspeccion/guardar', ['id' => 'inspeccionForm', 'class' => 'needs-validation', 'novalidate' => '']) }}
                <div class="form-step" id="step-1">

                    <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px;">Datos de
                        identificación de Inspector(a), Verificador(a) y Visitador(a) Domiciliario(a)</h3>

                    <h5 class="alert alert-warning"
                        style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                        Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                    </h5>

                    <div class="form-group">
                        <label><b>Homoclave</b></label>
                        {{ form_input(['name' => 'Homoclave', 'class' => 'form-control', 'value' => 'I-IPR-CTIH-0-IPR-0002', 'readonly' => true]) }}
                    </div>
                    <div class="form-group">
                        <label><b>Nombre de la Inspección</b><span class="text-danger">*</span></label>
                        {{ form_input(['name' => 'Nombre_Inspeccion', 'class' => 'form-control', 'required' => 'required']) }}
                    </div>
                    <div class="form-group">
                        <label>Modalidad (si existe)</label>
                        {{ form_input(['name' => 'Modalidad', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label><b>Sujeto Obligado</b><span class="text-danger">*</span></label>
                        <select name="Sujeto_Obligado_ID" class="form-control" required>
                            <option value="">Selecciona un Sujeto Obligado</option>
                            @foreach($sujetos_obligados as $so)
                                <option value="{{ $so->ID_sujeto }}">{{ $so->nombre_sujeto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipo de inspección/verificación/visita</label>
                        {{ form_input(['name' => 'Tipo_Inspeccion', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label>¿La inspección va dirigida a?</label>
                        <select name="Dirigida_A" class="form-control">
                            <option value="">Selecciona</option>
                            <option value="Físicas">Personas físicas</option>
                            <option value="Morales">Personas morales</option>
                            <option value="Ambas">Ambas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>La Inspección es (Ordinaria, Extraordinaria, etc.)</label>
                        {{ form_input(['name' => 'Caracter_Inspeccion', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label>¿Dónde se realiza la Inspección?</label>
                        {{ form_input(['name' => 'Realizada_En', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label>Objetivo de la Inspección<span class="text-danger">*</span></label>
                        {{ form_textarea(['name' => 'Objetivo', 'class' => 'form-control', 'rows' => 3, 'required' => true]) }}
                    </div>
                    <div class="form-group">
                        <label>Palabras Clave</label>
                        {{ form_textarea(['name' => 'Palabras_Clave', 'class' => 'form-control', 'rows' => 2]) }}
                    </div>
                    <div class="form-group">
                        <label>Periodicidad (Ej. Mensual, Trimestral)</label>
                        {{ form_input(['name' => 'Periodicidad', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label>Especificar qué motiva la Inspección</label>
                        {{ form_textarea(['name' => 'Motivo_Inspeccion', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label>Si la inspección es motivada por un Trámite o Servicio, menciona cuáles</label>
                        {{ form_textarea(['name' => 'Tramites_Servicios', 'class' => 'form-control', 'rows' => 2]) }}
                    </div>
                    <div class="form-group">
                        <label>Tamaño de empresa (número de trabajadores)</label>
                        {{ form_input(['name' => 'Tamano_Empresa', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label>¿Existe algún criterio que defina a qué sujeto regulado se aplica?</label>
                        <select name="Existe_Criterio" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                        <label>Describir el criterio (si "Sí")</label>
                        {{ form_textarea(['name' => 'Criterio_Descripcion', 'class' => 'form-control', 'rows' => 2]) }}
                    </div>
                    <div class="form-group">
                        <label>¿Se inspecciona a sujetos que hayan recibido resolución de algún trámite?</label>
                        <select name="Inspecciona_Sujetos_Resolucion" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                        <label>Nombre Trámite o Servicio</label>
                        {{ form_input(['name' => 'Nombre_Tramite_Servicio_Resol', 'class' => 'form-control']) }}
                        <label>Añadir enlace (http)</label>
                        {{ form_input(['name' => 'Enlace_Tramite_Servicio_Resol', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label>¿Existe un fundamento jurídico?</label>
                        <select name="Fundamento_Juridico" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                        <label>Nombre del trámite/fundamento</label>
                        {{ form_input(['name' => 'Nombre_Tramite_Fundamento', 'class' => 'form-control']) }}
                        <label>Añadir enlace (http)</label>
                        {{ form_input(['name' => 'Enlace_Fundamento', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-step" id="step-2">
                    <div class="form-group">
                        <label>Unidades Administrativas (JSON o texto)</label>
                        {{ form_textarea(['name' => 'Unidades_Administrativas', 'class' => 'form-control', 'rows' => 3]) }}
                        <small class="form-text text-muted">Podrías listar las IDs separadas por coma, o un
                            JSON.</small>
                    </div>
                </div>
                <div class="form-step" id="step-3">
                    <div class="form-group">
                        <label>Bien, elemento o sujeto de la inspección</label>
                        {{ form_textarea(['name' => 'Bien_Elemento', 'class' => 'form-control', 'rows' => 2]) }}
                    </div>
                    <div class="form-group">
                        <label>¿Participan otros Sujetos Obligados?</label>
                        <select name="Otros_Sujetos_Participan" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                        <label>Buscar/Agregar Sujeto Obligado Adicional</label>
                        {{ form_textarea(['name' => 'Sujeto_Obligado_Adicional', 'class' => 'form-control', 'rows' => 2]) }}
                    </div>
                    <div class="form-group">
                        <label>Derechos del Sujeto Regulado</label>
                        {{ form_textarea(['name' => 'Derechos_Sujeto_Regulado', 'class' => 'form-control', 'rows' => 2]) }}
                    </div>
                    <div class="form-group">
                        <label>Obligaciones del Sujeto Regulado</label>
                        {{ form_textarea(['name' => 'Obligaciones_Sujeto_Regulado', 'class' => 'form-control', 'rows' => 2]) }}
                    </div>
                    <div class="form-group">
                        <label>Requisitos o documentos a presentar</label>
                        {{ form_textarea(['name' => 'Requisitos_Inspeccion', 'class' => 'form-control', 'rows' => 2]) }}
                    </div>
                    <div class="form-group">
                        <label>¿Debe rellenar o firmar algún formato?</label>
                        <select name="Firmar_Formato" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                        <label>Subir formato (jpg, png, pdf)</label><br>
                        <input type="file" name="Archivo_Formato" class="form-control-file">
                        <label>¿El formato se encuentra fundamentado jurídicamente?</label>
                        <select name="Formato_Fundamento" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>¿Tiene algún costo?</label>
                        <select name="Tiene_Costo" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                        <label>Detalle costo/conceptos</label>
                        {{ form_textarea(['name' => 'Detalle_Costo', 'class' => 'form-control', 'rows' => 2]) }}
                    </div>
                    <div class="form-group">
                        <label>Pasos a realizar (puedes guardarlos en un JSON o texto)</label>
                        {{ form_textarea(['name' => 'Pasos', 'class' => 'form-control', 'rows' => 3]) }}
                    </div>
                </div>
                <div class="form-step" id="step-4">
                    <div class="form-group">
                        <label>Materia de la inspección (Ambiental, Laboral, etc.)</label>
                        {{ form_input(['name' => 'Materia_Inspeccion', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label>Sector / Subsector / Rama / Subrama / Clase</label>
                        {{ form_input(['name' => 'Sector', 'class' => 'form-control mb-2', 'placeholder' => 'Sector']) }}
                        {{ form_input(['name' => 'Subsector', 'class' => 'form-control mb-2', 'placeholder' => 'Subsector']) }}
                        {{ form_input(['name' => 'Rama', 'class' => 'form-control mb-2', 'placeholder' => 'Rama']) }}
                        {{ form_input(['name' => 'Subrama', 'class' => 'form-control mb-2', 'placeholder' => 'Subrama']) }}
                        {{ form_input(['name' => 'Clase', 'class' => 'form-control', 'placeholder' => 'Clase']) }}
                    </div>
                    <div class="form-group">
                        <label>¿Es posible avisar previamente?</label>
                        <select name="Aviso_Previo" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                        <label>Valor del plazo</label>
                        {{ form_input(['name' => 'Valor_Plazo', 'type' => 'number', 'class' => 'form-control']) }}
                        <label>Unidad de medida (días, semanas...)</label>
                        {{ form_input(['name' => 'Unidad_Medida_Plazo', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label>¿Qué tipo de sanciones pueden derivar?</label>
                        {{ form_input(['name' => 'Tipo_Sancion', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label>¿Las sanciones están fundamentadas jurídicamente?</label>
                        <select name="Sanciones_Fundamento" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                    </div>
                </div>
                <div class="form-step" id="step-5">
                    <div class="form-group">
                        <label>Facultades, atribuciones y obligaciones del Inspector</label>
                        {{ form_textarea(['name' => 'Facultades_Inspector', 'class' => 'form-control', 'rows' => 3]) }}
                    </div>
                    <div class="form-group">
                        <label>Las Inspecciones se realizan a través de:</label>
                        {{ form_textarea(['name' => 'Metodo_Inspecciones', 'class' => 'form-control', 'rows' => 2]) }}
                    </div>
                    <div class="form-group">
                        <label>¿Existe un contacto directo para quejas?</label>
                        <select name="Contacto_Quejas" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                        <label>Datos de contacto (si "Sí")</label>
                        {{ form_input(['name' => 'Contacto_Quejas_Datos', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-step" id="step-6">
                    <h8 class="mb-3">¿Cuántas inspecciones se realizaron en el año anterior por mes?
                        <h8 />
                        <div class="statistics-container">
                            <?php
$meses = [
    ['Enero', 'Febrero', 'Marzo'],
    ['Abril', 'Mayo', 'Junio'],
    ['Julio', 'Agosto', 'Septiembre'],
    ['Octubre', 'Noviembre', 'Diciembre']
];

foreach ($meses as $fila) {
    echo '<div class="statistics-row">';
    foreach ($fila as $mes) {
        echo '<div class="statistics-item">
                        <label class="mes-label">' . $mes . ':</label>
                        <input type="number" name="' . $mes . '_Inspecciones" class="form-control statistics-input" min="0" value="0">
                      </div>';
    }
    echo '</div>';
}
        ?>
                        </div>
                </div>
                <div class="form-step" id="step-7">
                    <h3>Paso 7: Información adicional</h3>
                    <div class="form-group">
                        <label>Información que se considere útil</label>
                        {{ form_textarea(['name' => 'Info_Adicional', 'class' => 'form-control', 'rows' => 3]) }}
                    </div>
                </div>
                <div class="form-step" id="step-8">
                    <h3>Paso 8: No publicidad</h3>
                    <div class="form-group">
                        <label>¿Permitir que todos los datos sean públicos?</label>
                        <select name="Permitir_Publicidad" class="form-control">
                            <option value="si">Sí</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Justificante no publicidad (PDF, JPG, PNG)</label><br>
                        <input type="file" name="Documento_No_Publicidad" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Determina la información que NO se puede publicar:</label>
                        <label>Datos de identificación</label>
                        <input type="text" name="No_Publicar_Datos_Identificacion" class="form-control"
                            placeholder="Ej. Homoclave, Nombre...">

                        <label>¿Ocultar contacto de la Autoridad Pública?</label>
                        <select name="No_Publicar_Contacto_Autoridad" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>

                        <label>Información sobre la inspección</label>
                        <input type="text" name="No_Publicar_Info_Inspeccion" class="form-control">

                        <label>Información de la Autoridad Pública</label>
                        <input type="text" name="No_Publicar_Info_Autoridad" class="form-control">

                        <label>Estadísticas</label>
                        <input type="text" name="No_Publicar_Estadisticas" class="form-control">
                    </div>
                </div>
                <div class="form-step" id="step-9">
                    <h3>Paso 9: Emergencias</h3>
                    <div class="form-group">
                        <label>¿La inspección es requerida para atender una situación de emergencia?</label>
                        <select name="Es_Emergencia" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Justificar razones de emergencia</label>
                        {{ form_textarea(['name' => 'Justificacion_Emergencia', 'class' => 'form-control', 'rows' => 3]) }}
                    </div>
                    <div class="form-group">
                        <label>Cargar el oficio o acta de declaración de emergencia (PDF, PNG, JPG)</label><br>
                        <input type="file" name="Archivo_Declaracion_Emergencia" class="form-control-file">
                    </div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn" id="prevBtn" onclick="navigateStep(-1)">Anterior</button>
                    <button type="button" class="btn" id="nextBtn" onclick="navigateStep(1)">Siguiente</button>
                    <button type="submit" class="btn" id="submitBtn" style="display:none;">Guardar todo</button>
                </div>
                {{ form_close() }}
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #8E354A;
        --border-color: #E5E7EB;
        --background-color: #F9FAFB;
        --text-color: #374151;
        --heading-color: #111827;
    }

    /* Update existing styles */
    .main-content {
        margin-top: -100px;
        /* Reduced from 55px */
    }

    .form-container {
        padding: 1.5rem;
        /* Reduced padding */
    }

    /* Add new grid layout styles */
    .form-step {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    /* Full width elements */
    .form-step>h3,
    .form-step>h5,
    .form-step>.full-width {
        grid-column: 1 / -1;
    }

    /* Smaller input fields */
    .form-control {
        padding: 0.375rem 0.5rem;
        /* Reduced padding */
        min-height: unset;
        /* Remove minimum height */
    }

    /* Smaller textareas */
    textarea.form-control {
        min-height: 60px;
        /* Reduced from default */
        max-height: 120px;
        /* Add maximum height */
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .form-step {
            grid-template-columns: 1fr;
            /* Single column on mobile */
        }
    }

    /* Adjust form group spacing */
    .form-group {
        margin-bottom: 1rem;
        /* Reduced from 1.5rem */
    }

    /* Make labels more compact */
    .form-group label {
        margin-bottom: 0.25rem;
        /* Reduced from 0.5rem */
        font-size: 0.9rem;
        /* Slightly smaller font */
    }

    .container-fluid {
        background-color: var(--background-color);
        min-height: 100vh;
        padding-top: 1rem;
    }

    .sidebar-wizard {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .wizard-step {
        border: none !important;
        color: var(--text-color);
        padding: 1rem 1.5rem;
        margin-bottom: 0.5rem;
        border-radius: 0.375rem !important;
        transition: all 0.2s;
    }

    .wizard-step:hover {
        background-color: #F3F4F6;
    }

    .wizard-step.active {
        background-color: var(--primary-color) !important;
        color: white;
    }

    .form-container {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--heading-color);
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 0.375rem;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        outline: none;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    #nextBtn,
    #submitBtn {
        background-color: var(--primary-color);
        border: none;
    }

    #nextBtn:hover,
    #submitBtn:hover {
        background-color: #4F46E5;
    }

    .form-navigation {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }


    .validate-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
    }

    /* Estilos para los botones de navegación */
    .form-navigation {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    /* Estilo base para todos los botones */
    .form-navigation .btn {
        padding: 8px 24px;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.2s;
        border: none;
    }

    /* Botón Anterior */
    #prevBtn {
        background-color: #6B7280;
        /* Color gris */
        color: white;
    }

    #prevBtn:hover {
        background-color: #4B5563;
    }

    /* Botón Siguiente */
    #nextBtn {
        background-color: #4A0404;
        /* Color guinda/maroon */
        color: white;
    }

    #nextBtn:hover {
        background-color: #3A0303;
    }

    /* Botón Guardar */
    #submitBtn {
        background-color: rgb(76, 228, 134);
        /* Color guinda/maroon */
        color: white;
    }

    #submitBtn:hover {
        background-color: #3A0303;
    }

    /* Estilo para botón deshabilitado */
    .form-navigation .btn:disabled {
        background-color: #D1D5DB;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .statistics-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .statistics-item {
        display: flex;
        flex-direction: column;
    }

    .statistics-item label {
        margin-bottom: 0.25rem;
    }

    .statistics-input {
        width: 100%;
        padding: 0.375rem 0.5rem;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .statistics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .statistics-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Estilos específicos para el paso de estadísticas */
    .statistics-container {
        width: 100%;
        max-width: 800px;
        margin-left: 0;
    }

    .statistics-row {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }

    .statistics-item {
        display: flex;
        align-items: center;
        width: 250px;
    }

    .mes-label {
        width: 100px;
        text-align: left;
        margin-right: 10px;
    }

    .statistics-input {
        width: 80px !important;
    }

    @media (max-width: 768px) {
        .statistics-row {
            flex-direction: column;
            gap: 10px;
        }

        .statistics-item {
            width: 100%;
        }
    }

    /* Nuevos estilos para los campos de entrada */
    .form-control {
        width: 100%;
        max-width: 300px;
        padding: 0.375rem 0.5rem;
        font-size: 0.9rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    textarea.form-control {
        min-height: 60px;
        max-height: 120px;
        resize: vertical;
    }

    select.form-control {
        width: 100%;
        max-width: 300px;
        padding: 0.375rem 0.5rem;
        font-size: 0.9rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
        font-weight: bold;
    }

    .form-step {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .form-step>h3,
    .form-step>h5,
    .form-step>.full-width {
        grid-column: 1 / -1;
    }

    @media (max-width: 768px) {
        .form-step {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    let currentStep = 1;
    const totalSteps = 9;

    function showStep(step) {
        $('.form-step').hide();
        $(`#step-${step}`).show();
        $('.wizard-step').removeClass('active');
        $(`.wizard-step[data-step="${step}"]`).addClass('active');

        if (step === 1) {
            $('#prevBtn').hide();
        } else {
            $('#prevBtn').show();
        }

        if (step === totalSteps) {
            $('#nextBtn').hide();
            $('#submitBtn').show();
        } else {
            $('#nextBtn').show();
            $('#submitBtn').hide();
        }

        currentStep = step;
    }

    function navigateStep(direction) {
        const newStep = currentStep + direction;
        if (newStep >= 1 && newStep <= totalSteps) {
            showStep(newStep);
        }
    }

    $(document).ready(function () {
        showStep(1);

        $('.wizard-step').click(function () {
            const step = $(this).data('step');
            showStep(step);
        });
    });

    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection