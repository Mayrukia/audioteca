<?php
/* @var $this CategoriasController */
/* @var $model Categorias */

$this->breadcrumbs=array(
	'Categorias'=>array('index'),
	'Crear',
);
?>

<h1>Crear Categorias</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>