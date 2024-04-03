<?php
/* @var $this PartesLibrosController */
/* @var $model PartesLibros */

$this->breadcrumbs=array(
	'Partes Libroses'=>array('index'),
	$model->ID_PARTES=>array('view','id'=>$model->ID_PARTES),
	'Modificar',
);

$this->menu=array(
	array('label'=>' PartesLibros', 'url'=>array('index')),
	array('label'=>'Crear PartesLibros', 'url'=>array('create')),
	array('label'=>'Ver PartesLibros', 'url'=>array('view', 'id'=>$model->ID_PARTES)),
	array('label'=>'Administrar PartesLibros', 'url'=>array('admin')),
);
?>

<h1>Modificar PartesLibros <?php echo $model->ID_PARTES; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>