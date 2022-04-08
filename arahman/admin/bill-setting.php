<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header('Location:/'.GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != ACCOUNTANT){
	header('Location:/'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();

}

?>






<?php 
$errors = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['primary_submit'])) {
   $values = array();
   
        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic1']))) {		//only 20 characters are allowed to be 
            $values[] = $basic_one = mysqli_real_escape_string ($connect, trim($_POST['basic1']));
        } else {
            $errors['basic1'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic2']))) {		//only 20 characters are allowed to be 
            $values[] = $basic_two = mysqli_real_escape_string ($connect, trim($_POST['basic2']));
        } else {
            $errors['basic2'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic3']))) {		//only 20 characters are allowed to be 
            $values[] = $basic_three = mysqli_real_escape_string ($connect, trim($_POST['basic3']));
        } else {
            $errors['basic3'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic4']))) {		//only 20 characters are allowed to be 
            $values[] = $basic_four = mysqli_real_escape_string ($connect, trim($_POST['basic4']));
        } else {
            $errors['basic4'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic5']))) {		//only 20 characters are allowed to be 
            $values[] = $basic_five = mysqli_real_escape_string ($connect, trim($_POST['basic5']));
        } else {
            $errors['basic5'] = 'Please enter correct value';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['basic6']))) {		//only 20 characters are allowed to be 
            $values[] =$basic_six = mysqli_real_escape_string ($connect, trim($_POST['basic6']));
        } else {
            $errors['basic6'] = 'Please enter correct value';
        } 
        


        if(empty($errors)) {

            $primary_classes = mysqli_query($connect, "SELECT * FROM primary_school_classes")  or die(db_conn_error);

            while($primary_row = mysqli_fetch_array($primary_classes)){ 

                for($i = 0; $i < count($values); $i++ ) {
                    mysqli_query($connect, "UPDATE primary_school_classes SET primary_class_fees ='".$values[$i]."' WHERE ") or die(db_conn_error);

                }


            }

        }


    }
        


?>




<?php require_once('../../incs-arahman/dashboard.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">
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
                                            
                                             if(isset($_POST['id'.$primary_row['primary_class']])){
                                                 echo 'id'.$primary_row['primary_class_id'];
                                             }else{
                                                echo $primary_row['primary_class_fees'];
                                            }
                                            echo '">
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
                                <form class="forms-sample">
                                <?php 
                                 $secondary_classes = mysqli_query($connect, "SELECT * FROM secondary_school_classes")  or die(db_conn_error);
                                 while($secondary_row = mysqli_fetch_array($secondary_classes)) {
                                     echo '
                                        <div class="form-group row">
                                            <label for="Input'.$secondary_row['secondary_class'].'fee" class="col-sm-3 col-form-label">'.$secondary_row['secondary_class'].'</label>
                                            <div class="col-sm-9">
                                            <input type="text" class="form-control" id="Input'.$secondary_row['secondary_class'].'fee" name="'.$secondary_row['secondary_class'].'" value="'.number_format((int)$primary_row['primary_class_fees']).'">
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