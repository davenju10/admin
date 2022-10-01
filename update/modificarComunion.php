<?php
 
    $respuesta = 0;
 
    if(isset($_POST['id'])){
        include("../../apis/base_de_datos.php");
        $DB = new dataBase();
        $respuesta = $DB->modificarCheckComunion(array($_POST['tipo'],$_POST['check'],$_POST['id']));
        $DB->desconectar();
    }
    if($respuesta){
        echo json_encode(array('code'=>true));
    }else{
        echo json_encode(array('code'=>false));
    }
    
?>