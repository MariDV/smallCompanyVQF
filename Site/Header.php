<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Neon is a Responsive Bootstrap 4 Admin Dashboard Template">
    <meta name="keywords" content="admin, admin template, admin panel, dashboard template, ui kits, web app, crm, cms, responsive, bootstrap 4, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<title>Document</title>

	<!-- Link used -->
	<!-- Bootstrap -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500&display=swap" rel="stylesheet"> -->
	<link rel="stylesheet" href="css/mainPage/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/mainPage/mainPage.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/mainPage/styles.css"> -->
    <link rel="stylesheet" type="text/css" href="css/mainPage/style-responsive.css">
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Start CSS -->
    <!-- Chartist Chart CSS -->
    <link rel="stylesheet" href="assets/plugins/chartist-js/chartist.min.css">

    <!-- Datepicker CSS -->
    <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- End CSS -->

    



    <!-- /*CHANGE ABAS OF THE DATAVIEW FOR USERS -----> DATAVIEW  */ -->

    <script>
    window.onload = function () {

    var chart1 = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Quantity of Customers"
        },
        axisY:{
            includeZero: false
        },
        data: [{        
            type: "line",       
            dataPoints: [

                { y: 20 },
                { y: 24},
                { y: 27, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
                { y: 25 },
                { y: 25 },
                { y: 10, indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
                { y: 15 },
                { y: 20 },
                { y: 24 },
                { y: 25 },
                { y: 25 },
                { y: 23 }
            ]
        }]
    });

    var chart2 = new CanvasJS.Chart("chartContainerNew", {
    animationEnabled: true,
    theme: "light2",
    title:{
        text: "Payment"
    },
    axisX:{
        valueFormatString: "DD MMM",
        crosshair: {
            enabled: true,
            snapToDataPoint: true
        }
    },
    axisY: {
        title: "Amount",
        crosshair: {
            enabled: true
        }
    },
    toolTip:{
        shared:true
    },  
    legend:{
        cursor:"pointer",
        verticalAlign: "bottom",
        horizontalAlign: "left",
        dockInsidePlotArea: true,
        itemclick: toogleDataSeries
    },
    data: [{
        type: "line",
        showInLegend: true,
        name: "Total Visit",
        markerType: "square",
        xValueFormatString: "DD MMM, YYYY",
        color: "#F08080",
        dataPoints: [
            { x: new Date(2019, 0, 1), y: 20000 },
            { x: new Date(2019, 1, 1), y: 21000 },
            { x: new Date(2019, 2, 1), y: 18540 },
            { x: new Date(2019, 3, 1), y: 15000},
            { x: new Date(2019, 4, 1), y: 27000 },
            { x: new Date(2019, 5, 1), y: 23070 },
            { x: new Date(2019, 6, 1), y: 19980 },
            { x: new Date(2019, 7, 1), y: 22000},
            { x: new Date(2019, 8, 1), y: 19870 },
            { x: new Date(2019, 9, 1), y: 14080 },
            { x: new Date(2019, 10, 1), y: 24000 },
            { x: new Date(2019, 11, 1), y: 25450 },
            { x: new Date(2019, 12, 1), y: 19500 },
            
        ]
    },
    {
        type: "line",
        showInLegend: true,
        name: "Converted Visit",
        lineDashType: "dash",
        dataPoints: [
            { x: new Date(2019, 0, 1), y: 19650 },
            { x: new Date(2019, 1, 1), y: 20050 },
            { x: new Date(2019, 2, 1), y: 18400 },
            { x: new Date(2019, 3, 1), y: 15000 },
            { x: new Date(2019, 4, 1), y: 27000 },
            { x: new Date(2019, 5, 1), y: 23600 },
            { x: new Date(2019, 6, 1), y: 19900 },
            { x: new Date(2019, 7, 1), y: 21700 },
            { x: new Date(2019, 8, 1), y: 19870 },
            { x: new Date(2019, 9, 1), y: 14080 },
            { x: new Date(2019, 10, 1), y: 23990 },
            { x: new Date(2019, 11, 1), y: 25450 },
            { x: new Date(2019, 12, 1), y: 19500 },
            
        ]
    }]
});
    chart1.render();
    chart2.render();

function toogleDataSeries(e){
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    } else{
        e.dataSeries.visible = true;
    }
    chart2.render();
}

}
</script>

<!-- CHANGE ABAS FOR CUSOMERINFO -->
<script src="./js/Abas.js" type="text/javascript"></script>

</head>
<body class="xp-horizontal">

