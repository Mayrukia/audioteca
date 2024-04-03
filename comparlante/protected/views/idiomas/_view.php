<?php
/* @var $this IdiomasController */
/* @var $data Idiomas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_IDIOMA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_IDIOMA), array('view', 'id'=>$data->ID_IDIOMA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDIOMA')); ?>:</b>
	<?php echo CHtml::encode($data->IDIOMA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION); ?>
	<br />


</div>