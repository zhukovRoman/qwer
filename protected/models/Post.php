<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property string $id
 * @property string $title
 * @property string $text
 * @property string $code
 * @property integer $category_id
 * @property integer $sub_cat_id
 * @property integer $author_id
 * @property integer $status_id
 * @property string $time_add
 * @property boolean $is_video
 * @property boolean $is_photoset
 * @property boolean $is_playlist
 * @property integer $view_count
 * @property integer $favourite_count
 * @property integer $comment_count
 * @property integer $rating_count
 * @property integer $all_vote_count
 * @property integer $positive_vote_count
 * @property string $preview_url
 * @property boolean $important_flag
 * @property boolean $landscape
 * @property integer $order
 * @property string $subtitle
 * @property string $tag
 * @property string $time_moder
 *
 * The followings are the available model relations:
 * @property PostRating[] $postRatings
 * @property Comment[] $comments
 * @property Favourites[] $favourites
 * @property Category $subCat
 * @property Account $author
 * @property PostStatus $status
 * @property Category $category
 */
class Post extends CActiveRecord {

    public $old_tags;

    const APPROVE_STATUS = 5;
    const DAYS_FOR_BEST = 30;
    const COUNT_OF_DISSCUS = 5;
    const DAYS_FOR_DISCUSS = 12;
    const COUNT_OF_BEST = 9;
    const DEF_URL = "images/def_prev.png";

