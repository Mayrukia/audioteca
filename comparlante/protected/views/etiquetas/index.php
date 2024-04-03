<?php
/* @var $this EtiquetasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Etiquetases',
);

$this->menu=array(
	array('label'=>'Crear Etiquetas', 'url'=>array('create')),
	array('label'=>'Administrar Etiquetas', 'url'=>array('admin')),
);
?>

<h1>Etiquetases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
