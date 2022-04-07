<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header('Location:/'.GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != ACCOUNTANT){
	header('Location:/'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();

}


?>


<?php 

    mysqli_query($connect, "SELECT " )

?>


<?php require_once('../../incs-arahman/dashboard.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> School Fees Setting</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Primary School</h4>
                                <p class="card-description">Primary School Fees </p>
                                <form class="forms-sample">
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputUsername2" placeholder="10,000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputEmail2" placeholder="10,000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputMobile" placeholder="10,000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputPassword2" placeholder="10,000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputConfirmPassword2" placeholder="10,000">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Secondary School</h4>
                                <p class="card-description"> Secondary School Fees</p>
                                <form class="forms-sample">
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputUsername2" placeholder="10,000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputEmail2" placeholder="10,000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputMobile" placeholder="10,000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputPassword2" placeholder="10,000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputConfirmPassword2" placeholder="10,000">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>

                








<script>
                     window.addEventListener("load", function() {
    var f = document.getElementById('Foo');
    setInterval(function() {
        f.style.display = (f.style.display == 'none' ? '' : 'none');
    }, 1000);

}, false);
</script>                 



            <?php require_once ('../../incs-arahman/dashboard-footer.php'); ?>