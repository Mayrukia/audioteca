<?php
/* @var $this PartesLibrosController */
/* @var $data PartesLibros */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_PARTES')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_PARTES), array('view', 'id'=>$data->ID_PARTES)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_LIBRO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_LIBRO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NUMERO_PARTE')); ?>:</b>
	<?php echo CHtml::encode($data->NUMERO_PARTE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('URL_AUDIO')); ?>:</b>
	<?php echo CHtml::encode($data->URL_AUDIO); ?>
	<br />


</div>