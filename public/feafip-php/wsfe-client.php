<?php
ini_set('display_errors', 1);
require_once("wsfe-class.php");

$data = json_decode(file_get_contents(getcwd() ."/".'data.json'), true);

$cust_cuit = floatval(str_replace('-', '', $data['customer_data']['ident']));
$cust_doc_type = $data['customer_data']['doc_type'];
$subtotal = floatval(str_replace(',', '.', $data['base']['subtotal']));
$sum_tax = floatval(str_replace(',', '.', $data['base']['sum_tax']));
$total = floatval(str_replace(',', '.', $data['base']['total']));

$nro = 0;
$PtoVta = $data['pto_vta'];
$TipoComp = $data['tipo_comp'];
$FechaComp = date("Ymd");
$certificado = "certificado.crt";
$clave = "clave.key";
$cuit = str_replace('-', '', $data['company_data']['ident']);
$urlwsaa = URLWSAA;

$wsfe = new WsFE();
$wsfe->CUIT = floatval($cuit);
$wsfe->setURL(URLWSW);
if ($wsfe->Login($certificado, $clave, $urlwsaa)) {

    if (!$wsfe->RecuperaLastCMP($PtoVta, $TipoComp)) {
        echo $wsfe->ErrorDesc;
    } else {
        $wsfe->Reset();
        $nro = $wsfe->RespUltNro + 1;
        $wsfe->AgregaFactura(1, $cust_doc_type, $cust_cuit, $nro, $nro, $FechaComp, $total, 0.0, $subtotal, 0.0, "", "", "", "PES", 1);
        $wsfe->AgregaIVA(5, $subtotal, $sum_tax);
        // $wsfe->AgregaTributo(2, "Perc IIBB", 1000, 3.5, 35); En caso de tributo
        $auth = false;
        try {
            if ($wsfe->Autorizar($PtoVta, $TipoComp)) {
                $auth = true;
            } else {
                echo $wsfe->ErrorDesc;
            }
        } catch (Exception $e) {
            if ($wsfe->CmpConsultar($TipoComp, $PtoVta, $nro, $cbte)) {
                $auth = true;
            } else {
                //cii
            }
        }
        if ($auth) {
            $data['invoice_num'] = sprintf('%04d-', $PtoVta) . sprintf('%08d', $nro);
            $data['CAE'] = $wsfe->RespCAE;
            $data['Vto'] = $wsfe->RespVencimiento;
            $data['barcode'] = $cuit . sprintf('%02d', $TipoComp) . sprintf('%04d', $PtoVta) . $wsfe->RespCAE . $wsfe->RespVencimiento;
            $wsfe->Invoice($data);
        }
    }
} else {
    echo $wsfe->ErrorDesc;
}


?>