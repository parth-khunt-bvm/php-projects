<?php
   include('../common-files/master_function.php');
   if(checklogin()){
      header("Location: dashborad.php");
      exit();
   }
    $loginLog = true;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         
         
        include('../common-files/db-connection.php');        

        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // Set parameters and execute
        $email = cleartext($_POST['email']);
        $password = md5(cleartext($_POST['password'])); // Hash the password        

        $stmt->bind_param("ss", $email, $password);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
               $row = $result->fetch_assoc();
               $_SESSION["sessionid"] = "phpproject";
               $_SESSION["userid"] = $row['userid'];
               $_SESSION["full_name"] = $row['full_name'];
               $_SESSION["email"] = $row['email'];
               $_SESSION["username"] = $row['username'];
               if(isset($_POST['remember']) && $_POST['remember'] == 1){
                  setcookie('email', cleartext($_POST['email']), time() + (86400 * 30));
                  setcookie('password', cleartext($_POST['password']), time() + (86400 * 30));
               } else {
                  setcookie("email", "", time() - 3600);
                  setcookie("password", "", time() - 3600);
               }
               
               header("Location: dashborad.php");
               exit();
            } else {
                // User not found
                $loginLog = false;
            }
        } else {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
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
         <a href="index.html">
         <img src="assets/pages/img/logo-big.png" alt="" /> </a>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN LOGIN -->
      <div class="content">
         <!-- BEGIN LOGIN FORM -->
         <form class="login-form" action="index.php" method="post" id="login-form">
            <h3 class="form-title font-green">Sign In</h3>

            <?php 
                if(!$loginLog){ ?>
                  <div class="alert alert-danger">
                     <button class="close" data-close="alert"></button>
                     <span> Enter any username and password. </span>
                  </div>
            <?php  } ?>
            
            <div class="form-group">
               <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
               <label class="control-label visible-ie8 visible-ie9">E-mail</label>
               <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="E-mail" id="email" name="email" value="<?= isset($_COOKIE['email']) && $_COOKIE['email'] != null ? $_COOKIE['email'] : '' ?>"/> 
            </div>
            <div class="form-group">
               <label class="control-label visible-ie8 visible-ie9">Password</label>
               <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" id="password" placeholder="Password" name="password" value="<?= isset($_COOKIE['password']) && $_COOKIE['password'] != null ? $_COOKIE['password'] : '' ?>"/> 
            </div>
            <div class="form-actions">
               <button type="submit" id="login-btn" class="btn green uppercase">Login</button>
               <label class="rememberme check mt-checkbox mt-checkbox-outline">
               <input type="checkbox" name="remember" value="1" <?= (isset($_COOKIE['email']) && $_COOKIE['email'] != null) || (isset($_COOKIE['password']) && $_COOKIE['password'] != null)? 'checked="checked"' : '' ?>/>Remember
               <span></span>
               </label>               
            </div>
            
            <div class="create-account">
                    <p>
                        <a href="register.php" id="register-btn" class="uppercase">Create an account</a>
                    </p>
                </div>
         </form>
         <!-- END LOGIN FORM -->
         
       
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
      <script src="assets/js/customejs/login.js" type="text/javascript"></script>
   </body>
</html>