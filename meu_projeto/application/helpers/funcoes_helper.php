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

function FormDataP($data){
    return date('d/m/y', strtotime($data));
}

function FormDataHora($data){
    return date('d/m/Y \à\s H:i:s', strtotime($data));
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

function tipo_assunto($tipo) {
        switch ($tipo) {
     case 1:
        echo "D&uacute;vida";
        break;
    case 2:
        echo "Cr&iacute;tica";
        break;
    case 3:
        echo "Sugest&atilde;o";
        break;
}
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
        echo "Depósito Bancário";
        break;
    case 2:
        echo "PagSeguro";
        break;
    case 3:
        echo "Boleto";
        break;
}
}

function FormPeriodo($id){
    switch ($id) {
     case 'year':
        echo "ano";
        break;
    case 'month':
        echo "meses";
        break;
    case 'day':
        echo "dias";
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
        echo "Nenhum";
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
        echo "Nenhum";
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
        echo "Nenhum";
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
        echo "Nenhum";
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
        echo "Nenhum";
        break;
}
}

function FormAcesso($id){
    switch ($id) {
        case 1:
            echo "Celular";
            break;
        case 2:
            echo "Tablet";
            break;
        case 3:
            echo "Notebook";
            break;
        case 4:
            echo "Computador";
            break;
        default:
            echo "Nenhum";
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

function FormTermosLabel($termos){
    switch ($termos) {
        case 1:
            echo "<span style='font-size: 12px' class='label label-success'>Sim</span>";
            break;
        case 2:
            echo "<span style='font-size: 12px' class='label label-danger'>Não</span>";
            break;
    }
}

function FormTipo($tipo){
    switch ($tipo) {
        case 1:
            echo "Novo";
            break;
        case 2:
            echo "Mudança";
            break;
        case 3:
            echo "Erro de Código";
            break;
        case 4:
            echo "Falha de Sistema";
            break;
        case 5:
            echo "Defeito";
            break;
    }
}

function FormNivel($nivel){
    switch ($nivel) {
        case 1:
            echo "<div style='font-size: 16px;' class='label label-success'>Leve</div>";
            break;
        case 2:
            echo "<div style='font-size: 16px;' class='label label-info'>Normal</div>";
            break;
        case 3:
            echo "<div style='font-size: 16px;' class='label label-warning'>Grave</div>";
            break;
        case 4:
            echo "<div style='font-size: 16px;' class='label label-danger'>Urgente</div>";
            break;
    }
}

function compararDatas($data_inicial, $duracao, $periodo) {
    $date = $data_inicial;
    $date = strtotime($date);
    $new_date = strtotime('+ ' . $duracao . ' ' . $periodo, $date);
    $data_final = date('Y-m-d', $new_date);

    $diaAtual = strtotime(date('Y-m-d'));
    $intervalo = ($new_date - $diaAtual) / 86400;
}

function time2text($time){
    $response=array();
    $years = floor($time/(86400*365));
    $time=$time%(86400*365);
    $months = floor($time/(86400*30));
    $time=$time%(86400*30);
    $days = floor($time/86400);
    $time=$time%86400;
    $hours = floor($time/(3600));
    $time=$time%3600;
    $minutes = floor($time/60);
    $seconds=$time%60;
    if($years>0) $response[]=$years.' ano'. ($years>1?'s':' ');
    if($months>0) $response[]=$months.' mes'.($months>1?'es':' ');
    if($days>0) $response[]=$days.' dia' .($days>1?'s':' ');

    return implode(' e ',$response);
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
  $variavel = preg_replace(",", "", $variavel);
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