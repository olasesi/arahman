<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header("Location:".GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != HEADMASTER){
	header("Location:".GEN_WEBSITE.'/dashboard.php');
	exit();
}

?>




<?php

if (!isset($errors)){$errors = array();}



if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){
    
    
    if ($_POST['class'] == "Choose class") {
		$errors['class'] = 'Please choose class';
	} else{
	$class = $_POST['class'];
	}

      
    if ($_POST['subject'] == "Choose subject") {
		$errors['subject'] = 'Please choose subject';
	} else{
	$subject = $_POST['subject'];
	}


//now to edit the product	
	if (empty($errors)){

        $notlinkquery = mysqli_query($connect, "SELECT primary_class_subjects_id FROM primary_class_subjects WHERE 	primary_class_id_class = '".$class."' AND primary_subject_id_subject = '".$subject."'") or die(db_conn_error);
        
        if(mysqli_num_rows($notlinkquery) == 0){

            mysqli_query($connect, "INSERT INTO primary_class_subjects (primary_class_id_class, primary_subject_id_subject) VALUES ('".$class."', '".$subject."')") or die(db_conn_error);
   
            $done = $class;
            $_POST = array();
         		

       
            
       
        }else{
            $errors['class_already_linked'] = 'Class has already been linked';

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
       <h4 class="card-title">The subject has been added to the class</h4>
     

          
              
                    </form>
                  </div>
                </div>
              </div>

            </div>';
}
          
            ?>
   <?php       
       if(array_key_exists('class_already_linked', $errors)){
           
           echo '<div class="row">
   
   <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">The subject has already been added to a primary school class</h4>
        
   
             
                 
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
                    <h4 class="card-title">Link class with subject</h4>
                    <p class="card-description"></p>
                    
                    <form class="forms-sample" method="POST" action="" >
                     
                    
                      <div class="form-group">
                        <label for="exampleSelectclass">Class</label>
                    <?php if (array_key_exists('class', $errors)) {
	                    echo '<p class="text-danger" >'.$errors['class'].'</p>';
	                    }
                    ?>
                        <select class="form-control" id="exampleSelectclass" name="class">
                       <?php        
                        
                        echo '<option>Choose class</option>';
                                        
                        if(isset ($_POST['class'])){
                        foreach ($class_range as $pri_class=>$class_number){
                        $sel_class = ($pri_class==$_POST['class'])?'Selected="selected"':'';
                        echo '<option value="'.$class_number.'" '.$sel_class.'>'.$pri_class.'</option>';}
                        }else{
                            foreach ($class_range as $pri_class=>$class_number){
                              
                                echo '<option value="'.$class_number.'">'.$pri_class.'</option>';}

                        }
                        ?>            
                        </select>
                      </div>



                      <div class="form-group">
                        <label for="exampleSelectsubject">Subject</label>
                     
                    
                    <?php 
                    $subjectquery = mysqli_query($connect, "SELECT primary_subjects_id, primary_subjects_name FROM primary_subjects") or die(db_conn_error);
                    if (array_key_exists('subject', $errors)) {
	                    echo '<p class="text-danger" >'.$errors['class'].'</p>';
	                    }
                    ?>
                        <select class="form-control" id="exampleSelectsubject" name="subject">
                       <?php        
                        
                        echo '<option>Choose subject</option>';
                        while($link = mysqli_fetch_array($subjectquery)){
                            echo '<option value="'.$link['primary_subjects_id'].'">'.$link['primary_subjects_name'].'</option>';
 
                        }  
                        
                        /*on error selection, the selected one should still be there. Not done yet*/
                      /*  if(isset ($_POST['subject'])){
                        foreach ($class_range as $pri_class=>$class_number){
                        $sel_class = ($pri_class==$_POST['class'])?'Selected="selected"':'';
                        echo '<option value="'.$class_number.'" '.$sel_class.'>'.$pri_class.'</option>';}
                        }else{
                            foreach ($class_range as $pri_class=>$class_number){
                              
                                echo '<option value="'.$class_number.'">'.$pri_class.'</option>';}

                        }*/
                        ?>            
                        </select>
                      </div>






                      <button type="submit" class="btn btn-primary me-2" name="submit">Link with class</button>
                    
                    </form>
                  </div>
                </div>
              </div>

            </div>

           <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>



















      