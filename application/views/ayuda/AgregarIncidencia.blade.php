<div id="AgregarIncidencia" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg p-6 w-1/2">

        <h2 class="text-xl font-semibold mb-4">Agregar Incidencia</h2>

        <form id="incidenceForm">
            <label class="block">Título de la incidencia <span class="text-red-500">*</span></label>
            <input type="text" name="title" required class="w-full border px-3 py-2 rounded mb-2">

            <label class="block">Descripción</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded mb-2"></textarea>

            <label class="block">Proyecto <span class="text-red-500">*</span></label>
            <select name="project" required class="w-full border px-3 py-2 rounded mb-2">
                <option>Selecciona una opción</option>
                @foreach($projects as $project)
                    <option value="{{ $project }}">{{ $project }}</option>
                @endforeach
            </select>

            <label class="block">Reproducible <span class="text-red-500">*</span></label>
            <select name="reproducible" required class="w-full border px-3 py-2 rounded mb-2">
                <option>No aplicable</option>
                @foreach($reproducibles as $reproducible)
                    <option value="{{ $reproducible }}">{{ $reproducible }}</option>
                @endforeach
            </select>

            <label class="block">Gravedad <span class="text-red-500">*</span></label>
            <select name="severity" required class="w-full border px-3 py-2 rounded mb-2">
                <option>Selecciona una opción</option>
                @foreach($severities as $severity)
                    <option value="{{ $severity }}">{{ $severity }}</option>
                @endforeach
            </select>

            <label class="block">Clasificación <span class="text-red-500">*</span></label>
            <select name="classification" required class="w-full border px-3 py-2 rounded mb-2">
                <option>Selecciona una opción</option>
                @foreach($classifications as $classification)
                    <option value="{{ $classification }}">{{ $classification }}</option>
                @endforeach
            </select>

            <label class="block">Archivos Anexos <span class="text-red-500">*</span></label>
            <input type="file" name="files[]" multiple required accept=".png,.jpg,.jpeg,.pdf,.doc,.docx" class="w-full border px-3 py-2 rounded mb-4">

            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded">Cancelar</button>
                <button type="button" onclick="submitForm()" class="px-4 py-2 bg-blue-500 text-white rounded">Agregar Incidencia</button>
            </div>
        </form>

        <div id="message" class="mt-4"></div>

    </div>
</div>

<script>
function showModal() {
    $('#AgregarIncidencia').removeClass('hidden');
}

function closeModal() {
    $('#AgregarIncidencia').addClass('hidden');
}

function submitForm() {
    const form = $('#incidenceForm')[0];
    const formData = new FormData(form);

    $.ajax({
        url: '{{ base_url("ayuda/store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            const res = JSON.parse(response);
            const messageDiv = $('#message');
            if (res.status === 'success') {
                messageDiv.html('<div class="alert alert-success">' + res.message + '</div>');
                form.reset();
                setTimeout(() => {
                    closeModal();
                    messageDiv.html('');
                }, 2000);
            } else {
                messageDiv.html('<div class="alert alert-danger">' + res.message + '</div>');
            }
        },
        error: function() {
            $('#message').html('<div class="alert alert-danger">Error al enviar el formulario.</div>');
        }
    });
}
</script>
