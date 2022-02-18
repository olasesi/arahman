<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
      
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div> -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="<?=GEN_WEBSITE.'/admin/dashboard.php';?>"><img src="assets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="<?=GEN_WEBSITE.'/admin/dashboard.php';?>"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <!-- <img class="img-xs rounded-circle " src="assets/images/faces/face15.jpg" alt="">
                  <span class="count bg-success"></span> -->
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal"><?= $_SESSION['admin_firstname'].' '.$_SESSION['admin_surname'] ?></h5>
                  <span><?= $_SESSION['admin_type']  ?></span>
                </div>
              </div>
              <div>
                        <?php
                        if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == OWNER){      // if not headmaster
                          echo '<a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                         
                          <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                            <a href="'.GEN_WEBSITE.'/admin/term-session.php" class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                  <i class="mdi mdi-settings text-primary"></i>
                                </div>
                              </div>
                              <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">School settings</p>
                              </div>
                            </a></div>';
                        }
                        ?>
              


                <!-- <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a> -->
                      
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="<?=GEN_WEBSITE.'/admin/dashboard.php';?>">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
         
          <?php
      //       if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == OWNER){
      //  echo   '<li class="nav-item menu-items">
      //       <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      //         <span class="menu-icon">
      //           <i class="mdi mdi-laptop"></i>
      //         </span>
      //         <span class="menu-title">Admins</span>
      //         <i class="menu-arrow"></i>
      //       </a>
      //       <div class="collapse" id="ui-basic">
      //         <ul class="nav flex-column sub-menu">
      //           <li class="nav-item"> <a class="nav-link" href="forms.php">Create admins</a></li>
      //           <li class="nav-item"> <a class="nav-link" href="show-admin.php">Show admins</a></li>
               
      //         </ul>
      //       </div>
      //     </li>';
      //       }
            ?>
          
          




          <?php
      //       if(isset($_SESSION['admin_active'])){
      //  echo   '<li class="nav-item menu-items">
      //       <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      //         <span class="menu-icon">
      //           <i class="mdi mdi-laptop"></i>
      //         </span>
      //         <span class="menu-title">Primary school</span>
      //         <i class="menu-arrow"></i>
      //       </a>
      //       <div class="collapse" id="ui-basic">
      //         <ul class="nav flex-column sub-menu">
      //           <li class="nav-item"> <a class="nav-link" href="forms.php">Students</a></li>
      //           <li class="nav-item"> <a class="nav-link" href="show-admin.php">School details</a></li>
               
      //         </ul>
      //       </div>
      //     </li>';
      //       }
            ?>
          

          <?php
      //       if(isset($_SESSION['admin_active'])){
      //  echo   '<li class="nav-item menu-items">
      //       <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
      //         <span class="menu-icon">
      //           <i class="mdi mdi-laptop"></i>
      //         </span>
      //         <span class="menu-title">Secondary school</span>
      //         <i class="menu-arrow"></i>
      //       </a>


            
      //       <div class="collapse" id="ui-basic2">
      //         <ul class="nav flex-column sub-menu">
      //           <li class="nav-item"> <a class="nav-link" href="forms.php">Students</a></li>
      //           <li class="nav-item"> <a class="nav-link" href="show-admin.php">School details</a></li>
               
      //         </ul>
      //       </div>
      //     </li>';
      //       }
            ?>
          







          <?php
            // if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == OWNER){
            //   echo  '<li class="nav-item menu-items">
            //     <a class="nav-link" href="term-session.php">
            //       <span class="menu-icon">
            //         <i class="mdi mdi-alarm"></i>
            //       </span>
            //       <span class="menu-title">Begin or end term</span>
            //     </a>
            //   </li>';
      
      
            // }
              
            ?>
<?php
 if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == OWNER){
       echo   '<li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-teachers" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Admins</span>
              <i class="menu-arrow"></i>
            </a>

 <div class="collapse" id="ui-teachers">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/show-admins.php">Show admins</a></li>
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/create-admins.php">Add admins</a></li>
              </ul>
            </div>
          </li>
           '; }       
          
?>





<?php
 if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == HEADMASTER){
       echo   '<li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basicsubjects" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Pri. Subjects</span>
              <i class="menu-arrow"></i>
            </a>


            <div class="collapse" id="ui-basicsubjects">
              <ul class="nav flex-column sub-menu">
                
              
         
              
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/add-subjects.php">Add new subjects</a>
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/link-subject-class.php">Give classes<br> to subjects</a></li>
                </li>
              </ul>
            </div>
          </li>   
              
  ';
 }       
          
?>


          
          
          <!-- <li class="nav-item menu-items">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Form Elements</span>
            </a>
          </li> -->
          
          
          
<!-- 
              <li class="nav-item menu-items">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
              <span class="menu-title">Subjects</span>
            </a>
          </li>
         
         
          <li class="nav-item menu-items">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="pages/icons/mdi.html">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Icons</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-security"></i>
              </span>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Documentation</span>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <!-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search students">
                </form>
              </li>
            </ul> -->
            <?php
 if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == ACCOUNTANT){
       echo   '<ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="POST" action="search-paid.php">
                  <input type="text" class="form-control" placeholder="Search student" name="">
                  <button type="submit" class="btn btn-success me-2" name="paid_students">Search</button>
                </form>
              </li>
            </ul>';
          }
          ?>
          <!-- <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
               
             

              <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown0" data-bs-toggle="dropdown" aria-expanded="false" href="#">Begin or end a session</a>
                
              
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown0">
                  <h6 class="p-3 mb-0 text-center">Are you sure you want to begin or end a session?<br> This process cannot be reversed when done</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-file-outline text-primary"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">-->











            
            
            
            
            
            
            <ul class="navbar-nav navbar-nav-right">
              
            <li class="nav-item dropdown d-none d-lg-block">
               
            <?php
            // if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == HEADMASTER){
            // echo '<a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" href="'.GEN_WEBSITE.'/admin/add-primary-teachers.php">Add Pri. teacher</a>
            // ';
            
            // }
            ?>
   <?php
            // if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == OWNER){
            // echo '<a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" href="#">Add admin</a>
            // ';
            
            // }
            ?>

             
              
             <!-- <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                  <h6 class="p-3 mb-0 text-center">Are you sure you want to begin or end your primary school term? This process cannot be reversed when done</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-file-outline text-primary"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
            
                     </div>
                  </a>
                  
                  
                  <div class="dropdown-divider"></div>
                  
                  
                  
                  <a class="dropdown-item preview-item ">
                   <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-web text-info"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1 ">This code should show current term</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-layers text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Software Testing</p>
                    </div>
                  </a>-->
                 <!-- <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all projects</p>
                </div>-->
              </li>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <li class="nav-item dropdown d-none d-lg-block">
             
              </li>
              <!-- <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-view-grid"></i>
                </a>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                      <p class="text-muted mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                      <p class="text-muted mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                      <p class="text-muted mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">4 new messages</p>
                </div>
              </li> -->
              <li class="nav-item dropdown border-left">
                <!-- <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Event today</p>
                      <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                      <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-link-variant text-warning"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Launch Admin</p>
                      <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div> -->
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                  <div class="navbar-profile">
                    <!-- <img class="img-xs rounded-circle" src="assets/images/faces/face15.jpg" alt=""> -->
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?= $_SESSION['admin_firstname'].' '.$_SESSION['admin_surname'] ?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>






                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <!-- <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a> -->
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="<?= GEN_WEBSITE.'/admin/logout.php';?>">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
                  <!-- <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">Advanced settings</p>
                </div> -->
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        
        
        
        
        
        
        
        
        
        
        