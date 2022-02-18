<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){      //If you are not admin
	header('Location:'.GEN_WEBSITE.'/admin');
    exit();
}


if($_SESSION['admin_type'] != HEADMASTER){      // if not headmaster
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}


if(!isset($_GET['id'])){
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}
?>






<?php
$query = mysqli_query($connect, "SELECT primary_teacher_class_id, primary_teacher_firstname, primary_teacher_surname,	primary_teacher_email, primary_teacher_sex, primary_teacher_age, primary_teacher_phone, primary_teacher_qualification, primary_teacher_address FROM primary_teachers WHERE primary_teacher_id  = '".mysqli_real_escape_string ($connect, $_GET['id'])."'") or die(db_conn_error);



if (!isset($errors)){$errors = array();}

if (mysqli_affected_rows($connect) == 1){

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit_info'])){
	 
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
    
    if ($_POST['class'] == "Choose school class") {
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
		
    

	//now to edit the product	
	if (empty($errors)){

mysqli_query($connect, "UPDATE primary_teachers SET primary_teacher_class_id = '".$class."', primary_teacher_firstname = '".$firstname."',  primary_teacher_surname = '".$surname."', primary_teacher_email = '".$email."', primary_teacher_sex = '".$gender."', primary_teacher_age = '".$age."', primary_teacher_phone = '".$phone."', primary_teacher_qualification = '".$qualification."', primary_teacher_address = '".$address."' WHERE primary_teacher_id = '".mysqli_real_escape_string ($connect, $_GET['id'])."'") or die(db_conn_error);


			if (mysqli_affected_rows($connect) == 1) {
                
          
            header('Location:'.GEN_WEBSITE.'/admin/show-teachers.php?info-edited='.$firstname);
            exit();
           
            
  }



}

 }
 
 	
//$all_about_goods = mysqli_query($connect, "SELECT * FROM goods WHERE goods_id = '".$_GET['goods_no']."'") or die(db_conn_error);

while ($row = mysqli_fetch_array($query)) {
	
    
    
	$pri_class = $row['primary_teacher_class_id'];      //This is the class e.g Basic 4
	$pri_firstname = $row['primary_teacher_firstname'];
	$pri_surname = $row['primary_teacher_surname'];
    $pri_email = $row['primary_teacher_email'];
	$pri_gender = $row['primary_teacher_sex'];
	$pri_age = $row['primary_teacher_age'];
    $pri_phone = $row['primary_teacher_phone'];
    $pri_qualification = $row['primary_teacher_qualification'];
	$pri_address = $row['primary_teacher_address'];
	
	
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
                    <h4 class="card-title">Edit teacher's infomation</h4>
                    <p class="card-description"></p>
                    
                     <form class="forms-sample" method="POST" action="">
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
                        <label for="exampleInputemail">Email address</label>
                        <?php if (array_key_exists('email', $errors)) {
				echo '<p class="text-danger">'.$errors['email'].'</p>';}?>
                        <input type="text" class="form-control" id="exampleInputemail" placeholder="Email address" value="<?php if(!isset($_POST['email'])){echo $pri_email;}else{echo $_POST['email'];}?>" name="email">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputqual">Qualification</label>
                        <?php if (array_key_exists('qualification', $errors)) {
				echo '<p class="text-danger">'.$errors['qualification'].'</p>';}?>
                        <input type="text" class="form-control" id="exampleInputqual" placeholder="Qualification" value="<?php if(!isset($_POST['qualification'])){echo $pri_qualification;}else{echo $_POST['qualification'];}?>" name="qualification">
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectage">Age</label>
                        <?php if (array_key_exists('age', $errors)) {
				echo '<p class="text-danger" >'.$errors['age'].'</p>';} 
                ?>

                        <select class="form-control" id="exampleSelectage" name="age">
                         <?php        
                        $age_range = array(1, 2, 3, 4, 5, 6, 7, 8);    
                        echo "<option>Enter age</option>";
                        foreach($age_range as $as_age){	
                            if(!isset ($_POST['age'])){
                                $editsel = ($as_age==$pri_age)?"Selected='selected'":"";
                                }else{
                                $editsel = ($as_age==$_POST['age'])?"Selected='selected'":"";			
                                }
                                echo "<option $editsel>$as_age</option>";
                        }

                       
                        ?>            
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                    <?php if (array_key_exists('gender', $errors)) {
	                    echo '<p class="text-danger">'.$errors['gender'].'</p>';
	                    }
                    ?>
                        <select class="form-control" id="exampleSelectGender" name="gender">
                       <?php        
                        $gender_range = array('Male', 'Female');    
                        echo "<option>Choose gender</option>";
                        foreach($gender_range as $as_gender){	
                            if(!isset ($_POST['gender'])){
                                $editsel_gender = ($as_gender==$pri_gender)?"Selected='selected'":"";
                                }else{
                                $editsel_gender = ($as_gender==$_POST['gender'])?"Selected='selected'":"";			
                                }
                                echo "<option $editsel_gender>$as_gender</option>";
                        }   
                        
                        ?>            
                        </select>
                      </div>



                      <div class="form-group">
                        <label for="exampleSelectpri_class">School Class</label>
                    <?php if (array_key_exists('class', $errors)) {
	                    echo '<p class="text-danger">'.$errors['class'].'</p>';
	                    }
                    ?>
                        <select class="form-control" id="exampleSelectpri_class" name="class">
                       <?php        
                        $pri_class_range = array('Basic one', 'Basic two', 'Basic three', 'Basic four', 'Basic five', 'Basic six');    
                        echo "<option>Choose school class</option>";
                                        
                        foreach($pri_class_range as $as_class){	
                            if(!isset ($_POST['class'])){
                                $editsel_class = ($as_class==$pri_class)?"Selected='selected'":"";
                                }else{
                                $editsel_class = ($as_class==$_POST['class'])?"Selected='selected'":"";			
                                }
                                echo "<option $editsel_class>$as_class</option>";
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
                        <textarea class="form-control" id="address" rows="4" name="address"><?php if(!isset($_POST['address'])){echo $pri_address;}else{echo $_POST['address'];}?></textarea>
                      </div>
                     
                     

                     
                      <button type="submit" class="btn btn-primary me-2" name="submit_info">Submit</button>
                      <button type="reset" class="btn btn-dark me-2" name="submit_info">Reset</button>
                    </form>
                  </div>
                </div>
              </div>

            </div>

           <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>



















      