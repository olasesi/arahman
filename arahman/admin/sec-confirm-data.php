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
$query = mysqli_query($connect, "SELECT secondary_id, sec_firstname, sec_surname, sec_age, sec_sex, sec_photo, sec_phone, sec_address FROM secondary_school_students WHERE secondary_id  = '".mysqli_real_escape_string ($connect, $_GET['id'])."' AND sec_paid = '0' AND sec_admit = '0' AND sec_active_email = '1'") or die(db_conn_error);

if (!isset($errors)){$errors = array();}

if (mysqli_affected_rows($connect) == 1) {

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){
	 
    if (preg_match ('/^[a-zA-Z]{3,20}$/i', trim($_POST['firstname']))) {		//only 20 characters are allowed to be inputted
		$firstname = mysqli_real_escape_string ($connect, trim($_POST['firstname']));
	} else {
		$errors['firstname'] = 'Please enter firstname.';
	} 
	 
 
    if (preg_match ('/^[a-zA-Z]{3,20}$/i', trim($_POST['surname']))) {		//only 20 characters are allowed to be inputted
		$surname = mysqli_real_escape_string ($connect, trim($_POST['surname']));
	} else {
		$errors['surname'] = 'Please enter surname.';
	} 

    if ($_POST['age'] == "Enter age") {
		$errors['age'] = 'Please select student age';
	} else{
	$age = $_POST['age'];
	}
	
    if ($_POST['gender'] == "Choose gender") {
		$errors['gender'] = 'Please select gender';
	} else{
	$gender = $_POST['gender'];
	}
    
  if ($_POST['sec_class'] == "Choose school class") {
		$errors['sec_class'] = 'Please select school class';
	} else{
	$sec_class = $_POST['sec_class'];
	}



	if(preg_match('/^(0)[0-9]{10}$/i',$_POST['phone'])){
        $phone =  mysqli_real_escape_string($connect,$_POST['phone']);
    }else{
        $errors['phone'] = "Enter a valid phone number";
    }
	
	
	if (preg_match ('/^.{3,300}+$/i', trim($_POST['address']))) {		
		$address = mysqli_real_escape_string ($connect, trim($_POST['address']));
		} else {
		$errors['address'] = 'Please enter a invalid address';
		}
		
      
    
   
    if (is_uploaded_file($_FILES['img']['tmp_name']) AND $_FILES['img']['error'] == UPLOAD_ERR_OK){ 
		
			if($_FILES['img']['size'] > 2097152){ 		//conditions for the file size 2MB
				$errors['editfile_size']="File size is too big. Max file size 2MB";
			}
		
			$editallowed_extensions = array('jpeg', '.png', '.jpg', '.JPG', 'JPEG', '.PNG');		
			$editallowed_mime = array('image/jpeg', 'image/png', 'image/pjpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/x-png');
			$editimage_info = getimagesize($_FILES['img']['tmp_name']);
			$ext = substr($_FILES['img']['name'], -4);
			
			
			
			
			if (!in_array($_FILES['img']['type'], $editallowed_mime) || !in_array($editimage_info['mime'], $editallowed_mime) || !in_array($ext, $editallowed_extensions)){
				$errors['wrong_upload'] = "Please choose correct file type. JPG or PNG";
				
			}
			
		}else{
		$errors['upload_image'] = 'Please upload photo';	
		
		}
   


	//now to edit the product	
	if (empty($errors)){

      
		$new_name= (string) sha1($_FILES['img']['name'] . uniqid('',true));
			$new_name .= ((substr($ext, 0, 1) != '.') ? ".{$ext}" : $ext);
			$dest = "students/".$new_name;
			
			if (move_uploaded_file($_FILES['img']['tmp_name'], $dest)) {
			
			$_SESSION['images']['new_name'] = $new_name;
			$_SESSION['images']['file_name'] = $_FILES['img']['name'];
			
      $query_term_session = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
while($loop_term_session=mysqli_fetch_array($query_term_session)){
  $current_term = $loop_term_session['choose_term'];
  $current_session_term = $loop_term_session['school_session'];
 
}

// $query_term_start_end = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
  
    // while($whiling_term_start_end = mysqli_fetch_array($query_term_start_end)){

    //   $term = $whiling_term_start_end['choose_term'];
    //   $session = $whiling_term_start_end['school_session'];
    // }



mysqli_query($connect, "UPDATE secondary_school_students SET sec_active='1', sec_admit = '1', sec_school_term = '".$current_term."' , sec_year = '".$current_session_term."', sec_firstname = '".$firstname."', sec_surname = '".$surname."', sec_age = '".$age."', sec_sex = '".$gender."', sec_class_id = '".$sec_class."', sec_photo = '".$new_name."', sec_address= '".$address."' WHERE secondary_id = '".mysqli_real_escape_string ($connect, $_GET['id'])."' AND sec_admit = '0' AND sec_active_email = '1' AND sec_paid = '0'") or die(db_conn_error);
			if (mysqli_affected_rows($connect) == 1) {
			
            $_POST = array();		
			$_FILES = array();
				
			unset($_FILES['img'], $_SESSION['images']);
            header('Location:'.GEN_WEBSITE.'/admin/sec-registered.php?confirm='.$firstname);
            exit();
           
            
  }

} else {
			trigger_error('The file could not be moved.');
			$errors['not_moved'] = "The file could not be moved.";
			unlink ($_FILES['img']['tmp_name']);
			}	

} 


 }
 
 	
