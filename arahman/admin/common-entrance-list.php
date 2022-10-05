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
                    <h4 class="card-title">Common Entrance fee</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                          
                            <th> Firstname </th>
                            <th> Surname </th>
                            <th>Amount </th>
                            <th>Payment status</th>
                            <th>Reference no</th>
                            <th> Session</th>
                            <th>Date paid </th>
                           
                        </tr>
                        </thead>
                        <tbody>




           
                                        <?php
                              include ('../../incs-arahman/paginate.php');
                              $statement = "secondary_common_e INNER JOIN secondary_school_students ON secondary_common_e_students_id = secondary_id ORDER BY secondary_id ASC";
                                        
                              $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
                                          if ($page <= 0) $page = 10;
                                                        // Set how many records do you want to display per page.
                                          $startpoint = ($page * $per_page) - $per_page;
                                          $results = mysqli_query($connect,"SELECT secondary_common_e_session, secondary_common_e_price, secondary_common_e_reference, secondary_common_e_status, sec_firstname, sec_surname, secondary_common_e_timestamp FROM ".$statement." LIMIT $startpoint, $per_page") or die(mysqli_error($connect));
                                          if (mysqli_num_rows($results) != 0){
                                              while ($row = mysqli_fetch_array($results)) {
                                                  
                                              
                                                echo '<tr>
                                                
                                                  <td>'.$row['sec_firstname'].'</td>
                                                  <td>'.$row['sec_surname'].' </td>
                                                  <td>&#8358;'.number_format($row['secondary_common_e_price']).' </td>
                                                  <td>';if($row['secondary_common_e_status'] == 1){echo 'paid';}
                                                  echo '</td>
                                                  <td>'.$row['secondary_common_e_reference'].' </td>
                                                  <td>'.$row['secondary_common_e_session'].' </td>
                                                  <td>'.date('M j Y g:i A', strtotime($row['secondary_common_e_timestamp']. OFFSET_TIME  )).'</td>';
                              echo '<td>';
                                               
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
                  <nav aria-label="Page navigation example"> <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE."/admin/common-entrance-list.php?");?> </nav>
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