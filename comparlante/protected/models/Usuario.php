<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $ID_USUARIO
 * @property string $NOMBRE
 * @property string $APELLIDO
 * @property string $CONTRASENA
 * @property string $CORREO
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_USUARIO, NOMBRE, CONTRASENA', 'required'),
			array('ID_USUARIO', 'length', 'max'=>15),
			array('NOMBRE, APELLIDO, CONTRASENA, CORREO', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_USUARIO, NOMBRE, APELLIDO, CONTRASENA, CORREO', 'safe', 'on'=>'search'),
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
			'ID_USUARIO' => 'Usuario',
			'NOMBRE' => 'Nombre',
			'APELLIDO' => 'Apellido',
			'CONTRASENA' => 'Contraseña',
			'CORREO' => 'Correo',
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

		$criteria->compare('ID_USUARIO',$this->ID_USUARIO,true);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('APELLIDO',$this->APELLIDO,true);
		$criteria->compare('CONTRASENA',$this->CONTRASENA,true);
		$criteria->compare('CORREO',$this->CORREO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function validatePassword($password)
	{
	return $password ===$this->CONTRASENA;
	}
}
