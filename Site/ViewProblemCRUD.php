<?php
//----------------------------------INSERT---------------------------------
	//to allow use mySQL DATABASE
	require_once 'Connection.php';
	
	//If the user press the button SAVE on the problem
	if(isset($_POST['saveProblem'])) {
		$id_Customer = $_POST['id_Customer'];
		$Report = $_POST['Report'];
		$Risk = $_POST['Risk'];


		//input the value
		$SQLSaveNewProblem = 'INSERT INTO problem_report (id_Customer, 	Report, Risk) VALUES (:id_Customer, :Report, :Risk)';

	    $dataSaveProblem = $conn->prepare($SQLSaveNewProblem); //prepair the sql

	    //--substitute of placeHolder--
	    $dataSaveProblem->bindParam(':id_Customer' , $id_Customer , PDO::PARAM_INT);
	    $dataSaveProblem->bindParam(':Report' , $Report , PDO::PARAM_STR);
	    $dataSaveProblem->bindParam(':Risk' , $Risk , PDO::PARAM_INT);
	    $dataSaveProblem->execute(); //play!

	}

	//-------------------------DELETE----------------------------------------
	//if the User clicked delete Button in a Problem Customer
	if(isset($_GET['deleteProblem'])){
		$id = $_GET['deleteProblem'];

		$SQLDeleteNewProblem = 'UPDATE problem_report SET active = 0 WHERE id = :id';

	    $DeleteProblem = $conn->prepare($SQLDeleteNewProblem); //prepair the sql

	    //--substitute of placeHolder--
	    $DeleteProblem->bindParam(':id' , $id, PDO::PARAM_INT);
	    $DeleteProblem->execute(); //play!

	    //comeback to page
	    header("location: customersInfo.php");
	}

	

 ?>