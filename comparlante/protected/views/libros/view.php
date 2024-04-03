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
	$id_libro=$model->ID_LIBRO;
	$url = Yii::app()->baseUrl.'/libros/'.$model->idioma->ID_IDIOMA.'/'.$model->categoria->ID_CATEGORIA.'/'.$model->ID_LIBRO.'.mp3';
	$value = $model->TITULO;
?>
<div class="col-md-12" tabindex="3">
	<h2> <?php echo CHtml::encode($model->TITULO); ?> </h2>
	<h3> Autor: <?php echo CHtml::encode(LibrosController::libroAutor($model->ID_LIBRO)); ?> </h3>
	<h3> Narrado por: <?php echo CHtml::encode($model->NARRADOR); ?> </h3>
	<h4> Descripción: <?php echo CHtml::encode($model->DESCRIPCION); ?>  </h4>
</div>
<!-- Partes de los libros -->
<?php
$partes =  PartesLibros::model()->findAllByAttributes(array('ID_LIBRO'=>$model->ID_LIBRO),array('order'=>'NUMERO_PARTE ASC'));

if(!Empty($partes)){
	$criteria = new CDbCriteria;
	$criteria->condition = "ID_LIBRO = :id";
	$criteria->params = array(":id"=>"$id_libro");
	$criteria->order = 'NUMERO_PARTE ASC';
	$data =  new CActiveDataProvider('PartesLibros', array('criteria'=>$criteria,
		'pagination' => array(
			'pageSize' => 500,
			),
		));
		?>
		<?php 



		$this->widget('ext.EColumnListView', array(
			'dataProvider'=>$data,
			'itemView'=>'_viewPartes',
			'columns'=> 3,

			'pager'=>array(
				'header'         => '',
				'firstPageLabel' => '&lt;&lt;',
				'prevPageLabel'  => '&lt;atrás',
				'nextPageLabel'  => 'adelante&gt;',
				'lastPageLabel'  => '&gt;&gt;',
				),
			));
		
	}
	else{
	?>
<div  class="name" onkeypress="reproduceSonido(event,<?php echo Chtml::encode($model->ID_LIBRO);?>)" >


	<?php 
	$url = Yii::app()->baseUrl.'/libros/'.$model->idioma->ID_IDIOMA.'/'.$model->categoria->ID_CATEGORIA.'/'.$model->ID_LIBRO.'.mp3';
	?>

<audio tabindex="4" name="audiolibro" id="<?php echo 'audiolibro'.Chtml::encode($model->ID_LIBRO);?>" controls="controls">
		<source src="<?php echo CHtml::encode($url); ?>" type="audio/mp3" />
		</audio>
		<br/>
</div>

<?php } ?>
	<script type="text/javascript">

	function reproduceSonido (event,id) {
		var chCode = ('charCode' in event) ? event.charCode : event.keyCode;

		if (chCode == 13) {
			document.getElementById('audiolibro'+id).play();
		}
	}

	</script>


<script type="text/javascript">
   document.title = "<?php echo $value; ?>"; 
   document.querySelector('meta[property="og:title"]').setAttribute("content", "<?php //echo  $value; ?>");
   document.querySelector('meta[property="og:description"]').setAttribute("content", "<?php // echo $value; ?>");
   </script>

