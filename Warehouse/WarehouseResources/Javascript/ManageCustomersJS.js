$(document).ready(function() {

});
$(document).ready(function () {
    $( ".Update" ).on( "click", function() {
        var send = "ManageCustomers "+ $(this).attr("id");
        parent.postMessage(send, '*');
    });
});
