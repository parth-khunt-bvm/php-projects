<?php

//  session_start();
include('../common-files/master_function.php');
    session_unset();

   
    if(!checklogin()){     
        header("Location: index.php");
        exit();
     } else {
        header("Location: dashborad.php");
        exit();
     }
?>