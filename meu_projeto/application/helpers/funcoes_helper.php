<?php

function reais($decimal){
    return "R$ " . number_format($decimal, 2, ",", ".");
}

function clearReais($decimal){
    return number_format($decimal, 2, ".", ",");
}

function porcento($porcento, $total){
    return ($porcento / 100) * $total;
}

function multiplicar($valor, $vezes){
    return $valor * $vezes;
}

function zerofill($num, $zerofill = 4) {
    return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
}


function FormData($data){
    return date('d/m/Y', strtotime($data));
}

function FormDataHora($data){
    return date('d/m/Y \à\s H:i', strtotime($data));
}

function FormHora($data){
    return date('\à\s H:i', strtotime($data));
}

function getDateDiff($start, $end = "NOW", $return = 'days') {

    //Transforma a data inicial em time    
    $sdate = strtotime($start);

    //Transforma a data final em time    
    $edate = strtotime($end);

    //Faz o cálculo para achar a diferença em dias    
    $pday = ($edate - $sdate) / 86400;

    //Faz o cálculo para achar a diferença em menses    
    $pmonth = $pday / 30;

    if ($return == 'days')
        $r = explode('.', $pday);

    elseif ($return == 'months')
        $r = explode('.', $pmonth);

    return $r[0];
}


function tipo_conta($tipo) {
        switch ($tipo) {
     case 1:
        echo "Corrente";
        break;
    case 2:
        echo "Poupança";
        break;
}
}

function tipo_pagam($tipo) {
        switch ($tipo) {
     case 1:
        echo "Boleto";
        break;
    case 2:
        echo "TED";
        break;
    case 3:
        echo "Depósito Bancário";
        break;
}
}

function FormPerfil($perfil){
    switch ($perfil) {
     case 1:
        echo "Usuário";
        break;
    case 2:
        echo "Cliente";
        break;
     case 3:
        echo "Admin";
        break;
}
}

function FormPerfilLabel($perfil){
    switch ($perfil) {
        case 1:
            echo "<span style='font-size: 12px' class='label label-warning'>Usuário</span>";
            break;
        case 2:
            echo "<span style='font-size: 12px' class='label label-info'>Cliente</span>";
            break;
        case 3:
            echo "Admin";
            break;
    }
}


function clear($string){
    $string = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $string));
    $string = strtolower($string);
    $string = str_replace(" ", "-", $string);
    $string = str_replace("---", "-", $string);
    return $string;
}

function plural($entrada, $primeiro, $segundo) {
    if($entrada <= 1) {
        echo $primeiro;      
    } else {
        echo $segundo;
    }   

}

function formStatus($status) {
    if($status = 1) {
        echo '<span class="label label-success">Ativo <span class="glyphicon glyphicon-ok"></span></span>';
    } else {
       '<span class="label label-danger">Inativo</span>';
    }
}