<?php
/* @var $this EtiquetasController */
/* @var $data Etiquetas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_ETIQUETA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_ETIQUETA), array('view', 'id'=>$data->ID_ETIQUETA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ETIQUETA')); ?>:</b>
	<?php echo CHtml::encode($data->ETIQUETA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION); ?>
	<br />


</div>