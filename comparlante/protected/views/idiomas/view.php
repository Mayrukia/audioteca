<?php
/* @var $this IdiomasController */
/* @var $model Idiomas */

$this->breadcrumbs=array(
	'Idiomases'=>array('index'),
	$model->ID_IDIOMA,
);

$this->menu=array(
	array('label'=>'Ver Idiomas', 'url'=>array('index')),
	array('label'=>'Crear Idiomas', 'url'=>array('create')),
	array('label'=>'Actualizar Idiomas', 'url'=>array('update', 'id'=>$model->ID_IDIOMA)),
	array('label'=>'Borrar Idiomas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_IDIOMA),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Idiomas', 'url'=>array('admin')),
);
?>

<h1> Idiomas #<?php echo $model->ID_IDIOMA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_IDIOMA',
		'IDIOMA',
		'IDIOMA_INGLES',
		'DESCRIPCION',
	),
)); ?>
