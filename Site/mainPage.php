<body>
	<!-- include the header -->
	<?php
		include "header.php";
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

    <!-- RESUMO TOP 4 BOX: -->
    <div class="flex-container">

        <!-- BOX1 -->
      <a href="/Quinta_das_Flores/Site/customers.php"><div id="first" class="squereResume mb-md-10" > 
         <p class="insideSquereResume" style="padding-top: 7px;font-size: 18px;">Number of Customers</p>
         
         <?php //number of costummers:
            $Values = $sql_qtdCustomer->fetchAll();
               foreach ($Values as $value) {
                   echo "<p class='infoSquereResume' id='count'>" . $value['CountCustomers'] . "</p>";
                }
  ?> 


      </div></a>

        <!-- BOX 2 -->
      <a href="/Quinta_das_Flores/Site/DataTable_Finance.php"><div id="second" class="squereResume mb-md-10" style="line-height: 24px;">
          <p class="insideSquereResume" style="padding-top: 7px;font-size: 18px;">Income BRL</p>
           <?php
                //Bring the current month
                echo "<p class='infoSquereResume' style='text-align:left;padding-left:35px;'>" . monthYear((new \DateTime())->format('m')). "</p>";

                //Values FROM DATABASE that contains: Status of paymment
                $incomeNow = $sql_valueIncome->fetchAll();
                foreach ($incomeNow as $value) {
                   echo "<p class='infoSquereResume' style='text-align:left;padding-left:35px;'>" . $value['statusPayment'] . " R$ <span style='font-size:25px;font-weight:bold;'>" . $value['payValue'] . "</span></p>";
                }

            ?>
            
      </div></a>

        <!-- BOX 3 -->
      <a href=""><div id="third" class="squereResume mb-md-10">
         <p class="insideSquereResume">algo 3</p>  
      </div></a>

        <!-- BOX 4 -->
      <a href=""><div id="fourth" class="squereResume mb-md-10">
           <p class="insideSquereResume">algo 4</p> 
      </div></a>

    </div><!-- END RESUMO TOP 4 BOX: -->

    <section class="middle">

    <div class="box" style="display: block; margin: 0 auto;text-align: center;"> 
      <div id="chartContainer" style="height: 370px; width: 35%; display: inline-block;margin-right: 5%;"></div>
      <div id="chartContainerNew" style="height: 370px; width: 35%; display: inline-block;margin-left: 5%;"></div>

    </div>
  
</section>
    
</body>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


<?php
  include "footer.php";
?>