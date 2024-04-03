<?php
/* @var $this PartesLibrosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Partes Libroses',
);

$this->menu=array(
	array('label'=>'Crear PartesLibros', 'url'=>array('create')),
	array('label'=>'Administrar PartesLibros', 'url'=>array('admin')),
);
?>

<h1>Partes Libroses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
