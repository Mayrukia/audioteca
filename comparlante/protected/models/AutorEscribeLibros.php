<?php

/**
 * This is the model class for table "autor_escribe_libros".
 *
 * The followings are the available columns in table 'autor_escribe_libros':
 * @property integer $ID_AUTOR
 * @property integer $ID_LIBRO
 */
class AutorEscribeLibros extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'autor_escribe_libros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_AUTOR, ID_LIBRO', 'required'),
			array('ID_AUTOR, ID_LIBRO', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_AUTOR, ID_LIBRO', 'safe', 'on'=>'search'),
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
			'autor'  => array(self::HAS_MANY, 'Autores', 'ID_AUTOR'),
			'libro'  => array(self::HAS_MANY, 'Libros', 'ID_LIBRO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_AUTOR' => 'Autor',
			'ID_LIBRO' => 'Libro',
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

		$criteria->compare('ID_AUTOR',$this->ID_AUTOR);
		$criteria->compare('ID_LIBRO',$this->ID_LIBRO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AutorEscribeLibros the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
