<?php

    include("../../apis/base_de_datos.php");
    include("../funciones.php");
    $DB = new dataBase();
    $reportajes = 0;
    
    if(!isset($_POST['filtro'])){
        $comuniones = $DB->getComuniones();
        $otros      = $DB->getComunionSinUser();
        $filtro = "";
        $orden  = "DESC";
        $inverso = "ASC";
    }else{
        $filtro = $_POST['filtro'];
        $orden  = $_POST['orden'];
        $inverso = "ASC";
        if($orden == "ASC"){
            $inverso = "DESC";
        }
        $comuniones = $DB->getComunionesOrden(array($filtro,$orden));
        $otros      = $DB->getComunionSinUser();
    }
    if($otros != 0){
        $reportajes = array_merge($comuniones,$otros);
    }else{
        $reportajes = $comuniones;
    }
    $resaltar = 'style="color: #111 !important; font-weight: bold;"';
    $asc = '<i class="bi bi-arrow-up-square-fill"></i>';
    $desc = '<i class="bi bi-arrow-down-square-fill"></i>';
    $asc_res = '<i class="bi bi-arrow-up-square-fill" '.$resaltar.'></i>';
    $desc_res = '<i class="bi bi-arrow-down-square-fill" '.$resaltar.'></i>';
    if($reportajes != 0){
?>
<div class="table-responsive p-0">
<table class="table align-items-center justify-content-center mb-0">
    <thead>
    <tr data-pagina="cabecera" class="fila active">
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "fecha_entrada") ? $resaltar : ''?>>
                Fecha
                <span data-filtro="fecha_entrada" data-orden="<?php echo ($filtro == "fecha_entrada") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "fecha_entrada") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado">
                Tag 
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "nombre") ? $resaltar : ''?>>
                Cliente 
                <span data-filtro="nombre" data-orden="<?php echo ($filtro == "nombre") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "nombre") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "enviadas") ? $resaltar : ''?>>
                Enviadas 
                <span data-filtro="enviadas" data-orden="<?php echo ($filtro == "enviadas") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "enviadas") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "recibidas") ? $resaltar : ''?>>
                Recibidas 
                <span data-filtro="recibidas" data-orden="<?php echo ($filtro == "recibidas") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "recibidas") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "maquetadas") ? $resaltar : ''?>>
                Maquetadas
                <span data-filtro="maquetadas" data-orden="<?php echo ($filtro == "maquetadas") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "maquetadas") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "ok") ? $resaltar : ''?>>
                Ok
                <span data-filtro="ok" data-orden="<?php echo ($filtro == "ok") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "ok") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "enviadas_dp") ? $resaltar : ''?>>
                Enviadas dp
                <span data-filtro="enviadas_dp" data-orden="<?php echo ($filtro == "enviadas_dp") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "enviadas_dp") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "recibido_album") ? $resaltar : ''?>>
                Recibido album
                <span data-filtro="recibido_album" data-orden="<?php echo ($filtro == "recibido_album") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "recibido_album") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-center">
            <p>
                Ver
            </p>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php

        $fila = 0;
        $pagina = 1;
        $paginacion = array(1);
        $clase = "active";

        foreach ($reportajes as $reportaje) {
            if($reportaje["codigo_cliente"] === 0){
                $mostrar = '<p class="boton_menus_mini" style="float:left; margin: auto !important;" onclick="crear_cliente_comunion(\''.$reportaje['codigo'].'\')">+</p>';
            }else{
                $mostrar = '<p onclick="mostrar_datos(\''.$reportaje["codigo_cliente"].'\')">'.$reportaje["nombre"].'</p>';
            }
            $fila = $fila + 1;
        ?>
    <tr data-fila="<?= $fila ?>" data-pagina="<?= $pagina ?>" class="fila <?= $clase ?>">
        <td onclick="mostrar_comunion('<?= $reportaje['codigo'] ?>')">
            <h6 class="mb-0 text-sm text-center">
                <?= fecha_corta($reportaje['fecha_evento']) ?>
            </h6>
        </td>
        <td onclick="mostrar_comunion('<?= $reportaje['codigo'] ?>')">
            <h6 class="mb-0 text-sm">
                <?= $reportaje['tipo'] ?>
            </h6>
        </td>
        <td onclick="mostrar_comunion('<?= $reportaje['codigo'] ?>')">
            <h6 class="mb-0 text-sm">
                <?= $mostrar ?>
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" onchange="modificar_comunion(this)" <?php echo ($reportaje['enviadas'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="enviadas" name="enviadas<?= $reportaje['id'] ?>" id="enviadas_<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" onchange="modificar_comunion(this)" <?php echo ($reportaje['recibidas'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="recibidas" name="recibidas<?= $reportaje['id'] ?>" id="recibidas_<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" onchange="modificar_comunion(this)" <?php echo ($reportaje['maquetadas'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="maquetadas" name="maquetadas<?= $reportaje['id'] ?>" id="maquetadas_<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" onchange="modificar_comunion(this)" <?php echo ($reportaje['ok'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="ok" name="ok<?= $reportaje['id'] ?>" id="ok_<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" onchange="modificar_comunion(this)" <?php echo ($reportaje['enviadas_dp'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="enviadas_dp" name="enviadas_dp<?= $reportaje['id'] ?>" id="enviadas_dp_<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" onchange="modificar_comunion(this)" <?php echo ($reportaje['recibido_album'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="recibido_album" name="album<?= $reportaje['id'] ?>" id="album_<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td class="align-middle text-center">
            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-eye" onclick="mostrar_comunion('<?= $reportaje['codigo'] ?>')" style="font-size:32px;"></i>
            </button>
        </td>
    </tr>          
        <?php
        if(is_int($fila / 8)){
            $pagina = $pagina + 1;
            $paginacion[] = $pagina;
        }
        if($fila >= 8){
            $clase = "";
        }
        }
        ?>
    </tbody>
</table>
</div>
<nav aria-label="Page navigation example" class="navegacion">
<ul class="pagination" id="comuniones_pag">
    <?php
    $activar = "active";
    foreach ($paginacion as $pag) {
    if($pag != 1){
        $activar = "";
    }
    ?>
    <li class="page-item <?= $activar?>" onclick="paginar(this, 'comuniones', 'comuniones_pag')" data-pagina="<?= $pag ?>"><p class="page-link"><?= $pag ?></p></li>
    <?php
    }
    ?>
</ul>
<p><?= count($reportajes) ?> Resultados</p>
</nav>
<?php
}else{ 
    echo '<p class="text-center">no hay reportajes</p>';
}
$DB->desconectar();