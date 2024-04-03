<?php
/* @var $this PartesLibrosController */
/* @var $model PartesLibros */

$this->breadcrumbs=array(
	'Partes Libroses'=>array('index'),
	$model->ID_PARTES,
);

$this->menu=array(
	array('label'=>'Ver PartesLibros', 'url'=>array('index')),
	array('label'=>'Crear PartesLibros', 'url'=>array('create')),
	array('label'=>'Actualizar PartesLibros', 'url'=>array('update', 'id'=>$model->ID_PARTES)),
	array('label'=>'Borrar PartesLibros', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_PARTES),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar PartesLibros', 'url'=>array('admin')),
);
?>

<h1> PartesLibros #<?php echo $model->ID_PARTES; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_PARTES',
		'ID_LIBRO',
		'NUMERO_PARTE',
		'URL_AUDIO',
	),
)); ?>
