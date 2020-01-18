<?php require_once('Header.php');?>

<?php
    include "Connection.php"; //connection with db
    include "monthYear.php"; //function for BOX2

        //query table - quantity of costummers - BOX1
    $sql_qtdCustomer = $conn->query("SELECT count(*) AS CountCustomers 
                                        FROM customers 
                                        WHERE active = 1");
    $sql_qtdCustomer->execute(); //play!

        //query table - LASTMONTH Payment - BOX2
    $sql_valueIncome = $conn->query("SELECT 
                                            SUM(Payment_Value) AS payValue,
                                            CASE 
                                             WHEN Payment_Date <= CURRENT_DATE() AND wasPaid = 1 THEN 'Paid'
                                             WHEN Payment_Date > CURRENT_DATE() AND wasPaid = 1 THEN 'Paid'
                                             WHEN Payment_Date >= CURRENT_DATE() AND wasPaid = 0 THEN 'Future'
                                             WHEN Payment_Date < CURRENT_DATE() AND wasPaid = 0 THEN 'Overdue Payment'
                                            END AS statusPayment
                                        FROM finance_situation
                                        WHERE
                                            MONTH(Payment_Date) = MONTH(CURRENT_DATE())
                                            AND finance_situation.active=1
                                        GROUP BY statusPayment");
    $sql_valueIncome->execute(); //play!       
?>

            <!-- Start XP Breadcrumbbar -->                    
            <div class="xp-breadcrumbbar">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h4 class="xp-page-title">Dashboard</h4>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="xp-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>          
            </div>
            <!-- End XP Breadcrumbbar -->
            
            <!-- Start XP Contentbar -->    
            <div class="xp-contentbar">

                <!-- Start Widget -->

                <!-- Start XP Row -->
                <div class="row"> 
                    <!-- Start XP Col -->   
                    <div class="col-md-12 col-lg-12 col-xl-7">
                        
                        <!-- Start XP Row -->
                        <div class="row">                             
                            <!-- Start XP Col -->
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="card m-b-30">
                                    <div class="card-header bg-white">
                                        <h5 class="card-title text-black mb-0">Weekly Revenue</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="xp-chart-label">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <p class="text-black">Current Week</p>
                                                    <h4 class="text-primary-gradient mb-3"><i class="icon-wallet mr-2"></i>78,254</h4>
                                                </li>
                                                <li class="list-inline-item">
                                                    <p class="text-black">Previous Week</p>
                                                    <h4 class="text-success-gradient mb-3"><i class="icon-wallet mr-2"></i>58,605</h4>
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="xp-chartist-series-overrides" class="ct-chart ct-golden-section xp-chartist-simple-line"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End XP Col --> 
                         </div>
                        <!-- End XP Row -->

                    </div>          
                    <!-- End XP Col -->

                    <!-- Start XP Col -->
                    <div class="col-md-12 col-lg-12 col-xl-5">
                        <div class="row">
                            <!-- Start XP Col -->
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="card bg-primary-gradient m-b-30">
                                    <div class="card-body">                                            
                                        <div class="xp-widget-box text-white">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-5 align-self-center">
                                                    <p class="xp-icon-timer mb-5"><i class="icon-hourglass"></i></p>
                                                    <?php //number of costummers:
                                                    $Values = $sql_qtdCustomer->fetchAll();
                                                    foreach ($Values as $value) {
                                                        echo "<h4 class='mb-0 font-26'>" . $value['CountCustomers'] . "</h4>";
                                                    }
                                                    ?> 
                                                    <p class="mb-2">Number of Customers</p>
                                                    <p class="mb-0"><span class="f-w-7">+18.68%</span> <span class="font-12">vs in last 7 days</span></p>   
                                                </div>
                                                <div class="col-md-6 col-lg-7">
                                                    <div id="xp-chartist-widget-bar" class="ct-chart ct-golden-section xp-chartist-label-placement xp-chartist-widget-color"></div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End XP Col -->

                            <!-- Start XP Col -->                       
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="card bg-success-gradient m-b-30">
                                    <div class="card-body">
                                        <div class="xp-widget-box text-white text-center pt-3">
                                            <p class="xp-icon-timer mb-4"><i class="icon-layers"></i></p>
                                            <h4 class="mb-2 font-20">Income BRL</h4>
                                            <?php
                                                //Bring the current month
                                                echo "<p class='mb-3'>" . monthYear((new \DateTime())->format('m')). "</p>";

                                                //Values FROM DATABASE that contains: Status of paymment
                                                $incomeNow = $sql_valueIncome->fetchAll();
                                                foreach ($incomeNow as $value) {
                                                   echo "<p class='mb-3'>" . $value['statusPayment'] . " R$ <span style='font-size:25px;font-weight:bold;'>" . $value['payValue'] . "</span></p>";
                                                }

                                            ?>

                                            <p class="mb-3">Welcome aboard, Thank you for joining our Team.</p>
                                            <button class="btn btn-white btn-rounded text-success">Ok, got it!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End XP Col -->

                            <!-- Start XP Col -->
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="card bg-danger-gradient m-b-30">
                                    <div class="card-body">
                                        <div class="xp-widget-box xp-widget-newsletter text-white text-center pt-3">
                                            <p class="xp-icon-timer mb-4"><i class="icon-paper-plane"></i></p>
                                            <h4 class="mb-2 font-20">Subscribe to Newsletter</h4>
                                            <p class="mb-3">Please, provide your email address to get latest updates.</p>
                                            <form>
                                                <div class="input-group">
                                                  <input type="search" class="form-control" placeholder="Enter Email" aria-label="Search" aria-describedby="button-addon-news">
                                                  <div class="input-group-append">
                                                    <button class="btn" type="submit" id="button-addon-news">GO</button>
                                                  </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End XP Col -->
                        </div>
                    </div>
                    <!-- End XP Col -->

                </div>
                <!-- End XP Row -->

                <!-- End XP Row -->
                <div class="row">                              

                    <!-- Start XP Col -->
                    <div class="col-md-12 col-lg-12 col-xl-8">
                        <div class="card m-b-30">
                            <div class="card-header bg-white">
                                <h5 class="card-title text-black mb-0">Revenue</h5>
                            </div>
                            <div class="card-body">
                                <div class="xp-chart-label">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <p class="text-black">Today's</p>
                                            <h4 class="text-primary-gradient mb-3"><i class="icon-wallet mr-2"></i>8,390</h4>
                                        </li>
                                        <li class="list-inline-item">
                                            <p class="text-black">Last Month</p>
                                            <h4 class="text-success-gradient mb-3"><i class="icon-wallet mr-2"></i>24,420</h4>
                                        </li>
                                        <li class="list-inline-item">
                                            <p class="text-black">Last Year</p>
                                            <h4 class="text-danger-gradient mb-3"><i class="icon-wallet mr-2"></i>3,25,780</h4>
                                        </li>
                                    </ul>
                                </div>
                                <div id="xp-chartist-stacked-bar" class="ct-chart ct-golden-section xp-chartist-stacked-bar"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End XP Col -->
                    
                    <!-- Start XP Col -->
                    <div class="col-md-12 col-lg-12 col-xl-4">
                        <div class="card m-b-30">
                            <div class="card-header bg-white">
                                <h5 class="card-title text-black mb-0">Project Resources</h5>
                            </div>
                            <div class="card-body">                                    
                                <div id="xp-chartist-donut-fill-rather-chart" class="ct-chart ct-golden-section xp-chartist-donut-fill-rather-chart"></div>
                                <div class="xp-chart-label mt-3">                                        
                                    <ul class="list-group">
                                      <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <p class="mb-0"><i class="mdi mdi-circle-outline text-primary"></i>Direct</p>
                                        <span class="badge badge-primary badge-pill">45%</span>
                                      </li>
                                      <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <p class="mb-0"><i class="mdi mdi-circle-outline text-success"></i>Marketing</p>
                                        <span class="badge badge-success badge-pill">35%</span>
                                      </li>
                                      <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <p class="mb-0"><i class="mdi mdi-circle-outline text-danger"></i>Others</p>
                                        <span class="badge badge-danger badge-pill">20%</span>
                                      </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End XP Col -->

                    <!-- Start XP Col -->                       
                    <div class="col-md-12 col-lg-12 col-xl-4">
                        <div class="card m-b-30">
                            <div class="card-header bg-white">
                                <h5 class="card-title text-black mb-0">Actions History</h5>
                            </div>
                            <div class="card-body">
                                <div class="xp-actions-history">
                                    <div class="xp-actions-history-list">
                                        <div class="xp-actions-history-item">                                            
                                            <h6 class="mb-1 text-black">Start Web Designing</h6>
                                            <p class="text-muted font-12">5 mins ago</p>
                                            <p class="m-b-30">We are start working on USA Project</p>
                                        </div>
                                    </div>
                                    <div class="xp-actions-history-list">
                                        <div class="xp-actions-history-item">
                                            <h6 class="mb-1 text-black">Completed Theme Development</h6>
                                            <p class="text-muted font-12">15 mins ago</p>
                                            <p class="m-b-30">We are completed a theme development into 5 days</p>
                                        </div>
                                    </div>
                                    <div class="xp-actions-history-list">
                                        <div class="xp-actions-history-item">
                                            <h6 class="mb-1 text-black">Project Submitted</h6>
                                            <p class="text-muted font-12">30 mins ago</p>
                                            <p class="m-b-30">We are done process of submitted project</p>
                                        </div>
                                    </div>
                                    <div class="xp-actions-history-list">
                                        <div class="xp-actions-history-item">
                                            <h6 class="mb-1 text-black">Received a Payment</h6>
                                            <p class="text-muted font-12">45 mins ago</p>
                                            <p class="m-b-30">We got monthy payment from clients</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End XP Col -->

                    <!-- Start XP Col -->                       
                    <div class="col-lg-6 col-xl-4">
                        <div class="card m-b-30">
                            <div class="card-header bg-white">
                                <h5 class="card-title text-black mb-0">To do Lists</h5>
                            </div>
                            <div class="card-body">
                                <div class="xp-to-do-list">
                                    <ul id="list-group" class="list-group list-group-flush"></ul>
                                    <form class="add-items">
                                        <div class="input-group mt-3">
                                            <input type="text" class="form-control" id="todo-list-item" placeholder="What do you need to do today?" aria-label="What do you need to do today?" aria-describedby="button-addon-to-do-list">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary add" id="button-addon-to-do-list" type="submit">Add to List</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End XP Col -->
                    <!-- Start XP Col -->
                    <div class="col-md-12 col-lg-4 col-xl-4">
                        <div class="card m-b-30">
                            <div class="card-header bg-white">
                                <h5 class="card-title text-black mb-0">Calender</h5>
                            </div>
                            <div class="card-body">
                                <div data-language="en" class="datepicker-here"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End XP Col -->
                </div>   
                <!-- End XP Row -->
            </div>
            <!-- End XP Contentbar -->
        </div>
        <!-- End XP Rightbar -->        

    </div>
    <!-- End XP Container -->    

    <!-- Start JS -->       
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <?php
    include "footer.php";
    ?> 
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/horizontal-menu.js"></script>

    <!-- Chartist Chart JS -->
    <script src="assets/plugins/chartist-js/chartist.min.js"></script>
    <script src="assets/plugins/chartist-js/chartist-plugin-tooltip.min.js"></script>

    <!-- To Do List JS -->
    <script src="assets/js/init/to-do-list-init.js"></script>

    <!-- Datepicker JS -->
    <script src="assets/plugins/datepicker/datepicker.min.js"></script>
    <script src="assets/plugins/datepicker/i18n/datepicker.en.js"></script>

    <!-- Dashboard JS -->
    <script src="assets/js/init/dashborad.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <!-- End JS -->

</body>
</html>