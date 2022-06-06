<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){      //If you are not admin
	header('Location:'.GEN_WEBSITE.'/admin');
    exit();
}

if($_SESSION['admin_type'] != ACCOUNTANT && $_SESSION['admin_type'] != OWNER){
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();

}


?>
<?php
$query = mysqli_query($connect, "SELECT * FROM secondary_common_fee") or die(db_conn_error);
if(mysqli_num_rows($query) == 0){
   
   mysqli_query($connect,"INSERT INTO secondary_common_fee (secondary_common_fee_price) 
    VALUES ('500')") or die(db_conn_error);
   
  }

  $queries = mysqli_query($connect, "SELECT secondary_common_fee_price FROM secondary_common_fee WHERE secondary_common_fee_id = '1'") or die(db_conn_error);


if (!isset($errors)){$errors = array();}

if (mysqli_affected_rows($connect) == 1){

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit_info'])){
	 
    

	if(preg_match('/^[0-9]{1,11}$/i',$_POST['phone'])){
        $phone =  mysqli_real_escape_string($connect,$_POST['phone']);
    }else{
        $errors['phone'] = "Enter a valid price";
    }
	
	


	//now to edit the product	
	if (empty($errors)){

mysqli_query($connect, "UPDATE secondary_common_fee SET secondary_common_fee_price = '".$phone."' WHERE secondary_common_fee_id = '1'") or die(db_conn_error);


			if (mysqli_affected_rows($connect) == 1) {
                
          
            header('Location:'.GEN_WEBSITE.'/admin/entrance-fee.php?price='.$phone);
            exit();
           
            
  }



}

 }
 
 	
//$all_about_goods = mysqli_query($connect, "SELECT * FROM goods WHERE goods_id = '".$_GET['goods_no']."'") or die(db_conn_error);

while ($row = mysqli_fetch_array($queries)) {
	
    
    
	$pri_phone = $row['secondary_common_fee_price'];      //This is the class e.g Basic 4
	
	
	
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

if(isset($_GET['price'])){

            echo ' 

  
  <div class="row">

     <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
           
            ';

echo '<h3 class="text-center">Common Entrance Fee Edited Successfully</h3>
  </div>
   </div>
 </div></div>
';
}

?>


          <div class="row">

             <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Entrance Fee</h4>
                    <p class="card-description"></p>
                    
                     <form class="forms-sample" method="POST" action="">
                     
                      
                    
                     

                      <div class="form-group">
                        <label for="phone">Common Entrance Fee (&#8358;)</label>
                        <?php if (array_key_exists('phone', $errors)) {
				echo '<p class="text-danger">'.$errors['phone'].'</p>';}?>
                        <input type="text" class="form-control" id="phone" placeholder="Common Entrance Fee" value="<?php if(!isset($_POST['phone'])){echo $pri_phone;}else{echo $_POST['phone'];}?>" name="phone">
                      </div>
                    
                     

                     
                      <button type="submit" class="btn btn-primary me-2" name="submit_info">Submit</button>
                     
                    </form>
                  </div>
                </div>
              </div>

            </div>

           <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>



















      