<?php
 
    $respuesta = 0;
 
    if(isset($_POST['nombre'])){
        include("../funciones.php");
        include("../../apis/base_de_datos.php");
        $DB = new dataBase();

        $respuesta = $DB->crearCliente(array($_POST['nombre'],$_POST['apellidos'],$_POST['dato'],$_POST['dni'],$_POST['telefono'],$_POST['email'],$_POST['observaciones_privadas'],$_POST['observaciones_publicas'],getCodigo()));
        $DB->desconectar();
    }
    
    echo $respuesta;
    
?>