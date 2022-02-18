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
if(!isset($_GET['students_name']) || !isset($_GET['search_button'])){
$_GET['students_name']= ""; 
}

include_once ('../../incs-arahman/paginate.php');
$statement = "primary_school_students, primary_school_classes WHERE (primary_class_id = pri_class_id) AND primary_class_id = '".$_SESSION['primary_teacher_class_id']."' AND (pri_firstname LIKE '%".mysqli_real_escape_string ($connect,$_GET['students_name'])."%' OR pri_surname LIKE '%".mysqli_real_escape_string ($connect,$_GET['students_name'])."%') ORDER BY primary_id DESC"; 

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 1;
            $per_page = 12; 		
            $startpoint = ($page * $per_page) - $per_page;
           
            $results = mysqli_query($connect,"SELECT DISTINCT primary_id, pri_active, pri_year, pri_firstname, pri_surname, pri_age, pri_sex, pri_email, pri_photo, pri_phone, pri_address, primary_class FROM ".$statement." LIMIT $startpoint, $per_page") or die(db_conn_error);
            

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
                                                        <img style="width:200px; height:200px;" src="../admin/students/'.$array_result['pri_photo'].'" alt="'.$array_result['pri_firstname'].'">
                                                    </figure>
                                                </div>
                                               
                                               
                                                <div class="col-md-8 col-lg-12">
                                                    <h5 class="text-white text-center text-md-center">
														'.$array_result['pri_firstname'].' '.$array_result['pri_surname'].'</h5>
                                                    <p class="text-white text-center text-md-center">'.$array_result['pri_email'].'</p>
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
                                                            <p class="text-white">'.$array_result['pri_year'].'</p>
															<p class="text-white">'.$array_result['pri_age'].'</p>
															<p class="text-white">'.$array_result['pri_sex'].'</p>
															<p class="text-white">'.$array_result['pri_phone'].'</p>
															<p class="text-white">'.$array_result['pri_address'].'</p>
															<p class="text-white">'.$array_result['primary_class'].'</p>
															
                                                           
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

                <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE.'/teachers/search-my-students.php?students_name='.$_GET['students_name'].'&'); ?>
			   
                <!-- content-wrapper ends -->
            <?php include_once("../../incs-arahman/footer-teacher-students.php"); ?>


