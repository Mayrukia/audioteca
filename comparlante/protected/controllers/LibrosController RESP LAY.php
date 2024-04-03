<?php

class LibrosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';

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
			//CRUD todos los permisos otorgados por default a las cuentas tipo administrador
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view','gridLibroGenero','AutoCompleteLookup','Vview','libroAutor','listarNarradores','autores','updateUrl','updateAutores','bibliotecaIdiomas'),
				'users'=>array('@'),
				),
			
			/* Permite el acceso a solo usuarios "no logeados" */
			array('allow',
				'actions'=>array('index','Vview','libroAutor','bibliotecaIdiomas'),
				'users'=>array('?'),
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
		$txt = LibrosController::libroAutor($id);
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'txt' =>$txt,
			));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Libros;
			@session_start();
  				$_SESSION["num"] =0;
		
		if(isset($_POST['Libros']))
		{
			$model->attributes = $_POST['Libros'];

			$model->audio  = CUploadedFile::getInstance($model,'audio');
			if($model->save())
			{
				if(!empty($model->audio))
				{
					$filename = $model->ID_LIBRO.".mp3";

					$modelL2 			= $this->loadModel($model->ID_LIBRO);
					$modelL2->URL_AUDIO	= '/libros/'.$modelL2->idioma->ID_IDIOMA."/".$modelL2->categoria->ID_CATEGORIA.'/'.$filename;
					$modelL2->save();
					
					/* Pregunta si existe la carpeta del "idioma", si no se encuentra, se creará */
					if(!file_exists(Yii::app()->basePath.'/../libros/'.$model->idioma->ID_IDIOMA))
						mkdir(Yii::app()->basePath.'/../libros/'.$model->idioma->ID_IDIOMA);

					/* Pregunta si existe la carpeta de la "categoria", si no se encuentra, se creará */
					if(!file_exists(Yii::app()->basePath.'/../libros/'.$model->idioma->ID_IDIOMA.'/'.$model->categoria->ID_CATEGORIA))
						mkdir(Yii::app()->basePath.'/../libros/'.$model->idioma->ID_IDIOMA.'/'.$model->categoria->ID_CATEGORIA);
					try
					{
						$model->audio->saveAs(Yii::app()->basePath.'/../libros/'.$model->idioma->ID_IDIOMA."/".$model->categoria->ID_CATEGORIA.'/'.$filename);
					}
					catch(Exception $e){}
				}
				
				if(!empty($_POST['Libros']['autores']))
				{
					$auto = $_POST['Libros']['autores'];
					
					foreach( $auto as $key => $value)
					{
						$modeloAL = new AutorEscribeLibros;
						$modeloAL->ID_AUTOR = $value;
						$modeloAL->ID_LIBRO = $model->ID_LIBRO;
						$modeloAL->save();
					}
				}

				if(!empty($_POST['Libros']['etiquetas']))
				{
					$etiquet = $_POST['Libros']['etiquetas'];
					
					foreach( $etiquet as $key => $value)
					{
						$modeloET= new LibrosTienenEtiquetas;
						$modeloET->ID_ETIQUETA = $value;
						$modeloET->ID_LIBRO = $model->ID_LIBRO;
						$modeloET->save();
					}
				}

				if(!empty($_POST['Libros']['genero']))
				{
					$gene = $_POST['Libros']['genero'];
					
					foreach( $gene as $key => $value)
					{
						$modeloGE= new LibroTieneGeneros;
						$modeloGE->ID_GENERO = $value;
						$modeloGE->ID_LIBRO = $model->ID_LIBRO;
						$modeloGE->save();
					}
				}

				$this->redirect(array('view','id'=>$model->ID_LIBRO));
			}


			/** Guardado Anterior a la doble lista **/
				// if(!empty($_POST['n_autor']))
				// {
				// 	$modelAL = AutorEscribeLibros::model();
				// 	$nautor  = $_POST['n_autor'];

				// 	$n_autor = substr($nautor, 0, strlen($nautor)-1);
				// 	$ids 	 = explode(';',$n_autor);

				// 	foreach( $ids as $key => $value)
				// 	{
				// 		$modeloAL= new AutorEscribeLibros;
				// 		$modeloAL->ID_AUTOR = $value;
				// 		$modeloAL->ID_LIBRO = $model->ID_LIBRO;
				// 		$modeloAL->save();
				// 	}
				// }
		}

		$this->render('create',array('model'=>$model));
	}

	public function actionUpdate($id)
	{
		$model 	= $this->loadModel($id);

		/** Llamado a los autores que posee el libro **/
		$criteria = new CDbCriteria;
		$criteria->condition = "ID_LIBRO LIKE :LIBRO";
		$criteria->params = array(":LIBRO"=>"%$id%");	
		$AutorArray = AutorEscribeLibros::model()->findAll($criteria);

		/** Llamado a las etiquetas que posee el libro **/
		$criteria = new CDbCriteria;
		$criteria->condition = "ID_LIBRO LIKE :LIBRO";
		$criteria->params = array(":LIBRO"=>"%$id%");	
		$EtiquetaArray = LibrosTienenEtiquetas::model()->findAll($criteria);

		/** Llamado a los géneros que posee el libro **/
		$criteria = new CDbCriteria;
		$criteria->condition = "ID_LIBRO LIKE :LIBRO";
		$criteria->params = array(":LIBRO"=>"%$id%");	
		$GeneroArray = LibroTieneGeneros::model()->findAll($criteria);

		$arrayA = array();
		$arrayE = array();
		$arrayG = array();

		/** Se obtiene las ID de los autores **/
		if(!empty($AutorArray))
		{
			$i = 0;
			foreach ($AutorArray as $key => $value) 
				foreach ($AutorArray[$key] as $key => $value) 
					if($key == 'ID_AUTOR')
					{
						$arrayA[$i] = $value;
						$i++;
					}
				}

				/** Se obtiene las ID de las Etiquetas **/
				if(!empty($EtiquetaArray))
				{
					$i = 0;
					foreach ($EtiquetaArray as $key => $value) 
						foreach ($EtiquetaArray[$key] as $key => $value) 
							if($key == 'ID_ETIQUETA')
							{
								$arrayE[$i] = $value;
								$i++;
							}
						}

						/** Se obtiene las ID de los Géneros **/
						if(!empty($GeneroArray))
						{
							$i = 0;
							foreach ($GeneroArray as $key => $value) 
								foreach ($GeneroArray[$key] as $key => $value) 
									if($key == 'ID_GENERO')
									{
										$arrayG[$i] = $value;
										$i++;
									}
								}

								if(isset($_POST['Libros']))
								{
									$model->attributes=$_POST['Libros'];
									$model->audio  = CUploadedFile::getInstance($model,'audio');

									if($model->save())
									{
										if(!empty($model->audio))
										{
											$filename = $model->ID_LIBRO.".mp3";

											/* Pregunta si el archivo de audio fue cambiado */
											$modelC = $this->loadModel($model->ID_LIBRO);
											$modelL2= $this->loadModel($model->ID_LIBRO);
											$modelL2->URL_AUDIO	= '/libros/'.$modelL2->idioma->ID_IDIOMA."/".$modelL2->categoria->ID_CATEGORIA.'/'.$filename;

											if($modelC->URL_AUDIO != $modelL2->URL_AUDIO)
											{
												if(file_exists(Yii::app()->basePath.'/..'.$modelC->URL_AUDIO))
													if(!unlink(Yii::app()->basePath.'/..'.$modelC->URL_AUDIO))
														$modelL2->URL_AUDIO	= $modelC->URL_AUDIO;
												}

												$modelL2->save();

												/* Pregunta si existe la carpeta del "idioma", si no se encuentra, se creará */
												if(!file_exists(Yii::app()->basePath.'/../libros/'.$model->idioma->ID_IDIOMA))
													mkdir(Yii::app()->basePath.'/../libros/'.$model->idioma->ID_IDIOMA);

												/* Pregunta si existe la carpeta de la "categoria", si no se encuentra, se creará */
												if(!file_exists(Yii::app()->basePath.'/../libros/'.$model->idioma->ID_IDIOMA.'/'.$model->categoria->ID_CATEGORIA))
													mkdir(Yii::app()->basePath.'/../libros/'.$model->idioma->ID_IDIOMA.'/'.$model->categoria->ID_CATEGORIA);

												try
												{							
													$model->audio->saveAs(Yii::app()->basePath.'/../libros/'.$model->idioma->ID_IDIOMA."/".$model->categoria->ID_CATEGORIA.'/'.$filename);						
												}
												catch(Exception $e){}
											}

											if(!empty($_POST['Libros']['autores']))
											{
												/* Se revisa si los autores anteriores se encuentran en la actualización */
												if(!empty($arrayA))
													for ($i=0; $i<count($arrayA); $i++) 
														if(!in_array($arrayA[$i], $_POST['Libros']['autores']))
														{
															$modelA = AutorEscribeLibros::model()->findByAttributes(array('ID_AUTOR'=>$arrayA[$i],'ID_LIBRO'=>$model->ID_LIBRO));
															$modelA->delete();	
														}

														$auto = $_POST['Libros']['autores'];

														foreach( $auto as $key => $value)
															if(!in_array($value,$arrayA))
															{
																$modeloAL = new AutorEscribeLibros;
																$modeloAL->ID_AUTOR = $value;
																$modeloAL->ID_LIBRO = $model->ID_LIBRO;
																$modeloAL->save();
															}
														}

														if(!empty($_POST['Libros']['etiquetas']))
														{
															/* Se revisa si los autores anteriores se encuentran en la actualización */
															if(!empty($arrayE))
																for ($i=0; $i<count($arrayE); $i++) 
																	if(!in_array($arrayE[$i], $_POST['Libros']['etiquetas']))
																	{
																		$modelE = LibrosTienenEtiquetas::model()->findByAttributes(array('ID_ETIQUETA'=>$arrayE[$i],'ID_LIBRO'=>$model->ID_LIBRO));
																		$modelE->delete();	
																	}

																	$etiquet = $_POST['Libros']['etiquetas'];

																	foreach( $etiquet as $key => $value)
																		if(!in_array($value,$arrayE))
																		{
																			$modeloET= new LibrosTienenEtiquetas;
																			$modeloET->ID_ETIQUETA = $value;
																			$modeloET->ID_LIBRO = $model->ID_LIBRO;
																			$modeloET->save();
																		}
																	}

																	if(!empty($_POST['Libros']['genero']))
																	{
																		/* Se revisa si los autores anteriores se encuentran en la actualización */
																		if(!empty($arrayG))
																			for ($i=0; $i<count($arrayG); $i++) 
																				if(!in_array($arrayG[$i], $_POST['Libros']['genero']))
																				{
																					$modelG = LibroTieneGeneros::model()->findByAttributes(array('ID_GENERO'=>$arrayG[$i],'ID_LIBRO'=>$model->ID_LIBRO));
																					$modelG->delete();	
																				}

																				$gene = $_POST['Libros']['genero'];

																				foreach( $gene as $key => $value)
																					if(!in_array($value,$arrayG))
																					{
																						$modeloGE= new LibroTieneGeneros;
																						$modeloGE->ID_GENERO = $value;
																						$modeloGE->ID_LIBRO = $model->ID_LIBRO;
																						$modeloGE->save();
																					}
																				}

																				$this->redirect(array('view','id'=>$model->ID_LIBRO));
																			}
																		}

																		$this->render('update',array(
																			'model'=>$model,'arrayA'=>$AutorArray,'arrayE'=>$EtiquetaArray,'arrayG'=>$GeneroArray,
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
		$dataProvider=new CActiveDataProvider('Libros');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Libros('searchMix');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Libros']))
			$model->attributes=$_GET['Libros'];

		$this->render('admin',array(
			'model'=>$model,
			));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Libros the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Libros::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Página requerida no existe.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Libros $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='libros-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/* Metodo utilizado para visualizar los distintos "Géneros" en cada "Libro" mostrado en la vista "admin" */
	protected function gridLibroGenero($data,$row)
	{
		$sql  = 'SELECT GENERO as genero FROM libros INNER JOIN libro_tiene_generos ON libros.ID_LIBRO = libro_tiene_generos.ID_LIBRO INNER JOIN genero ON genero.ID_GENERO = libro_tiene_generos.ID_GENERO';
		$sql .= ' where libro_tiene_generos.ID_LIBRO =' .$data->ID_LIBRO; 
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		$result = '';
		$i = 0;

		if(!empty($rows))
			foreach ($rows as $row)
			{
				if($i != 0)
					$result .= ', '.CHtml::encode($row['genero']); 
				else
					$result .= CHtml::encode($row['genero']);
				$i++;
			}
			
			return $result; 
		}

		public function actionAutoCompleteLookup()
		{
			if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
			{
				$name = $_GET['q']; 
				$limit = min($_GET['limit'], 50); 
				$criteria = new CDbCriteria;
				$criteria->condition = "AUTOR LIKE :AUTOR";
				$criteria->params = array(":AUTOR"=>"%$name%");
				$criteria->limit = $limit;
				$userArray = Autores::model()->findAll($criteria);
				$returnVal = '';
				foreach($userArray as $userAccount)
				{
					$returnVal .= $userAccount->getAttribute('AUTOR').'|'
					.$userAccount->getAttribute('ID_AUTOR')."\n";
				}
				echo $returnVal;
			}
		}

		/* Metodo ocupado desde la vista del Buscador de Libros */
		public function actionVview()
		{
			$drop = $_GET['drop'];
			$text = $_GET['text'];

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
			$criteria->order = 'TITULO ASC';
			$data =  new CActiveDataProvider('Libros', array('criteria'=>$criteria,
				'pagination' => array(
					'pageSize' => 100,
					),
				));

			$this->renderPartial('_buscador',array('dataProvider'=>$data));
		}

		public function libroAutor($id)
		{
			$sql  = 'SELECT AUTOR as autor FROM libros INNER JOIN autor_escribe_libros ON libros.ID_LIBRO = autor_escribe_libros.ID_LIBRO INNER JOIN autores ON autores.ID_AUTOR = autor_escribe_libros.ID_AUTOR';
			$sql .= ' where autor_escribe_libros.ID_LIBRO =' .$id; 
			$rows = Yii::app()->db->createCommand($sql)->queryAll();
			$result = '';
			$i = 0;

			if(!empty($rows))
				foreach ($rows as $row)
				{
					if($i != 0)
						$result .= ', '.CHtml::encode($row['autor']); 
					else
						$result .= CHtml::encode($row['autor']);
					$i++;
				}
				
				return $result; 
			}

			public function actionListarNarradores()
			{
				if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
				{
					$name = $_GET['q']; 
					$limit = min($_GET['limit'], 50); 
					$criteria = new CDbCriteria;
					$criteria->condition = "NARRADOR LIKE :narr";
					$criteria->params = array(":narr"=>"%$name%");
					$criteria->limit = $limit;
					$userArray = Libros::model()->findAll($criteria);
					$returnVal = '';
					foreach($userArray as $userAccount)
					{
						$returnVal .= $userAccount->getAttribute('NARRADOR').'|'
						.$userAccount->getAttribute('NARRADOR')."\n";
					}
					echo $returnVal;
				}
			}

			public function actionAutores()
			{
				if (Yii::app()->request->isAjaxRequest)
				{
        	//$asd = CHtml::listData(Autores::model()->findAll(), 'ID_AUTOR', 'AUTOR');
        	//$asd2 = CHtml::dropDownList('autores','',$dataA,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;'));
        	//$asd = CHtml::label('ID_CATEGORIA','',array('class'=>'col-sm-2 control-label'));
        	//$asd = $_POST;
					$asd =  "asd";
        	//echo 'asddddd';
					echo CJSON::encode(array(
						'status'=>'success', 
						'div'=> $asd
						/*'div'=> "<?php echo 'hola'; ?>"*/
						));
					exit;               
				}

		// if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
  //      	{
  //         $name = $_GET['q']; 
  //         $limit = min($_GET['limit'], 50); 
  //         $criteria = new CDbCriteria;
  //         $criteria->condition = "NARRADOR LIKE :narr";
  //         $criteria->params = array(":narr"=>"%$name%");
  //         $criteria->limit = $limit;
  //         $userArray = Libros::model()->findAll($criteria);
  //         $returnVal = '';
  //         foreach($userArray as $userAccount)
  //         {
  //            $returnVal .= $userAccount->getAttribute('NARRADOR').'|'
  //                                        .$userAccount->getAttribute('NARRADOR')."\n";
  //         }
  //         echo $returnVal;
  //     }
			}

			public function updateUrl($id)
			{
				$modelL2 			= $this->loadModel($id);
				$filename 			= $modelL2->ID_LIBRO.".mp3";
				$modelL2->URL_AUDIO	= '/libros/'.$modelL2->idioma->ID_IDIOMA."/".$modelL2->categoria->ID_CATEGORIA.'/'.$filename;
				$modelL2->save();
			}

			public function actionUpdateAutores()
			{	
				// $asd = "ola k ase";
				// echo CJSON::encode(array(
				// 	'status'=>'success', 
				// 	'div'=> $asd,
				// ));
				// exit;               
				@session_start();
				$_SESSION["num"] = 1;
				echo $this->renderPartial('test',array('num'=>1));
				
				// $asd = 'hola';
				// echo CJSON::encode(array(
				// 	'status'=>'success', 
				// 	'div'=> $asd
				// ));
				// exit;               


			//echo CHtml::activeTextField(Libros::model(),'autores');

				// $dataA = CHtml::listData(Autores::model()->findAll(), 'ID_AUTOR', 'AUTOR');
			 //    echo $form->dropDownList(Autores::model(),'autores',$dataA,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;'));
				//$dataA = CHtml::listData(Autores::model()->findAll(), 'ID_AUTOR', 'AUTOR');
				//echo CHtml::dropDownList('autores','',$dataA,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;'));
			}

			public function actionBibliotecaIdiomas()
			{
				$id = $_GET["id"];
				
				$criteria = new CDbCriteria;
				$criteria->condition = "ID_IDIOMA LIKE :id";
				$criteria->params = array(":id"=>"%$id%");
				$criteria->order = 'TITULO ASC';
				$data =  new CActiveDataProvider('Libros', array('criteria'=>$criteria,
					'pagination' => array(
						'pageSize' => 100,
						),
					));

				$this->render('_biblioteca',array('dataProvider'=>$data));
			}
		}