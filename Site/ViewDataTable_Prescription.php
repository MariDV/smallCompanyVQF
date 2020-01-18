<?php
//----------------------------------INSERT---------------------------------
    //to allow use mySQL DATABASE
    require_once 'Connection.php';
    //If the user press the button SAVE on the Prescription
    if(isset($_POST['save'])) {
       $id_Customer = $_POST['id_Customer'];
       $medicine = $_POST['medicine'];
       $Dose = $_POST['Dose'];
       $mesuremment = $_POST['mesuremment'];
       $medicine_Presentation = $_POST['medicine_Presentation'];
       $Posologia = $_POST['Posologia'];
       $qtdy_week = $_POST['qtdy_week'];
       $data_time = $_POST['data_time'];
       $way_takeit = $_POST['way_takeit'];
       $usage_till = $_POST['usage_till'];
       $orientation = $_POST['orientation'];
        //input the value
        $SQLSaveNewFamily = 'INSERT INTO prescricao_base (id_Customer, medicine, Dose, mesuremment, medicine_Presentation, Posologia, qtdy_week, data_time, way_takeit, usage_till, orientation) VALUES (:id_Customer, :medicine, :Dose, :mesuremment, :medicine_Presentation, :Posologia, :qtdy_week, :data_time, :way_takeit, :usage_till, :orientation)';
        $dataSaveFamily = $conn->prepare($SQLSaveNewFamily); //prepair the sql
        //--substitute of placeHolder--
        $dataSaveFamily->bindParam(':id_Customer' , $id_Customer, PDO::PARAM_INT);
        $dataSaveFamily->bindParam(':medicine' , $medicine, PDO::PARAM_STR);
        $dataSaveFamily->bindParam(':Dose' , $Dose , PDO::PARAM_INT);
        $dataSaveFamily->bindParam(':mesuremment' , $mesuremment, PDO::PARAM_STR);
        $dataSaveFamily->bindParam(':medicine_Presentation', $medicine_Presentation , PDO::PARAM_STR);
        $dataSaveFamily->bindParam(':Posologia' , $Posologia, PDO::PARAM_INT);
        $dataSaveFamily->bindParam(':qtdy_week' , $qtdy_week, PDO::PARAM_INT);
        $dataSaveFamily->bindParam(':data_time' , $data_time);
        $dataSaveFamily->bindParam(':way_takeit' , $way_takeit, PDO::PARAM_STR);
        $dataSaveFamily->bindParam(':usage_till' , $usage_till);
        $dataSaveFamily->bindParam(':orientation' , $orientation, PDO::PARAM_STR);
        $dataSaveFamily->execute(); //play!
    }
    //-------------------------DELETE----------------------------------------
    //if the User clicked delete Button in a Preparation
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $SQLDeletePreparation = 'UPDATE prescricao_base SET active = 0 WHERE id = :id';
        $DeleteFamily = $conn->prepare($SQLDeletePreparation); //prepair the sql
        //--substitute of placeHolder--
        $DeleteFamily->bindParam(':id' , $id, PDO::PARAM_INT);
        $DeleteFamily->execute(); //play!
        //comeback to page
        //header("location: DataTable_Prescription.php");
    }
    //-------------------------EDIT----------------------------------------
    //------------------------PART 1 --------------------------------------
    //search Prescription and input the info in a blank square
    //Default value --> if not GET (if dont click EDIT), bring this default value
    $idCustomerBlank= "";
    $NameBlank= "";   
    $MedicineBlank= "";
    $DoseBlank= 0;
    $MesuremmentBlank= "ml";
    $medicinePrescriptionBlank= "Comprimido";
    $PosologyBlank= 0;
    $WeekDayBlank= 0;
    $TimeBlank= "";
    $WaytotakeitBlank= "ORAL";
    $UsagetillBlank= "";
    $OrientationBlank= "";
    $updateBtn = false;
    //if the User clicked edit Button in a family Customer
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        //change button from Save to Update (end of the page)
        $updateBtn = true;
        $SQLEditPrescription = 'SELECT prescricao_base.*,
                                CONCAT(customers.name, " ", customers.lastName) AS name
                                FROM prescricao_base 
                                JOIN customers
                                ON prescricao_base.id_Customer = customers.id_fix_customer
                                WHERE prescricao_base.id = :id
                                AND prescricao_base.active = 1
                                LIMIT 1';
        $dataEditPrescription = $conn->prepare($SQLEditPrescription); //prepair the sql
        //--substitute of placeHolder--
        $dataEditPrescription->bindParam(':id' , $id, PDO::PARAM_INT);
        $dataEditPrescription->execute(); //play!
        //if after my sql execute, there is just 1 row:
        if ($dataEditPrescription->rowCount() == 1) {
            //$dataEditPrescription has now all information of PRESCRIPTION
            $dataEditPrescription = $dataEditPrescription->fetch(PDO::FETCH_ASSOC);
            //set all information of this row to inset on DATATABLE_PRESCRIPTION
            $idCustomerBlank= $dataEditPrescription['id_Customer'];
            $NameBlank= $dataEditPrescription['name']; 
            $MedicineBlank= $dataEditPrescription['medicine'];
            $DoseBlank= $dataEditPrescription['Dose'];
            $MesuremmentBlank= $dataEditPrescription['mesuremment'];
            $medicinePrescriptionBlank= $dataEditPrescription['medicine_Presentation'];
            $PosologyBlank= $dataEditPrescription['Posologia'];
            $WeekDayBlank= $dataEditPrescription['qtdy_week'];
            $TimeBlank= $dataEditPrescription['data_time'];
            $WaytotakeitBlank= $dataEditPrescription['way_takeit'];
            $UsagetillBlank= $dataEditPrescription['usage_till'];
            $OrientationBlank= $dataEditPrescription['orientation'];
        }
    }
    //------------------------PART 2 --------------------------------------
    //Update information into DB
    if(isset($_POST['update'])) {
        $id_Customer = $_POST['id_Customer'];
        $medicine = $_POST['medicine'];
        $Dose = $_POST['Dose'];
        $mesuremment = $_POST['mesuremment'];
        $medicine_Presentation = $_POST['medicine_Presentation'];
        $Posologia = $_POST['Posologia'];
        $qtdy_week = $_POST['qtdy_week'];
        $data_time = $_POST['data_time'];
        $way_takeit = $_POST['way_takeit'];
        $usage_till = $_POST['usage_till'];
        $orientation = $_POST['orientation'];
        //update the value
        $SQLupdatePrescription = 'UPDATE prescricao_base 
                                SET 
                                id_Customer = :id_Customer,
                                medicine = :medicine,
                                Dose = :Dose, 
                                mesuremment = :mesuremment,
                                medicine_Presentation = :medicine_Presentation,
                                Posologia = :Posologia,
                                qtdy_week = :qtdy_week,
                                data_time = :data_time,
                                way_takeit = :way_takeit,
                                usage_till = :usage_till,
                                orientation = :orientation
                                WHERE id_Customer = :id_Customer
                                AND active = 1';
        $updatePrescription = $conn->prepare($SQLupdatePrescription); //prepair the sql
        //--substitute of placeHolder--
        $updatePrescription->bindParam(':id_Customer' , $id_Customer, PDO::PARAM_INT);
        $updatePrescription->bindParam(':medicine' , $medicine, PDO::PARAM_STR);
        $updatePrescription->bindParam(':Dose' , $Dose , PDO::PARAM_INT);
        $updatePrescription->bindParam(':mesuremment' , $mesuremment, PDO::PARAM_STR);
        $updatePrescription->bindParam(':medicine_Presentation', $medicine_Presentation , PDO::PARAM_STR);
        $updatePrescription->bindParam(':Posologia' , $Posologia, PDO::PARAM_INT);
        $updatePrescription->bindParam(':qtdy_week' , $qtdy_week, PDO::PARAM_INT);
        $updatePrescription->bindParam(':data_time' , $data_time);
        $updatePrescription->bindParam(':way_takeit' , $way_takeit, PDO::PARAM_STR);
        $updatePrescription->bindParam(':usage_till' , $usage_till);
        $updatePrescription->bindParam(':orientation' , $orientation, PDO::PARAM_STR);
        $updatePrescription->execute(); //play!
    }
?>