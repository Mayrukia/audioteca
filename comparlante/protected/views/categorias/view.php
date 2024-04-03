<?php
/* @var $this CategoriasController */
/* @var $model Categorias */

$this->breadcrumbs=array(
	'Categorias'=>array('admin'),
	$model->CATEGORIA,
);
?>

<h1> Categoria: <?php echo $model->CATEGORIA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'ID_CATEGORIA',
		'CATEGORIA',
		'DESCRIPCION',
	),
)); ?>
