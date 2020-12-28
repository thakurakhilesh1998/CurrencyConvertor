<?php
    ob_start();
    if(!isset($_GET['token']))
    {
        die("something went wrong");
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="assets/css/user-register.css?v=<?php echo time()?>" rel="stylesheet" type="text/css">
</head>
<body>
    <?php require('partials/header.php');?>
    <?php 
        if(isset($_POST['reset']))
        {
            $token=$_GET['token'];
            require ('utils.php');
            $getToken=new Utils();
            $getEmail=$getToken->encrypt_decrypt("decrypt",$token);
            $pass1=$_POST['pass1'];
            $pass2=$_POST['pass2'];
            if($pass1==$pass2)
            {
                require ('CurrencyExchange.php');
                $updatep=new CurrencyExchange();
                $result=$updatep->resetPassword($pass2,$getEmail);
                if($result)
                {
                    echo '<div class="alert alert-success w-50 my-3" style="margin:0 auto" role="alert">Password Changed Successfully.!!<a href="user_login.php">Login Here</div>';
                }
                else
                {
                    echo '<div class="alert alert-danger w-50 my-3" role="alert" style="margin:0 auto">Something went wrong</div>';
                }
            }
            else
            {
                echo '<div class="alert alert-danger w-50 my-3" role="alert" style="margin:0 auto">Password Not Matched</div>';
            }

        }
    ?>
    <div class="container my-4">
        <form class="w-50" style="margin: 0 auto;" method="POST" action="" id="resetlink">
            <div class="form-group">
                <label for="pass1">New Password</label>
                <input type="password" name="pass1" id="pass1" class="form-control" placeholder="New Password">
                <span class="password_error_msg1 error_msg"></span>
            </div>
            <div class="form-group">
                <label for="pass2">Confirm Password</label>
                <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Confirm Password">
                <span class="password_error_msg2 error_msg"></span>
            </div>
            <span id="password_mismatch" class="error_msg"></span>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Reset Password" name="reset">
            </div>
        </form>
    </div>
    <?php require_once 'partials/footer.php'?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function()
        {
            let pass1=false;
            let pass2=false;
            $('#pass1').focusout(function()
            {
                checkPass1();
            });
            $('#pass2').focusout(function()
            {
                checkPass2();
            });

            function checkPass1()
            {
                let pattern=/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
                let pass=$('#pass1').val();
                let passlenght=$('#pass1').val().length;
                if(pattern.test(pass) && pass!='' && passlenght>=8)
                {
                    $('.password_error_msg1').hide();
                    $('#pass1').css("border-bottom","2px solid #34F458"); 
                }
                else
                {
                    $(".password_error_msg1").html("<ul><li>Must be at least 8 characters</li><li>At least 1 number, 1 lowercase, 1 uppercase letter</li><li>At least 1 special character from @#$%&</li></ul>");
                    $('.password_error_msg1').show();
                    $("#pass1").css("border-bottom","2px solid #F90A0A");
                    pass1=true;   
                }
            }

            
            function checkPass2()
            {
                let pattern=/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
                let pass=$('#pass2').val();
                let passlenght=$('#pass2').val().length;
                if(pattern.test(pass) && pass!='' && passlenght>=8)
                {
                    $('.password_error_msg2').hide();
                    $('#pass2').css("border-bottom","2px solid #34F458"); 
                }
                else
                {
                    $(".password_error_msg2").html("<ul><li>Must be at least 8 characters</li><li>At least 1 number, 1 lowercase, 1 uppercase letter</li><li>At least 1 special character from @#$%&</li></ul>");
                    $('.password_error_msg2').show();
                    $("#pass2").css("border-bottom","2px solid #F90A0A");
                    pass2=true;       
                }
            }

            $('#resetlink').submit(function()
            {
                pass1=false;
                pass2=false;
                if($('#pass1').val()===$('#pass2').val())
                {
                    checkPass1();
                    checkPass2();
                    if(pass1==false && pass2==false)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    $('#password_mismatch').html('<div class="alert alert-danger" role="alert">Password Not Matched</div>');
                    return false;
                }
            });
        });
    </script>
</body>
</html>