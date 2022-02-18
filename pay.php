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

if(!isset($_POST['pay'])){
    header('Location:'.GEN_WEBSITE.'/school-payment.php');
    exit();
}

$errors = array();
if (isset($_POST['pay'])){

  if ($_POST['primary_payment'] == "Choose school class") {
    $errors['school_price'] = 'Please select school class';
  } else{
  $pri_class_price = $_POST['primary_payment'];
  }


if(!empty($errors)){
    header('Location:'.GEN_WEBSITE.'/school-payment.php?select-class=not-selected');
    exit();

}



}



$result = array();

//Set other parameters as keys in the $postdata array
$postdata = [
    'email' => $_POST['email'],
    'amount' => $pri_class_price,
    'reference' => genReference(10),
    'callback_url' => GEN_WEBSITE.'/verify-payment.php'
];

$url = "https://api.paystack.co/transaction/initialize";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));  //Post Fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
    'Authorization: Bearer sk_test_*********************************',
    'Content-Type: application/json',

];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$request = curl_exec($ch);

curl_close($ch);

if ($request) {

    $result = json_decode($request, true);

    header('Location: ' . $result['data']['authorization_url']);

}