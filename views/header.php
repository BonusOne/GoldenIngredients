<!DOCTYPE html>
<html itemscope itemtype="https://schema.org/WebSite">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php if(isset($this->TitlePage)) { echo $this->TitlePage; } else { echo "Golden"; } ?></title>
    <meta name="keywords" content="<?php if(isset($this->keywords)) { echo $this->keywords; } else { echo "Golden"; } ?>" />
    <meta name="description" content="<?php if(isset($this->description)) { echo $this->description; } else { echo "Golden"; } ?>" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- name="author" content="Paweł Liwocha" -->
    
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/navfont.css">
    <?php /*<link rel="stylesheet" href="/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="/css/jquery-ui.structure.min.css" />
    <link rel="stylesheet" href="/css/jquery-ui.theme.min.css" />*/?>
    <link rel="stylesheet" href="/css/style.css?<?php echo filemtime('css/style.css'); ?>" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<?php /*<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>*/?>
    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <?php 
       if(isset($_COOKIE['AcceptCookies'])) {
            $AcceptCookies = $_COOKIE['AcceptCookies'];
       }
	 ?>
</head>
<body class="<?php if(isset($this->NavBold)){ echo $this->NavBold;} ?> <?php if(isset($this->NavSub)){ echo $this->NavSub;} ?>">
<header class="container col-xs-12">
    <div id="LogoA" class="col-xs-8 col-xs-offset-2 col-sm-2 col-sm-offset-2 col-md-2 col-md-offset-2">
        <a href="/" class="">
            <img src="/images/logo-pl.png" class="Logo" alt="Golden" title="Golden" />
            Golden
        </a>
    </div>
    <a href="/admin" style="margin-left: 100px;">Go to admin</a>
    <?php
        //require 'navigation.php';
    ?>
    <div class="clearfix"></div>
</header>
<div class="clearfix"></div>