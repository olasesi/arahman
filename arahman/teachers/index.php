<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');

?>
<?php
if(isset($_SESSION['admin_id'])){   //logged in admins dont have right to teachers login.
	header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();
}
?>

<?php
//if(isset($_SESSION['prospective_id'])){   //logged in students dont have right to teachers login.
	//header('Location:'.GEN_WEBSITE.'/prospective-students/home.php');
	//exit();
//}
?>

<?php
if(isset($_SESSION['primary_teacher_id'])){   //logged in teachers dont have right to teachers login.
	header('Location:'.GEN_WEBSITE.'/teachers/home.php');
	exit();
}
?>
<?php
if(isset($_SESSION['secondary_teacher_id'])){   //logged in teachers dont have right to teachers login.
	header('Location:'.GEN_WEBSITE.'/teachers/sec-home.php');
	exit();
}
?>
<?php
include ('../../incs-arahman/header-admin.php');
include ('../../incs-arahman/menu-admin.php');
?>

<?php
$signup_errors = array();
if(isset($_POST['submit']) AND $_SERVER['REQUEST_METHOD'] == "POST"){

  if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
	$email = mysqli_real_escape_string($connect,$_POST['email']);
}else{
	$signup_errors['email'] = "Enter a valid email address";
}


if(preg_match('/^.{6,100}$/i',$_POST['password'])){
    $password =  mysqli_real_escape_string($connect,$_POST['password']);
  }else{
    $signup_errors['password'] = "Minimum of 6 characters";
  }

  if(isset($_POST['school_type'])){
    $pri_school_type =  $_POST['school_type'];
   }else{
    $signup_errors['school_type'] = "Select school";

   }




if(empty($signup_errors)){

  if($pri_school_type == 'Primary school'){

  $query = mysqli_query($connect, "SELECT * FROM primary_teachers, primary_school_classes WHERE primary_class_id=primary_teacher_class_id AND primary_teacher_email='".$email."' AND primary_teacher_password = '".md5($password)."' AND primary_teacher_active='1'") or die(db_conn_error);
  if(mysqli_num_rows($query)== 1){

    while($row = mysqli_fetch_array ($query, MYSQLI_NUM)){
      //if(password_verify($password,$row[6])){

    //$row = mysqli_fetch_array ($query, MYSQLI_NUM);

  $value = md5(uniqid(rand(), true));
	$query_confirm_sessions = mysqli_query ($connect, "SELECT primary_teacher_cookie FROM primary_teachers WHERE primary_teacher_email='".$email."'  AND primary_teacher_active='1'") or die(db_conn_error);
	$cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);
	
	if (empty($cookie_value_if_empty[0])){
	mysqli_query($connect,"UPDATE primary_teachers SET primary_teacher_cookie = '".$value."' WHERE primary_teacher_email='".$email."'") or die(db_conn_error);		
	setcookie("teacher_remember_me", $value, time() + 4*24*3600);	//4 days for cookie to expire
	
	}else if(!empty($cookie_value_if_empty[0])){
	
	setcookie("teacher_remember_me", $cookie_value_if_empty[0], time() + 4*24*3600);	//4 days for cookie to expire
	}
  

$_SESSION['primary_teacher_id'] = $row[0];
$_SESSION['primary_teacher_class_id'] = $row[2];
$_SESSION['primary_teacher_firstname'] = $row[3];
$_SESSION['primary_teacher_surname'] = $row[4];
$_SESSION['primary_teacher_email'] = $row[5];
$_SESSION['primary_teacher_sex'] = $row[7];
$_SESSION['primary_teacher_age'] = $row[8];
$_SESSION['primary_teacher_phone'] = $row[9];
$_SESSION['primary_teacher_qualification'] = $row[10];
$_SESSION['primary_teacher_address'] = $row[11];
$_SESSION['primary_teacher_image'] = $row[12];
$_SESSION['primary_class'] = $row[16];
 

header('Location:'.GEN_WEBSITE.'/teachers/home.php');
 exit;


    // }else{

    //   $signup_errors['email'] = 'Invalid login details or you have been banned';
    // }




  }




  }else{



    $signup_errors['email'] = 'Invalid login details or you have been banned';
   

  }

}elseif($pri_school_type == 'Secondary school'){

  $query = mysqli_query($connect, "SELECT * FROM secondary_teachers, secondary_school_classes WHERE secondary_class_id=secondary_teacher_class_id AND secondary_teacher_email='".$email."' AND secondary_teacher_password = '".md5($password)."' AND secondary_teacher_active='1'") or die(db_conn_error);
  if(mysqli_num_rows($query)== 1){

    while($row = mysqli_fetch_array ($query, MYSQLI_NUM)){
      //if(password_verify($password,$row[6])){

    //$row = mysqli_fetch_array ($query, MYSQLI_NUM);

  $value = md5(uniqid(rand(), true));
	$query_confirm_sessions = mysqli_query ($connect, "SELECT secondary_teacher_cookie FROM secondary_teachers WHERE secondary_teacher_email='".$email."'  AND secondary_teacher_active='1'") or die(db_conn_error);
	$cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);
	
	if (empty($cookie_value_if_empty[0])){
	mysqli_query($connect,"UPDATE secondary_teachers SET secondary_teacher_cookie = '".$value."' WHERE secondary_teacher_email='".$email."'") or die(db_conn_error);		
	setcookie("sec_teacher_remember_me", $value, time() + 4*24*3600);	//4 days for cookie to expire
	
	}else if(!empty($cookie_value_if_empty[0])){
	
	setcookie("sec_teacher_remember_me", $cookie_value_if_empty[0], time() + 4*24*3600);	//4 days for cookie to expire
	}
  

$_SESSION['secondary_teacher_id'] = $row[0];
$_SESSION['secondary_teacher_class_id'] = $row[2];
$_SESSION['secondary_teacher_firstname'] = $row[3];
$_SESSION['secondary_teacher_surname'] = $row[4];
$_SESSION['secondary_teacher_email'] = $row[5];
$_SESSION['secondary_teacher_sex'] = $row[7];
$_SESSION['secondary_teacher_age'] = $row[8];
$_SESSION['secondary_teacher_phone'] = $row[9];
$_SESSION['secondary_teacher_qualification'] = $row[10];
$_SESSION['secondary_teacher_address'] = $row[11];
$_SESSION['secondary_teacher_image'] = $row[12];
$_SESSION['secondary_class'] = $row[16];
 

header('Location:'.GEN_WEBSITE.'/teachers/sec-home.php');
 exit;


    // }else{

    //   $signup_errors['email'] = 'Invalid login details or you have been banned';
    // }




  }




  }else{



    $signup_errors['email'] = 'Invalid login details or you have been banned';
   

  }





}








}
}
?>




