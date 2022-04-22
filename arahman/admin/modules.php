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

<?php //INSERT SECONDARY SCHOOL FEES TO DATABASE
$errors = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['module_submit'])) {
  
        if (isset($_POST['class'])) {		 
            $classes = $_POST['class'];
            
            } else{
              $errors['add_classes'] = 'Please choose class to add';
 }


        if (preg_match ('/^[0-9]{3,6}$/i', trim($_POST['price']))) {		 
             $price = mysqli_real_escape_string ($connect, trim($_POST['price']));
        } else {
            $errors['price'] = 'Please enter correct price';
        } 
        if (isset($_POST['startdate']) && !empty($_POST['startdate'])) {		 
            $startdate = $_POST['startdate'];
           
    } else {
            $errors['startdate'] = 'Please enter correct date';
        } 
        
        if (isset($_POST['enddate']) && !empty($_POST['enddate'])) {		 
            $enddate = $_POST['enddate'];
        } else{
            $errors['enddate'] = 'Please enter correct date';
            
        } 


        if(empty($errors)) {



            $taking_session = mysqli_query ($connect,"SELECT school_session, choose_term FROM term_start_end ORDER BY term_start_end_id DESC  LIMIT 1") or die(mysqli_error($connect));
            while($rows = mysqli_fetch_array($taking_session)){
                $the_session=$rows['school_session'];
                $the_term=$rows['choose_term'];
            }
  

  $find_module = mysqli_query ($connect,"SELECT module_type FROM modules WHERE module_id = '".$_POST['type']."'") or die(mysqli_error($connect));
  while($find_rows = mysqli_fetch_array($find_module)){
    $see_module=$find_rows['module_type'];
    
}

        mysqli_query($connect, "UPDATE modules SET module_type = '".$see_module."', module_session = '". $the_session."', module_term = '".$the_term."', module_start_date = '".$startdate."', module_end_date = '".$enddate."' WHERE module_id = '".$_POST['type']."'") or die(db_conn_error);
           // $last_insert_id = mysqli_insert_id($connect);

            foreach($classes as $class) {

            mysqli_query($connect, "INSERT INTO module_price (modules_id, module_price, module_class_id) 
            VALUES ('".$_POST['type']."', '".$price."','".$class."')") or die(mysqli_error($connect));
            }

            header("Location:".GEN_WEBSITE.'/admin/modules.php?module_setup=1');


        }


    }
        


?>




<?php require_once('../../incs-arahman/dashboard.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">

                <?php
if(isset($_GET['module_setup']) && $_GET['module_setup'] == 1){
echo ' <div class="row ">
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
<label class="badge badge-info">New module has now been set up</label>
</div>
</div>
</div>
</div>';

	
}


?>
           





                    <div class="page-header">
                        <h3 class="page-title">Module setup/edit</h3>
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
                                    <h4 class="card-title">Setup/Edit Module (Primary)</h4>
                                    <form class="form-sample" action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-form-label">Type</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" name="type">
                                            <?php 
                                             $fetch_module = mysqli_query($connect, "SELECT module_type, module_id FROM modules ORDER BY module_id DESC") or die(db_conn_error);

                                             while($row = mysqli_fetch_array( $fetch_module)) {

                                                echo '<option value="'.$row['module_id'].'">'.$row['module_type'].'</option>';
                                             }

                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Class</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control js-example-basic-multiple" multiple="multiple" style="width:100%" name="class[]">
                                                       
                                                  <?php  $fetch_class_primary = mysqli_query($connect, "SELECT primary_class_id, primary_class FROM primary_school_classes") or die(db_conn_error); 
                                                  
                                                  while($row_class = mysqli_fetch_array($fetch_class_primary)) {

                                                    echo '<option value="'.$row_class['primary_class_id'].'">'.$row_class['primary_class'].'</option>';
                                                 }
    
                                                  
                                                  ?>
                                                    
                                                   
                                                    </select>
                                                    <?php 
                                                     if (array_key_exists('add_classes', $errors)) { 
                                                        echo '<p class="text-danger">'.$errors['add_classes'].'</p>';
                                                         
                                                    }
                                                ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label">Start</label>
                                                <div class="col-sm-12">
                                                <input type="date" class="form-control" name="startdate" value="
                                                    <?php
                                                     if(isset($_POST['startdate']) AND !empty($_POST['startdate'])) {
                                                        echo $_POST['startdate'];
                                                    }?>
                                                "/>
                                                <?php 
                                                     if (array_key_exists('startdate', $errors)) { 
                                                        echo '<p class="text-danger">'.$errors['startdate'].'</p>';
                                                         
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label">End</label>
                                                <div class="col-sm-12">
                                                <input type="date" class="form-control" name="enddate"  value="
                                                    <?php
                                                    //  if(!isset($_POST['enddate'])) {
                                                    //     echo date('Y-m-d');
                                                    // } else {
                                                    //     echo $_POST['enddate'];
                                                    // }  
                                                    ?>
                                                "/>
                                                <?php 
                                                     if (array_key_exists('enddate', $errors)) { 
                                                        echo '<p class="text-danger">'.$errors['enddate'].'</p>';
                                                         
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label">Price</label>
                                                <div class="col-sm-12">
                                                <input type="text" class="form-control" name="price" value="<?php if(isset($_POST['price'])){echo $_POST['price'];}?>"/>
                                                <?php 
                                                     if (array_key_exists('price', $errors)) { 
                                                        echo '<p class="text-danger">'.$errors['price'].'</p>';
                                                         
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                   
                                        <button type="submit" class="btn btn-primary btn-lg" name="module_submit">Submit</button>
                                   
                                    </div>
                                    <div class="row">
                                      
                                   
                                    </form>
                                </div>
                            </div>
                        </div>


                   




                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Setup/Edit Module (Secondary)</h4>
                                    <form class="form-sample" action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-form-label">Type</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" name="type">
                                            <?php 
                                             $fetch_module = mysqli_query($connect, "SELECT module_type, module_id FROM modules ORDER BY module_id DESC") or die(db_conn_error);

                                             while($row = mysqli_fetch_array( $fetch_module)) {

                                                echo '<option value="'.$row['module_id'].'">'.$row['module_type'].'</option>';
                                             }

                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Class</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control js-example-basic-multiple" multiple="multiple" style="width:100%" name="class[]">
                                                       
                                                  <?php  $fetch_class_primary = mysqli_query($connect, "SELECT primary_class_id, primary_class FROM primary_school_classes") or die(db_conn_error); 
                                                  
                                                  while($row_class = mysqli_fetch_array($fetch_class_primary)) {

                                                    echo '<option value="'.$row_class['primary_class_id'].'">'.$row_class['primary_class'].'</option>';
                                                 }
    
                                                  
                                                  ?>
                                                    
                                                   
                                                    </select>
                                                    <?php 
                                                     if (array_key_exists('add_classes', $errors)) { 
                                                        echo '<p class="text-danger">'.$errors['add_classes'].'</p>';
                                                         
                                                    }
                                                ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label">Start</label>
                                                <div class="col-sm-12">
                                                <input type="date" class="form-control" name="startdate" value="
                                                    <?php
                                                     if(isset($_POST['startdate']) AND !empty($_POST['startdate'])) {
                                                        echo $_POST['startdate'];
                                                    }?>
                                                "/>
                                                <?php 
                                                     if (array_key_exists('startdate', $errors)) { 
                                                        echo '<p class="text-danger">'.$errors['startdate'].'</p>';
                                                         
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label">End</label>
                                                <div class="col-sm-12">
                                                <input type="date" class="form-control" name="enddate"  value="
                                                    <?php
                                                    //  if(!isset($_POST['enddate'])) {
                                                    //     echo date('Y-m-d');
                                                    // } else {
                                                    //     echo $_POST['enddate'];
                                                    // }  
                                                    ?>
                                                "/>
                                                <?php 
                                                     if (array_key_exists('enddate', $errors)) { 
                                                        echo '<p class="text-danger">'.$errors['enddate'].'</p>';
                                                         
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label">Price</label>
                                                <div class="col-sm-12">
                                                <input type="text" class="form-control" name="price" value="<?php if(isset($_POST['price'])){echo $_POST['price'];}?>"/>
                                                <?php 
                                                     if (array_key_exists('price', $errors)) { 
                                                        echo '<p class="text-danger">'.$errors['price'].'</p>';
                                                         
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                   
                                        <button type="submit" class="btn btn-primary btn-lg" name="module_submit">Submit</button>
                                   
                                    </div>
                                    <div class="row">
                                      
                                   
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