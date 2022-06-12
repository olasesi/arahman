<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
include("../../incs-arahman/cookie_for_most_students.php");
//include('../users/includes/menu.php');
?>
<?php
if(!isset($_SESSION['primary_id'])){   //Not a student? Please leave
	header('Location:'.GEN_WEBSITE.'/students');
	exit();
}
?>
  <?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['pay'])){
                $class_price = $_POST['balance'] * 100;
                $email = $_SESSION['pri_email'];
               $_SESSION['term'] = $_POST['term'];
               $_SESSION['session'] = $_POST['session'];
                require_once ('../../incs-arahman/pay.php');
 } ?>
<?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['pay_module'])){
                $_SESSION['module'] = $_POST['module'];
                $class_price = $_POST['module_price'] * 100;
                $email = $_SESSION['pri_email'];
              
                require_once ('../../incs-arahman/pay.php');
 } ?>
<?php include("../../incs-arahman/header-students.php");?>

<?php
	
	$query_banning = mysqli_query($connect, "SELECT pri_active FROM primary_school_students WHERE pri_active = '0' AND primary_id = '".$_SESSION['primary_id']."'") or die(db_conn_error); 
	
if (mysqli_affected_rows($connect) == 1) {

 mysqli_query($connect,"UPDATE primary_school_students SET pri_cookie_session = '' WHERE primary_id = '".$_SESSION['primary_id']."'") or die(db_conn_error);	
session_destroy();
setcookie("students_remember_me", "", time() - 31104000);		
	
header('Location:'.GEN_WEBSITE.'/students');
exit();
}

?>



           <!-- partial -->
		   <div class="main-panel">
                <div class="content-wrapper">

<?php
if(isset($_GET['confirm_file']) AND $_GET['confirm_file']=1){
echo '
<div class="row">
					   <div class="col-md-12 grid-margin stretch-card">
						   <div class="card">
							   <div class="card-body primary">
								   <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
									   <div>
										  
										   <h3 class="mb-0 text-center">Resources has been submitted</h3>
									   </div>
									 
								   </div>
								  
							   </div>
						   </div>
					   </div>
					 
					 
				   </div> ';
}
?>

<?php
if(isset($_GET['reference'])){
    $query_ref = mysqli_query($connect, "SELECT primary_payment_students_reference FROM primary_payment WHERE primary_payment_students_reference = '".$_GET['reference']."' AND primary_payment_students_id = '".$_SESSION['primary_id']."'") or die(db_conn_error);  
    if(mysqli_num_rows($query_ref) == 1){
echo '
<div class="row">
					   <div class="col-md-12 grid-margin stretch-card">
						   <div class="card">
							   <div class="card-body primary">
								   <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
									   <div>
										  
										   <h3 class="mb-0 text-center">You have completed your payment</h3>
									   </div>
									 
								   </div>
								  
							   </div>
						   </div>
					   </div>
					 
					 
				   </div> ';
}}
?>












<?php
   $query_students_no = mysqli_query($connect, "SELECT primary_payment_fees, primary_payment_paid_percent, primary_payment_term, primary_payment_session FROM primary_payment WHERE primary_payment_students_id = '".$_SESSION['primary_id']."' AND primary_payment_paid_percent != '100' AND primary_payment_completion_status='0'") or die(db_conn_error);		
  
  
    
        while($rows = mysqli_fetch_array($query_students_no)){ 
                                            
echo
'<div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                                        <div>
                                            <p class="mb-2 text-md-center text-lg-left">Amount owed</p>
                                            <h1 class="mb-0 text-danger">&#8358;'.number_format((((100 - $rows['primary_payment_paid_percent'])/100) * $rows['primary_payment_fees'])).'</h1>
                                        </div>
                                        <i class="typcn typcn-briefcase icon-xl text-secondary"></i>
                                    </div>
                                    <form class="form d-flex flex-column align-items-center justify-content-between w-100" method="post" action="">
                                           <input type="hidden" name="balance" value="'.(((100 - $rows['primary_payment_paid_percent'])/100) * $rows['primary_payment_fees']).'"/>
                                           <input type="hidden" name="term" value="'.$rows['primary_payment_term'].'"/> 
                                           <input type="hidden" name="session" value="'.$rows['primary_payment_session'].'"/>      
                                    <button class="btn btn-danger btn-rounded mt-1" type="submit" name="pay">Pay now</button>
                                </form>
                                </div> 
                            </div>
                           

                        </div>
                       
</div>


';

}

