<?php
 
    
 
 try {
    include("../funciones.php");
    include("../../apis/base_de_datos.php");

    $DB = new dataBase();

    $codigo_cliente  = getCodigo();
    $codigo_comunion = getCodigo();
    $nombre          = $_POST['nombre'];
    $apellidos       = $_POST['apellidos'];
    $dato            = $_POST['dato'];
    $email           = $_POST['email'];
    $telefono        = $_POST['telefono'];
    $observaciones   = $_POST['observaciones'];
    $fecha_comunion  = $_POST['fecha_comunion'];
    $fecha_reportaje = $_POST['fecha_reportaje'];
    $fecha_album     = $_POST['fecha_album'];

    $cliente  = $DB->crearCliente(array($_POST['nombre'],$_POST['apellidos'],$_POST['dato'],'',$_POST['telefono'],$_POST['email'],$_POST['observaciones'],'',$codigo_cliente));
    $comunion = $DB->crearComunion(array($_POST['dato'], $fecha_comunion, $fecha_reportaje, $fecha_album,0,0,0,0,0,0,"",$codigo_comunion));
    $cliente_comunion = $DB->crearClienteComunion(array($codigo_cliente,$codigo_comunion));

    $DB->desconectar();

    if($cliente && $comunion && $cliente_comunion){
        echo json_encode(array("code" => 200, "txt" => "Todo bien", "comunion" => $codigo_comunion));
    }else{
        echo json_encode(array("code" => 400, "txt" => "Algo ha fallado"));
    }
} catch (\Throwable $th) {
    echo json_encode(array("code" => 400, "txt" => strval($th)));
}
    
    
?>



                
                