//$all_about_goods = mysqli_query($connect, "SELECT * FROM goods WHERE goods_id = '".$_GET['goods_no']."'") or die(db_conn_error);

while ($row = mysqli_fetch_array($query)) {
	
    
    //$pri_name = $row['primary_id'];
	$pri_firstname = $row['sec_firstname'];
	$pri_surname = $row['sec_surname'];
	$pri_phone = $row['sec_phone'];

	
	}
	
}else{
    require_once ('../../incs-arahman/dashboard.php');
echo ' 
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
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
    </div>

  
  <div class="row">

     <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Upload student details</h4>
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

          
          
          
          
          
          
            <div class="row">

             <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Upload <?php echo $pri_firstname.' '.$pri_surname.' '; ?>details</h4>
                    <p class="card-description"></p>
                    
                     <form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputName1">Firstname</label>
                        <?php if (array_key_exists('firstname', $errors)) {
				echo '<p class="text-danger">'.$errors['firstname'].'</p>';}?>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Firstname" value="<?php if(!isset($_POST['firstname'])){echo $pri_firstname;}else{echo $_POST['firstname'];}?>" name="firstname">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName2">Surname</label>
                        <?php if (array_key_exists('surname', $errors)) {
				echo '<p class="text-danger">'.$errors['surname'].'</p>';}?>
                        <input type="text" class="form-control" id="exampleInputName2" placeholder="Surname" value="<?php if(!isset($_POST['surname'])){echo $pri_surname;}else{echo $_POST['surname'];}?>" name="surname">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleSelectage">Age</label>
                        <?php if (array_key_exists('age', $errors)) {
				echo '<p class="text-danger" >'.$errors['age'].'</p>';} 
                ?>

                        <select class="form-control" id="exampleSelectage" name="age">
                         <?php        
                           
                        echo "<option>Enter age</option>";
			
                        if(isset ($_POST['age'])){
                            foreach ($age_range as $pri_age){
                            $sel = ($pri_age==$_POST['age'])?"Selected='selected'":"";
                            echo "<option $sel>$pri_age</option>";}
                        }else{
                        foreach ($age_range as $pri_age){
                        echo "<option>$pri_age</option>";
                        }
                        }
                        ?>            
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                    <?php if (array_key_exists('gender', $errors)) {
	                    echo '<p class="text-danger" >'.$errors['gender'].'</p>';
	                    }
                    ?>
                        <select class="form-control" id="exampleSelectGender" name="gender">
                       <?php        
                        $gender_range = array('Male', 'Female');    
                        echo "<option>Choose gender</option>";
                                        
                        if(isset ($_POST['gender'])){
                        foreach ($gender_range as $pri_gender){
                        $sel_gender = ($pri_gender==$_POST['gender'])?"selected='selected'":"";
                        echo "<option $sel_gender>$pri_gender</option>";}
                        }else{
                        foreach ($gender_range as $pri_gender){
                        echo "<option>$pri_gender</option>";
                        }
                        }
                        ?>            
                        </select>
                      </div>



                      <div class="form-group">
                        <label for="exampleSelectsec_class">School Class</label>
                    <?php if (array_key_exists('sec_class', $errors)) {
	                    echo '<p class="text-danger">'.$errors['sec_class'].'</p>';
	                    }
                    ?>
                        <select class="form-control" id="exampleSelectsec_class" name="sec_class">
                       <?php        
                       
                        echo "<option>Choose school class</option>";
                        $query_select_class = mysqli_query($connect, "SELECT secondary_class_id, secondary_class FROM secondary_school_classes") or die(db_conn_error);
                               
                        if(isset ($_POST['sec_class'])){
                          while($sec_class_range = mysqli_fetch_array($query_select_class)){
                        $sel_sec_class = ($sec_class_range['secondary_class']==$_POST['sec_class'])?"Selected='selected'":"";
                        echo '<option '.$sel_sec_class. 'value="'.$sec_class_range['secondary_class_id'].'">'.$sec_class_range['secondary_class'].'</option>';}
                        }else{
                        foreach ($sec_class_range as $sec_class_range['secondary_class']=>$sec_class_range['secondary_class_id']){
                        echo '<option value="'.$sec_class_range['secondary_class_id'].'">'.$sec_class_range['secondary_class'].'</option>';
                        }
                        }

                        ?>            
                        </select>
                      </div>





                      <div class="form-group">
                        <label for="phone">Phone number</label>
                        <?php if (array_key_exists('phone', $errors)) {
				echo '<p class="text-danger">'.$errors['phone'].'</p>';}?>
                        <input type="text" class="form-control" id="phone" placeholder="Phone number" value="<?php if(!isset($_POST['phone'])){echo $pri_phone;}else{echo $_POST['phone'];}?>" name="phone">
                      </div>
                     
                      <div class="form-group">
                        <label for="exampleTextarea1">Address</label>
                        <?php if (array_key_exists('address', $errors)) {
				echo '<p class="text-danger">'.$errors['address'].'</p>';}?>
                        <textarea class="form-control" id="address" rows="4" name="address"><?php if(isset($_POST['address'])){echo $_POST['address'];}?></textarea>
                      </div>
                     
                      <div class="form-group">
                        <label>Image Upload</label>

                        <?php 
                        if (array_key_exists('upload_image', $errors)) {
				        echo '<p class="text-danger">'.$errors['upload_image'].'</p>';}
                        
                        if (array_key_exists('editfile_size', $errors)) {
                            echo '<p class="text-danger">'.$errors['editfile_size'].'</p>';}

                        if (array_key_exists('wrong_upload', $errors)) {
                            echo '<p class="text-danger">'.$errors['wrong_upload'].'</p>';}

                        if (array_key_exists('not_moved', $errors)) {
                            echo '<p class="text-danger">'.$errors['not_moved'].'</p>';}
                            


                        ?>
                        <input type="file" name="img" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload image</button>
                          </span>
                        </div>
                      </div>



                      <button type="submit" class="btn btn-primary me-2" name="submit">Submit</button>
                      <button type="reset" class="btn btn-dark me-2" name="submit_info">Reset</button>
                    </form>
                  </div>
                </div>
              </div>

            </div>

           <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>



















      