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

if(isset($_POST['submit'])) {
    $errors = array();

    if (preg_match ('/^[a-zA-Z]{3,50}$/i', trim($_POST['module']))) {	
		$module = mysqli_real_escape_string ($connect, trim($_POST['module']));
	} else {
		$errors['module'] = 'Please enter correct value';
	} 
    
    if (empty($errors)) {
      
        mysqli_query($connect, "INSERT INTO module_list (module_list_name) VALUES ('".$module."')") or die(db_conn_error);
    }
     

 }


?>
<?php 

if(isset($_GET['edit'])) {
    $the_module_id = $_GET['edit']; 

    if(isset($_POST['update'])) {
        $errors = array();
    
        if (preg_match ('/^[a-zA-Z]{3,50}$/i', trim($_POST['editmodule']))) {	
            $editmodule = mysqli_real_escape_string ($connect, trim($_POST['editmodule']));
        } else {
            $errors['editmodule'] = 'Please enter correct value';
        } 
        
        if (empty($errors)) {
        
            mysqli_query($connect, "UPDATE module_list SET  module_list_name = '".$editmodule."'  WHERE module_list_id = $the_module_id") or die(db_conn_error);
        }
        
    
    }
}

    


?>


<?php 

if(isset($_GET['delete'])) {
    $the_module_id = $_GET['delete'];
    $delete_query = mysqli_query($connect, "DELETE FROM module_list WHERE module_list_id = '$the_module_id'");
    header("Location: new-module.php");

}

?>







<?php require_once('../../incs-arahman/dashboard.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">
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
                                            
                                    <?php 
                                    
                                    if(isset($_GET['edit'])) {
                                        echo 'Edit Module';
                                    } else {
                                        echo 'Add New Module';

                                    }
                                    ?>
                                           
                                    </label>
                                    <input type="text" class="form-control" id="module" name="<?php 
                                    if(isset($_GET['edit'])) {
                                        echo 'editmodule';
                                    } else {
                                        echo 'module';

                                    }
                                    ?>" value="<?php 
                                    if(isset($_GET['edit'])) {
                                        $the_module_id = $_GET['edit'];
                                        $fetch_module = mysqli_query($connect, "SELECT * FROM module_list WHERE module_list_id = $the_module_id") or die(db_conn_error);
                                
                                        while($row = mysqli_fetch_array($fetch_module)) {
                                            echo $row['module_list_name'];
                                            
                                        }
                                    } 
                                    ?>" >
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary me-2" name="<?php 
                                        if(isset($_GET['edit'])) {
                                            echo 'update';
                                        } else {
                                            echo 'submit';

                                        }
                                        ?>">
                                        <?php 
                            
                                        if(isset($_GET['edit'])) {
                                            echo 'Update';
                                        } else {
                                            echo 'Submit';

                                        }
                                        ?>
                                    </button>
                                    
                                    </form>


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">

                                    <?php 
       $fetch_module = mysqli_query($connect, "SELECT * FROM module_list") or die(db_conn_error);

                                    ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Module Name</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                while($row = mysqli_fetch_array( $fetch_module)) {

                                                    echo'
                                                    <tr>
                                                        <td>'.$row['module_list_name'].'</td>
                                                        <td><a href="new-module.php?edit='.$row['module_list_id'].'">Edit</a></td></td>
                                                        <td><a href="new-module.php?delete='.$row['module_list_id'].'">Delete</a></td></td>
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