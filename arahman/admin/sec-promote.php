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

if(isset($_GET['confirm-promotion'])){
echo ' <div class="row ">
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
<label class="badge badge-info">Student has been promoted successfully. Student should now proceed to make payment</label>
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


$statement = "secondary_school_students WHERE (sec_paid = '0' AND sec_admit = '0' AND sec_active_email = '1' AND sec_class_id != '0') ORDER BY secondary_id DESC";
           
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 10;
            							// Set how many records do you want to display per page.
            $startpoint = ($page * $per_page) - $per_page;
          
            $results = mysqli_query($connect,"SELECT secondary_id, sec_paid, sec_firstname, sec_surname, sec_email, sec_phone, sec_timestamp FROM ".$statement." LIMIT $startpoint, $per_page") or die(mysqli_error($connect));
            
?>




            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                <div class="card-body">
 <h4 class="card-title">Promote students (secondary)</h4>
 <div class="table-responsive">
   <table class="table">
     <thead>
       <tr>
      
         <th> Firstname </th>
         <th> Surname </th>
         <th> Email address </th>
         <th> Phone number </th>
       
        <th>Date registered </th>
     </tr>
     </thead>
     <tbody>

<?php


if (mysqli_num_rows($results) != 0){
while ($row = mysqli_fetch_array($results)) {
 echo '<tr>
 
 <td>'.$row['sec_firstname'].'</td>
 <td>'.$row['sec_surname'].' </td>
 <td>'.$row['sec_email'].'</td>
 <td>'.$row['sec_phone'].'</td>';

 echo '<td> '.date('M j Y g:i A', strtotime($row['sec_timestamp'])).' </td>
 <td>
 <form action="'.GEN_WEBSITE.'/admin/sec-promote-students.php?id='.$row['secondary_id'].'" method="POST">

 <button type="submit" class="btn btn-success me-2" name="paid_students">Edit</button>
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


                  <nav aria-label="Page navigation example"> <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE."/admin/sec-promote.php?");?> </nav>
                </div>
              </div>
            </div>
         
           
            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>


           



              