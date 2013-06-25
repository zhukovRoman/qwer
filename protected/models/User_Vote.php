<?php

/**
 * This is the model class for table "user_vote".
 *
 * The followings are the available columns in table 'user_vote':
 * @property integer $id
 * @property integer $id_poll
 * @property integer $id_user
 * @property integer $id_var
 */
class User_Vote extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User_Vote the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_vote';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_poll, id_user, id_var', 'required'),
            array('id_poll, id_user, id_var', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, id_poll, id_user, id_var', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_poll' => 'Id Poll',
            'id_user' => 'Id User',
            'id_var' => 'Id Var',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('id_poll', $this->id_poll);
        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('id_var', $this->id_var);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function alreadyVote($poll_id) {
        $user = Yii::app()->user->getId();
        $criteria = new CDbCriteria;
        $criteria->addCondition("id_poll=:id");
        $criteria->addCondition("id_user=:user");
        $criteria->params = array(':id' => $poll_id, ':user' => $user);
        $c = User_Vote::model()->find($criteria);
        return ($c == null) ? false : true;
    }

    public static function getVotes($id_poll, $id_var = -1) {
        if ($id_var == -1) {
            $criteria = new CDbCriteria;
            $criteria->addCondition("id_poll=:id");
            $criteria->params = array(':id' => $id_poll);
            return User_Vote::model()->findAll($criteria);
        } else {
            $criteria = new CDbCriteria;
            $criteria->addCondition("id_poll=:id");
            $criteria->addCondition("id_var=:var");
            $criteria->params = array(':id' => $id_poll, ':var' => $id_var);
            return User_Vote::model()->findAll($criteria);
        }
    }

}