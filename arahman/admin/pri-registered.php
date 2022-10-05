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
<label class="badge badge-info">You have confirmed '.$_GET['confirm'].' admission. Student should proceed to make payment</label>
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


$statement = "primary_school_students WHERE (pri_paid = '0' AND pri_admit = '0' AND pri_active_email = '1') ORDER BY primary_id DESC";
           
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 10;
            							// Set how many records do you want to display per page.
            $startpoint = ($page * $per_page) - $per_page;
          
            $results = mysqli_query($connect,"SELECT primary_id, pri_paid, pri_firstname, pri_surname, pri_email, pri_phone, pri_timestamp FROM ".$statement." LIMIT $startpoint, $per_page") or die(mysqli_error($connect));
            
?>




            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                <?php
include_once ('../../incs-arahman/pri-recently-registered.php');
?>


                  <nav aria-label="Page navigation example"> <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE."/admin/pri-registered.php?");?> </nav>
                </div>
              </div>
            </div>
         
           
            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>


           



              