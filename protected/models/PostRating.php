<?php

/**
 * This is the model class for table "post_rating".
 *
 * The followings are the available columns in table 'post_rating':
 * @property string $id
 * @property integer $user_id
 * @property integer $author_id
 * @property string $post_id
 * @property string $time_add
 * @property integer $delta
 *
 * The followings are the available model relations:
 * @property Post $post
 * @property Account $user
 * @property Account $author
 */
class PostRating extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PostRating the static model class
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
		return 'post_rating';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, author_id, post_id, time_add, delta', 'required'),
			array('user_id, author_id, delta', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, author_id, post_id, time_add, delta', 'safe', 'on'=>'search'),
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
			'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
			'user' => array(self::BELONGS_TO, 'Account', 'user_id'),
			'author' => array(self::BELONGS_TO, 'Account', 'author_id'),
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
			'post_id' => 'Post',
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
		$criteria->compare('post_id',$this->post_id,true);
		$criteria->compare('time_add',$this->time_add,true);
		$criteria->compare('delta',$this->delta);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function allreadyVote($user, $post_id)
        {
            $user = Yii::app()->user->getId();
            $criteria = new CDbCriteria;
            $criteria->addCondition("post_id=:id");
            $criteria->addCondition("user_id=:user");
            $criteria->params = array(':id' => $post_id, ':user' => $user);
            $c = PostRating::model()->find($criteria);
            return ($c == null) ? false : true;
        }
        
        public static function addNewItem ($d, $post)
        {
            
            $model = new PostRating();
            $model->user_id = Yii::app()->user->getId();
            $model->author_id = $post->author_id;
            $model->post_id = $post->id;
            $model->time_add = date('Y-m-d H:i:s');
            $model->delta = $d;
            if ($model->save(false))
            {
                $post->saveCounters(array('all_vote_count'=>1));
                if ($d>0) $post->saveCounters(array('positive_vote_count'=>1));
                return $model;
            }
            return false;
            
            
        }
}