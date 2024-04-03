<?php
/* @var $this AutoresController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Autores',
);

$this->menu=array(
	array('label'=>'Crear Autores', 'url'=>array('create')),
	array('label'=>'Administrar Autores', 'url'=>array('admin')),
);
?>

<h1>Autores</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
