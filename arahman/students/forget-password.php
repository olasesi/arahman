<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');

?>
<?php

if(isset($_SESSION['primary_id'])){
  header('Location:'.GEN_WEBSITE.'/students/home.php');
exit();
}

if(isset($_SESSION['secondary_id'])){
  header('Location:'.GEN_WEBSITE.'/students/home-secondary.php');
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


  if(isset($_POST['school_type'])){
    $pri_school_type =  $_POST['school_type'];
   }else{
    $signup_errors['school_type'] = "Select school";

   }




    if(empty($signup_errors)){
 

  if($pri_school_type == 'Primary school'){
  
  $query = mysqli_query($connect, "SELECT * FROM primary_school_students WHERE pri_email='".$email."' AND pri_active_email='1'") or die(db_conn_error);
  
  if(mysqli_num_rows($query) == 1){
    $hash=md5(rand(0,1000000));
   
    mysqli_query($connect,"UPDATE primary_school_students SET pri_email_hash = '".$hash."' WHERE pri_email='".$email."' AND pri_active_email='1'") or die(db_conn_error);

    $body = '
          <div style="max-width:1000px; margin-left:auto; margin-right:auto;">
            <div style="font-size:14px; margin-top:50px;">
            <center><h1 style="color:#f5f5f5; background-color:#161616; text-shadow:1px 1px 1px #a2a2a2; padding-top:10px; padding-bottom:10px; text-transform:uppercase;">Password Reset Link</h1></center>
            <p>Please click this link to reset your password.
            <center><a href="'.GEN_WEBSITE.'/students/password-reset.php?hash='.$hash.'&school=1">Reset Password</a></center>
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
              
              mail($email, 'Password reset for student', $body, $headers);	
              
              //edit 1
              echo '<header id="home" class="home">
                      <div class="overlay-fluid-block">
                          <div class="container text-center">
                              <div class="row">
                                  <div class="home-wrapper">
                                      <div class="text-center">
                  
              <div class="home-content">
                <h3 class="text-success">Your password has been reset</h3>
                
                </br>
                A link has been sent to your email to reset your password. If you do not find the mail in your inbox, please check the spam mails.
              
              
		
		</div>
                            
							</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';
	
		
    include ('../../incs-arahman/footer.php');
		exit();


  
}


}elseif($pri_school_type == 'Secondary school'){

  $query = mysqli_query($connect, "SELECT * FROM secondary_school_students WHERE sec_email='".$email."' AND sec_active_email='1'") or die(db_conn_error);
  
  if(mysqli_num_rows($query) == 1){

    $hash=md5(rand(0,1000000));
   
    mysqli_query($connect,"UPDATE secondary_school_students SET sec_email_hash = '".$hash."' WHERE sec_email='".$email."' AND sec_active_email='1'") or die(db_conn_error);

    $body = '
          <div style="max-width:1000px; margin-left:auto; margin-right:auto;">
            <div style="font-size:14px; margin-top:50px;">
            <center><h1 style="color:#f5f5f5; background-color:#161616; text-shadow:1px 1px 1px #a2a2a2; padding-top:10px; padding-bottom:10px; text-transform:uppercase;">Password Reset Link</h1></center>
            <p>Please click this link to reset your password.
            <center><a href="'.GEN_WEBSITE.'/students/password-reset.php?hash='.$hash.'&school=2">Reset Password</a></center>
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
              
              mail($email, 'Password reset for student', $body, $headers);	
              
              //edit 1
              echo '<header id="home" class="home">
                      <div class="overlay-fluid-block">
                          <div class="container text-center">
                              <div class="row">
                                  <div class="home-wrapper">
                                      <div class="text-center">
                  
              <div class="home-content">
                <h3 class="text-success">Your password has been reset</h3>
                
                </br>
                A link has been sent to your email to reset your password. If you do not find the mail in your inbox, please check the spam mails.
              
              
		
		</div>
                            
							</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';
	
		
    include ('../../incs-arahman/footer.php');
		exit();





  }












}



}


}
?>

<?php
include_once ('../../incs-arahman/header-admin.php');
include_once ('../../incs-arahman/menu-admin.php');
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
                    <h2>Forget Password</h2>
                  </div>
                 
                 
                  <div class="col-lg-4">
                  <?php if(array_key_exists('email', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['email'].'</small>';}?>   
                  <fieldset>
                    <input name="email" type="text" id="email" placeholder="Email address" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
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

    <?php include ('../../incs-arahman/footer.php');?>