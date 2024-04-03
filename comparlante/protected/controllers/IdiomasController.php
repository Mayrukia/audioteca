<?php

class IdiomasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('create','update','admin','delete','index','view'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Idiomas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Idiomas']))
		{
			$model->attributes=$_POST['Idiomas'];

			$model->imagen=CUploadedFile::getInstance($model,'imagen');
			//$filename=utf8_decode($model->IDIOMA) . ".jpg";
			$filename=$model->IDIOMA. ".jpg";
			if($model->save()){
				if(!empty($model->imagen)){
					try{
					$model->imagen->saveAs(Yii::app()->basePath.'/../banderas/'.$filename);
					$imagen = Yii::app()->imagen->load(Yii::app()->basePath.'/../banderas/'.$filename);
   					$imagen->resize(400, 300)->quality(80);
   					$imagen->save();
   				}
   				catch(Exception $e){}
   				
				}
				$this->redirect(array('view','id'=>$model->ID_IDIOMA));
				}
		}

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

		if(isset($_POST['Idiomas']))
		{
			$model->attributes=$_POST['Idiomas'];

			$model->imagen=CUploadedFile::getInstance($model,'imagen');
			//$filename=utf8_decode($model->IDIOMA). ".jpg";
			$filename=$model->IDIOMA. ".jpg";

			if($model->save()){
				if(!empty($model->imagen)){
					try{
					$model->imagen->saveAs(Yii::app()->basePath.'/../banderas/'.$filename);
					$imagen = Yii::app()->imagen->load(Yii::app()->basePath.'/../banderas/'.$filename);
   					$imagen->resize(400, 300)->quality(80);
   					$imagen->save();
   				}
   				catch(Exception $e){}
				}
				$this->redirect(array('view','id'=>$model->ID_IDIOMA));
		}
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
		$dataProvider=new CActiveDataProvider('Idiomas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Idiomas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Idiomas']))
			$model->attributes=$_GET['Idiomas'];

		$dataProvider = $model->search();
		/* Se ingresa al DataProvider y se cambia la descrición para que se muestre mas recortada */
		foreach ($dataProvider->getData() as $key)
		{
			if(strlen($key->DESCRIPCION) >= 100)
				$key->DESCRIPCION = substr($key->DESCRIPCION, 0,100)."...";
		}
		
		$this->render('admin',array(
			'model'=>$model,
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Idiomas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Idiomas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Idiomas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='idiomas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
