<?php
require_once ('../incs-arahman/config.php');
require_once ('../incs-arahman/gen_serv_con.php');


if(!isset($_SESSION['primary_id'])){   
	header('Location:'.GEN_WEBSITE);
	exit();
}
  if(isset($_SESSION['primary_id']) AND $_SESSION['pri_admit'] == 1){   //logged in students dont have right to login again.
    header('Location:'.GEN_WEBSITE.'/students/home.php');
    exit();
  }
  

 



include ('../incs-arahman/header.php');



?>

<header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                          Edu Meeting
                      </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                           
<?php
if(isset($_SESSION['primary_id'])){
echo '<li class=""><a href="logout.php">Logout</a></li>';

}
?>


                            
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>



<section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center center-block">
          <div class="row">
            <div class="col-lg-12">
            
            <?php
if(isset($_GET['ref']) AND $_GET['status'] == 'success'){

            $con_ref = mysqli_query($connect, "SELECT primary_payment_students_reference FROM primary_payment WHERE primary_payment_students_id='".$_SESSION['primary_id']."' AND primary_payment_students_reference = '".$_GET['ref']."' AND primary_payment_status = 'success'") or die(db_conn_error);

            if(mysqli_num_rows($con_ref) == 1){

              echo '
              <div class="row">
              <div id="contact">
             <h2>Payment was successful!!!</h2>
             <h4>Admmission will be confirmed soon. And please click the logout button to complete this process </h4>
              </div> 
            </div>
  
              ';


              echo '
              </div>
          </div>
        </div>
        
      </div>
    </div>
    </section>';

     include('../incs-arahman/footer.php');

exit();

            }

}     
            
            ?>
            
           

            
            <form id="contact" action="pay.php" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Primary school class fees</h2>
                  </div>
                 
                
                 
<input type="hidden" name="email" value="<?= $_SESSION['pri_email']; ?>"/>

                  <div class="col-lg-4">
                 

                  <fieldset>
                    <?php if(isset($_GET['select-class']) AND $_GET['select-class'] == 'not-selected'){
                      echo '<p class="text-danger">Please select a primary class to pay</p>';
                    } ?>
                   <select name="primary_payment">
                   <option>Choose school class</option>
                    <option value="<?=BASIC_ONE_FEES;?>">Basic one</option>
<option value="<?=BASIC_TWO_FEES;?>">Basic two</option>
<option value="<?=BASIC_THREE_FEES;?>">Basic three</option>
<option value="<?=BASIC_FOUR_FEES;?>">Basic four</option>
<option value="<?=BASIC_FIVE_FEES;?>">Basic five</option>
<option value="<?=BASIC_SIX_FEES;?>">Basic six</option>

                   </select>
                  </fieldset>


</div>
                 
               



                  
                  
                
<div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button" name="pay">Pay School fees</button>
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











    <?php include('../incs-arahman/footer.php');?>