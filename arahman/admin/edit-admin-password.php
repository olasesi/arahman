<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them. Alls is general to all admins
	header("Location:".GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != OWNER){
	header("Location:".GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}

?>
<?php
if(isset($_GET['password_change'])){
    $results = mysqli_query($connect,"SELECT admin_id, type FROM admin WHERE admin_id = '".mysqli_real_escape_string($connect, $_GET['password_change'])."'") or die(db_conn_error);
if(mysqli_num_rows($results) == 0){
    header("Location:".GEN_WEBSITE.'/admin/show-admins.php');
	exit(); 
}

}else{
    header("Location:".GEN_WEBSITE.'/admin/show-admins.php');
	exit(); 

}

?>
<?php
if (!isset($errors)){$errors = array();}

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){
if($_POST['password'] == $_POST['confirm_password']){
	if(preg_match('/^.{6,255}$/i',$_POST['password'])){
    $password =  mysqli_real_escape_string($connect,$_POST['password']);
  }else{
    $errors['password'] = "Minimum of 6 characters";
  }
}else{
	$errors['password_match'] = "Password did not match";
}


	 
   
if (empty($errors)){
mysqli_query($connect, "UPDATE admin SET admin_password = '".md5($password)."' WHERE admin_id = '".mysqli_real_escape_string($connect, $_GET['password_change'])."'") or die(db_conn_error);
$done = 1;



 }
 
}	

 
?>
 <?php require_once ('../../incs-arahman/dashboard.php');?>  
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <!-- <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                      <div class="col-4 col-sm-3 col-xl-2">
                        <img src="assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                      </div>
                      <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Want even more features?</h4>
                        <p class="mb-0 font-weight-normal d-none d-sm-block">Check out our Pro version with 5 unique layouts!</p>
                      </div>
                      <div class="col-3 col-sm-2 col-xl-2 ps-0 text-center">
                        <span>
                          <a href="https://www.bootstrapdash.com/product/corona-admin-template/" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Upgrade to PRO</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

 <?php         
    if(isset($done) AND $done == 1){
           
        echo '<div class="row">

<div class="col-12 grid-margin stretch-card">
   <div class="card">
     <div class="card-body">
       <h4 class="card-title text-warning">Password has now been changed. The user can now login in again</h4>
     

          
              
                    </form>
                  </div>
                </div>
              </div>

            </div>';
}
          
            ?>
          

            <div class="row">

             <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Change admin password</h4>
                    <p class="card-description"></p>
                                        
                    <form class="forms-sample" method="POST" action="<?php //echo GEN_WEBSITE.'/admin/edit-admin-password.php?password_change='.$_GET['password_change']; ?>">
                      <div class="form-group">
                        <label for="exampleInputName1">Change admin password</label>
                        <?php if (array_key_exists('password', $errors)) {
				echo '<p class="text-danger">'.$errors['password'].'</p>';}?>
                 <?php if (array_key_exists('password_match', $errors)){
				echo '<p class="text-danger">'.$errors['password_match'].'</p>';}?>
                        <input type="password" class="form-control" id="exampleInputName1" placeholder="Password" value="" name="password">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">Confirm password</label>
                                     
                        <input type="password" class="form-control" id="exampleInputName1" placeholder="Confirm password" value="" name="confirm_password">
                      
                    </div>
                    <input type="hidden" value="<?php echo $_GET['password_change'];?>" name="pass_change">


                  <button type="submit" class="btn btn-primary me-2" name="submit">Submit</button>
                     
                    </form>
                  </div>
                </div>
              </div>

            </div>

           <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>



















      