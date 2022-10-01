
<?php 
session_start();
$_SESSION['casa'] = "CzIrl5okMrbg";
$_SESSION['usuario'] = "Yo";
if(isset($_POST['url'])){
    $url = $_POST['url']; // url de la pagina que queremos obtener  

}else{
    // $url = "https://www.airbnb.es/calendar/ical/711473003468379655.ics?s=ec23a24c1630e69a546dd58129c02d60";// url de airbnb OSCAR
    $url = "https://www.airbnb.es/calendar/ical/671687520453196826.ics?s=adb2ba7f87625c4a3d1a58603294bc8a"; // url de airbnb DAVID
    // $url = "https://admin.booking.com/hotel/hoteladmin/ical.html?t=1a18cf96-1bab-4588-95b2-ee93b4e3c556"; // url de booking DAVID
    
}
$url_content = '';  
$file = @fopen($url, 'r');  
if($file){  
  while(!feof($file)) {  
    $url_content .= @fgets($file, 4096);  
  }  
  fclose ($file);  
}  

// echo $url_content;

include('iCalEasyReader.php');
include('../api/base_de_datos.php');
$ical = new iCalEasyReader();
$lines = $ical->load($url_content);

function crear_fecha($valor){
    $dia = substr($valor, -2);
    $mes = substr($valor, -4, -2);
    $ano = substr($valor, 0, -4);
    return $ano."-".$mes."-".$dia;
}

$reservas = array();
foreach($lines['VEVENT'] as $evento){
    $control = false;
    $inicio  = false;
    $fin     = false;
    $codigo  = false;
    $detalle = false;
    foreach($evento as $clave => $valor){
        // echo $clave." => ".$valor."<br>";
        if($clave == "DTEND"){
            $fin = crear_fecha($valor['VALUE']);
        }
        if($clave == "DTSTART"){
            $inicio = crear_fecha($valor['VALUE']);
        }
        if($clave == "UID"){
            $codigo = explode("@",$valor);
            $codigo = explode("-",$codigo[0]);
        }
        if($clave == "DESCRIPTION"){
            $detalle = explode("\nPhone",$valor);
            $detalle = explode(" ",$detalle[0]);
        }
        if($clave == "SUMMARY" && $valor ="Reserved"){
            $control = true;
        }else{
            $control = false;
        }
    }
    if($control && isset($detalle[2])){
        $reservas[] = array("evento" => array("INICIO" => $inicio, "FIN" => $fin, "CODIGO" => $codigo[1], "URL" => $detalle[2]));
    }
    
}

$reservas_bd = 0;
$DB = new dataBase();

$casa = $DB->getCasaByCodigo(array($_SESSION['casa']));

if(!isset($_POST['filtro'])){
    $reservas_bd = $DB->getReservasByCasa(array($_SESSION['casa']));
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
    $reservas_bd = $DB->getReservasByCasaOrden(array($_SESSION['casa'],$filtro,$orden));
}

function str_contain($needle, $haystack, $insensitive = false) {
    return $insensitive ? false !== stristr($haystack, $needle) : false !== strpos($haystack, $needle);
}

/**
 * Sincronizar los datos que vienen del calendario con la base de datos filtrando primero que no estén por medio del key url
 */
if($reservas_bd != 0){
    //Buscar repetidas
    if($reservas != 0){ 
        foreach ($reservas as $res) {
            $buscar = explode("/",$res['evento']['URL']);     
            $buscar = end($buscar);
            $control_array = true;
            foreach ($reservas_bd as $res_bd) { 
                if(str_contain($buscar,$res_bd['url'])){
                    $control_array = false;
                }
            }
            if($control_array){
                echo $DB->nuevaReserva(array('desconocido', $res['evento']['INICIO'], $res['evento']['FIN'], 0, $res['evento']['CODIGO'], $_SESSION['casa'], $res['evento']['URL']));
            }
        }
    }

}else{
    //No hay ninguna reserva registrada, todas para dentro
    foreach ($reservas as $res) {
        $DB->nuevaReserva(array('desconocido', $res['evento']['INICIO'], $res['evento']['FIN'], 0, $res['evento']['CODIGO'], $_SESSION['casa'], $res['evento']['URL']));
    }
}



