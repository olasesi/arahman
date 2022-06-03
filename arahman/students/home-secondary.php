<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');
?>
<?php
$query = mysqli_query($connect, "DELETE FROM secondary_school_students WHERE sec_timestamp < '".date("Y-m-d H:i:s", strtotime("-48 hours"))."' AND sec_active_email='0'") or die(db_conn_error);


if(!isset($_SESSION['secondary_id'])){   //Not a student? Please leave
	header('Location:'.GEN_WEBSITE.'/students');
	exit();
}
?>
  <?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['pay'])){
                $class_price = $_POST['balance'] * 100;
                $email = $_SESSION['sec_email'];
               
                require_once ('../../incs-arahman/pay.php');
 } ?>
<?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['pay_module'])){
                $_SESSION['secondary_module'] = $_POST['module'];
                $class_price = $_POST['module_price'] * 100;
                $email = $_SESSION['sec_email'];
              
                require_once ('../../incs-arahman/pay.php');
 } ?>
<?php include("../../incs-arahman/header-students.php");?>

<?php
	
	$query_banning = mysqli_query($connect, "SELECT sec_active FROM secondary_school_students WHERE sec_active = '0' AND secondary_id = '".$_SESSION['secondary_id']."'") or die(db_conn_error); 
	
if (mysqli_affected_rows($connect) == 1) {

 mysqli_query($connect,"UPDATE secondary_school_students SET sec_cookie_session = '' WHERE secondary_id = '".$_SESSION['secondary_id']."'") or die(db_conn_error);	
session_destroy();
setcookie("sec_students_remember_me", "", time() - 31104000);		
	
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
    $query_ref = mysqli_query($connect, "SELECT secondary_payment_students_reference FROM secondary_payment WHERE secondary_payment_students_reference = '".$_GET['reference']."' AND secondary_payment_students_id = '".$_SESSION['secondary_id']."'") or die(db_conn_error);  
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
   $query_students_no = mysqli_query($connect, "SELECT secondary_payment_fees, secondary_payment_paid_percent FROM secondary_payment WHERE secondary_payment_students_id = '".$_SESSION['secondary_id']."' AND secondary_payment_paid_percent != '100' AND secondary_payment_completion_status='0'") or die(db_conn_error);		
  
  
    if(mysqli_num_rows($query_students_no) == 1){
        while($rows = mysqli_fetch_array($query_students_no)){ 
                                            
echo
'<div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                                        <div>
                                            <p class="mb-2 text-md-center text-lg-left">Amount owed</p>
                                            <h1 class="mb-0 text-danger">&#8358;'.number_format((((100 - $rows['secondary_payment_paid_percent'])/100) * $rows['secondary_payment_fees'])).'</h1>
                                        </div>
                                        <i class="typcn typcn-briefcase icon-xl text-secondary"></i>
                                    </div>
                                    <form class="form d-flex flex-column align-items-center justify-content-between w-100" method="post" action="">
                                           <input type="hidden" name="balance" value="'.(((100 - $rows['secondary_payment_paid_percent'])/100) * $rows['secondary_payment_fees']).'"/>        
                                    <button class="btn btn-danger btn-rounded mt-1" type="submit" name="pay">Pay now</button>
                                </form>
                                </div> 
                            </div>
                           

                        </div>
                       
</div>


';

}
}
?>

<?php
   $query_modules = mysqli_query($connect, "SELECT 	secondary_module_id, secondary_module_price, secondary_module_type, secondary_module_end_date FROM secondary_modules, secondary_module_price WHERE secondary_module_id = secondary_modules_id AND secondary_module_class_id = '".$_SESSION['sec_class_id']."'") or die(db_conn_error);		
  
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
       
          		           

echo
'
                                    <form class="form d-flex flex-column align-items-center justify-content-between w-100" method="post" action="">
                                           <input type="hidden" name="module" value="'.$rows_modules['secondary_module_id'].'"/> 
                                           
                                           <input type="hidden" name="module_price" value="'.$rows_modules['secondary_module_price'].'"/>
                                           
                                    <button class="btn btn-success btn-rounded mt-1" type="submit" name="pay_module">'.$rows_modules['secondary_module_type'].'</button>
                                </form>
                               

';




}
echo ' </div> 
</div>


</div>

