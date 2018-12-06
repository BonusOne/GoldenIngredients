<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php if(isset($this->TitlePage)) { echo $this->TitlePage; } else { echo "GoldenSubmarine"; } ?></title>
    <meta name="keywords" content="GoldenSubmarine" />
    <meta name="description" content="GoldenSubmarine" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css?<?php echo date('Hms'); ?>" />
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
</head>
<body style="background-color: #FFF;">
<section id="logins" class="container">
<div class="col-xs-12 text-center loginpas">
    <img src="/images/logo-pl.png" alt="Talkin Things" title="Talkin Things" style="width:230px;" />
    <?php $logged = Session::get('loggedIn'); ?>
</div>
<div class="clearfix"></div>
<?php if($logged == FALSE) { ?>
<div class="toolLogin">
    <form action="/login/loginDo" method="POST" id="LoginForm" class="col-xs-12">
        <div style="position: relative;" class="InputLoginBox">
            <span>Email</span>
            <input type="text" name="login" id="login" class="LoginFormInpu emails" placeholder="email" required="" />
        </div>
        <div class="clearfix"></div>
        <div style="position: relative;" class="InputPassBox">
            <span>Password</span>
            <input type="password" name="pass" id="pass" class="LoginFormInpu passwo" placeholder="Password" required="" />
        </div>
        <div class="clearfix"></div>
        <?php $error = Session::get('loginError'); if(isset($error)) { ?>
            <div class="LogErr"><?php echo Session::get('loginError'); ?></div>
            <div class="clearfix"></div>
        <?php } ?>
        <div class="col-xs-12 col-sm-12" style="padding: 0; text-align: right;">
            <button type="submit" name="submit" class="submit">Login</button>
        </div>
        <div class="clearfix"></div>
    </form>
    <div class="clearfix"></div>
</div>
<?php } else { ?> 
<div class="toolLogin"><a href="/admin" class="indexEnters">Enter</a></div>
<?php } ?>
<div class="clearfix"></div>
</section>
<script type="text/javascript">
$(document).ready(function() {	
    /*$('.indexLogin').click(function(){
        $('.toolLogin').toggle();
    });*/
});
</script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/js.js" type="text/javascript"></script>
<?php
    if (isset($this->js)) {
        foreach ($this->js as $js) {
            echo '<script type="text/javascript" src="/views/'.$js.'"></script>';
        }
    }
?>
</body>
</html>