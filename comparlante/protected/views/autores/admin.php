<?php
/* @var $this AutoresController */
/* @var $model Autores */

$this->breadcrumbs=array(
	'Autores'=>array('index'),
	'Administrar',
);

// $this->menu=array(
// 	array('label'=>'Ver Autores', 'url'=>array('index')),
// 	array('label'=>'Crear Autores', 'url'=>array('create')),
// );
?>

<h1>Administrar Autores</h1>

<a href=<?php echo '"'.CController::createUrl('autores/create').'"' ?>>
	<div class="btn btn-lg btn-warning">
		Crear Autor
	</div>
</a>	
<br>
<br>

<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'autores-grid',
	// 'dataProvider'=>$model->search(),
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'AUTOR',
			'value' => 'CHtml::link($data->AUTOR, array("autores/view&id=".$data->ID_AUTOR))',
			'type'  => 'raw',
			'htmlOptions'=>array('style' =>	'text-align:center'),
		),
		'DESCRIPCION',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
