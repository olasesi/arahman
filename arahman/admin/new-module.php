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


<?php 
 $errors_new_module = array();
 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
   

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




<?php 
  $sec_errors_new_module = array();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sec_submit'])) {
   

    if (preg_match ('/^[a-zA-Z 0-9]{3,50}$/i', trim($_POST['sec_module']))) {	
		$sec_module = mysqli_real_escape_string ($connect, trim($_POST['sec_module']));
       
	} else {
		$sec_errors_new_module['sec_module'] = 'Please enter valid name';
	} 
    

    if (empty($sec_errors_new_module)) {
       
        mysqli_query($connect, "INSERT INTO secondary_modules (secondary_module_type) VALUES ('".$sec_module."')") or die(db_conn_error);
        header('Location:'.GEN_WEBSITE.'/admin/new-module.php?confirm-new-module=1');

    }
}


?>

<?php 

if(isset($_GET['sec_delete'])) {
    $sec_the_module_id = mysqli_real_escape_string ($connect, trim($_GET['sec_delete']));
    $sec_delete_query = mysqli_query($connect, "DELETE FROM secondary_modules WHERE secondary_module_id = '$sec_the_module_id'");
    $sec_delete_query_price = mysqli_query($connect, "DELETE FROM secondary_module_price WHERE secondary_modules_id = '$sec_the_module_id'");
    $sec_delete_query_join = mysqli_query($connect, "DELETE FROM secondary_module_join_students WHERE sec_module_type_id = '$the_module_id'");
   
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
                                     


                                   
                              
                                    <div class="table-responsive">

                                    <?php 
                                 $fetch_module = mysqli_query($connect, "SELECT * FROM modules ORDER BY module_id DESC") or die(db_conn_error);

                                    ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Module Name Primary</th>
                                                    
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







                                            <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    

                                    <form class="forms-sample" action="" method="post">
                                    <div class="form-group">
                                        <label for="module">
                                            
                                  Add New Module (Secondary)
                                           
                                    </label>
                                    <input type="text" class="form-control" id="module" name="sec_module" value="<?php 
                                   
                                    if(isset($_POST['sec_module'])){echo $_POST['sec_module'];}


                                    ?>" >
                                    </div>
                                    
                                    <?php if (array_key_exists('sec_module', $sec_errors_new_module)) {
			                    	echo '<p class="text-danger">'.$sec_errors_new_module['sec_module'].'</p>';}?>
                                   


                                    <button type="submit" class="btn btn-primary me-2" name="sec_submit">

                                       Submit
                                    </button>
                                    
                                    </form>
                                     


                                   
                              
                                    <div class="table-responsive">

                                    <?php 
                                 $fetch_module = mysqli_query($connect, "SELECT * FROM secondary_modules ORDER BY secondary_module_id DESC") or die(db_conn_error);

                                    ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Module Name Secondary</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                while($row = mysqli_fetch_array($fetch_module)) {
                                                    $sec_fetch_know_status = mysqli_query($connect, "SELECT secondary_module_start_date, 	secondary_module_end_date, secondary_module_session FROM secondary_modules WHERE secondary_module_id = '".$row['secondary_module_id']."' AND secondary_module_start_date = '' AND secondary_module_end_date = '' AND secondary_module_session = ''") or die(db_conn_error);
                                                   
                                                    echo'
                                                    <tr>
                                                        <td>'.$row['secondary_module_type'].'</td>
                                                       
                                                        <td><a href="new-module.php?sec_delete='.$row['secondary_module_id'].'">Delete</a></td></td>
                                                        <td>';
                                                        if(mysqli_num_rows($sec_fetch_know_status) == 1){
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