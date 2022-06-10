<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header('Location:'.GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != ACCOUNTANT){
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();

}

?>
<?php //INSERT PRIMARY SCHOOL FEES TO DATABASE
$errorp = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['primary_submit'])) {
  
        $bill_id = $_POST['primary_submit_hidden'];

     if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['pri_school_fees']))) {		//only 20 characters are allowed to be 
        $bill = mysqli_real_escape_string ($connect, trim($_POST['pri_school_fees']));
      
   } 


        if(empty($errorp)) {

       mysqli_query($connect, "UPDATE primary_school_classes SET primary_class_fees ='".$bill."' WHERE primary_class_id = '".$bill_id."'") or die(db_conn_error);
       
       header('Location:'.GEN_WEBSITE.'/admin/bill-setting.php?bill-setting=1');
       exit();
        }


    }
        


?>


<?php //INSERT SECONDARY SCHOOL FEES TO DATABASE
$errors = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['secondary_submit'])) {
        $bill_id = $_POST['secondary_submit_hidden'];
        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['sec_school_fees']))) {		//only 20 characters are allowed to be 
             $jss_one = mysqli_real_escape_string ($connect, trim($_POST['sec_school_fees']));
        } 

      
        


        if(empty($errors)) {

                mysqli_query($connect, "UPDATE secondary_school_classes SET secondary_class_fees ='".$jss_one."' WHERE secondary_class_id = '".$bill_id."'") or die(db_conn_error);

                header('Location:'.GEN_WEBSITE.'/admin/bill-setting.php?bill-setting=1');
                exit();

            

        }


    }
        


?>




<?php require_once('../../incs-arahman/dashboard.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">

                <?php         
    if(isset($_GET['bill-setting']) AND $_GET['bill-setting'] == 1){
           
        echo '<div class="row">

<div class="col-12 grid-margin stretch-card">
   <div class="card">
     <div class="card-body">
       <h4 class="card-title">School fees has been successfully changed</h4>
     

          
              
                  </div>
                </div>
              </div>

            </div>';
}
   
            ?>


                    <div class="page-header">
                        <h3 class="page-title"> School Fees Setting</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Primary School</h4>
                                <p class="card-description">Primary School Fees </p>
                               
                                <?php 
                                 
                                $primary_classes = mysqli_query($connect, "SELECT * FROM primary_school_classes")  or die(db_conn_error);
                            
                            
                                 while($primary_row = mysqli_fetch_array($primary_classes)){
                                     echo '
                                     <form class="forms-sample" action="" method="post">
                                   
                                        <div class="form-group row">
                                            <label for="'.$primary_row['primary_class'].'" class="col-sm-3 col-form-label">'.$primary_row['primary_class'].'</label>
                                            <div class="col-sm-9">
                                            
                                            <input type="text" class="form-control" id="'.$primary_row['primary_class'].'" name="pri_school_fees" value="';
                                            
                                             if(isset($_POST['pri_school_fees'])){
                                                echo $_POST['pri_school_fees'];
                                           
                                        }else{
                                                echo $primary_row['primary_class_fees'];
                                            }
                                            echo '">';


                                            echo '
                                            <input type="hidden" name="primary_submit_hidden" value="'.$primary_row['primary_class_id'].'"/>
                                            <button type="submit" class="btn btn-primary me-2" name="primary_submit">Submit</button>

                                            </div>
                                        </div>
                                       
                                        </form>
                                        ';


                                }
                            
                                ?>

                               
                              
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Secondary School</h4>
                                <p class="card-description"> Secondary School Fees</p>
                               
                                <?php 
                                 $secondary_classes = mysqli_query($connect, "SELECT * FROM secondary_school_classes")  or die(db_conn_error);
                                 while($secondary_row = mysqli_fetch_array($secondary_classes)) {
                                     
                                     echo '
                                     <form class="forms-sample" action="bill-setting.php" method="post">
                                     <div class="form-group row">
                                     <label for="'.$secondary_row['secondary_class'].'" class="col-sm-3 col-form-label">'.$secondary_row['secondary_class'].'</label>
                                     <div class="col-sm-9">
                                     
                                     <input type="text" class="form-control" id="'.$secondary_row['secondary_class'].'" name="sec_school_fees" value="';
                                     
                                      if(isset($_POST['sec_school_fees'])){
                                         echo $_POST['sec_school_fees'];
                                     }
                                     else {
                                         echo $secondary_row['secondary_class_fees'];
                                     }
                                     echo '">';
                                   

                                     echo '
                                     <input type="hidden" name="secondary_submit_hidden" value="'.$secondary_row['secondary_class_id'].'"/>
                                     <button type="submit" class="btn btn-primary me-2" name="secondary_submit">Submit</button>
                                     </div>
                                 </div>
                                
                                 </form>      
                                 ';
                                }
                                
                                ?>
                               
                            </div>
                            </div>
                        </div>
                    </div>

                








<script>
                     window.addEventListener("load", function() {
    var f = document.getElementById('Foo');
    setInterval(function() {
        f.style.display = (f.style.display == 'none' ? '' : 'none');
    }, 1000);

}, false);
</script>                 



            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>