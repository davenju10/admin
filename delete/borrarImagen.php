<?php

    if(isset($_POST['codigo']) && isset($_POST['carpeta']) && isset($_POST['foto'])){

        include("../../apis/base_de_datos.php");
        $DB = new dataBase();
        $respuesta =  $DB->borrarFotoComunion($_POST['codigo']);
        $ruta = "../".$_POST['foto'];
        unlink($ruta);
        $DB->desconectar();
        
        echo $respuesta;
    }


?>