?>

<?php
   $query_modules = mysqli_query($connect, "SELECT 	module_id, module_price, module_type, module_end_date FROM modules, module_price WHERE module_id = modules_id AND module_class_id = '".$_SESSION['pri_class_id']."'") or die(db_conn_error);		
  
  echo '<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                  <div>
                      <p class="mb-2 text-md-center text-lg-left">Other school activities payment</p>
                      <h1 class="mb-0 text-danger"></h1>
                  </div>
                  
              </div>';
   
             


        while($rows_modules = mysqli_fetch_array($query_modules)){ 
       
          
            $query_modules_inner = mysqli_query($connect, "SELECT module_students, module_type_id, module_status FROM module_join_students WHERE module_type_id = '".$rows_modules['module_id']."' AND module_students = '".$_SESSION['primary_id']."' AND module_status = '1'") or die(db_conn_error);

if(mysqli_num_rows($query_modules_inner) == 0){

echo
'
                                    <form class="form d-flex flex-column align-items-center justify-content-between w-100" method="post" action="">
                                           <input type="hidden" name="module" value="'.$rows_modules['module_id'].'"/> 
                                           
                                           <input type="hidden" name="module_price" value="'.$rows_modules['module_price'].'"/>
                                           
                                    <button class="btn btn-success btn-rounded mt-1" type="submit" name="pay_module">'.$rows_modules['module_type'].' - Deadline: '.$rows_modules['module_end_date'].'</button>
                                </form>
                               

';

        }


}
echo ' </div> 
</div>


</div>

</div>
';
?>
<?php
  $query_inner = mysqli_query($connect, "SELECT module_type, module_type_id FROM module_join_students, modules WHERE module_id=module_type_id AND module_students = '".$_SESSION['primary_id']."'") or die(db_conn_error);
  
  
   
        while($rows_paid = mysqli_fetch_array($query_inner)){ 
                                            
echo
'<div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                                        <div>
                                            <p class="mb-2 text-md-center text-lg-left">Paid activities</p>
                                            <h1 class="mb-0 text-danger">'.$rows_paid['module_type'].'</h1>
                                        </div>
                                     
                                    </div>
                                   
                                </div> 
                            </div>
                           

                        </div>
                       
</div>


';

}

?>

                    <div class="row">
                        <div class="col-xl-6 grid-margin stretch-card flex-column">
                            <h5 class="mb-2 text-titlecase mb-4">Class statistics</h5>
                            <div class="row">
                                <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                            
                                            <p class="mb-0 text-muted">Students in </p>
                                                <!-- <p class="mb-0 text-muted">+1.37%</p> -->
                                            </div>
                                            <?php $query_students_no = mysqli_query($connect, "SELECT * FROM primary_school_students, primary_school_classes WHERE primary_class_id=pri_class_id AND pri_paid='1' AND pri_admit='1' AND pri_class_id = '".$_SESSION['pri_class_id']."'") or die(db_conn_error);			//To link to primary_school_classes later. For now we use primary_teacher_class_id



//Script to display some few students details in the page//

?>
											<h4><?=mysqli_num_rows($query_students_no)?></h4>
                                            <canvas id="transactions-chart" class="mt-auto" height="65"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                <?php $query_students_male = mysqli_query($connect, "SELECT primary_id FROM primary_school_students WHERE pri_sex = 'Male' AND pri_paid='1' AND pri_admit='1' AND pri_class_id = '".$_SESSION['pri_class_id']."'") or die(db_conn_error);?>
                                                    <p class="mb-2 text-muted">Male</p>
                                                    <h6 class="mb-0"><?=mysqli_num_rows($query_students_male);?></h6>
                                                </div>
                                                <div>
                                                    <p class="mb-2 text-muted"></p>
                                                    <h6 class="mb-0"></h6>
                                                </div>
                                                <div>
                                                    <p class="mb-2 text-muted">Female</p>
                                                    <h6 class="mb-0"><?=mysqli_num_rows($query_students_no) - mysqli_num_rows($query_students_male);?></h6>
                                                </div>
                                            </div>
                                            <canvas id="sales-chart-a" class="mt-auto" height="65"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100">
                                <div class="col-md-6 stretch-card grid-margin grid-margin-md-0">
                                    <div class="card">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <p class="text-muted">Class percentage of school</p>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h3 class="mb-"></h3>
                                                <?php $query_all_students = mysqli_query($connect, "SELECT primary_id FROM primary_school_students WHERE pri_paid='1' AND pri_admit='1'") or die(db_conn_error);	
