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
                        </li>
                        
                     </ul>
                    
                  </div>
                  <!-- END PAGE BAR -->
                  
                  
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
   </body>
</html>