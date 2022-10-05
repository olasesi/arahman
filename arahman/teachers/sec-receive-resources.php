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
include_once ('../../incs-arahman/paginate.php');

$statement = "secondary_test_assignment_submit, secondary_school_students WHERE secondary_id = secondary_test_upload_pri_id AND secondary_test_upload_classid = '".$_SESSION['secondary_teacher_class_id']."'ORDER BY secondary_test_submit_id DESC";

//
?>

<?php
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 10;
        		
            $startpoint = ($page * $per_page) - $per_page;




            $query_receive = mysqli_query ($connect, "SELECT sec_firstname, sec_surname, secondary_test_upload_submit_name, secondary_test_upload_submit_file,  secondary_test_submit_timestamp FROM ".$statement." LIMIT $startpoint, $per_page") or die(db_conn_error);
?>
                    <div class="row">
                        <div class="col-md-12">
                        <h5 class="mb-2 mt-4 text-titlecase mb-4">Resources/assigment recieved</h5>
                            <div class="card">
                                 
                                <div class="table-responsive pt-3">
                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                                <th class="ml-5">Assignment name</th>
                                                <th>Student name</th>
                                                <th>Date</th>
                                                <!-- <th>Date</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                       
                                           <?php if (mysqli_num_rows($query_receive) != 0){
	while ($row_query_receive = mysqli_fetch_array($query_receive)) {
        echo ' <tr>';
echo '<td>'.$row_query_receive['secondary_test_upload_submit_name'].'</td>';
echo '<td>'.$row_query_receive['sec_firstname'].' '.$row_query_receive['sec_surname'].'</td>';
echo '<td>'.date('M j Y g:i A', strtotime($row_query_receive['secondary_test_submit_timestamp']. OFFSET_TIME)).'</td>';




echo '<td>
    <div class="d-flex align-items-center">';
	echo'
	<a href="../../incs-storage/submit-assignments/'.$row_query_receive['secondary_test_upload_submit_file'].'" download="'.$row_query_receive['secondary_test_upload_submit_name'].'">Download</a>
	';
    //echo '
  
	 //<button type="submit" class="btn btn-danger btn-sm btn-icon-text mr-3" name="close_assignment" value="'.$row_read['secondary_test_upload_id'].'">Close</button>
	//';

echo '
</div>
</td>';
echo '</tr>';
}

}else{
    echo '<td>';
	echo '<p class="text-center">No test or resource was submitted</p>';
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
                <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE.'/teachers/sec-receive-resources.php?'); ?>
				<?php include_once("../../incs-arahman/footer-teacher-students.php"); ?>






