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
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
            <script src="../WarehouseResources/Javascript/ManageCustomersJS.js"></script>
            <link rel="stylesheet" href="../WarehouseResources/Style/ManageCustomers.css">
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo|Oswald" rel="stylesheet">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
            <meta charset="UTF-8">
            <title>

            </title>
        </head>
        <body>
            <div id="container">
                <div class="titulo">Manage Customers</div>
                <div id="tabla">
                    <div class='teerre' style='background-color: black!important; color: white !important;'><div class='conf nombre'>Name</div><div class='conf description' style='font-size: 2vw !important;'>Description</div><div class='conf labels'>Labels</div><div class='conf Date'>Added</div><div class='conf Update'>Update</div></div>
                    <?php
                        $query =          $connection->query("SELECT * FROM customers ORDER BY Customer ASC");
                        while($row =  $query->fetch_array()){
                            $ID =             $row['ID'];
                            $Name =           $row['Customer'];
                            $Description =    $row['Description'];
                            $Includes =       $row['VMI'];
                            $DateAdd =        $row['Added'];
                            $DateAdd =        substr($DateAdd, 0, 10);
                            echo "<div class='teerre'><div class='conf nombre'>$Name</div><div class='conf description'>$Description</div><div class='conf labels'>$Includes</div><div class='conf Date'>$DateAdd</div><div class='conf Update' id='$ID'>&nbsp;<i class='far fa-edit fa-lg'></i></div></div>";
                        }
                    ?>
                </div>
            </div>
        </body>
    </html>
    <?php
  }else{
     header("Location: http://localhost/LeRP/index.php");
  }
