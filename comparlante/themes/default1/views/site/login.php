<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */


$this->pageTitle=Yii::app()->name . ' - Acceso';
//$this->breadcrumbs=array( 'Acceso',);

?>
<div class="span4">
</div>
<div class="page-header">
    <h1>Biblioteca audiolibros Comparlante</h1>
</div>

<div class="row-fluid">
    <div class="span6 offset3">
       
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>"Acceso Restringido",
            ));    
            ?>

            <p>Por favor ingrese en los siguientes campos sus credenciales de ingreso al sistema:</p>
            
            <div class="form">
                <?php 
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                        ),
                    )); 
                    ?>
                    
                    <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>
                    <div class="span3">
                    </div>
                    <div>
                        <div class="row">
                            <?php echo "Usuario *"; ?> <br>
                            <?php echo $form->textField($model,'username'); ?>
                            <?php echo $form->error($model,'username'); ?>
                        </div>
                        <div class="span3">
                        </div>
                        <div class="row">
                            <?php echo "Clave de acceso *"; ?> <br>
                            <?php echo $form->passwordField($model,'password'); ?>
                            <?php echo $form->error($model,'password'); ?>
                        </div>
                        <div class="span3 clearfix">
                        </div>
                        <br>
                        <div class="row ">
                            <?php echo CHtml::submitButton('Acceder',array('class'=>'btn btn btn-primary')); ?>
                        </div>
                    </div>
                   
                    
                    <?php $this->endWidget(); ?>
                </div><!-- form -->

                <?php $this->endWidget();?>

            </div>

        </div>
        <div class="span6">
        </div>
