<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');

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
  $query = mysqli_query($connect, "SELECT * FROM primary_school_students WHERE pri_email='".$email."' AND pri_password='".$password."' AND pri_paid='0' AND pri_admit='0'") or die(db_conn_error);
  if(mysqli_num_rows($query)== 1){
    $row = mysqli_fetch_array ($query, MYSQLI_NUM);

  $value = md5(uniqid(rand(), true));
	$query_confirm_sessions = mysqli_query ($connect, "SELECT primary_teacher_cookie FROM primary_teachers WHERE primary_teacher_email='".$email."'") or die(db_conn_error);
	$cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);
	
	if (empty($cookie_value_if_empty[0])){
	mysqli_query($connect,"UPDATE primary_teachers SET primary_teacher_cookie = '".$value."' WHERE primary_teacher_email='".$email."'") or die(db_conn_error);		
	setcookie("teacher_remember_me", $value, time() + 4*24*3600);	//4 days for cookie to expire
	
	}else if(!empty($cookie_value_if_empty[0])){
	
	setcookie("teacher_remember_me", $cookie_value_if_empty[0], time() + 4*24*3600);	//4 days for cookie to expire
	}
  

$_SESSION['primary_teacher_id'] = $row[0];
$_SESSION['primary_teacher_class_id'] = $row[2];
$_SESSION['primary_teacher_firstname'] = $row[3];
$_SESSION['primary_teacher_surname'] = $row[4];
$_SESSION['primary_teacher_email'] = $row[5];
$_SESSION['primary_teacher_sex'] = $row[7];
$_SESSION['primary_teacher_age'] = $row[8];
$_SESSION['primary_teacher_phone'] = $row[9];
$_SESSION['primary_teacher_qualification'] = $row[10];
$_SESSION['primary_teacher_address'] = $row[11];
$_SESSION['primary_teacher_image'] = $row[12];
$_SESSION['primary_class'] = $row[16];
 

header('Location:'.GEN_WEBSITE.'/teachers/home.php');
 exit;












  }else{



    $signup_errors['email'] = 'Invalid login details or you have been banned';
   

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

    