<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_USUARIO'); ?>
		<?php echo $form->textField($model,'ID_USUARIO',array("class"=>"form-control",'size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'ID_USUARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE'); ?>
		<?php echo $form->textField($model,'NOMBRE',array("class"=>"form-control",'size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'NOMBRE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'APELLIDO'); ?>
		<?php echo $form->textField($model,'APELLIDO',array("class"=>"form-control",'size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'APELLIDO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CONTRASENA'); ?>
		<?php echo $form->passwordField($model,'CONTRASENA',array("class"=>"form-control",'size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'CONTRASENA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CORREO'); ?>
		<?php echo $form->textField($model,'CORREO',array("class"=>"form-control",'size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'CORREO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->