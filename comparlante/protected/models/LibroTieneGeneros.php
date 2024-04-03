<?php

/**
 * This is the model class for table "libro_tiene_generos".
 *
 * The followings are the available columns in table 'libro_tiene_generos':
 * @property integer $ID_GENERO
 * @property integer $ID_LIBRO
 */
class LibroTieneGeneros extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'libro_tiene_generos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_GENERO, ID_LIBRO', 'required'),
			array('ID_GENERO, ID_LIBRO', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_GENERO, ID_LIBRO', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'libros'  => array(self::HAS_MANY, 'Libros', 'ID_LIBRO'),
			'generos' => array(self::HAS_MANY, 'Genero', 'ID_GENERO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_GENERO' => 'Id Genero',
			'ID_LIBRO' => 'Id Libro',
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

		$criteria->compare('ID_GENERO',$this->ID_GENERO);
		$criteria->compare('ID_LIBRO',$this->ID_LIBRO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LibroTieneGeneros the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
