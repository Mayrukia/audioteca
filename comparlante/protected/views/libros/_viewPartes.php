

<div  class="name" onkeypress="reproduceSonido(event,<?php echo Chtml::encode($data->ID_LIBRO);?>)" >

<?php 
	$libro=Libros::model()->findByPk($data->ID_LIBRO);
	$url = Yii::app()->baseUrl.'/libros/'.$libro->idioma->ID_IDIOMA.'/'.$libro->categoria->ID_CATEGORIA.'/'.$libro->ID_LIBRO."-".$data->NUMERO_PARTE.'.mp3';
	?>
	<h4> <?php echo $libro->TITULO ."Parte :"; ?>
	
	<?php echo CHtml::encode($data->NUMERO_PARTE); ?>
	<br />


	
	<audio name="audiolibro" id="<?php echo 'audiolibro'.Chtml::encode($data->ID_LIBRO);?>" controls="controls">
		<source src="<?php echo CHtml::encode($url); ?>" type="audio/mp3" />
		</audio>
		<br/>


	</div>	

