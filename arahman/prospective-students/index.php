<?php
require ('../../incs-arahman/config.php');
require ('../../incs-arahman/gen_serv_con.php');
include ('../../incs-arahman/header-gen.php');
include('../../incs-arahman/menu.php');
?>
<?php
// if(isset($_SESSION['primary_id'])){
// 	header("Location:/");
// 	exit();
// }



?>

<?php
$signup_errors = array();
if(isset($_POST['submit']) AND $_SERVER['REQUEST_METHOD']== "POST" ){

  if (preg_match ('/^[a-zA-Z]{3,20}$/i', trim($_POST['firstname']))) {		//only 20 characters are allowed to be inputted
		$firstname = mysqli_real_escape_string ($connect, trim($_POST['firstname']));
	} else {
		$signup_errors['firstname'] = 'Maximum characters, 20';
	} 

  if (preg_match ('/^[a-zA-Z]{3,20}$/i', trim($_POST['surname']))) {		//only 20 characters are allowed to be inputted
		$surname = mysqli_real_escape_string ($connect, trim($_POST['surname']));
	} else {
		$signup_errors['surname'] = 'Maximum characters, 20';
	} 

if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
	$email = mysqli_real_escape_string($connect,$_POST['email']);
}else{
	$signup_errors['email'] = "Enter a valid email address";
}

if(preg_match('/^(0)[0-9]{10}$/i',$_POST['phone'])){
	$phone =  mysqli_real_escape_string($connect,$_POST['phone']);
}else{
	$signup_errors['phone'] = "Enter a valid phone number";
}



if($_POST['password'] == $_POST['confirm_password']){
	if(preg_match('/^.{6,100}$/i',$_POST['password'])){
    $password =  mysqli_real_escape_string($connect,$_POST['password']);
  }else{
    $signup_errors['password'] = "Minimum of 6 characters";
  }
}else{
	$signup_errors['password_match'] = "Password did not match";
}

if(isset($_POST['radio'])){
  $radio =  mysqli_real_escape_string($connect,$_POST['radio']);
  
}



if(empty($signup_errors)){


        $query = mysqli_query($connect, "SELECT pri_email FROM primary_school_students WHERE pri_email='".$email."'") or die(db_conn_error);
        if(mysqli_num_rows($query)== 0){
          $hash=md5(rand(0,1000));
          $encrypted = password_hash($password, PASSWORD_DEFAULT);
        
        $q = mysqli_query($connect,"INSERT INTO primary_school_students (pri_class_id, pri_year, pri_firstname, pri_surname, pri_age, pri_sex, pri_email, pri_photo, pri_phone, pri_address, pri_password, pri_email_hash, pri_cookie_session) 
          VALUES ('".$radio."', '','".$firstname."','".$surname."', '', '','".$email."', '','".$phone."', '','".$encrypted."','".$hash."', '')") or die(db_conn_error);

                if(mysqli_affected_rows($connect) == 1){


          $body = '
          <div style="max-width:1000px; margin-left:auto; margin-right:auto;">
            <div style="font-size:14px; margin-top:50px;">
            <center><h1 style="color:#f5f5f5; background-color:#161616; text-shadow:1px 1px 1px #a2a2a2; padding-top:10px; padding-bottom:10px; text-transform:uppercase;">Prospective Primary Student Registration</h1></center>
            <p>Thank you for registering to be a student on Arahman School. Please click this link to confirm your email.
            <center><a href="https://arahmanschool.com/verify-email.php?surname='.$surname.'&&hash='.$hash.'">https://arahmanschool.com/verify-email.php?hash='.$hash.'</a></center>
            </p>
            
            
            </div>
          </div>

          ';
              
              $headers = 'MIME-Version: 1.0' . "\r\n";
              $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
              $headers .= 'From: noreply@myshoptwo.com' . "\r\n";
              $headers .= 'Reply-To: noreply@myshoptwo.com' . "\r\n";
              $headers .= 'Return-Path: noreply@myshoptwo.com' . "\r\n";
              $headers .= 'BCC: noreply@myshoptwo.com' . "\r\n";
              $headers .= 'X-Priority: 3' . "\r\n";
              $headers .= 'X-Mailer: PHP/'. phpversion() . "\r\n";
              
              mail($email, 'Arahman School Registration', $body, $headers);	
              
              //edit 1
              echo '<header id="home" class="home">
                      <div class="overlay-fluid-block">
                          <div class="container text-center">
                              <div class="row">
                                  <div class="home-wrapper">
                                      <div class="text-center">
                  
              <div class="home-content">
                <h3 class="text-success">Congratulations for the Successful Application</h3>
                
                </br>
                A link has been sent to your email to continue the process. If you do not find the mail in your inbox, please check the spam mails.
              
              
		
		</div>
                            
							</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';
	
		
    include ('../../incs-arahman/footer.php');
		exit();


  }else{
    trigger_error('You could not be registered due to a system error. We apologize for any inconvenience.');

  }


  }else{



    $signup_errors['email'] = 'This email has already been registered. Please try another.';
   

  }










}

}
?>








<section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center center-block">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" action="" method="POST">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Prospective students</h2>
                  </div>
                  <div class="col-lg-4">
                  <?php if(array_key_exists('firstname', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['firstname'].'</small>';}?> 
                  <fieldset>
                      <input name="firstname" type="text" id="firstname" placeholder="Firstname"  value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];} ?>">
                    </fieldset>
                  </div>
                  <div class="col-lg-4">
                  <?php if(array_key_exists('surname', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['surname'].'</small>';}?> 
                  <fieldset>
                      <input name="surname" type="text" id="surname" placeholder="Surname" value="<?php if(isset($_POST['surname'])){echo $_POST['surname'];} ?>">
                    </fieldset>
                  </div>
                  <div class="col-lg-4">
                  <?php if(array_key_exists('email', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['email'].'</small>';}?>   
                  <fieldset>
                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Email address" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                  </fieldset>
                  </div>
                  <div class="col-lg-4">
                  <?php if(array_key_exists('phone', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['phone'].'</small>';}?>   
                  <fieldset>
                      <input name="phone" type="phone" id="number" placeholder="Phone number" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>">
                    </fieldset>
                  </div>
                  <div class="col-lg-4">
                  <?php if(array_key_exists('password', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password'].'</small>';}?>  
                  <?php if(array_key_exists('password_match', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password_match'].'</small>';}?>
                  <fieldset>
                    <input name="password" type="password" id="password" placeholder="Password" value="<?php if(isset($_POST['password'])){echo '';} ?>" >
                  </fieldset>
</div>
                  
                  <div class="col-lg-4">
                    <fieldset>
                    <input name="confirm_password" type="password" id="confirm_password" placeholder="Confirm Password" value="<?php if(isset($_POST['confirm_password'])){echo '';} ?>">
                  </fieldset>
</div>



        <input class="form-check-input" type="hidden" name="radio" id="gridRadios1" value="0" >
       
  





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




   <?php include ('../../incs-arahman/footer.php'); ?>
    