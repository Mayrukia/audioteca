<?php
/* @var $this GeneroController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Generos',
);

$this->menu=array(
	array('label'=>'Crear Genero', 'url'=>array('create')),
	array('label'=>'Administrar Genero', 'url'=>array('admin')),
);
?>

<h1>Generos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
