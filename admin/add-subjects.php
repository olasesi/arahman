<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header("Location:/".GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != HEADMASTER){
	header("Location:/".GEN_WEBSITE.'/dashboard.php');
	exit();
}

?>




<?php

if (!isset($errors)){$errors = array();}

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){
	 
    if (preg_match ('/^[a-zA-Z ]{3,30}$/i', trim($_POST['subjectname']))) {		//only 30 characters are allowed to be inputted has subject name
		$subjectname = mysqli_real_escape_string ($connect, trim($_POST['subjectname']));
	} else {
		$errors['subjectname'] = 'Please enter valid subject name';
	} 
	 
   
if (empty($errors)){
        $query = mysqli_query($connect, "SELECT primary_subjects_id FROM primary_subjects WHERE primary_subjects_name='".$subjectname."'") or die(db_conn_error);
        if(mysqli_num_rows($query)== 0){

            mysqli_query($connect, "INSERT INTO primary_subjects (primary_subjects_name) VALUES ('".$subjectname."')") or die(db_conn_error);
            $done = $subjectname;
            $_POST = array();		

        }else{
            $errors['subject_used'] = 'Subject has already been added';

        }	
	




 }
 
}	

 
?>
 <?php require_once ('../../incs-arahman/dashboard.php');?>  
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                      <div class="col-4 col-sm-3 col-xl-2">
                        <img src="assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                      </div>
                      <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Want even more features?</h4>
                        <p class="mb-0 font-weight-normal d-none d-sm-block">Check out our Pro version with 5 unique layouts!</p>
                      </div>
                      <div class="col-3 col-sm-2 col-xl-2 ps-0 text-center">
                        <span>
                          <a href="https://www.bootstrapdash.com/product/corona-admin-template/" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Upgrade to PRO</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

 <?php         
    if(isset($done)){
           
        echo '<div class="row">

<div class="col-12 grid-margin stretch-card">
   <div class="card">
     <div class="card-body">
       <h4 class="card-title">'.$done.' has been added</h4>
     

          
              
                    </form>
                  </div>
                </div>
              </div>

            </div>';
}
          
            ?>
          

<div class="row">
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Subjects taught in Primary school</h4>
                   <?php 
                   
                   $querysubject = mysqli_query($connect, "SELECT DISTINCT primary_subjects_name FROM primary_subjects ORDER BY primary_subjects_timestamp DESC ") or die(db_conn_error);
                   ?>
                    <div class="template-demo">
                     <?php
                     if(mysqli_num_rows($querysubject) == 0){
echo '<h2 class="text-center">No subject has been added yet</h2>';

                     }else{
while($rows = mysqli_fetch_array($querysubject)){
   echo '<button type="button" class="btn btn-info btn-fw disabled">'.$rows['primary_subjects_name'].'</button>';
}
                     }
                     ?>
                     
                     
                    </div>
                  </div>
                 
                </div>
              </div>
</div>













            <div class="row">

             <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Primary school subject</h4>
                    <p class="card-description"></p>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <form class="forms-sample" method="POST" action="">
                      <div class="form-group">
                        <label for="exampleInputName1">Subject name</label>
                        <?php if (array_key_exists('subjectname', $errors)) {
				echo '<p class="text-danger">'.$errors['subjectname'].'</p>';}?>
                 <?php if (array_key_exists('subject_used', $errors)) {
				echo '<p class="text-danger">'.$errors['subject_used'].'</p>';}?>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Subject name" value="<?php if(isset($_POST['subjectname'])){echo $_POST['subjectname'];}?>" name="subjectname">
                      </div>
                      
                  <button type="submit" class="btn btn-primary me-2" name="submit">Submit</button>
                     
                    </form>
                  </div>
                </div>
              </div>

            </div>

           <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>



















      