<?php

/**
 * This is the model class for table "idiomas".
 *
 * The followings are the available columns in table 'idiomas':
 * @property integer $ID_IDIOMA
 * @property string $IDIOMA
 * @property string $DESCRIPCION
 *
 * The followings are the available model relations:
 * @property Libros[] $libroses
 */
class Idiomas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $imagen;	  // Atributo para almacenar la URL del audio-libro.
	public function tableName()
	{
		return 'idiomas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('imagen', 'file','types'=>'jpg, jpeg, png', 'allowEmpty'=>true, 'on'=>'insert'), 
			array('imagen', 'file','types'=>'jpg, jpeg, png', 'allowEmpty'=>true, 'on'=>'update'), 

			array('IDIOMA', 'required'),
			array('IDIOMA', 'length', 'max'=>150),
			array('DESCRIPCION', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_IDIOMA, IDIOMA, DESCRIPCION', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'libroses' => array(self::HAS_MANY, 'Libros', 'ID_IDIOMA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_IDIOMA' => 'ID Idioma',
			'IDIOMA' => 'Idioma',
			'DESCRIPCION' => 'Descripción',
			'audio'		=> 'Bandera idioma',
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

		$criteria->compare('ID_IDIOMA',$this->ID_IDIOMA);
		$criteria->compare('IDIOMA',$this->IDIOMA,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Idiomas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
