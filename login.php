<?php
require_once  'includes/global.php';

if ($_SESSION['auth']) {
    redirect('index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Faceboot - A Facebook style template for Bootstrap</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/formValidation.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="css/styles.css" rel="stylesheet">
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
                                <a href="/" class="navbar-brand logo">FSN</a>
                            </div>
                        </div>
                        <!-- /top nav -->

                        <div class="padding">
                            <div class="full col-sm-10">

                                <!-- content -->                      
                                <div class="row">

                                    <!-- main col left --> 
                                    <div class="col-sm-4">
                                        <h1>First Social Network</h1>
                                        <p class="lead">Just try it...</p>
                                    </div>

                                    <!-- main col right -->
                                    <div class="col-sm-5">

                                        <div class="panel">
                                            <div class="panel-body">
                                                <h3>Sign In</h3>
                                                <form role="form" id="formLogIn">
                                                    <div class="form-group">
                                                        <label for="email_login">Email address:</label>
                                                        <input type="email" class="form-control" id="email_login" name="email_login">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pwd_login">Password:</label>
                                                        <input type="password" class="form-control" id="pwd_login" name="pwd_login">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>
                                                            <input type="checkbox" id="remember_me" name="remember_me"> Remember Me
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn btn-default" id="logInSubmit">Sign In</button>
                                                    <img src="img/ajax-loader.gif" alt="loading..." class="loading" id="loader"/>
                                                </form>
                                                <h5>OR</h5>
                                                <button type="button" class="btn btn-success" id="signUpFormCollaps">Sign Up</button>
                                                <div class="collapse">
                                                    <h1>Sign Up</h1>
                                                    <form role="form" id="defaultForm">
                                                        <div class="form-group ">
                                                            <label for="username">Username: *</label>
                                                            <input type="text" class="form-control" id="username" name="username">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="firstName">First Name:</label>
                                                            <input type="text" class="form-control" id="firstName" name="firstName">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="lastName">Last Name:</label>
                                                            <input type="text" class="form-control" id="lastName" name="lastName">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email address: *</label>
                                                            <input type="email" class="form-control" id="email" name="email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password">Password: *</label>
                                                            <input type="password" class="form-control" id="password" name="password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="confirmPassword">Retype password:</label>
                                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="datepicker">Birth date:</label>
                                                            <div class="input-group input-append date" id="datePicker">
                                                                <input type="text" class="form-control" name="date"/>
                                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            </div>  
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="gender" value="male" id="gender" /> Male
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="gender" value="female" id="gender" /> Female
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-lg-9 col-lg-offset-3">
                                                                <button type="submit" id="submit" class="btn btn-primary">Sign up</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!--/row-->

                            </div><!-- /col-9 -->
                        </div><!-- /padding -->
                    </div>
                    <!-- /main -->

                </div>
            </div>
        </div>

        <!-- script references -->
        <script src="js/lib/jquery.js" type="text/javascript"></script>
        <script src="js/lib/bootstrap.min.js"></script>
        <script src="js/lib/bootstrap-datepicker_1.3.0_js_bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="js/lib/formValidation.min.js" type="text/javascript"></script>
        <script src="js/lib/bootstrap.FormValidation.js" type="text/javascript"></script>
        <script src="js/validation.js" type="text/javascript"></script>
    </body>
</html>