<?php
 
    
 
 try {
    include("../funciones.php");
    include("../../apis/base_de_datos.php");

    $DB = new dataBase();

    $codigo_cliente  = $_POST['codigo_cliente']; 
    $codigo_comunion = getCodigo();
    $dato            = $_POST['dato'];
    $observaciones   = $_POST['observaciones'];
    $fecha_comunion  = $_POST['fecha_comunion'];
    $fecha_reportaje = $_POST['fecha_reportaje'];
    $fecha_album     = $_POST['fecha_album'];

    if($fecha_reportaje == ""){
        $fecha_reportaje = null;
    }

    if($fecha_album == ""){
        $fecha_album = null;
    }

    $comunion = $DB->crearComunion(array($_POST['dato'], $fecha_comunion, $fecha_reportaje, $fecha_album,0,0,0,0,0,0,"",$codigo_comunion));
    $cliente_comunion = $DB->crearClienteComunion(array($codigo_cliente,$codigo_comunion));

    $DB->desconectar();

    if($comunion && $cliente_comunion){
        echo json_encode(array("code" => 200, "txt" => "Todo bien", "comunion" => $codigo_comunion));
    }else{
        echo json_encode(array("code" => 400, "txt" => "Algo ha fallado"));
    }
} catch (\Throwable $th) {
    echo json_encode(array("code" => 400, "txt" => strval($th)));
}
    
    
?>



                
                