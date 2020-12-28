<?php 
    ob_start();
    session_start();
    if(isset($_SESSION['user']))
    {
        header("Location:user/index.php");
        die();
    }
?>
<?php 
    require ('CurrencyExchange.php');
    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $userlogin=new CurrencyExchange($email,$pass);
        $loginDetails=$userlogin->userLogin($email,$pass);
        if($loginDetails=="in")
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin:0!important">
            <strong>Incorrect Email or password</strong><br>Please check your credentials.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
        else if($loginDetails=="some")
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin:0!important">
            <strong>Something went wrong!!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }
        else
        {
            $getData=$loginDetails->fetch_assoc();
            $isverify=$getData['u_is_verify'];
            if($isverify==0)
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin:0!important">
                <strong>Email is not verified yet!!<br>Please first verify your email and try again.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
            else
            {
                $_SESSION['user']=$getData;
                header("Location:user/index.php");
                die();
            }
        }

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="assets/css/user-register.css?v=<?php echo time()?>" rel="stylesheet" type="text/css">

</head>
<body>
    <?php require_once 'partials/header.php'?>
        <div class='container my-4'>
            <form class="w-75" style="margin: 0 auto;" id="login" method="POST" action="">
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control">
                    <span id="email_error_msg" class="error_msg"></span>
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" name="pass" id="pass" placeholder="Enter Password" class="form-control">
                    <span id="password_error_msg" class="error_msg"></span>
                </div>
                <div class="form-group">
                    <input type="submit" name="login" id="loginBtn" value="Login" class="btn btn-success">
                </div>
            </form>
            <div class="text-center">
                <a href="reset.php">Forgot Password? Reset Here</a>
            </div>
        </div>
    <?php require_once 'partials/footer.php'?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function()
        {
            let email_error=false;
            let password_error=false;
            $('#email').focusout(function () { 
                checkEmail();
             })
            
            $('#pass').focusout(function()
            {
                checkPass();
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

            function checkPass()
            {
                let pattern=/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
                let pass=$('#pass').val();
                let passlenght=$('#pass').val().length;
                if(pattern.test(pass) && pass!='' && passlenght>=8)
                {
                    $('#password_error_msg').hide();
                    $('#pass').css("border-bottom","2px solid #34F458"); 
                }
                else
                {
                    $("#password_error_msg").html("<ul><li>Must be at least 8 characters</li><li>At least 1 number, 1 lowercase, 1 uppercase letter</li><li>At least 1 special character from @#$%&</li></ul>");
                    $('#password_error_msg').show();
                    $("#pass").css("border-bottom","2px solid #F90A0A");
                    password_error = true;
                }
            }

            $('#login').submit(function()
            {
                email_error=false;
                password_error=false;
                checkEmail();
                checkPass();
                if(email_error===false && password_error===false)
                {
                    return true;
                }
                else
                {
                    alert("All fields are required");
                    return false;
                }
            });
        });
    </script>
    <?php ob_flush();?>
</body>
</html>