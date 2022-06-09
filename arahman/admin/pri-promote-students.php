<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}

if($_SESSION['admin_type'] != ADMISSION){
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}


if(!isset($_GET['id'])){
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}
?>






<?php
$query = mysqli_query($connect, "SELECT primary_id, pri_class_id FROM primary_school_students WHERE primary_id  = '".mysqli_real_escape_string ($connect, $_GET['id'])."' AND pri_paid = '0' AND pri_admit = '0' AND pri_active_email = '1' AND pri_class_id != '0'") or die(db_conn_error);

if (!isset($errors)){$errors = array();}

if (mysqli_affected_rows($connect) == 1) {

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){
	 
 
    
  if ($_POST['pri_class'] == "Choose school class") {
		$errors['pri_class'] = 'Please select school class';
	} else{
	$pri_class = $_POST['pri_class'];
	}




    
   


	//now to edit the product	
	if (empty($errors)){

      
	
 $query_term_session = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
while($loop_term_session=mysqli_fetch_array($query_term_session)){
  $current_term = $loop_term_session['choose_term'];
  $current_session_term = $loop_term_session['school_session'];
 
}


mysqli_query($connect, "UPDATE primary_school_students SET pri_admit = '1', pri_school_term = '".$current_term."' , pri_year = '".$current_session_term."', pri_class_id = '".$pri_class."' WHERE primary_id = '".mysqli_real_escape_string ($connect, $_GET['id'])."' AND pri_admit = '0' AND pri_active_email = '1' AND pri_paid = '0' AND pri_class_id != '0'") or die(db_conn_error);
			if (mysqli_affected_rows($connect) == 1) {
			
            $_POST = array();		
			
				
	
            header('Location:'.GEN_WEBSITE.'/admin/pri-promote.php?confirm-promotion=1');
            exit();
           
            
  }



} 


 }
 
 	
//$all_about_goods = mysqli_query($connect, "SELECT * FROM goods WHERE goods_id = '".$_GET['goods_no']."'") or die(db_conn_error);

while ($row = mysqli_fetch_array($query)) {
	
    
    //$pri_name = $row['primary_id'];
	
	$pri_class_prev = $row['pri_class_id'];

	
	}
	
}else{
    require_once ('../../incs-arahman/dashboard.php');
echo ' 
<div class="main-panel">
  <div class="content-wrapper">
   

  
  <div class="row">

     <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Promote/Edit student</h4>
            <p class="card-description"></p>
            ';



            echo '<h3 class="text-center">No result found</h3>';




            
   
   
   
   
   
   
   echo '  </div>
   </div>
 </div>

</div>
';
   
   
      require_once ('../../incs-arahman/dashboard-footer.php');
exit();

}
	

 
?>
 <?php require_once ('../../incs-arahman/dashboard.php');?>  
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
             
          
          <?php
if(isset($_GET['confirm']) AND $_GET['confirm'] == 1){
echo ' <div class="row ">
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
<label class="badge badge-info">Student has been promoted successfully. He/She should now procede to payment</label>
</div>
</div>
</div>
</div>';

$_GET = array();	
}
?>



          
          
          
          
            <div class="row">

             <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Promote/Edit student</h4>
                    <p class="card-description"></p>
                    
                     <form class="forms-sample" method="POST" action="">
                     


                      <div class="form-group">
                        <label for="exampleSelectpri_class">School Class</label>
                    <?php if (array_key_exists('pri_class', $errors)) {
	                    echo '<p class="text-danger">'.$errors['pri_class'].'</p>';
	                    }
                    ?>
                        <select class="form-control" id="exampleSelectpri_class" name="pri_class">
                       <?php        
                       
                        echo "<option>Choose school class</option>";
                        $query_select_class = mysqli_query($connect, "SELECT primary_class_id, primary_class FROM primary_school_classes") or die(db_conn_error);
                                      
                        if(isset ($_POST['pri_class'])){
                          while($pri_class_range = mysqli_fetch_array($query_select_class)){
                        $sel_pri_class = ($pri_class_range['primary_class']==$_POST['pri_class'])?"Selected='selected'":"";
                        echo '<option '.$sel_pri_class. 'value="'.$pri_class_range['primary_class_id'].'">'.$pri_class_range['primary_class'].'</option>';}
                        }else{
                        foreach ($pri_class_range as $pri_class_range['primary_class']=>$pri_class_range['primary_class_id']){
                        echo '<option value="'.$pri_class_range['primary_class_id'].'">'.$pri_class_range['primary_class'].'</option>';
                        }
                        }





                        ?>            
                        </select>
                      </div>





                    
                    


                      <button type="submit" class="btn btn-primary me-2" name="submit">Submit</button>
                      <button type="reset" class="btn btn-dark me-2" name="submit_info">Reset</button>
                    </form>
                  </div>
                </div>
              </div>

            </div>

           <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>



















      