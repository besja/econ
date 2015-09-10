<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ru-RU"> <!--<![endif]-->
 <?php 

 global $base_path;
 global $base_url;
 global $theme_path;
 ?>
<head>
    <?php print $head; ?> 
    <title><?php print $head_title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Lora:400,500,700|Roboto:400,300,500,700,900&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <?php print $styles; ?>
    <?php print $scripts; ?>

</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/vendor/classie.js"></script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/vendor/bootstrap.js"></script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/vendor/owl.carousel.old.js"></script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/vendor/perfect-scrollbar.jquery.js"></script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/vendor/jquery.sticky-kit.min.js"></script>
<!-- <script src="js/vendor/jquery.nicescroll.min.js"></script> -->
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/global.js"></script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/uisearch.js"></script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/header.js"></script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/index.js"></script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/page.js"></script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/map-settings.js"></script>
<script src="<?php print $base_path.$theme_path;?>/spbgu/app/js/footer.js"></script>
</body>
</html>

