<?php
/* @var $this GeneroController */
/* @var $data Genero */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_GENERO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_GENERO), array('view', 'id'=>$data->ID_GENERO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GENERO')); ?>:</b>
	<?php echo CHtml::encode($data->GENERO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION); ?>
	<br />


</div>