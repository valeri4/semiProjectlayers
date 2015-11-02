<?php

require_once 'includes/global.php';
require_once 'includes/auth.php';
require_once 'includes/header.php';


//var_dump($_SESSION['friends_req_count']);
//var_dump($_SESSION['friends_req_count']);
//var_dump($_SESSION['friend_1']);
//var_dump($_SESSION['friend_2']);
//var_dump($_SESSION['u_id']);
//var_dump($_SESSION['uuID']);
//var_dump($_SESSION['user_image']);
//var_dump($_COOKIE['remember_me']);
?>
<script src="js/friendContent.js" type="text/javascript"></script>
<!-- content -->                      
<div class="row">

    <!-- main col left --> 
    <div class="col-sm-3" id="mainColLeft">
        <div id="friendInfo">
            <div class="panel panel-default">
                <div class="panel-thumbnail userPicure"><img src="profileImg/man.jpg" class="img-responsive"></div>
                <div class="panel-body">
                    <p class="lead fullName"></p>
                    <p class="birthDay"></p>
                    <p class="gender"></p>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><h4>About me:</h4></div>
                <div class="panel-body" id="aboutBlock">
                    <p class="aboutMeBody"></p>
                </div>
            </div>

        </div>

    </div>

    <!-- main col right -->
    <div class="col-sm-7">
        <div class="panel panel-default">

            <div id='friendPostsBlock'>
                <div id="friendsContenHeader"><h3></h3></div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="requestModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalHeader">Request Satus</h4>
                </div>
                <div class="modal-body" id="requestModalBody">
                    <p class="modalContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php

    require_once './includes/footer.php';
    