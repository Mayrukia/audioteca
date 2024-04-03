<?php
class BuscadorLibrosController extends Controller
{
	//public $layout = '/layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			);
	}

	public function actionIndex()
	{
		$this->render('index');
	}


	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','buscador','biblioteca','filterSearch','filterSearch2','buscar'),
				'users'=>array('*'),
				),
			
			array('allow',
				'actions'=>array('index','buscador','biblioteca','filterSearch','filterSearch2','buscar'),
				'users'=>array('?'),
				),
			
			array('deny',
				'users'=>array('*'),
				),
			);
	}

	public function actionBiblioteca()
	{
		$this->render('biblioteca');
	}


	public function actionFilterSearch()
	{
		$drop = $_POST['filtro'];		 // Obtiene la selección dada por el Dropdown
		$text = $_POST['filterField']; 	// Obtiene lo escrito en el Textfield
		
		$this->redirect(array('libros/Vview', 'drop'=>$drop,'text'=>$text));
	}

	public function actionFilterSearch2()
	{

		$drop = $_POST['filtro'];		// Obtiene la selección dada por el Dropdown
		$text = $_POST['filterField']; 	// Obtiene lo escrito en el Textfield
		
		$criteria = new CDbCriteria;

		/* Se activa si fue seleccionado "Titulo" */
		if($drop == 't')
			$criteria->condition = "TITULO LIKE :txt";

		/* Se activa si fue seleccionado "Autor" */
		if($drop == 'a')
		{
			$criteria->condition = "AUTOR LIKE :txt";
			$criteria->with = array('autores');
			$criteria->together = true;	
		}

		/* Se activa si fue seleccionado "Categoria" */
		if($drop == 'c')
		{
			$criteria->condition = "CATEGORIA LIKE :txt";			
			$criteria->with = array('categoria');		
		}

		/* Se activa si fue seleccionado "Género" */
		if($drop == 'g')
		{
			$criteria->condition = "GENERO LIKE :txt";
			$criteria->with = array('generos');
			$criteria->together = true;	
		}

		$criteria->params = array(":txt"=>"%$text%");
		$data =  new CActiveDataProvider('Libros', array('criteria'=>$criteria));

		// $this->renderPartial('_buscador',array('dataProvider'=>$data));
		//$this->redirect(array('BuscadorLibros/buscar', 'data'=>$data));
		$this->redirect(array('libros/Vview', 'data'=>$data));
	}
}

?>
