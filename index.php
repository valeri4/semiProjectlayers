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
<!-- content -->                      
<div class="row">

    <!-- main col left --> 
    <div class="col-sm-5">

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
            <form class="form-horizontal" role="form">
                <h4>What's New</h4>
                <div class="form-group" style="padding:14px;">
                    <textarea class="form-control" placeholder="Update your status"></textarea>
                </div>
                <button class="btn btn-primary" type="button">Post</button>
            </form>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>Bootply Editor &amp; Code Library</h4></div>
            <div class="panel-body">
                <p><img src="//placehold.it/150x150" class="img-circle pull-right"> <a href="#">The Bootstrap Playground</a></p>
                <div class="clearfix"></div>
                <hr>
                Design, build, test, and prototype using Bootstrap in real-time from your Web browser. Bootply combines the power of hand-coded HTML, CSS and JavaScript with the benefits of responsive design using Bootstrap. Find and showcase Bootstrap-ready snippets in the 100% free Bootply.com code repository.
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><a href="#" class="pull-right">View all</a> <p><strong>Stackoverflow</strong></p> <small>bdfdfdhd</small></div>
            <div class="panel-body">
                <img src="//placehold.it/150x150" class="img-circle pull-right"> <a href="#">Keyword: Bootstrap</a>
                <div class="clearfix"></div>
                <hr>

                <p>If you're looking for help with Bootstrap code, the <code>twitter-bootstrap</code> tag at <a href="http://stackoverflow.com/questions/tagged/twitter-bootstrap">Stackoverflow</a> is a good place to find answers.</p>

                <hr>
                <form>
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button class="btn btn-default">+1</button><button class="btn btn-default"><i class="glyphicon glyphicon-share"></i></button>
                        </div>
                        <input type="text" class="form-control" placeholder="Add a comment..">
                    </div>
                </form>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><a href="#" class="pull-right">View all</a> 


                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>


                <p><strong>Portlet Heading</strong></p></div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">Modals</li>
                    <li class="list-group-item">Sliders / Carousel</li>
                    <li class="list-group-item">Thumbnails</li>
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-thumbnail"><img src="/assets/example/bg_4.jpg" class="img-responsive"></div>
            <div class="panel-body">
                <p class="lead">Social Good</p>
                <p>1,200 Followers, 83 Posts</p>

                <p>
                    <img src="https://lh6.googleusercontent.com/-5cTTMHjjnzs/AAAAAAAAAAI/AAAAAAAAAFk/vgza68M4p2s/s28-c-k-no/photo.jpg" width="28px" height="28px">
                    <img src="https://lh4.googleusercontent.com/-6aFMDiaLg5M/AAAAAAAAAAI/AAAAAAAABdM/XjnG8z60Ug0/s28-c-k-no/photo.jpg" width="28px" height="28px">
                    <img src="https://lh4.googleusercontent.com/-9Yw2jNffJlE/AAAAAAAAAAI/AAAAAAAAAAA/u3WcFXvK-g8/s28-c-k-no/photo.jpg" width="28px" height="28px">
                </p>
            </div>
        </div>

    </div>
</div><!--/row-->



<?php

require_once './includes/footer.php';
