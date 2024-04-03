<?php
/* @var $this IdiomasController */
/* @var $model Idiomas */

$this->breadcrumbs=array(
	'Idiomas'=>array('admin'),
	$model->IDIOMA=>array('view','id'=>$model->ID_IDIOMA),
	'Modificar',
);
?>

<h1>Modificar Idioma: <?php echo $model->IDIOMA; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>