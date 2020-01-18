<?php
	include "header.php";
    include_once 'ViewDataTable_Finance.php';
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

    <!-- Title - Finance -  -->
    <div class="title-style">
      <fieldset class="box-title"> 
        <legend>Finance</legend>
      </fieldset>
    </div>

<!-- WITHBORDER  -->
    <div class="withborder">
        <div style="display: block;margin: 0 auto;width: 90%;margin-left: 80px;margin-bottom: 20px;padding-top: 40px;">
    
        <table id="finanTable" class="display nowrap" style="">
            <thead>
                <tr>
                <th>id</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Paymment Date</th>
                <th>Value</th>
                <th>Was Paid?</th>
                <th>When Paid</th>
                <th>active</th>
                <th>Comment</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
            //Query to bring all info of the FINANCE CUSTOMER
            //JOIN CUSTOMER to take the current customer Name
            $sql_Finance = $conn->query("SELECT 
                                            finance_situation.*,
                                            CONCAT(customers.name, ' ', customers.lastName) AS Name_Customer
                                            FROM finance_situation
                                            JOIN customers
                                            ON finance_situation.id_Customer = customers.id_fix_customer
                                            WHERE finance_situation.active = 1 AND customers.active=1");
            //print each line of my db
            $dataWithFetchFinance = $sql_Finance->fetchAll(PDO::FETCH_ASSOC);

            //$order = the value inside the table
            //$key = index for each row (each row is an array)
            foreach ($dataWithFetchFinance as $key => $order) {
                //the function to change color come here do it in php
                echo "<tr>
                        <td>" . $order['id'] . "</td>
                        <td>" . $order['id_Customer'] . "</td>
                        <td>" . $order['Name_Customer'] . "</td>
                        <td>" . $order['Payment_Date'] . "</td>
                        <td>" . $order['Payment_Value'] . "</td>

                        <td>" . $order['wasPaid'] . "</td>
                        <td>" . $order['whenPaid'] . "</td>
                        <td>" . $order['active'] . "</td>
                        <td>" . $order['Comment'] . "</td>
                        <td>
                            <a href='DataTable_Finance.php?editBill=" . $order['id'] ."' class='btn btn-info'>edit</a>
                            <a href='DataTable_Finance.php?deleteBill=" . $order['id'] ."' class='btn btn-danger' OnClick=\"return confirm('Are you sure you want to DELETE this Bill?');\" >delete</a>
                        </td>
                    </tr>";
            }
            ?>
            </tbody>
        </table> <!-- FINAL VIEW TABLE -->
        </div>
        <!------- FORM TO ADD, CHANGE AND DELETE ALL THE INFORMATION INSIDE DB FINANCE ------>
        <form action="#" method="POST" style="display: inline-block;width: 60%;padding-top: 30px;padding-left: 75px;">

            <div class="form-group"> 
                <label>id Customer</label>      
                <input type="text" name="id_Customer" class="form-control" value = "<?php echo $id_CustomerBlank ?>" required>
            </div>

            <div class="form-group"> 
                <label>Name</label>      
                <input type="text" name="Name_Customer" class="form-control" readonly value="<?php echo $CustomerNameBlank ?>">
            </div>

            <div class="form-group">
                <label>Paymment Date</label> 
                <input type="date" name="Payment_Date" class="form-control" value="<?php echo $Payment_DateBlank?>" required>
            </div>

            <div class="form-group">
                <label>Value</label> 
                <input type="number" min="0" name="Payment_Value" class="form-control" value="<?php echo $Payment_ValueBlank ?>" required>
            </div>

            <div class="form-group">
                <label>Was Paid?</label> 
                <select name="wasPaid" class="form-control">
                    <option value=1 <?php if($wasPaidBlank == 1) echo "selected"?>> Yes </option>
                    <option value= 0 <?php if($wasPaidBlank == 0) echo "selected"?>> No </option>
                </select>
            </div>

            <div class="form-group">
                <label>When Paid</label> 
                <input type="date" name="whenPaid" class="form-control" value="<?php echo $whenPaidBlank?>">
            </div>

            <div class="form-group">
                <label>Comment</label> 
                <input name="Comment" type="text" class="form-control" value="<?php echo $CommentBlank ?>">
            </div>

            <div class="form-group">
                
                <!-- BUTTON IN THE END. NEW PRESCRIPTION? = SAVE | EDIT PRESCRIPTION? = UPDATE -->
                <?php if($updateBtn == true) : ?>
                    <button type="submit" class="btn btn-info" name="updateBill" onClick="return confirm('Are you sure you want to UPDATE this Bill?');">Update</button>
                <?php else : ?>
                    <button type="submit" class="btn btn-primary" name="saveBill" onClick="return confirm('Are you sure you want to SAVE this Bill?');">Save</button>
                <?php endif; ?>

            </div>
            
        </form>


    </div>
</div>

</body>
<?php
    include "footer.php";
?>
    <!-- https://datatables.net/download/index -->
    
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sc-2.0.1/sl-1.3.1/datatables.min.js"></script>

    <!-- DATAVIEW WORKING -->
    <script type="text/javascript">
    $('#finanTable').DataTable( {
        // "scrollX": true,
        select: true,
        colReorder: true,
        autoFill: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    } );

    </script>