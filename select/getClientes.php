<?php
 
    $clientes = array();
    
    include("../../apis/base_de_datos.php");
    $DB = new dataBase();
    $clientes = $DB->getClientesCombo();
    $DB->desconectar();

    $combo = array();
    $categoria = "Crear Cliente";
    $combo["Crear Cliente"] = array('0' => 'Añadir nuevo');
    foreach ($clientes as $cliente) {
        if($categoria != $cliente['dato']){
            $categoria = $cliente['dato'];
            $combo[$categoria] = array();
        }
        // echo "categoria ".$categoria." codigo ".$cliente['codigo']." nombre ".$cliente['nombre']." ".$cliente['apellidos']."\n";
        $combo[$categoria][$cliente['codigo']] = $cliente['nombre']." ".$cliente['apellidos'];
    }
    

    echo json_encode($combo, JSON_UNESCAPED_UNICODE);




    // $combo = "{";
    //     $categoria = "";
    //     $cont = 0;
    //     foreach ($clientes as $cliente) {
    //         if($categoria != $cliente['dato']){
    //             $categoria = $cliente['dato'];
    //             if($cont == 0){
    //                 $combo = $combo."'".$categoria."' : {";
    //             }else{
    //                 $combo = substr($combo, 0, -1);
    //                 $combo = $combo."},'".$categoria."' : {";
    //             }
    //             $combo = $combo."{ ".$cliente['codigo']." : '".$cliente['nombre']." ".$cliente['apellidos']."' },";
    //         }else{
    //             $combo = $combo."{ ".$cliente['codigo']." : '".$cliente['nombre']." ".$cliente['apellidos']."' },";
    //         }
    //         $cont = $cont + 1;
    //     }
    //     $combo = substr($combo, 0, -1);
    //     $combo = $combo."}";
    
    //     echo $combo;
    // if(empty($clientes)){
    //     echo 0;
    // }else{
    //     echo json_encode($clientes);
    // }
    
?>
