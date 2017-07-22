<?php
require_once("wsfe-class.php");

$urlwsaa = URLWSAA;
$urlwscdc = URLWSCDC;

$certificado = "certificado.crt";
$clave = "clave.key";
$cuit = 20939802593;

$wsfe = new WsFE();
$wsfe->CUIT = $cuit;
$wsfe->setUrlCdc($urlwscdc);
if ($wsfe->Login($certificado, $clave, $urlwsaa, "wscdc")) {

    $CbteModo = "CAE";  // Puedesn ser CAE, CAEA o CAI
    $CuitEmisor = 20939802593;
    $PtoVta = 140;
    $CbteTipo = 1;
    $CbteNro = 1588;
    $CbteFch = "20170517";
    $ImpTotal = 1452.73;
    $CodAutorizacion= "67203477090542";
    $DocTipoReceptor = 80;
    $DocNroReceptor = "27929007862";

    if ($wsfe->ComprobanteConstatar($CbteModo, $CuitEmisor, $PtoVta, $CbteTipo, $CbteNro, $CbteFch, $ImpTotal, $CodAutorizacion,
        $DocTipoReceptor, $DocNroReceptor, $FchProceso /*Esta variable es por referencia donde se devuelve la fecha de procesamiento*/)) {
        echo "El comprobante pudo ser constatado exitosamente";
    } else {
        echo $wsfe->ErrorDesc;
    }

} else {
    echo $wsfe->ErrorDesc;
}


?>