<?php
require_once ('../../incs-arahman/config.php');
require_once ('../../incs-arahman/gen_serv_con.php');
//include("../incs_shop/cookie_for_most.php");
//include('../users/includes/menu.php');

if(!isset($_SESSION['admin_active'])){   //This is for all admins. Every of them.
	header('Location:/'.GEN_WEBSITE.'/admin');
	exit();
}

if($_SESSION['admin_type'] != ACCOUNTANT && $_SESSION['admin_type'] != OWNER){
	header('Location:/'.GEN_WEBSITE.'/admin/dashboard.php');
	exit();

}


?>


<?php require_once('../../incs-arahman/dashboard.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">$12.34</h3>
                                    <p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Potential growth</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">$17.34</h3>
                                    <p class="text-success ms-2 mb-0 font-weight-medium">+11%</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Revenue current</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">$12.34</h3>
                                    <p class="text-danger ms-2 mb-0 font-weight-medium">-2.4%</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-danger">
                                    <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Daily Income</h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">$31.53</h3>
                                    <p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                                </div>
                                <h6 class="text-muted font-weight-normal">Expense current</h6>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Payment History</h4>
                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                        <th> Refrence No </th>
                                        <th> Amount </th>
                                        <th> Class </th>
                                        <th> Date </th>
                                        <th> Percentage </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                        <span class="ps-2">Abdulkabir irrahdatullahi ayomide</span>
                                        </td>
                                        <td> LS458GFT </td>
                                        <td> $14,500 </td>
                                        <td> JSS 3 </td>
                                        <td> 14 Jun 2021 </td>
                                        <td>
                                        <div class="badge badge-outline-success">100%</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <span class="ps-2">Estella Bryan</span>
                                        </td>
                                        <td> LS458GFT </td>
                                        <td> $14,500 </td>
                                        <td> SSS 2 </td>
                                        <td> 14 Jun 2021 </td>
                                        <td>
                                        <div class="badge badge-outline-warning">75%</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <span class="ps-2">Lucy Abbott</span>
                                        </td>
                                        <td> LS458GFT </td>
                                        <td> $14,500 </td>
                                        <td> JSS 1 </td>
                                        <td> 14 Jun 2021 </td>
                                        <td>
                                        <div class="badge badge-outline-danger">50%</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <span class="ps-2">Peter Gill</span>
                                        </td>
                                        <td> LS458GFT </td>
                                        <td> $14,500 </td>
                                        <td> SSS 3 </td>
                                        <td> 14 Jun 2021 </td>
                                        <td>
                                        <div class="badge badge-outline-success">100%</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <span class="ps-2">Sallie Reyes</span>
                                        </td>
                                        <td> LS458GFT </td>
                                        <td> $14,500 </td>
                                        <td> JSS 1 </td>
                                        <td> 14 Jun 2021 </td>
                                        <td>
                                        <div class="badge badge-outline-success">100%</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
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