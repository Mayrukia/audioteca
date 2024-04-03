<?php
$this->breadcrumbs=array(
	'Autores'=>array('index'),
	$model->ID_AUTOR,
);

?>

<h1> Autor: <?php echo $model->AUTOR; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'AUTOR',
		'DESCRIPCION',
	),
)); ?>

<a href=<?php echo '"'.CController::createUrl('autores/create').'"' ?>>
	<div class="btn btn-lg btn-warning">
		Crear Autor
	</div>
</a>