<?php
/* @var $this IdiomasController */
/* @var $model Idiomas */

$this->breadcrumbs=array(
	'Idiomas'=>array('admin'),
	'Crear',
);
?>

<h1>Crear Idioma</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>