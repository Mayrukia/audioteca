<?php
/* @var $this GeneroController */
/* @var $model Genero */

$this->breadcrumbs=array(
	'Generos'=>array('index'),
	$model->ID_GENERO,
);

$this->menu=array(
	array('label'=>'Ver Genero', 'url'=>array('index')),
	array('label'=>'Crear Genero', 'url'=>array('create')),
	array('label'=>'Actualizar Genero', 'url'=>array('update', 'id'=>$model->ID_GENERO)),
	array('label'=>'Borrar Genero', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_GENERO),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Genero', 'url'=>array('admin')),
);
?>

<h1> Genero #<?php echo $model->ID_GENERO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_GENERO',
		'GENERO',
		'DESCRIPCION',
	),
)); ?>
