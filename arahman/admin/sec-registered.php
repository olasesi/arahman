<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header("Location:".GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != ADMISSION){
	header("Location:".GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}
?>
<?php
// if(!isset($_GET['search-registered-sec'])){
//     header("Location:".GEN_WEBSITE.'/admin/dashboard.php');
// 	exit();
// }

?>
<?php require_once ('../../incs-arahman/dashboard.php');?>
<?php
include_once ('../../incs-arahman/deny-student.php');
?>


        
        
        
        
        
        
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
           

<?php
if(isset($_GET['confirm'])){
echo ' <div class="row ">
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
<label class="badge badge-info">You have confirmed '.$_GET['confirm'].' admission. Student should proceed to school fees payment</label>
</div>
</div>
</div>
</div>';

$_GET = array();	
}
?>
<?php
include_once ('../../incs-arahman/reject-student-status.php');
?>           

<?php
include ('../../incs-arahman/paginate.php');


$statement = "secondary_school_students LEFT JOIN secondary_common_e ON secondary_common_e_students_id = secondary_id WHERE (sec_paid = '0' AND sec_admit = '0' AND sec_active_email = '1') ORDER BY secondary_id DESC";
           
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 10;
            							// Set how many records do you want to display per page.
            $startpoint = ($page * $per_page) - $per_page;
          
            $results = mysqli_query($connect,"SELECT secondary_common_e_status, secondary_id, sec_paid, sec_firstname, sec_surname, sec_email, sec_phone, sec_timestamp FROM ".$statement." LIMIT $startpoint, $per_page") or die(mysqli_error($connect));
            
?>




            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                <?php
include_once ('../../incs-arahman/sec-recently-registered.php');
?>


                  <nav aria-label="Page navigation example"> <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE."/admin/sec-registered.php?");?> </nav>
                </div>
              </div>
            </div>
         
           
            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>


           



              