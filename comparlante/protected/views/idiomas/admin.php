<?php
/* @var $this IdiomasController */
/* @var $model Idiomas */

$this->breadcrumbs=array(
	'Idiomas'=>array('admin'),
	'Administrar',
);
?>

<h1>Administrar Idiomas</h1>


<a href=<?php echo '"'.CController::createUrl('idiomas/create').'"' ?>>
	<div class="btn btn-lg btn-warning">
		Crear Idioma
	</div>
</a>	
<br>
<br>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'idiomas-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		//'ID_IDIOMA',
		'IDIOMA',
		'IDIOMA_INGLES',
		'DESCRIPCION',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
