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

    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['module_submit'])) {
   
        if (isset($_POST['type'])) {		//only 20 characters are allowed to be 
            $type = mysqli_real_escape_string ($connect, $_POST['type']);
            
        } 

        if (isset($_POST['class'])){	
         
            $class = $_POST['class'];
           
        } else {
            $errors['class'] = 'Please choose class';
        } 

        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['price']))) {		//only 20 characters are allowed to be 
            $price = mysqli_real_escape_string ($connect, trim($_POST['price']));
            
        } else {
            $errors['price'] = 'Please enter correct value';
        } 

        if (isset($_POST['start-date'])) {		//only 20 characters are allowed to be 
            $start_date = mysqli_real_escape_string ($connect, $_POST['start-date']);
            
        } else {
            $errors['start-date'] = 'Please enter correct value';
        } 

        if (isset($_POST['end-date'])) {		//only 20 characters are allowed to be 
            $end_date = mysqli_real_escape_string ($connect, $_POST['end-date']);
           
        } else {
            $errors['end-date'] = 'Please enter correct value';
        } 

      
        


        if(empty($errors)) {

           
foreach ($_POST['class'] as $each_class){
//echo '<pre>';
//var_dump($each_class);
//echo '</pre>';
    $q = mysqli_query($connect,"INSERT INTO modules (module_class_id, module_type, module_price, module_start_date, module_end_date) 
   VALUES ('".$each_class."','".$type."','".$price."', '".$start_date."', '".$end_date."')") or die(mysqli_error($connect));





}



        }


    }
        


?>




<?php require_once('../../incs-arahman/dashboard.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Payment Module</h3>
                    </div>
                    <div class="row">
                        <!-- <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Typeahead</h4>
                                    <p class="card-description"> A simple suggestion engine </p>
                                    <div class="form-group row">
                                    <div class="col">
                                        <label>Basic</label>
                                        <div id="the-basics">
                                        <input class="typeahead" type="text" placeholder="States of USA">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Bloodhound</label>
                                        <div id="bloodhound">
                                        <input class="typeahead" type="text" placeholder="States of USA">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create New Pyment Module</h4>
                                    <form class="form-sample" action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-form-label">Type</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" name="type">
                                                <option>Excursion</option>
                                                <option>Inter House Sport</option>
                                                <option>Pratical</option>
                                            </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-form-label">School</label>
                                            <div class="col-sm-12">
                                            <select id="class-selection" class="form-control" name="school">
                                                <option>Primary School</option>
                                                <option>Secondary School</option>
                                            </select>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Class</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control js-example-basic-multiple" multiple="multiple" style="width:100%" name="class[]">

                                                        <option value="1">Class 1</option>
                                                        <option value="2">Class 2</option>
                                                        <option value="3">Class 3</option>
                                                        <option value="4">Class 4</option>
                                                        <option value="5">Class 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label">Price</label>
                                                <div class="col-sm-12">
                                                <input type="text" class="form-control" name="price"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label">Start</label>
                                                <div class="col-sm-12">
                                                <input type="date" class="form-control" name="start-date"/>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label">End</label>
                                                <div class="col-sm-12">
                                                <input type="date" class="form-control" name="end-date"/>
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg" name="module_submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Striped Table</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Class</th>
                                                <th>Price</th>
                                                <th>Start</th>
                                                <th>End</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Jacob</td>
                                                <td>53275531</td>
                                                <td>12 May 2017</td>
                                                <td>12 May 2017</td>
                                                <td>12 May 2017</td>
                                                <td><label class="badge badge-danger">Pending</label></td>
                                            </tr>
                                            <tr>
                                                <td>Messsy</td>
                                                <td>53275532</td>
                                                <td>15 May 2017</td>
                                                <td>15 May 2017</td>
                                                <td>15 May 2017</td>
                                                <td><label class="badge badge-warning">In progress</label></td>
                                            </tr>
                                            <tr>
                                                <td>John</td>
                                                <td>53275533</td>
                                                <td>14 May 2017</td>
                                                <td>14 May 2017</td>
                                                <td>14 May 2017</td>
                                                <td><label class="badge badge-info">Fixed</label></td>
                                            </tr>
                                            <tr>
                                                <td>Peter</td>
                                                <td>53275534</td>
                                                <td>16 May 2017</td>
                                                <td>16 May 2017</td>
                                                <td>16 May 2017</td>
                                                <td><label class="badge badge-success">Completed</label></td>
                                            </tr>
                                            <tr>
                                                <td>Dave</td>
                                                <td>53275535</td>
                                                <td>20 May 2017</td>
                                                <td>20 May 2017</td>
                                                <td>20 May 2017</td>
                                                <td><label class="badge badge-warning">In progress</label></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
<script>
$(document).ready(function() {
$('#class-selection').on('select', function() {
var category_id = this.value;
$.ajax({
url: "../incs-arahman/selecting-school.php",
type: "POST",
data: {
school: category_id
},
cache: false,
success: function(result){
$("#class-selection").html(result);
}
});
});
});
</script>              



            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>