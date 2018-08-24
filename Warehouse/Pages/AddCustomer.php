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
            <script src="../WarehouseResources/Javascript/AddCustomerJS.js"></script>
            <link rel="stylesheet" href="../WarehouseResources/Style/AddCustomer.css">
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
            <meta charset="UTF-8">
            <title>

            </title>
        </head>
        <body>
            <div id="container">
                <div class="titulo">Add Customer</div>
                <form id="newCustomer" onsubmit='return RevisarInfo();'>
                    <div class="plaecHolder">Name
                    </div>
                    <div class="entrada">
                        <input type='text' class='unico' id='Name' required>
                    </div>
                    <div class="plaecHolder">Short Name
                    </div>
                    <div class="entrada">
                        <input type='text' class='unico' style='width: 35% !important;' id='Short' required>
                    </div>
                    <div class="plaecHolder">Short Description
                    </div>
                    <div class="entrada">
                        <input type='text' class='unico' id='Desc'>
                    </div>
                    <div class="plaecHolder">Attribute 1
                    </div>
                    <div class="entrada">
                        <input type='text' class='atribute' id='At1' required><input type='checkbox' id='At1Check' class='checkes'><span class="checkmark"></span>
                    </div>
                    <div class="plaecHolder">Attribute 2
                    </div>
                    <div class="entrada">
                        <input type='text' class='atribute' id='At2' onkeyup="Revisar(this.id, 'At2Check');"><input type='checkbox' disabled id='At2Check' class='checkes'><span class="checkmark"></span>
                    </div>
                    <div class="plaecHolder">Attribute 3
                    </div>
                    <div class="entrada">
                        <input type='text' class='atribute' id='At3' onkeyup="Revisar(this.id, 'At3Check');"><input type='checkbox' disabled id='At3Check' class='checkes'><span class="checkmark"></span>
                    </div>
                    <div class="plaecHolder">Includes label?
                    </div>
                    <div class="entrada">
                        <select id='includes' class='unico' style='width:  15% !important;'>
                            <option value='yes'>YES</option>
                            <option value='no'>NO</option>
                        </select>
                    </div>
                    <div class="entrada">
                        <input type='submit' value='Submit' id='submittir'>
                    </div>
                </form>
            </div>
        </body>
    </html>
    <?php
}else{
     header("Location: http://localhost/LeRP/index.php");
}
