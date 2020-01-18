<?php
//----------------------------------INSERT---------------------------------
	//to allow use mySQL DATABASE
	require_once 'Connection.php';

	//If the user press the button SAVE on the BankAcc
	if(isset($_POST['saveBankACC'])) {

		$responsibleCount_id = $_POST['responsibleCount_id'];
		$ownerType = $_POST['ownerType'];
		$id_Customer = $_POST['id_Customer'];
		$bankName = $_POST['bankName'];
		$agency = $_POST['agency'];
		$account = $_POST['account'];


		//input the value
		$SQLSaveNewBankAcc = 'INSERT INTO bank_acc (responsibleCount_id, ownerType, id_Customer, bankName, agency, account) VALUES (:responsibleCount_id, :ownerType, :id_Customer, :bankName, :agency, :account)';

	    $dataSaveBankAcc = $conn->prepare($SQLSaveNewBankAcc); //prepair the sql

	    //--substitute of placeHolder--
	    $dataSaveBankAcc->bindParam(':responsibleCount_id' , $responsibleCount_id , PDO::PARAM_INT);
	    $dataSaveBankAcc->bindParam(':ownerType' , $ownerType , PDO::PARAM_STR);
	    $dataSaveBankAcc->bindParam(':id_Customer' , $id_Customer , PDO::PARAM_INT);
	    $dataSaveBankAcc->bindParam(':bankName' , $bankName , PDO::PARAM_STR);
	    $dataSaveBankAcc->bindParam(':agency' , $agency , PDO::PARAM_INT);
	    $dataSaveBankAcc->bindParam(':account' , $account , PDO::PARAM_INT);
	    $dataSaveBankAcc->execute(); //play!

	}

	//-------------------------DELETE----------------------------------------
	//if the User clicked delete Button in a BankAcc
	if(isset($_GET['deleteBankACC'])){
		$id = $_GET['deleteBankACC'];

		$SQLDeleteNewBankAcc = 'UPDATE bank_acc SET active = 0 WHERE id = :id';

	    $DeleteBankAcc = $conn->prepare($SQLDeleteNewBankAcc); //prepair the sql

	    //--substitute of placeHolder--
	    $DeleteBankAcc->bindParam(':id' , $id, PDO::PARAM_INT);
	    $DeleteBankAcc->execute(); //play!

	    //comeback to page
	    header("location: customersInfo.php");
	}

	//-------------------------EDIT----------------------------------------
	//------------------------PART 1 --------------------------------------
	//search Bank Acc and input the info in a blank square

	//Default value --> if not GET (if dont click EDIT), bring this default value
	$blankSpaceresponsibleCount_id = 0;
	$blankSpaceownerType = "Customer";
	$blankSpacebankName = "";
	$blankSpaceagency = 0;
	$blankSpaceaccount = 0;

	//if the User clicked edit Button in a BankAccount Customer
	if(isset($_GET['editBankACC'])){
		$id = $_GET['editBankACC'];

		//change button from Save to Update (end of the page)
		$updateBtn = true;

		$SQLEditBankAcc = 'SELECT * 
						FROM bank_acc 
						WHERE id = :id
						AND active = 1';

	    $dataEditBankAcc = $conn->prepare($SQLEditBankAcc); //prepair the sql

	    //--substitute of placeHolder--
	    $dataEditBankAcc->bindParam(':id' , $id, PDO::PARAM_INT);
	    $dataEditBankAcc->execute(); //play!

	    //if after my sql execute, there is just 1 row:
        if ($dataEditBankAcc->rowCount() == 1) {

        	//$dataEditBankAcc has now all information of BankAcc
        	$dataEditBankAcc = $dataEditBankAcc->fetch(PDO::FETCH_ASSOC);

        	//set all information of this row to inset on FamylyCRUD
    		$blankSpaceresponsibleCount_id = $dataEditBankAcc['responsibleCount_id'];
    		$blankSpaceownerType = $dataEditBankAcc['ownerType'];
    		$blankSpacebankName = $dataEditBankAcc['bankName'];
    		$blankSpaceagency = $dataEditBankAcc['agency'];
    		$blankSpaceaccount = $dataEditBankAcc['account'];
        }
	}

	//------------------------PART 2 --------------------------------------
	//Update information into DB

	if(isset($_POST['updateBankACC'])) {

		$responsibleCount_id = $_POST['responsibleCount_id'];
		$ownerType = $_POST['ownerType'];
		$bankName = $_POST['bankName'];
		$id_Customer = $_POST['id_Customer'];
		$agency = $_POST['agency'];
		$account = $_POST['account'];
		
		//update the value
		$SQLupdateBankAcc = 'UPDATE bank_acc 
							SET 
							responsibleCount_id = :responsibleCount_id,
							ownerType = :ownerType,
							bankName = :bankName, 
							agency = :agency,
							account = :account
							WHERE id_Customer = :id_Customer
							AND active = 1';

	    $updateBankAcc = $conn->prepare($SQLupdateBankAcc); //prepair the sql

	    //--substitute of placeHolder--
	    $updateBankAcc->bindParam(':id_Customer' , $id_Customer , PDO::PARAM_INT);
	    $updateBankAcc->bindParam(':responsibleCount_id' , $responsibleCount_id , PDO::PARAM_INT);
	    $updateBankAcc->bindParam(':ownerType' , $ownerType , PDO::PARAM_STR);
	    $updateBankAcc->bindParam(':bankName' , $bankName , PDO::PARAM_STR);
	    $updateBankAcc->bindParam(':agency' , $agency , PDO::PARAM_INT);
	    $updateBankAcc->bindParam(':account' , $account , PDO::PARAM_INT);
	    $updateBankAcc->execute(); //play!

	}


 ?>