?>
                                                
                                                <h3 class="mb-"><?php if(mysqli_num_rows($query_students_no) > 0){ echo floor((mysqli_num_rows($query_students_no)/mysqli_num_rows($query_all_students))*100);}else{
                                                    echo 0;
                                                } ?>%</h3>
                                            </div>
                                            <canvas id="sales-chart-b" class="mt-auto" height="38"></canvas>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <?php $query_students_no_male = mysqli_query($connect, "SELECT pri_age FROM primary_school_students WHERE pri_paid='1' AND pri_sex='Male' AND pri_admit='1' AND pri_class_id = '".$_SESSION['pri_class_id']."'") or die(db_conn_error);		
                                
                                while($male_students = mysqli_fetch_array($query_students_no_male)){
                                    $arraying_male = $male_students['pri_age'];
                                    $adding_male[] = $arraying_male;

                                }
                                
                                
?>
                                <div class="col-md-6 stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row h-100">
                                                <div class="col-6 d-flex flex-column justify-content-between">
                                                    <p class="text-muted">Class Av. age (M)</p>
                                                    


                                                  
                                                    <h4>  <?php if(isset($adding_male)){echo round(array_sum($adding_male)/mysqli_num_rows($query_students_male), 2);}else{echo '0';}?></h4>
                                                    <canvas id="cpu-chart" class="mt-auto"></canvas>
                                                </div>
                                                
                                                <?php $query_students_no_female = mysqli_query($connect, "SELECT pri_age FROM primary_school_students WHERE pri_paid='1' AND pri_sex='Female' AND pri_admit='1' AND pri_class_id = '".$_SESSION['pri_class_id']."'") or die(db_conn_error);		
                                
                                while($female_students = mysqli_fetch_array($query_students_no_female)){
                                    $arraying_female = $female_students['pri_age'];
                                    $adding_female[] = $arraying_female;

                                }
                                
                                
?>
                                                
                                                <div class="col-6 d-flex flex-column justify-content-between">
                                                <?//=mysqli_num_rows($query_students_no) - mysqli_num_rows($query_students_male);?>
                                                <p class="text-muted">Class Av. age (F)</p>
                                                    <h4><?php if(isset($adding_female)){echo round(array_sum($adding_female)/(mysqli_num_rows($query_students_no) - mysqli_num_rows($query_students_male)));}else{echo '0';}?></h4>
                                                    <canvas id="memory-chart" class="mt-auto"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 grid-margin stretch-card flex-column">
                            <h5 class="mb-2 text-titlecase mb-4">Number of test/resources</h5>
                            <div class="row h-100">
                                <div class="col-md-12 stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start flex-wrap">
                                                <div>
                                                    <p class="mb-3"></p>
                                                    <?php $query_no_resource = mysqli_query($connect, "SELECT primary_test_upload_id FROM primary_test_assignment_upload WHERE (	primary_test_upload_class_id = '".$_SESSION['pri_class_id']."')") or die(db_conn_error);	?>
                                                    <h3><?= mysqli_num_rows($query_no_resource );?></h3>
                                                </div>
                                                <div id="income-chart-legend" class="d-flex flex-wrap mt-1 mt-md-0"></div>
                                            </div>
                                            <canvas id="income-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                    <div class="col-xl-8 col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body border-bottom">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-2 mb-md-0 text-uppercase font-weight-medium">Class Subjects</h6>
                                       
                                    </div>
                                </div>
                                <div class="card-body"> 
                                   
                                   
                                    <!-- <div class="d-flex justify-content-between align-items-center">-->
