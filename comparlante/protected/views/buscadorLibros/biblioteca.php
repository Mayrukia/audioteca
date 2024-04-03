
<!-- Begin Navigation -->
<div class="clearfix navBuscador">

  <!-- Mobile Nav Button -->
  <button type="button" class="nav-button" data-toggle="collapse" data-target=".nav-content">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>

  <!-- Navigation Links -->
  <!-- Navigation Links -->
  <div class="navigation navBuscador desktop" role="navigation">
   <a id="top" title="logo-comparlante" href="../index.html" role="tooltip" aria-hidden="true"><img  class="logoB" src="images/logo.png"  href="../index.html" alt="logo-comparlante" </a>
   <div style="display:none" id="top" role="tooltip" aria-hidden="true">Dirígete a la página de inicio </div>
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


<div id="homeContent" >
  <h2> Audioteca por idiomas </h2>
  <br>
  <!-- Banderas de paises e idiomas de libros -->
  <div class="content contenedor">
    <div class="row">
      <?php 
      $criteria = new CDbCriteria;
      $criteria->order = 'IDIOMA ASC';
      $idiomas = Idiomas::model()->findAll($criteria);
      $count   = 0;

      foreach ($idiomas as $key => $value) 
      {

        if($count % 4 == 0 )
        {

          echo '<div class="row banderas">'; 
        }

        $i = $count +5;
        echo '<div tabindex="'.$i.'" class="col-md-3 banderas" aria-describedby="flag'.$i.'" >';
        
        //echo '<a href="'.Yii::app()->createUrl('libros/bibliotecaIdiomas',array('id'=>$idiomas[$key]->ID_IDIOMA)).'">' . CHtml::image(Yii::app()->baseUrl."/banderas/".utf8_decode($idiomas[$key]->IDIOMA).".jpg",'imagen',array("width"=>80)) .'</a>';
        //echo '<a href="'.Yii::app()->createUrl('libros/bibliotecaIdiomas',array('id'=>$idiomas[$key]->ID_IDIOMA)).'">' . CHtml::image(Yii::app()->baseUrl."/banderas/".$idiomas[$key]->IDIOMA.".jpg",'imagen',array("width"=>80)) .'</a>';
        echo '<a href="'.Yii::app()->createUrl('libros/bibliotecaIdiomas',array('id'=>$idiomas[$key]->ID_IDIOMA)).'"><img src="' .Yii::app()->baseUrl."/banderas/".$idiomas[$key]->IDIOMA.".jpg" .'" width=80" height="60" alt="Audiolibros en '.$idiomas[$key]->IDIOMA .'"></a>';
        echo '<a href="'.Yii::app()->createUrl('libros/bibliotecaIdiomas',array('id'=>$idiomas[$key]->ID_IDIOMA)).'" style="font-weight: bold;">  '.$idiomas[$key]->IDIOMA.'</a>';
        
        echo '</div>';
        echo '<div style="display:none" id="flag'.$i.'" role="tooltip" aria-hidden="true"> Audiolibros en '. $idiomas[$key]->ID_IDIOMA .' </div>';
        $count= $count+1;

        if($count % 4 == 0 )
        {
          echo '</div>';
          
        }
      }
      ?>
      <br><br><br><br><br>

</div>

<div id="contenido" class="content" aling="center"> </div>
<span> <br> <br></span>

</div>

<div class="contenedor">

  <ul class="social-links grid-full">
    <li><a tabindex="90" aria-describedby="tp1" href="https://www.facebook.com/pages/Comparlante/1537630623166015?ref=aymt_homepage_panel" target="_blank" alt="Facebook" title="Facebook"><img src="../images/icons/facebook.png" width="50%"></a></li>
    <div style="display:none" id="tp1" role="tooltip" aria-hidden="true">Facebook. </div>  
    <li><a tabindex="91" aria-describedby="tp2" href="https://twitter.com/comparlante" target="_blank" title="Twitter" alt="Twitter"><img src="../images/icons/twitter.png" width="50%"></a></li>    
    <div style="display:none" id="tp2" role="tooltip" aria-hidden="true">Twitter. </div>
    <li><a tabindex="92" aria-describedby="tp3" href="mailto:info@comparlante.com" target="_blank" title="Email" alt="Email"><img src="../images/icons/email.png" width="50%"></a></li>   
    <div style="display:none" id="tp3" role="tooltip" aria-hidden="true">Correo electronico. </div>
    <li><a tabindex="93" aria-describedby="tp4" href="http://youtube.com/channel/UCTYBW1pJ5TcsCuMAYSm_10Q" target="_blank" title="YouTube" alt="YouTube"><img src="../images/icons/youtube.png" width="50%"></a></li>  
    <div style="display:none" id="tp4" role="tooltip" aria-hidden="true">canal de youtube. </div>
    <li><a tabindex="94" aria-describedby="tp5" href="https://www.linkedin.com/in/fundaci%C3%B3n-comparlante-207b88bb" target="_blank" title="Linkedin" alt="Linkedin"><img src="../images/icons/linkedin.png" width="50%"></a></li> 
    <div style="display:none" id="tp5" role="tooltip" aria-hidden="true">red social linkedin. </div>
  </ul>


  <!-- Copyright Info -->
  <div class="copyright grid-full"><h7>©2016 Comparlante. Todos los derechos reservados. Desarrollado por <a tabindex="94" href="http://www.primedevelopers.cl/" target="_blank"> Prime Developers Chile</a> </h7></div>
</div>

<script type="text/javascript"> 

function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text")) {return false;} 
} 

document.onkeypress = stopRKey; 

</script>