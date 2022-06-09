<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');

?>
<?php
if(!isset($_SESSION['school_type']) || !isset($_SESSION['email'])){
  header('Location:'.GEN_WEBSITE.'/students/school-fees-payment.php');
  exit();
}

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
if(isset($_POST['reset']) AND $_SERVER['REQUEST_METHOD'] == "POST"){
  unset($_SESSION['school_type']);
  unset($_SESSION['email']);
  unset($_SESSION['school_fees']);
  unset($_SESSION['school_class_name']);
  unset($_SESSION['percentage']);
  header('Location:'.GEN_WEBSITE.'/students/school-fees-payment.php');
  exit();

}

?>
<?php
$signup_errors = array();
if(isset($_POST['submit']) AND $_SERVER['REQUEST_METHOD'] == "POST"){

if(isset($_POST['post_school_fees'])){
  $var_fees = $_POST['post_school_fees'];
 }else{
  $signup_errors['post_school_fees'] = "Choose option";

 }



 if(empty($signup_errors)){
if($_SESSION['school_type'] == 'Primary school'){
  $_SESSION['percentage'] = ($var_fees/$_SESSION['school_fees']) * 100; 

$email = $_SESSION['email'];
 $class_price  = ceil($var_fees) * 100;

 include ('../../incs-arahman/pay.php');



}elseif($_SESSION['school_type'] == 'Secondary school'){
  $_SESSION['percentage'] = ($var_fees/$_SESSION['school_fees']) * 100;
  $email = $_SESSION['email'];
  $class_price  = ceil($var_fees) * 100;
  include ('../../incs-arahman/pay.php');
}

}








}

?>

<?php include_once ('../../incs-arahman/header-admin.php');?>




<section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center center-block">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>School fees payment method</h2>
                  </div>
                 
                 
    <?php 
if($_SESSION['school_type'] == 'Primary school'){

  echo '<h4>'.$_SESSION['email'].' The school fees for '.$_SESSION['school_class_name'].' is &#8358;'.number_format($_SESSION['school_fees']).' Please select what to pay now.</h4>';


}elseif($_SESSION['school_type'] == 'Secondary school'){


  echo '<h4>'.$_SESSION['email'].', The school fees for '.$_SESSION['school_class_name'].' is &#8358;'.number_format($_SESSION['school_fees']).' Please select what to pay now.</h4>';

}

?>         
                  
       

<label for="gridRadios2">50% Payment 
  (
    <?php
      if($_SESSION['school_type'] == 'Primary school'){
        echo '&#8358;'.number_format($_SESSION['school_fees'] * 0.5);
      }elseif($_SESSION['school_type'] == 'Secondary school'){
        echo '&#8358;'.number_format($_SESSION['school_fees'] * 0.5);
      }
      ?>
    
    )
</label>
        <input class="form-check-input" type="radio" name="post_school_fees" id="gridRadios2" value="
        <?php 
       if($_SESSION['school_type'] == 'Primary school'){
       echo $_SESSION['school_fees'] * 0.5;
       }elseif($_SESSION['school_type'] == 'Secondary school'){
        echo $_SESSION['school_fees'] * 0.5;
       } 
        ?>" 
        
        <?php if(isset($_POST['post_school_fees']) && $_POST['post_school_fees'] == $_SESSION['school_fees'] * 0.5){echo 'checked="checked"';} ?>>
        
        <label for="gridRadios3">70% Payment
        (
    <?php
      if($_SESSION['school_type'] == 'Primary school'){
        echo '&#8358;'.number_format($_SESSION['school_fees'] * 0.7);
      }elseif($_SESSION['school_type'] == 'Secondary school'){
        echo '&#8358;'.number_format($_SESSION['school_fees'] * 0.7);
      }
      ?>
    
    )
        </label>
        <input class="form-check-input" type="radio" name="post_school_fees" id="gridRadios3" value="
        <?php 
       if($_SESSION['school_type'] == 'Primary school'){
       echo $_SESSION['school_fees'] * 0.7;
       }elseif($_SESSION['school_type'] == 'Secondary school'){
        echo $_SESSION['school_fees'] * 0.7;
       } 
        ?>

        " <?php if(isset($_POST['post_school_fees']) && $_POST['post_school_fees'] == $_SESSION['school_fees'] * 0.7){echo 'checked="checked"';} ?>>
        <?php if(array_key_exists('post_school_fees', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['post_school_fees'].'</small>';}?>        

        <label for="gridRadios3">100% Payment
        (
    <?php
      if($_SESSION['school_type'] == 'Primary school'){
        echo '&#8358;'.number_format($_SESSION['school_fees']);
      }elseif($_SESSION['school_type'] == 'Secondary school'){
        echo '&#8358;'.number_format($_SESSION['school_fees']);
      }
      ?>
    
    )

        </label>
        <input class="form-check-input" type="radio" name="post_school_fees" id="gridRadios3" value="
        <?php 
       if($_SESSION['school_type'] == 'Primary school'){
       echo $_SESSION['school_fees'] * 1;
       }elseif($_SESSION['school_type'] == 'Secondary school'){
        echo $_SESSION['school_fees'] * 1;
       } 
        ?>
        " <?php if(isset($_POST['post_school_fees']) && $_POST['post_school_fees'] == $_SESSION['school_fees'] * 1){echo 'checked="checked"';} ?>>
        <?php if(array_key_exists('post_school_fees', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['post_school_fees'].'</small>';}?>
        
<div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button" name="submit">SUBMIT</button>
                    </fieldset>
                  </div>
                </div>
              </form>
              

              <form  action="" method="post">
    
    <button type="submit" id="form-submit" class="button" name="reset">RESET</button>
    
  
  
  </form>




            </div>
            
          </div>
          
        </div>
        
      </div>
    </div>
    </section>



   
   

   