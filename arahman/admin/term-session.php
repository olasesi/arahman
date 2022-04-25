<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header('Location:/'.GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != OWNER){
	header('Location:/'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();

}


?>



                  
                    <?php
         
              if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['end_term'])){
                
                $q_end_term = mysqli_query($connect,"UPDATE term_start_end SET term_end = '".$now->format('Y-m-d H:i:s')."' WHERE term_start_end_id = '".$_POST['hidden_start_end']."' LIMIT 1") or die(db_conn_error);
                
     /*           if(mysqli_affected_rows($connect, $q_end_term) === 1){
           //Primary school and should a students be logged out?      
          mysqli_query($connect,"UPDATE primary_school_students SET pri_paid = '0', pri_admit = '0'") or die(db_conn_error); //It just has to be this way. Perhaps the admission will promote the kids knowing that they were present last term. This period, admission will go to the portal and promote the students and put him to the appropriate class 

          mysqli_query($connect, "DELETE FROM primary_payment WHERE primary_payment_paid_percent ='100'") or die(db_conn_error);
          //Debtors details still available in the history

          mysqli_query($connect, "DELETE FROM module_join_students") or die(db_conn_error);
      
          mysqli_query($connect, "DELETE FROM module_price") or die(db_conn_error);

          mysqli_query($connect, "DELETE FROM modules") or die(db_conn_error);



                }*/
                
                
                
                
                
                header('Location:'.GEN_WEBSITE.'/admin/term-session.php?endstart_another=1');
                exit();
              
              
              
              
              
              }
          
           
              if (!isset($errors)) {$errors = array();}
              if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['start_end_term'])){
                
                if (preg_match ('/^(\d{4}\/\d{4})$/', $_POST['pri_session'])) {	
                  $pri_session = mysqli_real_escape_string ($connect, $_POST['pri_session']);
                } else {
                  $errors['pri_session'] = 'Please enter the school session e.g 2001/2002';
                } 
                
                if ($_POST['choose_term'] == "Choose term") {
                  $errors['choose_term'] = 'Please choose the school term you are in.';
                }else{
                $chooseterm = $_POST['choose_term'];    
                }

                 if(empty($errors)){

                   $no_copy = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end") or die(db_conn_error);
if(mysqli_num_rows($no_copy) > 0){
  $no_many_copy = mysqli_query($connect, "SELECT choose_term, school_session FROM term_start_end WHERE choose_term = '".$chooseterm."' AND school_session = '".$pri_session."'") or die(db_conn_error);
if(mysqli_num_rows($no_many_copy) > 0){

  header('Location:'.GEN_WEBSITE.'/admin/term-session.php?period_used_before=1');
  exit();
}
  
}


                  $query_term_start = mysqli_query($connect, "SELECT term_start, term_end FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
  
                  if(mysqli_num_rows($query_term_start) > 0){

                  while($row_term_start = mysqli_fetch_array($query_term_start)){
                    
                    
                   $ask_term_starts = $row_term_start['term_start'];
                   $ask_term_end = $row_term_start['term_end'];

}

                  if(!empty($ask_term_starts) AND empty($ask_term_end)){
                    header('Location:'.GEN_WEBSITE.'/admin/term-session.php?must_end_before=1');
                    exit();
                  }




                  // $no_copy = mysqli_query($connect, "SELECT term_start, term_end, choose_term, school_session FROM term_start_end") or die(db_conn_error);


}                    
  

                  // if (empty($start_term) AND empty($start_end)){
                 
                $q = mysqli_query($connect,"INSERT INTO term_start_end(choose_term, term_start, term_end, school_session) VALUES ('".$chooseterm."', '".$now->format('Y-m-d H:i:s')."', '', '".$pri_session."')") or die(db_conn_error);
                
                header('Location:'.GEN_WEBSITE.'/admin/term-session.php?confirm_file=1');
                exit();
                 //}elseif(!empty($start_term) AND !empty($start_end)){
                
                 //$q = mysqli_query($connect,"INSERT INTO term_start_end(term_start_end_id, choose_term, term_start, term_end, term_year) VALUES ('','".$chooseterm."', '".$now->format('Y-m-d H:i:s')."', '', '".$pri_session."')") or die(db_conn_error);
                 
                //}
              
              }
                
                
               
              
                
              }

              ?>
           


              <?php require_once('../../incs-arahman/dashboard.php'); ?>


        
        
        
        
        
        
              <!-- partial -->
              <div class="main-panel">
                <div class="content-wrapper">
                      

                          <?php         
                          if(isset($_GET['confirm_file']) AND $_GET['confirm_file'] = 1){
                                
                              echo '<div class="row">
                      
                          <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title text-warning text-center">A new school term has started. Please do not forget to end a term before beginning a new one</h4>
                          
                      
                                
                                    
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                      
                                  </div>';
                      }
                        
                          ?>

<?php         
                          if(isset($_GET['endstart_another']) AND $_GET['endstart_another'] = 1){
                                
                              echo '<div class="row">
                      
                          <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title text-warning text-center">You have now ended a school term</h4>
                          
                      
                                
                                    
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                      
                                  </div>';
                      }
                      
                          ?>


<?php         
                          if(isset($_GET['must_end_before']) AND $_GET['must_end_before'] = 1){
                                
                              echo '<div class="row">
                      
                          <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title text-warning text-center">You cannot start a new term without first ending the current term</h4>
                          
                      
                                
                                    
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                      
                                  </div>';
                      }
                     
                          ?>

<?php         
                          if(isset($_GET['period_used_before']) AND $_GET['period_used_before'] = 1){
                                
                              echo '<div class="row">
                      
                          <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title text-warning text-center">This term and session has been used before</h4>
                          
                      
                                
                                    
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
                     
                    
                     
                     
                     <h4 class="card-title text-danger text-center" id="Foo">WARNING!!! The portal runs on changes made here, so ensure you enter the correct values. Changes made here cannot be reversed </h4>
                      
                  
                            
                                
                                      </form>
                                    </div>
                                  </div>
                                </div>
                  
                              </div>

                  <div class="row">
      
                  <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">School term and session</h4>
                          <p class="card-title">To begin a term, type the session to begin with and select the term. And to end the term, only click the end term button </p>

           
                <form action="" method="POST">
                
                      
                          <div class="form-group">
                                  <label for="exampleInputName1">Session</label>
                                  <?php if (array_key_exists('pri_session', $errors)) {
                  echo '<p class="text-danger">'.$errors['pri_session'].'</p>';}?>
                                  <input type="text" class="form-control" id="exampleInputName1" placeholder="e.g 2001/2002" value="<?php if(isset($_POST['pri_session'])){echo $_POST['pri_session'];}?>" name="pri_session">
                                </div> 
                          
                          
                          <div class="form-group">
                            <label>Select school term</label>
                            <select class="js-example-basic-single" style="width:100%" name="choose_term">
            
                            
                            <option>Choose term</option>
                              <option>First term</option>
                              <option>Second term</option>
                              <option>Third term</option>
                            
                            </select>
                          </div>
            
                          <button type="submit" class="btn btn-success me-2" name="start_end_term">Begin term</button>
                          
                        </form>








                        <?php
                          $query_term_end = mysqli_query($connect, "SELECT term_start_end_id, term_start, term_end FROM term_start_end ORDER BY term_start_end_id DESC LIMIT 1") or die(db_conn_error);
  
                          if(mysqli_num_rows($query_term_end) > 0){

                          while($row_term_end = mysqli_fetch_array($query_term_end)){
                            
                            $term_start_end_id = $row_term_end['term_start_end_id'];
                           $the_term_starts = $row_term_end['term_start'];
                           $the_term_end = $row_term_end['term_end'];

  }

  if(!empty($the_term_starts) AND empty($the_term_end)){
echo '<hr>
<div class="form-group">
<form action="" method="POST">
<input type="hidden" value="'.$term_start_end_id.'" name="hidden_start_end">
<button type="submit" class="btn btn-danger me-2" name="end_term" >End term</button>
</form>
</div>
';
}
}                    
                     ?> 
                        </div>
                  </div> </div>





              <!-- <form action="" method="POST">
                <div class="form-group">
                <label>Select </label>
                
              </div>

              <button type="submit" class="btn btn-success me-2" name="end_term">End term</button>
              
  
                
                  </form> -->








              <!-- <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Secondary School</h4>
                    <h4 class="card-title">Begin or End</h4>
                    <div class="form-group">
                      <label>Select </label>
                      <select class="js-example-basic-single" style="width:100%">
                      <option value="">Choose term</option>
                      <option value="AL">First term</option>
                        <option value="WY">Second term</option>
                        <option value="AM">Third term</option>
                      
                      </select>
                    </div>
                    <button type="submit" class="btn btn-danger me-2">Submit</button>
                  </div>
                </div>
              </div> -->












            </div>


                     













<script>
                    /* window.addEventListener("load", function() {
    var f = document.getElementById('Foo');
    setInterval(function() {
        f.style.display = (f.style.display == 'none' ? '' : 'none');
    }, 1000);

}, false); */
</script>                 



            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>