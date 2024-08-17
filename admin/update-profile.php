<?php
   include('../common-files/db-connection.php');
   include('../common-files/master_function.php');
   if(!checklogin()){
      header("Location: index.php");
      exit();
   }


   
    $updateProfile = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = cleartext($_POST['name']);        
        $email = cleartext($_POST['email']);
        $username = cleartext($_POST['username']);
        $userid = cleartext($_SESSION['userid']);

        $stmt = $conn->prepare("SELECT COUNT(email) as countemail FROM `users` WHERE `email` = ? AND `userid` != ? ");        
        if ($stmt === false) {
            $updateProfile = 'wrong'; 
        }

        $stmt->bind_param("si", $email, $userid);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0 && $row['countemail'] == 0) {
        
                $stmt = $conn->prepare("UPDATE users SET full_name=?, email=?, username=?, updated_at=now() WHERE userid=?");
                $stmt->bind_param("sssi", $name, $email, $username, $userid);                
                
                if($stmt->execute()){
                    $_SESSION['full_name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['username'] = $username;
                    $updateProfile = 'updated'; 
                }else {
                    $updateProfile = 'wrong'; 
                }
                $stmt->close();
                $conn->close();
                
            }else {
               $updateProfile = 'email_exits'; 
            }
        }else {
            $updateProfile = 'wrong'; 
        }
        
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
   <!--<![endif]-->
   <!-- BEGIN HEAD -->
   <?php include('includes/header.php'); ?>
   <!-- END HEAD -->
   <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
      <div class="page-wrapper">
         <!-- BEGIN HEADER -->
         <?php include('includes/body_header.php'); ?>
         <!-- END HEADER -->

         <!-- BEGIN HEADER & CONTENT DIVIDER -->
         <div class="clearfix"> </div>
         <!-- END HEADER & CONTENT DIVIDER -->
         <!-- BEGIN CONTAINER -->
         <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <?php include('includes/menubar.php'); ?>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
               <!-- BEGIN CONTENT BODY -->
               <div class="page-content">
                  <!-- BEGIN PAGE HEADER-->
                  
                  <!-- BEGIN PAGE BAR -->
                  <div class="page-bar">
                     <ul class="page-breadcrumb">
                        <li>
                           <a href="dashborad.php">Dashborad</a>    
                           <i class="fa fa-circle"></i>
                        </li>
                        <li>
                           <span>My Profile</span>
                        </li>
                     </ul>
                  </div>
                  <!-- END PAGE BAR -->
                  

                   <!-- BEGIN PAGE TITLE-->
                  
                        <div class="row mt-15">
                            <div class="col-md-12">
                                <!-- BEGIN VALIDATION STATES-->
                                <div class="portlet light portlet-fit portlet-form bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bubble font-green"></i>
                                            <span class="caption-subject font-green bold uppercase">Update your profile</span>
                                        </div>
                                       
                                    </div>
                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                        <form action="update-profile.php" id="update-profile" method="post" class="form-horizontal">
                                            <div class="form-body">
                                            <?php 
                                                if($updateProfile){                                                     
                                                    if($updateProfile == 'updated'){
                                                        echo '<div class="alert alert-success" role="alert">Your profile has been succesfully updated</div>';
                                                    } elseif($updateProfile == 'email_exits' ){
                                                        echo '<div class="alert alert-warning" role="alert">Email already regsitered</div>';
                                                    } else {
                                                        echo '<div class="alert alert-danger" role="alert">Something goes to wrong.</div>';
                                                    }?>
                                                    
                                                    
                                                <?php  
                                            } ?>

                                                <div class="form-group  margin-top-20">
                                                    <label class="control-label col-md-3">Name
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="text" class="form-control" name="name" id="name"  value="<?= $_SESSION['full_name'] ?>"/> </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Email
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="text" class="form-control" name="email" id="email" value="<?= $_SESSION['email'] ?>"/> </div>
                                                    </div>
                                                </div>

                                                <div class="form-group  margin-top-20">
                                                    <label class="control-label col-md-3">Username
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="text" class="form-control" name="username" id="username" value="<?= $_SESSION['username'] ?>"/> </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn green">Submit</button>
                                                        <button type="button" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- END FORM-->
                                    </div>
                                </div>
                                <!-- END VALIDATION STATES-->
                            </div>
                        </div>
                        

               </div>
               <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

          
         </div>
         <!-- END CONTAINER -->
          
         <!-- BEGIN FOOTER -->
         <?php include('includes/body_footer.php'); ?> 
         <!-- END FOOTER -->
      </div>
      
      <div class="quick-nav-overlay"></div>
      <!-- END QUICK NAV -->
      <?php include('includes/footer.php'); ?> 
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
      <script src="assets/js/customejs/profile.js" type="text/javascript"></script>
   </body>
</html>