<?php
   include('../common-files/master_function.php');
   if(!checklogin()){
      header("Location: index.php");
      exit();
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
                        <a href="update-profile.php">My Profile</a> 
                           <i class="fa fa-circle"></i>
                        </li>

                        <li>
                        <a href="change-password.php">Manage Password</a> 
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
                                            <span class="caption-subject font-green bold uppercase">Manage Password</span>
                                        </div>
                                       
                                    </div>
                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                        <form action="change-password.php" id="changePass" method="post" class="form-horizontal">
                                            <div class="form-body">
                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                <div class="alert alert-success display-hide">
                                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                                                <div class="form-group  margin-top-20">
                                                    <label class="control-label col-md-3">Current Password
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i> 
                                                            <input type="password" class="form-control" name="oldPass" id="oldPass"  /> </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">New Password
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="password" class="form-control" name="newPass" id="newPass"/> </div>
                                                    </div>
                                                </div>

                                                <div class="form-group  margin-top-20">
                                                    <label class="control-label col-md-3">Old Password
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="password" class="form-control" name="conPass" id="conPass"/> </div>
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
      <script src="assets/js/customejs/changePass.js" type="text/javascript"></script>
   </body>
</html>