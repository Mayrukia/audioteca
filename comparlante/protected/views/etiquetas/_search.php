<?php
/* @var $this EtiquetasController */
/* @var $model Etiquetas */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_ETIQUETA'); ?>
		<?php echo $form->textField($model,'ID_ETIQUETA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ETIQUETA'); ?>
		<?php echo $form->textArea($model,'ETIQUETA',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->