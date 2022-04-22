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
 $errors_new_module = array();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $errors = array();

    if (preg_match ('/^[a-zA-Z 0-9]{3,50}$/i', trim($_POST['module']))) {	
		$module = mysqli_real_escape_string ($connect, trim($_POST['module']));
       
	} else {
		$errors_new_module['module'] = 'Please enter valid name';
	} 
    
    if (empty($errors_new_module)) {
       
        mysqli_query($connect, "INSERT INTO modules (module_type) VALUES ('".$module."')") or die(db_conn_error);
        header('Location:'.GEN_WEBSITE.'/admin/new-module.php?confirm-new-module=1');
    }
}


?>

<?php 

if(isset($_GET['delete'])) {
    $the_module_id = mysqli_real_escape_string ($connect, trim($_GET['delete']));
    $delete_query = mysqli_query($connect, "DELETE FROM modules WHERE module_id = '$the_module_id'");
    $delete_query_price = mysqli_query($connect, "DELETE FROM module_price WHERE modules_id = '$the_module_id'");
    $delete_query_join = mysqli_query($connect, "DELETE FROM module_join_students WHERE module_type_id = '$the_module_id'");
   
    header('Location:'.GEN_WEBSITE.'/admin/new-module.php?confirm-delete-module=1');

}

?>


          





<?php require_once('../../incs-arahman/dashboard.php'); ?>



            <div class="main-panel">
                <div class="content-wrapper">

                <?php         
    if(isset($_GET['confirm-new-module']) && $_GET['confirm-new-module'] == 1){
           
        echo '<div class="row">

<div class="col-12 grid-margin stretch-card">
   <div class="card">
     <div class="card-body">
       <h4 class="card-title">New module has been added</h4>
     

          
              
                    </form>
                  </div>
                </div>
              </div>

            </div>';
}
          
            ?>

<?php         
    if(isset($_GET['confirm-delete-module']) && $_GET['confirm-delete-module'] == 1){
           
        echo '<div class="row">

<div class="col-12 grid-margin stretch-card">
   <div class="card">
     <div class="card-body">
       <h4 class="card-title">Module has been deleted</h4>
     

          
              
                    </form>
                  </div>
                </div>
              </div>

            </div>';
}
          
            ?>



                    <div class="page-header">
                        <h3 class="page-title">Add Module</h3>
                    </div>
                    
                    
                    
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <form class="forms-sample" action="" method="post">
                                    <div class="form-group">
                                        <label for="module">
                                            
                                  Add New Module (Primary)
                                           
                                    </label>
                                    <input type="text" class="form-control" id="module" name="module" value="<?php 
                                   
                                    if(isset($_POST['module'])){echo $_POST['module'];}


                                    ?>" >
                                    </div>
                                    
                                    <?php if (array_key_exists('module', $errors_new_module)) {
				echo '<p class="text-danger">'.$errors_new_module['module'].'</p>';}?>
                                   


                                    <button type="submit" class="btn btn-primary me-2" name="submit">

                                       Submit
                                    </button>
                                    
                                    </form>
                                     

                                   
                                <div class="card-body">
                                    <div class="table-responsive">

                                    <?php 
       $fetch_module = mysqli_query($connect, "SELECT * FROM modules ORDER BY module_id DESC") or die(db_conn_error);

                                    ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Module Name Primary</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                while($row = mysqli_fetch_array($fetch_module)) {
                                                    $fetch_know_status = mysqli_query($connect, "SELECT module_start_date, 	module_end_date, module_session FROM modules WHERE module_id = '".$row['module_id']."' AND module_start_date = '' AND module_end_date = '' AND module_session = ''") or die(db_conn_error);
                                                   
                                                    echo'
                                                    <tr>
                                                        <td>'.$row['module_type'].'</td>
                                                       
                                                        <td><a href="new-module.php?delete='.$row['module_id'].'">Delete</a></td></td>
                                                        <td>';
                                                        if(mysqli_num_rows($fetch_know_status) == 1){
                                                        echo '<i>not set up</i>';
                                                        }
                                                    echo    '</td>
                                                    </tr>';
                                                }

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                             
                            </div>
                        </div>
                    
                    






                  
                








<script>
 /*                    window.addEventListener("load", function() {
    var f = document.getElementById('Foo');
    setInterval(function() {
        f.style.display = (f.style.display == 'none' ? '' : 'none');
    }, 1000);

}, false);*/
</script>   
<script>/*
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
});*/
</script>              



            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>