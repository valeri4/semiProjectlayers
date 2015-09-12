
$(document).ready(function () {
    
    $('#postModal').modal({show:true});

    //Sign Up Collaps in login.php
    $("#signUpFormCollaps").click(function () {
        $(".collapse").collapse('toggle');
    });

    $("#collapsePwd").click(function () {
        $("#collapse1").collapse('toggle');
    });

    $('#datePicker')
            .datepicker({
                format: 'dd/mm/yyyy'
            })
            .on('changeDate', function (e) {
                // Revalidate the date field
                $('#eventForm').formValidation('revalidateField', 'date');
            });


});