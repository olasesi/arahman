<?php
require_once ('../incs-arahman/config.php');
require_once ('../incs-arahman/gen_serv_con.php');


/*if(isset($_SESSION['primary_id'])){
  header('Location:'.GEN_WEBSITE.'/home.php');
exit();
}


if(isset($_SESSION['secondary_id'])){
  header('Location:'.GEN_WEBSITE.'/home.php');
exit();
}*/





$result = array();
//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/'.$_GET['reference'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
$ch, CURLOPT_HTTPHEADER, [
'Authorization: '. API]
);
$request = curl_exec($ch);
curl_close($ch);

if ($request) {
$result = json_decode($request, true);
}

if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {

  $query_term_session = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
  while($loop_term_session=mysqli_fetch_array($query_term_session)){
    $current_term = $loop_term_session['choose_term'];
    $current_session_term = $loop_term_session['school_session'];
   
  }
  
  if($_SESSION['school_type'] == 'Primary school'){

    mysqli_query($connect, "UPDATE primary_school_students SET pri_paid='1' WHERE pri_email = '".$_SESSION['email']."' AND pri_active_email = '1' AND pri_paid = '0'") or die(db_conn_error);


    $query_id = mysqli_query($connect, "SELECT primary_id FROM primary_school_students WHERE pri_email='".$_SESSION['email']."' AND pri_active_email='1'") or die(db_conn_error);
    if(mysqli_num_rows($query_id) == 1){
while($query_id_while = mysqli_fetch_array($query_id)){
 if($_SESSION['percentage'] == 100){
   $status = 1;
 }else{
  $status = 0;
 }
  $q = mysqli_query($connect,"INSERT INTO primary_payment (primary_payment_students_id, primary_payment_students_reference, primary_payment_term, primary_payment_session,primary_payment_fees, primary_payment_paid_percent, primary_payment_completion_status) 
  VALUES ('".$query_id_while['primary_id']."', '".$_GET['reference']."','". $current_term."','".  $current_session_term."', '".$_SESSION['school_fees']."', '".$_SESSION['percentage']."', '".$status."')") or die(db_conn_error);

unset($_SESSION['school_type']);
unset($_SESSION['email']);
unset($_SESSION['school_fees']);
unset($_SESSION['school_class_name']);
unset($_SESSION['percentage']);
header('Location:'.GEN_WEBSITE.'/students/school-fees-payment.php?reference='.$_GET['reference']);
exit();



}

    }

   
    

  }elseif($_SESSION['school_type'] == 'Secondary school'){
   
    mysqli_query($connect, "UPDATE secondary_school_students SET sec_paid='1' WHERE sec_email = '".$_SESSION['email']."' AND sec_active_email = '1' AND sec_paid = '0'") or die(db_conn_error);


    $query_id = mysqli_query($connect, "SELECT secondary_id FROM secondary_school_students WHERE sec_email='".$_SESSION['email']."' AND sec_active_email='1'") or die(db_conn_error);
    if(mysqli_num_rows($query_id) == 1){
while($query_id_while = mysqli_fetch_array($query_id)){
 if($_SESSION['percentage'] == 100){
   $status = 1;
 }else{
  $status = 0;
 }
  $q = mysqli_query($connect,"INSERT INTO secondary_payment (secondary_payment_students_id, secondary_payment_students_reference, secondary_payment_term, secondary_payment_session,secondary_payment_fees, secondary_payment_paid_percent, secondary_payment_completion_status) 
  VALUES ('".$query_id_while['secondary_id']."', '".$_GET['reference']."','". $current_term."','".  $current_session_term."', '".$_SESSION['school_fees']."', '".$_SESSION['percentage']."', '".$status."')") or die(db_conn_error);

unset($_SESSION['school_type']);
unset($_SESSION['email']);
unset($_SESSION['school_fees']);
unset($_SESSION['school_class_name']);
unset($_SESSION['percentage']);
header('Location:'.GEN_WEBSITE.'/students/school-fees-payment.php?reference='.$_GET['reference']);
exit();



}

    }




  }

if(isset($_SESSION['common_entrance_email']) AND isset($_SESSION['choose_session'])){

  $query_id = mysqli_query($connect, "SELECT secondary_id FROM secondary_school_students WHERE sec_email='".$_SESSION['common_entrance_email']."' AND sec_active_email='1' AND sec_paid = '0' AND sec_admit = '0' AND sec_class_id = '0'") or die(db_conn_error);
  if(mysqli_num_rows($query_id) == 1){

while($query_id_while = mysqli_fetch_array($query_id)){
  $common_entrance_fee = mysqli_query($connect, "SELECT secondary_common_fee_price FROM secondary_common_fee WHERE secondary_common_fee_id = '1'") or die(db_conn_error);
  
  while($common_entrance_fee_loop=mysqli_fetch_array($common_entrance_fee)){
    $entrance_fees = $common_entrance_fee_loop['secondary_common_fee_price'];
    }

  $q = mysqli_query($connect,"INSERT INTO secondary_common_e (secondary_common_e_students_id, secondary_common_e_session, secondary_common_e_price, secondary_common_e_reference, secondary_common_e_status) 
  VALUES ('".$query_id_while['secondary_id']."', '".$_SESSION['choose_session']."','". $entrance_fees ."','".  $_GET['reference']."', '1')") or die(db_conn_error);

unset($_SESSION['choose_session']);
unset($_SESSION['common_entrance_email']);

header('Location:'.GEN_WEBSITE.'/students/common-entrance.php?reference='.$_GET['reference']);
exit();



}

  }


 


}


if(isset($_SESSION['primary_id']) AND !isset($_SESSION['module'])){
  mysqli_query($connect, "UPDATE primary_payment SET primary_payment_students_reference='".$_GET['reference']."', primary_payment_paid_percent = '100', primary_payment_completion_status = '1' WHERE primary_payment_students_id = '".$_SESSION['primary_id']."' AND primary_payment_paid_percent != '100' AND primary_payment_completion_status = '0' AND primary_payment_term = '".$_SESSION['term']."' AND primary_payment_session = '".$_SESSION['session']."'") or die(db_conn_error);

  header('Location:'.GEN_WEBSITE.'/students/home.php?reference='.$_GET['reference']);
  exit();
  


}elseif(isset($_SESSION['secondary_id']) AND !isset($_SESSION['secondary_module'])){

  mysqli_query($connect, "UPDATE secondary_payment SET secondary_payment_students_reference='".$_GET['reference']."', secondary_payment_paid_percent = '100', secondary_payment_completion_status = '1' WHERE secondary_payment_students_id = '".$_SESSION['secondary_id']."' AND secondary_payment_paid_percent != '100' AND secondary_payment_completion_status = '0' AND secondary_payment_term = '".$_SESSION['term']."' AND secondary_payment_session = '".$_SESSION['session']."'") or die(db_conn_error);

  header('Location:'.GEN_WEBSITE.'/students/home-secondary.php?reference='.$_GET['reference']);
  exit();

}





if(isset($_SESSION['module'])){
 
   mysqli_query($connect,"INSERT INTO module_join_students (module_students, module_type_id, module_reference, module_status) 
  VALUES ('".$_SESSION['primary_id']."', '".$_SESSION['module']."','".$_GET['reference']."','1')") or die(db_conn_error);
 

 unset($_SESSION['module']);
 header('Location:'.GEN_WEBSITE.'/students/home.php?reference='.$_GET['reference']);
 exit();
 


}elseif(isset($_SESSION['secondary_module'])){

  mysqli_query($connect,"INSERT INTO secondary_module_join_students (secondary_module_students, secondary_module_type_id, secondary_module_reference, secondary_module_status) 
  VALUES ('".$_SESSION['secondary_id']."', '".$_SESSION['secondary_module']."','".$_GET['reference']."','1')") or die(db_conn_error);
 

 unset($_SESSION['secondary_module']);
 header('Location:'.GEN_WEBSITE.'/students/home-secondary.php?reference='.$_GET['reference']);
 exit();
 

}

  

  
//Perform necessary action
}else{
   echo 'Verification was not successful';
}
