<?php
/* @var $this IdiomasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Idiomases',
);

$this->menu=array(
	array('label'=>'Crear Idiomas', 'url'=>array('create')),
	array('label'=>'Administrar Idiomas', 'url'=>array('admin')),
);
?>

<h1>Idiomases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
