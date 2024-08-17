<?php
    $registerLog = false;
    if($_POST){
        include('../common-files/db-connection.php');
        include('../common-files/master_function.php');

        // Set parameters and execute
        $email = cleartext($_POST['email']);        

        $stmt = $conn->prepare("SELECT COUNT(email) as countemail FROM `users` WHERE `email` = ? ");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("s", $email);        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0 && $row['countemail'] == 0) {
               $stmt = $conn->prepare("INSERT INTO users (full_name, email, username, password, created_at, updated_at) VALUES (?, ?, ?, ?, now(), now())");
               $stmt->bind_param("ssss", $fullname, $email, $username, $password);
       
               // Set parameters and execute
               $fullname = cleartext($_POST['fullname']);        
               $username = cleartext($_POST['username']);
               $password = md5(cleartext($_POST['password'])); // Hash the password 
       
               if($stmt->execute()){
                   $registerLog = true;
               } 
            } else {
               die("email already");
            }
         }

       
        $stmt->close();
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
   <!--<![endif]-->
   <!-- BEGIN HEAD -->
   <head>
      <meta charset="utf-8" />
      <title>Metronic Admin Theme #1 | User Login 1</title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1" name="viewport" />
      <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
      <meta content="" name="author" />
      <!-- BEGIN GLOBAL MANDATORY STYLES -->
      <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
      <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
      <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
      <!-- END GLOBAL MANDATORY STYLES -->
      <!-- BEGIN PAGE LEVEL PLUGINS -->
      <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
      <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!-- END PAGE LEVEL PLUGINS -->
      <!-- BEGIN THEME GLOBAL STYLES -->
      <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
      <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
      <!-- END THEME GLOBAL STYLES -->
      <!-- BEGIN PAGE LEVEL STYLES -->
      <link href="assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />
      <!-- END PAGE LEVEL STYLES -->
      <!-- BEGIN THEME LAYOUT STYLES -->
      <!-- END THEME LAYOUT STYLES -->
      <link rel="shortcut icon" href="favicon.ico" />
   </head>
   <!-- END HEAD -->
   <body class=" login">
      <!-- BEGIN LOGO -->
      <div class="logo">
         <a href="index.php">
         <img src="assets/pages/img/logo-big.png" alt="" /> </a>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN LOGIN -->
      <div class="content">
         <!-- BEGIN REGISTRATION FORM -->
         <form class="" action="register.php" method="post" id="register-form">
            <h3 class="font-green">Sign Up</h3>
            <?php 
                if($registerLog){ ?>
                    
                    <div class="alert alert-success" role="alert">Succesfuuly registerd</div>
                <?php  } ?>
            <p class="hint"> Enter your personal details below: </p>
            <div class="form-group">
               <label class="control-label visible-ie8 visible-ie9">Full Name</label>
               <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" id="fullname" name="fullname" /> 
            </div>
            <div class="form-group">
               <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
               <label class="control-label visible-ie8 visible-ie9">Email</label>
               <input class="form-control placeholder-no-fix" type="text" placeholder="Email" id="email" name="email" /> 
            </div>
            <p class="hint"> Enter your account details below: </p>
            <div class="form-group">
               <label class="control-label visible-ie8 visible-ie9">Username</label>
               <input class="form-control placeholder-no-fix" type="text" autocomplete="off" id="username" placeholder="Username" name="username" /> 
            </div>
            <div class="form-group">
               <label class="control-label visible-ie8 visible-ie9">Password</label>
               <input class="form-control placeholder-no-fix" type="password" autocomplete="off"  id="password" placeholder="Password" name="password" /> 
            </div>
            <div class="form-group">
               <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
               <input class="form-control placeholder-no-fix" type="password" autocomplete="off"  id="rpassword" placeholder="Re-type Your Password" name="rpassword" /> 
            </div>
            <div class="form-actions">
               <a  href="index.php" id="register-back-btn" class="btn green btn-outline">Back to login</a>
               <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
            </div>
         </form>
         <!-- END REGISTRATION FORM -->
      </div>
      <div class="copyright"> 2014 © Metronic. Admin Dashboard Template. </div>
      <!--[if lt IE 9]>
      <script src="assets/global/plugins/respond.min.js"></script>
      <script src="assets/global/plugins/excanvas.min.js"></script> 
      <script src="assets/global/plugins/ie8.fix.min.js"></script> 
      <![endif]-->
      <!-- BEGIN CORE PLUGINS -->
      <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
      <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
      <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
      <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
      <!-- END CORE PLUGINS -->
      <!-- BEGIN PAGE LEVEL PLUGINS -->
      <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
      <script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
      <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
      <!-- END PAGE LEVEL PLUGINS -->
      <!-- BEGIN THEME GLOBAL SCRIPTS -->
      <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
      <!-- END THEME GLOBAL SCRIPTS -->
      <!-- BEGIN PAGE LEVEL SCRIPTS -->
      <!-- <script src="assets/pages/scripts/login.min.js" type="text/javascript"></script> -->
      <!-- END PAGE LEVEL SCRIPTS -->
      <!-- BEGIN THEME LAYOUT SCRIPTS -->
      <!-- END THEME LAYOUT SCRIPTS -->
      <script src="assets/js/customejs/register.js" type="text/javascript"></script>
   </body>
</html>