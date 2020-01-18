<?php
    session_start();
    if ($_POST) {
    header('Location: /Quinta_das_Flores/Site/customersInfo.php');
    }
	include "header.php";
    include "Connection.php";
    
    //Query table - All custumers to show in "customers Page"
   $sql_Custumers = $conn->query("SELECT * 
                                    FROM customers 
                                    WHERE active = 1
                                    ORDER BY name");
    $sql_Custumers->execute(); //play!


?>

<body style="background-color: #ededed;">

    <!-- Title - ALL CUSTOMERS -  -->
    <div class="title-style">
      <fieldset class="box-title"> 
        <legend>Customers</legend>
      </fieldset>
    </div>


<!-- WITHBORDER CONTAINS ALL ROWS WITH THE CARD/PROFILE -->
    <div class="withborder  " style="padding-bottom: 30px;padding-top: 30px;">
        <div  class="d-flex flex-row-reverse">
            <a href="/Quinta_das_Flores/Site/DataTable_customers.php"><button class="btn btn-primary p-2" id='allcust' style="margin: 4px 4px 0px 4px;">All information</button></a>
        </div>

    <!-- profile is the div that contains all elements in one row -->
        <div class="profile">


            <?php //All customers to loop throught the page

                    $Values = $sql_Custumers->fetchAll();
                       foreach ($Values as $value) {    

                        //<!-- container is the card/profile unit -->
                        echo "<div class='container'>

                                <img src='images/customers_photo/" . $value['lastName'] . '-'. $value['name'] . ".jpg' alt='Avatar' class='image'>
                                    
                                <form method='POST' class='text'>
                                    <p><input class='tag' type='text' name='Name' value='Name: ".$value['name'] . ' ' . $value['lastName']."' readonly></p>
                                    <p><input class='tag' type='text' name='Ap' value='Apt: ".$value['ap']."' readonly></p>
                                    <p><input class='tag' type='text' name='LevelDependence' value='Level Dependence: ".$value['level_Dependence']."' readonly></p>
                                    <p><input class='tag' type='hidden' name='idfixed' value='". $value['id_fix_customer'] ."'readonly></p>
                                    <p><input class='moreinfo' type='submit' name='Submit'></p>
                                </form>
                            </div>" ; 
                    } //end foreach

                    //----------CARD FOR ADD CUSTOMER--------    
                    echo "<div class='container'>

                        <img src='images/add2.png' alt='Avatar' class='image'>
    
                        <form method='POST' class='text'>
                            <p><input class='tag' type='hidden' name='idfixed' value=0 readonly></p>
                            <p><input class='moreinfo' type='submit' name='Submit'></p>
                        </form>
                    </div>";         
               
            
                // Gonna save Id_customer to bring all information from DB and go to CustomerInfo.php
                if (isset($_POST['idfixed']) != 0){
                    $_SESSION['idCustomer'] = $_POST['idfixed'];                  
                }
                else{
                    //Next id fixed. descrece the db and take the last id_fixed + 1 (set result to new customer)
                    $nextIdCustomers = "SELECT id_fix_customer 
                                        FROM customers 
                                        ORDER BY id_fix_customer DESC
                                        LIMIT 1";
                    $data = $conn->prepare($nextIdCustomers);
                    $data->execute();
                    $dataFetch = $data->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['idCustomer'] = $dataFetch['id_fix_customer'] + 1;
                } 
            
            ?>

        </div>
        </div>
    </div>
</div>

</body>
<?php
    include "footer.php";
?>