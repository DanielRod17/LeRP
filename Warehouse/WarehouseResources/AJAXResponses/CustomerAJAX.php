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
    if(isset($_POST['Alta'])){
        $Name =             $_POST['Name'];
        $Short =            $_POST['Short'];
        $At1 =              $_POST['At1'];
        $At2 =              $_POST['At2'];
        $At3 =              $_POST['At3'];
        $Fix1 =             (int)$_POST['Fix1'];
        $Fix2 =             (int)$_POST['Fix2'];
        $Fix3 =             (int)['Fix3'];
        $Desc =             $_POST['Desc'];
        $Labels =           $_POST['Labels'];
        if($Labels == 'YES')
            $Labels =         1;
        else
            $Labels =         0;
        $stmt =             $connection->prepare("SELECT ID FROM customers WHERE Customer=?");
        $stmt ->            bind_param('s', $Name);
        $stmt ->            execute();
        $stmt ->            store_result();
        if($stmt -> num_rows > 0){
            echo "Name already registered";
        }else{
            $stmt ->          close();
            $search =         $connection->prepare("SELECT ID FROM customers WHERE ShortCustomer=?");
            $search ->        bind_param('s', $Short);
            $search ->        execute();
            $search ->        store_result();
            if($search -> num_rows > 0){
                echo "Short name already registered";
            }else{
                $search ->        close();
                $queryID =        $connection->query("SELECT ID FROM customers ORDER BY ID DESC Limit 1");
                $queryID =        $queryID->fetch_object();
                $ID =             $queryID->ID;
                $ID =             $ID+1;
                $insertar =       $connection->prepare("INSERT INTO customers (ID, Customer, ShortCustomer, Active, Description, Att1, Att2, Att3, VMI, Fixed1, Fixed2, Fixed3, Crosscheck) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insertar ->      bind_param('ississssiiiii', $I, $Cus, $Shor, $Act, $Pref, $Att1, $Att2, $Att3, $Lab, $F1, $F2, $F3, $Cro);
                $I =              $ID;
                $Cus =            $Name;
                $Shor =           $Short;
                $Act =            1;
                $Pref =           $Desc;
                $Att1 =           $At1;
                $Att2 =           $At2;
                $Att3 =           $At3;
                $Lab =            $Labels;
                $F1 =             $Fix1;
                $F2 =             $Fix2;
                $F3 =             $Fix3;
                $Cro =            '0';
                $insertar ->      execute();
                $insertar ->      close();
                echo "Customer added";
            }
        }
    }
}else{
    echo "FORBIDDEN";
}
