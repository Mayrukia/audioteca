<?php
/* @var $this LibrosController */
/* @var $model Libros */

$this->breadcrumbs=array(
	'Biblioteca'=>array('admin'),
	//$model->ID_LIBRO=>array('view','id'=>$model->ID_LIBRO),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Libros', 'url'=>array('index')),
	array('label'=>'Crear Libros', 'url'=>array('create')),
	array('label'=>'Ver Libros', 'url'=>array('view', 'id'=>$model->ID_LIBRO)),
	array('label'=>'Administrar Libros', 'url'=>array('admin')),
);
?>

<h1>Modificar Libros <?php echo $model->TITULO; ?></h1>

<?php $this->renderPartial('_update', array('model'=>$model,'arrayA'=>$arrayA,'arrayE'=>$arrayE,'arrayG'=>$arrayG)); ?>