<?php
  $query_class_subjects = mysqli_query($connect, "SELECT primary_subjects_name FROM primary_subjects, primary_class_subjects, primary_school_classes WHERE primary_class_id_class = primary_class_id AND primary_subject_id_subject = primary_subjects_id AND primary_class_id_class= '".$_SESSION['pri_class_id']."'") or die(db_conn_error);		
  
  while($class_subjects = mysqli_fetch_array($query_class_subjects)){
   echo ' 
   
                     


                    
   <button type="button" class="btn btn-info btn-fw disabled">'.$class_subjects['primary_subjects_name'].'</button>

                   ';


  }
?>

                                       
                                                                 </div> 
                            </div>
                        </div>





                   
                        <div class="col-md-12 col-xl-4 grid-margin stretch-card">
                            <div class="col-md-12 stretch-card">
                                    <div class="card profile-card bg-gradient-primary">
                                        <div class="card-body">
                                            <div class="row align-items-center h-100">
                                                <div class="col-md-4">
                                                    <figure class="avatar mx-auto mb-4 mb-md-0">
                                                        <img src="../admin/<?= 'students/'.$_SESSION['pri_photo'];?>" alt="avatar">
                                                    </figure>
                                                </div>
                                                <div class="col-md-8">
                                                    <h5 class="text-white text-center text-md-left">
														<?= $_SESSION['pri_firstname'] .' '.$_SESSION['pri_surname'];?></h5>
                                                    <p class="text-white text-center text-md-left"><?= $_SESSION['pri_email']; ?></p>
                                                    <div class="d-flex align-items-center justify-content-between info pt-2">
                                                        <div>
                                                          
                                                            <p class="text-white font-weight-bold">Sex</p>
															<p class="text-white font-weight-bold">Age</p>
															<p class="text-white font-weight-bold">Phone</p>
														
															<p class="text-white font-weight-bold">Address</p>
															
                                                        </div>
                                                        <div>
                                                            <p class="text-white"></p>
															<p class="text-white"><?=$_SESSION['pri_sex'];?></p>
															<p class="text-white"><?=$_SESSION['pri_age'];?></p>
															<p class="text-white"><?=$_SESSION['pri_phone'];?></p>
														
															<p class="text-white"><?=$_SESSION['pri_address'];?></p>
															
                                                           
                                                        </div>
													

 
													
													</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                       
                    </div>







                    <?php


$query_read = mysqli_query ($connect, "SELECT primary_test_upload_id, primary_test_upload_testname,  primary_test_upload_filename, primary_test_upload_timestamp FROM primary_test_assignment_upload WHERE primary_test_upload_class_id = '".$_SESSION['pri_class_id']."' AND primary_test_upload_class_status = 'Open' ORDER BY primary_test_upload_id DESC LIMIT 12") or die(db_conn_error);

//
?>

                    <div class="row">
                        <div class="col-md-12">
                        <h5 class="mb-2 mt-4 text-titlecase mb-4">Assignments and resources</h5>
                            <div class="card">
                                 
                                <div class="table-responsive pt-3">
                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                            <th>Resource/test name</th>

                                                <th>Date given</th>
                                                <!-- <th>Date</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                       
                                           <?php if (mysqli_num_rows($query_read) != 0){
	while ($row_read = mysqli_fetch_array($query_read)) {
        echo ' <tr>';
        echo '<td>'.$row_read['primary_test_upload_testname'].'</td>';

echo '<td>'.date('M j Y g:i A', strtotime($row_read['primary_test_upload_timestamp']. OFFSET_TIME)).'</td>';




echo '<td>
    <div class="d-flex align-items-center">';
	echo'
	<a href="../../incs-storage/assignments/'.$row_read['primary_test_upload_filename'].'" download="'.$row_read['primary_test_upload_testname'].'">Download</a>
	';
    //echo '
  
	 //<button type="submit" class="btn btn-danger btn-sm btn-icon-text mr-3" name="close_assignment" value="'.$row_read['primary_test_upload_id'].'">Close</button>
	//';

echo '
</div>
</td>';
echo '</tr>';
}

}else{
    echo '<td>';
	echo '<p class="text-center">No test or resource was given</p>';
    echo '</td>';
}
?>
                                                





                                           
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



















                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
				<?php include_once("../../incs-arahman/footer-teacher-students.php"); ?>







					<?php
/*session_start();
if (isset($_SESSION['logged_in'])) {
  $file = '/this/is/the/path/file.mp3';

  header('Content-type: audio/mpeg');
  header('Content-length: ' . filesize($file));
  readfile($file);
}*/
?>



