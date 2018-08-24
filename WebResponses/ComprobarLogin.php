<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(isset($_POST['usuario'])){
    $connection=            mysqli_connect("localhost", "root", "peloncio1234.", "lerp_usuarios");
    $usuario =              $_POST['usuario'];
    $password =             $_POST['contra'];
    $sID =                  session_id();
    //echo $usuario." ".$password;
    $stmt =                 $connection->prepare("SELECT ID, CompanyDB, CompanyName FROM Usuarios WHERE Username=? AND password=?");
    $stmt ->                bind_param("ss", $usuario, $password);
    $stmt ->                execute();
    $stmt ->                store_result();
    if ($stmt->num_rows!=0){
        $stmt ->                bind_result($ID, $companyDB, $cmpName);
        $stmt ->                fetch();
        $query =                $connection->query("UPDATE Usuarios SET LastLogin=NOW(), SessionID='$sID' WHERE ID='$ID'");
        $_SESSION['cmpName'] =  $cmpName;
        $_SESSION['dataBase'] = $companyDB;
        $_SESSION['loggedin'] = true;
        $_SESSION['userID'] =   $ID;
        $_SESSION['userName'] = $usuario;
        echo $companyDB;
        //$arr =                  array('A' => $a, 'B' => $b);
        //array_push($return,$arr);
        //echo json_encode($return);
    }
    else{
        echo    "Wrong Credentials";
    }
    $stmt->                 close();          
}

