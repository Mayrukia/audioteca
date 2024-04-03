<?php
/* @var $this EtiquetasController */
/* @var $model Etiquetas */

$this->breadcrumbs=array(
	'Etiquetases'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Etiquetas', 'url'=>array('index')),
	array('label'=>'Administrar Etiquetas', 'url'=>array('admin')),
);
?>

<h1>Crear Etiquetas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>