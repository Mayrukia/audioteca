<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">

   <?php
    if(isset($_GET["r"]) && ($_GET["r"]=='libros/view' || $_GET["r"]=='libros%2Fview'))
    {
      $modelBook = Libros::model()->findByPk($_GET['id']); 
      $value = $modelBook->TITULO;
      echo '<title>Comparlante audiolibros | '.$value.'</title>';
    }
    else
      echo '<title>Comparlante audiolibros</title>';
  ?>
  <!--<title>Comparlante audiolibros | administrador</title>-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Comparlante biblioteca audio libros">
  <meta name="author" content="Prime Developers Chile">
  <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>

  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <?php
      $baseUrl = Yii::app()->theme->baseUrl; 
      $cs = Yii::app()->getClientScript();
      Yii::app()->clientScript->registerCoreScript('jquery');
      $baseUrl2 = Yii::app()->baseUrl;
      ?>
      <!-- Fav and Touch and touch icons -->
      <link rel="shortcut icon" href="<?php echo $baseUrl2;?>/images/logo-icon.png">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl2;?>/images/logo-icon.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl2;?>/images/logo-icon.png">
      <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl2;?>/images/logo-icon.png">
      <?php
      $cs->registerCssFile($baseUrl.'/css/abound.css');
      $cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
      $cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');

      $cs->registerCssFile($baseUrl.'/css/buscador_libros.css');
      $cs->registerCssFile($baseUrl.'/css/font-awesome.min.css');
      $cs->registerCssFile($baseUrl.'/css/font-awesome.css');



	  //$cs->registerCssFile($baseUrl.'/css/style-blue.css');
      ?>
      <!-- styles for style switcher -->
      <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>/css/style-blue.css" />
      <?php
    //$cs->registerScriptFile($baseUrl.'/js/controlTiempo.php');
      $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
      $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
      $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
      $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
      $cs->registerScriptFile($baseUrl.'/js/charts.js');
      $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
      $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
      $cs->registerScriptFile($baseUrl.'/js/styleswitcher.js'); 
      $cs->registerScriptFile($baseUrl.'/js/jquery-ui.min.js'); 
      ?>

    </head>

    <body>
      <section id="navigation-main">   
        <!-- Require the navigation -->
        <?php require_once('tpl_navigation.php')?>
</section><!-- /#navigation-main -->

<section class="main-body">
<div class="container-fluid ">
<!-- Include content pages -->
<?php echo $content; ?>
</div>
</section>

<!-- Require the footer. -->

</body>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-75127504-2', 'auto');
ga('send', 'pageview');

</script>
</html>
