<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');

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
   echo 'Registration for new session is closed';
   include ('../../incs-arahman/footer.php');
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
 

    if(empty($signup_errors)){


  $query = mysqli_query($connect, "SELECT * FROM secondary_school_students WHERE sec_email='".$email."' AND sec_active_email='1'") or die(db_conn_error);
  
  if(mysqli_num_rows($query) == 1){

    while($row = mysqli_fetch_array($query, MYSQLI_NUM)){

 
  if(password_verify($password,$row[16])){
   

        
    $finding_fees_sec = mysqli_query ($connect, "SELECT sec_email FROM secondary_school_students  WHERE sec_email='".$email."'") or die(db_conn_error);

    if(mysqli_num_rows($finding_fees_sec) == 1){
     
      while($rows_sec = mysqli_fetch_array($finding_fees_sec)){

      
        $_SESSION['common_entrance_email'] = $email;
       
       
        
        
       
        
        
        header('Location:'.GEN_WEBSITE.'/students/common-entrance-payment.php');
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
?>

<?php
include_once ('../../incs-arahman/header-admin.php');

?>
<?php
if(isset($_GET['reference'])){

$query_id = mysqli_query($connect, "SELECT secondary_common_e_reference FROM secondary_common_e WHERE secondary_common_e_reference='".$_GET['reference']."'") or die(db_conn_error);

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
                    <h2>Common entrance payment</h2>
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

    