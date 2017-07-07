<?php

require("wsfe-class.php");

$nro = 0;
$PtoVta = 6600;
$TipoComp = 1;
$FechaComp = "20151215";
$certificado = "certificado.crt";
$clave = "clave.key";
$cuit = 20939802593;
$urlwsaa = URLWSAA;

$wsfe = new WsFE();
$wsfe->CUIT = $cuit;
$wsfe->setURL(URLWSW);

if ($wsfe->Login($certificado, $clave, $urlwsaa)) {

//    if (!$wsfe->CAEASolicitar("201512", 2, $CAE, $FchVigDesde, $FchVigHasta, $FchTopeInf, $FchProceso)){
//        echo $wsfe->ErrorDesc;
//    }

    if ($wsfe->CAEAConsultar("201512", 1, $CAE, $FchVigDesde, $FchVigHasta, $FchTopeInf, $FchProceso)){

        if ($wsfe->RecuperaLastCMP($PtoVta, $TipoComp)) {
            $nro = $wsfe->RespUltNro;
            $nro = $nro + 1;
            $wsfe->Reset();
            $wsfe->AgregaFactura(1, 80, 21111111113, $nro, $nro, $FechaComp, 12135.0, 0.0, 10000.0, 0.0, "", "", "", "PES", 1);
            $wsfe->AgregaIVA(5, 10000, 2100);
            $wsfe->AgregaTributo(2, "Perc IIBB", 1000, 3.5, 35);

                if ($wsfe->CAEAInformar($PtoVta, $TipoComp, $CAE)) {
                    echo "Felicitaciones! Si ve este mensaje usted logró informar correctamente el comprobante";
                } else {
                    echo $wsfe->ErrorDesc;
                }
        } else {
            echo $wsfe->ErrorDesc;
        }
    } else {
        echo $wsfe->ErrorDesc;
    }

} else {
    echo $wsfe->ErrorDesc;
}

?>