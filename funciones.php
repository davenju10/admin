<?php

function fecha_corta($fecha){
    $date = date('d-m-y', strtotime($fecha));
    $hora = date('H:i', strtotime($fecha));
    $dia = date('d', strtotime($fecha));
    $meses = array("Ene","Feb","Mar","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
    $mes = $meses[date('n', strtotime($fecha))];
    $año = date('y', strtotime($fecha));
    // $otro = "".$date->format('dd-mm-yy');
    // return $date->format('d-m-yy');
    return $dia."-".$mes."-".$año."<br>".$hora;
}

function getCodigo(){
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUWXYZ';
    $a = substr(str_shuffle($permitted_chars), 0, 8);
    $b = substr(str_shuffle($permitted_chars), 0, 8);
    $c = substr(str_shuffle($permitted_chars), 0, 8);
    $cadena = $a.$b.$c;
    return $cadena;		
}

?>