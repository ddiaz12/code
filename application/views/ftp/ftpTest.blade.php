<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subir Archivo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.6/sweetalert2.min.css">
</head>
<body>
    <h2>Subir Archivo</h2>
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="userfile" id="userfile" size="20" />
        <br /><br />
        <button type="button" onclick="enviarFormulario()">Subir</button>
    </form>

    <div id="response"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.6/sweetalert2.min.js"></script>
    <script>
    function enviarFormulario() {
        var formData = new FormData();
        formData.append('userfile', $('#userfile')[0].files[0]);

        $.ajax({
            url: '<?php echo base_url('ftp/upload_file'); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#response').html(response);
            },
            error: function() {
                console.error('Error al procesar la solicitud.');
            }
        });
    }
    </script>
</body>
</html>
