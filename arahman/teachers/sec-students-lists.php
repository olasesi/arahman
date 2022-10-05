<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
include("../../incs-arahman/sec_cookie_for_most_teachers.php");

?>
<?php
if(!isset($_SESSION['secondary_teacher_id'])){   //Not a teacher? Please leave
	header('Location:'.GEN_WEBSITE.'/teachers');
	exit();
}
?>
<?php
if(!isset($_GET['show_students'])){   //Not a teacher? Please leave
	header('Location:'.GEN_WEBSITE.'/sec-home.php');
	exit();
}?>

<?php
/*Highlight Students details
$results = mysqli_query($connect,"SELECT primary_id, pri_firstname, pri_surname, pri_age, pri_sex, pri_photo, primary_class FROM primary_school_students, primary_school_classes WHERE pri_paid = '1' AND pri_admit = '1' AND pri_active_email = '1' AND primary_class_id = pri_class_id AND pri_class_id = '".$_SESSION['primary_teacher_class_id']."' AND primary_id = '".$_GET['show_students']."'") or die(db_conn_error); 

if(mysqli_num_rows($results) == 0){
    echo 'This student is not in your class';
}elseif(mysqli_num_rows($results) == 1){
}*/
  
  ?>
<?php
include ('../../incs-arahman/paginate.php');
$statement = "secondary_school_students, secondary_school_classes WHERE sec_paid = '1' AND sec_admit = '1' AND sec_active_email = '1' AND secondary_class_id = sec_class_id AND sec_class_id = '".$_SESSION['secondary_teacher_class_id']."' ORDER BY secondary_id ASC";
           
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 10;
            $per_page = 15; 								// Set how many records do you want to display per page.
            $startpoint = ($page * $per_page) - $per_page;
            $results = mysqli_query($connect,"SELECT secondary_id, sec_year, sec_firstname, sec_surname, sec_age, sec_sex, sec_email, sec_photo, sec_phone, sec_address, secondary_class FROM secondary_school_students, secondary_school_classes WHERE sec_paid = '1' AND sec_admit = '1' AND sec_active_email = '1' AND secondary_class_id = sec_class_id AND sec_class_id = '".$_SESSION['secondary_teacher_class_id']."' ORDER BY secondary_id ASC LIMIT $startpoint, $per_page") or die(db_conn_error);
            if (mysqli_num_rows($results) != 0){
                while ($row = mysqli_fetch_array($results)) {
                    echo '<tr>
                    <td> '.$row['sec_year'].'</td>
                    <td>'.$row['sec_firstname'].'</td>
                    <td>'.$row['sec_surname'].' </td>
                    <td>'.$row['sec_age'].' </td>
                    <td>'.$row['sec_sex'].' </td>
                    <td>'.$row['sec_email'].'</td>
                    <td>'.$row['sec_photo'].' </td>
                    <td>'.$row['sec_phone'].'</td>
                    <td>'.$row['sec_address'].' </td>
                    <td>'.$row['secondary_class'].' </td>
                   
                    <td>
                    <form action="'.GEN_WEBSITE.'/admin/confirm-data.php?id='.$row['secondary_id'].'" method="POST">
                   
                    <button type="submit" class="btn btn-success me-2" name="paid_students">Confirm admission</button>
                    </form>
                    </td>

                </tr>';

                  }
            }else{
                echo '<h3 class="text-center">No students details</h3>';
            } 

           ?>