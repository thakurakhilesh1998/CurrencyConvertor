<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/user-register.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/intlTelInput.css?v=<?php echo time()?>">

</head>

<body>
    <?php require_once '../partials/header.php' ?>
    <?php
    if (!isset($_SESSION['user'])) {
        header("Location:../user_login.php");
    }
    ?>
    <div class="container">
        <!-- Tabs navs -->
        <ul class="nav nav-tabs nav-fill mt-5 mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="true">View / Edit Profile</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Upload / Update Documents</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls="ex1-tabs-3" aria-selected="true">View Status</a>
            </li>
        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex1-content">
            <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                <?php require_once('../partials/viewprofile.php');?>
                
            </div>
            <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                <?php require_once('../partials/uploaddoc.php');?>
            </div>
            <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                <?php require_once('../partials/userstatus.php');?>
            </div>
        </div>
        <!-- Tabs content -->
    </div>
    <?php require_once '../partials/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ex1-tab-1').click(function() {
                $('#ex1-tab-1').addClass("active");
                $('#ex1-tab-2').removeClass("active");
                $('#ex1-tab-3').removeClass("active");
                $('#ex1-tabs-1').addClass("show active");
                $('#ex1-tabs-2').removeClass("show active");
                $('#ex1-tabs-3').removeClass("show active");


            });
            $('#ex1-tab-2').click(function() {
                $('#ex1-tab-2').addClass("active");
                $('#ex1-tab-1').removeClass("active");
                $('#ex1-tab-3').removeClass("active");
                $('#ex1-tabs-2').addClass("show active");
                $('#ex1-tabs-1').removeClass("show active");
                $('#ex1-tabs-3').removeClass("show active");
            });
            $('#ex1-tab-3').click(function() {
                $('#ex1-tab-3').addClass("active");
                $('#ex1-tab-2').removeClass("active");
                $('#ex1-tab-1').removeClass("active");
                $('#ex1-tabs-3').addClass("show active");
                $('#ex1-tabs-1').removeClass("show active");
                $('#ex1-tabs-2').removeClass("show active");
            });
        });
    </script>
</body>

</html>