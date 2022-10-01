<?php
session_start();
$_SESSION['usuario']= "fewSDFAWEw324";
if(isset($_SESSION['usuario'])){
  include('../api/base_de_datos.php');
  $DB = new dataBase();

  $casas = $DB->getCasasByUser(array($_SESSION['usuario']));

  $reservas_casas      = array();
  $huespedes           = array();
  $huespedes_completos = 0;
  $huespedes_parcial   = 0;

  if($casas != 0){

    foreach ($casas as $casa) {
       $reservas = $DB->getReservasByCasa(array($casa['codigo']));       
       $reservas_casas = array_merge($reservas_casas, $reservas);
    }

    $reservas_mes = 0;
    $fecha_actual = new DateTime();
    $x1 = $fecha_actual->format('Y');
    $x2 = $fecha_actual->format('m');

    if(!empty($reservas_casas)){
      foreach ($reservas_casas as $reserva) {
  
        $huespedes_reserva = $DB->getPersonasPorReserva(array($reserva['codigo']));
        $huespedes = array_merge($huespedes_reserva, $huespedes);
  
        $fecha_entrada = new DateTime($reserva['inicio']);
        $x3 = $fecha_entrada->format('Y');
        $x4 = $fecha_entrada->format('m');
        if($x1 == $x3 && $x2 == $x4){
          $reservas_mes = $reservas_mes+1;
        }
      }

      if(!empty($huespedes)){
        foreach ($huespedes as $huesped) {
          if($huesped['codigo_reserva'] != "" && $huesped['nombre'] != "" && 
             $huesped['documento'] != "" && $huesped['tipo_documento'] != "" &&
             $huesped['fecha_documento'] != "" && $huesped['sexo'] != "" &&
             $huesped['fecha_nacimiento'] != "" && $huesped['pais'] != "" &&
             $huesped['codigo'] != "" && $huesped['firma'] != ""){
              $huespedes_completos = $huespedes_completos+1;
          }else{
              $huespedes_parcial = $huespedes_parcial+1;
          }
        }
      }

    }

  }
  
  $DB->desconectar();
}
$titulo      = "Registro de húespedes seguro para cumplir la normativa.";
$descripcion = "Evita sanciones guardando los datos de los húespedes para la policia, cumple la normativa actual de acuerdo con la Ley
Orgánica 3/2018 de Protección de Datos Personales y garantía de
los derechos digitales";

$iconos      = "registros.png";
$svg         = "registros.svg";
$url         = "";
$compartir   = "";

?>
<!DOCTYPE html>
<html style="font-size: 14px;font-family: Roboto, Arial, sans-serif;" lang="es-ES" system-icons="" typography="" typography-spacing="" standardized-themed-scrollbar="">
<head>
  <meta charset='utf-8'>

  <title><?= $titulo ?></title>

  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta http-equiv="Cache-control" content="public">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="robots" content="no-index, no-follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <meta itemprop="author" content="David Enamorado">
  <meta itemprop="name" content="Boggiero 62 3ºC">
  <meta itemprop="description" content="<?= $descripcion ?>">

  <link rel="apple-touch-icon" sizes="180x180" href="<?= $icono ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= $icono ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= $icono ?>">
  <link rel="icon" type="image/png" sizes="192x192" href="<?= $icono ?>">
  <link rel="mask-icon" href="<?= $svg ?>">
  <link rel="shortcut icon" href="<?= $icono ?>">


  <!-- <link rel="manifest" href="<= $url ?>manifest.json"> -->

  <link rel="canonical" href="<?= $url.$compartir ?>">
  <link rel="shortlinkUrl" href="<?= $url.$compartir ?>">
  <link rel="alternate" type="application/json+oembed" href="<?= $url ?>" title="<?= $titulo ?>">
  <link rel="alternate" type="text/xml+oembed" href="<?= $url ?>" title="<?= $titulo ?>">
  <link rel="image_src" href="<?= $icono ?>">


  <meta name="description" content="<?= $descripcion ?>">
  <meta name="robots" content="index, follow">
  <meta name="locality" content="Zaragoza, España">
  <meta name="geo.placename" content="Zaragoza">
  <meta name="geo.region" content="ES">


  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= $titulo ?>">
  <meta property="og:url" content="<?= $url.$compartir  ?>">
  <meta property="og:title" content="<?= $titulo ?>">
  <meta property="og:image" content="<?= $icono ?>">
  <meta property="og:image:width" content="720">
  <meta property="og:image:height" content="720">
  <meta property="og:image:alt" content="Esther Blasco Serrano">
  <meta property="og:description" content="<?= $descripcion ?>">


  <meta property="al:ios:app_name" content="<?= $titulo ?>">
  <meta property="al:ios:url" content="<?= $url.$compartir  ?>">
  <meta property="al:android:url" content="<?= $url.$compartir  ?>">
  <meta property="al:web:url" content="<?= $url.$compartir  ?>">


  <meta name="twitter:card" content="website">
  <meta name="twitter:site" content="<?= $titulo ?>">
  <meta name="twitter:url" content="<?= $url.$compartir ?>">
  <meta name="twitter:title" content="<?= $titulo ?>">
  <meta name="twitter:description" content="<?= $descripcion ?>">
  <meta name="twitter:image" content="<?= $icono ?>">
  <meta name="twitter:image:width" content="720">
  <meta name="twitter:image:height" content="720">

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

	<!-- Nucleo Icons -->
	<link href="assets/css/nucleo-icons.css" rel="stylesheet" />
	<link href="assets/css/nucleo-svg.css" rel="stylesheet" />

	<!-- Font Awesome Icons -->
	<script src="assets/js/kit.js" crossorigin="anonymous"></script>

	<!-- Material Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

	<!-- CSS Files -->
	<link id="pagestyle" href="assets/css/material-dashboard.v-2.css" rel="stylesheet" />
	<!-- <link rel="manifest" href="manifest.json"> -->

	<meta name="theme-color" content="#f0f2f5">
  <style>
    main{
      scroll-behavior: smooth;
    }
  </style>
