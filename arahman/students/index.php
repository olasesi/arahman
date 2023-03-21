<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');

?>
<?php
$query = mysqli_query($connect, "DELETE FROM primary_school_students WHERE pri_timestamp < '".date("Y-m-d H:i:s", strtotime("-48 hours"))."' AND pri_active_email='0'") or die(db_conn_error);



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


if(preg_match('/^.{6,100}$/i',$_POST['password'])){
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
  
  $query = mysqli_query($connect, "SELECT * FROM primary_school_students WHERE pri_email='".$email."' AND pri_active_email='1' AND pri_active='1' AND pri_paid='1' AND pri_admit='1'") or die(db_conn_error);
  
  if(mysqli_num_rows($query) == 1){

    while($row = mysqli_fetch_array($query, MYSQLI_NUM)){

 
  if(password_verify($password,$row[16])){
    
    
    

  $value = md5(uniqid(rand(), true));
	$query_confirm_sessions = mysqli_query ($connect, "SELECT pri_cookie_session FROM primary_school_students WHERE pri_email='".$email."'") or die(db_conn_error);
	$cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);
	
	if (empty($cookie_value_if_empty[0])){
	mysqli_query($connect,"UPDATE primary_school_students SET pri_cookie_session = '".$value."' WHERE pri_email='".$email."'") or die(db_conn_error);		
	setcookie("students_remember_me", $value, time() + 4*24*3600);	//4 days for cookie to expire
	
	}else if(!empty($cookie_value_if_empty[0])){
	
	setcookie("students_remember_me", $cookie_value_if_empty[0], time() + 4*24*3600);	//4 days for cookie to expire
	}


$_SESSION['primary_id'] = $row[0];
$_SESSION['pri_class_id'] = $row[5];
$_SESSION['pri_firstname'] = $row[8];
$_SESSION['pri_surname'] = $row[9];
$_SESSION['pri_age'] = $row[10];
$_SESSION['pri_sex'] = $row[11];
$_SESSION['pri_email'] = $row[12];
$_SESSION['pri_photo'] = $row[13];
$_SESSION['pri_phone'] = $row[14];
$_SESSION['pri_address'] = $row[15];


header('Location:'.GEN_WEBSITE.'/students/home.php');
 exit;











  }else{



    $signup_errors['email'] = 'You entered an incorrect login details or you are not allowed now';
   

  }

  }
}else{



  $signup_errors['email'] = 'You entered an incorrect login details or you are not allowed now';
 

}







}elseif($pri_school_type == 'Secondary school'){

  $query = mysqli_query($connect, "SELECT * FROM secondary_school_students WHERE sec_email='".$email."' AND sec_active_email='1' AND sec_active='1' AND sec_paid='1' AND sec_admit='1'") or die(db_conn_error);
  
  if(mysqli_num_rows($query) == 1){

    while($row = mysqli_fetch_array($query, MYSQLI_NUM)){

   // }
 // }
  
  
  //$row = mysqli_fetch_array($query, MYSQLI_NUM);


 
  if(password_verify($password,$row[16])){
    
    
    

  $value = md5(uniqid(rand(), true));
	$query_confirm_sessions = mysqli_query ($connect, "SELECT sec_cookie_session FROM secondary_school_students WHERE sec_email='".$email."'") or die(db_conn_error);
	$cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);
	
	if (empty($cookie_value_if_empty[0])){
	mysqli_query($connect,"UPDATE secondary_school_students SET sec_cookie_session = '".$value."' WHERE sec_email='".$email."'") or die(db_conn_error);		
	setcookie("sec_students_remember_me", $value, time() + 4*24*3600);	//4 days for cookie to expire
	
	}else if(!empty($cookie_value_if_empty[0])){
	
	setcookie("sec_students_remember_me", $cookie_value_if_empty[0], time() + 4*24*3600);	//4 days for cookie to expire
	}

 


$_SESSION['secondary_id'] = $row[0];
$_SESSION['sec_class_id'] = $row[5];
$_SESSION['sec_firstname'] = $row[8];
$_SESSION['sec_surname'] = $row[9];
$_SESSION['sec_age'] = $row[10];
$_SESSION['sec_sex'] = $row[11];
$_SESSION['sec_email'] = $row[12];
$_SESSION['sec_photo'] = $row[13];
$_SESSION['sec_phone'] = $row[14];
$_SESSION['sec_address'] = $row[15];
 

header('Location:'.GEN_WEBSITE.'/students/home-secondary.php');
exit;











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
include('../../incs-arahman/menu.php');
?>


<section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center center-block mt-5 mb-5">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Student login</h2>
                  </div>
                 
                 
                  <div class="col-lg-4"><div style="height:30px;">
                  <?php if(array_key_exists('email', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['email'].'</small>';}?></div>
                  <fieldset>
                    <input name="email" type="text" id="email" placeholder="Email address" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                  </fieldset>
                  </div>
                  
                  <div class="col-lg-4"><div style="height:30px;">
                  <?php if(array_key_exists('password', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password'].'</small>';}?></div>
                 
                  <fieldset>
                    <input name="password" type="password" id="password" placeholder="Password" value="<?php if(isset($_POST['password'])){echo '';} ?>" >
                  </fieldset>
</div>
  
<?php if(array_key_exists('school_type', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['school_type'].'</small>';}?>        
<label for="gridRadios2">Primary school</label>
        <input class="form-check-input" type="radio" name="school_type" id="gridRadios2" value="Primary school" <?php if(isset($_POST['school_type']) && $_POST['school_type'] =='Primary school'){echo 'checked="checked"';} ?>>
        
        <label for="gridRadios3">Secondary school</label>
        <input class="form-check-input" type="radio" name="school_type" id="gridRadios3" value="Secondary school" <?php if(isset($_POST['school_type']) && $_POST['school_type'] == 'Secondary school'){echo 'checked="checked"';} ?>>
       


        
<div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button" name="submit">SUBMIT</button>
                    </fieldset>
                  </div>
                </div>
                <a href="<?php echo GEN_WEBSITE.'/students/forget-password.php'; ?>" class="forget-password">forget password?</a>
              </form>

              
            </div>
          </div>
        </div>
        
      </div>
    </div>
    </section>

    <?php include ('../../incs-arahman/footer.php'); ?>