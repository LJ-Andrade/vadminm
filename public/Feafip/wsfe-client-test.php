<?php
    ini_set('display_errors', 1);
    require_once("wsfe-class.php");

    // $data = json_decode(file_get_contents(getcwd() ."/".'data.json'), true);
    $data = $_POST['data'];
    $cae = $_POST['cae'];

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



    $data['nro'] = $_POST['nro'];
    $data['CAE'] = $_POST['cae'];
    $data['Vto'] = $_POST['vto'];
    $data['Nro'] = $_POST['nro'];
    $data['barcode'] = $cuit . sprintf('%02d', $TipoComp) . sprintf('%04d', $PtoVta) . $_POST['cae'] . $_POST['vto'];
    // Original Line

    $pdf = Invoice($data);

    function Invoice($data, $format = ''){
        $invoice = new Invoice();
        // $data = json_decode(file_get_contents('data.json'), true);
        return $invoice->Generate($data, $format);
    }
?>