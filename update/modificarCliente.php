<?php
 
    $respuesta = 0;
 
    if(isset($_POST['id'])){
        include("../../apis/base_de_datos.php");
        $DB = new dataBase();
        $respuesta = $DB->modificarCliente(array($_POST['nombre'],$_POST['apellidos'],$_POST['dato'],$_POST['dni'],$_POST['telefono'],$_POST['email'],$_POST['observaciones_privadas'],$_POST['observaciones_publicas'],$_POST['id']));
        $cliente = array("nombre"=>$_POST['nombre'],"apellidos"=>$_POST['apellidos'],"dato"=>$_POST['dato'],"dni"=>$_POST['dni'],"telefono"=>$_POST['telefono'],"email"=>$_POST['email'],"observaciones_privadas"=>$_POST['observaciones_privadas'],"observaciones_publicas"=>$_POST['observaciones_publicas']);
        $DB->desconectar();
    }
    if($respuesta != 0){
        echo json_encode($cliente);
    }else{
        echo 0;
    }
    
?>