<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
include("../../incs-arahman/cookie_for_most_teachers.php");

?>
<?php
if(!isset($_SESSION['primary_teacher_id'])){   //Not a teacher? Please leave
	header('Location:'.GEN_WEBSITE.'/teachers');
	exit();
}
?>
<?php

$query_banning = mysqli_query($connect, "SELECT primary_teacher_active FROM primary_teachers WHERE primary_teacher_active = '0' AND primary_teacher_id = '".$_SESSION['primary_teacher_id']."'") or die(db_conn_error); 
	
if (mysqli_affected_rows($connect) == 1) {

 mysqli_query($connect,"UPDATE primary_teachers SET primary_teacher_cookie = '' WHERE primary_teacher_id = '".$_SESSION['primary_teacher_id']."'") or die(db_conn_error);	
session_destroy();
setcookie("teachers_remember_me", "", time() - 31104000);		
	
header('Location:'.GEN_WEBSITE.'/teachers');
exit();
}

?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['delete_assignment'])){
	mysqli_query($connect, "DELETE FROM primary_test_assignment_upload WHERE primary_test_upload_id  = '".$_POST['delete_assignment']."'") or die(db_conn_error);

    header('Location:'.GEN_WEBSITE.'/teachers/home.php?confirm_delete=1');
    exit();

    
}
?>


