<?php
require_once 'includes/global.php';
require_once (__DIR__ . '/includes/auth.php');

//if ($_SESSION['about']) {
//    redirect('index.php');
//}

require_once 'includes/header.php';
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<link href="css/formValidation.min.css" rel="stylesheet" type="text/css"/>
<script src="js/lib/formValidation.min.js" type="text/javascript"></script>
<script src="js/lib/bootstrap.FormValidation.js" type="text/javascript"></script>
<script src="js/lib/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="js/uploadImg.js" type="text/javascript"></script>
<script src="js/about.js" type="text/javascript"></script>


<div class="col-sm-3">


</div>

<div class="col-sm-6 panel panel-default">

    <h2>Profile</h2>

    <div class="row">
        <!--        <div class="col-sm-6 col-md-4">
                    <div class="thumbnail defaultImg">
                        <img src="profileImg/man.jpg" alt=""/>
                        <div class="caption">
                            <h5>Default Picture</h5>
                            <i class="glyphicon glyphicon-ok"></i>
                        </div>
                    </div>
                </div>-->


        <div class="col-sm-4 col-md-4">
            <div class="thumbnail userImg">
                <i class="glyphicon glyphicon-remove"></i>
                <img id="user_image_preview" class="profileImg" src="profileImg/man.jpg" alt=""/>
            </div>
        </div>

        <form id="uploadForm" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="user_image">Upload Image File:</label>
                <input type="file" class="filestyle" data-icon="false" id="user_image" name="user_image">
                <small class="help-block"  style="display: block; color: red;"></small>
            </div>
        </form>
    </div>  

    <form id="u">
        <div class="form-group">
            <label for="about">About myself:</label>
            <textarea class="form-control" rows="5" id="about" name="about">
            </textarea>
        </div>

        <button type="submit" class="btn btn-default">Save</button>
    </form>

    <?php
    require_once 'includes/footer.php';
    ?>
