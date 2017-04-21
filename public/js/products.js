
// Oferta Input behavior
$('#OfertaCheck').click(function(){
    var input = $('.OfertaInput');
    if(input.attr("disabled")){
        input.prop("disabled", false);
    } else {
        input.prop("disabled", true);
        input.val('');
    }
});

$('#EstadoCheck').click(function(){
    var text = $('#EstadoInput');

    if($('#EstadoCheck')[0].checked){
        
        text.val("En lista");
    } else {
        console.log('no checkeado');
        
        text.val("No Listar");
    }
});


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
});


//---------------- Precio Gremio --------------//
$("#PjeGremioIpt").keyup(function (e) {
    var pjegremio   = $(this).val();
    var preciocosto = $('#PrecioCostoIpt').val();
    var resultado   = calcPtje(preciocosto, pjegremio);
    $('#PrecioGremioDisp').val(resultado);
});

//------------- Precio Particular --------------//
$("#PjeParticularIpt").keyup(function (e) {
    var pjegremio   = $(this).val();
    var preciocosto = $('#PrecioCostoIpt').val();
    var resultado   = calcPtje(preciocosto, pjegremio);
    $('#PrecioParticularDisp').val(resultado);
});

//------------- Precio Especial --------------//
$("#PjeEspecialIpt").keyup(function (e) {
    var pjegremio   = $(this).val();
    var preciocosto = $('#PrecioCostoIpt').val();
    var resultado   = calcPtje(preciocosto, pjegremio);
    $('#PrecioEspecialDisp').val(resultado);
});


/////////////////////////////////////////////////
//                 UPDATES                     //
/////////////////////////////////////////////////


function updateProduct(route,id,value,success){
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


