<?php
/* @var $this LibrosController */
/* @var $model Libros */

$this->breadcrumbs=array(
	'Biblioteca'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Libros', 'url'=>array('index')),
	array('label'=>'Biblioteca', 'url'=>array('admin')),
);
?>


<h1>Agregar Partes Libro <?php echo $model->TITULO; ?></h1>

<?php $this->renderPartial('_formPartes', array('model'=>$model)); ?>
<?php //$this->renderPartial('_formPartes', array('model'=>$model,'items'=>$items,'validateItems'=>$validateItems)); ?>