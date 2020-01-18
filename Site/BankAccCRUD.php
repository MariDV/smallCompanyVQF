        <!-- https://cdnjs.com/libraries/jquery/1.9.0 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sc-2.0.1/sl-1.3.1/datatables.min.css"/>
    <style type="text/css">
        #myTable_wrapper{
            padding: 20px;
        }             
    </style>

<?php require_once 'ViewBankAccCRUD.php' ?>

<!-- DATAVIEW OF BANK ACCOUNT CUSTOMER -->
<?php 
    //Query to bring all info of the BankAcc CUSTOMER
	//JOIN CUSTOMER to take the current customer Name
    $sql_BankAll = $conn->query("SELECT 
    								bank_acc.*,
    								CONCAT(customers.name, ' ', customers.lastName) AS Name_Customer
   									FROM bank_acc
   									JOIN customers
   									ON bank_acc.id_Customer = customers.id_fix_customer
   									WHERE customers.id_fix_customer = " . $_SESSION['idCustomer'] . "
   									AND bank_acc.active = 1
	                                AND customers.active = 1");
    //print each line of my db
    $dataWithFetchAccount = $sql_BankAll->fetchAll(PDO::FETCH_ASSOC);
?>

	<table id="aTable" class="display nowrap">
		<thead>
			<tr>
				<th>id</th>
				<th>Responsable Account ID</th>
				<th>Owner Typer</th>
				<th>id Customer</th>
				<th>Name Customer</th>
				<th>Bank Name</th>
				<th>Bank Agency</th>
				<th>Bank Account</th>
				<th>created_at</th>
				<th></th>
			</tr>
		</thead>
	
	<!-- LOOP ALL INFORMATION TO A TABLE -->
	<?php 
		foreach ($dataWithFetchAccount as $key => $order) {
	    echo "<tr>
	            <td>" . $order['id'] . "</td>
	            <td>" . $order['responsibleCount_id'] . "</td>
	            <td>" . $order['ownerType'] . "</td>
	            <td>" . $order['id_Customer'] . "</td>
	            <td>" . $order['Name_Customer'] . "</td>
	            <td>" . $order['bankName'] . "</td>
	            <td>" . $order['agency'] . "</td>
	            <td>" . $order['account'] . "</td>
	            <td>" . $order['created_at'] . "</td>
	            <td>
					<a href='customersInfo.php?editBankACC=" . $order['id'] ."' class='btn btn-info'>edit</a>
					<a href='ViewBankAccCRUD.php?deleteBankACC=" . $order['id'] ."' class='btn btn-danger' OnClick=\"return confirm('Are you sure you want to DELETE this Bank Account?');\" >delete</a>
	            </td>
	        </tr>";

	}


	 ?>
	</table> <!-- END DATAVIEW -->

<!------- FORM TO ADD, CHANGE AND DELETE ALL THE INFORMATION INSIDE DB FAMILY ------>
    <form action="#" method="POST" style="display: inline-block;width: 60%;padding-top: 30px;padding-left: 15px;">

		<div class="form-group"> 
			<label>Account Owner ID</label>      
			<input type="text" name="responsibleCount_id" class="form-control" type="number" value = "<?php echo $blankSpaceresponsibleCount_id ?>">
		</div>

		<div class="form-group"> 
			<label>Account Owner Type</label>      
			<select name="ownerType" class="form-control">
                <option value='Customer' <?php if($blankSpaceownerType == "Customer") echo "selected"?>> Customer </option>
                <option value='Family' <?php if($blankSpaceownerType == "Family") echo "selected"?>> Family </option>
            </select>
		</div>
		<div class="form-group"> 
			<label>id Customer</label>      
			<input type="text" name="id_Customer" class="form-control" readonly value =  <?php if($id_fix_customer != 0) { echo "'$id_fix_customer'"; } else { echo "'$nextIdCustomer'"; } ?>>
		</div>

		<div class="form-group"> 
			<label>Bank Name</label>      
			<input type="text" name="bankName" class="form-control" value="<?php echo $blankSpacebankName ?>">
		</div>

		<div class="form-group">
			<label>agency</label> 
			<input type="number" min="0" name="agency" class="form-control" value="<?php echo $blankSpaceagency ?>">
		</div>

		<div class="form-group">
			<label>account</label> 
			<input type="text" name="account" class="form-control" value="<?php echo $blankSpaceaccount ?>">
		</div>

		<div class="form-group">
			
			<!-- BUTTON IN THE END. NEW Bank ACC? = SAVE | EDIT ACC? = UPDATE -->
			<?php if($updateBtn == true) : ?>
				<button type="submit" class="btn btn-info" name="updateBankACC" onClick="return confirm('Are you sure you want to UPDATE this Bank Account?');">Update</button>
			<?php else : ?>
				<button type="submit" class="btn btn-primary" name="saveBankACC" onClick="return confirm('Are you sure you want to SAVE this Bank Account?');">Save</button>
			<?php endif; ?>

		</div>
        
    </form>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sc-2.0.1/sl-1.3.1/datatables.min.js"></script>
    <script type="text/javascript">
 $('#aTable').DataTable( {
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