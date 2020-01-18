<?php
    include "header.php";
    include_once 'ViewDataTable_Prescription.php';
?>

        <!-- https://cdnjs.com/libraries/jquery/1.9.0 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sc-2.0.1/sl-1.3.1/datatables.min.css"/>
    <style type="text/css">
        #myTablePres_wrapper{
            padding: 20px;
        }
             
        
    </style>

    
<body style="background-color: #ededed;">

    <!-- Title - ALL CUSTOMERS -  -->
    <div class="title-style">
      <fieldset class="box-title"> 
        <legend>Prescription</legend>
      </fieldset>
    </div>

<!-- WITHBORDER CONTAINS ALL ROWS WITH THE CARD/PROFILE -->
    <div class="withborder">

    
        <table id="myTablePres" class="display nowrap" >
            <thead>
                <tr>
                    <th>id</th>
                    <th>id Customer</th>
                    <th>Name</th>   
                    <th>Medicine</th>
                    <th>Dose</th>
                    <th>Mesuremment</th>
                    <th>medicine Prescription</th>
                    <th>Posology</th>
                    <th>Week Day</th>
                    <th>Time</th>
                    <th>Way to take it</th>
                    <th>Usage till</th>
                    <th>Orientation</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            <?php
            //data has the query now
            $SQLDataPrescription = $conn->query("SELECT
                                                prescricao_base.id AS id,
                                                prescricao_base.id_Customer AS id_Customer,
                                                CONCAT(customers.name, ' ', customers.lastName) AS name,
                                                prescricao_base.medicine AS medicine,
                                                prescricao_base.Dose AS Dose,
                                                prescricao_base.mesuremment AS mesuremment,
                                                prescricao_base.medicine_Presentation AS medicine_Presentation,
                                                prescricao_base.Posologia AS Posologia,
                                                prescricao_base.qtdy_week AS qtdy_week,
                                                prescricao_base.data_time AS data_time,
                                                prescricao_base.way_takeit AS way_takeit,
                                                prescricao_base.usage_till AS usage_till,
                                                prescricao_base.orientation AS orientation,
                                                prescricao_base.created_at  AS created_at
                                                FROM prescricao_base
                                                JOIN customers
                                                ON  prescricao_base.id_Customer = customers.id_fix_customer
                                                WHERE prescricao_base.active = 1
                                                AND customers.active = 1");
            $PrescriptionFetch = $SQLDataPrescription->fetchAll(PDO::FETCH_ASSOC);
            //$order = the value inside the table
            //$key = index for each row (each row is an array)
            foreach ($PrescriptionFetch as $key => $order) {
                echo "<tr>
                        <td>" . $order['id'] . "</td>
                        <td>" . $order['id_Customer'] . "</td>
                        <td>" . $order['name'] . "</td>
                        <td>" . $order['medicine'] . "</td>
                        <td>" . $order['Dose'] . "</td>
                        <td>" . $order['mesuremment'] . "</td>
                        <td>" . $order['medicine_Presentation'] . "</td>
                        <td>" . $order['Posologia'] . "</td>
                        <td>" . $order['qtdy_week'] . "</td>
                        <td>" . $order['data_time'] . "</td>
                        <td>" . $order['way_takeit'] . "</td>
                        <td>" . $order['usage_till'] . "</td>
                        <td>" . $order['orientation'] . "</td>
                        <td>" . $order['created_at'] . "</td>
                        <td>
                            <a href='DataTable_Prescription.php?edit=" . $order['id'] ."' class='btn btn-info'>edit</a>
                            <a href='DataTable_Prescription.php?delete=" . $order['id'] ."' class='btn btn-danger' OnClick=\"return confirm('Are you sure you want to DELETE this Prescription?');\" >delete</a>
                        </td>
                    </tr>";
            }
            ?>
            </tbody>
        </table> <!-- FINAL VIEW TABLE -->

        <!------- FORM TO ADD, CHANGE AND DELETE ALL THE INFORMATION INSIDE DB PRESCRIPTION ------>
        <form action="#" method="POST" style="display: inline-block;width: 100%;padding-top: 30px;padding-left: 75px;">

            <div class="form-group"> 
                <label>id Customer</label>      
                <input type="text" name="id_Customer" class="form-control" value = "<?php echo $idCustomerBlank ?>">
            </div>

            <div class="form-group"> 
                <label>Name</label>      
                <input type="text" name="name" class="form-control" readonly value="<?php echo $NameBlank ?>">
            </div>

            <div class="form-group">
                <label>medicine</label> 
                <input type="text" name="medicine" class="form-control" value="<?php echo $MedicineBlank?>">
            </div>

            <div class="form-group">
                <label>Dose</label> 
                <input type="number" min="0" name="Dose" class="form-control" value="<?php echo $DoseBlank ?>">
            </div>

            <div class="form-group">
                <label>mesuremment</label> 
                <select name="mesuremment" class="form-control">
                    <option value='ml' <?php if($MesuremmentBlank == 'ml') echo "selected"?>> ml </option>
                    <option value= 'gotas' <?php if($MesuremmentBlank == 'gotas') echo "selected"?>> gotas </option>
                    <option value= 'mg' <?php if($MesuremmentBlank == 'mg') echo "selected"?>> mg </option>
                    <option value= 'ui' <?php if($MesuremmentBlank == 'ui') echo "selected"?>> ui </option>
                </select>
            </div>

            <div class="form-group">
                <label>medicine_Presentation</label> 
                <select name="medicine_Presentation" class="form-control">
                    <option value= 'Comprimido' <?php if($medicinePrescriptionBlank == 'Comprimido') echo "selected"?>> Comprimido </option>
                    <option value= 'Sache' <?php if($medicinePrescriptionBlank == 'Sache') echo "selected"?>> Sache </option>
                    <option value= 'Medida' <?php if($medicinePrescriptionBlank == 'Medida') echo "selected"?>> Medida </option>
                    <option value= 'Gota' <?php if($medicinePrescriptionBlank == 'Gota') echo "selected"?>> Gota </option>
                    <option value= 'Creme' <?php if($medicinePrescriptionBlank == 'Creme') echo "selected"?>> Creme </option>
                    <option value= 'Adesivo' <?php if($medicinePrescriptionBlank == 'Adesivo') echo "selected"?>> Adesivo </option>
                </select>
            </div>

            <div class="form-group">
                <label>Posologia</label> 
                <input name="Posologia" type="number" min="0.1" max="1" step="0.1" id="myPercent" value="<?php echo $PosologyBlank?>">
            </div>

            <div class="form-group">
                <label>qtdy_week</label> 
                <input name="qtdy_week" type="number" min="0" max="1234567" class="form-control" value="<?php echo $WeekDayBlank ?>">
            </div>

            <div class="form-group">
                <label>data_time</label> 
                <input name="data_time" type="Time" class="form-control" value="<?php echo $TimeBlank ?>">
            </div>

            <div class="form-group">
                <label>way_takeit</label> 
                <select name="way_takeit" class="form-control">
                    <option value= 'ORAL' <?php if($WaytotakeitBlank == 1) echo "selected"?>> ORAL </option>
                    <option value= 'SUBLINGUAL' <?php if($WaytotakeitBlank == 0) echo "selected"?>> SUBLINGUAL </option>
                    <option value= 'TOPICO' <?php if($WaytotakeitBlank == 1) echo "selected"?>> TOPICO </option>
                </select>
            </div>

            <div class="form-group">
                <label>usage_till</label> 
                <input name="usage_till" type="text" class="form-control" value="<?php echo $UsagetillBlank ?>">
            </div>

            <div class="form-group"> 
                <label>orientation</label>      
                <input type="text" name="orientation" class="form-control" value="<?php echo $OrientationBlank ?>">
            </div>

            <div class="form-group">
                
                <!-- BUTTON IN THE END. NEW PRESCRIPTION? = SAVE | EDIT PRESCRIPTION? = UPDATE -->
                <?php if($updateBtn == true) : ?>
                    <button type="submit" class="btn btn-info" name="update" onClick="return confirm('Are you sure you want to UPDATE this Prescription?');">Update</button>
                <?php else : ?>
                    <button type="submit" class="btn btn-primary" name="save" onClick="return confirm('Are you sure you want to SAVE this Prescription?');">Save</button>
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
    <script type="text/javascript">
 $('#myTablePres').DataTable( {
    "scrollX": true,
    select: true,
    colReorder: true,
    autoFill: true,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );
    //work with percent in my imput
    document.getElementById('myForm').onsubmit = function() {
        var valInDecimals = document.getElementById('myPercent').value / 100;
    }
    </script>