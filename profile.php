<?php
require_once  'includes/global.php';
require_once 'includes/auth.php';
require_once 'includes/header.php';
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<link href="css/formValidation.min.css" rel="stylesheet" type="text/css"/>
<script src="js/lib/bootstrap-datepicker_1.3.0_js_bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="js/lib/formValidation.min.js" type="text/javascript"></script>
<script src="js/lib/bootstrap.FormValidation.js" type="text/javascript"></script>
<script src="js/userInfo.js"></script>

<div class="col-sm-3">


</div>

<div class="col-sm-6 panel panel-default">



    <h2>Profile</h2>
    <form role="form" id="userInfo">
        <div class="form-group ">
            <label for="username">Username: *</label>
            <input type="text" class="form-control" id="username" name="username"
                   placeholder="" readonly>
        </div>
        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="">
        </div>
        <div class="form-group">
            <label for="email">Email address: *</label>
            <input type="email" class="form-control" id="email" name="email" placeholder=""
                   readonly>
        </div>
        <div class="form-group">
            <label for="datepicker">Birth date:</label>

            <div class="input-group input-append date" id="datePicker">
                <input type="text" class="form-control" name="date" id="bdayCalendar" value=""/>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <div class="form-group">
            <label>Gender</label>

            <div class="radio">
                <label>
                    <input type="radio" name="gender" value="male" id="male" /> Male
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="gender" value="female" id="female"/>Female
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="about">About myself:</label>
            <textarea class="form-control" rows="5" id="about" name="about">
            </textarea>
        </div>

        <button type="submit" class="btn btn-default">Save</button>
    </form>
    <h3>Change Password</h3>
    <hr>
    <form role="form" id="changePassword">
        <div class="form-group pass">
            <label for="old_password">Old Password:</label>
            <input type="password" class="form-control" id="old_password" name="old_password">
        </div>
        <div class="form-group">
            <label for="pwd">New Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="repwd">Re-Enter New Password:</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
        </div>

        <button type="submit" class="btn btn-default">Change Password</button>

    </form>


    <?php
    include_once 'includes/footer.php';
    ?>
