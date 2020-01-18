<?php
	include "header.php";
    include "Connection.php";
?>

        <!-- https://cdnjs.com/libraries/jquery/1.9.0 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sc-2.0.1/sl-1.3.1/datatables.min.css"/>
    <style type="text/css">
        #myTable_wrapper{
            padding: 20px;
        }
             
        
    </style>

    
<body style="background-color: #ededed;">

    <!-- Title - ALL CUSTOMERS -  -->
    <div class="title-style">
      <fieldset class="box-title"> 
        <legend id="Header_nameDataview">Customers</legend>
      </fieldset>
    </div>

<!-- BUTTON FOR CHANGE INFORMATION INSIDE PAGE (ALL FUNCTIONS ARE on HEADER)  -->
    <div class="files" style="margin-left: 19px;">
        <button class="btn-file" id='opCustomer' onclick="changedbCustumer();" style="background:white;">Customers Info</button>
        <button class="btn-file" id='opAddress' onclick="changedbAddress();">Address</button>
        <button class="btn-file" id='opBank' onclick="changedbBank();">Bank</button>
        <button class="btn-file" id='opFamily' onclick="changedbFamily();">Family</button>
        <button class="btn-file" id='opSneeds' onclick="changedbSpecialNeeds();">Special Needs</button>  
        <button class="btn-file" id='opProblem' onclick="changedbproblems();">Problem Report</button>   
    </div>

