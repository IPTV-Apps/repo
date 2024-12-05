['#borderColor'].forEach(function (elementId) {
    $(elementId).spectrum({
        preferredFormat: "hex3",
        showInput: true,
        change: function (color) {
            $.ajax({
                type: 'post',
                url: './includes/post_webview_tmdb.php',
                data: {
                    post_borderColor: 1,
                    borderColor: color.toString()
                },
                success: function () {
                    location.reload();
                }
            });
        }
    });
});

$('#interval').bootstrapSlider().on('change', function () {
    var intervalValue = $(this).bootstrapSlider('getValue');
    $.ajax({
        type: 'post',
        url: './includes/post_webview_tmdb.php',
        data: {
            post_interval: 1,
            interval: intervalValue
        },
        success: function () {
            location.reload();
        }
    });
});

$(document).ready(function () {
    function handleCheckboxChange(checkboxId, postKey) {
        $(checkboxId).on('change', function () {
            var isChecked = $(this).prop('checked');
            $.ajax({
                type: 'post',
                url: './includes/post_webview_tmdb.php',
                data: {
                    [postKey]: 1,
                    [checkboxId.replace('#', '')]: isChecked ? 'enabled' : 'disabled'
                },
                success: function () {
                    location.reload();
                }
            });
        });
    }

    const checkboxes = {
        '#hideTitle': 'post_hideTitle',
        '#hideSubtitle': 'post_hideSubtitle',
        '#hideRating': 'post_hideRating',
        '#hideCard': 'post_hideCard',
        '#hideLogo': 'post_hideLogo',
        '#hideInfo': 'post_hideInfo',
        '#hidePoster': 'post_hidePoster',
        '#hideActors': 'post_hideActors',
        '#hideNav': 'post_hideNav',
    };

    for (let checkboxId in checkboxes) {
        handleCheckboxChange(checkboxId, checkboxes[checkboxId]);
    }
});
