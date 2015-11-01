
$(function () {
    $.ajax({
        type: 'GET',
        url: "friends/friendsAPI.php",
        data: {command: "get_requests"},
        error: function (err) {
            console.log("Error: " + err.status);
        },
        success: function (userData) {

            switch (userData) {
                case 'no_requests':
                    $('#requestBadge').text(0);
                    break;

                case '[null]':
                    $('#requestBadge').text(0);
                    break;

                default:
                    userData = JSON.parse(userData);

                    $('#requestBadge').text(userData.length);
            }
        }
    });

});


