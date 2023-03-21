<?php
require ('../../incs-arahman/config.php');
require ('../../incs-arahman/gen_serv_con.php');
?>
<?php
$query_term_start = mysqli_query($connect, "SELECT term_start, term_end, choose_term FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
  while($term_rows = mysqli_fetch_array($query_term_start)){
    $start_var = $term_rows['term_start'];
    $end_var = $term_rows['term_end'];
    $choose_term_var = $term_rows['choose_term'];
  }
  if(empty($start_var) || empty($end_var) || $choose_term_var != 'Third term'){ 
    include ('../../incs-arahman/header-gen.php');
include('../../incs-arahman/menu.php');
 

 echo '<section class="section main-banner" id="top" data-section="section1">
   <video autoplay muted loop id="bg-video">
     <source src="assets/images/course-video.mp4" type="video/mp4"/>
 </video>

   <div class="video-overlay header-text">
       <div class="container">
           <div class="row">
               <div class="col-lg-12">
                   <div class="caption">
                       <h6></h6>
                       <h2>Registration for new session is closed</h2>
                       <p></a></a></p>
                       <div class="main-button-red">
                           <div class="scroll-to-section"></div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>';

   include ('../../incs-arahman/footer.php');
   exit();

  }
?>
<?php
include ('../../incs-arahman/header-gen.php');
include('../../incs-arahman/menu.php');
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

if(preg_match('/^[0-9]{9,11}$/i',$_POST['phone'])){
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
  
  if(isset($_POST['school_type'])){
    $pri_school_type =  mysqli_real_escape_string($connect,$_POST['school_type']);
    }else{
      $signup_errors['school_type'] = "Please select an option";    }


if(empty($signup_errors)){

  // $taking_session = mysqli_query ($connect,"SELECT school_session, choose_term FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(mysqli_error($connect));
  // while($rows = mysqli_fetch_array($taking_session)){
    
   
  //   $the_term=$rows['choose_term']; 
   
  // $the_session = $rows['school_session'];
     
  // }


if($pri_school_type == 'Primary school'){
        $query = mysqli_query($connect, "SELECT pri_email FROM primary_school_students WHERE pri_email='".$email."'") or die(db_conn_error);
        if(mysqli_num_rows($query)== 0){
          $hash=md5(rand(0,1000));
          $encrypted = password_hash($password, PASSWORD_DEFAULT);
        //$radio does not do anything really. I thought that I would use it but now its too late to remove it. The radio button is hidden


        $q = mysqli_query($connect,"INSERT INTO primary_school_students (pri_class_id, pri_school_term,  pri_year, pri_firstname, pri_surname, pri_age, pri_sex, pri_email, pri_photo, pri_phone, pri_address, pri_password, pri_email_hash, pri_cookie_session) 
          VALUES ('".$radio."', '', '','".$firstname."','".$surname."', '', '','".$email."', '','".$phone."', '','".$encrypted."','".$hash."', '')") or die(mysqli_error($connect));

                if(mysqli_affected_rows($connect) == 1){


          $body = '
          <div style="max-width:1000px; margin-left:auto; margin-right:auto;">
            <div style="font-size:14px; margin-top:50px;">
            <center><h1 style="color:#f5f5f5; background-color:#161616; text-shadow:1px 1px 1px #a2a2a2; padding-top:10px; padding-bottom:10px; text-transform:uppercase;">Prospective Primary Student Registration</h1></center>
            <p>Thank you for registering to be a student on Arahman School. Please click this link to confirm your email.
            <center><a href="'.GEN_WEBSITE.'/verify-email.php?hash='.$hash.'">'.GEN_WEBSITE.'/verify-email.php?hash='.$hash.'</a></center>
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
              </br></br></br></br>
                <h3 class="text-success">Congratulations for the Successful Application</h3>
                
                </br>
                A link has been sent to your email to continue the process. If you do not find the mail in your inbox, please check the spam mails.
              
              </br></br></br>
		
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
}elseif($pri_school_type == 'Secondary school'){


  $query = mysqli_query($connect, "SELECT sec_email FROM secondary_school_students WHERE sec_email='".$email."'") or die(db_conn_error);
        if(mysqli_num_rows($query)== 0){
          $hash=md5(rand(0,1000));
          $encrypted = password_hash($password, PASSWORD_DEFAULT);
        
        $q = mysqli_query($connect,"INSERT INTO secondary_school_students (sec_class_id, sec_school_term, sec_year, sec_firstname, sec_surname, sec_age, sec_sex, sec_email, sec_photo, sec_phone, sec_address, sec_password, sec_email_hash, sec_cookie_session) 
          VALUES ('".$radio."', '', '','".$firstname."','".$surname."', '', '','".$email."', '','".$phone."', '','".$encrypted."','".$hash."', '')") or die(mysqli_error($connect));

                if(mysqli_affected_rows($connect) == 1){


          $body = '
          <div style="max-width:1000px; margin-left:auto; margin-right:auto;">
            <div style="font-size:14px; margin-top:50px;">
            <center><h1 style="color:#f5f5f5; background-color:#161616; text-shadow:1px 1px 1px #a2a2a2; padding-top:10px; padding-bottom:10px; text-transform:uppercase;">Prospective Secondary Student Registration</h1></center>
            <p>Thank you for registering to be a student on Arahman School. Please click this link to confirm your email.
            <center><a href="'.GEN_WEBSITE.'/verify-email-sec.php?hash='.$hash.'">'.GEN_WEBSITE.'/verify-email-sec.php?hash='.$hash.'</a></center>
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
                  <div class="col-lg-4"><div style="height:30px;">
                  <?php if(array_key_exists('firstname', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['firstname'].'</small>';}?> </div>
                  <fieldset>
                      <input name="firstname" type="text" id="firstname" placeholder="Firstname"  value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];} ?>">
                    </fieldset>
                  </div>
                  <div class="col-lg-4"><div style="height:30px;">
                  <?php if(array_key_exists('surname', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['surname'].'</small>';}?> </div>
                  <fieldset>
                      <input name="surname" type="text" id="surname" placeholder="Surname" value="<?php if(isset($_POST['surname'])){echo $_POST['surname'];} ?>">
                    </fieldset>
                  </div>
                  <div class="col-lg-4"><div style="height:30px;">
                  <?php if(array_key_exists('email', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['email'].'</small>';}?>  </div> 
                  <fieldset>
                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Email address" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                  </fieldset>
                  </div>
                  <div class="col-lg-4"><div style="height:30px;">
                  <?php if(array_key_exists('phone', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['phone'].'</small>';}?> </div>  
                  <fieldset>
                      <input name="phone" type="phone" id="number" placeholder="Phone number" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>">
                    </fieldset>
                  </div>
                  <div class="col-lg-4">
                  <div style="height:30px;"><?php if(array_key_exists('password', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password'].'</small>';}?>  
                  <?php if(array_key_exists('password_match', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password_match'].'</small>';}?></div>
                  <fieldset>
                    <input name="password" type="password" id="password" placeholder="Password" >
                  </fieldset>
</div>
                  
                  <div class="col-lg-4"><div style="height:30px;"></div>
                    <fieldset>
                    <input name="confirm_password" type="password" id="confirm_password" placeholder="Confirm Password" >
                  </fieldset>
</div>


 <!--This is only used to select the school to choose. This was not used in the validation. Not also in the database-->
        <label for="gridRadios2">Primary school</label>
        <input class="form-check-input" type="radio" name="school_type" id="gridRadios2" value="Primary school" <?php if(isset($_POST['school_type']) && $_POST['school_type'] =='Primary school'){echo 'checked="checked"';} ?>>
        
        <label for="gridRadios3">Secondary school</label>
        <input class="form-check-input" type="radio" name="school_type" id="gridRadios3" value="Secondary school" <?php if(isset($_POST['school_type']) && $_POST['school_type'] == 'Secondary school'){echo 'checked="checked"';} ?>>
 <!--This is only used to select the school to choose. This was not used in the validation. Not also in the database-->



    <!--This will only be used for class id- to know the class they will belong to. 0 is value by default-->    
        <input class="form-check-input" type="hidden" name="radio" id="gridRadios1" value="0" >
       <?php if(array_key_exists('school_type', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['school_type'].'</small>';}?>
    <!--This will only be used for class id- to know the class they will belong to. 0 is value by default-->    
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