$(function () {
    function log(message) {
        $("<div>").text(message).prependTo("#log");
        $("#log").scrollTop(0);
    }

    $("#srch-term").autocomplete({
        source: function (request, response) {
            $.ajax({
                type: "POST",
                url: "users/autoCompleteSearch.php",
                dataType: "json",
                data: {
                    q: request.term
                },
                success: function (data) {
                    response( data );
                }
            });
        },
        minLength: 3,
        select: function (event, ui) {
            log(ui.item ?
                    "Selected: " + ui.item.label :
                    "Nothing selected, input was " + this.value);
        },
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function () {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });
}); 