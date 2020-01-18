        <!-- https://cdnjs.com/libraries/jquery/1.9.0 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sc-2.0.1/sl-1.3.1/datatables.min.css"/>
    <style type="text/css">
        #myTable_wrapper{
            padding: 20px;
        }             
    </style>

<?php require_once 'ViewProblemCRUD.php' ?>


<!-- DATAVIEW OF Customer Problems -->
<?php 

    //Query to bring all info of the CUSTOMER PROBLEM
	//JOIN CUSTOMER to take the current customer Name
    $sql_ProblemAll = $conn->query("SELECT 
    								problem_report.*,
    								CONCAT(customers.name, ' ', customers.lastName) AS Name_Customer
   									FROM problem_report
   									JOIN customers
   									ON problem_report.id_Customer = customers.id_fix_customer
   									WHERE customers.id_fix_customer = " . $_SESSION['idCustomer'] . "
   									AND problem_report.active = 1
	                                AND customers.active = 1");
    //print each line of my db
    $dataWithFetch = $sql_ProblemAll->fetchAll(PDO::FETCH_ASSOC);

 ?>

	<table id="ProbTable" class="display nowrap">
		<thead>
			<tr>
				<th>id Problem</th>
				<th>id Customer</th>
				<th>Name</th>
				<th>Report</th>
				<th>Risk</th>
				<th>Data</th>
				<th></th>
			</tr>
		</thead>
	
	<!-- LOOP ALL INFORMATION TO A TABLE -->
		<?php 
			foreach ($dataWithFetch as $key => $order) {
            echo "<tr>
            		<td>" . $order['id'] . "</td>
                    <td>" . $order['id_Customer'] . "</td>
                    <td>" . $order['Name_Customer'] . "</td>
                    <td>" . $order['Report'] . "</td>
                    <td>" . $order['Risk'] . "</td>
                    <td>" . $order['Data'] . "</td>
                    <td>
						<a href='ViewProblemCRUD.php?deleteProblem=" . $order['id'] ."' class='btn btn-danger' OnClick=\"return confirm('Are you sure you want to DELETE this Customer problem?');\" >delete</a>
                    </td>
                </tr>";

                
        	}

		?>
	</table> <!-- END DATAVIEW -->

<!------- FORM TO ADD, CHANGE AND DELETE ALL THE INFORMATION INSIDE DB PROBLEM ------>
    <form action="#" method="POST" style="display: inline-block;width: 60%;padding-top: 30px;padding-left: 15px;">

		<div class="form-group"> 
			<label>id Customer</label>      
			<input type="text" name="id_Customer" class="form-control" readonly value =  <?php if($id_fix_customer != 0) { echo "'$id_fix_customer'"; } else { echo "'$nextIdCustomer'"; } ?>>
		</div>

		<div class="form-group">
			<label>Report</label> 
			<input type="text" name="Report" class="form-control" required>
		</div>

		<div class="form-group">
			<label>Risk</label> 
			<select name="Risk" class="form-control">
                <option value='0' selected> No Risk </option>
                <option value='1'> Low Risk </option>
                <option value='2'> Medium Risk </option>
                <option value='3'> High Risk </option>
            </select>
		</div>

		<div class="form-group">
			
			<!-- BUTTON IN THE END. NEW PROBLEM? = SAVE | EDIT PROBLEM? = UPDATE -->
			<?php if($updateBtn == true) : ?>
				<button type="submit" class="btn btn-info" name="updateFamily" onClick="return confirm('Are you sure you want to UPDATE this Customer Family?');">Update</button>
			<?php else : ?>
				<button type="submit" class="btn btn-primary" name="saveProblem" onClick="return confirm('Are you sure you want to SAVE this Customer Problem?');">Save</button>
			<?php endif; ?>

		</div>
        
    </form>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sc-2.0.1/sl-1.3.1/datatables.min.js"></script>
    <script type="text/javascript">
 $('#ProbTable').DataTable( {
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