

<div  class="name" onkeypress="reproduceSonido(event,<?php echo Chtml::encode($data->ID_LIBRO);?>)" >

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('TITULO')); ?>:</b>
	<?php echo CHtml::encode($data->TITULO); ?>
	<br />

	<b><?php echo CHtml::encode('Autor(es)'); ?>:</b>
	<?php echo CHtml::encode(LibrosController::libroAutor($data->ID_LIBRO)); ?>
	<br />

	<b><?php echo CHtml::encode(('Narrado por')); ?>:</b>
	<?php echo CHtml::encode($data->NARRADOR); ?>
	<br />
	
	
	<?php 
	if(empty($data->DESCRIPCION))
		echo CHtml::encode('');
	else	
		echo CHtml::encode(substr($data->DESCRIPCION, 0,200).' ...'); 
	?>
	<br />

	<?php 
	$url = Yii::app()->baseUrl.'/libros/'.$data->idioma->ID_IDIOMA.'/'.$data->categoria->ID_CATEGORIA.'/'.$data->ID_LIBRO.'.mp3';
	?>
	<audio name="audiolibro" id="<?php echo 'audiolibro'.Chtml::encode($data->ID_LIBRO);?>" controls="controls">
		<source src="<?php echo CHtml::encode($url); ?>" type="audio/mp3" />
		</audio>
		<br/>


	</div>	

