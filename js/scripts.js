
$(function () {
    $.ajax({
        type: 'GET',
        url: "friends/friendsAPI.php",
        data: {command: "get_requests"},
        error: function (err) {
            console.log("Error: " + err.status);
        },
        success: function (userData) {
            if (userData == "no_requests") {
                $('#requestBadge').text(0);
            }
            if (userData == '[null]') {
                $('#requestBadge').text(0);
            } else {
                userData = JSON.parse(userData);

                $('#requestBadge').text(userData.length);
            }
        }
    });

});


