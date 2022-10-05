<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SCHOOL PORTAL</title>
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
    <link rel="stylesheet" href="assets/vendors/css/custom.css">
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
          <a class="sidebar-brand brand-logo" href="<?=GEN_WEBSITE.'/admin/dashboard.php';?>"  style="color:white; text-decoration:none;"><h3 class="mb-0">PORTAL</h3><!--<img src="assets/images/logo.svg" alt="logo" />--></a>
          <a class="sidebar-brand brand-logo-mini" href="<?=GEN_WEBSITE.'/admin/dashboard.php';?>"  style="color:white;  text-decoration:none;"><!--<img src="assets/images/logo-mini.svg" alt="logo" />--><h3 class="mb-0">PORTAL</h3></a>
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
                <?php  $taking_session = mysqli_query ($connect,"SELECT school_session, choose_term FROM term_start_end ORDER BY term_start_end_id DESC  LIMIT 1") or die(mysqli_error($connect));
           if(mysqli_num_rows($taking_session) == 1){
           while($rows = mysqli_fetch_array($taking_session)){
            $the_term=$rows['choose_term'];
            $the_session=$rows['school_session'];
              echo '<br><br>';
              echo '<div class="badge badge-outline-warning">'.$the_term.'</div>'; 
              echo '<br><br>';
              echo '<div class="badge badge-outline-success">'.$the_session.'</div>';
             
            }
            
          }else{
            $the_term = 0;
            $the_session = 0;
          }
  ?>
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
                        <?php
                        if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == ACCOUNTANT){      // if not headmaster
                          echo '<a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                         
                          <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                            <a href="'.GEN_WEBSITE.'/admin/bill-setting.php" class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                  <i class="mdi mdi-settings text-primary"></i>
                                </div>
                              </div>
                              <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">School bill settings</p>
                              </div>
                            </a></div>';
                        }
                        ?>
              

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
 if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == OWNER){
       echo   '<li class="nav-item menu-items">
       <a class="nav-link" data-bs-toggle="collapse" href="#recent-payments" aria-expanded="false" aria-controls="ui-basic">
         <span class="menu-icon">
           <i class="mdi mdi-laptop"></i>
         </span>
         <span class="menu-title">Recent Payment</span>
         <i class="menu-arrow"></i>
       </a>

       <div class="collapse" id="recent-payments">
         <ul class="nav flex-column sub-menu">
         <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/primary-school-payment.php">Primary School</a></li>
         <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/secondary-school-payment.php">Secondary School</a></li>
           
         </ul>
       </div>
     </li>
       <li class="nav-item menu-items">
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
                
              </ul>
            </div>
          </li>
           
          <li class="nav-item menu-items">
          <a class="nav-link" data-bs-toggle="collapse" href="#recent-payments_common" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-laptop"></i>
            </span>
            <span class="menu-title">Common Entrance</span>
            <i class="menu-arrow"></i>
          </a>

          <div class="collapse" id="recent-payments_common">
            <ul class="nav flex-column sub-menu">
           
            <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/common-entrance-list.php">Entrance paid list</a></li>
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/entrance-fee.php">Entrance amount</a></li>
              
            </ul>
          </div>
        </li>
          
          
          
          
          '; 
          
          
          
          }       
          
?>
<?php
 if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == ACCOUNTANT){
       echo   '<li class="nav-item menu-items">
              <a class="nav-link" data-bs-toggle="collapse" href="#recent-payments" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                  <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Recent Payment</span>
                <i class="menu-arrow"></i>
              </a>

              <div class="collapse" id="recent-payments">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/primary-school-payment.php">Primary School</a></li>
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/secondary-school-payment.php">Secondary School</a></li>
                  
                </ul>
              </div>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" data-bs-toggle="collapse" href="#modules" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                  <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Module</span>
                <i class="menu-arrow"></i>
              </a>

              <div class="collapse" id="modules">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/new-module.php">Add New Module</a></li>
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/modules.php">Module Setup</a></li>
               

               
                </ul>
              </div>
            </li> 
            
            
            <li class="nav-item menu-items">
              <a class="nav-link" data-bs-toggle="collapse" href="#recent-payments_common" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                  <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Common Entrance</span>
                <i class="menu-arrow"></i>
              </a>

              <div class="collapse" id="recent-payments_common">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/common-entrance-list.php">Entrance paid list</a></li>
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/entrance-fee.php">Entrance amount</a></li>
                  
                </ul>
              </div>
            </li>
            
            '; 
          }       
          
?>




