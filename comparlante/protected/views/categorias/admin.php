<?php
/* @var $this CategoriasController */
/* @var $model Categorias */

$this->breadcrumbs=array(
	'Categorias'=>array('admin'),
	'Administrar',
);
?>

<h1>Administrar Categorias</h1>

<a href=<?php echo '"'.CController::createUrl('categorias/create').'"' ?>>
	<div class="btn btn-lg btn-warning">
		Crear Categoria
	</div>
</a>	
<br>
<br>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categorias-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		//'ID_CATEGORIA',
		'CATEGORIA',
		'CATEGORIA_INGLES',
		'DESCRIPCION',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
