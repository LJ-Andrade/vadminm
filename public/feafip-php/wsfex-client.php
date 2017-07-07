<?php

require("wsfex-class.php");

$nro = 0;
$PtoVta = 100;
$TipoComp = 19;
$FechaComp = date("Ymd");
$certificado = "certificado.crt";
$clave = "clave.key";
$cuit = 20939802593;
$urlwsaa = URLWSAA;

$wsfe = new WsFEX();
$wsfe->CUIT = $cuit;
$wsfe->setURL(URLWSW);

if ($wsfe->Login($certificado, $clave, $urlwsaa)) {

    if (!$wsfe->RecuperaLastCMP($PtoVta, $TipoComp)) {
        echo $wsfe->ErrorDesc;
    } else {
        $IdTrans = 0;
        if (!$wsfe->UltimoIdTrans($IdTrans)){ //$IdTrans variable por referencia
            echo $wsfe->ErrorDesc;
        } else {
            $IdTrans++;
            $wsfe->Reset();
            $nro = $wsfe->RespUltNro + 1;
            $wsfe->AgregaFactura($IdTrans, $FechaComp, $TipoComp, $PtoVta, $nro, 1, "N", 208, "chile sa", 50000000032, "Domicilio", "", "DOL", 8, "", 100, "", "contado", "CIF", "", 1);
            $wsfe->AgregaItem("11111", "remera ", 1, 1, 100, 100, 0);
            if ($wsfe->Autorizar()) {
                echo "Felicitaciones!�Si�ve�este�mensaje�instalo�correctamente�FEAFIP.�CAE�y�Vencimiento�:" . $wsfe->RespCAE . "�" . $wsfe->RespVencimiento;
            } else {
                echo $wsfe->ErrorDesc;
            }
        }
    }
} else {
    echo $wsfe->ErrorDesc;
}

?>