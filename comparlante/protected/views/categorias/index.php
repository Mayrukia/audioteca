<?php
/* @var $this CategoriasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categoriases',
);

$this->menu=array(
	array('label'=>'Crear Categorias', 'url'=>array('create')),
	array('label'=>'Administrar Categorias', 'url'=>array('admin')),
);
?>

<h1>Categoriases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
