<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Faceboot - A Facebook style template for Bootstrap</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/formValidation.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="css/styles.css" rel="stylesheet">
        
        
        <!-- script references -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/lib/bootstrap.min.js"></script>
        <script src="js/lib/jquery-ui.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
        <script src="js/lib/formValidation.min.js" type="text/javascript"></script>
        <script src="js/lib/bootstrap.js" type="text/javascript"></script>
        <script src="js/validation.js" type="text/javascript"></script>
        <script src="js/userPosts.js" type="text/javascript"></script>
        <script src="js/scripts.js"></script>
        <script src="js/aboutMe.js" type="text/javascript"></script>
        <script src="js/removeEditPosts.js" type="text/javascript"></script>
        <script src="js/lib/jquery.visible.min.js" type="text/javascript"></script>
        <script src="js/loadPosts.js" type="text/javascript"></script>
        <script src="js/friendAutocomplete.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="box">
                <div class="row row-offcanvas row-offcanvas-left">

                    <!-- main right col -->
                    <div class="column col-sm-12 col-xs-12" id="main">

                        <!-- top nav -->
                        <div class="navbar navbar-blue navbar-static-top">  
                            <div class="navbar-header">
                                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="/SemiProjectLayers" class="navbar-brand logo">FSN</a>
                            </div>
                            <nav class="collapse navbar-collapse" role="navigation">
                                <form class="navbar-form navbar-left">
                                    <div class="input-group input-group-sm" style="max-width:360px;">
                                        <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="#postModal" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle userIco" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="profile.php">Profile</a></li>
                                            <li><a href="logout.php">LogOut</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- /top nav -->

                        <div class="padding">
                            <div class="full col-sm-9">

  