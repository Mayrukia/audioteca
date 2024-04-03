<?php

class PartesLibrosController extends Controller
{
	//public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('create','update','admin','delete','index','view'),
				'users'=>array('@'),
			),
			
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new PartesLibros;

		if(isset($_POST['PartesLibros']))
		{
			$model->attributes=$_POST['PartesLibros'];
			$model->audio  = CUploadedFile::getInstance($model,'audio');
			
			if($model->save())
			{
				if(!empty($model->audio))
				{
					$modelBook= Libros::model()->findByPk($model->ID_LIBRO);
					$modelPart= $this->loadModel($model->ID_PARTES);
					$filename = $model->ID_LIBRO."-".$model->NUMERO_PARTE.".mp3";
					$modelPart->URL_AUDIO = '/libros/'.$modelBook->idioma->ID_IDIOMA."/".$modelBook->categoria->ID_CATEGORIA.'/'.$filename;
					$modelPart->save();

					/* Pregunta si existe la carpeta del "idioma", si no se encuentra, se creará */
					if(!file_exists(Yii::app()->basePath.'/../libros/'.$modelBook->idioma->ID_IDIOMA))
						mkdir(Yii::app()->basePath.'/../libros/'.$modelBook->idioma->ID_IDIOMA);

					/* Pregunta si existe la carpeta de la "categoria", si no se encuentra, se creará */
					if(!file_exists(Yii::app()->basePath.'/../libros/'.$modelBook->idioma->ID_IDIOMA.'/'.$modelBook->categoria->ID_CATEGORIA))
						mkdir(Yii::app()->basePath.'/../libros/'.$modelBook->idioma->ID_IDIOMA.'/'.$modelBook->categoria->ID_CATEGORIA);
					
					try
					{
						$model->audio->saveAs(Yii::app()->basePath.'/../libros/'.$modelBook->idioma->ID_IDIOMA."/".$modelBook->categoria->ID_CATEGORIA.'/'.$filename);
					}
					catch(Exception $e){}

				}
				if(isset($_POST['other']))
					$this->redirect(array('partesLibros/create','id'=>$model->ID_LIBRO));
				else
					$this->redirect(array('libros/view','id'=>$model->ID_LIBRO));
			}
		}
		
		if(isset($_GET['id']))
			$model->ID_LIBRO = $_GET['id'];

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PartesLibros']))
		{
			$model->attributes=$_POST['PartesLibros'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_PARTES));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PartesLibros');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PartesLibros('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PartesLibros']))
			$model->attributes=$_GET['PartesLibros'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PartesLibros the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PartesLibros::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PartesLibros $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='partes-libros-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
