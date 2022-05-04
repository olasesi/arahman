<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');

?>
<?php
$toggle_position = mysqli_query($connect,"SELECT admin_pay_reg_toggle FROM admin_owner WHERE admin_pay_reg_toggle = 'close'") or die(db_conn_error);
if(mysqli_num_rows($toggle_position) == 1){

  include_once ('../../incs-arahman/header-admin.php');

echo 'Payment from portal is currently close';

exit();

}

?>
<?php
if(isset($_SESSION['primary_id'])){
  header('Location:'.GEN_WEBSITE.'/students/home.php');
exit();
}

?>
<?php
if(isset($_SESSION['secondary_id'])){
  header('Location:'.GEN_WEBSITE.'/students/home.php');
exit();
}

?>
<?php
$signup_errors = array();
if(isset($_POST['submit']) AND $_SERVER['REQUEST_METHOD'] == "POST"){

  if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
	$email = mysqli_real_escape_string($connect,$_POST['email']);
}else{
	$signup_errors['email'] = "Enter a valid email address";
}


if(preg_match('/^.{6,255}$/i',$_POST['password'])){
    $password =  mysqli_real_escape_string($connect,$_POST['password']);
  }else{
    $signup_errors['password'] = "Minimum of 6 characters";
  }
 
  if(isset($_POST['school_type'])){
    $pri_school_type =  $_POST['school_type'];
   }else{
    $signup_errors['school_type'] = "Select school";

   }




    if(empty($signup_errors)){
 

  if($pri_school_type == 'Primary school'){
  
  $query = mysqli_query($connect, "SELECT * FROM primary_school_students WHERE pri_email='".$email."' AND pri_active_email='1'") or die(db_conn_error);
  
  if(mysqli_num_rows($query) == 1){

    while($row = mysqli_fetch_array($query, MYSQLI_NUM)){

 
  if(password_verify($password,$row[16])){
    
    $finding_fees = mysqli_query ($connect, "SELECT primary_class, primary_class_fees, pri_email FROM primary_school_students INNER JOIN primary_school_classes ON pri_class_id = primary_class_id WHERE pri_email='".$email."'") or die(db_conn_error);

    if(mysqli_num_rows($finding_fees) == 1){
    while($rows = mysqli_fetch_array($finding_fees)){

$_SESSION['school_type'] = $pri_school_type; 
$_SESSION['email'] = $email;
$_SESSION['school_fees'] = $rows['primary_class_fees'];
$_SESSION['school_class_name'] = $rows['primary_class'];

header('Location:'.GEN_WEBSITE.'/students/percentage-payment.php');
exit();
    
  }

    }else{

      $signup_errors['admission'] = 'Please contact the admission department';
    }
	











  }else{



    $signup_errors['email'] = 'You entered an incorrect login details or you are not allowed now';
   

  }

  }
}else{



  $signup_errors['email'] = 'You entered an incorrect login details or you are not allowed now';
 

}







}elseif($pri_school_type == 'Secondary school'){

  $query = mysqli_query($connect, "SELECT * FROM secondary_school_students WHERE sec_email='".$email."' AND sec_active_email='1'") or die(db_conn_error);
  
  if(mysqli_num_rows($query) == 1){

    while($row = mysqli_fetch_array($query, MYSQLI_NUM)){

 
  if(password_verify($password,$row[16])){
   

        
    $finding_fees_sec = mysqli_query ($connect, "SELECT secondary_class, secondary_class_fees, sec_email FROM secondary_school_students INNER JOIN secondary_school_classes ON sec_class_id = secondary_class_id WHERE sec_email='".$email."'") or die(db_conn_error);

    if(mysqli_num_rows($finding_fees_sec) == 1){
     
      while($rows_sec = mysqli_fetch_array($finding_fees_sec)){

        $_SESSION['school_type'] = $pri_school_type; 
        $_SESSION['email'] = $email;
        $_SESSION['school_fees'] = $rows_sec['secondary_class_fees'];
        $_SESSION['school_class_name'] = $rows_sec['secondary_class'];
        
        
       
        
        
        header('Location:'.GEN_WEBSITE.'/students/percentage-payment.php');
        exit();


          }


    }else{

      $signup_errors['admission'] = 'Please contact the admission department';
    }
	



    }else{



    $signup_errors['email'] = 'You entered an incorrect login details or you are not allowed now';
   

  }



    }
  }else{
    $signup_errors['email'] = 'You entered an incorrect login details or you are not allowed now';

  }












}



}


}
?>

<?php
include_once ('../../incs-arahman/header-admin.php');

?>
<?php
if(isset($_GET['reference'])){
 $query_id = mysqli_query($connect, "SELECT	primary_payment_students_reference FROM primary_payment WHERE primary_payment_students_reference='".$_GET['reference']."'") or die(db_conn_error);

if(mysqli_num_rows($query_id) == 1){
  echo 'Payment was successful';
}


$query_id = mysqli_query($connect, "SELECT	secondary_payment_students_reference FROM secondary_payment WHERE secondary_payment_students_reference='".$_GET['reference']."'") or die(db_conn_error);

if(mysqli_num_rows($query_id) == 1){
  echo 'Payment was successful';
}


}

?>

<section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center center-block">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Student fees payment</h2>
                  </div>
                 
                 
                  <div class="col-lg-4">
                 
                  <?php if(array_key_exists('admission', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['admission'].'</small>';}?>   
                  <?php if(array_key_exists('email', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['email'].'</small>';}?>   
                  <fieldset>
                    <input name="email" type="text" id="email" placeholder="Email address" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                  </fieldset>
                  </div>
                  
                  <div class="col-lg-4">
                  <?php if(array_key_exists('password', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password'].'</small>';}?>  
                 
                  <fieldset>
                    <input name="password" type="password" id="password" placeholder="Password" value="<?php if(isset($_POST['password'])){echo '';} ?>" >
                  </fieldset>
</div>
  

<label for="gridRadios2">Primary school</label>
        <input class="form-check-input" type="radio" name="school_type" id="gridRadios2" value="Primary school" <?php if(isset($_POST['school_type']) && $_POST['school_type'] =='Primary school'){echo 'checked="checked"';} ?>>
        
        <label for="gridRadios3">Secondary school</label>
        <input class="form-check-input" type="radio" name="school_type" id="gridRadios3" value="Secondary school" <?php if(isset($_POST['school_type']) && $_POST['school_type'] == 'Secondary school'){echo 'checked="checked"';} ?>>
        <?php if(array_key_exists('school_type', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['school_type'].'</small>';}?>        


        
<div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button" name="submit">SUBMIT</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    </section>

    