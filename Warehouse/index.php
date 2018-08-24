<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    ?>
    <html>
        <head>
            <script src="WarehouseResources/Javascript/IndexJS.js"></script>
            <link rel="stylesheet" href="WarehouseResources/Style/EstiloGeneral.css">
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
            <meta charset="UTF-8">
            <title>
            </title>
        </head>
        <body>
        <div id="containerWHS">
            <div id="opcionesWHS">
                <div class="opcionWHS" onclick="reload('1');">
                    <span class="spanner"><i class="fas fa-indent"></i></span>
                    <div class="textOpc">
                        GENERATE<br> LABELS
                    </div>
                </div>
                <div class="opcionWHS" onclick="reload('2');">
                    <span class="spanner"><i class="fas fa-user-plus"></i></span>
                    <div class="textOpc">
                        ADD <br>CUSTOMER
                    </div>
                </div>
                <div class="opcionWHS" onclick="reload('3');">
                    <span class="spanner"><i class="fas fa-user-friends"></i></span>
                    <div class="textOpc">
                        MANAGE <br>CUSTOMERS
                    </div>
                </div>
                <div class="opcionWHS">
                    <span class="spanner"><i class="fas fa-print"></i></span>
                    <div class="textOpc">
                        VIEW & PRINT
                    </div>
                </div>
                <div class="opcionWHS">
                    <span class="spanner"><i class="fas fa-barcode"></i></span>
                    <div class="textOpc">
                        SCAN<br> LABELS
                    </div>
                </div>
                <div class="opcionWHS" >
                    <span class="spanner"><i class="fas fa-check-circle"></i></span>
                    <div class="textOpc">
                        CROSSCHECK
                    </div>
                </div>
                <div class="opcionWHS">
                    <span class="spanner"><i class="far fa-list-alt"></i></span>
                    <div class="textOpc">
                        MANAGE<br> LABELS
                    </div>
                </div>
                <div class="opcionWHS">
                    <span class="spanner"><i class="fas fa-chart-pie"></i></span>
                    <div class="textOpc">
                        REPORTS
                    </div>
                </div>
            </div>
        </div>
        </body>
    </html>
    <?php
}else{
    header("Location: http://localhost/LeRP/index.php");
}
?>
