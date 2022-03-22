<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//require_once("../../incs-arahman/cookie_for_most.php");

if(!isset($_SESSION['admin_active'])){  
	header("Location:".GEN_WEBSITE."/admin");
	exit();
}

mysqli_query($connect,"UPDATE admin SET admin_cookie_session = '' WHERE admin_id = '".$_SESSION['admin_user_id']."'") or die(db_conn_error);	
session_destroy();
setcookie("admin_remember_me", "", time() - 31104000);		
	
header("Location:".GEN_WEBSITE."/admin");
exit();