</div>
';
?>
<?php
  $query_inner = mysqli_query($connect, "SELECT secondary_module_type_id, secondary_module_type_id FROM secondary_module_join_students, secondary_modules WHERE secondary_module_id=secondary_module_type_id AND secondary_module_students = '".$_SESSION['secondary_id']."'") or die(db_conn_error);
  
  
   
        while($rows_paid = mysqli_fetch_array($query_inner)){ 
                                            
echo
'<div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                                        <div>
                                            <p class="mb-2 text-md-center text-lg-left">Paid activities</p>
                                            <h1 class="mb-0 text-danger">'.$rows_paid['secondary_module_type_id'].'</h1>
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
                                            <?php $query_students_no = mysqli_query($connect, "SELECT * FROM secondary_school_students, secondary_school_classes WHERE secondary_class_id=sec_class_id AND sec_paid='1' AND sec_admit='1' AND sec_class_id = '".$_SESSION['sec_class_id']."'") or die(db_conn_error);			//To link to primary_school_classes later. For now we use primary_teacher_class_id



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
                                                <?php $query_students_male = mysqli_query($connect, "SELECT secondary_id FROM secondary_school_students WHERE sec_sex = 'Male' AND sec_paid='1' AND sec_admit='1' AND sec_class_id = '".$_SESSION['sec_class_id']."'") or die(db_conn_error);?>
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
                                                <?php $query_all_students = mysqli_query($connect, "SELECT secondary_id FROM secondary_school_students WHERE sec_paid='1' AND sec_admit='1'") or die(db_conn_error);	
?>
                                                
                                                <h3 class="mb-"><?= floor((mysqli_num_rows($query_students_no)/mysqli_num_rows($query_all_students))*100) ?>%</h3>
                                            </div>
                                            <canvas id="sales-chart-b" class="mt-auto" height="38"></canvas>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <?php $query_students_no_male = mysqli_query($connect, "SELECT sec_age FROM secondary_school_students WHERE sec_paid='1' AND sec_sex='Male' AND sec_admit='1' AND sec_class_id = '".$_SESSION['sec_class_id']."'") or die(db_conn_error);		
                                
                                while($male_students = mysqli_fetch_array($query_students_no_male)){
                                    $arraying_male = $male_students['sec_age'];
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
                                                
                                                <?php $query_students_no_female = mysqli_query($connect, "SELECT sec_age FROM secondary_school_students WHERE sec_paid='1' AND sec_sex='Female' AND sec_admit='1' AND sec_class_id = '".$_SESSION['sec_class_id']."'") or die(db_conn_error);		
                                
                                while($female_students = mysqli_fetch_array($query_students_no_female)){
                                    $arraying_female = $female_students['sec_age'];
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
                                                    <?php $query_no_resource = mysqli_query($connect, "SELECT secondary_test_upload_id FROM secondary_test_assignment_upload WHERE (secondary_test_upload_class_id = '".$_SESSION['sec_class_id']."')") or die(db_conn_error);	?>
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
                        <!-- <div class="col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body border-bottom">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-2 mb-md-0 text-uppercase font-weight-medium">Activities</h6>
                                        <div class="dropdown">
                                            <button class="btn bg-white p-0 pb-1 text-muted btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Last 30 days
                                    </button> 
                                             <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                                <h6 class="dropdown-header">Settings</h6>
                                                <a class="dropdown-item" href="javascript:;">Action</a>
                                                <a class="dropdown-item" href="javascript:;">Another action</a>
                                                <a class="dropdown-item" href="javascript:;">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="javascript:;">Separated link</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="sales-chart-c" class="mt-2"></canvas>
                                    <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3 mt-4">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <p class="text-muted">Gross Sales</p>
                                            <h5>492</h5>
                                             <div class="d-flex align-items-baseline">
                                                <p class="text-success mb-0">0.5%</p>
                                                <i class="typcn typcn-arrow-up-thick text-success"></i>
                                            </div> 
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <p class="text-muted">Purchases</p>
                                            <h5>87k</h5>
                                             <div class="d-flex align-items-baseline">
                                                <p class="text-success mb-0">0.8%</p>
                                                <i class="typcn typcn-arrow-up-thick text-success"></i>
                                            </div> 
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <p class="text-muted">Tax Return</p>
                                            <h5>882</h5>
                                             <div class="d-flex align-items-baseline">
                                                <p class="text-danger mb-0">-04%</p>
                                                <i class="typcn typcn-arrow-down-thick text-danger"></i>
                                            </div> 
                                        </div>
                                    </div>
                                     <div class="d-flex justify-content-between align-items-center">
                                        <div class="dropdown">
                                            <button class="btn bg-white p-0 pb-1 pt-1 text-muted btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Last 7 days</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                                <h6 class="dropdown-header">Settings</h6>
                                                <a class="dropdown-item" href="javascript:;">Action</a>
                                                <a class="dropdown-item" href="javascript:;">Another action</a>
                                                <a class="dropdown-item" href="javascript:;">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="javascript:;">Separated link</a>
                                            </div>
                                        </div>
                                        <p class="mb-0">overview</p>
                                    </div> 
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-12 col-xl-12 grid-margin stretch-card">
                            <div class="row">
                               <!-- <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card newsletter-card bg-gradient-warning">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                                <h5 class="mb-3 text-white">Newsletter</h5>
                                                <form class="form d-flex flex-column align-items-center justify-content-between w-100">
                                                    <div class="form-group mb-2 w-100">
                                                        <input type="text" class="form-control" placeholder="email address">
                                                    </div>
                                                    <button class="btn btn-danger btn-rounded mt-1" type="submit">Subscribe</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>  -->
                                <div class="col-md-12 stretch-card">
                                    <div class="card profile-card bg-gradient-primary">
                                        <div class="card-body">
                                            <div class="row align-items-center h-100">
                                                <div class="col-md-4">
                                                    <figure class="avatar mx-auto mb-4 mb-md-0">
                                                        <img src="../admin/<?= 'students/'.$_SESSION['sec_photo'];?>" alt="avatar">
                                                    </figure>
                                                </div>
                                                <div class="col-md-8">
                                                    <h5 class="text-white text-center text-md-left">
														<?= $_SESSION['sec_firstname'] .' '.$_SESSION['sec_surname'];?></h5>
                                                    <p class="text-white text-center text-md-left"><?= $_SESSION['sec_email']; ?></p>
                                                    <div class="d-flex align-items-center justify-content-between info pt-2">
                                                        <div>
                                                          
                                                            <p class="text-white font-weight-bold">Sex</p>
															<p class="text-white font-weight-bold">Age</p>
															<p class="text-white font-weight-bold">Phone</p>
														
															<p class="text-white font-weight-bold">Address</p>
															
                                                        </div>
                                                        <div>
                                                            <p class="text-white"></p>
															<p class="text-white"><?=$_SESSION['sec_sex'];?></p>
															<p class="text-white"><?=$_SESSION['sec_age'];?></p>
															<p class="text-white"><?=$_SESSION['sec_phone'];?></p>
														
															<p class="text-white"><?=$_SESSION['sec_address'];?></p>
															
                                                           
                                                        </div>
													

 
													
													</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body border-bottom">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-2 mb-md-0 text-uppercase font-weight-medium">Sales statistics</h6>
                                        <div class="dropdown">
                                             <button class="btn bg-white p-0 pb-1 text-muted btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Last 7 days
                                        </button> 
                                             <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton4">
                                                <h6 class="dropdown-header">Settings</h6>
                                                <a class="dropdown-item" href="javascript:;">Action</a>
                                                <a class="dropdown-item" href="javascript:;">Another action</a>
                                                <a class="dropdown-item" href="javascript:;">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="javascript:;">Separated link</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="sales-chart-d" height="320"></canvas>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                                        <div>
                                            <p class="mb-2 text-md-center text-lg-left">Total Expenses</p>
                                            <h1 class="mb-0">8742</h1>
                                        </div>
                                        <i class="typcn typcn-briefcase icon-xl text-secondary"></i>
                                    </div>
                                    <canvas id="expense-chart" height="80"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                                        <div>
                                            <p class="mb-2 text-md-center text-lg-left">Total Budget</p>
                                            <h1 class="mb-0">47,840</h1>
                                        </div>
                                        <i class="typcn typcn-chart-pie icon-xl text-secondary"></i>
                                    </div>
                                    <canvas id="budget-chart" height="80"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                                        <div>
                                            <p class="mb-2 text-md-center text-lg-left">Total Balance</p>
                                            <h1 class="mb-0">$7,243</h1>
                                        </div>
                                        <i class="typcn typcn-clipboard icon-xl text-secondary"></i>
                                    </div>
                                    <canvas id="balance-chart" height="80"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> 
 -->






















                    <?php


$query_read = mysqli_query ($connect, "SELECT secondary_test_upload_id, secondary_test_upload_testname,  secondary_test_upload_filename, secondary_test_upload_timestamp FROM secondary_test_assignment_upload WHERE secondary_test_upload_class_id = '".$_SESSION['sec_class_id']."' AND secondary_test_upload_class_status = 'Open' ORDER BY secondary_test_upload_id DESC LIMIT 12") or die(db_conn_error);

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
        echo '<td>'.$row_read['secondary_test_upload_testname'].'</td>';

echo '<td>'.date('M j Y g:i A', strtotime($row_read['secondary_test_upload_timestamp']. OFFSET_TIME)).'</td>';




echo '<td>
    <div class="d-flex align-items-center">';
	echo'
	<a href="../../incs-storage/assignments/'.$row_read['secondary_test_upload_filename'].'" download="'.$row_read['secondary_test_upload_testname'].'">Download</a>
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



