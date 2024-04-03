<?php

/**
 * This is the model class for table "libros".
 *
 * The followings are the available columns in table 'libros':
 * @property integer $ID_LIBRO
 * @property integer $ID_CATEGORIA
 * @property integer $ID_IDIOMA
 * @property string $TITULO
 * @property string $ANO
 * @property string $DESCRIPCION
 * @property string $URL_AUDIO
 *
 * The followings are the available model relations:
 * @property Autores[] $autores
 * @property Genero[] $generos
 * @property Categorias $iDCATEGORIA
 * @property Idiomas $iDIDIOMA
 * @property Etiquetas[] $etiquetases
 */
class Libros extends CActiveRecord
{
	public $genero;  // Atributo adicional
	public $audio;	 // Atributo para almacenar la URL del audio-libro.
	public $etiquetas;// Atributo para almacenar las etiquetas.
	public $autores = array(); // Atributo para almacenar los autores de cada libro.

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'libros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('audio', 'file','types'=>'mp3', 'allowEmpty'=>true, 'on'=>'insert'), 
			array('audio', 'file','types'=>'mp3', 'allowEmpty'=>true, 'on'=>'update'), 

			array('TITULO', 'required'),
			//array('genero', 'required', 'on'=>'update'), /* Dejar para modo de ejemplo*/
			array('ID_CATEGORIA, ID_IDIOMA', 'numerical', 'integerOnly'=>true),
			array('TITULO, NARRADOR', 'length', 'max'=>250),
			array('ANO', 'length', 'max'=>15),
			array('DESCRIPCION, EDITORIAL, URL_AUDIO, NARRADOR', 'safe'),
			
			array('ID_LIBRO, genero,ID_CATEGORIA, ID_IDIOMA, TITULO, ANO, DESCRIPCION, URL_AUDIO, NARRADOR', 'safe', 'on'=>'search'),
			array('ID_LIBRO, genero,ID_CATEGORIA, ID_IDIOMA, TITULO, ANO, DESCRIPCION, URL_AUDIO, NARRADOR', 'safe', 'on'=>'searchMix'),
		);
	}

	public function relations()
	{
		return array(
			'autores' 		=> array(self::MANY_MANY, 'Autores', 'autor_escribe_libros(ID_LIBRO, ID_AUTOR)'),
			'generos' 		=> array(self::MANY_MANY, 'Genero', 'libro_tiene_generos(ID_LIBRO, ID_GENERO)'),
			'categoria' 	=> array(self::BELONGS_TO, 'Categorias', 'ID_CATEGORIA'),
			'idioma' 		=> array(self::BELONGS_TO, 'Idiomas', 'ID_IDIOMA'),
			'etiquetas' 	=> array(self::MANY_MANY, 'Etiquetas', 'libros_tienen_etiquetas(ID_LIBRO, ID_ETIQUETA)'),
			);
	}


	public function attributeLabels()
	{
		return array(
			'ID_LIBRO' => 'Libro',
			'ID_CATEGORIA' => 'Categoria',
			'ID_IDIOMA' => 'Idioma',
			'TITULO' => 'Titulo',
			'ANO' => 'Año',
			'DESCRIPCION' => 'Descripción',
			'URL_AUDIO' => 'URL Audio',
			'NARRADOR' => 'Narrador',
			'EDITORIAL' => 'Editorial',
			'audio'		=> 'Audio-Libro',
			);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('ID_LIBRO',$this->ID_LIBRO);
		$criteria->compare('ID_CATEGORIA',$this->ID_CATEGORIA);
		$criteria->compare('ID_IDIOMA',$this->ID_IDIOMA);
		$criteria->compare('TITULO',$this->TITULO,true);
		$criteria->compare('ANO',$this->ANO,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('URL_AUDIO',$this->URL_AUDIO,true);
		$criteria->compare('NARRADOR',$this->NARRADOR,true);
		$criteria->compare('EDITORIAL',$this->EDITORIAL,true);

		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
    			'defaultOrder'=>'TITULO ASC',
    		),
			'pagination' => array(
            'pageSize' => 500,
        ),
		));
	}

	public function searchMix()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('ID_LIBRO',$this->ID_LIBRO);
		$criteria->compare('ID_CATEGORIA',$this->ID_CATEGORIA);
		$criteria->compare('ID_IDIOMA',$this->ID_IDIOMA);
		$criteria->compare('TITULO',$this->TITULO,true);
		$criteria->compare('ANO',$this->ANO,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('URL_AUDIO',$this->URL_AUDIO,true);
		$criteria->compare('NARRADOR',$this->NARRADOR,true);

		$criteria->with = array('generos');
		$criteria->compare('generos.ID_GENERO', $this->genero,true);
		  
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
    			'defaultOrder'=>'TITULO ASC',
    		),
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
