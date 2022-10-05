<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../../incs-arahman/sec_cookie_for_most_teachers.php");

?>
<?php
if(!isset($_SESSION['secondary_teacher_id'])){   //Not a teacher? Please leave
	header('Location:'.GEN_WEBSITE.'/teachers');
	exit();
}
?>


<?php include("../../incs-arahman/header-teacher-students.php");?>



            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                
  

                <?php
//This is all about uploading assignmend and tests
 if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['close_assignment'])){
	mysqli_query($connect, "UPDATE secondary_test_assignment_upload SET secondary_test_upload_class_status = 'Close' WHERE secondary_test_upload_class_status = 'Open' AND secondary_test_upload_id  = '".$_POST['close_assignment']."'") or die(db_conn_error);
}elseif($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['open_assignment'])){
	mysqli_query($connect, "UPDATE secondary_test_assignment_upload SET secondary_test_upload_class_status = 'Open' WHERE secondary_test_upload_class_status = 'Close' AND secondary_test_upload_id = '".$_POST['open_assignment']."'") or die(db_conn_error);
}



include_once ('../../incs-arahman/paginate.php');

$statement = "secondary_test_assignment_upload, secondary_school_classes WHERE secondary_class_id = secondary_test_upload_class_id AND secondary_test_upload_class_id='".$_SESSION['secondary_teacher_class_id']."'ORDER BY secondary_test_upload_id DESC";

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 10;
        		
            $startpoint = ($page * $per_page) - $per_page;



            $query_read = mysqli_query ($connect, "SELECT secondary_test_upload_testname, secondary_test_upload_id, secondary_test_upload_class_status, secondary_test_upload_filename, secondary_class, secondary_test_upload_timestamp FROM ".$statement." LIMIT $startpoint, $per_page") or die(db_conn_error);
//
?>

                    <div class="row">
                        <div class="col-md-12">
                        <h5 class="mb-2 mt-4 text-titlecase mb-4">Assignments and resources</h5>
                            <div class="card">
                                 
                                <div class="table-responsive pt-3">
                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                            <th>Resource/test name</th>
                                                <th>Date given</th>
                                             
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                       
                                           <?php if (mysqli_num_rows($query_read) != 0){
	while ($row_read = mysqli_fetch_array($query_read)) {
        echo ' <tr>';
        echo '<td>'.$row_read['secondary_test_upload_testname'].'</td>';
echo '<td>'.date('M j Y g:i A', strtotime($row_read['secondary_test_upload_timestamp']. OFFSET_TIME)).'</td>';

echo '<td>'.$row_read['secondary_test_upload_class_status'].'</td>';	



echo '<td>
    <div class="d-flex align-items-center">';
if($row_read['secondary_test_upload_class_status'] == 'Open'){
	
    echo '
    <form action="" method="POST">
	 <button type="submit" class="btn btn-danger btn-sm btn-icon-text mr-3" name="close_assignment" value="'.$row_read['secondary_test_upload_id'].'">Close</button>
	</form>';
}elseif($row_read['secondary_test_upload_class_status'] == 'Close'){
echo '<form action="" method="POST">
<button type="submit" class="btn btn-success btn-sm btn-icon-text mr-3" name="open_assignment" value="'.$row_read['secondary_test_upload_id'].'">Open</button>
</form>';}
echo '
</div>
</td>';


echo '<td>
    <div class="d-flex align-items-center">';

	
    echo '
    <form action="" method="POST">
	 <button type="submit" class="btn btn-danger btn-sm btn-icon-text mr-3" name="delete_assignment" value="'.$row_read['secondary_test_upload_id'].'">Delete</button>
	</form>';

echo '
</div>
</td>';




echo '</tr>';
}

// $query_read_more = mysqli_query ($connect, "SELECT secondary_test_upload_id FROM secondary_test_assignment_upload, secondary_school_classes WHERE secondary_class_id = secondary_test_upload_class_id AND secondary_test_upload_class_id='".$_SESSION['secondary_teacher_class_id']."'ORDER BY secondary_test_upload_id DESC") or die(db_conn_error);

// if(mysqli_num_rows($query_read_more) > 20){
// 	echo '<td>';
//     echo '<a href="'.GEN_WEBSITE.'/teachers/sec-more-assignments.php"><h6 class="preview-subject">See more...</h6></a>';
//     echo '</td>';
// }
}else{
    echo '<td>';
	echo '<p class="text-center">No test or resource was uploaded</p>';
    echo '</td>';
}
?>
                                                





                                           
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>














                </div>
                <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE.'/teachers/sec-resources.php?'); ?>
				<?php include_once("../../incs-arahman/footer-teacher-students.php"); ?>






