<?php
/* @var $this EtiquetasController */
/* @var $model Etiquetas */

$this->breadcrumbs=array(
	'Etiquetases'=>array('index'),
	$model->ID_ETIQUETA,
);

$this->menu=array(
	array('label'=>'Ver Etiquetas', 'url'=>array('index')),
	array('label'=>'Crear Etiquetas', 'url'=>array('create')),
	array('label'=>'Actualizar Etiquetas', 'url'=>array('update', 'id'=>$model->ID_ETIQUETA)),
	array('label'=>'Borrar Etiquetas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_ETIQUETA),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Etiquetas', 'url'=>array('admin')),
);
?>

<h1> Etiquetas #<?php echo $model->ID_ETIQUETA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_ETIQUETA',
		'ETIQUETA',
		'DESCRIPCION',
	),
)); ?>
