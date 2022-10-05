<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header('Location:'.GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != ACCOUNTANT && $_SESSION['admin_type'] != OWNER){
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();

}


?>


<?php require_once('../../incs-arahman/dashboard.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                   
                  
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Primary School fees</h4>
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
                              $statement = "primary_school_students INNER JOIN primary_payment ON primary_payment_students_id = primary_id  WHERE (pri_paid = '1' AND pri_admit = '1' AND pri_active_email = '1') ORDER BY primary_id ASC";
                                        
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
                                                  <td>'.$row['primary_payment_term'].' </td>
                                                  <td>'.$row['primary_payment_session'].' </td>
                                                  <td>'.date('M j Y g:i A', strtotime($row['primary_payment_timestamp']. OFFSET_TIME  )).'</td>';
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
                  <nav aria-label="Page navigation example"> <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE."/admin/primary-school-payment.php?");?> </nav>
                </div>
              </div>
            </div>
         






                

            








<script>
//                      window.addEventListener("load", function() {
//     var f = document.getElementById('Foo');
//     setInterval(function() {
//         f.style.display = (f.style.display == 'none' ? '' : 'none');
//     }, 1000);

// }, false);
</script>                 



            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>