$(document).ready(function () {
    $('#layout').on('change', function () {
        $.ajax({
            type: 'post',
            url: './includes/post_webview_frameview.php',
            data: { 
                post_frameview_layout: 1,
                layout: $(this).val()
            },
            success: function (response) {
                location.reload(); // Reload the page
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    });
});