<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	$model->ID_USUARIO=>array('view','id'=>$model->ID_USUARIO),
	'Modificar',
);
?>

<h1>Modificar Usuario: <?php echo $model->ID_USUARIO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>