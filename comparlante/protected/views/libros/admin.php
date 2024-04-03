<?php
/* @var $this LibrosController */
/* @var $model Libros */

$this->breadcrumbs=array(
	'Biblioteca'=>array('admin')
);
?>

<h1>Biblioteca de audiolibros</h1>

<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'libros-grid',
		'dataProvider'=>$model->searchMix(),
		'filter'=>$model,
		'htmlOptions'=>array('style' =>	'text-align:center'),
		'pager'=>array(
	        'header'         => '',
	        'firstPageLabel' => '&lt;&lt;',
	        'prevPageLabel'  => '&lt;atrás',
	        'nextPageLabel'  => 'adelante&gt;',
	        'lastPageLabel'  => '&gt;&gt;',
    	),
		'columns'=>array(
			array(
				'header'=>'Libro',
				'name'=>'TITULO',
				'value' => 'CHtml::link($data->TITULO, array("libros/view&id=".$data->ID_LIBRO))',
				'type'  => 'raw',
				'htmlOptions'=>array('style' =>	'text-align:center'),
			),
			array(
				'name'=>'ID_CATEGORIA',
				'htmlOptions'=>array('style' =>	'text-align:center'),
				'value' => 'CHtml::link($data->categoria->CATEGORIA, array("categorias/view&id=".$data->ID_CATEGORIA))',
				'type'  => 'raw',
				'filter' => CHtml::listData(Categorias::model()->findAll(),'ID_CATEGORIA', 'CATEGORIA'),
			),
			array(
				'name'  => 'genero',
				'header'=>'Género',
				'htmlOptions'=>array('style' =>	'text-align:center'),
				'value'=>array($this,'gridLibroGenero'),
				// 'filter' => CHtml::listData(Categorias::model()->findAll(),'ID_CATEGORIA', 'CATEGORIA'),
				'filter'=>false,
			),
			array(
				'name'=>'ID_IDIOMA',
				'htmlOptions'=>array('style' =>	'text-align:center'),
				'value' => 'CHtml::link($data->idioma->IDIOMA, array("idiomas/view&id=".$data->ID_IDIOMA))',
				'type'  => 'raw',
				'filter' => CHtml::listData(Idiomas::model()->findAll(),'ID_IDIOMA', 'IDIOMA'),
			),
			array(
				'name'=>'ANO',
				'htmlOptions'=>array('style' =>	'text-align:center'),
			),
			// 'DESCRIPCION',
			// 'TITULO',
			// 'ID_CATEGORIA',
			// 'ID_IDIOMA',
			// 'URL_AUDIO',
			array(
				'class'=>'CButtonColumn',
			),
		),
	)); 
?>
