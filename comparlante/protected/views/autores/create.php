<?php
/* @var $this AutoresController */
/* @var $model Autores */

$this->breadcrumbs=array(
	'Autores'=>array('admin'),
	'Crear',
);
?>

<h1>Crear Autores</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>