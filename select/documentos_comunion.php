<?php
     
    $documentos = 0;
    if(isset($_GET['codigo'])){
        include("../../apis/base_de_datos.php");
        $DB = new dataBase();
        $documentos = $DB->getDocumentosComunion(array($_GET['codigo']));
        $DB->desconectar();
    }
    if($documentos != 0){
        foreach ($documentos as $documento) {
            $ruta = "../".$_GET['codigo']."/".$documento['nombre'];
            echo '<div class="text-center me-2 d-flex align-items-center justify-content-center documento-subido">
                    <span class="borrar-doc" onclick="borrarDocumentoComunion(\''.$documento['codigo'].'\',\''.$ruta.'\',\''.$_GET['codigo'].'\')">X</span>
                    <i class="material-icons opacity-10"><img style="width: 100%;height: 100%;" src="../assets/images/documentos.png" alt="" onclick="mostrarDocumento(\''.$ruta.'\')"></i>
                    <p>'.$documento['oldname'].'</p>   
                </div>';
        }
    }
?>