<?php
 if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == ADMISSION){
  
  echo   '<li class="nav-item menu-items">
              <a class="nav-link" data-bs-toggle="collapse" href="#register-payments" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                  <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Registered students</span>
                <i class="menu-arrow"></i>
              </a>

              <div class="collapse" id="register-payments">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/pri-registered.php">Primary schools</a></li>
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/sec-registered.php">Secondary schools</a></li>
                  
                </ul>
              </div>
            </li>
           
            
           
            
            ';

          
            echo   '<li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basicclasses" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Classes</span>
              <i class="menu-arrow"></i>
            </a>
          
          
            <div class="collapse" id="ui-basicclasses">
              <ul class="nav flex-column sub-menu">
                
              
          
              
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/add-classes.php">Add new classes</a>
               
                </li>
              </ul>
            </div>
          </li>   
              
          ';
          
          
          





$query_term_start = mysqli_query($connect, "SELECT term_start, term_end, choose_term FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
  while($term_rows = mysqli_fetch_array($query_term_start)){
    $start_var = $term_rows['term_start'];
    $end_var = $term_rows['term_end'];
    $choose_term_var = $term_rows['choose_term'];

  }
  if(!empty($start_var) && !empty($end_var) && $choose_term_var == 'Third term'){   
    
    echo   '<li class="nav-item menu-items">
    <a class="nav-link" data-bs-toggle="collapse" href="#promote-students" aria-expanded="false" aria-controls="ui-basic">
      <span class="menu-icon">
        <i class="mdi mdi-laptop"></i>
      </span>
      <span class="menu-title">Promote students</span>
      <i class="menu-arrow"></i>
    </a>

    <div class="collapse" id="promote-students">
      <ul class="nav flex-column sub-menu">
      <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/pri-promote.php">Primary schools</a></li>
      <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/sec-promote.php">Secondary schools</a></li>
        
      </ul>
    </div>
  </li>
 
  
 
  
  ';
  
 
          }       
        }
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


  echo   '<li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basicteacher" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Pri. Teachers</span>
              <i class="menu-arrow"></i>
            </a>


            <div class="collapse" id="ui-basicteacher">
              <ul class="nav flex-column sub-menu">
                
              
         
              
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/add-teacher.php">Add new teacher</a>
                </li>
              </ul>
            </div>
          </li>   
              
  ';


 }       
          
?>


          
<?php
 if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == PRINCIPAL){
       echo   '<li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basicsubjects" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Sec. Subjects</span>
              <i class="menu-arrow"></i>
            </a>


            <div class="collapse" id="ui-basicsubjects">
              <ul class="nav flex-column sub-menu">
                
              
         
              
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/sec-add-subjects.php">Add new subjects</a>
                <li class="nav-item"><a class="nav-link" href="'.GEN_WEBSITE.'/admin/sec-link-subject-class.php">Give classes<br> to subjects</a></li>
                </li>
              </ul>
            </div>
          </li>   
              
  ';
 }       
          
?>

        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="<?=GEN_WEBSITE.'/admin/dashboard.php';?>"><h1 style="color:white;">P</h1></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
           
            <?php
 if((isset($_SESSION['admin_active'])) AND ($_SESSION['admin_type'] == ACCOUNTANT OR $_SESSION['admin_type'] == OWNER)){
       echo   '<ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="GET" action="search-paid.php">
                  <input type="text" class="form-control" placeholder="Paid student (primary)" name="search-paid" value="';
                  if(isset($_GET['search-paid'])){echo $_GET['search-paid'];}
                  echo '">
                  
                  <button type="submit" class="btn btn-success me-2" name="button-paid_students">Search</button>  
                   </form>
              </li>
            </ul>';

echo
'<ul class="navbar-nav w-100">
<li class="nav-item w-100">
  <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search method="GET" action="sec-search-paid.php"">
    <input type="text" class="form-control" placeholder="Paid students (secondary)" name="search-paid-sec" value="';
    if(isset($_GET['search-paid-sec'])){echo $_GET['search-paid-sec'];}
    echo '">
    
    <button type="submit" class="btn btn-danger me-2" name="button-paid_students-sec">Search</button>  
    </form>
</li>
</ul>';

          }
          
          ?>
           <?php
 if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == ADMISSION){
       echo   '<ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="GET" action="search-registered.php">
                  <input type="text" class="form-control" placeholder="Registered students (Primary)" name="search-registered" value="';if(isset($_GET['search-registered'])){echo $_GET['search-registered'];}
                  echo'">
                  <button type="submit" class="btn btn-success me-2" name="button-search-registered">Search</button>
                </form>
              </li>
            </ul>';

            echo   '<ul class="navbar-nav w-100">
            <li class="nav-item w-100">
              <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="GET" action="sec-search-registered.php">
                <input type="text" class="form-control" placeholder="Registered students (Secondary)" name="search-registered-sec" value="';if(isset($_GET['search-registered-sec'])){echo $_GET['search-registered-sec'];}
                echo'">
                <button type="submit" class="btn btn-danger me-2" name="button-search-registered-sec">Search</button>
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
        
        
        
        
        
        
        
        
        
        
        