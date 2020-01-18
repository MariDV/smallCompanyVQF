<?php
//----------------------------------INSERT---------------------------------
	//to allow use mySQL DATABASE
	require_once 'Connection.php';
	
	//If the user press the button SAVE on the FamilyFile
	if(isset($_POST['saveFamily'])) {
		$id_Customer = $_POST['id_Customer'];
		$name = $_POST['name'];
		$relationship = $_POST['relationship'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$emergency_call = $_POST['emergency_call'];


		//input the value
		$SQLSaveNewFamily = 'INSERT INTO customers_family (id_Customer, name, relationship, phone, address, emergency_call) VALUES (:id_Customer, :name, :relationship, :phone, :address, :emergency_call)';

	    $dataSaveFamily = $conn->prepare($SQLSaveNewFamily); //prepair the sql

	    //--substitute of placeHolder--
	    $dataSaveFamily->bindParam(':id_Customer' , $id_Customer , PDO::PARAM_INT);
	    $dataSaveFamily->bindParam(':name' , $name , PDO::PARAM_STR);
	    $dataSaveFamily->bindParam(':relationship' , $relationship , PDO::PARAM_STR);
	    $dataSaveFamily->bindParam(':phone' , $phone , PDO::PARAM_INT);
	    $dataSaveFamily->bindParam(':address' , $address , PDO::PARAM_STR);
	    $dataSaveFamily->bindParam(':emergency_call' , $emergency_call , PDO::PARAM_INT);
	    $dataSaveFamily->execute(); //play!

	}

	//-------------------------DELETE----------------------------------------
	//if the User clicked delete Button in a family Customer
	if(isset($_GET['deleteFamily'])){
		$id = $_GET['deleteFamily'];

		$SQLDeleteNewFamily = 'UPDATE customers_family SET active = 0 WHERE id = :id';

	    $DeleteFamily = $conn->prepare($SQLDeleteNewFamily); //prepair the sql

	    //--substitute of placeHolder--
	    $DeleteFamily->bindParam(':id' , $id, PDO::PARAM_INT);
	    $DeleteFamily->execute(); //play!

	    //comeback to page
	    header("location: customersInfo.php");
	}

	//-------------------------EDIT----------------------------------------
	//------------------------PART 1 --------------------------------------
	//search family and input the info in a blank square

	//Default value --> if not GET (if dont click EDIT), bring this default value
	$blankSpaceName = "";
	$blankSpaceRelationship = "Other";
	$blankSpacePhone = "";
	$blankSpaceAdd = "";
	$blankSpaceEC = 1;
	$updateBtn = false;

	//if the User clicked edit Button in a family Customer
	if(isset($_GET['editFamily'])){
		$id = $_GET['editFamily'];

		//change button from Save to Update (end of the page)
		$updateBtn = true;

		$SQLEditFamily = 'SELECT * 
						FROM customers_family 
						WHERE id = :id
						AND active = 1';

	    $dataEditFamily = $conn->prepare($SQLEditFamily); //prepair the sql

	    //--substitute of placeHolder--
	    $dataEditFamily->bindParam(':id' , $id, PDO::PARAM_INT);
	    $dataEditFamily->execute(); //play!

	    //if after my sql execute, there is just 1 row:
        if ($dataEditFamily->rowCount() == 1) {

        	//$dataEditFamily has now all information of familyCustomer
        	$dataEditFamily = $dataEditFamily->fetch(PDO::FETCH_ASSOC);

        	//set all information of this row to inset on FamylyCRUD
    		$blankSpaceName = $dataEditFamily['name'];
    		$blankSpaceRelationship = $dataEditFamily['relationship'];
    		$blankSpacePhone = $dataEditFamily['phone'];
    		$blankSpaceAdd = $dataEditFamily['address'];
    		$blankSpaceEC = $dataEditFamily['emergency_call'];
        }
	}

	//------------------------PART 2 --------------------------------------
	//Update information into DB

	if(isset($_POST['updateFamily'])) {

		$id_Customer = $_POST['id_Customer'];
		$name = $_POST['name'];
		$relationship = $_POST['relationship'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$emergency_call = $_POST['emergency_call'];

		//update the value
		$SQLupdateFamily = 'UPDATE customers_family 
							SET 
							name = :name,
							relationship = :relationship,
							phone = :phone, 
							address = :address,
							emergency_call = :emergency_call
							WHERE id = :id
							AND active = 1';

	    $updateFamily = $conn->prepare($SQLupdateFamily); //prepair the sql

	    //--substitute of placeHolder--
	    $updateFamily->bindParam(':id' , $id , PDO::PARAM_INT);
	    $updateFamily->bindParam(':name' , $name , PDO::PARAM_STR);
	    $updateFamily->bindParam(':relationship' , $relationship , PDO::PARAM_STR);
	    $updateFamily->bindParam(':phone' , $phone , PDO::PARAM_INT);
	    $updateFamily->bindParam(':address' , $address , PDO::PARAM_STR);
	    $updateFamily->bindParam(':emergency_call' , $emergency_call , PDO::PARAM_INT);
	    $updateFamily->execute(); //play!

	}


 ?>