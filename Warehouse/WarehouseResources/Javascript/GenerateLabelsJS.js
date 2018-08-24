/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function checkLabelRequest(){
    var cliente =       document.getElementById('customer');
    var clienteName =   cliente.options[cliente.selectedIndex].innerHTML;
    var type =          document.getElementById('type');
    var typeName =      type.options[type.selectedIndex].innerHTML;
    var Qty =           document.getElementById('Qty').value;
    var url = "../WarehouseResources/PDF/Labels.php?Cliente=" + clienteName + "&Type=" + typeName + "&Qty=" + Qty;
    $("#frameLabel").attr("src", url);
    return false;
}

