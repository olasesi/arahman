<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header("Location:".GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != ADMISSION){
  header("Location:".GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}

?>




<?php

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){
	 
    if (preg_match ('/^[a-zA-Z ]{3,30}$/i', trim($_POST['subjectname']))) {		//only 30 characters are allowed to be inputted has subject name
		$subjectname = mysqli_real_escape_string ($connect, trim($_POST['subjectname']));
	} else {
		$errors['subjectname'] = 'Please enter valid class name';
	} 

      
if (empty($errors)){
      $query = mysqli_query($connect, "SELECT primary_class_id FROM primary_school_classes WHERE primary_class='".$subjectname."'") or die(db_conn_error);
      if(mysqli_num_rows($query)== 0){

          mysqli_query($connect, "INSERT INTO primary_school_classes (primary_class) VALUES ('".$subjectname."')") or die(db_conn_error);
         $done = $subjectname;
          $_POST = array();		



      }else{
          $errors['subject_used'] = 'Class name has already been added';

      }	
 }
 
}	








$errorsedit = array();
if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submitedit'])) {

  if (preg_match ('/^[a-zA-Z ]{3,30}$/i', trim($_POST['subjectnameedit']))) {		
		$subjectnameedit = mysqli_real_escape_string ($connect, trim($_POST['subjectnameedit']));
	} else {
		$errorsedit['subjectnameedit'] = 'Please enter valid class name';
	} 

  $clean_hidden = mysqli_real_escape_string ($connect, trim($_POST['hidden']));
     
if (empty($errorsedit)){
      $query = mysqli_query($connect, "SELECT primary_class_id FROM primary_school_classes WHERE primary_class='".$subjectnameedit."'") or die(db_conn_error);
      if(mysqli_num_rows($query)== 0){

        mysqli_query($connect, "UPDATE primary_school_classes SET primary_class = '".$subjectnameedit."' WHERE primary_class_id='".$clean_hidden."'") or die(db_conn_error);	
	
        $status = 1;
          $_POST = array();		



      }elseif(mysqli_num_rows($query)== 1){
        $errorsedit['alreadyused'] = 'Class name has already been used';

      }
 }
 

 
  






}

 
?>
 <?php require_once ('../../incs-arahman/dashboard.php');?>  
      
        <div class="main-panel">
          <div class="content-wrapper">
      

 <?php         
    if(isset($done)){
           
        echo '<div class="row">

<div class="col-12 grid-margin stretch-card">
   <div class="card">
     <div class="card-body">
       <h4 class="card-title text-success">'.$done.' has been added</h4>
              
                    </form>
                  </div>
                </div>
              </div>

            </div>';
}
            ?>
          
          <?php  
             
    if( array_key_exists('subjectnameedit', $errorsedit)  ){
           
        echo '<div class="row">

<div class="col-12 grid-margin stretch-card">
   <div class="card">
     <div class="card-body">
       <h4 class="card-title text-danger">	'.$errorsedit['subjectnameedit'].' </h4>
              
                    </form>
                  </div>
                </div>
              </div>

            </div>';
}
            ?>


<?php  
             
             if( array_key_exists('alreadyused', $errorsedit)  ){
                    
                 echo '<div class="row">
         
         <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-danger"> '.$errorsedit['alreadyused'].' </h4>
                       
                             </form>
                           </div>
                         </div>
                       </div>
         
                     </div>';
         }
                     ?>
         
         <?php  
             
             if(isset($status) AND $status == 1){
                    
                 echo '<div class="row">
         
         <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-success"> Class name successfully changed</h4>
                       
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
                    <h4 class="card-title">Classes In Primary school</h4>
                   <?php 
                   
                   $querysubject = mysqli_query($connect, "SELECT  primary_class, primary_class_id FROM primary_school_classes ORDER BY primary_class_id DESC ") or die(db_conn_error);
                   ?>
                    <div class="template-demo">
                    <?php
                      if(isset($_GET['confirm_delete']) AND $_GET['confirm_delete'] == 1 ){
                      echo ' <h3><span class="badge bg-primary">Classes/Class category has been edited</span></h3>';
                      }
                    ?>
                    
                     <?php
                     if(mysqli_num_rows($querysubject) == 0){
echo '<h2 class="text-center">No class has been added yet</h2>';

                     }else{
while($rows = mysqli_fetch_array($querysubject)){
   echo '<div class="dropdown">
          <button class="btn btn-info btn-fw dropdown-toggle" type="button" data-bs-toggle="dropdown">
          '.$rows['primary_class'].'
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <form action="" method="POST">
            <input type="hidden" name="delete-name" value="'.$rows['primary_class'].'">  
            <button type="submit" name="delete-subject" value="'.$rows['primary_class_id'].'" class="btn btn-danger btn-lg">Edit</button>
            
            </form>
          </div>
        </div>';
}
                     }
                     ?>
                     
                     
                    </div>
                  </div>
                 
                </div>
              </div>
</div>

<?php 
if(isset($_POST['delete-subject'])){
  
  $querysubject = mysqli_query($connect, "SELECT primary_class_id, primary_class FROM primary_school_classes WHERE primary_class_id='".mysqli_real_escape_string ($connect, $_POST['delete-subject'])."'") or die(db_conn_error);
while($rows = mysqli_fetch_array($querysubject)){
  $single = $rows['primary_class'];
  $hidden = $rows['primary_class_id'];
}

  echo '
<div class="row">

<div class="col-12 grid-margin stretch-card">
   <div class="card">
     <div class="card-body">
       <h4 class="card-title">Edit primary school classes</h4>
       <p class="card-description"></p>

       <form class="forms-sample" method="POST" action="">
         <div class="form-group">
           <label for="exampleInputName1">Class name</label>';
          
 
         echo  '<input type="text" class="form-control" id="exampleInputName1" placeholder="Class name" value="'; if(isset($_POST['subjectnameedit'])){echo $_POST['subjectnameedit'];}else{echo $single;} echo '" name="subjectnameedit">
         </div>
<input type="hidden" name="hidden" value = "'.$hidden.'" >

         
     <button type="submit" class="btn btn-primary me-2" name="submitedit">Submit</button>
        
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
                    <h4 class="card-title">Add Primary school classes</h4>
                    <p class="card-description"></p>

                    <form class="forms-sample" method="POST" action="">
                      <div class="form-group">
                        <label for="exampleInputName1">Class name</label>
                        <?php if (array_key_exists('subjectname', $errors)) {
				echo '<p class="text-danger">'.$errors['subjectname'].'</p>';}?>
              
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Class name" value="<?php if(isset($_POST['subjectname'])){echo $_POST['subjectname'];}?>" name="subjectname">
                      </div>


                      
                  <button type="submit" class="btn btn-primary me-2" name="submit">Submit</button>
                     
                    </form>
                  </div>
                </div>
              </div>

            </div>

           <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>



















      