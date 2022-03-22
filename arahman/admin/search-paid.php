<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header("Location:/".GEN_WEBSITE.'/admin');
	exit();
}

if(isset($_SESSION['admin_active']) AND $_SESSION['admin_type'] != ACCOUNTANT){
	header("Location:/".GEN_WEBSITE.'/admin/dashboard.php');
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
if(isset($_GET['confirm'])){
echo ' <div class="row ">
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
<label class="badge badge-info">You have confirmed '.$_GET['confirm'].' admission.</label>
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
                    <h4 class="card-title">Recently paid</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                          <th> S/N </th>
                            <th> Firstname </th>
                            <th> Surname </th>
                            <th> Email address </th>
                            <th> Phone number </th>
                            <th> Payment status </th>
                            <th>Date paid </th>
                        </tr>
                        </thead>
                        <tbody>




           
           <?php
include ('../../incs-arahman/paginate.php');
$statement = "primary_school_students WHERE pri_paid = '1' AND pri_admit = '0' AND pri_active_email = '1' ORDER BY primary_id ASC";
           
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 1;
            $per_page = 15; 								// Set how many records do you want to display per page.
            $startpoint = ($page * $per_page) - $per_page;
            $results = mysqli_query($connect,"SELECT primary_id, pri_paid, pri_firstname, pri_surname, pri_email, pri_phone FROM primary_school_students WHERE pri_paid = '1' AND pri_admit = '0' AND pri_active_email = '1' ORDER BY primary_id ASC LIMIT $startpoint, $per_page") or die(db_conn_error);
            if (mysqli_num_rows($results) != 0){
                while ($row = mysqli_fetch_array($results)) {
                    echo '<tr>
                    <td> 1 </td>
                    <td>'.$row['pri_firstname'].'</td>
                    <td>'.$row['pri_surname'].' </td>
                    <td>'.$row['pri_email'].'</td>
                    <td>'.$row['pri_phone'].'</td>
                    <td>Paid</td>
                    <td> 04 Dec 2019 </td>
                    <td>
                    <form action="'.GEN_WEBSITE.'/admin/confirm-data.php?id='.$row['primary_id'].'" method="POST">
                   
                    <button type="submit" class="btn btn-success me-2" name="paid_students">Confirm admission</button>
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
                  <nav aria-label="Page navigation example"> <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE."/admin/search-paid.php?");?> </nav>
                </div>
              </div>
            </div>
         
           
            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>


           



              