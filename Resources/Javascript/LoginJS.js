/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*var images = [], x = -1;
images[0] = "../LeRP/Resources/Images/Login2.jpg";
images[1] = "../LeRP/Resources/Images/Login3.jpeg";
images[2] = "../LeRP/Resources/Images/Login4.jpg";
images[3] = "../LeRP/Resources/Images/Login5.jpg";
images[4] = "../LeRP/Resources/Images/Login1.jpg";*/
/*
 * 
 * 
 */
var images =                new Array();
var  x =                    0;
var temp =                  1;
function preload() {
    for (i = 0; i < preload.arguments.length; i++) {
            images[i] =                 new Image();
            images[i].src =             preload.arguments[i];
            images[i].style.width =     "100%";
            images[i].className =       "delete";
            images[i].style.height =    "100%";
            images[i].style.opacity =   "0.7";
            images[i].style.transition ="all 2s ease";
            x =                         i;
    }
}
preload(
        "../LeRP/Resources/Images/Login2.jpg",
        "../LeRP/Resources/Images/Login5.jpg",
        "../LeRP/Resources/Images/Login1.jpg"
);
/*
 * 
 */

function changeBackground(){
    preload();
    var src =       document.getElementById("contenedor");
    src.appendChild(images[1]);
    setInterval(displayNextImage, 4000);
    $( "#contenedor" ).remove( ".delete" );
}
function displayNextImage() {
    var src =       document.getElementById("contenedor");
    src.appendChild(images[temp]);
    if(temp < x)
        temp++;
    else
        temp = 0;
}

function displayPreviousImage() {
    x = (x <= 0) ? images.length - 1 : x - 1;
    document.body.src = images[x];
}
function mostrarRecuperar(){
    $("#forgot").slideToggle();
}
function EnviarPassword(){
    var mail =          document.getElementById('emailRec').value;
    alert (mail);
    return false;
}
function Login(){
    var usuario =          document.getElementById('usuario').value;
    var password =         document.getElementById('password').value;
    $.ajax({ //PERFORM AN AJAX CALL
        type:                   'post', 
        url:                    'WebResponses/ComprobarLogin.php', //PHP CONTAINING ALL THE FUNCTIONS
        data:                   {usuario: usuario, contra: password}, //SEND THE VALUE TO EXECUTE A QUERY WITH THE PALLET ID
        success: function(data) { //IF THE REQUEST ITS SUCCESSFUL
            if(data != "Wrong Credentials"){
                window.location.href = "Dashboard.php";
            }else{
                alert (data);
            }
        }
    });
    return false;
}