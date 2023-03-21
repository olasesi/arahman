<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');
?>
<?php
if(isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header('Location:'.GEN_WEBSITE.'/admin');
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

  if(preg_match('/^[0-9a-z_]{3,30}$/i',$_POST['email'])){
	$email = mysqli_real_escape_string($connect,$_POST['email']);
}else{
	$signup_errors['email'] = "Enter a valid username";
}


if(preg_match('/^.{6,100}$/i',$_POST['password'])){
    $password =  mysqli_real_escape_string($connect,$_POST['password']);
  }else{
    $signup_errors['password'] = "Minimum of 6 characters";
  }



if(empty($signup_errors)){
  $query = mysqli_query($connect, "SELECT * FROM admin WHERE admin_email='".$email."' AND admin_password='".md5($password)."' AND admin_active='1'") or die(db_conn_error);
  if(mysqli_num_rows($query)== 1){
    $row = mysqli_fetch_array ($query, MYSQLI_NUM);

  $value = md5(uniqid(rand(), true));
	$query_confirm_sessions = mysqli_query ($connect, "SELECT admin_cookie_session FROM admin WHERE admin_email='".$email."'") or die(db_conn_error);
	$cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);
	
	if (empty($cookie_value_if_empty[0])){
	mysqli_query($connect,"UPDATE admin SET admin_cookie_session = '".$value."' WHERE admin_email='".$email."'") or die(db_conn_error);		
	setcookie("admin_remember_me", $value, time() + 4*24*3600);	//4 days for cookie to expire
	
	}else if(!empty($cookie_value_if_empty[0])){
	
	setcookie("admin_remember_me", $cookie_value_if_empty[0], time() + 4*24*3600);	//4 days for cookie to expire
	}


$_SESSION['admin_user_id'] = $row[0];
$_SESSION['admin_active'] = $row[1];
$_SESSION['admin_type'] = $row[2];
$_SESSION['admin_firstname'] = $row[3];
$_SESSION['admin_surname'] = $row[4];
$_SESSION['admin_email'] = $row[5];
$_SESSION['admin_password'] = $row[6];

 

  

header('Location:'.GEN_WEBSITE.'/admin/dashboard.php');
 exit;












  }else{



    $signup_errors['email'] = 'Invalid login details or you have been banned';
   

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
                    <h2>Admin login</h2>
                  </div>
                 
                 
                  <div class="col-lg-4">
                  <div style="height:30px;">
                    <?php if(array_key_exists('email', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['email'].'</small>';}?> </div>  
                  <fieldset>
                    <input name="email" type="text" id="email" placeholder="Username" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                  </fieldset>
                  </div>
                  
                  <div class="col-lg-4"><div style="height:30px;">
                  <?php if(array_key_exists('password', $signup_errors)){echo '<small class="text-danger">'.$signup_errors['password'].'</small>';}?>  </div>
                 
                  <fieldset>
                    <input name="password" type="password" id="password" placeholder="Password" value="<?php if(isset($_POST['password'])){echo '';} ?>" >
                  </fieldset>
</div>
                  
                
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
