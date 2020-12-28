<?php 
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="assets/css/user-register.css?v=<?php echo time()?>" rel="stylesheet" type="text/css">
</head>
<body>
    <?php require('partials/header.php');?>
    <div class="container">
        <form id="reset" class="w-50 my-4" style="margin: 0 auto;" method="POST" action="">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                <span id="email_error_msg" class="error_msg"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" id="resetp" value="Send Password Reset Link" name="resetpass">
            </div>
        </form>
        <?php 
        if(isset($_POST['resetpass']))
        {
            $email=$_POST['email'];
            require ('CurrencyExchange.php');
            $reset=new CurrencyExchange();
            $getReset=$reset->getEmail($email);
            if($getReset)
            {
                require ('utils.php');
                $getToken=new Utils();
                $token=$getToken->encrypt_decrypt("encrypt",$email);
                $to=$email;
                $subject="Reset Password";
                $message="Hi,$email<br>Click on the link below to reset your password.<a href='http://localhost/Currency Exchange/resetemail.php?token=$token'>http://localhost/Currency Exchange/resetemail.php?token=$token</a>";
                $headers="From:thakurakhilesh20@gmail.com \r\n";
                $headers.="MIME-Version:1.0"."\r\n";
                $headers.="Content-type:text/html;charset-UTF-8"."\r\n";
                mail($to,$subject,$message,$headers);
                echo '<div class="alert alert-success w-50" style="margin:0 auto" role="alert">Password Reset Link Sent to your email!</div>';
            }
            else
            {
                echo '<div class="alert alert-danger w-50" style="margin:0 auto" role="alert">Please Check Your email! This email does not exists</div>';
            }
        }
    ?>
    </div>
    
    <?php require_once 'partials/footer.php'?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function()
        {
            let email_error=false;
            $('#email').focusout(function () { 
                checkEmail();
             });

            function checkEmail()
            {
                let pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                let email=$('#email').val();
                if(pattern.test(email) && email!='')
                {
                    $('#email_error_msg').hide();
                    $('#email').css("border-bottom","2px solid #34F458"); 
                }
                else
                {
                    $("#email_error_msg").html("Email pattern does not match!");
                    $('#email_error_msg').show();
                    $("#email").css("border-bottom","2px solid #F90A0A");
                    email_error = true;
                }
            }

            $('#reset').submit(function()
            {
                email_error=false;
                checkEmail();
                if(email_error===false)
                {
                    return true;
                }
                else
                {
                    alert("email is required");
                    return false;
                }
            });

        });
    </script>
    <?php ob_flush();?>
</body>
</html>