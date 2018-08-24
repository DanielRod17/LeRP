/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function RevisarInfo(){
    var Name =      document.getElementById("Name").value;
    var Short =     document.getElementById('Short').value;
    var At1 =       document.getElementById('At1').value;
    var At2 =       document.getElementById('At2').value;
    var At3 =       document.getElementById('At3').value;
    var Desc =      document.getElementById('Desc').value;
    var Fix1 =      document.getElementById('At1Check').checked;
    var Fix2 =      document.getElementById('At2Check').checked;
    var Fix3 =      document.getElementById('At3Check').checked;
    var Labels =    document.getElementById('includes').options[document.getElementById('includes').selectedIndex].innerHTML;
    //alert (Name + " " + cName + " " + Short + " " + At1);
    if(Name == '' || Short == '' || At1 == ''){
        alert("Fields are missing");
    }else{
        $.ajax({ //PERFORM AN AJAX CALL
            type:                   'post',
            url:                    "../WarehouseResources/AJAXResponses/CustomerAJAX.php", //PHP CONTAINING ALL THE FUNCTIONS
            data:                   {Alta: '1', Name: Name, Short: Short, At1: At1, At2: At2, At3: At3, Fix1: Fix1, Fix2: Fix2, Fix3: Fix3, Desc: Desc, Labels: Labels}, //SEND THE VALUE TO EXECUTE A QUERY WITH THE PALLET ID
            success:                function(data) { //IF THE REQUEST ITS SUCCESSFUL
                alert(data);
            }
        });
    }
    return false;
}
function Revisar(e, id){
    var check = document.getElementById(e);
    //alert(check.value);
    if (check.value == ""){
        document.getElementById(id).click();
        document.getElementById(id).disabled = true;
    }else{
        document.getElementById(id).disabled = false;
    }
}
