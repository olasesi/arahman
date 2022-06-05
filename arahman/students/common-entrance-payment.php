<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');

?>
<?php
if(!isset($_SESSION['common_entrance_email'])){
    header('Location:'.GEN_WEBSITE.'/students/common-entrance.php');
    exit();
  }
  

$query_term_start = mysqli_query($connect, "SELECT term_start, term_end, choose_term, school_session FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
  while($term_rows = mysqli_fetch_array($query_term_start)){
    $start_var = $term_rows['term_start'];
    $end_var = $term_rows['term_end'];
    $choose_term_var = $term_rows['choose_term'];
    $choose_session = $term_rows['school_session'];
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
if(isset($_POST['reset']) AND $_SERVER['REQUEST_METHOD'] == "POST"){
 
  unset($_SESSION['common_entrance_email']);
  unset($_SESSION['choose_session']);
  header('Location:'.GEN_WEBSITE.'/students/common-entrance.php');
  exit();

}

?>
<?php

if(isset($_POST['submit']) AND $_SERVER['REQUEST_METHOD'] == "POST"){

  $common_entrance_fee = mysqli_query($connect, "SELECT secondary_common_fee_price FROM secondary_common_fee WHERE secondary_common_fee_id = '1'") or die(db_conn_error);
  
  while($common_entrance_fee_loop=mysqli_fetch_array($common_entrance_fee)){
    $entrance_fees = $common_entrance_fee_loop['secondary_common_fee_price'];
    }


$_SESSION['choose_session'] = $choose_session;
$email = $_SESSION['common_entrance_email'];
 $class_price = $entrance_fees * 100;
  include ('../../incs-arahman/pay.php');











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
                    <h2>Pay common entrance fee</h2>
                  </div>
                 
       
        
<div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button" name="submit">Pay common entrance</button>
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



   
   

   