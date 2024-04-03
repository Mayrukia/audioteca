<?php

class AutoresController extends Controller
{
	//public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('create','update','admin','delete','index','view'),
				'users'=>array('@'),
			),
			
			array('allow',
				'actions'=>array('create','update','admin','delete','index','view'),
				'users'=>array('*'),
			),

			array('deny',
				'users'=>array('*'),
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
		$model=new Autores;

		if(isset($_POST['Autores']))
		{
			$model->attributes=$_POST['Autores'];
			
			if($model->save())
				if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Autor creado exitosamente.",
                        //'div2'=>$this->renderPartial('test', array('model'=>$model), true)
                        //'div2'=>"<script type='text/javascript'>document.location='test.php'</script>"
                    ));

                    exit;               
                }

				if(isset($_POST['other']))
					$this->redirect(array('create'));
				else
					$this->redirect(array('view','id'=>$model->ID_AUTOR));
		}
		
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form', array('model'=>$model), true)
            ));
            exit;               
        }
        else
			$this->render('create',array(
				'model'=>$model,
			));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Autores']))
		{
			$model->attributes=$_POST['Autores'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_AUTOR));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Autores');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new Autores('search');
		$model->unsetAttributes();
		if(isset($_GET['Autores']))
			$model->attributes=$_GET['Autores'];

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

	public function loadModel($id)
	{
		$model=Autores::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Página requerida no existe.');
		return $model;
	}
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='autores-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}