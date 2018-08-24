<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$dataBase =             "companydb_".$_SESSION['dataBase'];
$connection =           mysqli_connect("localhost", "root", "peloncio1234.", "$dataBase");
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    ?>
    <html>
        <head>
            <script src="../WarehouseResources/Javascript/GenerateLabelsJS.js"></script>
            <link rel="stylesheet" href="../WarehouseResources/Style/GenerateLabels.css">
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
            <meta charset="UTF-8">
            <title></title>
        </head>
        <body>
            <div id="container">
                <div id="formulario">
                    <div class="titulo">GENERATE LABELS</div>
                    <form id="etiquetas" onsubmit="return checkLabelRequest();">
                        <div class="formita arriba">
                            Select Customer
                        </div>
                        <div class="formita">
                            <select class="abajo" id="customer">
                                <?php
                                    $query =                $connection->query("SELECT ID, Customer FROM customers ORDER BY Customer ASC");
                                    while($row = $query->fetch_array()){
                                        $id =           $row['ID'];
                                        $customer =     $row['Customer'];
                                        echo "<option value = '$id'>$customer</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="formita arriba">
                            Select Type
                        </div>
                        <div class="formita">
                            <select class="abajo" id="type">
                                <option value="0">Box</option>
                                <option value="1">Pallet</option>
                            </select>
                        </div>
                        <div class="formita arriba">
                            Select Type
                        </div>
                        <div class="formita">
                            <input class="abajo" id="Qty" type="number" min="1" max="50" required>
                        </div>
                        <div class="formita">
                            <input type="submit" class="botonSubmit"  value="Submit">
                        </div>
                    </form>
                </div>
                <div id="resultado">
                    <iframe id="frameLabel" frameborder="0">
                    </iframe></center>
                </div>
            </div>
        </body>
    </html>
<?php
}else{
    header("Location: http://localhost/LeRP/index.php");
}