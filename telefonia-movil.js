function checar_iemi(){


    var imei=document.getElementById('iemi').value;

    if (imei.length < 10 ){
        console.log("MUY PEQUEÑO");
return false;
}
var parametros = {

"imei": imei,   
 

        };

var url = "apis/imei.php";
        $.ajax({                        
           type: "GET",                 
           url: url,                     
           data:parametros,
            beforeSend: function(){
 $('#respuesta_iemi').html("ESPERE POR FAVOR...");
    },   
           success: function(data)             
           {

$("#respuesta_iemi").html(data);

 $('#respuesta_iemi').addClass('alert alert-INFO');
}

});

}