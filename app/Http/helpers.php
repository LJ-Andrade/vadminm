<?php
    
//////////////////////////////////////////////
//         Numbers, Calcs. & Converts       //
//////////////////////////////////////////////

function formatNum($number, $digits)
{
    $root       = 10;
    $multiplier = pow($root, $digits);
    $result     = ((int)($number * $multiplier)) / $multiplier;
    return number_format($result, $digits, ',', '.');
}
    
function convertAndRoundDecimal($number, $precision)
{
    $number = floatval($number);
    $p      = pow(10, $precision);
    return ceil(round($number * $p, 1)) / $p;
    
   
}

function round_sup($nb, $precision)
{
}
    
function calcFinalPrice($cost, $pje)
{
    $result = floatval($cost) * floatval($pje) / 100;
    $result = floatval($result) + floatval($cost);
    return $result;
}

function calcFinalPriceConvert($cost, $percent, $currencyActualValue)
{

    $percent = floatval($cost) * floatval($percent) / 100;
    $result  = floatval($cost) + floatval($percent);
    $result  = $result * floatval($currencyActualValue);
    return $result;
}
    
//////////////////////////////////////////////
//               Translations               //
//////////////////////////////////////////////

function typeTrd($type)
{
    switch ($type) {
        case 'user':
            echo 'Usuario';
            break;
        case 'admin':
            echo 'Administrador';
            break;
        case 'superadmin':
            echo 'Super Administrador';
            break;

        default:
            echo '';
            break;
    }
}

function roleTrd($role)
{
    switch ($role) {
        case 'seller':
            echo 'Vendedor';
            break;
        case 'none':
            echo 'Sin Rol';
            break;
        default:
            echo '';
            break;
    }
}

function statusTrd($status) {

    switch ($status) {
        case 'activo':
            echo 'En lista';
            break;
        case 'pausado':
            echo 'Sin listar';
            break;
        default:
            echo 'Sin listar';
            break;
    }

}

function paymentType($type) {

    switch ($type) {
        case 'E':
            echo 'Efectivo';
            break;
        case 'B':
            echo 'Banco';
            break;
        case 'C':
            echo 'Cheque';
            break;
        case 'R':
            echo 'Retención';
            break;
        default:
            echo 'Desconocido';
            break;
    }
}

function movementType($type) {

    switch ($type) {
        case 'E':
            echo 'Efectivo';
            break;
        case 'B':
            echo 'Banco';
            break;
        case 'C':
            echo 'Cheque';
            break;
        case 'R':
            echo 'Retención';
            break;
        case 'F':
            echo 'Factura';
            break;
        case 'ND':
            echo 'Nota de Débito';
            break;
        case 'NC':
            echo 'Nota de Crédito';
            break;
        default:
            echo 'Desconocido';
            break;
    }
}

function compType($type){

    switch ($type) {
        case 'F':
            $comprobante = 'Factura';
            break;
        case 'NC':
            $comprobante = 'Nota de Crédito';
            break;
        case 'ND':
            $comprobante = 'Nota de Débito';
            break;
        default:
            $comprobante = 'No definido';
            break;
    }
    return $comprobante;
}


function getMonthName($month)
{
    switch ($month) {
        case '01':
        return 'Enero';
            break;
        case '02':
        return 'Febrero';
            break;
        case '03':
        return 'Marzo';
            break;
        case '04':
        return 'Abril';
            break;
        case '05':
        return 'Mayo';
            break;
        case '06':
        return 'Junio';
            break;
        case '07':
        return 'Julio';
            break;
        case '08':
        return 'Agosto';
            break;
        case '09':
        return 'Septiembre';
            break;
        case '10':
        return 'Octubre';
            break;
        case '11':
        return 'Noviembre';
            break;
        case '12':
        return 'Diciembre';
            break;
        default:
        return 'Sin Mes';
        break;
    }

}

//////////////////////////////////////////////
//              Date Formats                //
//////////////////////////////////////////////

function transDateT($data){
    if($data != null){
        $a        = explode(' ', $data);
        $b        = explode('-', $a[0]);
        $date     = $b[2]."/".$b[1]."/".$b[0];
        return $date;
    } else {
        return '';
    }
}

function transDateTS($data){
    if($data != null){
        $a        = explode(' ', $data);
        $b        = explode('-', $a[0]);
        $pretime  = explode(':', $a[1]);
        $time     = $pretime[0].':'.$pretime[1];
        $date     = $b[2]."/".$b[1]."/".$b[0];
        $datetime = $date.' '.$time;
        return $datetime;
    } else {
        return '';
    }
}

function transDateTO($data){
    if($data != null){
        $a        = explode('-', $data);
        $date     = $a[2].'/'.$a[1].'/'.$a[0];
        return $date;
    } else {
        return '';
    }
}

//////////////////////////////////////////////
//             Misc. Functions              //
//////////////////////////////////////////////

function getUrl(){
    $url = $_SERVER['REQUEST_URI'];
    return $url;
}


