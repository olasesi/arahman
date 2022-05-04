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

  $query_term_session = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(mysqli_error($connect));
  while($loop_term_session=mysqli_fetch_array($query_term_session)){
    $current_term = $loop_term_session['choose_term'];
    $current_session_term = $loop_term_session['school_session'];
   
  }
  
  if($_SESSION['school_type'] == 'Primary school'){

    mysqli_query($connect, "UPDATE primary_school_students SET pri_paid='1' WHERE pri_email = '".$_SESSION['email']."' AND pri_active_email = '1' AND pri_paid = '0'") or die(mysqli_error($connect));


    $query_id = mysqli_query($connect, "SELECT primary_id FROM primary_school_students WHERE pri_email='".$_SESSION['email']."' AND pri_active_email='1'") or die(mysqli_error($connect));
    if(mysqli_num_rows($query_id) == 1){
while($query_id_while = mysqli_fetch_array($query_id)){
 if($_SESSION['percentage'] == 100){
   $status = 1;
 }else{
  $status = 0;
 }
  $q = mysqli_query($connect,"INSERT INTO primary_payment (primary_payment_students_id, primary_payment_students_reference, primary_payment_term, primary_payment_session,primary_payment_fees, primary_payment_paid_percent, primary_payment_completion_status) 
  VALUES ('".$query_id_while['primary_id']."', '".$_GET['reference']."','". $current_term."','".  $current_session_term."', '".$_SESSION['school_fees']."', '".$_SESSION['percentage']."', '".$status."')") or die(mysqli_error($connect));

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
   
    mysqli_query($connect, "UPDATE secondary_school_students SET sec_paid='1' WHERE sec_email = '".$_SESSION['email']."' AND sec_active_email = '1' AND sec_paid = '0'") or die(mysqli_error($connect));


    $query_id = mysqli_query($connect, "SELECT secondary_id FROM secondary_school_students WHERE sec_email='".$_SESSION['email']."' AND sec_active_email='1'") or die(mysqli_error($connect));
    if(mysqli_num_rows($query_id) == 1){
while($query_id_while = mysqli_fetch_array($query_id)){
 if($_SESSION['percentage'] == 100){
   $status = 1;
 }else{
  $status = 0;
 }
  $q = mysqli_query($connect,"INSERT INTO secondary_payment (secondary_payment_students_id, secondary_payment_students_reference, secondary_payment_term, secondary_payment_session,secondary_payment_fees, secondary_payment_paid_percent, secondary_payment_completion_status) 
  VALUES ('".$query_id_while['secondary_id']."', '".$_GET['reference']."','". $current_term."','".  $current_session_term."', '".$_SESSION['school_fees']."', '".$_SESSION['percentage']."', '".$status."')") or die(mysqli_error($connect));

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

  // if(isset($_SESSION['primary_id'])){

  // }elseif(isset($_SESSION['secondary_id'])){

  // }







  

  
//Perform necessary action
}else{
   echo 'Verification was not successful';
}
