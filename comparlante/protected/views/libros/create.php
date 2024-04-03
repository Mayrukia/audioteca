<?php
/* @var $this LibrosController */
/* @var $model Libros */

$this->breadcrumbs=array(
	'Biblioteca'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Libros', 'url'=>array('index')),
	array('label'=>'Biblioteca', 'url'=>array('admin')),
);
?>

<h1>Creador de Libros</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>