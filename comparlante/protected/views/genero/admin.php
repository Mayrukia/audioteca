<?php
/* @var $this GeneroController */
/* @var $model Genero */

$this->breadcrumbs=array(
	'Generos'=>array('admin'),
	'Administrar',
);?>

<h1>Administrar Géneros</h1>
<a href=<?php echo '"'.CController::createUrl('genero/create').'"' ?>>
	<div class="btn btn-lg btn-warning">
		Crear Género
	</div>
</a>	
<br>
<br>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'genero-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		//'ID_GENERO',
		'GENERO',
		'GENERO_INGLES',
		'DESCRIPCION',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
