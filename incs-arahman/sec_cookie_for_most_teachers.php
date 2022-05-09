<?php
if(!isset($_SESSION['secondary_teacher_id'])){	

if(isset($_COOKIE['sec_teacher_remember_me'])){ 
	
	$cookiesessions = $_COOKIE['sec_teacher_remember_me'];
$query = mysqli_query($connect, "SELECT * FROM secondary_teachers, secondary_school_classes WHERE secondary_class_id=secondary_teacher_class_id  AND secondary_teacher_active='1' AND secondary_teacher_cookie='".$cookiesessions."' ") or die(db_conn_error);
 

if(mysqli_num_rows($query)== 1){
    $row = mysqli_fetch_array ($query, MYSQLI_NUM);

 
	



$_SESSION['secondary_teacher_id'] = $row[0];
$_SESSION['secondary_teacher_class_id'] = $row[2];
$_SESSION['secondary_teacher_firstname'] = $row[3];
$_SESSION['secondary_teacher_surname'] = $row[4];
$_SESSION['secondary_teacher_email'] = $row[5];
$_SESSION['secondary_teacher_sex'] = $row[7];
$_SESSION['secondary_teacher_age'] = $row[8];
$_SESSION['secondary_teacher_phone'] = $row[9];
$_SESSION['secondary_teacher_qualification'] = $row[10];
$_SESSION['secondary_teacher_address'] = $row[11];
$_SESSION['secondary_teacher_image'] = $row[12];
$_SESSION['secondary_class'] = $row[16];
}
}
}

?>