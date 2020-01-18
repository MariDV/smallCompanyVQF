<?php
    session_start(); //Bring information of the Customer that was clicked
	include "header.php";
    include "Connection.php";
    

    //BLANK VARIABLES TO ADD CUSTOMERS
    //PERSONAL INFORMATION VARIABLES
    $id = 0;
    $id_fix_customer = 0;
    $name = "";
    $lastName = "";
    $RG = 0;
    $CPF = 0;
    $age = 0;
    $birth_date;
    $gender = "male";
    $ap = 0;
    $weight = 0;
    $height = 0;
    $IMC = 0;
    $relationship_status = "single";
    $power_of_Attorney = 0;
    $benefice = 0;
    $health_insurance_id = 0;
    $level_Dependence = 0;
    $death_Date;
    $activePersonal = 1;

    //Next id fixed (for each)
    $nextIdCustomers = "SELECT id_fix_customer 
                        FROM customers 
                        ORDER BY id_fix_customer DESC
                        LIMIT 1";
    $data = $conn->prepare($nextIdCustomers);
    $data->execute();
    $dataFetch = $data->fetch(PDO::FETCH_ASSOC);
    $nextIdCustomer = $dataFetch['id_fix_customer'] + 1;


    //SPECIAL NEEDS VARIABLES
    $id_Sneeds_Customer = 0;
    $disease = "";
    $allergy = "";
    $use_Diaper = 0;
    $eat_Alone = 0;
    $heel_Chair = 0;
    $Tracheostomized = 0;
    $Decubitus_ulcer = 0;
    $gastric_tube = 0;
    $tube_Naso = 0;
    $Diabetic = 0;
    $use_insuline = 0;
    $activeSNeeds = 1;

    //ADDRESS VARIABLE
    $id_Address_Customer = 0; //for find customer (customer_id)
    $id_address = 0;
    $country = "";
    $state = "";
    $address = "";
    $numberAddress = 0;
    $CEP = 0;
    $reference = "";
    $fullName="";


    //end variables--------
    
    //IF the user cliked in one of the customers
    if (isset($_SESSION['idCustomer'])) {
       
        //-------------------PERSONAL INFORMATION LOOP--------------------------
        //Query to bring all info of the clicked Customer
        $sql_PersonalInfo = $conn->query("SELECT * 
                                            FROM customers 
                                            WHERE id_fix_customer = " . $_SESSION['idCustomer'] . " 
                                            AND active = 1");
        $sql_PersonalInfo->execute(); //play!

        
        //Foreach to thought all information of the clicked customer:
        $Values = $sql_PersonalInfo->fetchAll();
        foreach ($Values as $value) {

            //if there is information inside POST[ID], insert in all variables
            //PERSONAL INFORMATION VARIABLES

            $id = $value['id'];
            $id_fix_customer = $value['id_fix_customer'];
            $name = $value['name'];
            $lastName = $value['lastName'];
            $RG = $value['RG'];
            $CPF = $value['CPF'];
            $age = $value['age'];
            $birth_date = $value['birth_date'];
            $gender = $value['gender'];
            $ap = $value['ap'];
            $weight = $value['weight'];
            $height = $value['height'];
            $IMC = $value['IMC'];
            $relationship_status = $value['height'];
            $power_of_Attorney = $value['power_of_Attorney'];
            $benefice = $value['benefice'];
            $health_insurance_id = $value['health_insurance_id'];
            $level_Dependence = $value['level_Dependence'];
            $death_Date = $value['death_Date'];
            $activePersonal = $value['active'];

            //----save the photo of the page without break----
            $_SESSION['fullname'] = $lastName . "-" . $name;
            $fullName=$_SESSION['fullname'];
        } //close foreach loop PERSONAL INFORMATION HERE! 

        //--------------------SPECIAL NEEDS LOOP------------------------
        //Query to bring all info of the clicked Customer
        $sql_SpecialNeeds = $conn->query("SELECT * 
                                        FROM special_needs 
                                        WHERE id_Customer = $id_fix_customer
                                        AND active = 1");
        $sql_SpecialNeeds->execute(); //play!

        
        //Foreach to thought all information of the clicked customer:
        $Values = $sql_SpecialNeeds->fetchAll();
        foreach ($Values as $value) {

            //if there is information inside POST[ID], insert in all variables
            //SPECIAL NEEDS VARIABLES
            $id_Sneeds_Customer = $value['id_Customer'];
            $disease = $value['disease'];
            $allergy = $value['allergy'];
            $use_Diaper = $value['use_Diaper'];
            $eat_Alone = $value['eat_Alone'];
            $heel_Chair = $value['heel_Chair'];
            $Tracheostomized = $value['Tracheostomized'];
            $Decubitus_ulcer = $value['Decubitus_ulcer'];
            $gastric_tube = $value['gastric_tube'];
            $tube_Naso = $value['tube_Naso'];
            $Diabetic = $value['Diabetic'];
            $use_insuline = $value['use_insuline'];
            $activeSNeeds = $value['active'];
        }//close foreach loop SPECIAL NEEDS HERE! 

        //--------------------ADDRESS CUSTOMER LOOP------------------------
        //Query to bring all info of the clicked Customer
        $sql_Adress = $conn->query("SELECT * 
                                        FROM address 
                                        WHERE id_Customer = $id_fix_customer
                                        AND active = 1");
        $sql_Adress->execute(); //play!

        
        //Foreach to thought all information of the clicked customer:
        $Values = $sql_Adress->fetchAll();
        foreach ($Values as $value) {

            //if there is information inside POST[ID], insert in all variables
            //ADDRESS VARIABLES
            $id_Address_Customer = $value['id_Customer'];
            $country = $value['country'];
            $state = $value['state'];
            $address = $value['address'];
            $numberAddress = $value['numberAddress'];
            $CEP = $value['CEP'];
            $reference = $value['reference'];
        }//close foreach loop ADDRESS HERE!
    } //end isset --> if there is information inside POST[ID]

?>
<style type="text/css">
    button.btn-file{
    border-bottom: 0;
    border-radius: 5px 5px 0px 0px;
    padding: 10px;
}
</style>

<body style="background-color: #ededed;">

    <!-- Title - ALL CUSTOMERS -  -->
    <div class="title-style">
          <fieldset class="box-title" id="test" style="padding-inline-start: 77.75em;"> 
            <legend><?php  echo $name . " " . $lastName  ?></legend>
          </fieldset>
    </div>

    <!-- BUTTON FOR CHANGE INFORMATION INSIDE PAGE (ALL FUNCTIONS ARE on HEADER)  -->
        <div class="files" style="margin-left: 19px;">
        <button class="btn-file" id="personalinfo1" style="background: white;" onclick="changeback();">Personal Info</button>
        <button class="btn-file" id="specialneeds2" style="background: lightgrey;" onclick="changeinfo();">Special Needs</button>
        <button class="btn-file" id="addressInput3" style="background: lightgrey;" onclick="changeAddress();">Address</button>
        <button class="btn-file" id="FamilyInfo4" style="background: lightgrey;" onclick="changeFamily();">Family</button>    
        <button class="btn-file" id="BankAccCRUD5" style="background: lightgrey;" onclick="changeBankAcc();">Bank Account</button>
        <button class="btn-file" id="ProblemCustomer6" style="background: lightgrey;" onclick="changeProblem();">Customer Report</button>       
    </div>

    <!-- WITHBORDER OF THE BODY - CONTAINS ALL ROWS WITH THE CARD/PROFILE -->
    <!------------------------------------------------PERSONAL INFORMATION SESION---------------------------------------------------------->
    <div class="withborder"  style="display: block;" >

        <div  style="display: inline-block;margin: 0 auto;width: 60%;">
        <!-- PERSONAL FORM -->
            <form method="POST" id="personalinfo" style="display: inline-block;width: 100%;padding-top: 30px;padding-left: 75px;padding-bottom: 30px;">
                <table>
                    <tr class="trContactInfo">
                        <td><input  class='formInput' type="hidden" name="id" value="<?php echo  $id ?>" required></td>
                    </tr>
                    <tr class="trContactInfo">
                        <th class="header_input">Name</th>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="firstname">First name:</td>
                        <td><input class='formInput' type="text" name="name" value="<?php echo $name ?>" required></td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="lastname">Last Name:</td>
                        <td><input class='formInput' type="text" name="lastname" value="<?php echo  $lastName ?>" required></td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="id_fix_customer">Fix ID for customer:</td><!--  this IF is for but current id_fixed for each customer -->
                        <td><input class='formInput' type="number" name="id_fix_customer" readonly value =  <?php if($id_fix_customer != 0) { echo "'$id_fix_customer'"; } else { echo "'$nextIdCustomer'"; } ?>></td>
                    </tr>

                    <!-- DOCUMENTS -->
                    <tr class="trContactInfo" style="line-height: 2.5em">
                        <th class="header_input">Documents</th>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="RG">RG:</td>
                        <td><input class='formInput' type="text" name="RG" value="<?php echo  $RG ?>" required></td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="CPF">CPF:</td>
                        <td><input class='formInput' type="text" name="CPF" value="<?php echo  $CPF ?>" required></td>
                    </tr>

                    <!-- PERSONAL INFORMATION -->
                    <tr class="trContactInfo" style="line-height: 2.5em">
                        <th class="header_input">Personal Information</th>
                    </tr>
                        <tr class="trContactInfo">
                        <td for="age">Age:</td>
                        <td><input class='formInput' type="number" min="0" max="120"  name="age" value="<?php echo  $age ?>" required></td>
                    </tr> 
                    <tr class="trContactInfo">
                        <td for="birth_date">birth_date:</td>
                        <td><input class='formInput' type="date" name="birth_date" value="<?php echo  $birth_date ?>" required></td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="Gender">Gender:</td>
                        <td>
                            <input class='formInput' type="radio" name="gender" value="male" <?php if($gender=="male") echo "checked"?> > Male
                            <input class='formInput' type="radio" name="gender" value="female" <?php if($gender=="female") echo "checked"?> > Female
                            <input class='formInput' type="radio" name="gender" value="other" <?php if($gender=="other")  echo "checked"?> > Other
                        </td>
                    </tr> 
                    <tr class="trContactInfo">
                        <td for="ap">Apartament:</td>
                        <td><input class='formInput' type="number" min="1" max="120"  name="ap" value="<?php echo $ap ?>" required></td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="weight">Weight:</td>
                        <td><input class='formInput' type="number" min="45" max="120" name="weight"  value="<?php echo $weight ?>" required></td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="height">Height:</td>
                        <td><input class='formInput' type="number" min="120" max="200" name="height"  value="<?php echo $height ?>" required></td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="IMC">IMC:</td>
                        <td><input class='formInput' type="number" name="IMC" readonly value="<?php echo $IMC ?>"></td>
                    </tr>
                    <tr class="trContactInfo" >
                        <td for="relationship_status">Relationship_status:</td>
                        <td>
                            <select name="relationship_status">
                                <option value="single" <?php if($gender=="single") echo "selected"?> >Single</option>
                                <option value="married" <?php if($gender=="married") echo "selected"?> >Married</option>
                                <option value="divorced" <?php if($gender=="divorced") echo "selected"?> >Divorced</option>
                                <option value="others" <?php if($gender=="others") echo "selected"?> >Others</option>
                            </select>
                        </td>
                    </tr>

                    <!-- HEALTH INFO -->
                    <tr class="trContactInfo" style="line-height: 2.5em">
                        <th class="header_input">Health Information</th>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="power_of_Attorney">Power of Attorney:</td>
                        <td>
                            <select name="power_of_Attorney">
                                <option value=1 <?php if($power_of_Attorney==1) echo "selected"?> >Yes</option>
                                <option value=0 <?php if($power_of_Attorney==0) echo "selected"?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="benefice">Benefice:</td>
                        <td>
                            <select name="benefice">
                                <option value=1 <?php if($benefice==1) echo "selected"?>>Yes</option>
                                <option value=0  <?php if($benefice==0) echo "selected"?> >No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="health_insurance_id">Health insurance id:</td>
                        <td><input class='formInput' type="text" name="health_insurance_id" value="<?php echo  $health_insurance_id ?>"></td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="level_Dependence">Level Dependence:</td>
                        <td>
                            <select name="level_Dependence">
                                <option value=0 <?php if($level_Dependence==0) echo "selected"?>>No Dependence</option>
                                <option value=1 <?php if($level_Dependence==1) echo "selected"?>>Level 1</option>
                                <option value=2 <?php if($level_Dependence==2) echo "selected"?>>Level 2</option>
                                <option value=3 <?php if($level_Dependence==3) echo "selected"?>>Level 3</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="death_Date">Death Date:</td>
                        <td><input class='formInput' type="date" name="death_Date" value="<?php echo  $death_Date ?>"></td>
                    </tr>
                    <tr class="trContactInfo">
                        <td for="activePersonal">Active:</td>
                    <td><input class='formInput' type="checkbox" name="activePersonal" checked></td>
                    </tr>
                </table>
               
                <!-- BUTTON TO GO TO OTHER REGISTRATION (NOT SUBMIT) -->
                <div style="display: inline-block">
                    <button sly class="btn btn-primary" type="update" name='updateCustomer' id="updateBtn" onClick="return confirm('Are you sure you want to UPDATE this custommer?')">Update</button>
                </div>
            </form>
        </div>
        

        <div  id="specialneeds" style="display: inline-block;margin: 0 auto;width: 60%;display: none;margin-bottom: 30px;">

        <!----------------------- SPECIAL NEEDS FORM ------------------- -->
            <form method="POST" style="display: inline-block;width: 100%;padding-top: 30px;padding-left: 75px;">
                <table>
                    <tr class="trSpecialNeeds">
                        <td for="id_Customer">ID Customer:</td>
                        <td><input class='formInput' type="number" name="id_Customer" readonly value=<?php if($id_fix_customer != 0) { echo "'$id_fix_customer'"; } else { echo "'$nextIdCustomer'"; } ?>></td>
                    </tr>
                    <tr class="trSpecialNeeds" style="line-height: 2.5em">
                        <th class="header_input">Special needs</th>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="disease">Disease:</td>
                        <td><input class='formInput' type="text" name="disease" value="<?php echo $disease ?>"></td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="allergy">Allergy:</td>
                        <td><input class='formInput' type="text" name="allergy" value="<?php echo  $allergy ?>"></td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="use_Diaper">Use Diaper:</td>
                        <td>
                            <select name="use_Diaper">
                                <option value=1 <?php if($use_Diaper==1) echo "selected"?>>Yes</option>
                                <option value=0 <?php if($use_Diaper==0) echo "selected"?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="eat_Alone">Eat Alone:</td>
                        <td>
                            <select name="eat_Alone">
                                <option value=1 <?php if($eat_Alone==1) echo "selected"?>>Yes</option>
                                <option value=0 <?php if($eat_Alone==0) echo "selected"?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="heel_Chair">Heel Chair:</td>
                        <td>
                            <select name="heel_Chair">
                                <option value=1 <?php if($heel_Chair==1) echo "selected"?>>Yes</option>
                                <option value=0 <?php if($heel_Chair==0) echo "selected"?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="Tracheostomized">Tracheostomized:</td>
                        <td>
                            <select name="Tracheostomized">
                                <option value=1 <?php if($Tracheostomized==1) echo "selected"?>>Yes</option>
                                <option value=0 <?php if($Tracheostomized==0) echo "selected"?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="Decubitus_ulcer">Decubitus ulcer:</td>
                        <td>
                            <select name="Decubitus_ulcer">
                                <option value=1 <?php if($Decubitus_ulcer==1) echo "selected"?>>Yes</option>
                                <option value=0 <?php if($Decubitus_ulcer==0) echo "selected"?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="gastric_tube">gastric tube:</td>
                        <td>
                            <select name="gastric_tube">
                                <option value=1 <?php if($gastric_tube==1) echo "selected"?>>Yes</option>
                                <option value=0 <?php if($gastric_tube==0) echo "selected"?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="tube_Naso">tube Naso:</td>
                        <td>
                            <select name="tube_Naso">
                                <option value=1 <?php if($tube_Naso==1) echo "selected"?>>Yes</option>
                                <option value=0 <?php if($tube_Naso==0) echo "selected"?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="Diabetic">Diabetic:</td>
                        <td>
                            <select name="Diabetic">
                                <option value=1 <?php if($Diabetic==1) echo "selected"?>>Yes</option>
                                <option value=0 <?php if($Diabetic==0) echo "selected"?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="use_insuline">use insuline:</td>
                        <td>
                            <select name="use_insuline">
                                <option value=1 <?php if($use_insuline==1) echo "selected"?>>Yes</option>
                                <option value=0 <?php if($use_insuline==0) echo "selected"?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="trSpecialNeeds">
                        <td for="activeSNeeds">Active:</td>
                        <td><input class='formInput' type="checkbox" name="activeSNeeds" checked></td>
                    </tr>
                </table>
               
                <!-- BUTTON TO GO TO OTHER REGISTRATION (NOT SUBMIT) -->
                <div style="display: inline-block">
                    <button sly class="btn btn-primary" type="update" name='updateSpecialNeeds' id="updateBtn" onClick="return confirm('Are you sure you want to UPDATE this Special needs?')">Update</button>
                </div>
            </form>
        </div>


        <div  id="addressInput" style="display: inline-block;margin: 0 auto;width: 60%;display: none;margin-bottom: 30px;">

        <!--------------------------------------- ADDRESS FORM --------------------------------- -->
            <form method="POST" style="display: inline-block;width: 100%;padding-top: 30px;padding-left: 75px;">
                <table>
                    <tr class="trAddress">
                        <td for="id_Address_Customer">ID Customer:</td>
                        <td><input class='formInput' type="number" name="id_Address_Customer" readonly value=<?php if($id_fix_customer != 0) { echo "'$id_fix_customer'"; } else { echo "'$nextIdCustomer'"; } ?>></td>
                    </tr>
                    <tr class="trAddress" style="line-height: 2.5em">
                        <th class="header_input">Address</th>
                    </tr>
                    <tr class="trAddress">
                        <td for="country">Alpha Country:</td>
                        <td><input class='formInput' required type="text" name="country" maxlength="2" placeholder="BR" value="<?php echo $country ?>"></td>
                    </tr>
                    <tr class="trAddress">
                        <td for="state">State:</td>
                        <td><input class='formInput' required type="text" name="state" maxlength="2" placeholder="SP" value="<?php echo $state ?>"></td>
                    </tr>
                    <tr class="trAddress">
                        <td for="state">Address:</td>
                        <td><input type="text" class='formInput' required name="address" value="<?php echo $address ?>"></input></td>
                    </tr>
                    <tr class="trAddress">
                        <td for="numberAddress">number:</td>
                        <td><input class='formInput' required type="number" min="1" name="numberAddress" value="<?php echo $numberAddress ?>" required></td>
                    </tr>
                    <tr class="trAddress">
                        <td for="CEP">CEP:</td>
                        <td><input class='formInput' required type="number" min="1000000" max="99999999" name="CEP" value="<?php echo $CEP ?>" required></td>
                    </tr>
                    <tr class="trAddress">
                        <td for="reference">reference:</td>
                        <td><input type="text" class='formInput'  name="reference" value="<?php echo $reference ?>"></input></td>
                    </tr>
                    <tr class="trAddress">
                        <td for="activeSNeeds">Active:</td>
                        <td><input class='formInput' type="checkbox" name="activeSNeeds" checked></td>
                    </tr>
                </table>
               
                <!-- BUTTON TO GO TO OTHER REGISTRATION (NOT SUBMIT) -->
                <div style="display: inline-block">
                    <button sly class="btn btn-primary" type="update" name='updateAddress' id="updateBtn" onClick="return confirm('Are you sure you want to UPDATE this Address?')">Update</button>
                </div>
            </form>
        </div>
    
     <?php
     

    //OPEN FAMILYINFO, AND REQUEST INFO USING 'FAMILYCRUD.PHP'
    echo "<div  id='FamilyInfo' class='row justify-content-center' style='margin: 0;width: 95%;display: none;margin-left:30px;margin-right:0px;margin-bottom: 20px;'>";
    //----------------------- FAMILY CRUD ----------------------------------
    require_once('FamilyCRUD.php');
    //----------------------- FINISH FAMILY CRUD ----------------------------------
    echo "</div>";


    //OPEN BankAcc, AND REQUEST INFO USING 'BankAccCRUD.PHP'
    echo "<div  id='BankAccCRUD' class='row justify-content-center' style='margin: 0 auto;width: 95%;display: none;margin-bottom: 20px;'>";
    //----------------------- BANK ACOUNT CRUD ----------------------------------
    require_once('BankAccCRUD.php');
    //----------------------- FINISH BANK ACCOUNT CRUD ----------------------------------
    echo "</div>";

       //OPEN Customer Problem, AND REQUEST INFO USING 'Problem.PHP'
    echo "<div  id='ProblemCRUD' class='row justify-content-center' style='margin: 0 auto;width: 95%;display: none;margin-bottom: 20px;'>";
    //----------------------- BANK ACOUNT CRUD ----------------------------------
    require_once('ProblemCRUD.php');
    //----------------------- FINISH PROBLEM CRUD ----------------------------------
    echo "</div>";
    
    if ($fullName!=""){
    //CURRENT PHOTO OF THE CUSTOMER -> WITH LASTANAME-NAME.JPG
         echo "<div id='profilepic' style='display:inline-block;width:20%;vertical-align: top;' ><img style='max-width: 250px;vertical-align: top;' src='images/customers_photo/" . ($_SESSION['fullname']) . ".jpg' alt='Avatar' class='image' >"; 
    }else{
        echo "<div id='profilepic' style='display:inline-block;width:20%;vertical-align: top;' ><img style='max-width: 250px;vertical-align: top;' src='https://pages.theascent.com/hubfs/add%20authorized%20user.jpg' alt='Avatar' class='image' >"; 
    }
    
    ?>

    </div> <!-- END WHITE BOARD (MAIN PAGE) -->
</div>

        <!---------------------------- UPDATE ------------------------------->
<?php
        // <!-- CODE FOR UPDATE CUSTOMER. IT WILL CREATE A NEW CUSTOMER  AND THE PREVIOUS WITH SAME NAME WILL BE INATIVATE. -->
        if(isset($_POST["updateCustomer"])){

            //Search in DB with name, last name if it`s already there:
            $SQLupdadeFindDBCustomer = 'SELECT * 
                                    FROM customers 
                                    WHERE id = :id 
                                    AND active = 1
                                    LIMIT 1';


            $UndatePlayFindCustomer = $conn->prepare($SQLupdadeFindDBCustomer);
            $UndatePlayFindCustomer->bindParam(':id' , $_POST['id'], PDO::PARAM_INT); 
            $UndatePlayFindCustomer->execute(); //play!

            //if after my sql execute, there is just 1 row:
            if ($UndatePlayFindCustomer->rowCount() == 1) {

                //part PHP to UPDATE--->
                //Update Current customer -> Change status = 0
                $SQLupdateChangeDBCustomer = 'UPDATE customers
                                        SET active = 0
                                        WHERE id = :id                                       
                                        AND active = 1';

                $updateChange = $conn->prepare($SQLupdateChangeDBCustomer);
                $updateChange->bindParam(':id' , $_POST['id'], PDO::PARAM_INT); 
                $updateChange->execute(); //play and UPDATE THE DB!

            //function to UPDATE customer into DATABASE
            insertCustomerDB();
            }  

            //if after my sql execute, there is just 0 row:
            //----CREATE CUSTOMERS!----
            else{
                insertCustomerDB();
            } 
        } //end POST[updateCustomer]

        // <!-- CODE FOR UPDATE CUSTOMER SPECIAL NEEDS. IT WILL CREATE A NEW CUSTOMER AND THE PREVIOUS WITH SAME NAME WILL BE INATIVATE. -->
        if(isset($_POST["updateSpecialNeeds"])){

            //Search in DB with id_customer if it`s already there:
            $SQLupdadeFindDB_Sneeds = 'SELECT * 
                                        FROM special_needs 
                                        WHERE id_Customer = :id_Customer 
                                        AND active = 1
                                        LIMIT 1';

            $UndatePlayFind_Sneeds = $conn->prepare($SQLupdadeFindDB_Sneeds);
            $UndatePlayFind_Sneeds->bindParam(':id_Customer' , $_POST['id_Customer'], PDO::PARAM_INT); 
            $UndatePlayFind_Sneeds->execute(); //play!

            //if after my sql execute, there is just 1 row:
            if ($UndatePlayFind_Sneeds->rowCount() == 1) {
                
                //part PHP to UPDATE--->
                //Update Current Special Needs -> Change status = 0
                $SQLupdateChangeDB_Sneeds = 'UPDATE special_needs
                                        SET active = 0
                                        WHERE id_Customer = :id_Customer
                                        AND active = 1';

                $updateChange_Sneeds = $conn->prepare($SQLupdateChangeDB_Sneeds);
                $updateChange_Sneeds->bindParam(':id_Customer' , $_POST['id_Customer'], PDO::PARAM_INT); 
                $updateChange_Sneeds->execute(); //play and UPDATE THE DB!

                //function to UPDATE SPECIAL NEEDS into DATABASE
                insertspecialNeedsDB();
                }
                
            //if after my sql execute, there is just 0 row:
            //----CREATE CUSTOMERS!----
            else{
                insertspecialNeedsDB();
            }  
        } //end POST[updateCustomer]


        // <!-- CODE FOR UPDATE CUSTOMER ADDRESS. IT WILL CREATE A NEW CUSTOMER AND THE PREVIOUS WITH SAME NAME WILL BE INATIVATE. -->
        if(isset($_POST["updateAddress"])){

            //Search in DB with id_customer if it`s already there:
            $SQLupdadeFindDB_Address = 'SELECT * 
                                        FROM address 
                                        WHERE id_Customer = :id_Customer 
                                        AND active = 1
                                        LIMIT 1';

            $UndatePlayFind_Address = $conn->prepare($SQLupdadeFindDB_Address);
            $UndatePlayFind_Address->bindParam(':id_Customer' , $_POST['id_Address_Customer'], PDO::PARAM_INT); 
            $UndatePlayFind_Address->execute(); //play!

            //if after my sql execute, there is just 1 row:z
            if ($UndatePlayFind_Address->rowCount() == 1) {
                
                //part PHP to UPDATE--->
                //Update Current Special Needs -> Change status = 0
                $SQLupdateChangeDB_Sneeds = 'UPDATE address
                                        SET active = 0
                                        WHERE id_Customer = :id_Customer
                                        AND active = 1';

                $updateChange_Sneeds = $conn->prepare($SQLupdateChangeDB_Sneeds);
                $updateChange_Sneeds->bindParam(':id_Customer' , $_POST['id_Address_Customer'], PDO::PARAM_INT); 
                $updateChange_Sneeds->execute(); //play and UPDATE THE DB!

                //function to UPDATE SPECIAL NEEDS into DATABASE
                insertAddressDB();
                }
                
            //if after my sql execute, there is just 0 row:
            //----CREATE CUSTOMERS!----
            else{
                insertAddressDB();
            }  
        } //end POST[updateCustomer]
?>


<!-- -------------------FUNCTION FOR THE PAGE---------------------- -->
<?php 
//THIS FUNCTIONS IS TO UPDATE AND INSERT THE CUSTOMERS FROM CUSTOMERINFO PAGE TO DATABASE
function insertCustomerDB(){

    //--UPDATE QUERY----
    include "Connection.php";

    $updateSQL = 'INSERT INTO customers (id_fix_customer, name, lastName, RG, CPF, age, birth_date, gender, ap, relationship_status, weight, height, IMC, power_of_Attorney, benefice, health_insurance_id, level_Dependence, death_Date, active) VALUES (:id_fix_customer, :name, :lastName, :RG, :CPF, :age, :birth_date, :gender, :ap, :relationship_status, :weight, :height, :IMC, :power_of_Attorney, :benefice, :health_insurance_id, :level_Dependence, :death_Date, :active)';


    $dataUpdateCustomers = $conn->prepare($updateSQL); //prepair the sql

    //IMC ALREADY CALCULATED TO SEND TO SQL
    $IMCCustomers = $_POST['weight']/2*($_POST['height']/100);


    //--substitute of placeHolder--
    $dataUpdateCustomers->bindParam(':id_fix_customer' ,  $_POST['id_fix_customer'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':name' ,  $_POST['name'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':lastName' , $_POST['lastname'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':RG' ,$_POST['RG'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':CPF' ,$_POST['CPF'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':age' ,$_POST['age'], PDO::PARAM_INT);
    $dataUpdateCustomers->bindParam(':birth_date' , $_POST['birth_date']);
    $dataUpdateCustomers->bindParam(':gender' ,$_POST['gender'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':ap' ,$_POST['ap'], PDO::PARAM_INT);
    $dataUpdateCustomers->bindParam(':relationship_status' , $_POST['relationship_status'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':weight' ,$_POST['weight'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':height' ,$_POST['height'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':IMC' , $IMCCustomers, PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':power_of_Attorney' , $_POST['power_of_Attorney'], PDO::PARAM_BOOL);
    $dataUpdateCustomers->bindParam(':benefice' ,$_POST['benefice'], PDO::PARAM_BOOL);
    $dataUpdateCustomers->bindParam(':health_insurance_id' ,$_POST['health_insurance_id'], PDO::PARAM_INT);
    $dataUpdateCustomers->bindParam(':level_Dependence' ,$_POST['level_Dependence'], PDO::PARAM_BOOL);
    $dataUpdateCustomers->bindParam(':death_Date' ,$_POST['death_Date']);
    $dataUpdateCustomers->bindParam(':active' ,$_POST['activePersonal'], PDO::PARAM_BOOL);
    $dataUpdateCustomers->execute(); //play!

    echo "<strong style='color: green'>Customer Updated!</strong>";
    }

    //THIS FUNCTIONS IS TO UPDATE AND INSERT THE CUSTOMERS FROM CUSTOMERINFO PAGE TO DATABASE
function insertspecialNeedsDB(){

    //--UPDATE QUERY----
    include "Connection.php";

    $updateSQL = 'INSERT INTO special_needs (id_Customer, disease, allergy, use_Diaper, eat_Alone, heel_Chair, Tracheostomized, Decubitus_ulcer, gastric_tube, tube_Naso, Diabetic, use_insuline) VALUES (:id_Customer, :disease, :allergy, :use_Diaper, :eat_Alone, :heel_Chair, :Tracheostomized, :Decubitus_ulcer, :gastric_tube, :tube_Naso, :Diabetic, :use_insuline)';

    $dataUpdateCustomers = $conn->prepare($updateSQL); //prepair the sql

    //--substitute of placeHolder--
    $dataUpdateCustomers->bindParam(':id_Customer' ,  $_POST['id_Customer'], PDO::PARAM_INT);
    $dataUpdateCustomers->bindParam(':disease' , $_POST['disease'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':allergy' ,$_POST['allergy'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':use_Diaper' ,$_POST['use_Diaper'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':eat_Alone' ,$_POST['eat_Alone'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':heel_Chair' , $_POST['heel_Chair'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':Tracheostomized' ,$_POST['Tracheostomized'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':Decubitus_ulcer' ,$_POST['Decubitus_ulcer'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':gastric_tube' , $_POST['gastric_tube'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':tube_Naso' ,$_POST['tube_Naso'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':Diabetic' ,$_POST['Diabetic'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':use_insuline' , $_POST['use_insuline'], PDO::PARAM_STR);
    $dataUpdateCustomers->execute(); //play!

    echo "<strong style='color: green'>Special Needs Updated!</strong>";
    }


     //THIS FUNCTIONS IS TO UPDATE AND INSERT THE CUSTOMERS FROM CUSTOMERINFO PAGE TO DATABASE
function insertAddressDB(){

    //--UPDATE QUERY----
    include "Connection.php";

    $updateSQL = 'INSERT INTO address (id_Customer, country, state, address, numberAddress, CEP, reference) VALUES (:id_Customer, :country, :state, :address, :numberAddress, :CEP, :reference)';

    $dataUpdateCustomers = $conn->prepare($updateSQL); //prepair the sql

    //--substitute of placeHolder--
    $dataUpdateCustomers->bindParam(':id_Customer' ,  $_POST['id_Address_Customer'], PDO::PARAM_INT);
    $dataUpdateCustomers->bindParam(':country' , $_POST['country'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':state' ,$_POST['state'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':address' ,$_POST['address'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':numberAddress' ,$_POST['numberAddress'], PDO::PARAM_STR);
    $dataUpdateCustomers->bindParam(':CEP' ,$_POST['CEP'], PDO::PARAM_INT);
    $dataUpdateCustomers->bindParam(':reference' , $_POST['reference'], PDO::PARAM_STR);
    $dataUpdateCustomers->execute(); //play!

    echo "<strong style='color: green'>Address Updated!</strong>";
    }
 ?>
 </body>
 <?php
    include "footer.php";
?>
 