<?php
/* @var $this EtiquetasController */
/* @var $model Etiquetas */

$this->breadcrumbs=array(
	'Etiquetas'=>array('admin'),
	'Administrar',
);
?>

<h1>Administrar Etiquetas</h1>
<a href=<?php echo '"'.CController::createUrl('etiquetas/create').'"' ?>>
	<div class="btn btn-lg btn-warning">
		Crear Etiqueta
	</div>
</a>	
<br>
<br>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'etiquetas-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		// 'ID_ETIQUETA',
		'ETIQUETA',
		'ETIQUETA_INGLES',
		'DESCRIPCION',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
