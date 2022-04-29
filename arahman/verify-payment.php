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
  
  if($_SESSION['school_type'] == 'Primary school'){

    mysqli_query($connect, "UPDATE primary_school_students SET pri_paid='1' WHERE pri_email = '".$_SESSION['email']."' AND pri_active_email = '1' AND pri_paid = '0'") or die(db_conn_error);


    $query_id = mysqli_query($connect, "SELECT primary_id FROM primary_school_students WHERE pri_email='".$_SESSION['email']."' AND pri_active_email='1'") or die(db_conn_error);
    if(mysqli_num_rows($query_id) == 1){
while($query_id_while = mysqli_fetch_array($query_id)){

  
}

    }

    $q = mysqli_query($connect,"INSERT INTO primary_payment (primary_payment_students_id, primary_payment_students_reference, primary_payment_term, primary_payment_session,primary_payment_fees,primary_payment_status) 
        VALUES ('".$_SESSION['primary_id']."', '".$_GET['reference']."','".$current_term."','". $current_session_term."', '".$result['data']['amount']."', '".$result['data']['status']."')") or die(db_conn_error);
    

  }elseif($_SESSION['school_type'] == 'Secondary school'){
    mysqli_query($connect, "UPDATE secondary_school_students SET sec_paid='1' WHERE sec_email = '".$_SESSION['email']."' AND sec_active_email = '1' AND sec_paid = '0'") or die(db_conn_error);




  }

  if(isset($_SESSION['primary_id'])){

  }elseif(isset($_SESSION['secondary_id'])){}







  if(!$_SESSION['primary_id']){

  $query = mysqli_query($connect, "SELECT primary_id, pri_email FROM primary_school_students WHERE pri_email='".$_SESSION['email']."' AND pri_active_email='1'") or die(db_conn_error);

  if(mysqli_num_rows($query) == 1){
while($find_student = mysqli_fetch_array($query)){
 mysqli_query($connect, "UPDATE primary_school_students SET pri_paid='1' WHERE pri_email = '".$_SESSION['email']."' AND pri_active_email = '1' AND pri_paid = '0'") or die(db_conn_error);

$q = mysqli_query($connect,"INSERT INTO primary_payment (primary_payment_students_id, primary_payment_students_reference, primary_payment_term, primary_payment_session,primary_payment_fees,primary_payment_status) 
    VALUES ('".$_SESSION['primary_id']."', '".$_GET['reference']."','".$current_term."','". $current_session_term."', '".$result['data']['amount']."', '".$result['data']['status']."')") or die(db_conn_error);
}
}elseif(mysqli_num_rows($query_sec) == 0){
  $query_sec = mysqli_query($connect, "SELECT sec_email FROM secondary_school_students WHERE sec_email='".$_SESSION['email']."' AND sec_active_email='1'") or die(db_conn_error);
  if(mysqli_num_rows($query_sec) == 1){

    mysqli_query($connect, "UPDATE secondary_school_students SET sec_paid='1' WHERE secondary_id = '".$_SESSION['email']."' pri_active_email = '1' AND pri_paid = '0'") or die(db_conn_error);
   
   $q_sec = mysqli_query($connect,"INSERT INTO primary_payment (primary_payment_students_id, primary_payment_students_reference, primary_payment_term, primary_payment_session,primary_payment_fees,primary_payment_status) 
       VALUES ('".$_SESSION['primary_id']."', '".$_GET['reference']."','".$current_term."','". $current_session_term."', '".$result['data']['amount']."', '".$result['data']['status']."')") or die(db_conn_error);
   
   }



}      
}elseif($_SESSION['primary_id']){

  echo 'This should come in the dashboard';
}

  
//Perform necessary action
}else{
   echo 'Verification was not successful';
}
