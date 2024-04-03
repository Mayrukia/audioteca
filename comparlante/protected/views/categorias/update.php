<?php
/* @var $this CategoriasController */
/* @var $model Categorias */

$this->breadcrumbs=array(
	'Categorias'=>array('admin'),
	$model->CATEGORIA=>array('view','id'=>$model->ID_CATEGORIA),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Categorias', 'url'=>array('index')),
	array('label'=>'Crear Categorias', 'url'=>array('create')),
	array('label'=>'Ver Categorias', 'url'=>array('view', 'id'=>$model->ID_CATEGORIA)),
	array('label'=>'Administrar Categorias', 'url'=>array('admin')),
);
?>

<h1>Modificar Categoria: <?php echo $model->CATEGORIA; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>