<section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center center-block">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Teachers login</h2>
                  </div>
                 
                 
                  <div class="col-lg-4"><div style="height:30px;">
                  <?php if(array_key_exists('email', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['email'].'</small>';}?> </div>  
                  <fieldset>
                    <input name="email" type="text" id="email" placeholder="Email address" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                  </fieldset>
                  </div>
                  
                  <div class="col-lg-4"><div style="height:30px;">
                  <?php if(array_key_exists('password', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password'].'</small>';}?> </div> 
                 
                  <fieldset>
                    <input name="password" type="password" id="password" placeholder="Password" value="<?php if(isset($_POST['password'])){echo '';} ?>" >
                  </fieldset>
</div>
<?php if(array_key_exists('school_type', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['school_type'].'</small>';}?>        
  
<label for="gridRadios2">Primary school</label>
        <input class="form-check-input" type="radio" name="school_type" id="gridRadios2" value="Primary school" <?php if(isset($_POST['school_type']) && $_POST['school_type'] =='Primary school'){echo 'checked="checked"';} ?>>
        
        <label for="gridRadios3">Secondary school</label>
        <input class="form-check-input" type="radio" name="school_type" id="gridRadios3" value="Secondary school" <?php if(isset($_POST['school_type']) && $_POST['school_type'] == 'Secondary school'){echo 'checked="checked"';} ?>>


        
<div class="col-lg-12">              
                
<div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button" name="submit">SUBMIT</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    </section>

    <section class="contact-us" id="contact">
   
   <div class="footer">

<p>Copyright © <span id="copyright-year"></span> , Ltd. All Rights Reserved.
  <!-- <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a></p> -->
</div>
</section>


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        var copy_year = new Date();
    document.getElementById("copyright-year").innerHTML = copy_year.getFullYear();

    </script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
            var
                direction = section.replace(/#/, ''),
                reqSection = $('.section').filter('[data-section="' + direction + '"]'),
                reqSectionPos = reqSection.offset().top - 0;

            if (isAnimate) {
                $('body, html').animate({
                        scrollTop: reqSectionPos
                    },
                    800);
            } else {
                $('body, html').scrollTop(reqSectionPos);
            }

        };

        var checkSection = function checkSection() {
            $('.section').each(function() {
                var
                    $this = $(this),
                    topEdge = $this.offset().top - 80,
                    bottomEdge = topEdge + $this.height(),
                    wScroll = $(window).scrollTop();
                if (topEdge < wScroll && bottomEdge > wScroll) {
                    var
                        currentId = $this.data('section'),
                        reqLink = $('a').filter('[href*=\\#' + currentId + ']');
                    reqLink.closest('li').addClass('active').
                    siblings().removeClass('active');
                }
            });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function(e) {
            e.preventDefault();
            showSection($(this).attr('href'), true);
        });

        $(window).scroll(function() {
            checkSection();
        });
    </script>
    </body>



    </html>
