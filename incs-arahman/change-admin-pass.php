<?php
if($_SESSION['admin_type'] == HEADMASTER || $_SESSION['admin_type'] == ACCOUNTANT || $_SESSION['admin_type'] == ADMISSION ){
$ban_query = mysqli_query($connect, "SELECT admin_active FROM admin WHERE admin_active = '0' AND admin_id = '".$_SESSION['admin_user_id']."'") or die(db_conn_error); 

if(mysqli_num_rows($ban_query) == 1){
  mysqli_query($connect,"UPDATE admin SET admin_cookie_session = '' WHERE admin_id = '".$_SESSION['admin_user_id']."'") or die(db_conn_error);	
  session_destroy();
  setcookie("admin_remember_me", "", time() - 31104000);		

header("Location:".GEN_WEBSITE."/admin");
exit();

}


}
/////////////////////////////////
////////////////////////////////

if($_SESSION['admin_type'] == HEADMASTER || $_SESSION['admin_type'] == ACCOUNTANT || $_SESSION['admin_type'] == ADMISSION){


    $change_pass = mysqli_query($connect, "SELECT admin_password FROM admin WHERE admin_password != '".$_SESSION['admin_password']."' AND admin_id = '".$_SESSION['admin_user_id']."'") or die(db_conn_error); 
  
  if(mysqli_num_rows($change_pass) == 1){
    mysqli_query($connect,"UPDATE admin SET admin_cookie_session = '' WHERE admin_id = '".$_SESSION['admin_user_id']."'") or die(db_conn_error);	
    session_destroy();
    setcookie("admin_remember_me", "", time() - 31104000);		
  
  header("Location:".GEN_WEBSITE."/admin");
  exit();
  
  }
  }