<?php include("../../incs-arahman/header-teacher-students.php");?>



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
if(isset($_GET['confirm_delete']) AND $_GET['confirm_delete']=1){
echo '
<div class="row">
					   <div class="col-md-12 grid-margin stretch-card">
						   <div class="card">
							   <div class="card-body primary">
								   <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
									   <div>
										  
										   <h3 class="mb-0 text-center">Resources has been deleted</h3>
									   </div>
									 
								   </div>
								  
							   </div>
						   </div>
					   </div>
					 
					 
				   </div> ';
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
                                                <p class="mb-0 text-muted">Students in <?=$_SESSION['primary_class'];?></p>
                                                <!-- <p class="mb-0 text-muted">+1.37%</p> -->
                                            </div>
                                            <?php $query_students_no = mysqli_query($connect, "SELECT * FROM primary_school_students, primary_school_classes WHERE primary_class_id=pri_class_id AND pri_paid='1' AND pri_admit='1' AND pri_class_id = '".$_SESSION['primary_teacher_class_id']."'") or die(db_conn_error);			//To link to primary_school_classes later. For now we use primary_teacher_class_id



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
                                                <?php $query_students_male = mysqli_query($connect, "SELECT primary_id FROM primary_school_students WHERE pri_sex = 'Male' AND pri_paid='1' AND pri_admit='1' AND pri_class_id = '".$_SESSION['primary_teacher_class_id']."'") or die(db_conn_error);?>
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
                                                
                                                <h3 class="mb-"><?= floor((mysqli_num_rows($query_students_no)/mysqli_num_rows($query_all_students))*100) ?>%</h3>
                                            </div>
                                            <canvas id="sales-chart-b" class="mt-auto" height="38"></canvas>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <?php $query_students_no_male = mysqli_query($connect, "SELECT pri_age FROM primary_school_students WHERE pri_paid='1' AND pri_sex='Male' AND pri_admit='1' AND pri_class_id = '".$_SESSION['primary_teacher_class_id']."'") or die(db_conn_error);		
                                
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
                                                
                                                <?php $query_students_no_female = mysqli_query($connect, "SELECT pri_age FROM primary_school_students WHERE pri_paid='1' AND pri_sex='Female' AND pri_admit='1' AND pri_class_id = '".$_SESSION['primary_teacher_class_id']."'") or die(db_conn_error);		
                                
                                while($female_students = mysqli_fetch_array($query_students_no_female)){
                                    $arraying_female = $female_students['pri_age'];
                                    $adding_female[] = $arraying_female;

                                }
                                
                                
?>
                                                
                                                <div class="col-6 d-flex flex-column justify-content-between">
                                                <?//=mysqli_num_rows($query_students_no) - mysqli_num_rows($query_students_male);?>
                                                <p class="text-muted">Class Av. age (F)</p>
                                                    <h4><?php if(isset($adding_female)){echo round(array_sum($adding_female)/mysqli_num_rows($query_students_no_female), 2);}else{echo '0';}?></h4>
                                                    <canvas id="memory-chart" class="mt-auto"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 grid-margin stretch-card flex-column">
                            <h5 class="mb-2 text-titlecase mb-4">Prospective students statistics</h5>
                            <div class="row h-100">
                                <div class="col-md-12 stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start flex-wrap">
                                                <div>
                                                    <p class="mb-3"></p>
                                                    <?php $query_pros_students_no = mysqli_query($connect, "SELECT primary_id FROM primary_school_students WHERE (pri_active_email = '0' OR pri_paid='0' OR pri_admit='0')") or die(db_conn_error);	?>
                                                    <h3><?= mysqli_num_rows($query_pros_students_no);?></h3>
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
  $query_class_subjects = mysqli_query($connect, "SELECT primary_subjects_name FROM primary_subjects, primary_class_subjects, primary_school_classes WHERE primary_class_id_class = primary_class_id AND primary_subject_id_subject = primary_subjects_id AND primary_class_id_class= '".$_SESSION['primary_teacher_class_id']."'") or die(db_conn_error);		
  
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
                                                        <img src="../admin/<?= 'teachers/'.$_SESSION['primary_teacher_image'];?>" alt="avatar">
                                                    </figure>
                                                </div>
                                                <div class="col-md-8">
                                                    <h5 class="text-white text-center text-md-left">
														<?= $_SESSION['primary_teacher_firstname'] .' '.$_SESSION['primary_teacher_surname'];?></h5>
                                                    <p class="text-white text-center text-md-left"><?= $_SESSION['primary_teacher_email']; ?></p>
                                                    <div class="d-flex align-items-center justify-content-between info pt-2">
                                                        <div>
                                                            <p class="text-white font-weight-bold">Class</p>
                                                            <p class="text-white font-weight-bold">Sex</p>
															<p class="text-white font-weight-bold">Age</p>
															<p class="text-white font-weight-bold">Phone</p>
															<p class="text-white font-weight-bold">Qual.</p>
															<p class="text-white font-weight-bold">Address</p>
															
                                                        </div>
                                                        <div>
                                                            <p class="text-white"><?=$_SESSION['primary_class'];?></p>
															<p class="text-white"><?=$_SESSION['primary_teacher_sex'];?></p>
															<p class="text-white"><?=$_SESSION['primary_teacher_age'];?></p>
															<p class="text-white"><?=$_SESSION['primary_teacher_phone'];?></p>
															<p class="text-white"><?=$_SESSION['primary_teacher_qualification'];?></p>
															<p class="text-white"><?=$_SESSION['primary_teacher_address'];?></p>
															
                                                           
                                                        </div>
													

 
													
													</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           
                        </div>
                        
                    </div>

                  

                    <div class="row">
                        <div class="col-md-12">
                        <h5 class="mb-2 text-titlecase mb-4">Students details</h5>
                            <div class="card">
                                <div class="table-responsive pt-3">
                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                                <th class="ml-5">Firstname</th>
                                                <th>Surname</th>
                                                <th>Age</th>
                                                <th>Sex</th>
                                                <th>Year registered</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           


                    <?php
//Highlight Students details
$results = mysqli_query($connect,"SELECT primary_id, pri_year, pri_firstname, pri_surname, pri_age, pri_sex, pri_photo, primary_class FROM primary_school_students, primary_school_classes WHERE pri_paid = '1' AND pri_admit = '1' AND pri_active_email = '1' AND primary_class_id = pri_class_id AND pri_class_id = '".$_SESSION['primary_teacher_class_id']."' ORDER BY primary_id ASC LIMIT 20") or die(db_conn_error); // Sec. students will be added to the select lists later.
  
if (mysqli_num_rows($results) >= 1 AND mysqli_num_rows($results) <= 12){
	if (mysqli_num_rows($results) >= 1 AND mysqli_num_rows($results) <= 12){
	while ($row_student = mysqli_fetch_array($results)) {
		echo '<tr>';
        echo '<td>'.$row_student['pri_firstname'].'</td>';
		echo '<td>'.$row_student['pri_surname'].'</td>';
       echo '<td>'.$row_student['pri_age'].'</td>';
		echo '<td>'.$row_student['pri_sex'].'</td>';
	 echo '<td>'.$row_student['pri_year'].'</td>';


      
	echo '</tr>';
	}



               
	//$more_results = mysqli_query($connect,"SELECT primary_id FROM primary_school_students WHERE pri_paid = '1' AND pri_admit = '0' AND pri_active_email = '1' ORDER BY primary_id ASC") or die(db_conn_error); // Sec. students will be added to the select lists later.
	

}
echo '<td> <div class="d-flex align-items-center">';
echo '<form action="search-my-students.php?students_name=&search_button=" method="GET">
<button type="submit" class="btn btn-success btn-sm btn-icon-text mr-3" name="show_students" value="">Show more details</button>
</form>';
echo '<div></td>';
}elseif(mysqli_num_rows($results) == 0){
	echo '<h3 class="text-center">No registered students</h3>';

}

?>

</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



















                    <?php
//This is all about uploading assignmend and tests
 if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['close_assignment'])){
	mysqli_query($connect, "UPDATE primary_test_assignment_upload SET primary_test_upload_class_status = 'Close' WHERE primary_test_upload_class_status = 'Open' AND primary_test_upload_id  = '".$_POST['close_assignment']."'") or die(db_conn_error);
}elseif($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['open_assignment'])){
	mysqli_query($connect, "UPDATE primary_test_assignment_upload SET primary_test_upload_class_status = 'Open' WHERE primary_test_upload_class_status = 'Close' AND primary_test_upload_id = '".$_POST['open_assignment']."'") or die(db_conn_error);
}