</head>
<body class="g-sidenav-show  bg-gray-200">
  <div class="min-height-400 bg-gradient-primary position-absolute w-100 z-index-0" id="fondo-sup">
    <div class="position-absolute w-100 z-index-1 bottom-0">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
            </defs>
            <g class="moving-waves">
            <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40"></use>
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
            <use xlink:href="#gentle-wave" x="48" y="6" fill="rgba(255,255,255,0.25)"></use>
            <use xlink:href="#gentle-wave" x="48" y="9" fill="rgba(255,255,255,0.20)"></use>
            <use xlink:href="#gentle-wave" x="48" y="15" fill="rgba(255,255,255,0.15)"></use>
            <use id="ola" xlink:href="#gentle-wave" x="48" y="16" fill="rgba(240,242,245,1)"></use>
            </g>
        </svg>
    </div>
  </div>
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps bg-white" id="sidenav-main">
    <div class="sidenav-header">
      <i translate="no"class="fas fa-times p-3 cursor-pointer opacity-5 position-absolute end-0 top-0 d-xl-none" style="position: absolute !important; width: 50px !important;height: 50px !important;" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="javascript:void(0)" target="_blank">
        <img src="assets/img/brocoli.min.gif" style="width: 70px !important;height: 70px !important;margin: auto; background: transparent;" alt="Logo"></img>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-primary mis-botones" href="#navbarBlur">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i translate="no"class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Cuadro de mandos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mis-botones" href="#reservas">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i style="width: 30px;" class="material-icons opacity-10"><img style="width: 100%;height: 100%;" src="../assets/images/cliente.png" alt=""></i>
            </div>
            <span class="nav-link-text ms-1">RESERVAS</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mis-botones" href="javascript:void(0);">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i style="width: 30px;" class="material-icons opacity-10"><img style="width: 100%;height: 100%;" src="../assets/images/documentos.png" alt=""></i>
            </div>
            <span class="nav-link-text ms-1">HÚESPEDES</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-8">AJUSTES</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link mis-botones" href="comuniones.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i style="width: 30px;" class="material-icons opacity-10"><img style="width: 100%;height: 100%;" src="../assets/images/comunion.png" alt=""></i>
            </div>
            <span class="nav-link-text ms-1">PERFIL</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mis-botones" href="javascript:void(0);">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i style="width: 30px;" class="material-icons opacity-10"><img style="width: 100%;height: 100%;" src="../assets/images/boda.png" alt=""></i>
            </div>
            <span class="nav-link-text ms-1">CONFIGURACION</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <button class="btn btn-primary bg-gradient-primary mt-4 w-100 mis-botones active" onclick="proceso_ajax()" type="button">Proceso de alertas</button>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg" style="min-height: 100vh;display: grid;align-items: center;">
    <style>
      .input-group.input-group-outline.focused .form-label,
      .input-group.input-group-outline.focused.is-focused .form-label,
      .input-group.input-group-outline.is-filled .form-label {
        height: 12px;
      }
      .dark-version .navbar-main h1, .sidenav.bg-transparent .navbar-nav h1, .bg-white h1 {
          font-size: 1rem;
          font-weight: 700 !important;
          line-height: 1.625;
      }
    </style>
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 border-radius-xl my-3 bg-white" style="margin: 1rem 1rem auto 1rem !important;max-height: 60px;scroll-margin-top: 2rem;" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" id="bread">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-2">
            <li class="breadcrumb-item text-sm"><a class="opacity-5" href="javascript:;">Páginas</a></li>
            <li class="breadcrumb-item text-sm active" aria-current="page">Cuadro de mandos</li>
          </ol>
          <h1 class="font-weight-bolder mb-0">- Panel de administración 2022 -</h1>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 ms-md-0 ms-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i translate="no"class="sidenav-toggler-line"></i>
                  <i translate="no"class="sidenav-toggler-line"></i>
                  <i translate="no"class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <!-- Tarjetas de datos brutos -->
      <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i translate="no" class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <h2 class="text-sm mb-0 text-capitalize">Reservas Totales</h2>
                <h3 class="mb-0"><?= count($reservas_casas) ?></h3>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <h4 class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55%</span> que la última semana</p>
            </h4>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i translate="no" class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <h2 class="text-sm mb-0 text-capitalize">Este mes</h2>
                <h3 class="mb-0"><?= $reservas_mes ?></h3>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <h4 class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3%</span> que el último mes</p>
            </h4>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i translate="no" class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <h2 class="text-sm mb-0 text-capitalize">Húespedes registrados</h2>
                <h3 class="mb-0"><?= $huespedes_completos ?></h3>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <h4 class="card-footer p-3">
              <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-5%</span> que el último mes</p>
            </h4>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i translate="no" class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <h2 class="text-sm mb-0 text-capitalize">Pendientes</h2>
                <h3 class="mb-0"><?= $huespedes_parcial ?></h3>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <h4 class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+7% </span> que el último mes</p>
            </h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col mt-4 mb-4">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-dark border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line-tasks" class="chart-canvas" height="170" style="display: block; box-sizing: border-box; height: 170px; width: 353.2px;" width="353"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h2 class="mb-0 ">Húespedes por mes</h2>
              <h3 class="text-sm ">Rendimiento anual</h3>
              <hr class="dark horizontal">
              <h4 class="d-flex ">
                <i translate="no" class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm">recién actualizado</p>
              </h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary mis-botones active border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3" style="align-items: center;display: flex;flex-direction: row;justify-content: space-between;">Reservas<p class="boton_menus" onclick="crear_reserva()">+</p></h6>
              </div>
            </div>
            <style>
              td:nth-child(2), th:nth-child(2){
                position: sticky;
                left: 0;
                background: #fff !important;
                z-index: 5;
                opacity: 1 !important;
              }
            </style>
            <div class="card-body px-0 pb-2" id="reservas">

              <!-- Cargar tabla con todos los clientes -->

            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer py-4" style="margin: auto 1rem 0 1rem !important;">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <div class="m-4">
                <div class="copyright text-center text-sm text-muted">
                © <span>2022</span>
                hecho con <i translate="no"class="fa fa-heart"></i> por
                Enamorado digital
                para una web mejor.
                </div>
            </div>
        </div>
      </div>
    </footer>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/sweetalert2.all.min.js"></script>
  <script src="assets/js/core/alerts.js"></script>
  <script src="assets/js/plugins/all.min.js"></script>
  <script src="assets/js/plugins/axios.min.js"></script>
  <script src="assets/js/material-dashboard.js?v=3.2"></script>
  <script src="jquery.min.js"></script>
  <script src="assets/js/funciones.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script>

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
      type: "line",
      data: {
        labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        datasets: [{
          label: "Tareas",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [70, 100, 350, 50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#f8f9fa',
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script>
    var alerta;

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    function crear_reserva(){
      Swal.fire("¡Nuevo documento!", 'Sin hacer', "info") 
    }

    function sincornizar_reservas(params = []){
      var params = params;
      $.ajax({
          data: params,
          url:   'importar_calendario.php',
          type:  'post',
          beforeSend: function () {
          },
          success: function (response) { 
              document.getElementById('reservas').innerHTML = response; 
          },
          error: function (response) { 
              document.getElementById('reservas').innerHTML = response;              
          }
      });
    }

    sincornizar_reservas();
    
    </script>
</body>

</html>