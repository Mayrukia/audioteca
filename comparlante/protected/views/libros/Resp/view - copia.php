<?php
/* @var $this LibrosController */
/* @var $model Libros */

$this->breadcrumbs=array(
	'Libros'=>array('main'),
	$model->TITULO,
	);

$url = Yii::app()->baseUrl.'/libros/'.$model->idioma->ID_IDIOMA.'/'.$model->categoria->ID_CATEGORIA.'/'.$model->ID_LIBRO.'.mp3';

?>



<form class="form-horizontal">
	<h1> Libro #<?php echo $model->TITULO; ?></h1>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
		<div class="col-sm-10">
			<p class="form-control-static">	<?php echo CHtml::encode($model->TITULO); ?> </p>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Autor(es)</label>
		<div class="col-sm-10">
			<p class="form-control-static">	<?php echo $txt;?> </p>
		</div>
	</div>
	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">Año</label>
		<div class="col-sm-10">
			<p class="form-control-static">	<?php echo CHtml::encode($model->ANO); ?> </p>
		</div>
	</div>
	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">Idioma</label>
		<div class="col-sm-10">
			<p class="form-control-static">	<?php echo CHtml::encode($model->idioma->IDIOMA); ?> </p>
		</div>
	</div>
	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">Categoria</label>
		<div class="col-sm-10">
			<p class="form-control-static">	<?php echo CHtml::encode($model->categoria->CATEGORIA); ?> </p>
		</div>
	</div>
	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">Narrador</label>
		<div class="col-sm-10">
			<p class="form-control-static">	<?php echo CHtml::encode($model->NARRADOR); ?> </p>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
		<div class="col-sm-10">
			<p class="form-control-static"><?php echo CHtml::encode($model->DESCRIPCION); ?></p>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Audio</label>
		<div class="col-sm-10">
			<audio name="audiolibro" id="<?php echo 'audiolibro'.$model->ID_LIBRO;?>" controls="controls">
				<source src="<?php echo $url; ?>" type="audio/mp3" />
				</audio>
			</div>
		</div>

	</form>