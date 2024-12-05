$(function () {
    $("#post_thesportsdb").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('post_thesportsdb_leagues', '1');
        $.ajax({
            type: "post",
            url: "./includes/post_webview_thesportsdb.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                location.reload();
            },
        });
    });
});

$(document).ready(function () {
    $('#widget').on('change', function () {
        $.ajax({
            type: 'post',
            url: './includes/post_webview_thesportsdb.php',
            data: { 
                post_thesportsdb: 1,
                widget: $(this).val()
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

$('#tsdb_leagues').picker({search : true});