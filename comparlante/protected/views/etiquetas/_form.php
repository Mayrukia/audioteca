<?php
/* @var $this EtiquetasController */
/* @var $model Etiquetas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'etiquetas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ETIQUETA'); ?>
		<?php echo $form->textField($model,'ETIQUETA',array("class"=>"form-control",'rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ETIQUETA'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'ETIQUETA_INGLES'); ?>
		<?php echo $form->textField($model,'ETIQUETA_INGLES',array("class"=>"form-control",'rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ETIQUETA_INGLES'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DESCRIPCION'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION',array("class"=>"form-control",'rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DESCRIPCION'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->