    /*     * <img src="topics/2012_08_23/5ddb91f24bb76bfab77ca8fa98a4921f_92_crop.jpg" alt="">
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Post the static model class
     */

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'post';
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, category_id, text', 'required',
                'on' => 'create_text',
                'message' => 'Поле {attribute} обязательно для заполнения'),
            array('title, category_id', 'required', 'on' => 'create_video'),
            array('title, category_id', 'required', 'on' => 'create_photo'),
            array('category_id, sub_cat_id, author_id, 
                status_id, view_count, favourite_count,
                comment_count, rating_count, all_vote_count,
                positive_vote_count, order', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 130, 'min' => 3,
                'tooLong' => 'Длинна заголовка должна быть больше 2 и меньше 130 символов',
                'tooShort' => 'Длинна заголовка должна быть больше 2 и меньше 130 символов',
            ),
            array(' subtitle', 'length', 'max' => 300, 'min' => 3,
                'tooLong' => 'Длинна подзаголовка должна быть больше 2 и меньше 300 символов',
                'tooShort' => 'Длинна подзаголовка должна быть больше 2 и меньше 300 символов',
            ),
            array('preview_url', 'length', 'max' => 120),
            array('tag', 'length', 'max' => 500),
            array('text', 'length', 'max' => 30000, 'min' => 15,
                'on' => 'create_text',
                'tooLong' => 'Длинна текста должна быть меньше 15000 символов',
                'tooShort' => 'Длинна текста должна быть больше 15',
            ),
            array('text, preview_url, title, subtitle, sub_cat_id, category_id, tag, code', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, text, category_id, sub_cat_id, author_id,
                status_id, time_add, is_video, is_photoset, is_playlist, subtitle, 
                author.login, author.id', 'safe', 'on' => 'search'),
            array('title, subtitle', 'match', 'pattern' => '/^[\'":ёЁ0-9A-zА-я\s\-\(\)\"\.\,\?\!№%]+$/u',
                'message' => 'Поле может содержать только буквы, цифры и символы (-".,?!№%)'),
            array('code', 'match',
                'pattern' => "/((?:http:\/\/)?(?:player\.)?(?:www\.)?vimeo\.com\/(?:video\/)?(\d{1,10}))|((?:http:\/\/)?(?:www\.)?youtu(?:\.be|be\.com)\/(?:(?:watch\?v=)|(?:embed\/)?([\w\-]{6,12})(?:\&.+)?))/i",
                'message' => 'Неверный формат видео', 'on' => 'create_video'),
            array('code', 'required',
                'on' => 'create_video',
                'message' => 'Поле не может быть пустым. Вставьте сюда код видео')
        );
    }

    public static function getCategories() {
        $cats = Category::model()->findAll('parent_id=0');
        $res = array();
        foreach ($cats as $cat) {
            $res[$cat->id] = $cat->name;
        }
        return $res;
    }

    public static function getSubCategories($idParent) {
        if (!$idParent) {
            $idParent = 1;
        }
        $data = Category::model()->findAll('parent_id=:sel', array(':sel' => $idParent));
        $res = array();
        if (count($data) != 0) {
            $res[0] = "Без подкатегории";
        }
        foreach ($data as $cat) {
            $res[$cat->id] = $cat->name;
        }
        return $res;
    }

    public static function stripTags($tags) {
        $ret = array();
        $res = array();
        $mass_of_tags = explode(",", $tags);
        foreach ($mass_of_tags as $tag) {
            //$tmp = preg_replace("/\+s/", " ", $tag);

            $tmp = preg_replace("/[\s]+/", " ", $tag);
            $tmp = trim($tmp);
            if ($tmp != "") {
                $res [] = mb_strtolower($tmp, "UTF-8");
            }
        }
        $ret[0] = implode(",", $res);
        $ret[1] = $res;

        return $ret;
    }

    public function getTags() {
        //$res = explode(",", $this->tag);
        $ret = array();
        foreach (explode(",", $this->tag) as $t) {
            if ($t != "")
                $ret[] = $t;
        }
        return $ret;
    }

    public static function saveNewTag($tags) {

        foreach ($tags as $one_tag) {
            $try_tag = Tag::model()->find("name = :123", array(':123' => mb_strtolower($one_tag, 'UTF-8')));
            if ($try_tag != NULL) {
                $try_tag->freq++;
                $try_tag->save();
            } else {
                $new_tag = new Tag;
                $new_tag->name = mb_strtolower($one_tag, 'UTF-8');
                $new_tag->freq = 1;
                $new_tag->save();
            }
        }
    }

    public static function deleteOldTags($tags) {

        foreach ($tags as $one_tag) {
            $try_tag = Tag::model()->find("name = :123", array(':123' => strtolower($one_tag)));
            if ($try_tag != NULL) {
                $try_tag->freq--;
                $try_tag->save();
            }
        }
    }

    //  /(?:http:\/\/)?(?:www\.)?youtu(?:\.be|be\.com)\/(?:(?:watch\?v=)|(?:embed\/))?([\w\-]{6,12})(?:\&.+)?/i
    //  /(?:http:\/\/)?(?:player\.)?(?:www\.)?vimeo\.com\/(?:video\/)?(\d{1,10})/i
    //  
    public function decodeVideLink() {
        $start_frame_vimeo = '<iframe class="photo-border" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen src="http://player.vimeo.com/video/';
        $start_frame_youtube = '<iframe class="photo-border" width="560" height="315" frameborder="0" allowfullscreen src="http://www.youtube.com/embed/';
        $end_frame = '" ></iframe>';

        $code = json_decode($this->code);

        if ($code->service == 'vimeo')
            return $start_frame_vimeo . $code->url . $end_frame;
        if ($code->service == 'youtube')
            return $start_frame_youtube . $code->url . $end_frame;
    }

    public static function parseVideoLink($link) {

        $youtube_patern = "/(?:http:\/\/)?(?:www\.)?youtu(?:\.be|be\.com)\/(?:(?:watch\?v=)|(?:embed\/))?([\w\-]{6,12})(?:\&.+)?/i";
        $vimeo_patern = "/(?:http:\/\/)?(?:player\.)?(?:www\.)?vimeo\.com\/(?:video\/)?(\d{1,10})/i";

        $urls = array();

        if (preg_match($youtube_patern, $link, $urls)) {
            return json_encode(array(
                        'service' => "youtube",
                        'url' => $urls[1],
                    ));
        }
        if (preg_match($vimeo_patern, $link, $urls)) {
            return json_encode(array(
                        'service' => "vimeo",
                        'url' => $urls[1],
                    ));
        }
    }

    public function getraiting() {
        if ($this->all_vote_count == 0)
            return 0;
        $z = 1.96;
        $p = $this->positive_vote_count / $this->all_vote_count;
        $n = $this->all_vote_count;
        return round(($p + $z * $z / (2 * $n) - $z * sqrt(($p * (1 - $p) + $z * $z / (4 * $n)) / $n)) / (1 + $z * $z / $n), 2) * 10;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function convertCode() {
        //$items = explode("|", $this->code);
        $items = json_decode($this->code);
        $this->code = "";
        foreach ($items as $i) {
            if ($i != "") {
                $tmp = '<div>' . '<img src="' .
                        substr($i, 0, -4) . '_crop.jpg' . '"></div>';

                $this->code .= $tmp;
                //echo '<img src="'.substr($i, 0, -4).'.jpg'.'">';
            }
        }
    }

    public function getGalleryPhoto() {
        //$items = explode("|", $this->code);
        $items = json_decode($this->code);
        //$this->code = "";
        foreach ($items as $i) {
            if ($i != "") {
                echo '<a href="' . $i . '">
                    <img class="photo-border" src="' . substr($i, 0, -4) . '_crop.jpg' . '" 
                    width="100" height="100" />
                    </a>';
                // echo '<img src="'.substr($i, 0, -4).'.jpg'.'">';
            }
        }
    }

    public function getPhotos() {
        $res = array();

        $matches = array();
        preg_match_all('/<img[^>]+src=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/', $this->code, $matches);
        $paths = array();
        foreach ($matches[2] as $i) {
            if ($i != "") {
                $id = substr($i, -44, -9);
                $tmp = '<div><img src="' . $i . '"></div>'
                        . CHtml::button("Удалить", array('class' => 'btn-danger btn-mini', 'style' => 'margin: 5px 2px 3px 23px',
                            'onclick' => 'js:del_photo_from_set("' . $id . '")',));
                $res[$id] = $tmp;
            }
        }
        return $res;
    }

    public function afterValidate() {

        $purifier = new CHtmlPurifier();
        $purifier->options = array('HTML.SafeIframe' => true,
            'URI.SafeIframeRegexp' => '%^http://(www.youtube.com/embed/|player.vimeo.com/video/|w.soundcloud.com/player/)%');
        // $purifier->options = array();
        $this->text = $purifier->purify($this->text);

        if ($this->sub_cat_id == 0) {
            $this->sub_cat_id = null;
        }

        $this->tag = trim($this->tag);
        //$model->preview_url = $_POST['Post']['preview_url'];

        if ($this->preview_url != '') {

            if (preg_match('/topics\/(?:tmp|[0-9_]+)\/[a-zA-Z0-9_]+\.jpg/u', $this->preview_url)) {

                $res = Post::moveCropPicture($this->preview_url);
                $this->preview_url = $res[1];
                $size = getimagesize($this->preview_url);
                ($size[0] > $size[1]) ? $this->landscape = true :
                                $this->landscape = false;
            }
            else
                $this->preview_url = "";
        }
        else
            $this->landscape = true;

        if ($this->is_video) {
            $this->code = Post::parseVideoLink($this->code);
        }

        if ($this->is_playlist) {
            $this->code = Post::parsePoll($this->code);
        }
        if ($this->is_photoset) {
            $this->code = $this->ParsePhotoSet();
            //echo $this->code; die();
        }

        $this->moveImgFromText();

        return parent::afterValidate();
    }

    private function parsePoll($code) {
        $vars = explode("\r\n", $code);
        foreach ($vars as $var) {
            $var = trim($var);
        }
        return json_encode($vars);
    }

    public function moveImgFromText() {
        $matches = array();

        //$patern = '/<img[^>][\s]*[a-zA-Z0-9\/\=\s\"]*[\s]*src[\s]*=[\s]*\"[a-zA-Z0-9\/]+\.jpg/u';
        $patern = '/<img\\b[^<>]*?src=(?|"([^"]*)"|\'([^\']*)\'|([^"\"]+))[^<>]*>/i';
        preg_match_all($patern, $this->text, $matches);
        //print_r($matches[1]); die();
        $folder = "topics/" . date('Y_m_d') . "/"; // folder for uploaded files

        if (!is_dir($folder)) {
            //если папки нет
            if (!mkdir($folder))
                throw new CHttpException(404, 'can not create directory for topic.');
            #Изменить мод               
            chmod($folder, 0777);
        }



        foreach ($matches[1] as $img) {

            if (strpos($img, "opics/tmp/")) {
                //echo $img; die();
                $new_url = $folder . substr($img, strrpos($img, "/", 6) + 1, -4) . ".jpg";
                if (Post::renamePicture($img, $new_url) != "") {
                    $this->text = str_replace($img, $new_url, $this->text);
                }
            }
            //
        }
    }

    public function ParsePhotoSet() {
        $matches = array();
        preg_match_all('/<img[^>]+src=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/', $this->code, $matches);
        $paths = array();

        foreach ($matches[2] as $url) {
            $res = Post::moveCropPicture($url, false);
            $paths[] = $res[0];
        }
        return json_encode($paths);

        //implode("|", $paths);
    }

    public static function renamePicture($old_ulr, $new_url) {

        if (file_exists($old_ulr) && !rename($old_ulr, $new_url)) {
            echo "не удалось скопировать файлы...\n";
            die();
            return false;
        }
        else
            return $new_url;
    }

    public static function moveCropPicture($url) {
        $end = ".jpg";
        $crop = "_crop";
        $folder = "topics/" . date('Y_m_d') . "/"; // folder for uploaded files

        if (!is_dir($folder)) {
            //если папки нет
            if (!mkdir($folder))
                throw new CHttpException(404, 'can not create directory for topic.');
            #Изменить мод               
            chmod($folder, 0777);
        }

        $name = substr($url, strrpos($url, "/", 8) + 1, -9);

        $new_crop_file = $folder . $name . $crop . $end;
        $new_full_file = $folder . $name . $end;
        $old_crop_file = $url;
        $old_full_file = substr($url, 0, -9) . $end;


        $ret = array(Post::renamePicture($old_full_file, $new_full_file),
            Post::renamePicture($old_crop_file, $new_crop_file));

        return $ret;
    }

    public static function compareTags($old, $new) {
        $for_delete = array();
        $for_add = array();

        //проходим по старым и находим те, которые удалили.
        foreach ($old as $o) {
            $is_find = false;
            foreach ($new as $n) {
                if (strcasecmp($o, $n) == 0) {
                    $is_find = true;
                    break;
                }
            }

            if ($is_find == false) {
                $for_delete[] = $o;
            }
        }
        // проходим по новым и находим, те которые надо добавить.

        foreach ($new as $n) {
            $is_find = false;
            foreach ($old as $o) {
                if (strcasecmp($o, $n) == 0) {
                    $is_find = true;
                    break;
                }
            }

            if ($is_find == false) {
                $for_add[] = $n;
            }
        }
        return array($for_delete, $for_add);
    }

    public static function getBest() {
        $f = Post::DAYS_FOR_BEST;

        $criteria = new CDbCriteria;
        $criteria->addCondition("status_id=:status");
        $criteria->addCondition("time_moder > now() - interval $f day");
        $criteria->params = array(':status' => Post::APPROVE_STATUS,);
        //$criteria->limit=7;

        $arr = Post::model()->findAll($criteria);
        uasort($arr, "Post::sortByRating");

        if (count($arr) <= Post::COUNT_OF_BEST)
            return $arr;
        else {

            return array_slice($arr, 0, Post::COUNT_OF_BEST);
        }
    }

    public static function getDiscussed() {
        $f = Post::DAYS_FOR_DISCUSS;
        $criteria = new CDbCriteria;
        $criteria->addCondition("status_id=:status");
        $criteria->addCondition("comment_count>0");
        $criteria->addCondition("time_moder > now() - interval $f day");
        $criteria->limit = 5;
        $criteria->order = 'comment_count DESC';
        $criteria->params = array(':status' => Post::APPROVE_STATUS,
        );
        return Post::model()->findAll($criteria);
    }

    public function afterSave() {
        parent::afterSave();
    }

    public function modifyTag() {
        if ($this->isNewRecord) {
            $tags = Post::stripTags($this->tag);
            Post::saveNewTag($tags[1]);
        } else {

            $tmp = Post::stripTags($this->old_tags);
            $old_tags = $tmp[1];
            $tmp = Post::stripTags($this->tag);
            $new_tags = $tmp[1];
            //print_r($new_tags);
            //print_r($old_tags);
            //die();
            $mass = Post::compareTags($old_tags, $new_tags);

            Post::deleteOldTags($mass[0]);
            Post::saveNewTag($mass[1]);
        }
    }

    public static function getSpecProj() {
        $criteria = new CDbCriteria;
        $criteria->addCondition("status_id=:status");
        $criteria->addCondition("important_flag=true");
        $criteria->params = array(':status' => Post::APPROVE_STATUS,
        );


        return Post::model()->find($criteria);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'postRatings' => array(self::HAS_MANY, 'PostRating', 'post_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'post_id',
                'order' => 'time_add ASC',),
            'favourites' => array(self::HAS_MANY, 'Favourites', 'post_id'),
            'subCat' => array(self::BELONGS_TO, 'Category', 'sub_cat_id'),
            'author' => array(self::BELONGS_TO, 'Account', 'author_id'),
            'status' => array(self::BELONGS_TO, 'PostStatus', 'status_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Заголовок',
            'subtitle' => 'Подзаголовок',
            'text' => 'Текст',
            'code' => $this->is_video ? 'Код видео:' : "Варианты ответов:",
            'category_id' => 'Выберите категорию',
            'sub_cat_id' => 'Выберите подкатегорию',
            'author_id' => 'Автор',
            'status_id' => 'Status',
            'time_add' => 'Добавлено',
            'is_video' => 'Is Video',
            'is_photoset' => 'Is Photoset',
            'is_playlist' => 'Is Playlist',
            'view_count' => 'View Count',
            'favourite_count' => 'Favourite Count',
            'comment_count' => 'Comment Count',
            'rating_count' => 'Rating Count',
            'all_vote_count' => 'All Vote Count',
            'positive_vote_count' => 'Positive Vote Count',
            'preview_url' => 'Preview Url',
            'important_flag' => 'Important Flag',
            'landscape' => 'Landscape',
            'order' => 'Order',
            'Tag' => 'Теги',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        #$criteria->compare('text',$this->text,true);
        #$criteria->compare('code',$this->code,true);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('sub_cat_id', $this->sub_cat_id);
        $criteria->compare('author_id', $this->author_id);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('time_add', $this->time_add, true);
        $criteria->compare('is_video', $this->is_video);
        $criteria->compare('is_photoset', $this->is_photoset);
        $criteria->compare('is_playlist', $this->is_playlist);
        #$criteria->compare('view_count',$this->view_count);
        #$criteria->compare('favourite_count',$this->favourite_count);
        #$criteria->compare('comment_count',$this->comment_count);
        #$criteria->compare('rating_count',$this->rating_count);
        #$criteria->compare('all_vote_count',$this->all_vote_count);
        #$criteria->compare('positive_vote_count',$this->positive_vote_count);
        #$criteria->compare('preview_url',$this->preview_url,true);
        $criteria->compare('important_flag', $this->important_flag);
        $criteria->compare('landscape', $this->landscape);
        #$criteria->compare('order',$this->order);
        $criteria->compare('subtitle', $this->subtitle, true);
        $criteria->compare('tag', $this->tag, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function searchModer($status) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        //$criteria->addCondition('status_id=1');
        $criteria->condition = "t.status_id=:status";

        $criteria->params = array(':status' => $status);


        $criteria->compare('lower(title)', mb_strtolower($this->title, "UTF-8"), true);
        $criteria->compare('time_add', $this->time_add);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('sub_cat_id', $this->sub_cat_id);
        $criteria->with = array('author', 'category');
        $criteria->compare('author.login', $this->author_id, true);


        $sort = new CSort();
        $sort->attributes = array(
            'author_id' => array(
                'asc' => $expr = 'author.login',
                'desc' => $expr . ' DESC',
            ),
            'time_add' => array(
                'asc' => $expr = 'time_add',
                'desc' => $expr . ' DESC',
            ),
            'title' => array(
                'asc' => $expr = 'title',
                'desc' => $expr . ' DESC',
            ),
            'category_id' => array(
                'asc' => $expr = 'category.name',
                'desc' => $expr . ' DESC',
            ),
            'sub_cat_id' => array(
                'asc' => $expr = 'category.name',
                'desc' => $expr . ' DESC',
            )
        );


        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                    'sort' => $sort,
                    'pagination' => array(
                        'pageSize' => 20,
                    ),
                ));
    }

    public static function inFavorite($post_id) {
        $user = Yii::app()->user->getId();
        $criteria = new CDbCriteria;
        $criteria->addCondition("post_id=:id");
        $criteria->addCondition("user_id=:user");
        $criteria->params = array(':id' => $post_id, ':user' => $user);
        $c = Favourites::model()->find($criteria);
        return ($c == null) ? false : $c;
    }

    public static function sortByRating($p1, $p2) {

        $r1 = $p1->getraiting();
        $r2 = $p2->getraiting();
        //echo $r1. " " .$r2; die();
        if ($r1 > $r2)
            return -1;
        elseif ($r1 < $r2)
            return 1;
        else
            return 0;
    }

}