<?php
/* @var $this GeneroController */
/* @var $model Genero */

$this->breadcrumbs=array(
	'Generos'=>array('admin'),
	$model->GENERO=>array('view','id'=>$model->ID_GENERO),
	'Modificar',
);
?>

<h1>Modificar Género: <?php echo $model->GENERO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>