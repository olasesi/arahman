<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
include("../../incs-arahman/cookie_for_most_teachers.php");

?>
<?php
if(!isset($_SESSION['primary_teacher_id'])){   //Not a teacher? Please leave
	header('Location:'.GEN_WEBSITE.'/teachers');
	exit();
}
?>
<?php
if(!isset($_GET['show_students'])){   //Not a teacher? Please leave
	header('Location:'.GEN_WEBSITE.'/home.php');
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
$statement = "primary_school_students, primary_school_classes WHERE pri_paid = '1' AND pri_admit = '1' AND pri_active_email = '1' AND primary_class_id = pri_class_id AND pri_class_id = '".$_SESSION['primary_teacher_class_id']."' ORDER BY primary_id ASC";
           
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 1;
            $per_page = 15; 								// Set how many records do you want to display per page.
            $startpoint = ($page * $per_page) - $per_page;
            $results = mysqli_query($connect,"SELECT primary_id, pri_year, pri_firstname, pri_surname, pri_age, pri_sex, pri_email, pri_photo, pri_phone, pri_address, primary_class FROM primary_school_students, primary_school_classes WHERE pri_paid = '1' AND pri_admit = '1' AND pri_active_email = '1' AND primary_class_id = pri_class_id AND pri_class_id = '".$_SESSION['primary_teacher_class_id']."' ORDER BY primary_id ASC LIMIT $startpoint, $per_page") or die(db_conn_error);
            if (mysqli_num_rows($results) != 0){
                while ($row = mysqli_fetch_array($results)) {
                    echo '<tr>
                    <td> '.$row['pri_year'].'</td>
                    <td>'.$row['pri_firstname'].'</td>
                    <td>'.$row['pri_surname'].' </td>
                    <td>'.$row['pri_age'].' </td>
                    <td>'.$row['pri_sex'].' </td>
                    <td>'.$row['pri_email'].'</td>
                    <td>'.$row['pri_photo'].' </td>
                    <td>'.$row['pri_phone'].'</td>
                    <td>'.$row['pri_address'].' </td>
                    <td>'.$row['primary_class'].' </td>
                   
                    <td>
                    <form action="'.GEN_WEBSITE.'/admin/confirm-data.php?id='.$row['primary_id'].'" method="POST">
                   
                    <button type="submit" class="btn btn-success me-2" name="paid_students">Confirm admission</button>
                    </form>
                    </td>

                </tr>';

                  }
            }else{
                echo '<h3 class="text-center">No students details</h3>';
            } 

           ?>