<div class="clearfix"></div>
<footer>
    <div class="container col-xs-12 col-sm-8 col-sm-offset-2 ">
        <div class="author">&copy; Paweł Liwocha</div>
        <div class="clearfix"></div>
    </div>
</footer>
<?php if(!isset($_COOKIE['AcceptCookies'])) { ?>
<div class="CookiesBox">
    <div class="CookiesBoxIn">
        <div class="CookiesBoxInLeft">
            We use cookies and other tracking technologies to&nbsp;improve your browsing experience on&nbsp;our web site, to&nbsp;show you personalized content, to&nbsp;analyze our website traffic, and&nbsp;to&nbsp;understand where our visitors are coming from.
            <div class="clearfix"></div>
        </div>
        <div class="CookiesBoxInRight">
            <a class="CookiesGot">Got it!</a>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php } ?>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/js.js?<?php echo filemtime('js/js.js'); ?>" type="text/javascript"></script>
<?php
    if (isset($this->js)) {
        foreach ($this->js as $js) {
            echo '<script type="text/javascript" src="/views/'.$js.'?'.filemtime('views/'.$js).'"></script>';
        }
    }
?>
</body>
</html>