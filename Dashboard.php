<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
//echo $_SESSION['dataBase']. " ". $_SESSION['loggedin']. " ". $_SESSION['userID']. " ". $_SESSION['userName'];
$IDUsuario =            $_SESSION['userID'];
$UserName =             $_SESSION['userName'];
$dataBase =             "companydb_".$_SESSION['dataBase'];
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
?>
    <html>
        <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="Resources/Javascript/DashboardJS.js"></script>
            <link rel="stylesheet" href="Resources/Style/Dashboard_Layout.css">
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Cairo" rel="stylesheet">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
            <meta charset="UTF-8">
            <title></title>
        </head>
        <body onscroll="DetectScroll();" onload=" DetectScroll();">
            <div id="contenedor">
                <div id="menu">
                    <div id="logo">
                        <div id="collapse" onclick="Collapse();">&nbsp;<i class="fas fa-angle-left fa-2x"></i></div>
                        <img id="logoIMG" src="Resources/Images/LogPro2.png"/>
                    </div>
                    <div id="informacion">
                        <div id="opciones">
                            <div class="opcion" onclick="LoadDashboard();">Dashboard</div>
                            <div class="opcion" onclick="LoadWarehouse()">Warehouse</div>
                            <div class="opcion">Transports</div>
                            <div class="opcion">Yard</div>
                            <div class="opcion">Accountability</div>
                            <div class="opcion">Customs</div>
                        </div>
                    </div>
                </div>
                <div id="contenido">
                    <div id="topOptions">
                        <div class="userOptions" id="opc1">
                            Opción 1
                        </div>
                        <div class="userOptions">
                            Opción 2
                        </div>
                        <div class="userOptions">
                            Opción 3
                        </div>
                        <div id="user">
                            <div id="profilepic">
                                <?php
                                    foreach (glob("./Resources/Images/UserPic/$IDUsuario.*") as $filename) {
                                        echo "<img style='width: 100%; height: 100%; border-radius: 50px;' src='$filename'>";
                                    }
                                ?>
                            </div>
                            <div id="infoUsuario">
                                <?php
                                    echo "<a href='#'>$UserName</a>";
                                ?>
                                <br>
                                <button id="logout" onclick="Logout();">Logout</button>
                            </div>
                        </div>
                    </div>
                    <iframe id="load" onload="iframeLoaded();" scrolling='no'>

                    </iframe>
                </div>
            </div>
            <div id="TopButton" onclick="ScrolltoTop();">
                &nbsp;<i class="fas fa-chevron-up"></i>
            </div>
            <div id="modal">
                <div id="modalContent">
                    <div id='top'>
                        <div id="close">
                            <i class="fas fa-plus rotate"></i>
                        </div>
                    </div>
                    <div id='content'></div>
                </div>
            </div>
        </body>
    </html>
<?php
}else{
    header("Location: http://localhost/LeRP/index.php");
}
?>
