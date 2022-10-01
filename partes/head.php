<?php
	  include "configuracion.php";
?>
<!DOCTYPE html>
<html style="font-size: 14px;font-family: Roboto, Arial, sans-serif;" lang="es-ES" system-icons="" typography="" typography-spacing="" standardized-themed-scrollbar="">

<head>
  	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5, minimum-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">	

	<link rel="apple-touch-icon" sizes="57x57" href="<?= $url_base ?>assets/img/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?= $url_base ?>assets/img/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= $url_base ?>assets/img/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= $url_base ?>assets/img/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= $url_base ?>assets/img/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?= $url_base ?>assets/img/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?= $url_base ?>assets/img/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= $url_base ?>assets/img/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= $url_base ?>assets/img/favicon/apple-icon-180x180.png">
	<link rel="apple-touch-icon" sizes="512x512" href="<?= $url_base ?>assets/img/logo/maskable2.png"/>
	<link rel="apple-touch-icon" sizes="720x720" href="<?= $url_base ?>assets/img/logo/logo-xl.png"/>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="#FFFFFF">
	<meta name="apple-mobile-web-app-title" content="<?= $title ?>">
	<link rel="apple-touch-startup-image" href="<?= $url_base ?>assets/img/logo/maskable2.png">

	<link rel="icon" type="image/png" sizes="16x16" href="<?= $url_base ?>assets/img/favicon/favicon-16x16.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= $url_base ?>assets/img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= $url_base ?>assets/img/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="192x192" href="<?= $url_base ?>assets/img/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="512x512" href="<?= $url_base ?>assets/img/logo/maskable2.png"/>
	<link rel="icon" type="image/png" sizes="720x720" href="<?= $url_base ?>assets/img/logo/logo-lg.png"/>
	<link rel="icon" type="image/png" sizes="1024x1024" href="<?= $url_base ?>assets/img/logo/logo-xl.png"/>
	<link rel="icon" type="image/png" href="<?= $url_base ?>assets/img/logo/maskable2.png"/>

	<meta name="title" content="<?= $title ?>">
	<title><?= $title ?></title>
	<meta http-equiv="Cache-control" content="public">
	<meta name="description" content="<?= $description ?>">
	<meta name="keywords" content="<?= $keywords ?>">
	<link rel="shortlinkUrl" href="<?= $url_base ?>">
	<!-- <link rel="alternate" href="android-app://com.google.android.youtube/http/www.youtube.com/watch?v=VuYl6SmsCuc&amp;feature=youtu.be">
	<link rel="alternate" href="ios-app://544007664/vnd.youtube/www.youtube.com/watch?v=VuYl6SmsCuc&amp;feature=youtu.be"> -->
	<link rel="alternate" type="application/json+oembed" href="<?= $url_base ?>" title="<?= $title ?>">
	<link rel="alternate" type="text/xml+oembed" href="<?= $url_base ?>" title="<?= $title ?>">
	<link rel="image_src" href="<?= $logo_share ?>">

	<meta name="msapplication-TileImage" content="<?= $url_base ?>assets/img/logo/maskable2.png">
	<meta name="robots" content="index, follow">
	<meta name="locality" content="Zaragoza, España">
	<meta name="locality" content="Las Palmas, España"> 
	<meta name="geo.placename" content="Zaragoza">
	<meta name="geo.placename" content="Las Palmas">
	<meta name="geo.region" content="ES">

	<meta property="og:type" content="website">
	<meta property="og:title" content="<?= $title ?>">
	<meta property="og:url" content="<?= $url_base ?>">
	<meta property="og:image" content="<?= $logo_share ?>"> 
	<meta property="og:description" content="<?= $description ?>">

	<meta property="og:site_name" content="<?= $title ?>">
	<meta property="og:url" content="<?= $url_base ?>">
	<meta property="og:title" content="<?= $title ?>">
	<meta property="og:image" content="<?= $logo_share ?>">
	<meta property="og:image:width" content="<?= $ancho ?>">
	<meta property="og:image:height" content="<?= $alto ?>">
	<meta property="og:description" content="<?= $description ?>">
	<!-- <meta property="al:ios:app_store_id" content="544007664"> -->
	<meta property="al:ios:app_name" content="<?= $title ?>">
	<meta property="al:ios:url" content="<?= $url_base ?>">
	<meta property="al:android:url" content="<?= $url_base ?>">
	<meta property="al:web:url" content="<?= $url_base ?>">
	<!-- <meta property="og:type" content="video.other"> -->
	<!-- <meta property="og:video:url" content="https://www.youtube.com/embed/VuYl6SmsCuc">
	<meta property="og:video:secure_url" content="https://www.youtube.com/embed/VuYl6SmsCuc">
	<meta property="og:video:type" content="text/html">
	<meta property="og:video:width" content="<= $ancho ?>">
	<meta property="og:video:height" content="<= $alto?>"> -->
	<!-- <meta property="al:android:app_name" content="<= $title ?>">
	<meta property="al:android:package" content="com.google.android.youtube">
	<meta property="fb:app_id" content="87741124305"> -->

	<meta itemprop="image" content="<?= $logo_share ?>">
	<meta itemprop="author" content="David Enamorado">
	<meta itemprop="name" content="<?= $title ?>">
	<meta itemprop="headline" content="<?= $title ?>">
	<meta itemprop="description" content="<?= $description ?>">

	<meta name="twitter:card" content="website">
	<meta name="twitter:site" content="<?= $title ?>">
	<meta name="twitter:url" content="<?= $url_base ?>">
	<meta name="twitter:title" content="<?= $title ?>">
	<meta name="twitter:description" content="<?= $description ?>">
	<meta name="twitter:image" content="<?= $logo_share ?>">
	<!-- <meta name="twitter:app:name:iphone" content="<= $title ?>">
	<meta name="twitter:app:id:iphone" content="544007664">
	<meta name="twitter:app:name:ipad" content="<= $title ?>">
	<meta name="twitter:app:id:ipad" content="544007664">
	<meta name="twitter:app:url:iphone" content="vnd.youtube://www.youtube.com/watch?v=VuYl6SmsCuc&amp;feature=youtu.be&amp;feature=applinks">
	<meta name="twitter:app:url:ipad" content="vnd.youtube://www.youtube.com/watch?v=VuYl6SmsCuc&amp;feature=youtu.be&amp;feature=applinks">
	<meta name="twitter:app:name:googleplay" content="<= $title ?>">
	<meta name="twitter:app:id:googleplay" content="com.google.android.youtube">
	<meta name="twitter:app:url:googleplay" content="<= $url_base ?>"> -->
	<!-- <meta name="twitter:player" content="https://www.youtube.com/embed/VuYl6SmsCuc">
	<meta name="twitter:player:width" content="<= $ancho ?>">
	<meta name="twitter:player:height" content="<= $alto?>"> -->
	<meta name="referrer" content="origin-when-cross-origin">




	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

	<!-- Nucleo Icons -->
	<link href="<?= $url_base ?>assets/css/nucleo-icons.css" rel="stylesheet" />
	<link href="<?= $url_base ?>assets/css/nucleo-svg.css" rel="stylesheet" />

	<!-- Font Awesome Icons -->
	<script src="<?= $url_base ?>assets/js/kit.js" crossorigin="anonymous"></script>

	<!-- Material Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

	<!-- CSS Files -->
	<link id="pagestyle" href="<?= $url_base ?>assets/css/material-dashboard.v-4.css" rel="stylesheet" />
	<link rel="manifest" href="<?= $url_base ?>manifest.json">

	<!-- <script src="https://cdn.lr-in.com/LogRocket.min.js" crossorigin="anonymous"></script> 
	<script>window.LogRocket && window.LogRocket.init('kpyxrr/panel-admin');</script> -->
	<meta name="theme-color" content="#f0f2f5">
</head>