

window.friendsRequests = {};
$(function () {
    $.ajax({
        type: 'GET',
        url: "friends/friendsAPI.php",
        data: {command: "get_requests"},
        error: function (err) {
            console.log("Error: " + err.status);
        },
        success: function (userData) {
            userData = JSON.parse(userData);
            window.friendsRequests.userData = userData;

            $('#requestBadge').text(userData.length);

        }
    });

});



console.dir(window.friendsRequests.userData);