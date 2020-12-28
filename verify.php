<?php 
    require ('CurrencyExchange.php');
    if(isset($_GET['vkey']))
    {
        $key=$_GET['vkey'];
        $getVerify=new CurrencyExchange();
        $result=$getVerify->getVerifiedKey($key);
        if($result)
        {
            $update=$getVerify->updateVerification($key);
            if($update)
            {
                echo "<div style='text-align:center'>Your account verified Successfully!!! Login Now and upload documents to enjoy and features</div>";
            }
            else
            {
                echo "<div style='text-align:center'>Something went wrong</div>";
            }
        }
        else
        {
            echo "<div style='text-align:center'>email is already verified</div>";
        }
    }
    else
    {
        die("<div style='text-align:center'>Something Went wrong</div>");
    }

?>