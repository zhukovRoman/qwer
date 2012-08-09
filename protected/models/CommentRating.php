<?php

/**
 * This is the model class for table "comment_rating".
 *
 * The followings are the available columns in table 'comment_rating':
 * @property string $id
 * @property integer $user_id
 * @property integer $author_id
 * @property string $comment_id
 * @property string $time_add
 * @property integer $delta
 *
 * The followings are the available model relations:
 * @property Account $user
 * @property Account $author
 * @property Comment $comment
 */
class CommentRating extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CommentRating the static model class
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
		return 'comment_rating';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, author_id, comment_id, time_add, delta', 'required'),
			array('user_id, author_id, delta', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, author_id, comment_id, time_add, delta', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Account', 'user_id'),
			'author' => array(self::BELONGS_TO, 'Account', 'author_id'),
			'comment' => array(self::BELONGS_TO, 'Comment', 'comment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'author_id' => 'Author',
			'comment_id' => 'Comment',
			'time_add' => 'Time Add',
			'delta' => 'Delta',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('comment_id',$this->comment_id,true);
		$criteria->compare('time_add',$this->time_add,true);
		$criteria->compare('delta',$this->delta);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}