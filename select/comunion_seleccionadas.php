<?php
     
    $fotos = 0;
 
    if(isset($_GET['codigo'])){
        include("../../apis/base_de_datos.php");
        $DB = new dataBase();
        $fotos = $DB->getFotosComunionSeleccionadas(array($_GET['codigo']));
        $DB->desconectar();
    }

    if($fotos != 0){
        foreach ($fotos as $foto) {
            $ruta = "../".$foto['codigo_comunion']."/".$foto['foto'];
        ?>
            <div class="image" id="<?= $foto['codigo']?>">
     			<img src="<?= $ruta ?>" alt="image">
                <p><?= $foto['foto']?></p>
     		</div>
        <?php
        }
    }else{
        echo "Todavía no ha realizado la selección.";
    }
?>
