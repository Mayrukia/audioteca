<?php
/* @var $this CategoriasController */
/* @var $model Categorias */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categorias-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'CATEGORIA'); ?>
		<?php echo $form->textField($model,'CATEGORIA',array("class"=>"form-control",'size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'CATEGORIA'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'CATEGORIA_INGLES'); ?>
		<?php echo $form->textField($model,'CATEGORIA_INGLES',array("class"=>"form-control",'size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'CATEGORIA_INGLES'); ?>
	</div>

	<br>

	<div class="row">
		<?php echo $form->labelEx($model,'DESCRIPCION'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION',array("class"=>"form-control",'rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DESCRIPCION'); ?>
	</div>

	<br>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->