<?php 
    $userid=$_SESSION['user']['u_id'];
    $getUserStatus=new CurrencyExchange();
    $userdata=$getUserStatus->getUserById($userid);

    $user_status=$userdata['u_status'];
    $user_msg=$userdata['u_msg'];
?>
<?php 
    if($user_status):
?>
<div class="alert alert-success">
    User is Verified. Now add currency and buy currency.
</div>
<?php else:?>
<div class="alert alert-danger">
    User status is not verified. It is pending at the admin level. Please wait for approval form Admin.
</div>
<?php endif;?>
<div class=" alert alert-secondary">
    Message from Admin<br>
    <?php echo $user_msg;?>
</div>