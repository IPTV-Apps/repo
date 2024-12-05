$('#interval').bootstrapSlider();

$(document).ready(function () {
    var totalFiles = 0;
    var uploadedFiles = 0;
    var spinner = $('#upload-spinner');
    var errorMsg = $('#error-msg');

    $('#fileupload').fileupload({
        previewMaxHeight: 80,
        previewMaxWidth: 120,
        url: 'https://api.imgur.com/3/image',
        type: 'POST',
        headers: {
            Authorization: 'Client-ID 9e57cb1c4791cea'
        },
        dataType: 'json',
        singleFileUploads: true,
        autoUpload: true,
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        maxFileSize: 999000,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|a?png|tiff)$/i,
        add: function (e, data) {
            spinner.show();
            data.formData = {
                image: data.files[0]
            };
            data.submit();
        },
        done: function (e, data) {
            var fileUrl = data.result.data.link;
            $.ajax({
                url: './includes/post_webview_slideshow.php',
                type: 'POST',
                data: {
                    post_images: 1,
                    fileUrl: fileUrl
                },
                success: function (response) {
                    uploadedFiles++;
                    if (uploadedFiles === totalFiles) {
                        location.reload();
                    }
                }
            });
            spinner.hide();
        },
        fail: function (e, data) {
            errorMsg.html('Upload failed: ' + data.errorThrown);
            spinner.hide();
        }
    });

    $('#fileupload').on('fileuploadadd', function (e, data) {
        totalFiles++;
    });

    $('#fileupload').on('fileuploadchange', function (e, data) {
        $('#fileupload .empty-row').hide();
    });

    $('#fileupload').on('fileuploadfail', function (e, data) {
        if (data.errorThrown === 'abort') {
            if ($('#fileupload .files tr').not('.empty-row').length == 1) {
                $('#fileupload .empty-row').show();
            }
        }
    });

    if ($.support.cors) {
        $.ajax({
            url: 'https://api.imgur.com/3/image/0r65LVT',
            type: 'GET',
            headers: {
                'Authorization': 'Client-ID 9e57cb1c4791cea'
            },
            success: function (response) {
                console.log('Imgur API is up:', response);
            },
            error: function () {
                var alert = '<div class="alert alert-danger m-b-0 m-t-15">Imgur API server currently unavailable - ' + new Date() + '</div>';
                errorMsg.removeClass('d-none').html(alert);
            }
        });
    }
});

function viewImage(url) {
    document.getElementById('modalImage').src = url;
    $('#imageModal').modal('show');
}

function deleteImage(id) {
    var result = confirm('Are you sure you want to delete this image?');
    if (result) {
        $.ajax({
            url: './includes/post_webview_slideshow.php',
            type: 'POST',
            data: {
                delete_image: 1,
                id: id
            },
            success: function (response) {
                location.reload();
            }
        });
    }
}
