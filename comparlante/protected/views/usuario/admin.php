<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	'Administrar',
);
?>

<h1>Administrar Usuarios</h1>

<a href=<?php echo '"'.CController::createUrl('usuario/create').'"' ?>>
	<div class="btn btn-lg btn-warning">
		Crear Usuario
	</div>
</a>	
<br>
<br>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_USUARIO',
		'NOMBRE',
		'APELLIDO',
		'CORREO',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
