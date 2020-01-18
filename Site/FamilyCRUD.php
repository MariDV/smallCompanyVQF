        <!-- https://cdnjs.com/libraries/jquery/1.9.0 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sc-2.0.1/sl-1.3.1/datatables.min.css"/>
    <style type="text/css">
        #myTable_wrapper{
            padding: 20px;
        }             
    </style>

<?php require_once 'ViewFamilyCRUD.php' ?>

<!-- DATAVIEW OF FAMILY CUSTOMER -->
<?php 
    //Query to bring all info of the FAMILY CUSTOMER
	//JOIN CUSTOMER to take the current customer Name
    $sql_FamilyAll = $conn->query("SELECT 
    								customers_family.*,
    								CONCAT(customers.name, ' ', customers.lastName) AS Name_Customer
   									FROM customers_family
   									JOIN customers
   									ON customers_family.id_Customer = customers.id_fix_customer
   									WHERE customers.id_fix_customer = " . $_SESSION['idCustomer'] . "
	                                AND customers_family.active = 1
	                                AND customers.active = 1");
    //print each line of my db
    $dataWithFetch = $sql_FamilyAll->fetchAll(PDO::FETCH_ASSOC);

 ?>

	<table id="fammyTable" class="display nowrap">
		<thead>
			<tr>
				<th>id Family</th>
				<th>id Customer</th>
				<th>Name Customer</th>
				<th>Name Family</th>
				<th>Relationship</th>
				<th>Phone</th>
				<th>Address</th>
				<th>EmergencyCall</th>
				<th>active</th>
				<th>created_at</th>
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
                    <td>" . $order['name'] . "</td>
                    <td>" . $order['relationship'] . "</td>
                    <td>" . $order['phone'] . "</td>
                    <td>" . $order['address'] . "</td>
                    <td>" . $order['emergency_call'] . "</td>
                    <td>" . $order['active'] . "</td>
                    <td>" . $order['created_at'] . "</td>
                    <td>
						<a href='customersInfo.php?editFamily=" . $order['id'] ."' class='btn btn-info'>edit</a>
						<a href='ViewFamilyCRUD.php?deleteFamily=" . $order['id'] ."' class='btn btn-danger' OnClick=\"return confirm('Are you sure you want to DELETE this Customer Family?');\" >delete</a>
                    </td>
                </tr>";

                
        	}

		?>
	</table> <!-- END DATAVIEW -->

<!------- FORM TO ADD, CHANGE AND DELETE ALL THE INFORMATION INSIDE DB FAMILY ------>
    <form action="#" method="POST" style="display: inline-block;width: 60%;padding-top: 30px;padding-left: 15px;">

		<div class="form-group"> 
			<label>id Customer</label>      
			<input type="text" name="id_Customer" class="form-control" readonly value =  <?php if($id_fix_customer != 0) { echo "'$id_fix_customer'"; } else { echo "'$nextIdCustomer'"; } ?>>
		</div>

		<div class="form-group"> 
			<label>Name</label>      
			<input type="text" name="name" class="form-control" value="<?php echo $blankSpaceName ?>">
		</div>

		<div class="form-group">
			<label>Relationship</label> 
			<select name="relationship" class="form-control">
                <option value='Mother' <?php if($blankSpaceRelationship == "Mother") echo "selected"?>> Mother </option>
                <option value='Father' <?php if($blankSpaceRelationship == "Father") echo "selected"?>> Father </option>
                <option value='Brother' <?php if($blankSpaceRelationship == "Brother") echo "selected"?>> Brother/ Sister </option>
                <option value='RelationshipPartner' <?php if($blankSpaceRelationship == "RelationshipPartner") echo "selected"?>> RelationshipPartner </option>
                <option value='Other' <?php if($blankSpaceRelationship == "Other") echo "selected"?>> Other </option>
            </select>
		</div>

		<div class="form-group">
			<label>Phone</label> 
			<input type="number" min="11111111" name="phone" class="form-control" value="<?php echo $blankSpacePhone ?>">
		</div>

		<div class="form-group">
			<label>Address</label> 
			<input type="text" name="address" class="form-control" value="<?php echo $blankSpaceAdd ?>">
		</div>

		<div class="form-group">
			<label>EmergencyCall</label> 
			<select name="emergency_call" class="form-control">
                <option value= 1 <?php if($blankSpaceEC == 1) echo "selected"?>> Yes </option>
                <option value= 0 <?php if($blankSpaceEC == 0) echo "selected"?>> No </option>
            </select>
		</div>

		<div class="form-group">
			
			<!-- BUTTON IN THE END. NEW FAMILY? = SAVE | EDIT FAMILY? = UPDATE -->
			<?php if($updateBtn == true) : ?>
				<button type="submit" class="btn btn-info" name="updateFamily" onClick="return confirm('Are you sure you want to UPDATE this Customer Family?');">Update</button>
			<?php else : ?>
				<button type="submit" class="btn btn-primary" name="saveFamily" onClick="return confirm('Are you sure you want to SAVE this Customer Family?');">Save</button>
			<?php endif; ?>

		</div>
        
    </form>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sc-2.0.1/sl-1.3.1/datatables.min.js"></script>
    <script type="text/javascript">
 $('#fammyTable').DataTable( {
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