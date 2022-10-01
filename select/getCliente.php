<?php
 
 $cliente = 0;
 
 if(isset($_POST['identificador'])){
    include("../../apis/base_de_datos.php");
    $DB = new dataBase();
    $cliente = $DB->getCliente(array($_POST['identificador']));
    $DB->desconectar();
}
    
echo json_encode($cliente);


    
?>
