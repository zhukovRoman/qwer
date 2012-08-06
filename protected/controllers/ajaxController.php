<?php
class AjaxController extends CController {
    // actionIndex вызывается всегда, когда action не указан явно.
    
    
    public function actionChangeSubCat(){
        $selectedCat = $_POST['Post']['category_id'];
        
        $data = Category::model()->findAll('parent_id=:sel', array (':sel'=>$selectedCat));
        
        $data=CHtml::listData($data,'id','name');
            foreach($data as $value=>$subcategory)  {
                echo CHtml::tag
                        ('option', array('value'=>$value),CHtml::encode($subcategory),true);
            }
        
      
    }
    
      public function actionUpload()
	{
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            $folder='upload/';// folder for uploaded files
            $allowedExtensions = array("jpg", "png");//array("jpg","jpeg","gif","exe","mov" and etc...
            $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $result;// it's array
	}
        
        public function actionAjaxcrop ()
        {
            
            Yii::import('ext.jcrop.EJCropper');
            $jcropper = new EJCropper();
            $jcropper->thumbPath = 'uploads/tmp';

            // some settings ...
            $jcropper->jpeg_quality = 95;
            $jcropper->png_compression = 8;

            // get the image cropping coordinates (or implement your own method)
            $coords = $jcropper->getCoordsFromPost('imageId');

            // returns the path of the cropped image, source must be an absolute path.
            $thumbnail = $jcropper->crop('Z:\\home\\cube\\www\\upload\\image.jpg', $coords);
        }
}
?>
