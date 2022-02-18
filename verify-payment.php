<?php
require_once ('../incs-arahman/config.php');
require_once ('../incs-arahman/gen_serv_con.php');



if(!isset($_SESSION['primary_id'])){
    header('Location:'.GEN_WEBSITE.'/school-fees-payment.php');
  exit();
  }
  
  
  if($_SESSION['pri_admit'] == 1){   //logged in students dont have right to login again.
      header('Location:'.GEN_WEBSITE.'/students/home.php');
      exit();
  }
  


$result = array();
//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/'.$_GET['reference'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
$ch, CURLOPT_HTTPHEADER, [
'Authorization: Bearer sk_test_*****************************']
);
$request = curl_exec($ch);
curl_close($ch);

if ($request) {
$result = json_decode($request, true);
}

if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {

    // $query_term_start_end = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
  
    // while($whiling_term_start_end = mysqli_fetch_array($query_term_start_end)){

    //   $term = $whiling_term_start_end['choose_term'];
    //   $session = $whiling_term_start_end['school_session'];
    // }


    mysqli_query($connect, "UPDATE primary_school_students SET pri_paid='1',  WHERE primary_id = '".$_SESSION['primary_id']."' AND pri_admit = '0' AND pri_active_email = '1' AND pri_paid = '0'") or die(db_conn_error);

    // if(mysqli_affected_rows($connect) == 1){
    
    
    // }

    $query_term_session = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
    while($loop_term_session=mysqli_fetch_array($query_term_session)){
      $current_term = $loop_term_session['choose_term'];
      $current_session_term = $loop_term_session['school_session'];
     
    }
    
    
    $q = mysqli_query($connect,"INSERT INTO primary_payment (primary_payment_students_id, primary_payment_students_reference, primary_payment_term, primary_payment_session,primary_payment_fees,primary_payment_status) 
    VALUES ('".$_SESSION['primary_id']."', '".$_GET['reference']."','".$current_term."','". $current_session_term."', '".$result['data']['amount']."', '".$result['data']['status']."')") or die(db_conn_error);

          




  
	

    // $q = mysqli_query($connect,"INSERT INTO primary_school_students (pri_class_id, pri_year, pri_firstname, pri_surname, pri_age, pri_sex, pri_email, pri_photo, pri_phone, pri_address, pri_password, pri_email_hash, pri_cookie_session) 
    // VALUES ('".$radio."', '','".$firstname."','".$surname."', '', '','".$email."', '','".$phone."', '','".$encrypted."','".$hash."', '')") or die(db_conn_error);



    
    header('Location:'.GEN_WEBSITE.'/school-payment.php?ref='.$_GET['reference'].'&status='.$result['data']['status']);
    exit();
   
//Perform necessary action
}else{
    header('Location:'.GEN_WEBSITE.'/school-payment.php?status=0');
    exit();
}
