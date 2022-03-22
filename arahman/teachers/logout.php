<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');


if(!isset($_SESSION['primary_teacher_id'])){  
	header("Location:".GEN_WEBSITE."/teachers");
	exit();
}

mysqli_query($connect,"UPDATE primary_teachers SET primary_teacher_cookie = '' WHERE primary_teacher_id = '".$_SESSION['primary_teacher_id']."'") or die(db_conn_error);	
session_destroy();
setcookie("teacher_remember_me", "", time() - 31104000);		
	
header("Location:".GEN_WEBSITE."/teachers");
exit();


