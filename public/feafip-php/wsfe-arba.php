<?php
ini_set('display_errors', 1);
require_once("wsfe-class.php");

$wsfe = new WsFE();
$wsfe->CUIT = floatval(30714016918);
$wsfe->PasswodArba = "252729";
if ($wsfe->ConsultaARBA(20319091166, "20160801", "20160831", $alicuotas)) {
    $percepcion = $alicuotas->percepcion;
    $retencion = $alicuotas->retencion;
} else {
    echo $wsfe->ErrorDesc;
}


?>