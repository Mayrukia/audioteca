<?php
/* @var $this PartesLibrosController */
/* @var $model PartesLibros */

$this->breadcrumbs=array(
	'Partes Libroses'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver PartesLibros', 'url'=>array('index')),
	array('label'=>'Crear PartesLibros', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#partes-libros-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Partes Libroses</h1>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'partes-libros-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_PARTES',
		'ID_LIBRO',
		'NUMERO_PARTE',
		'URL_AUDIO',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
