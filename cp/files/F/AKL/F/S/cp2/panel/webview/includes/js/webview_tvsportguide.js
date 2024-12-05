['#tvsg_boarder_color', '#tvsg_background_color', '#tvsg_text_color'].forEach(function(elementId) {
    $(elementId).spectrum({
        preferredFormat: "hex",
        "showInput": true
    });
});