$query_read = mysqli_query ($connect, "SELECT primary_test_upload_testname, primary_test_upload_id, primary_test_upload_class_status, primary_test_upload_filename, primary_class, primary_test_upload_timestamp FROM primary_test_assignment_upload, primary_school_classes WHERE primary_class_id = primary_test_upload_class_id AND primary_test_upload_class_id='".$_SESSION['primary_teacher_class_id']."'ORDER BY primary_test_upload_id DESC LIMIT 20") or die(db_conn_error);

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
                                             
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                       
                                           <?php if (mysqli_num_rows($query_read) != 0){
	while ($row_read = mysqli_fetch_array($query_read)) {
        echo ' <tr>';
        echo '<td>'.$row_read['primary_test_upload_testname'].'</td>';
echo '<td>'.date('M j Y g:i A', strtotime($row_read['primary_test_upload_timestamp']. OFFSET_TIME)).'</td>';

echo '<td>'.$row_read['primary_test_upload_class_status'].'</td>';	



echo '<td>
    <div class="d-flex align-items-center">';
if($row_read['primary_test_upload_class_status'] == 'Open'){
	
    echo '
    <form action="" method="POST">
	 <button type="submit" class="btn btn-danger btn-sm btn-icon-text mr-3" name="close_assignment" value="'.$row_read['primary_test_upload_id'].'">Close</button>
	</form>';
}elseif($row_read['primary_test_upload_class_status'] == 'Close'){
echo '<form action="" method="POST">
<button type="submit" class="btn btn-success btn-sm btn-icon-text mr-3" name="open_assignment" value="'.$row_read['primary_test_upload_id'].'">Open</button>
</form>';}
echo '
</div>
</td>';


echo '<td>
    <div class="d-flex align-items-center">';

	
    echo '
    <form action="" method="POST">
	 <button type="submit" class="btn btn-danger btn-sm btn-icon-text mr-3" name="delete_assignment" value="'.$row_read['primary_test_upload_id'].'">Delete</button>
	</form>';

echo '
</div>
</td>';




echo '</tr>';
}

$query_read_more = mysqli_query ($connect, "SELECT primary_test_upload_id FROM primary_test_assignment_upload, primary_school_classes WHERE primary_class_id = primary_test_upload_class_id AND primary_test_upload_class_id='".$_SESSION['primary_teacher_class_id']."'ORDER BY primary_test_upload_id DESC") or die(db_conn_error);

if(mysqli_num_rows($query_read_more) > 20){
	echo '<td>';
    echo '<a href="'.GEN_WEBSITE.'/teachers/more-assignments.php"><h6 class="preview-subject">See more...</h6></a>';
    echo '</td>';
}
}else{
    echo '<td>';
	echo '<p class="text-center">No test or resource was uploaded</p>';
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













