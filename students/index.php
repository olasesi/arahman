<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');

?>
<?php
// if(isset($_SESSION['admin_id'])){   //logged in admins dont have right to teachers login.
// 	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
// 	exit();
// }
?>

<?php
// if(isset($_SESSION['prospective_id'])){   //logged in students dont have right to login again.
// 	header('Location:'.GEN_WEBSITE.'/students/home.php');
// 	exit();
// }
?>

<?php
// if(isset($_SESSION['primary_teacher_id'])){   //logged in teachers dont have right to teachers login.
// 	header('Location:'.GEN_WEBSITE.'/teachers/home.php');
// 	exit();
// }
?>


<?php

if(isset($_SESSION['primary_id']) AND $_SESSION['pri_admit'] == 0){  
  header('Location:'.GEN_WEBSITE.'/school-payment.php');
	exit();
}


if(isset($_SESSION['primary_id'])){
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


if(preg_match('/^.{6,100}$/i',$_POST['password'])){
    $password =  mysqli_real_escape_string($connect,$_POST['password']);
  }else{
    $signup_errors['password'] = "Minimum of 6 characters";
  }



if(empty($signup_errors)){
 
  
  $query = mysqli_query($connect, "SELECT * FROM primary_school_students, primary_school_classes WHERE pri_class_id=primary_class_id AND pri_email='".$email."' AND pri_active_email='1' AND pri_active='1' AND pri_paid='1' AND pri_admit='1'") or die(db_conn_error);
  
  $row = mysqli_fetch_array($query, MYSQLI_NUM);

  
  /*if(password_verify($password, $row[15])){
   

  }


  $query = mysqli_query($connect, "SELECT * FROM primary_school_students, primary_school_classes WHERE pri_class_id=primary_class AND pri_email='".$email."' AND pri_password='".$decrypted."' AND pri_active_email='1' AND  	pri_active='1' AND pri_paid='1' AND pri_admit='1'") or die(db_conn_error);

  echo $encrypted;
  echo '<br>';
  echo $email;*/


 
  if(password_verify($password,$row[15])){
    
    
    

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
$_SESSION['pri_firstname'] = $row[7];
$_SESSION['pri_surname'] = $row[8];
$_SESSION['pri_age'] = $row[9];
$_SESSION['pri_sex'] = $row[10];
$_SESSION['pri_email'] = $row[11];
$_SESSION['pri_photo'] = $row[12];
$_SESSION['pri_phone'] = $row[13];
$_SESSION['pri_address'] = $row[14];
$_SESSION['primary_class'] = $row[20];
 

header('Location:'.GEN_WEBSITE.'/students/home.php');
 exit;











  }else{



    $signup_errors['email'] = 'You entered an incorrect login details or you have been restricted access';
   

  }


}
}
?>

<?php
include_once ('../../incs-arahman/header-admin.php');

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
                    <h2>Admin login</h2>
                  </div>
                 
                 
                  <div class="col-lg-4">
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

    