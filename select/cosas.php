<?php

    include("../../apis/base_de_datos.php");
    $DB = new dataBase();
    $clientes = 0;
    
    $clientes = $DB->getClientes();
    $DB->desconectar();

    var_dump($clientes);