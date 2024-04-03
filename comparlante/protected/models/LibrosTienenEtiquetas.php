<?php

/**
 * This is the model class for table "libros_tienen_etiquetas".
 *
 * The followings are the available columns in table 'libros_tienen_etiquetas':
 * @property integer $ID_ETIQUETA
 * @property integer $ID_LIBRO
 */
class LibrosTienenEtiquetas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'libros_tienen_etiquetas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_ETIQUETA, ID_LIBRO', 'required'),
			array('ID_ETIQUETA, ID_LIBRO', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_ETIQUETA, ID_LIBRO', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_ETIQUETA' => 'Etiqueta',
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

		$criteria->compare('ID_ETIQUETA',$this->ID_ETIQUETA);
		$criteria->compare('ID_LIBRO',$this->ID_LIBRO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LibrosTienenEtiquetas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
