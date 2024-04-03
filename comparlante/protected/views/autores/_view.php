<?php
/* @var $this AutoresController */
/* @var $data Autores */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_AUTOR')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_AUTOR), array('view', 'id'=>$data->ID_AUTOR)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AUTOR')); ?>:</b>
	<?php echo CHtml::encode($data->AUTOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION); ?>
	<br />


</div>