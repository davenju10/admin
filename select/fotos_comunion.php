<?php
     
    $fotos = 0;
 
    if(isset($_GET['codigo'])){
        include("../../apis/base_de_datos.php");
        $DB = new dataBase();
        $fotos = $DB->getFotosComunion(array($_GET['codigo']));
        $DB->desconectar();
    }

    if($fotos != 0){
        foreach ($fotos as $foto) {
            $ruta = "../".$foto['codigo_comunion']."/".$foto['foto'];
        ?>
            <div class="image" id="<?= $foto['codigo']?>">
     			<img src="<?= $ruta ?>" alt="image">
     			<span onclick="borrarImagen('<?= $foto['codigo']?>','<?= $foto['codigo_comunion']?>','<?= $ruta ?>')">&times;</span>
                <p><?= $foto['foto']?></p>
     		</div>
        <?php
        }
    }
?>
