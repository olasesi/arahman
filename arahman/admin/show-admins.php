<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){      //If you are not admin
	header('Location:'.GEN_WEBSITE.'/admin');
    exit();
}

if($_SESSION['admin_type'] != OWNER){      // if not headmaster
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}

?>

<?php
 //This is for banning and unbanning 
 if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['ban_admin'])){
    mysqli_query($connect, "UPDATE admin SET admin_active = '0' WHERE admin_active  = '1' AND admin_id = '".$_POST['ban_admin']."'") or die(db_conn_error);

  }elseif($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['unban_admin'])){
    mysqli_query($connect, "UPDATE admin SET admin_active = '1' WHERE admin_active  = '0' AND admin_id = '".$_POST['unban_admin']."'") or die(db_conn_error);

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
                    <h4 class="card-title">School admins</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                         
                            <th> Post </th>
                            <th> Post number </th>
                            <th> Username </th>
                            <th> Status </th>
                            <th>Date added</th>
                        </tr>
                        </thead>
                        <tbody>




           
           <?php
include ('../../incs-arahman/paginate.php');
$statement = "admin ORDER BY admin_id ASC";
           
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 10;
          		// Set how many records do you want to display per page. Image alt tag to be put too
            $startpoint = ($page * $per_page) - $per_page;
            $results = mysqli_query($connect,"SELECT admin_id, admin_active, type, admin_firstname, admin_firstname, admin_lastname, admin_email, admin_timestamp FROM admin ORDER BY admin_id ASC LIMIT $startpoint, $per_page") or die(db_conn_error);
            
            if (mysqli_num_rows($results) != 0){
                while ($row = mysqli_fetch_array($results)) {
                    $active = ($row['admin_active'] == 1)?'active':'inactive'; 
                    echo '<tr>
                    <td>
                    <i class="mdi mdi-account-outline"></i>    
                    <span class="ps-2">'.$row['type'].'</span>
                  </td>
                    
                    <td>'.$row['admin_firstname'].' '.$row['admin_lastname'].'</td>
                    <td>'.$row['admin_email'].'</td>
                    <td>'.$active.'</td>
                    <td>'.date('M j Y g:i A', strtotime($row['admin_timestamp'])).'</td>
                   
                    <td>
                    <form action="'.GEN_WEBSITE.'/admin/edit-admin-password.php" method="GET">
                   
                    <button type="submit" class="btn btn-success me-2" name="password_change" value="'.$row['admin_id'].'">Change password</button>
                    </form>
                   </td>

                   <td>';
                   
if($row['type'] != 'owner'){
    if($row['admin_active'] == 1){

                  echo  '<form action="" method="POST">
                   
                    <button type="submit" class="btn btn-danger me-2" value="'.$row['admin_id'].'" name="ban_admin">Ban</button>
                    </form>';


}elseif($row['admin_active'] == 0){


    echo  '<form action="" method="POST">
                   
    <button type="submit" class="btn btn-danger me-2" value="'.$row['admin_id'].'" name="unban_admin">Unban</button>
    </form>';

}
}


                   echo'
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
                  <nav aria-label="Page navigation example"> <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE."/admin/show-admins.php?");?> </nav>
                </div>
              </div>
            </div>
         
           
            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>


           



              