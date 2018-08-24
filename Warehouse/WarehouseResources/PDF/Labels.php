<?php
//require('../FPDF/code128.php'); //library to generate the barcodes
require('../../../Resources/FPDF/code128.php');
 if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$dataBase =             "companydb_".$_SESSION['dataBase'];
$connection =           mysqli_connect("localhost", "root", "peloncio1234.", "$dataBase");
if(isset($_GET['Cliente']) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){//Gets the day from the server's date. Reduces (in seconds) the time to fit to the current timezone.
    $qty =                      $_GET['Qty'];
    $cliente =                  $_GET['Cliente'];
    $sn =                       $_SESSION['userName'];
    $kind =                     $_GET['Type'];
    $year =                     date('Y',time()-60*60*0); //Gets the year from the server's date. Reduces (in seconds) the time to fit to the current timezone.
    $year =                     substr($year, 2, 4);
    $month =                    date('m',time()-60*60*0); //Gets the month from the server's date. Reduces (in seconds) the time to fit to the current timezone.
    $day =                      date('d',time()-60*60*0);  
    $timestamp =                date("Y-m-d H:i:s",time()-60*60*0); //Gets a timestamp from the server's date, including year, month, day, hour, minutes and seconds.
    $identifier =               $year.$month.$day; 
    if($kind == "Box")
    {
        $firstIdentifier =          "B".$identifier; //This identifier will be used only when the DataBase is empty to create the first record in it.
        $sel =                      $connection->query("SELECT Id AS max_Id, Id FROM etiquetas ORDER BY Id DESC LIMIT 1"); //The MAX Id in the table it's selected. It can be any number, ranging from 1 to the last record. Only the first one is created in the previous query.
        if($sel -> num_rows > 0){
            $sel_row =                  $sel->fetch_object(); //The row retreived from the Query it's then stored in an object variable.
            $maxId =                    $sel_row->Id; //Selects the ID from the row selected and stores it in a new variable called maxId.
            $nextId =                   $maxId+1; //Adds 1 to the value of the maxId and stores it in the variable nextId.
        }else{
            $nextId =                   1;
        }
        $IdSelect =                 $connection->query("SELECT Caja AS max_Caja, Caja FROM etiquetas WHERE DATE(Fecha)=DATE(NOW()) ORDER BY Caja DESC LIMIT 1;"); //This query selects the max (and last) Batch processed.
        $SelectedRow =              $IdSelect->fetch_object(); //The row retreived from the Query it's then stored in an object variable. 
        if($IdSelect -> num_rows == 0){
            $LastId =                   0;
        }
        else{
            $LastId =                   $SelectedRow->Caja; //Selects the Batch number from the row selected and stores it in a new variable called LastBox.
        }
        $ProxId =                   $LastId+1;
        ////////////////////////////////////////////
        $sel =                      $connection->query("SELECT Id AS max_Id, Id FROM tempEtiquetas ORDER BY Id DESC LIMIT 1"); //The MAX Id in the table it's selected. It can be any number, ranging from 1 to the last record. Only the first one is created in the previous query.
        if($sel -> num_rows > 0){
            $sel_row =                  $sel->fetch_object(); //The row retreived from the Query it's then stored in an object variable.
            $maxIdT =                   $sel_row->Id; //Selects the ID from the row selected and stores it in a new variable called maxId.
            $nextIdT =                  $maxIdT+1; //Adds 1 to the value of the maxId and stores it in the variable nextId.
        }else{
            $nextIdT =                  1;
        }
        $IdSelect =                 $connection->query("SELECT Caja AS max_Caja, Caja FROM tempEtiquetas WHERE DATE(Fecha)=DATE(NOW()) ORDER BY Caja DESC LIMIT 1;"); //This query selects the max (and last) Batch processed.
        $SelectedRow =              $IdSelect->fetch_object(); //The row retreived from the Query it's then stored in an object variable. 
        if($IdSelect -> num_rows == 0){
            $LastIdT =                   0;
        }
        else{
            $LastIdT =                   $SelectedRow->Caja; //Selects the Batch number from the row selected and stores it in a new variable called LastBox.
        }
        $ProxIdT =                   $LastIdT+1;
        if($nextIdT > $nextId){
            $nextId =                   $nextIdT;
        }
        if($ProxIdT > $ProxId){
            $ProxId =                   $ProxIdT;
        }
        ////////////////////////////////////////////
        $DateSelect =               $connection->query("SELECT Fecha AS max_Fecha, Fecha FROM etiquetas ORDER BY Fecha DESC LIMIT 1;"); //This query selects the last (newest) date processed.
        if($DateSelect -> num_rows > 0){
            $DateRow =                  $DateSelect->fetch_object(); //The row retreived from the Query it's then stored in an object variable.
            $Date =                     $DateRow->Fecha; //Selects the date from the row selected and stores it in a new variable called Date.
        }else{
            $Date =                     date("Y-m-d H:i:s",time()-60*60*0);
        }
        $value =                    $ProxId;
        for( $x = 0; $x < $qty; $x++){
            $digit =                    $LastId+$x+1;
            $finalIdentifier =          $firstIdentifier."-".$value; //the identifier to be put in the database it's concatenated with four 0s.
            $query1 =                   "INSERT INTO etiquetas (Id, Cantidad, Cliente, Fecha, Caja, Identificador, User)
                                        VALUES ('$nextId', '$qty', '$cliente', '$timestamp', '$value', '$finalIdentifier', '$sn');"; //Query that inserts the new data, withe the nextId and the finalIdentifier in the database.
            $executeQuery1 =            mysqli_query($connection,$query1); //Executes the query.
            $a1[$x] =                   $finalIdentifier;
            $nextId++;
            $value++;
            $digit =                    0;
        }
    } ///////////PALLETS
    /////////////I LIKE IT
    else{ //This variable concatenate the first three values that will be used and printed in the Batch ID.
        $firstIdentifier =          "P".$identifier; //This identifier will be used only when the DataBase is empty to create the first record in it.
        $sel =                      $connection->query("SELECT ID FROM pallets ORDER BY ID DESC LIMIT 1"); //The MAX Id in the table it's selected. It can be any number, ranging from 1 to the last record. Only the first one is created in the previous query.
        if($sel -> num_rows > 0){
            $sel_row =                  $sel->fetch_object(); //The row retreived from the Query it's then stored in an object variable.
            $maxId =                    $sel_row->ID; //Selects the ID from the row selected and stores it in a new variable called maxId.
            $nextId =                   $maxId+1; //Adds 1 to the value of the maxId and stores it in the variable nextId.
        }else{
            $nextId =                   1;
        }
        $IdSelect =                 $connection->query("SELECT Dailycount FROM pallets WHERE DATE(Timestamp)=DATE(NOW()) ORDER BY Dailycount DESC LIMIT 1;"); //This query selects the max (and last) Batch processed.
        $SelectedRow =              $IdSelect->fetch_object(); //The row retreived from the Query it's then stored in an object variable. 
        if($IdSelect -> num_rows == 0){
            $LastId=                    0;
        }
        else{
            $LastId =                   $SelectedRow->Dailycount; //Selects the Batch number from the row selected and stores it in a new variable called LastBox.
        }
        $ProxId =                   $LastId+1;
        //////////////////////////////
        //$nextId  $LastId
        $sel =                      $connection->query("SELECT ID FROM temp ORDER BY ID DESC LIMIT 1"); //The MAX Id in the table it's selected. It can be any number, ranging from 1 to the last record. Only the first one is created in the previous query.
        $sel_row =                  $sel->fetch_object(); //The row retreived from the Query it's then stored in an object variable.
        $maxIdT =                   $sel_row->ID; //Selects the ID from the row selected and stores it in a new variable called maxId.
        $nextIdT =                  $maxIdT+1; //Adds 1 to the value of the maxId and stores it in the variable nextId.
        $IdSelect =                 $connection->query("SELECT Dailycount FROM temp WHERE DATE(Timestamp)=DATE(NOW()) ORDER BY Dailycount DESC LIMIT 1;"); //This query selects the max (and last) Batch processed.
        $SelectedRow =              $IdSelect->fetch_object(); //The row retreived from the Query it's then stored in an object variable. 
        if($IdSelect -> num_rows == 0){
            $LastIdT=                    0;
        }
        else{
            $LastIdT =                   $SelectedRow->Dailycount; //Selects the Batch number from the row selected and stores it in a new variable called LastBox.
        }
        $ProxIdT =                   $LastIdT+1;
        if($nextIdT > $nextId){
            $nextId =                   $nextIdT;
        }
        if($ProxIdT > $ProxId){
            $ProxId =                   $ProxIdT;
        }
        /////////////////////
        ////////////////////////////////
        $value =                    $ProxId;
        for($x = 0 ; $x < $qty ; $x++){
            $digit =                $LastId+$x+1;
            $finalIdentifier =      $firstIdentifier."-".$value; //the identifier to be put in the database it's concatenated with four 0s.
            $query1 =               "INSERT INTO temp (ID, Customer, Timestamp, Dailycount, PalletID, Usuario, Queued)
                                    VALUES ('$nextId', '$cliente', '$timestamp', '$value', '$finalIdentifier', '$sn', '0');"; //Query that inserts the new data, withe the nextId and the finalIdentifier in the database.
            $executeQuery1 =        mysqli_query($connection,$query1); //Executes the query.
            $a1[$x] =               $finalIdentifier;
            $nextId++;
            $value++;
            $digit =                    0;
        }
    }
}else{
    echo "FORBIDDEN";
}
GenerateLabels($cliente, $a1);

function GenerateLabels($cliente , $a1){
    $cmpName =      $_SESSION['cmpName'];
    $pdf =          new PDF_Code128('L','mm',array(35,88)); //Creates a pdf file in Landscape position, with a size of 35x88 milimmeters
    $pdf ->         SetAutoPageBreak(false); //Prevents bottom borders
    $pdf ->         SetFont('Arial','',7);
    foreach($a1 as $code){
        $pdf ->         AddPage();
        $pdf ->         Code128(7,8,$code,75,14);
        $pdf ->         SetY(5);
        $pdf ->         SetX(7);
        $pdf ->         SetFont('Arial','',10);
        $pdf ->         Cell(0,0, $cmpName ,0,0,'C');
        $pdf ->         SetY(10);
        $pdf ->         SetFont('Arial','B',15);
        $pdf ->         SetX(3);
        $pdf ->         SetY(26);
        $pdf ->         Cell(0,0,$code,0,0,'C');
        $pdf ->         SetFont('Arial','B',8);
        $pdf ->         SetX(3);
        $pdf ->         SetY(31);
        $pdf ->         Cell(0,0,$cliente,0,0,'C');
    }
    $pdf->Output();
}
?>