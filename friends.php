<?php

require_once 'includes/global.php';
require_once 'includes/auth.php';
require_once 'includes/header.php';


//var_dump($_SESSION['about']);
//var_dump($_SESSION['username']);
//var_dump($_SESSION['u_id']);
//var_dump($_SESSION['uuID']);
//var_dump($_SESSION['user_image']);
//var_dump($_COOKIE['remember_me']);
?>
<script src="js/friendContent.js" type="text/javascript"></script>
<!-- content -->                      
<div class="row">

    <!-- main col left --> 
    <div class="col-sm-3">

        <div class="panel panel-default">
            <div class="panel-thumbnail userPicure"><img src="profileImg/man.jpg" class="img-responsive"></div>
            <div class="panel-body">
                <p class="lead fullName"></p>
                <p class="birthDay"></p>
                <p class="gender"></p>
            </div>
        </div>


        <!--                                      <div class="panel panel-default">
                                                <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>Bootstrap Examples</h4></div>
                                                  <div class="panel-body">
                                                    <div class="list-group">
                                                      <a href="http://bootply.com/tagged/modal" class="list-group-item">Modal / Dialog</a>
                                                      <a href="http://bootply.com/tagged/datetime" class="list-group-item">Datetime Examples</a>
                                                      <a href="http://bootply.com/tagged/datatable" class="list-group-item">Data Grids</a>
                                                    </div>
                                                  </div>
                                              </div>
                                           
                                              <div class="well"> 
                                                   <form class="form-horizontal" role="form">
                                                    <h4>What's New</h4>
                                                     <div class="form-group" style="padding:14px;">
                                                      <textarea class="form-control" placeholder="Update your status"></textarea>
                                                    </div>
                                                    <button class="btn btn-primary pull-right" type="button">Post</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                                                  </form>
                                              </div>
                                           
                                              <div class="panel panel-default">
                                                 <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>More Templates</h4></div>
                                                  <div class="panel-body">
                                                    <img src="//placehold.it/150x150" class="img-circle pull-right"> <a href="#">Free @Bootply</a>
                                                    <div class="clearfix"></div>
                                                    There a load of new free Bootstrap 3 ready templates at Bootply. All of these templates are free and don't require extensive customization to the Bootstrap baseline.
                                                    <hr>
                                                    <ul class="list-unstyled"><li><a href="http://www.bootply.com/templates">Dashboard</a></li><li><a href="http://www.bootply.com/templates">Darkside</a></li><li><a href="http://www.bootply.com/templates">Greenfield</a></li></ul>
                                                  </div>
                                              </div>-->

        <div class="panel panel-default">
            <div class="panel-heading"><h4>About me:</h4></div>
            <div class="panel-body" id="aboutBlock">
                <p class="aboutMeBody"></p>
            </div>
        </div>



    </div>

    <!-- main col right -->
    <div class="col-sm-7">
        <div class="panel panel-default">
            <div id='friendPostsBlock'>

            </div>
        </div>
    </div>




    <div class="modal fade" id="requestModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Request Satus</h4>
                </div>
                <div class="modal-body" id="requestModalBody">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php

    require_once './includes/footer.php';
    