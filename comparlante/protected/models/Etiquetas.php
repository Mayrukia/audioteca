<?php

/**
 * This is the model class for table "etiquetas".
 *
 * The followings are the available columns in table 'etiquetas':
 * @property integer $ID_ETIQUETA
 * @property string $ETIQUETA
 * @property string $DESCRIPCION
 *
 * The followings are the available model relations:
 * @property Libros[] $libroses
 */
class Etiquetas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'etiquetas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ETIQUETA', 'required'),
			array('DESCRIPCION', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_ETIQUETA, ETIQUETA, DESCRIPCION', 'safe', 'on'=>'search'),
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
			'libros' => array(self::MANY_MANY, 'Libros', 'libros_tienen_etiquetas(ID_ETIQUETA, ID_LIBRO)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_ETIQUETA' => 'ID Etiqueta',
			'ETIQUETA' => 'Etiqueta',
			'DESCRIPCION' => 'Descripción',
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

		$criteria->compare('ID_ETIQUETA',$this->ID_ETIQUETA);
		$criteria->compare('ETIQUETA',$this->ETIQUETA,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Etiquetas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
