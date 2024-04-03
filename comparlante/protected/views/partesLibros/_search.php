<?php
/* @var $this PartesLibrosController */
/* @var $model PartesLibros */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_PARTES'); ?>
		<?php echo $form->textField($model,'ID_PARTES'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_LIBRO'); ?>
		<?php echo $form->textField($model,'ID_LIBRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NUMERO_PARTE'); ?>
		<?php echo $form->textField($model,'NUMERO_PARTE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'URL_AUDIO'); ?>
		<?php echo $form->textArea($model,'URL_AUDIO',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->