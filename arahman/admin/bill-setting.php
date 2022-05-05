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
  
        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic1']))) {		//only 20 characters are allowed to be 
             $basic_one = mysqli_real_escape_string ($connect, trim($_POST['basic1']));
        } else {
            $errorp['basic1'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic2']))) {		//only 20 characters are allowed to be 
             $basic_two = mysqli_real_escape_string ($connect, trim($_POST['basic2']));
        } else {
            $errorp['basic2'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic3']))) {		//only 20 characters are allowed to be 
             $basic_three = mysqli_real_escape_string ($connect, trim($_POST['basic3']));
        } else {
            $errorp['basic3'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic4']))) {		//only 20 characters are allowed to be 
             $basic_four = mysqli_real_escape_string ($connect, trim($_POST['basic4']));
        } else {
            $errorp['basic4'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic5']))) {		//only 20 characters are allowed to be 
             $basic_five = mysqli_real_escape_string ($connect, trim($_POST['basic5']));
        } else {
            $errorp['basic5'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic6']))) {		//only 20 characters are allowed to be 
             $basic_six = mysqli_real_escape_string ($connect, trim($_POST['basic6']));
        } else {
            $errorp['basic6'] = 'Please enter correct value';
        } 
        


        if(empty($errorp)) {

            // $primary_classes = mysqli_query($connect, "SELECT * FROM primary_school_classes")  or die(db_conn_error);

            
                mysqli_query($connect, "UPDATE primary_school_classes SET primary_class_fees ='".$basic_one."' WHERE primary_class_id = '1' ") or die(db_conn_error);
                mysqli_query($connect, "UPDATE primary_school_classes SET primary_class_fees ='".$basic_two."' WHERE primary_class_id = '2'") or die(db_conn_error);
                mysqli_query($connect, "UPDATE primary_school_classes SET primary_class_fees ='".$basic_three."' WHERE primary_class_id = '3'") or die(db_conn_error);
                mysqli_query($connect, "UPDATE primary_school_classes SET primary_class_fees ='".$basic_four."' WHERE primary_class_id = '4'") or die(db_conn_error);
                mysqli_query($connect, "UPDATE primary_school_classes SET primary_class_fees ='".$basic_five."' WHERE primary_class_id = '5'") or die(db_conn_error);
                mysqli_query($connect, "UPDATE primary_school_classes SET primary_class_fees ='".$basic_six."' WHERE primary_class_id = '6'") or die(db_conn_error);

            
                header('Location:'.GEN_WEBSITE.'/admin/bill-setting.php?bill-setting=1');
                exit();
            
            

        }


    }
        


?>


<?php //INSERT SECONDARY SCHOOL FEES TO DATABASE
$errors = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['secondary_submit'])) {
  
        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['ss1']))) {		//only 20 characters are allowed to be 
             $jss_one = mysqli_real_escape_string ($connect, trim($_POST['ss1']));
        } else {
            $errors['ss1'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['ss2']))) {		//only 20 characters are allowed to be 
             $jss_two = mysqli_real_escape_string ($connect, trim($_POST['ss2']));
        } else {
            $errors['ss2'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['ss3']))) {		//only 20 characters are allowed to be 
             $jss_three = mysqli_real_escape_string ($connect, trim($_POST['ss3']));
        } else {
            $errors['ss3'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['ss4']))) {		//only 20 characters are allowed to be 
             $sss_one = mysqli_real_escape_string ($connect, trim($_POST['ss4']));
        } else {
            $errors['ss4'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['ss5']))) {		//only 20 characters are allowed to be 
             $sss_two = mysqli_real_escape_string ($connect, trim($_POST['ss5']));
        } else {
            $errors['ss5'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['ss6']))) {		//only 20 characters are allowed to be 
             $sss_three = mysqli_real_escape_string ($connect, trim($_POST['ss6']));
        } else {
            $errors['ss6'] = 'Please enter correct value';
        } 
        


        if(empty($errors)) {

            // $primary_classes = mysqli_query($connect, "SELECT * FROM primary_school_classes")  or die(db_conn_error);

            
                mysqli_query($connect, "UPDATE secondary_school_classes SET secondary_class_fees ='".$jss_one."' WHERE secondary_class_id = '1' ") or die(db_conn_error);
                mysqli_query($connect, "UPDATE secondary_school_classes SET secondary_class_fees ='".$jss_two."' WHERE secondary_class_id = '2'") or die(db_conn_error);
                mysqli_query($connect, "UPDATE secondary_school_classes SET secondary_class_fees ='".$jss_three."' WHERE secondary_class_id = '3'") or die(db_conn_error);
                mysqli_query($connect, "UPDATE secondary_school_classes SET secondary_class_fees ='".$sss_one."' WHERE secondary_class_id = '4'") or die(db_conn_error);
                mysqli_query($connect, "UPDATE secondary_school_classes SET secondary_class_fees ='".$sss_two."' WHERE secondary_class_id = '5'") or die(db_conn_error);
                mysqli_query($connect, "UPDATE secondary_school_classes SET secondary_class_fees ='".$sss_three."' WHERE secondary_class_id = '6'") or die(db_conn_error);

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
                                <form class="forms-sample" action="bill-setting.php" method="post">
                                <?php 
                                 
                                $primary_classes = mysqli_query($connect, "SELECT * FROM primary_school_classes")  or die(db_conn_error);
                            
                            
                                 while($primary_row = mysqli_fetch_array($primary_classes)){
                                     echo '
                                        <div class="form-group row">
                                            <label for="Input'.$primary_row['primary_class'].'fee" class="col-sm-3 col-form-label">'.$primary_row['primary_class'].'</label>
                                            <div class="col-sm-9">
                                            
                                            <input type="text" class="form-control" id="Input'.$primary_row['primary_class'].'fee" name="basic'.$primary_row['primary_class_id'].'" value="';
                                            
                                             if(isset($_POST['basic'.$primary_row['primary_class_id']])){
                                                
                                            
                                            if (array_key_exists('basic'.$primary_row['primary_class_id'], $errorp)) {
                                               echo $_POST['basic'.$primary_row['primary_class_id']] ;}
                                            else {
                                                echo $primary_row['primary_class_fees'];
                                            }}
                                            else {
                                                echo $primary_row['primary_class_fees'];
                                            }
                                            echo '">';
                                            if (array_key_exists('basic'.$primary_row['primary_class_id'], $errorp)) { 
                                                echo '<p class="text-danger">'.$errorp['basic'.$primary_row['primary_class_id']].'</p>';

                                            }
                                            

                                            echo '
                                            </div>
                                        </div>
                                        ';


                                }
                                
                                ?>

                               
                                <button type="submit" class="btn btn-primary me-2" name="primary_submit">Submit</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Secondary School</h4>
                                <p class="card-description"> Secondary School Fees</p>
                                <form class="forms-sample" action="bill-setting.php" method="post">
                                <?php 
                                 $secondary_classes = mysqli_query($connect, "SELECT * FROM secondary_school_classes")  or die(db_conn_error);
                                 while($secondary_row = mysqli_fetch_array($secondary_classes)) {
                                     echo '
                                     <div class="form-group row">
                                     <label for="Input'.$secondary_row['secondary_class'].'fee" class="col-sm-3 col-form-label">'.$secondary_row['secondary_class'].'</label>
                                     <div class="col-sm-9">
                                     
                                     <input type="text" class="form-control" id="Input'.$secondary_row['secondary_class'].'fee" name="ss'.$secondary_row['secondary_class_id'].'" value="';
                                     
                                      if(isset($_POST['ss'.$secondary_row['secondary_class_id']])){
                                         
                                     
                                     if (array_key_exists('ss'.$secondary_row['secondary_class_id'], $errors)) {
                                        echo $_POST['ss'.$secondary_row['secondary_class_id']] ;}
                                     else {
                                         echo $secondary_row['secondary_class_fees'];
                                     }}
                                     else {
                                         echo $secondary_row['secondary_class_fees'];
                                     }
                                     echo '">';
                                     if (array_key_exists('ss'.$secondary_row['secondary_class_id'], $errors)) { 
                                         echo '<p class="text-danger">'.$errors['ss'.$secondary_row['secondary_class_id']].'</p>';

                                     }
                                     

                                     echo '
                                     </div>
                                 </div>
                                        ';
                                }
                                
                                ?>
                                <button type="submit" class="btn btn-primary me-2" name="secondary_submit">Submit</button>
                                </form>
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