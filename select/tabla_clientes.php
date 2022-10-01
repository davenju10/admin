<?php

    include("../../apis/base_de_datos.php");
    $DB = new dataBase();
    $clientes = 0;
    
    if(!isset($_POST['filtro'])){
        $clientes = $DB->getClientes();
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
        $clientes = $DB->getClientesOrden(array($filtro,$orden));
    }

    $DB->desconectar();
    $resaltar = 'style="color: #111 !important; font-weight: bold;"';
    $asc = '<i class="bi bi-arrow-up-square-fill"></i>';
    $desc = '<i class="bi bi-arrow-down-square-fill"></i>';
    $asc_res = '<i class="bi bi-arrow-up-square-fill" '.$resaltar.'></i>';
    $desc_res = '<i class="bi bi-arrow-down-square-fill" '.$resaltar.'></i>';
    if($clientes != 0){
?>
<div class="table-responsive p-0">
<table class="table align-items-center justify-content-center mb-0">
    <thead>
    <tr data-pagina="cabecera" class="fila active">
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "nombre") ? $resaltar : ''?>>
                Nombre 
                <span data-filtro="nombre" data-orden="<?php echo ($filtro == "nombre") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "nombre") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "apellidos") ? $resaltar : ''?>>
                Apellidos
                <span data-filtro="apellidos" data-orden="<?php echo ($filtro == "apellidos") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "apellidos") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "dato") ? $resaltar : ''?>>
                Dato
                <span data-filtro="dato" data-orden="<?php echo ($filtro == "dato") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "dato") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "dni") ? $resaltar : ''?>>
                Dni
                <span data-filtro="dni" data-orden="<?php echo ($filtro == "dni") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "dni") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado">
                Telefono
            </p>
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <p class="encabezado" <?php echo ($filtro == "email") ? $resaltar : ''?>>
                Email
                <span data-filtro="email" data-orden="<?php echo ($filtro == "email") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "email") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
            </p>
        </th>
        <th>
            <p>
                Trabajos
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

        foreach ($clientes as $cliente) {
        $fila = $fila + 1;
        ?>
    <tr data-fila="<?= $fila ?>" data-pagina="<?= $pagina ?>" class="fila <?= $clase ?>" onclick="ir_a_cliente('<?= $cliente['codigo'] ?>')">
        <td>
        <h6 class="mb-0 text-sm">
            <?= $cliente['nombre'] ?>
        </h6>
        </td>
        <td>
        <h6 class="mb-0 text-sm">
            <?= $cliente['apellidos'] ?>
        </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm">
                <?= $cliente['dato'] ?>
            </h6>
        </td>
        <td>
            <h6 class="mb-0 text-sm">
                <?= $cliente['dni'] ?>
            </h6>
        </td>
        <td>
        <h6 class="mb-0 text-sm">
            <?= $cliente['telefono'] ?>
        </h6>
        </td>
        <td>
        <h6 class="mb-0 text-sm">
            <?= $cliente['email'] ?>
        </h6>
        </td>
        <td class="align-middle">
        <button class="btn btn-link text-secondary mb-0" onclick="ir_a_cliente('<?= $cliente['codigo'] ?>')" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-pencil-square" style="font-size: large;"></i>
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
<ul class="pagination" id="clientes_pag">
    <?php
    $activar = "active";
    foreach ($paginacion as $pag) {
    if($pag != 1){
        $activar = "";
    }
    ?>
    <li class="page-item <?= $activar?>" onclick="paginar(this, 'clientes', 'clientes_pag')" data-pagina="<?= $pag ?>"><p class="page-link"><?= $pag ?></p></li>
    <?php
    }
    ?>
</ul>
<p><?= count($clientes) ?> Resultados</p>
</nav>
<?php

}else{ 
    echo '<p class="text-center">No hay clientes</p>';
}