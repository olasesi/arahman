<?php
require_once ('../incs-arahman/config.php');
require_once ('../incs-arahman/gen_serv_con.php');
$page_title = 'Email Verification';


// if(isset($_SESSION['user_id'])){
// header("Location:".GEN_WEBSITE);
// exit();}


include ('../incs-arahman/header.php');

echo '<header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">';

if(isset($_GET['hash']) && !empty($_GET['hash'])){

//$surname = mysqli_real_escape_string($connect, $_GET['surname']);	
$hash = mysqli_real_escape_string($connect, $_GET['hash']);

$search = mysqli_query($connect, "SELECT sec_email, sec_active_email FROM secondary_school_students WHERE sec_email_hash = '".$hash."' AND sec_active_email = '0'") or die(db_conn_error);
$match = mysqli_num_rows($search);

	if($match > 0){

	mysqli_query($connect, "UPDATE secondary_school_students SET sec_active_email = '1' WHERE sec_surname='".$surname."' AND sec_email_hash='".$hash."' AND sec_active_email='0'") or die(db_conn_error);	
	
	echo '<br><br><br>';
	echo '<div class="">Thank you for registering. An email has been sent to your inbox. Please click the link to confirm your account.
    <center><a href="'.GEN_WEBSITE.'/verify-email.php?hash='.$_GET['hash'].'">Confirm email</a></center> 
    </div>';
	echo '<br><br><br>';
	
echo  						'</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';	
	
	
	}else{
	echo '<br><br><br>';
	echo '<div class="">The url is either invalid or expired. Please sign up again and click the link sent to you.</div>';	
	echo '<br><br><br>';
	echo  						'</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';	
	}

}else{
	echo '<br><br><br>';
	echo '<div class="">Invalid approach. Please use the link that has been sent to your email.</div>';	
	echo '<br><br><br>';
	echo  						'</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';	
}


