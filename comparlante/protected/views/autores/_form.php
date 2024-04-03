<?php
/* @var $this AutoresController */
/* @var $model Autores */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'autores-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		'focus'=>array($model,'AUTOR'),
		'htmlOptions' => array('class'=>'form-horizontal'),
		)); ?>

		<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

		<?php echo $form->errorSummary($model); ?>

		<div class="form-group">
		
				<?php echo $form->labelEx($model,'AUTOR'); ?>
				<?php echo $form->textField($model,'AUTOR',array("class"=>"form-control",'size'=>80,'maxlength'=>150,'ajax' => array(
                        'type' =>'POST',
                        'data'=> "js:$(this).serialize()",
                        'url' => CController::createUrl('autores/verify'),
                        'update' => '#Autores_DESCRIPCION',
                    ))); ?>
				<?php echo $form->error($model,'AUTOR'); ?>
		</div>

		<div class="form-group">
			<div class="col-md-12">
				<?php echo $form->labelEx($model,'DESCRIPCION'); ?>
				<?php echo $form->textArea($model,'DESCRIPCION',array("class"=>"form-control", 'rows'=>2, 'cols'=>50)); ?>
				<?php echo $form->error($model,'DESCRIPCION'); ?>
			</div>
		</div>
		<div class="span"> </div>
		<div class="form-group">
			<div class="col-sm-8">
				<!-- <?php echo CHtml::submitButton($model->isNewRecord ? ' Crear ' : ' Guardar ',array('class'=>'btn btn-success')); ?> -->
				<?php echo CHtml::submitButton('Guardar y Salir',array('class'=>'btn btn-primary','name'=> 'add')); ?>
				<?php echo CHtml::submitButton('Guardar y Agregar otra parte', array('class'=>'btn btn-success','name' => 'other')); ?>
			</div>
		</div>

		<?php $this->endWidget(); ?>

</div><!-- form -->