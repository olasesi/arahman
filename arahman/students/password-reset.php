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
include_once ('../../incs-arahman/header-admin.php');

?>
<?php 
if(!isset($_GET['hash'])){
  echo '<center><h2>Invalid link</h2></center>';
  
   
exit();

}
?>
<?php 
if(!isset($_GET['school'])){
  echo '<center><h2>Invalid link</h2></center>';
  
   
exit();

}
?>

<?php
$signup_errors = array();
if(isset($_POST['submit']) AND $_SERVER['REQUEST_METHOD']== "POST" ){


if($_POST['password'] == $_POST['confirm_password']){
	if(preg_match('/^.{6,100}$/i',$_POST['password'])){
    $password =  mysqli_real_escape_string($connect,$_POST['password']);
  }else{
    $signup_errors['password'] = "Minimum of 6 characters";
  }
}else{
	$signup_errors['password_match'] = "Password did not match";
}


if(empty($signup_errors)){

 
if($_GET['school'] == 1){
      $encrypted = password_hash($password, PASSWORD_DEFAULT);
      
      $q = mysqli_query($connect,"UPDATE primary_school_students SET pri_password = '".$encrypted."', pri_email_hash = '' WHERE pri_email_hash = '".mysqli_real_escape_string($connect, $_GET['hash'])."' AND pri_active_email='1'") or die(db_conn_error);	

                if(mysqli_affected_rows($connect) == 1){


         
            
              //edit 1
              echo '<header id="home" class="home">
                      <div class="overlay-fluid-block">
                          <div class="container text-center">
                              <div class="row">
                                  <div class="home-wrapper">
                                      <div class="text-center">
                  
              <div class="home-content">
                <h3 class="text-success">Password was successfully changed</h3>
                
                </br>
               Your password has been reset. Go to student login to enter your account.
              
              
		
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


  
}elseif($_GET['school'] == 2){

          $encrypted = password_hash($password, PASSWORD_DEFAULT);
        
          $q = mysqli_query($connect,"UPDATE secondary_school_students SET sec_password = '".$encrypted."', sec_email_hash = '' WHERE sec_email_hash = '".mysqli_real_escape_string($connect, $_GET['hash'])."' AND sec_active_email='1'") or die(db_conn_error);	

                if(mysqli_affected_rows($connect) == 1){


       
              //edit 1
              echo '<header id="home" class="home">
              <div class="overlay-fluid-block">
                  <div class="container text-center">
                      <div class="row">
                          <div class="home-wrapper">
                              <div class="text-center">
          
      <div class="home-content">
        <h3 class="text-success">Password was successfully changed</h3>
        
        </br>
       Your password has been reset. Go to student login to enter your account.
      
      

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

    echo '<center><h2>Invalid link</h2></center>';


}


}
}


?>


<?php
if($_GET['school'] == 1){
  
  $query = mysqli_query($connect, "SELECT pri_email_hash FROM primary_school_students WHERE pri_email_hash='".mysqli_real_escape_string($connect, $_GET['hash'])."' AND pri_active_email='1'") or die(db_conn_error);

if(mysqli_num_rows($query) == 1){

   echo '<section class="contact-us" id="contact">
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
                
                  <div class="col-lg-4">';
                  if(array_key_exists('password', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password'].'</small>';}  
                  if(array_key_exists('password_match', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password_match'].'</small>';}
                  echo '<fieldset>
                    <input name="password" type="password" id="password" placeholder="Password" >
                  </fieldset>
</div>
                  
                  <div class="col-lg-4">
                    <fieldset>
                    <input name="confirm_password" type="password" id="confirm_password" placeholder="Confirm Password" >
                  </fieldset>
</div>


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
    </section>';

}else{

    echo '<center><h2>Invalid link</h2></center>';

}


}elseif($_GET['school'] == 2){
    $query = mysqli_query($connect, "SELECT sec_email_hash FROM secondary_school_students WHERE sec_email_hash='".mysqli_real_escape_string($connect, $_GET['hash'])."' AND sec_active_email='1'") or die(db_conn_error);

    if(mysqli_num_rows($query) == 1){
    
        echo '<section class="contact-us" id="contact">
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
                    
                      <div class="col-lg-4">';
                      if(array_key_exists('password', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password'].'</small>';}  
                      if(array_key_exists('password_match', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password_match'].'</small>';}
                      echo '<fieldset>
                        <input name="password" type="password" id="password" placeholder="Password" >
                      </fieldset>
    </div>
                      
                      <div class="col-lg-4">
                        <fieldset>
                        <input name="confirm_password" type="password" id="confirm_password" placeholder="Confirm Password" >
                      </fieldset>
    </div>
    
    
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
        </section>';
    
    
    }else{

        echo '<center><h2>Invalid link</h2></center>';
    
    }
    


}else{

    echo '<center><h2>Invalid link</h2></center>';
}
?>
<?php include ('../../incs-arahman/footer.php');?>