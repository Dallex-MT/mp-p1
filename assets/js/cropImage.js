document.addEventListener("DOMContentLoaded", function () {
    $(document).on('click', '#upload-aphoto', function () {
        document.getElementById('selectedFile').click();
    });

    $('#selectedFile').change(function () {
        if (this.files[0] == undefined)
            return;
        $('#imageModalContainer').modal('show');
        let reader = new FileReader();
        reader.addEventListener("load", function () {
            window.src = reader.result;
            $('#selectedFile').val('');
        }, false);
        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        }
    });

    let croppi;
    $('#imageModalContainer').on('shown.bs.modal', function () {
        let width = document.getElementById('crop-image-container').offsetWidth - 100;
        $('#crop-image-container').height((width - 80) + 'px');
        croppi = $('#crop-image-container').croppie({
            viewport: {
                width: width,
                height: width,
                type: 'square'
            },
            boundary: {
                width: width,
                height: width
            }
        });
        $('.modal-body1').height(document.getElementById('crop-image-container').offsetHeight + 50 + 'px');
        croppi.croppie('bind', {
            url: window.src,
        }).then(function () {
            croppi.croppie('setZoom', 0);
        });
    });
    $('#imageModalContainer').on('hidden.bs.modal', function () {
        croppi.croppie('destroy');
    });

    $(document).on('click', '.save-modal', function (ev) {
        croppi.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            size: 'original'
        }).then(function (resp) {
            // Enviar la imagen recortada al servidor mediante AJAX
            $.ajax({
                url: 'changePicture.php',
                type: 'POST',
                data: { imagen: resp },
                success: function(response) {
                    console.log('Imagen guardada con éxito en el servidor');
                },
                error: function(xhr, status, error) {
                    console.error('Error al guardar la imagen en el servidor:', error);
                }
            });
            $('.modal').modal('hide');
        });
    });
});