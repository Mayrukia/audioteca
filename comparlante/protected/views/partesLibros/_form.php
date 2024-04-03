<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'partes-libros-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->hiddenField($model,'ID_LIBRO'); ?>
		<?php echo $form->error($model,'ID_LIBRO'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'NUMERO_PARTE'); ?>
		<?php echo $form->textField($model,'NUMERO_PARTE',array('class'=>'form-control')); ?>
	</div>

	<div class="form-group">
        <?php echo $form->labelEx($model,'Audio',array('class'=>'control-labe  l')); ?>
        <?php echo CHtml::activeFileField($model,'audio'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Guardar y Salir',array('name'=> 'add', 'class'=>'btn')); ?>
		<?php echo CHtml::submitButton('Guardar y Agregar otra parte', array('name' => 'other','class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>