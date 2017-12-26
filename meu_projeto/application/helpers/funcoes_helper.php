<?php

function reais($decimal){
    return "R$ " . number_format($decimal, 2, ",", ".");
}

function clearReais($decimal){
    return number_format($decimal, 2, ".", ",");
}

function porcento($porcento, $total){
    return ($porcento * 100) / $total;
}

function porcentoRev($porcento, $total){
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
        echo "Admin";
        break;
    case 2:
        echo "Usuário";
        break;
    }
}

function FormPerfil_SO($id){
    switch ($id) {
     case 1:
        echo "Surdo";
        break;
    case 2:
        echo "Ouvinte";
        break;    
    default:
        echo "Total";
        break;
}
}

function FormEscolar($id){
    switch ($id) {
     case 1:
        echo "Ensino Fundamental";
        break;
    case 2:
        echo "Ensino Médio";
        break;  
    case 3:
        echo "Ensino Superior";
        break;  
    default:
        echo "Total";
        break;
}
}

function FormIgreja($id){
    switch ($id) {
     case 1:
        echo "Evangélica";
        break;
    case 2:
        echo "Católica";
        break;  
    case 3:
        echo "Outra";
        break;  
    default:
        echo "Total";
        break;
}
}

function FormFuncao($id){
    switch ($id) {
     case 1:
        echo "Pastor";
        break;
    case 2:
        echo "Professor";
        break;  
    case 3:
        echo "Estudante";
        break;  
    default:
        echo "Total";
        break;
}
}

function FormSaber($id){
    switch ($id) {
     case 1:
        echo "Google";
        break;
    case 2:
        echo "Facebook";
        break;  
    case 3:
        echo "Indicação de Amigo";
        break;  
    default:
        echo "Total";
        break;
}
}

function FormPerfilLabel($perfil){
    switch ($perfil) {
        case 1:
            echo "<span style='font-size: 12px' class='label label-info'>Admin</span>";
            break;
        case 2:
            echo "<span style='font-size: 12px' class='label label-success'>Usuário</span>";
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

function url_amigavel($variavel){
    $procurar   = array('à','ã','â','é','ê','í','ó','ô','õ','ú','ü','ç',);
    $substituir = array('a','a','a','e','e','i','o','o','o','u','u','c',);
    $variavel = strtolower($variavel);
    $variavel   = str_replace($procurar, $substituir, $variavel);
    $variavel = htmlentities($variavel);
  $variavel = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml);/", "$1", $variavel);
  $variavel = preg_replace("/([^a-z0-9]+)/", "-", html_entity_decode($variavel));
  return trim($variavel, "-");
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

if (!function_exists('formata_preco'))
{
    function formata_preco($valor)
    {
        $negativo = false;
        $preco = "";
        $valor = intval(trim($valor));
            if ($valor < 0) {
                $negativo = true;
                $valor = abs($valor);
        }
        $valor = strrev($valor);
        while (strlen($valor) < 3) {
            $valor .= "0";
        }
        for ($i = 0; $i < strlen($valor); $i++) {
            if ($i == 2)    {
                $preco .= ",";
            }
            if (($i <> 2) AND (($i+1)%3 == 0))  {
                $preco .= ".";
            }
            $preco .= substr($valor, $i , 1);
        }
        $preco = strrev($preco);
        return ($negativo ? "-" : "") . $preco;
    }
}