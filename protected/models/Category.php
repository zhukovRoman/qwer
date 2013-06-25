<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $order
 *
 * The followings are the available model relations:
 * @property Post[] $posts
 * @property Post[] $posts1
 */
class Category extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id,name', 'required'),
            array('parent_id, order', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'posts' => array(self::HAS_MANY, 'Post', 'category_id'),
            'posts1' => array(self::HAS_MANY, 'Post', 'sub_cat_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Вложена',
            'name' => 'Название',
            'order' => 'Порядок',
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
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('order', $this->order);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
					'pagination' => array(
                        'pageSize' => 50,
                    ),
                ));
				
				
    }

    public function getSubCats($cat) {
        return Category::model()->findAll('parent_id=:sel', array(':sel' => $cat->id));
    }

    public function getParent($cat) {
        return Category::model()->findByPk($cat->parent_id);
    }

    public static function getCategories($id_par = 0) {
        $criteria = new CDbCriteria();
        $criteria->addCondition('parent_id=:sel');
        $criteria->order = "`order` ASC";
        $criteria->params = array(':sel' => $id_par);
        $cats = Category::model()->findAll($criteria);
        
        $url = ($id_par==0)? 'category/view':'category/subcatview';
        $res = array();
        foreach ($cats as $cat) {
            
            $subcats = Category::getCategories($cat->id);
            if (count ($subcats)!=0)
            $res[] = array(
                'label' => $cat->name,
                'url' => Yii::app()->createUrl($url, array(
                    'id' => $cat->id,
                )),
                'items' => $subcats,    
            );
            else 
                $res[] = array(
                'label' => $cat->name,
                'url' => Yii::app()->createUrl($url, array(
                    'id' => $cat->id,
                )),  
            );
        }
        return $res;
    }
    
    public function getNameParent($id)
    {
        $par = $this->getParent($this);
        return ($par==null) ? "Без категории":$par->name;
    }

}