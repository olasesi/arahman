<?php
if(!isset($_SESSION['primary_id'])){	

if(isset($_COOKIE['students_remember_me'])){ 
	
	$cookiesessions = $_COOKIE['students_remember_me'];
    $query = mysqli_query($connect, "SELECT * FROM primary_school_students WHERE pri_active_email='1' AND pri_active='1' AND pri_paid='1' AND pri_admit='1' AND pri_cookie_session='".$cookiesessions."'") or die(db_conn_error);

if(mysqli_num_rows($query)== 1){
    $row = mysqli_fetch_array ($query, MYSQLI_NUM);

 $_SESSION['primary_id'] = $row[0];
    $_SESSION['pri_class_id'] = $row[5];
    $_SESSION['pri_firstname'] = $row[8];
    $_SESSION['pri_surname'] = $row[9];
    $_SESSION['pri_age'] = $row[10];
    $_SESSION['pri_sex'] = $row[11];
    $_SESSION['pri_email'] = $row[12];
    $_SESSION['pri_photo'] = $row[13];
    $_SESSION['pri_phone'] = $row[14];
    $_SESSION['pri_address'] = $row[15];
    
}
}
}

?>