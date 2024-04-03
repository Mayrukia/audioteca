<?php
/* @var $this LibrosController */
/* @var $model Libros */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_LIBRO'); ?>
		<?php echo $form->textField($model,'ID_LIBRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_CATEGORIA'); ?>
		<?php echo $form->textField($model,'ID_CATEGORIA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_IDIOMA'); ?>
		<?php echo $form->textField($model,'ID_IDIOMA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TITULO'); ?>
		<?php echo $form->textField($model,'TITULO',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ANO'); ?>
		<?php echo $form->textField($model,'ANO',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION',array('rows'=>6, 'cols'=>50)); ?>
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