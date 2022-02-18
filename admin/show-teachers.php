<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){      //If you are not admin
	header('Location:'.GEN_WEBSITE.'/admin');
    exit();
}

if($_SESSION['admin_type'] != HEADMASTER){      // if not headmaster
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();
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
                    <h4 class="card-title">Primary school teachers</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                         
                            <th> Fullname </th>
                            <th> Email address </th>
                            <th> Gender </th>
                            <th> Age </th>
                            <th>Qualification </th>
                            <th>Date started</th>
                        </tr>
                        </thead>
                        <tbody>




           
           <?php
include ('../../incs-arahman/paginate.php');
$statement = "primary_teachers ORDER BY primary_teacher_id ASC";
           
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 1;
            $per_page = 15; 		// Set how many records do you want to display per page. Image alt tag to be put too
            $startpoint = ($page * $per_page) - $per_page;
            $results = mysqli_query($connect,"SELECT primary_teacher_id, primary_teacher_firstname, primary_teacher_surname, primary_teacher_email, primary_teacher_sex, primary_teacher_age, primary_teacher_qualification, primary_teacher_image FROM primary_teachers ORDER BY primary_teacher_id ASC LIMIT $startpoint, $per_page") or die(db_conn_error);
            
            if (mysqli_num_rows($results) != 0){
                while ($row = mysqli_fetch_array($results)) {
                    echo '<tr>
                    <td>
                    <img src="'.GEN_WEBSITE.'/admin/teachers/'.$row['primary_teacher_image'].'" alt="'.$row['primary_teacher_firstname'].'"/>    
                    <span class="ps-2">'.$row['primary_teacher_firstname']." ".$row['primary_teacher_surname'].'</span>
                  </td>
                    
                    <td>'.$row['primary_teacher_email'].'</td>
                    <td>'.$row['primary_teacher_sex'].'</td>
                    <td>'.$row['primary_teacher_age'].'</td>
                    <td>'.$row['primary_teacher_qualification'].'</td>
                    <td> 04 Dec 2019 </td>
                    <td>
                    <form action="'.GEN_WEBSITE.'/admin/edit-teacher-data.php" method="POST">
                   
                    <button type="submit" class="btn btn-success me-2" name="edit_teacher_data">Edit</button>
                    </form>
                   </td>

                   <td>
                    <form action="" method="POST">
                   
                    <button type="submit" class="btn btn-danger me-2" name="ban_teacher">Ban</button>
                    </form>
                    </td>
                   

                </tr>';

                  }
            }else{
                echo '<h3 class="text-center">No result found</h3>';
            } 

           ?>
            </tbody>
                      </table>
                      
                    </div>
                    
                  </div>
                  <nav aria-label="Page navigation example"> <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE."/admin/show-teachers.php?");?> </nav>
                </div>
              </div>
            </div>
         
           
            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>


           



              