<!-- Start XP Container -->
    <div id="xp-container">

        <!-- Start XP Rightbar -->
        <div class="xp-rightbar">

            <!-- XP Search Modal -->
            <div class="modal fade xpSearchModal" id="xpSearchModal" tabindex="-1" role="dialog" aria-labelledby="xpSearchModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="xp-searchbar">
                                <form>
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit" id="button-addon2">GO</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start XP Headerbar -->
            <div class="xp-headerbar">

                <!-- Start XP Topbar -->
                <div class="xp-topbar">

                    <!-- Start XP Row -->
                    <div class="row"> 

                        <!-- Start XP Col -->
                        <div class="col-2 col-md-2 col-lg-2 align-self-center">
                            <!-- Start XP Logobar -->
                            <div class="xp-logobar">
                                <a href="index.php" class="xp-small-logo"><img src="images/emDev-app.png" class="img-fluid" alt="logo"></a>
                                <a href="index.php" class="xp-main-logo"><img src="images/emDev-app.png" class="img-fluid" alt="logo" ></a>
                            </div>                        
                            <!-- End XP Logobar -->
                        </div> 
                        <!-- End XP Col -->

                        <!-- Start XP Col -->
                        <div class="col-10 col-md-10 col-lg-10">
                            <div class="xp-profilebar text-right">
                                <ul class="list-inline mb-0">
                                    <!-- <li class="list-inline-item">                                        
                                        <div class="xp-search">
                                            <a href="#" class="text-white" data-toggle="modal" data-target="#xpSearchModal"><i class="icon-magnifier"></i></a>
                                        </div>
                                    </li> -->
                                    
                                    <li class="list-inline-item">
                                        <div class="dropdown xp-notification">
                                            <a class="dropdown-toggle  text-white" href="#" role="button" id="xp-notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-bell font-18 v-a-m"></i>
                                                <span class="badge badge-pill bg-danger-gradient xp-badge-up">3</span>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="xp-notification">
                                                <ul class="list-unstyled">
                                                  <li class="media">
                                                    <div class="media-body">
                                                      <h5 class="mt-0 mb-0 py-3 text-white text-center font-16">3 New Notifications</h5>
                                                    </div>
                                                  </li>  
                                                  <li class="media xp-noti">                                                
                                                    <div class="mr-3 xp-noti-icon primary-rgba"><i class="icon-user-follow text-primary"></i></div>
                                                    <div class="media-body">
                                                        <a href="#">  
                                                            <h5 class="mt-0 mb-1 font-14">New user registered</h5>
                                                            <p class="mb-0 font-12 f-w-4">2 min ago</p>
                                                        </a>
                                                    </div>
                                                  </li>
                                                  <li class="media xp-noti">
                                                    <div class="mr-3 xp-noti-icon success-rgba"><i class="icon-basket-loaded text-success"></i></div>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5 class="mt-0 mb-1 font-14">New order placed</h5>
                                                            <p class="mb-0 font-12 f-w-4">8:45 PM</p>
                                                        </a>
                                                    </div>
                                                  </li>
                                                  <li class="media xp-noti">
                                                    <div class="mr-3 xp-noti-icon danger-rgba"><i class="icon-like text-danger"></i></div>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5 class="mt-0 mb-1 font-14">John like your photo.</h5>
                                                            <p class="mb-0 font-12 f-w-4">Yesterday</p>
                                                        </a>
                                                    </div>
                                                  </li>
                                                  <li class="media">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-0 py-3 text-black text-center font-14">
                                                            <a href="#" class="text-primary">View all</a>
                                                        </h5>
                                                    </div>
                                                  </li>
                                                </ul>                                            
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <div class="dropdown xp-userprofile">
                                            <a class="dropdown-toggle " href="#" role="button" id="xp-userprofile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/topbar/user.jpg" alt="user-profile" class="rounded-circle img-fluid"><span class="xp-user-live"></span></a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="xp-userprofile">
                                                <a class="dropdown-item py-3 text-white text-center font-16" href="#">Welcome, John Doe</a>
                                                <a class="dropdown-item" href="#"><i class="icon-user text-primary mr-2"></i> Profile</a>
                                                <a class="dropdown-item" href="#"><i class="icon-wallet text-success mr-2"></i> Billing</a>
                                                <a class="dropdown-item" href="#"><i class="icon-settings text-warning mr-2"></i> Setting</a>
                                                <a class="dropdown-item" href="#"><i class="icon-lock text-info mr-2"></i> Lock Screen</a>
                                                <a class="dropdown-item" href="#"><i class="icon-power text-danger mr-2"></i> Logout</a>
                                            </div>
                                        </div>                                   
                                    </li>
                                    <li class="list-inline-item xp-horizontal-menu-toggle">
                                        <button type="button" class="navbar-toggle bg-transparent" data-toggle="collapse" data-target="#navbar-menu">
                                            <i class="icon-menu font-20 text-white"></i>
                                        </button>                                   
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End XP Col -->

                    </div> 
                    <!-- End XP Row -->

                </div>
                <!-- End XP Topbar -->

                <!-- Start XP Menubar -->                    
                <div class="xp-menubar text-left">

                    <!-- Start XP Nav -->
                    <nav class="xp-horizontal-nav xp-mobile-navbar xp-fixed-navbar">

                        <div class="collapse navbar-collapse" id="navbar-menu">
                          <ul class="xp-horizontal-menu">
                            <li class="scroll"><a href="index.php"><i class="icon-home"></i><span>Home</span></a></li>
                            <li class="scroll"><a href="/Quinta_das_Flores/Site/Customers.php"><i class="icon-people"></i><span>Customers</span></a></li>
                            <li class="scroll"><a href="/Quinta_das_Flores/Site/DataTable_customers.php"><i class="icon-book-open"></i><span>Data View</span></a></li>
                            <li class="scroll"><a href="/Quinta_das_Flores/Site/DataTable_Prescription.php"><i class="icon-notebook"></i><span>Prescription</span></a></li>
                            <li class="scroll"><a href="events.php"><i class="icon-event"></i><span>Events</span></a></li>
                            <li class="scroll"><a href="#"><i class="icon-doc"></i><span>Forms</span></a></li>
                          </ul>
                        </div>
                    </nav>
                    <!-- End XP Nav -->
                </div>
                <!-- End XP Menubar -->
            </div>
            <!-- End XP Headerbar -->
