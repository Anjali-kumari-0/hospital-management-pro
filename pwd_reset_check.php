<?php
   
    // Set timezone
    date_default_timezone_set('Asia/Kolkata');
    $today=date("Y-m-d");

    $diff=abs(round((strtotime($today)-strtotime($_SESSION["pwdDate"]))/86400));
    echo "<div class='alert alert-info'>Your Password is ".$diff." day(s) old.</div>";
    if($diff>30){
        echo"<div class='alert alert-danger'>Security Hint : <a href='changePassword.php'>Change Password</a></div>";
    }
?>