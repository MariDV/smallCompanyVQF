<?php
//----------------------------------INSERT---------------------------------
    //to allow use mySQL DATABASE
    require_once 'Connection.php';

    //If the user press the button SAVE on the Prescription
    if(isset($_POST['saveBill'])) {


        $id_Customer = $_POST['id_Customer']; 
        $Payment_Date = $_POST['Payment_Date']; 
        $Payment_Value = $_POST['Payment_Value']; 
        $wasPaid = $_POST['wasPaid']; 
        $whenPaid = $_POST['whenPaid']; 
        $Comment = $_POST['Comment']; 

        //input the value
        $SQLSaveNewFinance = 'INSERT INTO finance_situation (id_Customer, Payment_Date, Payment_Value, wasPaid, whenPaid, Comment) VALUES (:id_Customer, :Payment_Date, :Payment_Value, :wasPaid, :whenPaid, :Comment)';

        $dataSaveFinance = $conn->prepare($SQLSaveNewFinance); //prepair the sql

        //--substitute of placeHolder--
        $dataSaveFinance->bindParam(':id_Customer' , $id_Customer, PDO::PARAM_INT);
        $dataSaveFinance->bindParam(':Payment_Date' , $Payment_Date, PDO::PARAM_STR);
        $dataSaveFinance->bindParam(':Payment_Value' , $Payment_Value , PDO::PARAM_INT);
        $dataSaveFinance->bindParam(':wasPaid' , $wasPaid, PDO::PARAM_INT);
        $dataSaveFinance->bindParam(':whenPaid', $whenPaid , PDO::PARAM_STR);
        $dataSaveFinance->bindParam(':Comment' , $Comment, PDO::PARAM_STR);
        $dataSaveFinance->execute(); //play!
    }

    //-------------------------DELETE----------------------------------------
    //if the User clicked delete Button in a Bill
    if(isset($_GET['deleteBill'])){
        $id = $_GET['deleteBill'];

        $SQLDeleteFinance = 'UPDATE finance_situation SET active = 0 WHERE id = :id';

        $DeleteFinance = $conn->prepare($SQLDeleteFinance); //prepair the sql

        //--substitute of placeHolder--
        $DeleteFinance->bindParam(':id' , $id, PDO::PARAM_INT);
        $DeleteFinance->execute(); //play!
    }

    //-------------------------EDIT----------------------------------------
    //------------------------PART 1 --------------------------------------
    //search Bills and input the info in a blank square

    //Default value --> if not GET (if dont click EDIT), bring this default value
    $id_CustomerBlank = 0;
    $CustomerNameBlank = '';
    $Payment_DateBlank = ''; //1900-01-01
    $Payment_ValueBlank = 0;
    $wasPaidBlank = 0;
    $whenPaidBlank = '';
    $CommentBlank = '';

    $updateBtn = false;


    //if the User clicked edit Button in a Bill Customer
    if(isset($_GET['editBill'])){
        $id = $_GET['editBill'];

        //change button from Save to Update (end of the page)
        $updateBtn = true;

        $SQLEditFinance = 'SELECT finance_situation.*,
                                CONCAT(customers.name, " ", customers.lastName) AS FullName
                                FROM finance_situation 
                                JOIN customers
                                ON finance_situation.id_Customer = customers.id_fix_customer
                                WHERE finance_situation.id = :id
                                AND finance_situation.active = 1
                                LIMIT 1';

        $dataEditFinance= $conn->prepare($SQLEditFinance); //prepair the sql

        //--substitute of placeHolder--
        $dataEditFinance->bindParam(':id' , $id, PDO::PARAM_INT);
        $dataEditFinance->execute(); //play!

        //if after my sql execute, there is just 1 row:
        if ($dataEditFinance->rowCount() == 1) {

            //$dataEditPrescription has now all information of PRESCRIPTION
            $dataEditFinance = $dataEditFinance->fetch(PDO::FETCH_ASSOC);

            //set all information of this row to inset on DATATABLE_FINANCE_SITUATION
            $id_CustomerBlank = $dataEditFinance['id_Customer'];
            $CustomerNameBlank = $dataEditFinance['FullName'];
            $Payment_DateBlank = $dataEditFinance['Payment_Date'];
            $Payment_ValueBlank = $dataEditFinance['Payment_Value'];
            $wasPaidBlank = $dataEditFinance['wasPaid'];
            $whenPaidBlank = $dataEditFinance['whenPaid'];
            $CommentBlank = $dataEditFinance['Comment'];
        }

    }

    //------------------------PART 2 --------------------------------------
    //Update information into DB

    if(isset($_POST['updateBill'])) {

        $id_Customer = $_POST['id_Customer']; 
        $Payment_Date = $_POST['Payment_Date']; 
        $Payment_Value = $_POST['Payment_Value']; 
        $wasPaid = $_POST['wasPaid']; 
        $whenPaid = $_POST['whenPaid']; 
        $Comment = $_POST['Comment'];

        //update the value
        $SQLupdateFinance = 'UPDATE finance_situation 
                                SET 
                                id_Customer = :id_Customer,
                                Payment_Date = :Payment_Date,
                                Payment_Value = :Payment_Value, 
                                wasPaid = :wasPaid,
                                whenPaid = :whenPaid,
                                Comment = :Comment
                                WHERE id_Customer = :id_Customer
                                AND id = :id
                                AND active = 1';

        $updateFinance = $conn->prepare($SQLupdateFinance); //prepair the sql

        //--substitute of placeHolder--
        $updateFinance->bindParam(':id_Customer' , $id_Customer, PDO::PARAM_INT);
        $updateFinance->bindParam(':id' , $id, PDO::PARAM_INT);
        $updateFinance->bindParam(':Payment_Date' , $Payment_Date, PDO::PARAM_STR);
        $updateFinance->bindParam(':Payment_Value' , $Payment_Value , PDO::PARAM_INT);
        $updateFinance->bindParam(':wasPaid' , $wasPaid, PDO::PARAM_INT);
        $updateFinance->bindParam(':whenPaid', $whenPaid , PDO::PARAM_STR);
        $updateFinance->bindParam(':Comment' , $Comment, PDO::PARAM_STR);
        $updateFinance->execute(); //play!

    }
?>