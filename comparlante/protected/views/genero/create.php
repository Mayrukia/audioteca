<?php
/* @var $this GeneroController */
/* @var $model Genero */

$this->breadcrumbs=array(
	'Generos'=>array('admin'),
	'Crear',
);
?>

<h1>Crear Genero</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>