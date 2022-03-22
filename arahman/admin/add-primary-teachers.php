<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header("Location:/");
	exit();
}

if($_SESSION['admin_type'] != HEADMASTER){
	header("Location:/");
	exit();
}

?>




<?php

if (!isset($errors)){$errors = array();}



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

    if (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {		
		$email= mysqli_real_escape_string ($connect, trim($_POST['email']));
	} else {
		$errors['email'] = 'Please enter a valid email.';
	} 

    if($_POST['password'] == $_POST['conpassword']){
        if(preg_match('/^.{6,100}$/i',$_POST['password'])){
        $password =  mysqli_real_escape_string($connect,$_POST['password']);
      }else{
        $errors['password'] = "Minimum of 6 characters";
      }
    }else{
        $errors['conpassword'] = "Password did not match";
    }

   
    if (preg_match ('/^.{3,30}$/i', trim($_POST['qualification']))) {		
		$qualification = mysqli_real_escape_string ($connect, trim($_POST['qualification']));
	} else {
		$errors['qualification'] = 'Please enter teacher qualification';
	} 

if ($_POST['age'] == "Enter age") {
		$errors['age'] = 'Please choose age';
	} else{
	$age = $_POST['age'];
	}
	
    if ($_POST['gender'] == "Choose gender") {
		$errors['gender'] = 'Please choose teacher gender';
	} else{
	$gender = $_POST['gender'];
	}
    
    if ($_POST['class'] == "Choose class") {
		$errors['class'] = 'Please choose class';
	} else{
	$class = $_POST['class'];
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
			$dest = "teachers/".$new_name;
			
			if (move_uploaded_file($_FILES['img']['tmp_name'], $dest)) {
			
			$_SESSION['images']['new_name'] = $new_name;
			$_SESSION['images']['file_name'] = $_FILES['img']['name'];
			
mysqli_query($connect, "INSERT INTO primary_teachers (primary_teacher_class_id, primary_teacher_firstname, primary_teacher_surname,	primary_teacher_email, primary_teacher_password, primary_teacher_sex, primary_teacher_age, primary_teacher_phone, primary_teacher_qualification, primary_teacher_address, primary_teacher_image, 	primary_teacher_cookie) VALUES ( '".$class."', '".$firstname."', '".$surname."', '".$email."','".$password."','".$gender."', '".$age."', '".$phone."','".$qualification."', '".$address."', '".$new_name."', '')") or die(db_conn_error);
        


if (mysqli_affected_rows($connect) == 1) {
			
            $_POST = array();		
			$_FILES = array();
				
			unset($_FILES['img'], $_SESSION['images']);
            header('Location:'.GEN_WEBSITE.'/admin/add-primary-teachers.php?teacher-added='.$firstname);
            exit();
           
            
  }

} else {
			trigger_error('The file could not be moved.');
			$errors['not_moved'] = "The file could not be moved.";
			unlink ($_FILES['img']['tmp_name']);
			}	

} 


 }
 
 	

 
?>
 <?php require_once ('../../incs-arahman/dashboard.php');?>  
        <!-- partial -->
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

 <?php         
    if(isset($_GET['teacher-added'])){
           
        echo '<div class="row">

<div class="col-12 grid-margin stretch-card">
   <div class="card">
     <div class="card-body">
       <h4 class="card-title">'.$_GET['teacher-added'].' has been added</h4>
     

          
              
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
                    <h4 class="card-title">Upload teacher details</h4>
                    <p class="card-description"></p>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputName1">Firstname</label>
                        <?php if (array_key_exists('firstname', $errors)) {
				echo '<p class="text-danger">'.$errors['firstname'].'</p>';}?>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Firstname" value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];}?>" name="firstname">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName2">Surname</label>
                        <?php if (array_key_exists('surname', $errors)) {
				echo '<p class="text-danger">'.$errors['surname'].'</p>';}?>
                        <input type="text" class="form-control" id="exampleInputName2" placeholder="Surname" value="<?php if(isset($_POST['surname'])){echo $_POST['surname'];}?>" name="surname">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputemail2">Email address</label>
                        <?php if (array_key_exists('email', $errors)) {
				echo '<p class="text-danger">'.$errors['email'].'</p>';}?>
                        <input type="text" class="form-control" id="exampleInputemail2" placeholder="Email Address" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" name="email">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputpassword">Password</label>
                        <?php if(array_key_exists('password', $errors)){echo '<p class="text-danger">'.$errors['password'].'</p>';}?>  
                  <?php if(array_key_exists('conpassword', $errors)){echo '<p class="text-danger">'.$errors['conpassword'].'</p>';}?>
                
                        <input type="password" class="form-control" id="exampleInputpassword" placeholder="Password" value="" name="password">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputconpassword">Confirm password</label>
             
                        <input type="password" class="form-control" id="exampleInputconpassword" placeholder="Confirm password" value="" name="conpassword">
                      </div>



                      <div class="form-group">
                        <label for="exampleInputqua2">Qualification</label>
                        <?php if (array_key_exists('qualification', $errors)) {
				echo '<p class="text-danger">'.$errors['qualification'].'</p>';}?>
                        <input type="text" class="form-control" id="exampleInputqua2" placeholder="Qualification" value="<?php if(isset($_POST['qualification'])){echo $_POST['qualification'];}?>" name="qualification">
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
                        $sel_gender = ($pri_gender==$_POST['gender'])?"Selected='selected'":"";
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
                        <label for="exampleSelectclass">Class</label>
                    <?php if (array_key_exists('class', $errors)) {
	                    echo '<p class="text-danger" >'.$errors['class'].'</p>';
	                    }
                    ?>
                        <select class="form-control" id="exampleSelectclass" name="class">
                       <?php        
                        
                        echo '<option>Choose class</option>';
                                        
                        if(isset ($_POST['class'])){
                        foreach ($class_range as $pri_class=>$class_number){
                        $sel_class = ($pri_class==$_POST['class'])?'Selected="selected"':'';
                        echo '<option value="'.$class_number.'" '.$sel_class.'>'.$pri_class.'</option>';}
                        }else{
                            foreach ($class_range as $pri_class=>$class_number){
                              
                                echo '<option value="'.$class_number.'">'.$pri_class.'</option>';}

                        }
                        ?>            
                        </select>
                      </div>



                      <div class="form-group">
                        <label for="phone">Phone number</label>
                        <?php if (array_key_exists('phone', $errors)) {
				echo '<p class="text-danger">'.$errors['phone'].'</p>';}?>
                        <input type="text" class="form-control" id="phone" placeholder="Phone number" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>" name="phone">
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



















      