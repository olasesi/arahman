<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
include("../../incs-arahman/cookie_for_most_teachers.php");

?>
<?php
if(!isset($_SESSION['primary_teacher_id'])){   //Not a teacher? Please leave
	header('Location:'.GEN_WEBSITE.'/teachers');
	exit();
}
?>


<?php

if (!isset($errors)){$errors = array();}



if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){
	 
    if (preg_match ('/^.{3,30}$/i', trim($_POST['assignment_name']))) {	
		$assignment_name = mysqli_real_escape_string ($connect, trim($_POST['assignment_name']));
	} else {
		$errors['assignment_name'] = 'Please enter valid name.';
	} 
	 
 
if (is_uploaded_file($_FILES['img']['tmp_name']) AND $_FILES['img']['error'] == UPLOAD_ERR_OK){ 
		
			if($_FILES['img']['size'] > 2097152){ 		//conditions for the file size 2MB
				$errors['editfile_size']="File size is too big. Max file size 2MB";
			}
		
			$editallowed_extensions = array('.pdf');		
			$editallowed_mime = array('application/pdf');
			$ext = substr($_FILES['img']['name'], -4);
			
			if (!in_array($_FILES['img']['type'], $editallowed_mime) || !in_array($ext, $editallowed_extensions)){
				$errors['wrong_upload'] = "Please choose a PDF file";
				
			}
			
		}else{
		$errors['upload_image'] = 'Please upload file';	
		
		}
   



	if (empty($errors)){

      
		$new_name= (string) sha1($_FILES['img']['name'] . uniqid('',true));
			$new_name .= ((substr($ext, 0, 1) != '.') ? ".{$ext}" : $ext);
			$dest = "../../incs-storage/assignments/".$new_name;
			
			if (move_uploaded_file($_FILES['img']['tmp_name'], $dest)) {
			
			$_SESSION['remind']['new_name'] = $new_name;
			$_SESSION['remind']['file_name'] = $_FILES['img']['name'];
			
mysqli_query($connect, "INSERT INTO primary_test_assignment_upload (primary_test_upload_class_id, primary_test_upload_filename, primary_test_upload_testname) VALUES ('".$_SESSION['primary_teacher_class_id']."', '".$new_name."', '".$assignment_name."')") or die(db_conn_error);
        


if (mysqli_affected_rows($connect) == 1) {
			
            $_POST = array();		
			$_FILES = array();
				
			unset($_FILES['img'], $_SESSION['remind']);
            header('Location:'.GEN_WEBSITE.'/teachers/home.php?confirm_file=1');
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












<?php include("../../incs-arahman/header-teacher-students.php");?>



            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                  




                <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Upload test/resources (.pdf)</h4>
        <p class="card-description">
          Test - Assignments - Resources for students
        </p>
        <form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputName1">Resource/test name</label>
            <?php if (array_key_exists('assignment_name', $errors)) {
				echo '<p class="text-danger">'.$errors['assignment_name'].'</p>';}?>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="e.g maths assignment" name="assignment_name" value="<?php if(isset($_POST['assignment_name'])){echo $_POST['assignment_name'];}?>">
          </div>
         
          <div class="form-group">
            <label>File upload</label>
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
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
            </div>
          </div>

          
         
          <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
          
        </form>
      </div>
    </div>
  </div>









                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/footer.html -->









<?php include_once("../../incs-arahman/footer-teacher-students.php"); ?>



