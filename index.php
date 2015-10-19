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
<script src="js/mainContent.js" type="text/javascript"></script>
<link href="css/formValidation.min.css" rel="stylesheet" type="text/css"/>
<script src="js/lib/formValidation.min.js" type="text/javascript"></script>
<script src="js/lib/bootstrap.FormValidation.js" type="text/javascript"></script>
<!-- content -->                      
<div class="row">

    <!-- main col left --> 
    <div class="col-sm-3">

        <div class="panel panel-default">
            <div class="panel-thumbnail userPicure"><img src="" class="img-responsive"></div>
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
            <div class="panel-body">
                <p class="aboutMeBody">dgssdgdfgdfgdfgdfgdfg</p>
            </div>
        </div>



    </div>

    <!-- main col right -->
    <div class="col-sm-7">

        <div class="well"> 
            <form class="form-horizontal" role="form" id='post'>
                <h4>What's New</h4>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Update your status" id='addPost' name="addPost"></textarea>
                </div>
                <button class="btn btn-primary" type="button" id="postBtn">Post</button>
                <img src="img/ajax-loader.gif" alt="loading..." class="loading" id="loader"/>
            </form>
        </div>

        <div id='postsBlock'>

        </div>



        <!--post modal-->
        <div id="editPostWindow" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        Edit Post
                    </div>
                    <div class="modal-body">
                        <form class="form center-block">
                            <div class="form-group">
                                <textarea class="form-control input-lg" id="textEditor" autofocus=""></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button class="btn btn-primary" type="button" data-dismiss="modal" aria-hidden="true" id="updatePost">Update</button>
                            <img src="img/ajax-loader.gif" alt="loading..." class="loading" id="loader"/>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
        <?php

        require_once './includes/footer.php';
        