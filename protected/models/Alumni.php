<?php

/**
 * This is the model class for table "alumni".
 *
 * The followings are the available columns in table 'alumni':
 * @property integer $AlumniID
 * @property string $Name
 * @property string $Forename
 * @property string $Surname
 * @property string $Workplace
 * @property string $Mobile
 * @property string $Email
 * @property integer $DepartmentID
 * @property string $OtherEducation
 * @property string $pass
 * @property string $diplom
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Department $department
 * @property Fact[] $facts
 */
class Alumni extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Alumni the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alumni';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('AlumniID, Name, Surname, Workplace, DepartmentID', 'required'),
			array('AlumniID, DepartmentID, status', 'numerical', 'integerOnly'=>true),
			array('Name, Forename, Surname, diplom', 'length', 'max'=>45),
			array('Workplace, OtherEducation', 'length', 'max'=>100),
			array('Mobile', 'length', 'max'=>15),
			array('Email', 'length', 'max'=>50),
			array('pass', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('AlumniID, Name, Forename, Surname, Workplace, Mobile, Email, DepartmentID, OtherEducation, pass, diplom, status', 'safe', 'on'=>'search'),
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
			'department' => array(self::BELONGS_TO, 'Department', 'DepartmentID'),
			'facts' => array(self::HAS_MANY, 'Fact', 'AlumniID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'AlumniID' => 'Alumni',
			'Name' => 'Name',
			'Forename' => 'Forename',
			'Surname' => 'Surname',
			'Workplace' => 'Workplace',
			'Mobile' => 'Mobile',
			'Email' => 'Email',
			'DepartmentID' => 'Department',
			'OtherEducation' => 'Other Education',
			'pass' => 'Pass',
			'diplom' => 'Diplom',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('AlumniID',$this->AlumniID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Forename',$this->Forename,true);
		$criteria->compare('Surname',$this->Surname,true);
		$criteria->compare('Workplace',$this->Workplace,true);
		$criteria->compare('Mobile',$this->Mobile,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('DepartmentID',$this->DepartmentID);
		$criteria->compare('OtherEducation',$this->OtherEducation,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('diplom',$this->diplom,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}