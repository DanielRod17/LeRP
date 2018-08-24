/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function reload(e){
    //alert("Div clicked "+e);
    var url =               '';
    if(e === '1'){
        url =               'Warehouse/Pages/GenerateLabels.php';
        //$('#load').attr('src', 'Dashboard.php');
    }
    else if(e === '2'){
        url =               'Warehouse/Pages/AddCustomer.php';
    }
    else if(e === '3'){
        url =               'Warehouse/Pages/ManageCustomers.php';
    }
    //$('#load', window.parent.document).attr('src', 'Warehouse/Pages/GenerateLabels.php');
    var frame = $('#load', window.parent.document);
    frame.fadeOut(500, function () {
        frame.attr('src', url);
        frame.fadeIn(500);
    });
    //frame.attr('opacity', '1 !important');
}
