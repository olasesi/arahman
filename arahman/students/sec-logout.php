<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//require_once("../../incs-arahman/cookie_for_most.php");

if(!isset($_SESSION['secondary_id'])){  
	header("Location:".GEN_WEBSITE."/students");
	exit();
}




mysqli_query($connect,"UPDATE secondary_school_students SET sec_cookie_session = '' WHERE secondary_id  = '".$_SESSION['secondary_id']."'") or die(db_conn_error);	
session_destroy();
setcookie("sec_students_remember_me", "", time() - 31104000);		
	
header("Location:".GEN_WEBSITE."/students");
exit();


