<?php

    include("../../apis/base_de_datos.php");
    include("../funciones.php");
    $DB = new dataBase();
    $reportajes = 0;
    
    if(!isset($_POST['filtro'])){
        $reportajes = $DB->getBodas();
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
        $reportajes = $DB->getBodasOrden(array($filtro,$orden));
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
                Cliente 
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
            $id_cliente = $DB->getClienteReportaje(array($reportaje['codigo']));
            if($id_cliente != -1){
                $cliente = $DB->getCliente(array($id_cliente));
                $mostrar = '<p onclick="mostrar_datos('.$cliente['codigo'].')">'.$cliente['nombre'].'</p>';
            }else{
                $mostrar = '<p class="boton_menus_mini" onclick="crear_cliente_boda('.$reportaje['id'].')">+</p>';
            }
            $fila = $fila + 1;
        ?>
    <tr data-fila="<?= $fila ?>" data-pagina="<?= $pagina ?>" class="fila <?= $clase ?>">
        <td>
            <h6 class="mb-0 text-sm">
                <?= fecha_corta($reportaje['fecha_entrada']) ?>
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm">
                <?= $mostrar ?>
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" <?php echo ($reportaje['enviadas'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="enviadas" name="enviadas<?= $reportaje['id'] ?>" id="enviadas<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" <?php echo ($reportaje['recibidas'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="recibidas" name="recibidas<?= $reportaje['id'] ?>" id="recibidas<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" <?php echo ($reportaje['maquetadas'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="maquetadas" name="maquetadas<?= $reportaje['id'] ?>" id="maquetadas<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" <?php echo ($reportaje['ok'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="ok" name="ok<?= $reportaje['id'] ?>" id="ok<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" <?php echo ($reportaje['enviadas_dp'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="enviadas_dp" name="enviadas_dp<?= $reportaje['id'] ?>" id="enviadas_dp<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm text-center">
                <input type="checkbox" class="check-box-estado" <?php echo ($reportaje['recibido_album'] == 1) ? 'checked' : ''; ?> data-id="<?= $reportaje['id'] ?>" data-tipo="recibido_album" name="album<?= $reportaje['id'] ?>" id="album<?= $reportaje['id'] ?>" >
            </h6>
        </td>
        <td class="align-middle text-center">
            <button class="btn btn-link text-secondary mb-0" onclick="mostrar_datos('<?= $reportaje['codigo'] ?>')" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-eye" style="font-size:32px;"></i>
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
<ul class="pagination" id="reportajes_pag">
    <?php
    $activar = "active";
    foreach ($paginacion as $pag) {
    if($pag != 1){
        $activar = "";
    }
    ?>
    <li class="page-item <?= $activar?>" onclick="paginar(this, 'reportajes', 'reportajes_pag')" data-pagina="<?= $pag ?>"><p class="page-link"><?= $pag ?></p></li>
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