
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




    var NoResultsLabel = "No Results";
    $("#srch-term").autocomplete({
        source: function (request, response) {
            $.ajax({
                type: "GET",
                url: "friends/friendsAPI.php",
                dataType: "json",
                data: {
                    command: 'autocomplete',
                    search_input: request.term
                },
                success: function (data) {
                    searchResult = [];

                    if (data == "user_not_exist") {
                        searchResult = [NoResultsLabel];
                    } else {
                        for (i = 0; i < data.length; i++) {
                            searchResult.push({label: data[i].first_name + " " + data[i].last_name, value: data[i].username});
                        }
                    }

                    response(searchResult);
                }
            });
        },
        minLength: 3,
        select: function (event, ui) {

            if (ui.item.label === NoResultsLabel) {
                event.preventDefault();
            }else{
                console.log(ui.item.label);
                console.log(ui.item.value);
                
                window.location.href = "friends.php?" + ui.item.value;
            }

        },
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function () {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });
});


