/////////////////////////////////////////////////
//               PRICE CALC                    //
/////////////////////////////////////////////////

$('#PrecioCostoIpt').keyup(function (e) {
    $('#PjeParticularIpt').val('');
    $('#PjeGremioIpt').val('');
    $('#PjeEspecialIpt').val('');
    $('#PrecioGremioDisp').val('');
    $('#PrecioParticularDisp').val('');
    $('#PrecioEspecialDisp').val('');
    $('#PrecioOfertaDisp').val('');
    $("#PjeOfertaIpt").val('');
});


//---------------- Precio Gremio --------------//
$("#PjeGremioIpt").keyup(function (e) {
    var percent     = $('#PjeGremioIpt').val();
    var preciocosto = $('#PrecioCostoIpt').val();
    var resultado   = calcPtje(preciocosto, percent);
    $('#PrecioGremioDisp').val(resultado);
});

// //------------- Precio Particular --------------//
$("#PjeParticularIpt").keyup(function (e) {
    var percent   = $(this).val();
    // console.log(pjgremio);
    var preciocosto = $('#PrecioCostoIpt').val();
    var resultado   = calcPtje(preciocosto, percent);
    $('#PrecioParticularDisp').val(resultado);
});

// //------------- Precio Especial --------------//
$("#PjeEspecialIpt").keyup(function (e) {
    var percent     = $(this).val();
    var preciocosto = $('#PrecioCostoIpt').val();
    var resultado   = calcPtje(preciocosto, percent);
    $('#PrecioEspecialDisp').val(resultado);
});

// //------------- Precio Oferta --------------//
$("#PjeOfertaIpt").keyup(function (e) {
    var percent     = $(this).val();
    var preciocosto = $('#PrecioCostoIpt').val();
    var resultado   = calcPtje(preciocosto, percent);
    $('#PrecioOfertaDisp').val(resultado);
});




//////////////////////////////
// 							//
//       CALCULATIONS       //
//                          //
//////////////////////////////


function calcPtje(preciocosto, percent){
	var calc   = parseFloat(preciocosto) * parseFloat(percent) / 100;
	var result = parseFloat(preciocosto) + parseFloat(calc);
	var result = Math.round(result*Math.pow(10,2))/Math.pow(10,2);
	return result;
}


/////////////////////////////////////////////////
//                 UPDATES                     //
/////////////////////////////////////////////////

// Update Product Status
function updateProductStatus(route, action){

    $.ajax({
        url: route,
        method: 'post',             
        dataType: 'json',
        data: { action: action },
        beforeSend: function(){
            toggleLoader();
        },
        success: function(data){
            location.reload();  
        },
        complete: function(data){
            toggleLoader();
        },
        error: function(data)
        {
            console.log(data);
            $('#Error').html(data.responseText);
        },
    });

}

function updateProduct(route, id, value, success){
    var data = {route: route, id: id, value: value};
    $.post(route, data, function(data) {
        // console.log(data);
    })
    .done(function(data) {
        success;
    })
    .fail(function(data) {
        // console.log(data);
    });
}

function updateCurrencyAndPrice(route, id, data, success){
    // var data = {route: route, id: id, value: value};
  
    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'JSON',
        data: data,
        beforeSend: function(){
            
        },
        success: function(data){
            success;
        },
        error: function(data){
            console.log(data);
            $('#Error').html(data.responseText);
        }
    }); 
}

function sumStock(route, id, value, action){
    var data = {route: route, id: id, value: value};
    var output = '';
    $.ajax({
        url: route,
        type: 'post',
        dataType: 'json',
        data: data,
        beforeSend: function(){
            $('#UpdateStockBtn').html('Actualizando...');
        },
        success: function(data){
            $('#UpdateStockBtn').html('Actualizar');
            
            // location.reload();
        },
        error: function(data){
            console.log(data);
        }
    }); 

}

