<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');
//$testtime = mysqli_query($connect, "SELECT CURRENT_TIMESTAMP() AS real_time");
//while($row = mysqli_fetch_array($testtime)){
//echo $row['real_time'];
//mysqli_query($connect, "DELETE FROM primary_school_students WHERE pri_active_email ='0' AND ") or die(db_conn_error);
//}
// $no_many_copy = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end WHERE choose_term = '".$chooseterm."' AND school_session = '".$pri_session."'") or die(db_conn_error);
// 
    

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header("Location:".GEN_WEBSITE.'/admin');
	exit();
}
?>
<?php
$query = mysqli_query($connect, "DELETE FROM secondary_school_students WHERE sec_timestamp < '".date("Y-m-d H:i:s", strtotime("-48 hours"))."' AND sec_active_email='0'") or die(db_conn_error);
?>
<?php
$query = mysqli_query($connect, "DELETE FROM primary_school_students WHERE pri_timestamp < '".date("Y-m-d H:i:s", strtotime("-48 hours"))."' AND pri_active_email='0'") or die(db_conn_error);
?>
<?php
//Forceful logout of the admin by the super admin
//Forceful password change and logout of the admin by the super admin. The super admin wonts logged out immediately if he changes password
include("../../incs-arahman/change-admin-pass.php");
?>

