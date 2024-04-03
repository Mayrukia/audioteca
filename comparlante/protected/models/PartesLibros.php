<?php

/**
 * This is the model class for table "partes_libros".
 *
 * The followings are the available columns in table 'partes_libros':
 * @property integer $ID_PARTES
 * @property integer $ID_LIBRO
 * @property integer $NUMERO_PARTE
 * @property string $URL_AUDIO
 *
 * The followings are the available model relations:
 * @property Libros $iDLIBRO
 */
class PartesLibros extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $audio;	  // Atributo para almacenar la URL del audio-libro.
	
	public function tableName()
	{
		return 'partes_libros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('audio', 'file','types'=>'mp3', 'allowEmpty'=>true, 'on'=>'insert'), 
			array('audio', 'file','types'=>'mp3', 'allowEmpty'=>true, 'on'=>'update'), 
			array('NUMERO_PARTE', 'required'),
			array('ID_LIBRO, NUMERO_PARTE', 'numerical', 'integerOnly'=>true),
			array('URL_AUDIO', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_PARTES, ID_LIBRO, NUMERO_PARTE, URL_AUDIO', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'libro' => array(self::BELONGS_TO, 'Libros', 'ID_LIBRO'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'ID_PARTES' => 'Id Partes',
			'ID_LIBRO' => 'Id Libro',
			'NUMERO_PARTE' => 'Número de Parte',
			'URL_AUDIO' => 'Url Audio',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('ID_PARTES',$this->ID_PARTES);
		$criteria->compare('ID_LIBRO',$this->ID_LIBRO);
		$criteria->compare('NUMERO_PARTE',$this->NUMERO_PARTE);
		$criteria->compare('URL_AUDIO',$this->URL_AUDIO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
