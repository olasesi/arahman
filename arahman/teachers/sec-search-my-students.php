<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
include("../../incs-arahman/sec_cookie_for_most_teachers.php");
?>
<?php
if(!isset($_SESSION['secondary_teacher_id'])){   //Not a teacher? Please leave
	header('Location:'.GEN_WEBSITE.'/teachers');
	exit();
}
?>

<?php
if(!isset($_GET['students_name']) || !isset($_GET['search_button'])){
$_GET['students_name']= ""; 
}

include_once ('../../incs-arahman/paginate.php');
$statement = "secondary_school_students, secondary_school_classes WHERE (secondary_class_id = sec_class_id AND sec_active_email = '1' AND sec_paid = '1' AND sec_admit = '1') AND secondary_class_id = '".$_SESSION['secondary_teacher_class_id']."' AND (sec_firstname LIKE '%".mysqli_real_escape_string ($connect,$_GET['students_name'])."%' OR sec_surname LIKE '%".mysqli_real_escape_string ($connect,$_GET['students_name'])."%') ORDER BY secondary_id DESC"; 

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 10;
        		
            $startpoint = ($page * $per_page) - $per_page;
           
            $results = mysqli_query($connect,"SELECT DISTINCT secondary_id, sec_active, sec_year, sec_firstname, sec_surname, sec_age, sec_sex, sec_email, sec_photo, sec_phone, sec_address, secondary_class FROM ".$statement." LIMIT $startpoint, $per_page") or die(db_conn_error);
            

?>


<?php include_once("../../incs-arahman/header-teacher-students.php");?>



            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">


                <?php
                
                if(mysqli_num_rows($results) != 0){
                while($array_result = mysqli_fetch_array($results)){
                echo'   
                <div class="row">
                       
                        <div class="col-md-12 col-xl-12">
                            <div class="row">
                              
                                <div class="col-md-12 ">
                                    <div class="card profile-card bg-gradient-primary">
                                        <div class="card-body">
                                            <div class="row align-items-center h-100">
                                               
                                            
                                            <div class="col-md-4 col-lg-12">
                                                    <figure class="avatar mx-auto mb-4 mb-md-0" style="width:200px; height:200px;">
                                                        <img style="width:200px; height:200px;" src="../admin/students/'.$array_result['sec_photo'].'" alt="'.$array_result['sec_firstname'].'">
                                                    </figure>
                                                </div>
                                               
                                               
                                                <div class="col-md-8 col-lg-12">
                                                    <h5 class="text-white text-center text-md-center">
														'.$array_result['sec_firstname'].' '.$array_result['sec_surname'].'</h5>
                                                    <p class="text-white text-center text-md-center">'.$array_result['sec_email'].'</p>
                                                    <div class="d-flex align-items-center justify-content-between info pt-2">
                                                        <div>
                                                            <p class="text-white font-weight-bold">Year started</p>
                                                           
															<p class="text-white font-weight-bold">Age</p>
															<p class="text-white font-weight-bold">Sex</p>
														 <p class="text-white font-weight-bold">Phone</p>
                                                            <p class="text-white font-weight-bold">Address</p>
                                                            <p class="text-white font-weight-bold">Class</p>
													
                                                        </div>
                                                        <div>
                                                            <p class="text-white">'.$array_result['sec_year'].'</p>
															<p class="text-white">'.$array_result['sec_age'].'</p>
															<p class="text-white">'.$array_result['sec_sex'].'</p>
															<p class="text-white">'.$array_result['sec_phone'].'</p>
															<p class="text-white">'.$array_result['sec_address'].'</p>
															<p class="text-white">'.$array_result['secondary_class'].'</p>
															
                                                           
                                                        </div>
													

 
													
													</div>
                                                </div>
                                        
                                        
                                        </div>
                                        
                                                </div>
                                    </div>
                                </div>



                                


                            </div>
                        </div>
                 </div>';
                
                }
                }else{
                    
                    echo ' <div class="row">
                       
                    <div class="col-md-12 col-xl-12">
                        <div class="row">
                          
                            <div class="col-md-12 ">
                                <div class="card profile-card bg-gradient-primary">
                                    <div class="card-body">
                                        <div class="row align-items-center h-100">
                                           

                                        <h5 class="text-white text-center text-md-center">
                                        No student in this Class</h5>

                                        
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div></div></div>
                                        
                                        
                                        ';

                }

?>





                    

                </div>

                <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE.'/teachers/sec-search-my-students.php?students_name='.$_GET['students_name'].'&'); ?>
			   
                <!-- content-wrapper ends -->
            <?php include_once("../../incs-arahman/footer-teacher-students.php"); ?>


