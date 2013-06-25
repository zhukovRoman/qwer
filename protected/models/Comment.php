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
class Comment extends CActiveRecord {

    const APPROVE_STATUS = 4;
    const START_STATUS = 1;
    const BEST_TIME = 200; // сколько дней для лучшего.
    const COUNT_OF_LAST = 5;
    
    
    static public function createNewComment($text, $parent, $post) {
        $comment = new Comment();
        $comment->text = $text;
        $comment->post_id = $post->id;
        $comment->parent_id = $parent;
        $comment->author_id = Yii::app()->user->getId();
        $comment->time_add = date('Y-m-d H:i:s');
        $comment->rating = 0;
        $comment->all_vote_count = 0;
        $comment->positive_vote_count = 0;
        $comment->status_id = 1;
        if ($comment->save())
        {
            $post->saveCounters(array('comment_count'=>1));
            return $comment;
        }
        else return false;
    }

    public static function alreadyVote($iduser, $idcomment) {
        $criteria = new CDbCriteria;
        $criteria->addCondition("comment_id=:id");
        $criteria->addCondition("user_id=:user");
        $criteria->params = array(':id' => $idcomment, ':user' => $iduser);
        $c = CommentRating::model()->find($criteria);

        return ($c == null) ? false : true;
    }

    public function getRaiting() {
        return $this->positive_vote_count;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comment';
    }

    public static function getBest ()
    {
        $d = Comment::BEST_TIME;
        $criteria = new CDbCriteria;
		$criteria->with = array ('post');
        $criteria->addCondition ( "t.status_id=:status");
		$criteria->addCondition ( "t.positive_vote_count>0");
        $criteria->addCondition('t.status_id=:status1', 'OR');
		$criteria->addCondition( "post.status_id=5",'AND');
        $criteria->addCondition ("t.time_add > now() - interval $d day");
        $criteria->params = array(':status' => Comment::APPROVE_STATUS,
                                    ':status1' => Comment::START_STATUS,
                                   
                                 );
        $criteria->order="(t.all_vote_count-t.positive_vote_count) DESC, t.time_add DESC";
        $criteria->limit=5;
        return Comment::model()->findAll ($criteria);
    }
    
    public static function getLast ()
    {
    $d = Comment::BEST_TIME;
        $criteria = new CDbCriteria;
        $criteria->with = array ('post');
        $criteria->addCondition ( "t.status_id=:status");
        $criteria->addCondition('t.status_id=:status1', 'OR');
		$criteria->addCondition( "post.status_id=5",'AND');
        $criteria->params = array(':status' => Comment::APPROVE_STATUS,
                                    ':status1' => Comment::START_STATUS,
                                   
                                 );
		$criteria->order="t.time_add DESC";
        $criteria->limit=Comment::COUNT_OF_LAST;
        return Comment::model()->findAll ($criteria);
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
        array('author_id, post_id, time_add, status_id', 'required'),
        array('author_id, rating, all_vote_count, positive_vote_count, status_id', 'numerical', 'integerOnly' => true),
        array('parent_id, text', 'safe'),
        array('text', 'length', 'max' => 500, 'min' => 2,
            'tooLong' => 'Длинна комментария должна быть больше 2 и меньше 500 символов',
            'tooShort' => 'Длинна комментария должна быть больше 2 и меньше 500 символов',
        ),
        //array('text', 'required'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, author_id, post_id, parent_id, 
            text, time_add, rating, all_vote_count,
            positive_vote_count, status_id, 
            author.login, author.id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
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
    public function attributeLabels() {
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
    
    public function recurseCalc($isRestore=false)
    {
        if (!$isRestore)
        {
            $count = 1;
            if ($this->status_id==2) return 0;
            foreach ($this->comments as $comm)
            {
                $count =  $count+$comm->recurseCalc();

            }
            return $count;
        }
        //подсчет при восстановлении коммента
        else {
          $count = 1;
          if ($this->status_id==2) return 0;
          foreach ($this->comments as $comm)
            {
                $count =  $count+$comm->recurseCalc();

            }
            return $count;
        }
        
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('author_id', $this->author_id);
        $criteria->compare('post_id', $this->post_id, true);
        $criteria->compare('parent_id', $this->parent_id, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('time_add', $this->time_add, true);
        $criteria->compare('rating', $this->rating);
        $criteria->compare('all_vote_count', $this->all_vote_count);
        $criteria->compare('positive_vote_count', $this->positive_vote_count);
        $criteria->compare('status_id', $this->status_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
    public function searchModer($status) {
        
        $criteria = new CDbCriteria;
        if($status!=0)
        {
            $criteria->condition = "t.status_id=:status";
            $criteria->params = array(':status' => $status);
        }
        
        $criteria->with = array('author', 'post');
        $criteria->compare('lower(author.login)', mb_strtolower(
                $this->author_id, "UTF-8"), true);
        $criteria->compare('lower(t.text)', mb_strtolower(
                $this->text, "UTF-8"), true);
        $criteria->compare('lower(post.title)', mb_strtolower(
                $this->post_id,"UTF-8"), true);
        
        $sort = new CSort();
        $sort->attributes = array(
            'author_id' => array(
                'asc' => $expr = 'author.login',
                'desc' => $expr . ' DESC',
            ),
            'text' => array(
                'asc' => $expr = 't.text',
                'desc' => $expr . ' DESC',
            ),
            'time_add' => array(
                'asc' => $expr = 't.time_add',
                'desc' => $expr . ' DESC',
            ),
             'post_id' => array(
                'asc' => $expr = 'post.title',
                'desc' => $expr . ' DESC',
            ),
              'status_id' => array(
                'asc' => $expr = 't.status_id',
                'desc' => $expr . ' DESC',
            ),

        );


        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                    'sort' => $sort,
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
                ));
    }

}