$DB->desconectar();

// echo json_encode($reservas);

$resaltar = 'style="color: #111 !important; font-weight: bold;"';
$asc = '<i class="bi bi-arrow-up-square-fill"></i>';
$desc = '<i class="bi bi-arrow-down-square-fill"></i>';
$asc_res = '<i class="bi bi-arrow-up-square-fill" '.$resaltar.'></i>';
$desc_res = '<i class="bi bi-arrow-down-square-fill" '.$resaltar.'></i>';
if($reservas_bd!= 0){
?>
<div class="table-responsive p-0">
<table class="table align-items-center justify-content-center mb-0">
<thead>
<tr data-pagina="cabecera" class="fila active">
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
        <p class="encabezado" <?php echo ($filtro == "nombre") ? $resaltar : ''?>>
            Casa
            <span data-filtro="nombre" data-orden="<?php echo ($filtro == "nombre") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "nombre") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
        </p>
    </th>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
        <p class="encabezado" <?php echo ($filtro == "apellidos") ? $resaltar : ''?>>
            Nombre
            <span data-filtro="apellidos" data-orden="<?php echo ($filtro == "apellidos") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "apellidos") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
        </p>
    </th>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
        <p class="encabezado" <?php echo ($filtro == "dato") ? $resaltar : ''?>>
            Inicio
            <span data-filtro="dato" data-orden="<?php echo ($filtro == "dato") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "dato") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
        </p>
    </th>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
        <p class="encabezado" <?php echo ($filtro == "dni") ? $resaltar : ''?>>
            Fin
            <span data-filtro="dni" data-orden="<?php echo ($filtro == "dni") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "dni") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
        </p>
    </th>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
        <p class="encabezado">
            Personas
        </p>
    </th>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
        <p class="encabezado" <?php echo ($filtro == "email") ? $resaltar : ''?>>
            Url
            <span data-filtro="email" data-orden="<?php echo ($filtro == "email") ? $inverso : "DESC"?>" onclick="orden(this)"><?php echo ($filtro == "email") ? ($inverso == "ASC") ? $asc_res : $desc_res : $desc ?></span>
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

    foreach ($reservas_bd as $reserva) {
    $fila = $fila + 1;
    ?>
    <tr data-fila="<?= $fila ?>" data-pagina="<?= $pagina ?>" class="fila <?= $clase ?>" onclick="ir_a_reserva('<?= $reserva['codigo'] ?>')">
        <td class="mb-0 text-center">
            <h6>
                <?= $casa['nombre'] ?>
            </h6>
        </td>
        <td class="mb-0 text-center">
            <h6>
                <?= $reserva['nombre'] ?>
            </h6>
        </td>
        <td class="mb-0 text-center">
            <h6>
                <?= $reserva['inicio'] ?>
            </h6>
        </td>
        <td class="mb-0 text-center">
            <h6>
                <?= $reserva['fin'] ?>
            </h6>
        </td>
        <td class="mb-0 text-center">
            <h6>
                <?= $reserva['numero'] ?>
            </h6>
        </td>
        <td class="mb-0 text-center">
            <a class="btn btn-link text-secondary mb-0" target="_blank" href="https://www.boggiero62.mifuturapp.com/reserva/<?= $_SESSION['casa'] ?>/<?= $reserva['codigo'] ?>" aria-haspopup="true" aria-expanded="false">
                Ir a la página
            </a>
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
<ul class="pagination" id="reservas_pag">
<?php
$activar = "active";
foreach ($paginacion as $pag) {
if($pag != 1){
    $activar = "";
}
?>
<li class="page-item <?= $activar?>" onclick="paginar(this, 'reservas', 'reservas_pag')" data-pagina="<?= $pag ?>"><p class="page-link"><?= $pag ?></p></li>
<?php
}
?>
</ul>
<p><?= count($reservas_bd) ?> Resultados</p>
</nav>
<?php
}else{ 
echo '<p class="text-center">No hay reservas</p>';
}
