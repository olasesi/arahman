<?php
if(!isset($_SESSION['secondary_id'])){	

if(isset($_COOKIE['sec_students_remember_me'])){ 
	
	$cookiesessions = $_COOKIE['sec_students_remember_me'];
    $query = mysqli_query($connect, "SELECT * FROM secondary_school_students WHERE sec_active_email='1' AND sec_active='1' AND sec_paid='1' AND sec_admit='1' AND sec_cookie_session='".$cookiesessions."'") or die(db_conn_error);

if(mysqli_num_rows($query)== 1){
    $row = mysqli_fetch_array ($query, MYSQLI_NUM);


    $_SESSION['secondary_id'] = $row[0];
    $_SESSION['sec_class_id'] = $row[5];
    $_SESSION['sec_firstname'] = $row[8];
    $_SESSION['sec_surname'] = $row[9];
    $_SESSION['sec_age'] = $row[10];
    $_SESSION['sec_sex'] = $row[11];
    $_SESSION['sec_email'] = $row[12];
    $_SESSION['sec_photo'] = $row[13];
    $_SESSION['sec_phone'] = $row[14];
    $_SESSION['sec_address'] = $row[15];
     
}
}
}

?>