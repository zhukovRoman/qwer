<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property string $id
 * @property integer $author_id
 * @property string $post_id
 * @property string $parent_id
 * @property string $text
 * @property string $time_add
 * @property integer $rating
 * @property integer $all_vote_count
 * @property integer $positive_vote_count
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property CommentRating[] $commentRatings
 * @property Comment $parent
 * @property Comment[] $comments
 * @property Account $author
 * @property Post $post
 * @property CommentStatus $status
 */
class Comment extends CActiveRecord
{
    
    
        static public function createNewComment ($text, $parent, $post)
        {
            $comment = new Comment();
            $comment -> text = $text;
            $comment ->post_id = $post;
            $comment ->parent_id = $parent;
            $comment ->author_id = Yii::app()->user->getId();
            $comment ->time_add = date('Y-m-d H:i:s');
            $comment ->rating = 0;
            $comment ->all_vote_count =0;
            $comment ->positive_vote_count = 0;
            $comment ->status_id = 1;
            return ($comment->save())? $comment:false;
            
           
        }
        
        public function getRaiting ()
        {
            return $this->positive_vote_count;
        }

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author_id, post_id, time_add, status_id', 'required'),
			array('author_id, rating, all_vote_count, positive_vote_count, status_id', 'numerical', 'integerOnly'=>true),
			array('parent_id, text', 'safe'),
                        array('text','length', 'max'=>1000, 'min'=>1),
                        array('text','required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, author_id, post_id, parent_id, text, time_add, rating, all_vote_count, positive_vote_count, status_id', 'safe', 'on'=>'search'),
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
			'commentRatings' => array(self::HAS_MANY, 'CommentRating', 'comment_id'),
			'parent' => array(self::BELONGS_TO, 'Comment', 'parent_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'parent_id'),
			'author' => array(self::BELONGS_TO, 'Account', 'author_id'),
			'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
			'status' => array(self::BELONGS_TO, 'CommentStatus', 'status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author_id' => 'Author',
			'post_id' => 'Post',
			'parent_id' => 'Parent',
			'text' => 'Текст комментария',
			'time_add' => 'Time Add',
			'rating' => 'Rating',
			'all_vote_count' => 'All Vote Count',
			'positive_vote_count' => 'Positive Vote Count',
			'status_id' => 'Status',
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
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('post_id',$this->post_id,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('time_add',$this->time_add,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('all_vote_count',$this->all_vote_count);
		$criteria->compare('positive_vote_count',$this->positive_vote_count);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
}