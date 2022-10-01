<?php

    if(isset($_POST['codigo']) && isset($_POST['ruta'])){


        include("../../apis/base_de_datos.php");
        $DB = new dataBase();
        $DB->borrarEnlaceDocumentoComunion($_POST['codigo']);
        $DB->borrarDocumentoComunion($_POST['codigo']);

        $ruta = $_POST['ruta'];
        unlink($ruta);
        $DB->desconectar();
        
        echo $respuesta;
    }


?>