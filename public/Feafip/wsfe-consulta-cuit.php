<?php
require_once("wsfe-class.php");

$urlwsaa = URLWSAA;
$urlwscdc = URLWSCDC;

$certificado = "certificado.crt";
$clave = "clave.key";
$cuit = 20939802593;

$wsfe = new WsFE();
$datosPersona;
$wsfe->ConsultarCUIT(20939802593, $datosPersona);


?>