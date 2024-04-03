<?php
/* @var $this EtiquetasController */
/* @var $model Etiquetas */

$this->breadcrumbs=array(
	'Etiquetases'=>array('index'),
	$model->ID_ETIQUETA=>array('view','id'=>$model->ID_ETIQUETA),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Etiquetas', 'url'=>array('index')),
	array('label'=>'Crear Etiquetas', 'url'=>array('create')),
	array('label'=>'Ver Etiquetas', 'url'=>array('view', 'id'=>$model->ID_ETIQUETA)),
	array('label'=>'Administrar Etiquetas', 'url'=>array('admin')),
);
?>

<h1>Modificar Etiquetas <?php echo $model->ID_ETIQUETA; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>