<?php
/* @var $this IdiomasController */
/* @var $model Idiomas */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'idiomas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data', 'class'=>'form-horizontal'),
		)); ?>

		<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

		<?php echo $form->errorSummary($model); ?>

		<div class="row">
			<?php echo $form->labelEx($model,'IDIOMA'); ?>
			<?php echo $form->textField($model,'IDIOMA',array("class"=>"form-control",'size'=>60,'maxlength'=>150)); ?>
			<?php echo $form->error($model,'IDIOMA'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'IDIOMA_INGLES'); ?>
			<?php echo $form->textField($model,'IDIOMA_INGLES',array("class"=>"form-control",'size'=>60,'maxlength'=>150)); ?>
			<?php echo $form->error($model,'IDIOMA_INGLES'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'DESCRIPCION'); ?>
			<?php echo $form->textArea($model,'DESCRIPCION',array("class"=>"form-control",'rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'DESCRIPCION'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'imagen'); ?>

			<?php echo CHtml::activeFileField($model,'imagen'); ?>
			<?php echo $form->error($model,'imagen'); ?>
		</div>

		<?php if($model->isNewRecord!='1'){?>
		<div class="row">
			<?php echo CHtml::image(Yii::app()->baseUrl."/banderas/".$model->IDIOMA.".jpg",'imagen',array("width"=>200)); }?> 
		</div>
		<br>
		<div class="form-group">
			<div class="">
				<?php echo CHtml::submitButton($model->isNewRecord ? ' Crear ' : ' Guardar ',array('class'=>'btn btn-default')); ?>
			</div>
		</div>

		<?php $this->endWidget(); ?>

</div><!-- form -->