<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header("Location:".GEN_WEBSITE.'/admin');
	exit();
}

if(($_SESSION['admin_type'] != ACCOUNTANT) && ($_SESSION['admin_type'] != OWNER)){
	header("Location:".GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}
?>

<?php
if(!isset($_GET['search-paid'])){
    header("Location:".GEN_WEBSITE.'/admin/dashboard.php');
	exit();
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
           




            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Search paid (Primary)</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                          
                            <th> Firstname </th>
                            <th> Surname </th>
                            <th>Fees </th>
                            <th> Completion status</th>
                            <th> Term</th>
                            <th> Session</th>
                            <th>Date paid(fees) </th>
                            <th>Modules</th>
                        </tr>
                        </thead>
                        <tbody>




           
                                        <?php
                              include ('../../incs-arahman/paginate.php');
                              $statement = "primary_school_students INNER JOIN primary_payment ON primary_payment_students_id = primary_id  WHERE (pri_paid = '1' AND pri_admit = '1' AND pri_active_email = '1') AND (pri_firstname LIKE '%".mysqli_real_escape_string($connect, $_GET['search-paid'])."%' OR pri_surname LIKE '%".mysqli_real_escape_string($connect, $_GET['search-paid'])."%') ORDER BY primary_id ASC";
                                        
                              $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
                                          if ($page <= 0) $page = 10;
                                                        // Set how many records do you want to display per page.
                                          $startpoint = ($page * $per_page) - $per_page;
                                          $results = mysqli_query($connect,"SELECT primary_payment_fees, primary_payment_session, primary_payment_term,  primary_payment_paid_percent, primary_payment_timestamp,  primary_id, pri_paid, pri_firstname, primary_payment_completion_status, pri_surname, pri_email, pri_phone FROM ".$statement." LIMIT $startpoint, $per_page") or die(mysqli_error($connect));
                                          if (mysqli_num_rows($results) != 0){
                                              while ($row = mysqli_fetch_array($results)) {
                                                  
                                                $num_of_joins = mysqli_query($connect,"SELECT * FROM modules LEFT JOIN module_join_students ON module_id = module_type_id WHERE module_students = '".$row['primary_id']."'") or die(mysqli_error($connect));
                                                echo '<tr>
                                                
                                                  <td>'.$row['pri_firstname'].'</td>
                                                  <td>'.$row['pri_surname'].' </td>
                                                  <td>&#8358;'.number_format($row['primary_payment_fees']).' </td>
                                                  <td><div class="badge badge-outline-success">'.$row['primary_payment_paid_percent'].'% </div></td>
                                                  <td>'.$row['primary_payment_term'].'</td>
                                                  <td>'.$row['primary_payment_session'].'</td>
                                                  <td>'.date('M j Y g:i A', strtotime($row['primary_payment_timestamp']. OFFSET_TIME)).'</td>';
                              echo '<td>';
                                                  while ($row_answer = mysqli_fetch_array($num_of_joins)) {
                                                  
                                                    echo '<div class="badge badge-outline-success">'.$row_answer['module_type'].'</div>';
                                                  
                                                  }

                              echo '</td>';

                              echo                '</tr>';

                                          




                                                }
                                          }else{
                                              echo '<h3 class="text-center">No result found</h3>';
                                          } 

                                        ?>
                      </tbody>
                      </table>
                      
                    </div>
                    
                  </div>
                  <nav aria-label="Page navigation example"> <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE."/admin/search-paid.php?search-paid=".mysqli_real_escape_string($connect, $_GET['search-paid'])."&button-paid_students=&");?> </nav>
                </div>
              </div>
            </div>
         
           
            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>


           



              