<!-- WITHBORDER CONTAINS ALL ROWS WITH THE CARD/PROFILE -->
    <div class="withborder" style="padding-top: 30px;padding-bottom: 30px;">

        <!-- --------------CUSTOMER INFORMATION------------- -->
        <div id="cust" class='row justify-content-center' style='margin: 0 auto;width: 95%;display: block;'>
        <table id="cmyTable" class="display nowrap" >
            <thead>
                <tr>
                    <th>id</th>
                    <th>FixedID</th>
                    <th>Name</th>   
                    <th>Last Name</th>
                    <th>RG</th>
                    <th>CPF</th>
                    <th>Age</th>
                    <th>birth_date</th>
                    <th>Gender</th>
                    <th>AP</th>
                    <th>RelationShip</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>IMC</th>
                    <th>Power of Attorney</th>
                    <th>Benefice</th>
                    <th>Health Insurance</th>
                    <th>Dependence Lvl</th>
                    <th>Death_Date</th>
                    <th>Active</th>
                    <th>Create at</th>
                </tr>
            </thead>
            <tbody>

            <?php
            //data has the query now
            $dataTableCustommer = $conn->query("SELECT * FROM customers WHERE active = 1");
            $dataWithFetch = $dataTableCustommer->fetchAll(PDO::FETCH_ASSOC);

            //$order = the value inside the table
            //$key = index for each row (each row is an array)
            foreach ($dataWithFetch as $key => $order) {
                echo "<tr>
                        <td>" . $order['id'] . "</td>
                        <td>" . $order['id_fix_customer'] . "</td>
                        <td>" . $order['name'] . "</td>
                        <td>" . $order['lastName'] . "</td>
                        <td>" . $order['RG'] . "</td>
                        <td>" . $order['CPF'] . "</td>
                        <td>" . $order['age'] . "</td>
                        <td>" . $order['birth_date'] . "</td>
                        <td>" . $order['gender'] . "</td>
                        <td>" . $order['ap'] . "</td>
                        <td>" . $order['relationship_status'] . "</td>
                        <td>" . $order['weight'] . "</td>
                        <td>" . $order['height'] . "</td>
                        <td>" . $order['IMC'] . "</td>
                        <td>" . $order['power_of_Attorney'] . "</td>
                        <td>" . $order['benefice'] . "</td>
                        <td>" . $order['health_insurance_id'] . "</td>
                        <td>" . $order['level_Dependence'] . "</td>
                        <td>" . $order['death_Date'] . "</td>
                        <td>" . $order['active'] . "</td>
                        <td>" . $order['created_at'] . "</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>

        </div>

        <!-- ---------------------ADDRESS-------------------- -->
        <div id="address" class="row justify-content-center" style='margin: 0 auto;width: 95%;display: none;'>
        <table id="addmyTable" class="display nowrap" >
            <thead>
                <tr>
                    <th>id</th>
                    <th>id_Customer</th>
                    <th>Name Customer</th>
                    <th>country</th>   
                    <th>state</th>
                    <th>address</th>
                    <th>number Address</th>
                    <th>CEP</th>
                    <th>Reference</th>
                    <th>active</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>

            <?php
            //data has the query now
            $dataTableAddress = $conn->query("SELECT address.*,
                                            CONCAT(customers.name, ' ', customers.lastName) AS Name_Customer
                                            FROM address
                                            JOIN customers
                                            ON address.id_Customer = customers.id_fix_customer
                                            WHERE address.active = 1
                                            AND customers.active = 1");
            $dataWithFetchAddress = $dataTableAddress->fetchAll(PDO::FETCH_ASSOC);

            //$order = the value inside the table
            //$key = index for each row (each row is an array)
            foreach ($dataWithFetchAddress as $key => $order) {
                echo "<tr>
                        <td>" . $order['id'] . "</td>
                        <td>" . $order['id_Customer'] . "</td>
                        <td>" . $order['Name_Customer'] . "</td>
                        <td>" . $order['country'] . "</td>
                        <td>" . $order['state'] . "</td>
                        <td>" . $order['address'] . "</td>
                        <td>" . $order['numberAddress'] . "</td>
                        <td>" . $order['CEP'] . "</td>
                        <td>" . $order['reference'] . "</td>
                        <td>" . $order['active'] . "</td>
                        <td>" . $order['created_at'] . "</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
        </div>

        <!-- ------------------BANK ACCOUNT------------------ -->
        <div id="bank" class='row justify-content-center' style='margin: 0 auto;width: 95%;display: none;'>
            <table id="bankmyTable" class="display nowrap" >
            <thead>
                <tr>
                    <th>id</th>
                    <th>responsible ID</th>
                    <th>Owner Type</th>
                    <th>id Customer</th>   
                    <th>Name Customer</th>
                    <th>Bank Name</th>
                    <th>Agency</th>
                    <th>Account</th>
                    <th>Active</th>
                    <th>Created_at</th>
                </tr>
            </thead>
            <tbody>

            <?php
            //data has the query now
            $dataTableBlankAccount = $conn->query("SELECT bank_acc.*,
                                            CONCAT(customers.name, ' ', customers.lastName) AS Name_Customer
                                            FROM bank_acc
                                            JOIN customers
                                            ON bank_acc.id_Customer = customers.id_fix_customer
                                            WHERE bank_acc.active = 1");
            $dataWithFetchBlankAccount = $dataTableBlankAccount->fetchAll(PDO::FETCH_ASSOC);

            //$order = the value inside the table
            //$key = index for each row (each row is an array)
            foreach ($dataWithFetchBlankAccount as $key => $order) {
                echo "<tr>
                        <td>" . $order['id'] . "</td>
                        <td>" . $order['responsibleCount_id'] . "</td>
                        <td>" . $order['ownerType'] . "</td>
                        <td>" . $order['id_Customer'] . "</td>
                        <td>" . $order['Name_Customer'] . "</td>
                        <td>" . $order['bankName'] . "</td>
                        <td>" . $order['agency'] . "</td>
                        <td>" . $order['account'] . "</td>
                        <td>" . $order['active'] . "</td>
                        <td>" . $order['created_at'] . "</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
        </div>

        <!-- ---------------FAMILY------------ -->
        <div  id='family' class='row justify-content-center' style='margin: 0;width: 95%;display: none;margin-left:30px;margin-right:0px;margin-bottom: 20px;'>
        <table id="fammyTable" class="display nowrap" >
            <thead>
                <tr>
                    <th>id</th>
                    <th>id_Customer</th>
                    <th>name</th>
                    <th>relationship</th>   
                    <th>phone</th>
                    <th>address</th>
                    <th>emergency_call</th>
                    <th>active</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>

            <?php
            //data has the query now
            $dataTableFamily = $conn->query("SELECT *
                                            FROM customers_family
                                            WHERE active = 1");
            $dataWithFetchFamily = $dataTableFamily->fetchAll(PDO::FETCH_ASSOC);

            //$order = the value inside the table
            //$key = index for each row (each row is an array)
            foreach ($dataWithFetchFamily as $key => $order) {
                echo "<tr>
                        <td>" . $order['id'] . "</td>
                        <td>" . $order['id_Customer'] . "</td>
                        <td>" . $order['name'] . "</td>
                        <td>" . $order['relationship'] . "</td>
                        <td>" . $order['phone'] . "</td>
                        <td>" . $order['address'] . "</td>
                        <td>" . $order['emergency_call'] . "</td>
                        <td>" . $order['active'] . "</td>
                        <td>" . $order['created_at'] . "</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
        </div>

        <!-- -------------SPECIAL NEEDS------------- -->
        <div id="specialneed" class='row justify-content-center' style='margin: 0 auto;width: 95%;display: none;'>
        <table id="specmyTable" class="display nowrap" >
            <thead>
                <tr>
                    <th>id</th>
                    <th>id_Customer</th>
                    <th>Name Customer</th>
                    <th>disease</th>   
                    <th>allergy</th>
                    <th>use_Diaper</th>
                    <th>eat_Alone</th>
                    <th>heel_Chair</th>
                    <th>Tracheostomized</th>
                    <th>Decubitus_ulcer</th>
                    <th>gastric_tube</th>
                    <th>tube_Naso</th>
                    <th>Diabetic</th>
                    <th>use_insuline</th>
                    <th>active</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>

            <?php
            //data has the query now
            $dataTableSpecial_Needs = $conn->query("SELECT special_needs.*,
                                            CONCAT(customers.name, ' ', customers.lastName) AS Name_Customer
                                            FROM special_needs
                                            JOIN customers
                                            ON special_needs.id_Customer = customers.id_fix_customer
                                            WHERE special_needs.active = 1
                                            AND customers.active = 1");
            $dataWithFetchSpecial_Needs = $dataTableSpecial_Needs->fetchAll(PDO::FETCH_ASSOC);

            //$order = the value inside the table
            //$key = index for each row (each row is an array)
            foreach ($dataWithFetchSpecial_Needs as $key => $order) {
                echo "<tr>
                        <td>" . $order['id'] . "</td>
                        <td>" . $order['id_Customer'] . "</td>
                        <td>" . $order['Name_Customer'] . "</td>
                        <td>" . $order['disease'] . "</td>
                        <td>" . $order['allergy'] . "</td>
                        <td>" . $order['use_Diaper'] . "</td>
                        <td>" . $order['eat_Alone'] . "</td>
                        <td>" . $order['heel_Chair'] . "</td>
                        <td>" . $order['Tracheostomized'] . "</td>
                        <td>" . $order['Decubitus_ulcer'] . "</td>
                        <td>" . $order['gastric_tube'] . "</td>
                        <td>" . $order['tube_Naso'] . "</td>
                        <td>" . $order['Diabetic'] . "</td>
                        <td>" . $order['use_insuline'] . "</td>
                        <td>" . $order['active'] . "</td>
                        <td>" . $order['created_at'] . "</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
        </div>

        <!-- ---------------PROBLEMS------------ -->
        <div  id='problem' class='row justify-content-center' style='margin: 0 auto;width: 95%;display: none;'>
        <table id="ProbTable" class="display nowrap" style='margin: 0px ; width: 100%;'>
            <thead>
                <tr>
                    <th>id Problem</th>
                    <th>id Customer</th>
                    <th>Name</th>
                    <th>Report</th>
                    <th>Risk</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>

            <?php
            //data has the query now
            $dataTableproblem = $conn->query("SELECT 
                                    problem_report.*,
                                    CONCAT(customers.name, ' ', customers.lastName) AS Name_Customer
                                    FROM problem_report
                                    JOIN customers
                                    ON problem_report.id_Customer = customers.id_fix_customer
                                    WHERE problem_report.active = 1
                                    AND customers.active = 1");
            $dataWithFetchProblem = $dataTableproblem->fetchAll(PDO::FETCH_ASSOC);

            //$order = the value inside the table
            //$key = index for each row (each row is an array)
            foreach ($dataWithFetchProblem as $key => $order) {
                echo "<tr>
                        <td>" . $order['id'] . "</td>
                        <td>" . $order['id_Customer'] . "</td>
                        <td>" . $order['Name_Customer'] . "</td>
                        <td>" . $order['Report'] . "</td>
                        <td>" . $order['Risk'] . "</td>
                        <td>" . $order['Data'] . "</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>
</body>

    <!-- https://datatables.net/download/index -->
    
     <?php include "footer.php"; ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sc-2.0.1/sl-1.3.1/datatables.min.js"></script>
    <script type="text/javascript">
    $('#cmyTable').DataTable( {
    "scrollX": true,
    select: true,
    colReorder: true,
    autoFill: true,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );

 $('#addmyTable').DataTable( {
    select: true,
    colReorder: true,
    autoFill: true,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );

 $('#bankmyTable').DataTable( {
    select: true,
    colReorder: true,
    autoFill: true,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );

 $('#fammyTable').DataTable( {
    select: true,
    colReorder: true,
    autoFill: true,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );

 $('#specmyTable').DataTable( {
    "scrollX": true,
    select: true,
    colReorder: true,
    autoFill: true,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );


 $('#ProbTable').DataTable( {
    "scrollX": true,
    select: true,
    colReorder: true,
    autoFill: true,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );
</script>
