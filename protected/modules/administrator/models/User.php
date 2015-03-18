<?php

class User extends CActiveRecord
{
	public $verifikasi_password;
	
	public function tableName()
	{
		return 'user';
	}

	public function rules()
	{
		return array(
			//array('id', 'required'),
			array('id, role_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>30),
			array('nama', 'length', 'max'=>50),
			array('email', 'length', 'max'=>100),
			array('password', 'length', 'max'=>1000 , 'min' => 6),
			array('role_id , username , nama , email , password , verifikasi_password' , 'required'),
			array('username , email' , 'unique'),
			array('email' , 'email'),
			array('verifikasi_password' , 'compare' , 'compareAttribute' => 'password'),
			array('id, role_id, username, nama, email, password', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		
		return array(
			'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_id' => 'Role',
			'username' => 'Username',
			'nama' => 'Nama',
			'email' => 'Email',
			'password' => 'Password',
		);
	}

	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			$this->password = helper::enkrip($this->password);
			return true;
		}
	}
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
