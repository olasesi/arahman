<?php
if(!isset($_SESSION['primary_teacher_id'])){	

if(isset($_COOKIE['teacher_remember_me'])){ 
	
	$cookiesessions = $_COOKIE['teacher_remember_me'];
$query = mysqli_query($connect, "SELECT * FROM primary_teachers, primary_school_classes WHERE primary_class_id=primary_teacher_class_id AND primary_teacher_email='".$email."' AND primary_teacher_password='".$password."' AND primary_teacher_active='1' AND primary_teacher_cookie='".$cookiesessions."' ") or die(db_conn_error);
 

if(mysqli_num_rows($query)== 1){
    $row = mysqli_fetch_array ($query, MYSQLI_NUM);

 
	



$_SESSION['primary_teacher_id'] = $row[0];
$_SESSION['primary_teacher_class_id'] = $row[2];
$_SESSION['primary_teacher_firstname'] = $row[3];
$_SESSION['primary_teacher_surname'] = $row[4];
$_SESSION['primary_teacher_email'] = $row[5];
$_SESSION['primary_teacher_sex'] = $row[7];
$_SESSION['primary_teacher_age'] = $row[8];
$_SESSION['primary_teacher_phone'] = $row[9];
$_SESSION['primary_teacher_qualification'] = $row[10];
$_SESSION['primary_teacher_address'] = $row[11];
$_SESSION['primary_teacher_image'] = $row[12];
$_SESSION['primary_class'] = $row[16];
}
}
}

?>