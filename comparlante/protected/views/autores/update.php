<?php
/* @var $this AutoresController */
/* @var $model Autores */

$this->breadcrumbs=array(
	'Autores'=>array('index'),
	$model->AUTOR=>array('view','id'=>$model->ID_AUTOR),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Autores', 'url'=>array('index')),
	array('label'=>'Crear Autores', 'url'=>array('create')),
	array('label'=>'Ver Autores', 'url'=>array('view', 'id'=>$model->ID_AUTOR)),
	array('label'=>'Administrar Autores', 'url'=>array('admin')),
);
?>

<h1>Modificar Autores: <?php echo $model->AUTOR; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>