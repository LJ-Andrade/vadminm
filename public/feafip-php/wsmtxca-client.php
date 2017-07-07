<?php

require_once("wsmtxca-class.php");

$nro = 0;
$PtoVta = 100;
$TipoComp = 1;
$FechaComp = date("Y-m-d");
$certificado = "certificado.crt";
$clave = "clave.key";
$cuit = 20939802593;
$urlwsaa = URLWSAA;

$wsmtxca = new WsMTXCA();
$wsmtxca->CUIT = $cuit;
$wsmtxca->setURL(URLWSW);

if ($wsmtxca->Login($certificado, $clave, $urlwsaa)) {

    if (!$wsmtxca->RecuperaLastCMP($TipoComp, $PtoVta)) {
        echo $wsmtxca->ErrorDesc;
    } else {
        $wsmtxca->Reset();
        $nro = $wsmtxca->RespUltNro + 1;
        // codigoTipoComprobante, numeroPuntoVenta, numeroComprobante,fechaEmision, codigoTipoDocumento, numeroDocumento, importeGravado, importeNoGravado, importeExento, importeSubtotal, importeOtrosTributos, importeTotal, codigoMoneda, cotizacionMoneda, observaciones, codigoConcepto, fechaServicioDesde, fechaServicioHasta, fechaVencimientoPago
        $wsmtxca->AgregaFactura($TipoComp, $PtoVta, $nro, $FechaComp, 80, 30702637895, 100, 0, 0, 100, 0, 121, "PES", 1, "", 1, "", "", "");
        $wsmtxca->AgregaIVA(5, 21);
        // unidadesMtx, codigoMtx, codigo, descripcion, cantidad, codigoUnidadMedida, precioUnitario, importeBonificacion, codigoCondicionIVA, importeIVA, importeItem
        $wsmtxca->AgregaItem(1, "articulo1", "articulo1", "descripcion arti 1", 1, 1, 100, 0, 5, 21, 121);
        try {
            if ($wsmtxca->Autorizar()) {
                echo "Felicitaciones! Si ve este mensaje instalo correctamente FEAFIP. CAE y Vencimiento :" . $wsmtxca->RespCAE . " " . $wsmtxca->RespVencimiento;
            } else {
                echo $wsmtxca->ErrorDesc;
            }
        } catch (Exception $e){

            if ($wsmtxca->CmpConsultar($TipoComp, $PtoVta, $nro, $cbte)){
                echo "Felicitaciones! Si ve este mensaje instaló correctamente FEAFIP. CAE y Vencimiento :" . $cbte->CodAutorizacion . " " . $cbte->FchVto;
            } else {
                //cii
            }
        }
    }
} else {
    echo $wsmtxca->ErrorDesc;
}

?>