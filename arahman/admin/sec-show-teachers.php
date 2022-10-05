<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){      //If you are not admin
	header('Location:'.GEN_WEBSITE.'/admin');
    exit();
}

if($_SESSION['admin_type'] != PRINCIPAL){      // if not PRINCIPAL
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}

?>
<?php
//Forceful password change and logout of the admin by the super admin. The super admin wonts logged out immediately if he changes password
if($_SESSION['admin_type'] == PRINCIPAL || $_SESSION['admin_type'] == ACCOUNTANT || $_SESSION['admin_type'] == ADMISSION){


  $change_pass = mysqli_query($connect, "SELECT admin_password FROM admin WHERE admin_password != '".$_SESSION['admin_password']."' AND admin_id = '".$_SESSION['admin_user_id']."'") or die(mysqli_error($connect)); 

if(mysqli_num_rows($change_pass) == 1){
  mysqli_query($connect,"UPDATE admin SET admin_cookie_session = '' WHERE admin_id = '".$_SESSION['admin_user_id']."'") or die(mysqli_error($connect));	
  session_destroy();
  setcookie("admin_remember_me", "", time() - 31104000);		

header("Location:".GEN_WEBSITE."/admin");
exit();

}
}
?>


<?php require_once ('../../incs-arahman/dashboard.php');?>

  <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <!-- <div class="row">
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
            </div> -->

            <?php
if(isset($_GET['info-edited'])){
echo ' <div class="row ">
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
<label class="badge badge-success">You have successfully edited '.$_GET['info-edited'].'</label>
</div>
</div>
</div>
</div>';

$_GET = array();	
}


?>




            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Secondary school teachers</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                         
                            <th> Fullname </th>
                            <th> Email address </th>
                            <th> Gender </th>
                            <th> Age </th>
                            <th>Qualification </th>
                            <th>Class </th>
                            <th>Date started</th>
                        </tr>
                        </thead>
                        <tbody>




           
          <?php
            if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] == PRINCIPAL){
  
              if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['ban_teacher'])){
                mysqli_query($connect, "UPDATE secondary_teachers SET secondary_teacher_active = '0', 	secondary_teacher_cookie = '' WHERE secondary_teacher_active = '1' AND secondary_teacher_id = '".$_POST['ban_teacher']."'") or die(mysqli_error($connect));

              }elseif($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['unban_teacher'])){
                mysqli_query($connect, "UPDATE secondary_teachers SET secondary_teacher_active = '1' WHERE  secondary_teacher_active = '0' AND secondary_teacher_id = '".$_POST['unban_teacher']."'") or die(mysqli_error($connect));

              }
              // $results = mysqli_query($connect,"SELECT primary_teacher_id, primary_teacher_active,  primary_teacher_class_id, primary_teacher_firstname, primary_teacher_surname, primary_teacher_sex, primary_teacher_qualification, primary_class_id, primary_class FROM primary_teachers, primary_school_classes WHERE primary_class_id = primary_teacher_class_id ORDER BY primary_teacher_id ASC LIMIT 3") or die(mysqli_error($connect)); 

              include ('../../incs-arahman/paginate.php');
              $statement = "secondary_teachers INNER JOIN secondary_school_classes ON secondary_class_id =  secondary_teacher_class_id ORDER BY secondary_teacher_id ASC";
                        
              $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
              if ($page <= 0) $page = 10;
               	// Set how many records do you want to display per page. Image alt tag to be put too
                $startpoint = ($page * $per_page) - $per_page;
                $results = mysqli_query($connect,"SELECT secondary_class, secondary_class_id, secondary_teacher_timestamp, secondary_teacher_id, secondary_teacher_active, secondary_teacher_firstname, secondary_teacher_surname, secondary_teacher_email, secondary_teacher_sex, secondary_teacher_age, secondary_teacher_qualification, secondary_teacher_image FROM ".$statement." LIMIT $startpoint, $per_page") or die(mysqli_error($connect));
                
              if (mysqli_num_rows($results) != 0){
                while ($row = mysqli_fetch_array($results)) {
                  echo '
                  <tr>
                    <td>
                      <img src="'.GEN_WEBSITE.'/admin/teachers/'.$row['secondary_teacher_image'].'" alt="'.$row['secondary_teacher_firstname'].'"/>    
                      <span class="ps-2">'.$row['secondary_teacher_firstname']." ".$row['secondary_teacher_surname'].'</span>
                    </td>
                    
                    <td>'.$row['secondary_teacher_email'].'</td>
                    <td>'.$row['secondary_teacher_sex'].'</td>
                    <td>'.$row['secondary_teacher_age'].'</td>
                    <td>'.$row['secondary_teacher_qualification'].'</td>
                    <td>'.$row['secondary_class'].'</td>
                    <td> '.date('M j Y g:i A', strtotime($row['secondary_teacher_timestamp'])).'</td>

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
                  </tr>';
                }
              } else{
                echo '<h3 class="text-center">No result found</h3>';
              } 
            }
          ?>
            </tbody>
                      </table>
                      
                    </div>
                    
                  </div>
                  <nav aria-label="Page navigation example"> <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE."/admin/sec-show-teachers.php?");?> </nav>
                </div>
              </div>
            </div>
         
           
            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>


           



              