<?php require_once ('../../incs-arahman/dashboard.php');?>


        
        
        
        
        
        
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
           

            <?php
            $query = mysqli_query($connect, "SELECT primary_id FROM primary_school_students WHERE pri_admit = '1' AND pri_active_email = '1' AND pri_paid = '1'") or die(db_conn_error);  ?>
            
            <div class="row">
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><?=mysqli_num_rows($query)?></h3>
                          <p class="text-success ms-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Primary sch. students<br>(Paid in full or part)</h6>
                  </div>
                </div>
              </div>
          <?php $query_pri_sch = mysqli_query($connect, "SELECT primary_teacher_id FROM primary_teachers") or die(db_conn_error); ?>
              
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><?=mysqli_num_rows($query_pri_sch)?></h3>
                          <p class="text-success ms-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Primary sch. teachers</h6>
                  </div>
                </div>
              </div>
              <?php $query_sec = mysqli_query($connect, "SELECT secondary_id FROM secondary_school_students WHERE sec_admit = '1' AND sec_active_email = '1' AND sec_paid = '1'") or die(db_conn_error);  ?>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><?=mysqli_num_rows($query_sec)?></h3>
                          <p class="text-danger ms-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                      <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Secondary sch. students<br>(Paid in full or part)</h6>
                  </div>
                </div>
              </div>

              <?php 
              $query_sec_sch = mysqli_query($connect, "SELECT secondary_teacher_id FROM secondary_teachers") or die(db_conn_error);  ?>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><?=mysqli_num_rows($query_sec_sch)?></h3>
                          <p class="text-success ms-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Secondary sch. teachers</h6>
                  </div>
                </div>
              </div>
            </div>

            <?php    
              if((isset($_SESSION['admin_active'])) AND ($_SESSION['admin_type'] == OWNER || $_SESSION['admin_type'] == ACCOUNTANT )){?>
           <div class="row">
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                  
                                    <h3 class="mb-0">
                                    <?php

                                    
                            $find = mysqli_query ($connect,"SELECT * FROM primary_school_students WHERE pri_active_email = '1' AND pri_admit = '1' AND pri_paid = '0'") or die(db_conn_error);

                                    echo mysqli_num_rows($find);
                                    ?>
                                    </h3>
                                  
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Admitted Students <br>Not paid for the term (pri)</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">
                                    <?php



                            $find = mysqli_query ($connect,"SELECT * FROM primary_payment WHERE primary_payment_paid_percent = '100' AND primary_payment_completion_status = '1' AND primary_payment_term = '".$the_term."' AND primary_payment_session = '".$the_session."'") or die(db_conn_error);

                                   echo mysqli_num_rows($find);
                                  
                                    ?>    

                                  </h3>
                                    
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Fully Paid students<br> for the term(pri)</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">
                                     <?php 
                           
                           
                           $find = mysqli_query ($connect,"SELECT * FROM secondary_school_students WHERE sec_active_email = '1' AND sec_admit = '1' AND sec_paid = '0'") or die(db_conn_error);

                                echo  mysqli_num_rows($find);
                                    
                           
                           
                           
                           
                          
                                    ?>    
 
                                </h3>
                                   
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Admitted Students Not paid for the term (sec)</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">
                                     <?php   
                                    $find = mysqli_query ($connect,"SELECT * FROM secondary_payment WHERE secondary_payment_paid_percent = '100' AND secondary_payment_completion_status = '1' AND secondary_payment_term = '".$the_term."' AND secondary_payment_session = '".$the_session."'") or die(db_conn_error);

echo mysqli_num_rows($find);
?>

                                    </h3>
                                   
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Fully Paid students
for the term(sec)</h6>
                            </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                  
                                    <h3 class="mb-0">
                                    <?php

 


                                    $find = mysqli_query ($connect,"SELECT * FROM primary_payment WHERE (primary_payment_paid_percent != '100' AND primary_payment_completion_status = '0') AND (primary_payment_session != '".$the_session."' OR primary_payment_term != '".$the_term."')") or die(db_conn_error);


echo mysqli_num_rows ($find);


                                    ?>
                                    </h3>
                                  
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Students <br>With Outstanding from previous(pri)</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">
                                    <?php
                           $find = mysqli_query ($connect,"SELECT DISTINCT module_students FROM module_join_students ") or die(db_conn_error);

                                   
                                    echo mysqli_num_rows($find);
                                    ?>    

                                  </h3>
                                    
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Students<br> with at least one module(Pri)</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">
                                    <?php
  
                             $find = mysqli_query ($connect,"SELECT * FROM secondary_payment WHERE (secondary_payment_paid_percent != '100' AND secondary_payment_completion_status = '0') AND (secondary_payment_session != '".$the_session."' OR secondary_payment_term != '".$the_term."')") or die(db_conn_error);

                            
                             echo mysqli_num_rows($find); 
                             
                                    ?>    

                                    </h3>
                                   
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Students
With Outstanding from previous(sec)</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">
                                    <?php
                           $find = mysqli_query ($connect,"SELECT DISTINCT secondary_module_students FROM secondary_module_join_students") or die(db_conn_error);

                                    echo mysqli_num_rows($find);
                                    ?>       
                                  
                                    </h3>
                                   
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Students
with at least one module(Sec)</h6>
                            </div>
                            </div>
                        </div>
                    </div>





                    <?php }?>





















            <div class="row">
              <!-- <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Students Population</h4>
                    <canvas id="transaction-history" class="transaction-chart"></canvas>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1 text-success">Primary school for Green</h6>
                        <p class="text-muted mb-0"></p>
                      </div>
                      <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0"></h6>
                      </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1 text-danger">Secondary school for Red</h6>
                        <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
                      </div>
                      <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">$593</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->







              
            
        <?php    
              if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == ADMISSION){



                $results = mysqli_query($connect,"SELECT pri_firstname, pri_surname, pri_email, pri_phone FROM primary_school_students  WHERE pri_paid = '0' AND pri_admit = '0' AND pri_active_email = '1' ORDER BY primary_id DESC LIMIT 5") or die(db_conn_error); // Sec. students will be added to the select lists later.
                
                echo '<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Registered students (Primary)</h4>
                      <p class="text-muted mb-1">Other details</p>
                      
                    </div>';


                if (mysqli_num_rows($results) >= 1 && mysqli_num_rows($results) <= 5){
                   
                              
                  
                        if(mysqli_num_rows($results) >= 1 AND mysqli_num_rows($results) <= 5){
                              while ($row = mysqli_fetch_array($results)){
                            
                            
                                echo '<div class="row">
                                  <div class="col-12">
                                    <div class="preview-list">
                                      <div class="preview-item border-bottom">
                                        <div class="preview-thumbnail">
                                          <div class="preview-icon bg-primary">
                                            <i class="mdi mdi-account-card-details"></i>
                                          </div>
                                        </div>
                                        <div class="preview-item-content d-sm-flex flex-grow">
                                          <div class="flex-grow">
                                            <h6 class="preview-subject">'.$row['pri_surname'].' '.$row['pri_firstname'].'</h6>
                                            <p class="text-muted mb-0">'.$row['pri_email'].'</p>
                                          </div>
                                          <div class="me-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted"></p>
                                            
                                            <p class="text-muted mb-0">'.$row['pri_phone'].'</p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>';
                            
                            
                            
                                
                              
                              
                            }
                                              }elseif(mysqli_num_rows($results) > 5){
                                        echo '<div class="row">
                                        <div class="col-12">
                                          <div class="preview-list">
                                            <div class="preview-item border-bottom">
                                              <div class="preview-thumbnail">
                                              </div>
                                              <div class="preview-item-content d-sm-flex flex-grow">
                                                <div class="flex-grow">
                                                  <h6 class="preview-subject"></h6>
                                                  <p class="text-muted mb-0"></p>
                                                </div>
                                                <div class="me-auto text-sm-right pt-2 pt-sm-0">
                                                  <p class="text-muted text-center"><a href="'.GEN_WEBSITE.'/admin/pri-registered.php">See more...</a></p>
                                                  <p class="text-muted mb-0"></p>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>';
                                }

               

                }elseif(mysqli_num_rows($results) == 0){
                  
                  echo '<h3 class="text-center">No result found</h3>';
                } 

                if(mysqli_num_rows($results) >= 0){               
                echo '<form action="pri-registered.php" method="POST"><button type="submit" class="btn btn-warning btn-fw"> See more</button></form>';
              }
            echo '  </div>
            </div>
            </div>
            ';








            $results = mysqli_query($connect,"SELECT sec_firstname, sec_surname, sec_email, sec_phone FROM secondary_school_students  WHERE sec_paid = '0' AND sec_admit = '0' AND sec_active_email = '1' ORDER BY secondary_id DESC LIMIT 5") or die(db_conn_error); // Sec. students will be added to the select lists later.
                
            echo '<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                  <h4 class="card-title mb-1">Registered students (Secondary)</h4>
                  <p class="text-muted mb-1">Other details</p>
                  
                </div>';


            if (mysqli_num_rows($results) >= 1 && mysqli_num_rows($results) <= 5){
               
                          
              
                    if(mysqli_num_rows($results) >= 1 AND mysqli_num_rows($results) <= 5){
                          while ($row = mysqli_fetch_array($results)){
                        
                        
                            echo '<div class="row">
                              <div class="col-12">
                                <div class="preview-list">
                                  <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                      <div class="preview-icon bg-primary">
                                        <i class="mdi mdi-account-card-details"></i>
                                      </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                      <div class="flex-grow">
                                        <h6 class="preview-subject">'.$row['sec_surname'].' '.$row['sec_firstname'].'</h6>
                                        <p class="text-muted mb-0">'.$row['sec_email'].'</p>
                                      </div>
                                      <div class="me-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted"></p>
                                        
                                        <p class="text-muted mb-0">'.$row['sec_phone'].'</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>';
                        
                        
                        
                            
                          
                          
                        }
                                          }elseif(mysqli_num_rows($results) > 5){
                                    echo '<div class="row">
                                    <div class="col-12">
                                      <div class="preview-list">
                                        <div class="preview-item border-bottom">
                                          <div class="preview-thumbnail">
                                          </div>
                                          <div class="preview-item-content d-sm-flex flex-grow">
                                            <div class="flex-grow">
                                              <h6 class="preview-subject"></h6>
                                              <p class="text-muted mb-0"></p>
                                            </div>
                                            <div class="me-auto text-sm-right pt-2 pt-sm-0">
                                              <p class="text-muted text-center"><a href="'.GEN_WEBSITE.'/admin/sec-registered.php">See more...</a></p>
                                              <p class="text-muted mb-0"></p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>';
                            }

           

            }elseif(mysqli_num_rows($results) == 0){
              
              echo '<h3 class="text-center">No result found</h3>';
            } 

            if(mysqli_num_rows($results) >= 0){               
            echo '<form action="sec-registered.php" method="POST"><button type="submit" class="btn btn-warning btn-fw"> See more</button></form>';
          }
        echo '  </div>
        </div>
        </div>
        ';

}











 




              
              ?>
           
           <?php    
              if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == ACCOUNTANT){



                $results = mysqli_query($connect,"SELECT primary_payment_paid_percent, primary_id, pri_firstname, pri_surname, primary_class FROM primary_school_students INNER JOIN primary_school_classes ON primary_class_id = primary_id INNER JOIN primary_payment ON primary_payment_students_id = primary_id WHERE pri_paid = '1' AND pri_admit = '1' AND pri_active_email = '1' ORDER BY primary_id DESC LIMIT 5") or die(db_conn_error); // Sec. students will be added to the select lists later.
                
                echo '<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Paid students (Primary)</h4>
                      <p class="text-muted mb-1"></p>
                    </div>';


                if (mysqli_num_rows($results) >= 1 && mysqli_num_rows($results) <= 5){
                   
                  if(mysqli_num_rows($results) >= 1 AND mysqli_num_rows($results) <= 5){
                  while ($row = mysqli_fetch_array($results)){
                 
                
                    echo '<div class="row">
                      <div class="col-12">
                        <div class="preview-list">
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-primary">
                                <i class="mdi mdi-file-document"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">'.$row['pri_surname'].' '.$row['pri_firstname'].'</h6>
                                <p class="text-muted mb-0">'.$row['primary_class'].'</p>
                              </div>
                              <div class="me-auto text-sm-right pt-2 pt-sm-0">
                              <div class="badge badge-outline-success">'.$row['primary_payment_paid_percent'].'%</div>
                                <p class="text-muted mb-0"></p>
                              </div>
                            </div>
                          </div>
                         </div>
                      </div>
                    </div>';
                
                
                
                    
                   
                }
              }elseif(mysqli_num_rows($results) > 5){
                 echo '<div class="row">
                <div class="col-12">
                  <div class="preview-list">
                    <div class="preview-item border-bottom">
                      <div class="preview-thumbnail">
                       </div>
                      <div class="preview-item-content d-sm-flex flex-grow">
                        <div class="flex-grow">
                          <h6 class="preview-subject"></h6>
                          <p class="text-muted mb-0"></p>
                        </div>
                        <div class="me-auto text-sm-right pt-2 pt-sm-0">
                          <p class="text-muted text-center"><a href="'.GEN_WEBSITE.'/admin/search-paid.php?search-paid=&button-paid_students=">See more</a></p>
                          <p class="text-muted mb-0"></p>
                        </div>
                      </div>
                    </div>
                   </div>
                </div>
              </div>';
}

               

                }elseif(mysqli_num_rows($results) == 0){
                  
                  echo '<h3 class="text-center">No result found</h3>';
                } 

                if(mysqli_num_rows($results) >= 0){               
                  echo '<form action="'.GEN_WEBSITE.'/admin/search-paid.php?search-paid=&button-paid_students=" method="POST"><button type="submit" class="btn btn-warning btn-fw"> See more</button></form>';
                }

echo '  </div>
</div>
</div>
';








$results = mysqli_query($connect,"SELECT secondary_payment_paid_percent, secondary_id, sec_firstname, sec_surname, secondary_class FROM secondary_school_students INNER JOIN secondary_school_classes ON secondary_class_id = secondary_id INNER JOIN secondary_payment ON secondary_payment_students_id = secondary_id WHERE sec_paid = '1' AND sec_admit = '1' AND sec_active_email = '1' ORDER BY secondary_id DESC LIMIT 5") or die(db_conn_error); // Sec. students will be added to the select lists later.
                
echo '<div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <div class="d-flex flex-row justify-content-between">
      <h4 class="card-title mb-1">Paid students (Secondary)</h4>
      <p class="text-muted mb-1"></p>
    </div>';


if (mysqli_num_rows($results) >= 1 && mysqli_num_rows($results) <= 5){
   
  if(mysqli_num_rows($results) >= 1 AND mysqli_num_rows($results) <= 5){
  while ($row = mysqli_fetch_array($results)){
 

    echo '<div class="row">
      <div class="col-12">
        <div class="preview-list">
          <div class="preview-item border-bottom">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-primary">
                <i class="mdi mdi-file-document"></i>
              </div>
            </div>
            <div class="preview-item-content d-sm-flex flex-grow">
              <div class="flex-grow">
                <h6 class="preview-subject">'.$row['sec_surname'].' '.$row['sec_firstname'].'</h6>
                <p class="text-muted mb-0">'.$row['secondary_class'].'</p>
              </div>
              <div class="me-auto text-sm-right pt-2 pt-sm-0">
              <div class="badge badge-outline-success">'.$row['secondary_payment_paid_percent'].'%</div>
                <p class="text-muted mb-0"></p>
              </div>
            </div>
          </div>
         </div>
      </div>
    </div>';



    
   
}
}elseif(mysqli_num_rows($results) > 5){
 echo '<div class="row">
<div class="col-12">
  <div class="preview-list">
    <div class="preview-item border-bottom">
      <div class="preview-thumbnail">
       </div>
      <div class="preview-item-content d-sm-flex flex-grow">
        <div class="flex-grow">
          <h6 class="preview-subject"></h6>
          <p class="text-muted mb-0"></p>
        </div>
        <div class="me-auto text-sm-right pt-2 pt-sm-0">
          <p class="text-muted text-center"><a href="'.GEN_WEBSITE.'/admin/sec-search-paid.php?search-paid-sec=&button-paid_students-sec=">See more</a></p>
          <p class="text-muted mb-0"></p>
        </div>
      </div>
    </div>
   </div>
</div>
</div>';
}



}elseif(mysqli_num_rows($results) == 0){
  
  echo '<h3 class="text-center">No result found</h3>';
} 

if(mysqli_num_rows($results) >= 0){               
  echo '<form action="'.GEN_WEBSITE.'/admin/sec-search-paid.php?search-paid-sec=&button-paid_students-sec=" method="POST"><button type="submit" class="btn btn-warning btn-fw"> See more</button></form>';
}

echo '  </div>
</div>
</div>
';







 }
              
              ?>
           




           <?php    
              if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == OWNER){



                $results = mysqli_query($connect,"SELECT type, admin_firstname, admin_lastname FROM admin ORDER BY admin_id ASC LIMIT 5") or die(db_conn_error); 
                echo '<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Admins</h4>
                      <p class="text-muted mb-1">Admin post</p>
                    </div>';


              
                 


                    if (mysqli_num_rows($results) >= 1 && mysqli_num_rows($results) <= 5){
                   
                      if(mysqli_num_rows($results) >= 1 AND mysqli_num_rows($results) <= 5){
                      while ($row = mysqli_fetch_array($results)){
                
                    echo '<div class="row">
                      <div class="col-12">
                      
                        <div class="preview-list">
                      

                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-primary">
                                <i class="mdi mdi-account-outline"></i>
                              </div>
                            </div>

                     
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                              <a href="'.GEN_WEBSITE.'/admin/show-admins.php" style="text-decoration:none;"><h6 class="preview-subject">'.$row['admin_firstname'].' '.$row['admin_lastname'].'</h6>  </a>
                                
                              </div>
                              <div class="me-auto text-sm-right pt-2 pt-sm-0">

                              <p class="text-muted mb-0">'.$row['type'].'</p>
                              </div>
                             
                            </div>
                          
                          </div>
                         </div>
                      </div>
                    </div>';
                
                
                
                    
                   
                  
                }
                }elseif(mysqli_num_rows($results) > 5){
                  
                  echo '<div class="row">
                <div class="col-12">
                  <div class="preview-list">
                    <div class="preview-item border-bottom">
                      <div class="preview-thumbnail">
                       </div>
                      <div class="preview-item-content d-sm-flex flex-grow">
                        <div class="flex-grow">
                          <h6 class="preview-subject"></h6>
                          <p class="text-muted mb-0"></p>
                        </div>
                        <div class="me-auto text-sm-right pt-2 pt-sm-0">
                          <p class="text-muted text-center"><a href="'.GEN_WEBSITE.'/admin/show-admins.php">See more...</a></p>
                          <p class="text-muted mb-0"></p>
                        </div>
                      </div>
                    </div>
                   </div>
                </div>
              </div>';
                } 

              }elseif(mysqli_num_rows($results) == 0){
                  
                echo '<h3 class="text-center">No result found</h3>';
              } 

              if(mysqli_num_rows($results) >= 0){               
                echo '<form action="show-admins.php" method="POST"><button type="submit" class="btn btn-warning btn-fw"> More details..</button></form>';
              }


echo '</div>
</div>
</div>
';

 }
              
              ?>    
           
            <?php    
              if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == HEADMASTER){
                
                if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['ban_teacher'])){
                  mysqli_query($connect, "UPDATE primary_teachers SET primary_teacher_active = '0', primary_teacher_cookie = '' WHERE primary_teacher_active = '1' AND primary_teacher_id = '".$_POST['ban_teacher']."'") or die(db_conn_error);

                }elseif($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['unban_teacher'])){
                  mysqli_query($connect, "UPDATE primary_teachers SET primary_teacher_active = '1' WHERE  primary_teacher_active = '0' AND primary_teacher_id = '".$_POST['unban_teacher']."'") or die(db_conn_error);

                }

                $results = mysqli_query($connect,"SELECT primary_teacher_id, primary_teacher_active,  primary_teacher_class_id, primary_teacher_firstname, primary_teacher_surname, primary_teacher_sex, primary_teacher_qualification, primary_class_id, primary_class FROM primary_teachers, primary_school_classes WHERE primary_class_id =	primary_teacher_class_id ORDER BY primary_teacher_id DESC LIMIT 5") or die(db_conn_error); 
                
                 
                
                echo '<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Primary School teachers</h4>
                      <p class="text-muted mb-1"></p>
                    </div>';

                    if (mysqli_num_rows($results) >= 1 && mysqli_num_rows($results) <= 5){

              
                      if(mysqli_num_rows($results) >= 1 AND mysqli_num_rows($results) <= 5){
                        while ($row = mysqli_fetch_array($results)){
                      
                    echo '
                    <div class="row">
                      <div class="col-12">
                        <div class="preview-list">
                          <a href="'.GEN_WEBSITE.'/admin/show-teachers.php" style="text-decoration:none; color:inherit;"><div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-primary">
                                <i class="mdi mdi-file-document"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">'.$row['primary_teacher_firstname'].' '.$row['primary_teacher_surname'].'</h6>
                                <p class="text-muted mb-0">'.$row['primary_class'].', '.$row['primary_teacher_sex'].'</p>
                              </div>
                            </div>

                            <td>
                              <form action="'.GEN_WEBSITE.'/admin/edit-teacher-data.php" method="GET">
                                <button type="submit" class="btn btn-success me-2" name="id" value="'.$row['primary_teacher_id'].'">Edit</button>
                              </form>
                            </td>
        
                            <td>';
                              if($row['primary_teacher_active'] == 1){
                                echo '
                                <form action="" method="POST">
                                  <button type="submit" class="btn btn-danger me-2" name="ban_teacher" value="'.$row['primary_teacher_id'].'">Ban</button>
                                </form>';
                              } elseif($row['primary_teacher_active'] == 0){
                                echo '
                                <form action="" method="POST">
                                  <button type="submit" class="btn btn-danger me-2" name="unban_teacher" value="'.$row['primary_teacher_id'].'">Unban</button>
                                </form>';
                              } 
                              echo  '
                            </td>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                    
                    
                    ';
                }
               
              

              }elseif(mysqli_num_rows($results) > 5){
                  echo '<div class="row">
                  <div class="col-12">
                    <div class="preview-list">
                      <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                         
                        </div>
                        <div class="preview-item-content d-sm-flex flex-grow">
                          <div class="flex-grow">
                           <a href="'.GEN_WEBSITE.'/admin/show-teachers.php"> <h6 class="preview-subject">See more...</h6></a>
                           
                          </div>
                          <div class="me-auto text-sm-right pt-2 pt-sm-0">
                           
                          </div>
                        </div>
                      </div>
                     </div>
                  </div>
                </div>';

                }

              }elseif(mysqli_num_rows($results) == 0){
                
                echo '<h3 class="text-center">No primary school teacher</h3>';
              } 
              if(mysqli_num_rows($results) >= 0){               
                echo '<form action="show-teachers.php" method="POST"><button type="submit" class="btn btn-warning btn-fw"> More details..</button></form>';
              }
              echo '  
              </div>
              </div>
              </div>
              ';

              }
              
            ?>

