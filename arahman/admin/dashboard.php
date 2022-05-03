<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');
$testtime = mysqli_query($connect, "SELECT CURRENT_TIMESTAMP() AS real_time");
while($row = mysqli_fetch_array($testtime)){
echo $row['real_time'];
//mysqli_query($connect, "DELETE FROM primary_school_students WHERE pri_active_email ='0' AND ") or die(db_conn_error);
}
// $no_many_copy = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end WHERE choose_term = '".$chooseterm."' AND school_session = '".$pri_session."'") or die(db_conn_error);
// 
      

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header("Location:".GEN_WEBSITE.'/admin');
	exit();
}
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
                    <h6 class="text-muted font-weight-normal">Primary sch. students</h6>
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
                    <h6 class="text-muted font-weight-normal">Secondary sch. students</h6>
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
              if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == OWNER){?>
           <div class="row">
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                  
                                    <h3 class="mb-0">
                                    <?php
                            $find = mysqli_query ($connect,"SELECT count(*) AS total FROM primary_school_students WHERE pri_active_email = '1' AND pri_admit = '1'") or die(mysqli_error($connect));

                                    $result=mysqli_fetch_assoc ($find);
                                    echo $result['total'];
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
                                <h6 class="text-muted font-weight-normal">Admmitted Students <br>For the term</h6>
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
                            $find = mysqli_query ($connect,"SELECT count(*) AS total FROM primary_school_students WHERE pri_active_email = '1' AND pri_admit = '1' AND pri_paid = '1'") or die(mysqli_error($connect));

                                    $result=mysqli_fetch_assoc ($find);
                                    echo $result['total'];
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
                                <h6 class="text-muted font-weight-normal">Fully Paid students<br> for the term</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">12.34</h3>
                                   
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Previous outstanding</h6>
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
                                        
                                  
                                    </h3>
                                   
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Total Income</h6>
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
                            $find = mysqli_query ($connect,"SELECT count(*) AS total FROM primary_school_students WHERE pri_active_email = '1' AND pri_admit = '1'") or die(mysqli_error($connect));

                                    $result=mysqli_fetch_assoc ($find);
                                    echo $result['total'];
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
                                <h6 class="text-muted font-weight-normal">Admmitted Students <br>For the term</h6>
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
                            $find = mysqli_query ($connect,"SELECT count(*) AS total FROM primary_school_students WHERE pri_active_email = '1' AND pri_admit = '1' AND pri_paid = '1'") or die(mysqli_error($connect));

                                    $result=mysqli_fetch_assoc ($find);
                                    echo $result['total'];
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
                                <h6 class="text-muted font-weight-normal">Fully Paid students<br> for the term</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">12.34</h3>
                                   
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Previous outstanding</h6>
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
                                        
                                  
                                    </h3>
                                   
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Total Income</h6>
                            </div>
                            </div>
                        </div>
                    </div>





                    <?php }?>





















            <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Students Population</h4>
                    <canvas id="transaction-history" class="transaction-chart"></canvas>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1 text-success">Primary school for Green</h6>
                        <!--<p class="text-muted mb-0"></p>-->
                      </div>
                      <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0"></h6>
                      </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1 text-danger">Secondary school for Red</h6>
                        <!--<p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>-->
                      </div>
                      <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                       <!-- <h6 class="font-weight-bold mb-0">$593</h6>-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>







              
            
        <?php    
              if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == ADMISSION){



                $results = mysqli_query($connect,"SELECT pri_firstname, pri_surname, pri_email, pri_phone FROM primary_school_students WHERE pri_paid = '0' AND pri_admit = '0' AND pri_active_email = '1' ORDER BY primary_id ASC LIMIT 5") or die(db_conn_error); // Sec. students will be added to the select lists later.
                
                echo '<div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Registered students (Primary and Secondary)</h4>
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
                                                  <p class="text-muted text-center"><a href="'.GEN_WEBSITE.'/admin/search-paid.php">See more...</a></p>
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
                echo '<form action="show-registered.php" method="POST"><button type="submit" class="btn btn-warning btn-fw"> More details..</button></form>';
              }
            echo '  </div>
            </div>
            </div>
            ';

 }
              
              ?>
           
           <?php    
              if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == ACCOUNTANT){



                $results = mysqli_query($connect,"SELECT primary_payment_paid_percent, primary_id, pri_firstname, pri_surname, primary_class FROM primary_school_students INNER JOIN primary_school_classes ON primary_class_id = primary_id INNER JOIN primary_payment ON primary_payment_students_id = primary_id WHERE pri_paid = '1' AND pri_admit = '1' AND pri_active_email = '1' ORDER BY primary_id ASC LIMIT 5") or die(db_conn_error); // Sec. students will be added to the select lists later.
                
                echo '<div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Recently paid students</h4>
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
                          <p class="text-muted text-center"><a href="'.GEN_WEBSITE.'/admin/search-paid.php">See more...</a></p>
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
                  echo '<form action="show-registered.php" method="POST"><button type="submit" class="btn btn-warning btn-fw"> More details..</button></form>';
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
                echo '<div class="col-md-8 grid-margin stretch-card">
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
                                <i class="mdi mdi-file-document"></i>
                              </div>
                            </div>

                     
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                              <a href="'.GEN_WEBSITE.'/admin/show-admins.php"><h6 class="preview-subject">'.$row['admin_firstname'].' '.$row['admin_lastname'].'</h6>  </a>
                                
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

                $results = mysqli_query($connect,"SELECT primary_teacher_id, primary_teacher_active,  primary_teacher_class_id, primary_teacher_firstname, primary_teacher_surname, primary_teacher_sex, primary_teacher_qualification, primary_class_id, primary_class FROM primary_teachers, primary_school_classes WHERE primary_class =	primary_teacher_class_id ORDER BY primary_teacher_id DESC LIMIT 5") or die(db_conn_error); 
                
                 
                
                echo '<div class="col-md-8 grid-margin stretch-card">
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
                   mysqli_query($connect, "UPDATE primary_teachers SET primary_teacher_active = '0', primary_teacher_cookie = '' WHERE primary_teacher_active = '1' AND primary_teacher_id = '".$_POST['ban_teacher']."'") or die(db_conn_error);

                 }elseif($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['unban_teacher'])){
                   mysqli_query($connect, "UPDATE primary_teachers SET primary_teacher_active = '1' WHERE  primary_teacher_active = '0' AND primary_teacher_id = '".$_POST['unban_teacher']."'") or die(db_conn_error);

                 }

                 $results = mysqli_query($connect,"SELECT primary_teacher_id, primary_teacher_active, primary_teacher_class_id, primary_teacher_firstname, primary_teacher_surname, primary_teacher_sex, primary_teacher_qualification, primary_class_id, primary_class FROM primary_teachers, primary_school_classes WHERE primary_class =	primary_teacher_class_id ORDER BY primary_teacher_id DESC LIMIT 5") or die(db_conn_error); 
                
                 
                
                 echo '<div class="col-md-8 grid-margin stretch-card">
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
                
                 echo '<h3 class="text-center">No secondary school teacher</h3>';
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



            </div>

            <?php    
              if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == OWNER){
           echo '<div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Revenue</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">&#8358;0</h2>
                          <p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>
                        </div>
                        <h6 class="text-muted font-weight-normal">11.38% Since last month</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-codepen text-primary ms-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Sales</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">$45850</h2>
                          <p class="text-success ms-2 mb-0 font-weight-medium">+8.3%</p>
                        </div>
                        <h6 class="text-muted font-weight-normal"> 9.61% Since last month</h6>
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
                    <h5>Purchase</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">$2039</h2>
                          <p class="text-danger ms-2 mb-0 font-weight-medium">-2.1% </p>
                        </div>
                        <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ms-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>';}
            ?>

<?php    
              if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == ACCOUNTANT){
           echo '<div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Revenue</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">&#8358;0</h2>
                          <p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>
                        </div>
                        <h6 class="text-muted font-weight-normal">11.38% Since last month</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-codepen text-primary ms-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Sales</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">$45850</h2>
                          <p class="text-success ms-2 mb-0 font-weight-medium">+8.3%</p>
                        </div>
                        <h6 class="text-muted font-weight-normal"> 9.61% Since last month</h6>
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
                    <h5>Purchase</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">$2039</h2>
                          <p class="text-danger ms-2 mb-0 font-weight-medium">-2.1% </p>
                        </div>
                        <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ms-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>';}
            ?>
    
           
            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>

           
       