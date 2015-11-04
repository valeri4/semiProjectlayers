
var countNewFriends2view;

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

    $.ajax({
        type: 'GET',
        url: "friends/friendsAPI.php",
        data: {command: "get_new_friend_view"},
        error: function (err) {
            console.log("Error: " + err.status);
        },
        success: function (userData) {

            switch (userData) {
                case 'no_new_friends':
                    break;
                default:
                    $('#newFriends').text(userData);
                    countNewFriends2view = userData;
                    console.log(countNewFriends2view);
            }
        }
    });


    var availableTags = [
        "ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++",
        "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran",
        "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl",
        "PHP", "Python", "Ruby", "Scala", "Scheme"
    ];

    $("#srch-term").autocomplete({
        source: availableTags
    });

});