<?php    
              if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == PRINCIPAL){
                
                if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['ban_teacher'])){
                  mysqli_query($connect, "UPDATE secondary_teachers SET secondary_teacher_active = '0', secondary_teacher_cookie = '' WHERE secondary_teacher_active = '1' AND secondary_teacher_id = '".$_POST['ban_teacher']."'") or die(db_conn_error);

                }elseif($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['unban_teacher'])){
                  mysqli_query($connect, "UPDATE secondary_teachers SET secondary_teacher_active = '1' WHERE  secondary_teacher_active = '0' AND secondary_teacher_id = '".$_POST['unban_teacher']."'") or die(db_conn_error);

                }

                $results = mysqli_query($connect,"SELECT secondary_teacher_id, secondary_teacher_active,  secondary_teacher_class_id, secondary_teacher_firstname, secondary_teacher_surname, secondary_teacher_sex, secondary_teacher_qualification, secondary_class_id, secondary_class FROM secondary_teachers, secondary_school_classes WHERE secondary_class_id =	secondary_teacher_class_id ORDER BY secondary_teacher_id DESC LIMIT 5") or die(db_conn_error); 
                
                 
                
                echo '<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Secondary School teachers</h4>
                      <p class="text-muted mb-1"></p>
                    </div>';

                    if (mysqli_num_rows($results) >= 1 && mysqli_num_rows($results) <= 5){

              
                      if(mysqli_num_rows($results) >= 1 AND mysqli_num_rows($results) <= 5){
                        while ($row = mysqli_fetch_array($results)){
                      
                    echo '
                    <div class="row">
                      <div class="col-12">
                        <div class="preview-list">
                          <a href="'.GEN_WEBSITE.'/admin/sec-show-teachers.php" style="text-decoration:none; color:inherit;"><div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-primary">
                                <i class="mdi mdi-file-document"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">'.$row['secondary_teacher_firstname'].' '.$row['secondary_teacher_surname'].'</h6>
                                <p class="text-muted mb-0">'.$row['secondary_class'].', '.$row['secondary_teacher_sex'].'</p>
                              </div>
                            </div>

                            <td>
                              <form action="'.GEN_WEBSITE.'/admin/sec-edit-teacher-data.php" method="GET">
                                <button type="submit" class="btn btn-success me-2" name="id" value="'.$row['secondary_teacher_id'].'">Edit</button>
                              </form>
                            </td>
        
                            <td>';
                              if($row['secondary_teacher_active'] == 1){
                                echo '
                                <form action="" method="POST">
                                  <button type="submit" class="btn btn-danger me-2" name="ban_teacher" value="'.$row['secondary_teacher_id'].'">Ban</button>
                                </form>';
                              } elseif($row['secondary_teacher_active'] == 0){
                                echo '
                                <form action="" method="POST">
                                  <button type="submit" class="btn btn-danger me-2" name="unban_teacher" value="'.$row['secondary_teacher_id'].'">Unban</button>
                                </form>';
                              } 
                              echo  '
                            </td>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                    
                    
                    ';
                }
               
              

              }elseif(mysqli_num_rows($results) > 5){
                  echo '<div class="row">
                  <div class="col-12">
                    <div class="preview-list">
                      <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                         
                        </div>
                        <div class="preview-item-content d-sm-flex flex-grow">
                          <div class="flex-grow">
                           <a href="'.GEN_WEBSITE.'/admin/sec-show-teachers.php"> <h6 class="preview-subject">See more...</h6></a>
                           
                          </div>
                          <div class="me-auto text-sm-right pt-2 pt-sm-0">
                           
                          </div>
                        </div>
                      </div>
                     </div>
                  </div>
                </div>';

                }

              }elseif(mysqli_num_rows($results) == 0){
                
                echo '<h3 class="text-center">No secondary school teacher</h3>';
              } 
              if(mysqli_num_rows($results) >= 0){               
                echo '<form action="sec-show-teachers.php" method="POST"><button type="submit" class="btn btn-warning btn-fw"> More details..</button></form>';
              }
              echo '  
              </div>
              </div>
              </div>
              ';

              }
              
            ?>



            </div>

            <?php    
              if((isset($_SESSION['admin_active'])) AND ($_SESSION['admin_type'] == OWNER || $_SESSION['admin_type'] == ACCOUNTANT )){
           echo '<div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Revenue (pri)</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">&#8358;';
                          

                          
                          $find = mysqli_query ($connect,"SELECT primary_payment_fees, primary_payment_paid_percent FROM primary_payment WHERE primary_payment_session = '".$the_session."' AND primary_payment_term = '".$the_term."'") or die(db_conn_error);
                          
                 
            $sum = array();
                          while($result=mysqli_fetch_array ($find)){
                        $sum[] =   $result['primary_payment_fees'] * ($result['primary_payment_paid_percent']/100);

                         
                          }

                         echo number_format(array_sum($sum));

                          
                          echo '</h2>
                         
                        </div>
                        <h6 class="text-muted font-weight-normal">This term</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-cash text-primary ms-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total outstanding (pri)</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">&#8358;';
                          

                          $find = mysqli_query ($connect,"SELECT 	primary_payment_fees, primary_payment_paid_percent FROM primary_payment WHERE primary_payment_paid_percent != '100'") or die(db_conn_error);

$sum = array();
                          while($result=mysqli_fetch_array ($find)){
                          $sum[] = ($result['primary_payment_fees'] - ( $result['primary_payment_fees'] * ($result['primary_payment_paid_percent']/100)));

                         
                          }

                          echo number_format(array_sum($sum));

                          
                          echo '</h2>
                          <p class="text-success ms-2 mb-0 font-weight-medium"></p>
                        </div>
                        <h6 class="text-muted font-weight-normal"> </h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ms-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Module activities (Pri)</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">
                          &#8358;';
                          

                          $find = mysqli_query ($connect,"SELECT module_type_id FROM module_join_students") or die(db_conn_error);

$sum = array();
                          while($result=mysqli_fetch_array ($find)){

                            $find_price = mysqli_query ($connect,"SELECT DISTINCT module_price FROM module_price WHERE modules_id = '".$result['module_type_id']."' LIMIT 1") or die(db_conn_error);
                           
                            while($result_price=mysqli_fetch_array ($find_price)){
                              $sum[] = $result_price['module_price'];

                            }

                         

                         
                          }
                          echo number_format(array_sum($sum));
                         

                          
                          echo '
                          
                          </h2>
                          <p class="text-danger ms-2 mb-0 font-weight-medium"> </p>
                        </div>
                        <h6 class="text-muted font-weight-normal">This term</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ms-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>







              <div class="col-sm-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5>Revenue (Sec)</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <h2 class="mb-0">&#8358;';
                        

                        
                        $find = mysqli_query ($connect,"SELECT secondary_payment_fees, secondary_payment_paid_percent FROM secondary_payment WHERE secondary_payment_session = '".$the_session."' AND secondary_payment_term = '".$the_term."'") or die(db_conn_error);
                
                 
$sum = array();
                        while($result=mysqli_fetch_array ($find)){
                        $sum[] =  $result['secondary_payment_fees'] * ($result['secondary_payment_paid_percent']/100);

                       
                        }

                        echo number_format(array_sum($sum));

                        
                        echo '</h2>
                       
                      </div>
                      <h6 class="text-muted font-weight-normal">This term</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-cash text-primary ms-auto"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5>Total outstanding (Sec)</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <h2 class="mb-0">&#8358;';
                        

                        $find = mysqli_query ($connect,"SELECT 	secondary_payment_fees, secondary_payment_paid_percent FROM secondary_payment WHERE secondary_payment_paid_percent != '100'") or die(db_conn_error);

$sum = array();
                        while($result=mysqli_fetch_array ($find)){
                        $sum[] = ($result['secondary_payment_fees'] - ( $result['secondary_payment_fees'] * ($result['secondary_payment_paid_percent']/100)));

                       
                        }

                        echo number_format(array_sum($sum));

                        
                        echo '</h2>
                        <p class="text-success ms-2 mb-0 font-weight-medium"></p>
                      </div>
                      <h6 class="text-muted font-weight-normal"></h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-wallet-travel text-danger ms-auto"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5>Module activities (Sec)</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <h2 class="mb-0">
                        &#8358;';
              

                        $find = mysqli_query ($connect,"SELECT secondary_module_type_id FROM secondary_module_join_students") or die(db_conn_error);

$sum = array();
                        while($result=mysqli_fetch_array ($find)){

                         $find_price = mysqli_query ($connect,"SELECT DISTINCT secondary_module_price FROM secondary_module_price WHERE secondary_modules_id = '".$result['secondary_module_type_id']."' LIMIT 1") or die(db_conn_error);
                                                   
                                                    while($result_price=mysqli_fetch_array ($find_price)){
                                                      $sum[] = $result_price['secondary_module_price'];
                        
                                                    }
                        

                       
                        }
                        echo number_format(array_sum($sum));
                       

                        
                        echo '
                        
                        </h2>
                        <p class="text-danger ms-2 mb-0 font-weight-medium"> </p>
                      </div>
                      <h6 class="text-muted font-weight-normal">This term</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-monitor text-success ms-auto"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-sm-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h5>Common Entrance Payment(Sec)</h5>
                <div class="row">
                  <div class="col-8 col-sm-12 col-xl-8 my-auto">
                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                      <h2 class="mb-0">
                      &#8358;';
                      

                      $find = mysqli_query ($connect,"SELECT secondary_common_e_price FROM secondary_common_e") or die(db_conn_error);

$sum = array();
                      while($result=mysqli_fetch_array ($find)){
                      $sum[] = $result['secondary_common_e_price'];

                     
                      }
                      echo number_format(array_sum($sum));
                     

                      
                      echo '
                      
                      </h2>
                      <p class="text-danger ms-2 mb-0 font-weight-medium"> </p>
                    </div>
                    <h6 class="text-muted font-weight-normal">This term</h6>
                  </div>
                  <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                    <i class="icon-lg mdi mdi-cash text-success ms-auto"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
            
            
            
            
            
            </div>';
          
          
          
          
          
          }
            ?>


           
            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>

           
       