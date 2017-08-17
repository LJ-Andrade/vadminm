<?php
    
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

function getUrl(){
    $url = $_SERVER['REQUEST_URI'];
    return $url;
}



function calcFinalPrice($cost, $pje){
    $result = $cost * $pje / 100;
    $result = $result + $cost;
    return $result;
}

function calcFinalPriceConvert($cost, $porcentage, $currencyActualValue){
    // $cost                = floatval($cost);
    // $porcentage          = floatval($porcentage);
    // $currencyActualValue = floatval($currencyActualValue);

    $porcentage = $cost * $porcentage / 100;
    $result     = $cost + $porcentage;
    $result     = $result * $currencyActualValue;
    return $result;
}


function transDateT($data){
    $a        = explode(' ', $data);
    $b        = explode('-', $a[0]);
    $date     = $b[2]."/".$b[1]."/".$b[0];
    return $date;
}

function transDateTS($data){
    $a        = explode(' ', $data);
    $b        = explode('-', $a[0]);
    $pretime  = explode(':', $a[1]);
    $time     = $pretime[0].':'.$pretime[1];
    $date     = $b[2]."/".$b[1]."/".$b[0];
    $datetime = $date.' '.$time;
    return $datetime;
}

function transDateTO($data){
    $a        = explode('-', $data);
    $date     = $a[2].'/'.$a[1].'/'.$a[0];
    return $date;
}

function formatNum($number, $digitos)
{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos, ',', '.');
}