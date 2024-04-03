<!-- Begin Navigation -->
<div class="clearfix navBuscador">

  <!-- Mobile Nav Button -->
  <button type="button" class="nav-button2" data-toggle="collapse" data-target=".nav-content">
    <span class="sr-only">menú de navegación</span>
    <span class="icon-bar2"></span>
    <span class="icon-bar2"></span>
    <span class="icon-bar2"></span>
  </button>

  <!-- Navigation Links -->
  <div class="navigation navBuscador desktop" role="navigation">
    <a id="top" title="logo-comparlante"><img src="images/logo.png" width="200px"  alt="logo-comparlante" </a>
    <div class="nav-content">
      <ul >
        <li id="index" ><a  tabindex="60" href="../index.html">INICIO</a></li>
        <li id="participar" ><a tabindex="61" href="../como-participar.html">¿CÓMO PARTICIPAR?</a></li>
        <li id="acerca-de" ><a tabindex="62" href="acerca-de.html">ACERCA DE </a></li>
        <li id="contacto" ><a tabindex="63" href="../contacto.html">CONTACTO</a></li>
        <li id="fundación comparlante"><a tabindex="60" href="http://comparlante.com/index_es.php">FUNDACIÓN COMPARLANTE</a></li>
      </ul>     
    </div>
  </div>
</div>

<?php 
  $idioma= $_GET["id"];
  $idioma = Idiomas::model()->findByPk($idioma);
  echo "<h1>Libros en ".$idioma->IDIOMA ."</h1>";
?>


<?php 
$this->widget('ext.EColumnListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'columns'=> 3,

	'pager'=>array(
        'header'         => '',
        'firstPageLabel' => '&lt;&lt;',
        'prevPageLabel'  => '&lt;atrás',
        'nextPageLabel'  => 'adelante&gt;',
        'lastPageLabel'  => '&gt;&gt;',
    ),
));
?>
<script type="text/javascript">
  function reproduceSonido (event,id)
  {
    var chCode = ('charCode' in event) ? event.charCode : event.keyCode;

    if (chCode == 13)
    {
      document.location.href = "<?php echo Yii::app()->createUrl('libros/view', array('id' => ''));?>"+id;
      //document.getElementById('audiolibro'+id).play();
    }
  }
</script>
<div id="contenido" class="content" aling="center"> </div>
<span> <br> <br></span>

</div>

<div class="contenedor">

  <ul class="social-links grid-full">
    <li><a tabindex="90" aria-describedby="tp1" href="https://www.facebook.com/pages/Comparlante/1537630623166015?ref=aymt_homepage_panel" target="_blank" alt="Facebook" title="Facebook"><img src="../images/icons/facebook.png" width="50%"></a></li>
    <div style="display:none" id="tp1" role="tooltip" aria-hidden="true">Facebook. </div>  
    <li><a tabindex="91" aria-describedby="tp2" href="https://twitter.com/comparlante" target="_blank" title="Twitter" alt="Twitter"><img src="../images/icons/twitter.png" width="50%"></a></li>    
    <div style="display:none" id="tp2" role="tooltip" aria-hidden="true">Twitter. </div>
    <li><a tabindex="92" aria-describedby="tp3" href="mailto:comparlante@gmail.com" target="_blank" title="Email" alt="Email"><img src="../images/icons/email.png" width="50%"></a></li>   
    <div style="display:none" id="tp3" role="tooltip" aria-hidden="true">Correo electronico. </div>
    <li><a tabindex="93" aria-describedby="tp4" href="http://youtube.com/channel/UCTYBW1pJ5TcsCuMAYSm_10Q" target="_blank" title="YouTube" alt="YouTube"><img src="../images/icons/youtube.png" width="50%"></a></li>  
    <div style="display:none" id="tp4" role="tooltip" aria-hidden="true">canal de youtube. </div>
    <li><a tabindex="94" aria-describedby="tp4" href="https://www.linkedin.com/in/fundaci%C3%B3n-comparlante-207b88bb" target="_blank" title="Linkedin" alt="Linkedin"><img src="../images/icons/linkedin.png" width="50%"></a></li> 
    <div style="display:none" id="tp4" role="tooltip" aria-hidden="true">red social linkedin. </div>
  </ul>


  <!-- Copyright Info -->
  <div class="copyright grid-full"><h7>©2016 Comparlante. Todos los derechos reservados. desarrollado por <a tabindex="94" href="http://www.primedevelopers.cl/" target="_blank"> Prime Developers Chile</a> </h7></div>
</div>