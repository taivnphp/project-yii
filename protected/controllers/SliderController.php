<?php

class SliderController extends Controller
{
    public $layout = '//layouts/admin';
    protected $folderName = 'slider/';

    public function loadModel($id) {
        $model = SlideShow::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t( 'trans', 'Not Found'));
        return $model;
    }

    public function actionIndex()
    {
        $this->redirect(array('slider/admin'));
    }

    public function actionAdmin()
    {
    	Yii::app()->language = 'vi';
        $this->checkAccess();

        $sliders = new SlideShow('search');
        $sliders->unsetAttributes();  // clear any default values                

        $this->render('admin', array(
            'model' => $sliders,            
            'adminUrl' => Yii::app()->createUrl('slider/admin'),
            'uploadPath' => Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles . $this->folderName
        ));
    }

    public function actionCreate(){

    	$slideShow = new SlideShow;
    	if(!empty($_POST['SlideShow'])){
    		$slideShow->attributes = $_POST['SlideShow'];    		
    		$fileSliderShow = array();
            if (isset($_FILES["slideShowImage"]) && !empty($_FILES["slideShowImage"]['name'])){
                $fileSliderShow = $_FILES["slideShowImage"];
                $ext = strtolower(pathinfo($fileSliderShow['name'], PATHINFO_EXTENSION));                
                $slideShow->slideshowImageURL = md5('thumb' . time()) . '.' . $ext ;                 
            }

            if($slideShow->save()){
                $uploadPath = $this->pUploadFiles . $this->folderName . '/';
                if(!is_dir($uploadPath)){            
                    $old = umask(0);
                    @mkdir($uploadPath, 0777);
                    umask($old);
                }
                //upload thumbnail
                if (!empty($fileSliderShow)){                                        
                    move_uploaded_file($fileSliderShow["tmp_name"], $uploadPath . $slideShow->slideshowImageURL);                    
                }                        

                Yii::app()->user->setFlash('message', 'Thông tin Slider đã được lưu !');
                $this->redirect(array('update', 'id' => $slideShow->slideshowID));
            }
            
    	}
    	$this->render('form' , array(
            'slideShow' => $slideShow,
            'uploadPath' => Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles . $this->folderName
        ));
    }

    public function actionUpdate($id){
    	$slideShow = $this->loadModel($id);

    	if(!empty($_POST['SlideShow'])){
    		$slideShow->attributes = $_POST['SlideShow'];    		
    		$fileSliderShow = array();
            if (isset($_FILES["slideShowImage"]) && !empty($_FILES["slideShowImage"]['name'])){
                $fileSliderShow = $_FILES["slideShowImage"];
                $ext = strtolower(pathinfo($fileSliderShow['name'], PATHINFO_EXTENSION));                
                $slideShow->slideshowImageURL = md5('thumb' . time()) . '.' . $ext ;                 
            }

            if($slideShow->save()){
                $uploadPath = $this->pUploadFiles . $this->folderName . '/';
                if(!is_dir($uploadPath)){            
                    $old = umask(0);
                    @mkdir($uploadPath, 0777);
                    umask($old);
                }
                //upload thumbnail
                if (!empty($fileSliderShow)){                                        
                    move_uploaded_file($fileSliderShow["tmp_name"], $uploadPath . $slideShow->slideshowImageURL);                    
                }                        

                Yii::app()->user->setFlash('message', 'Thông tin Slider đã được lưu !');
                $this->redirect(array('update', 'id' => $slideShow->slideshowID));
            }
            
    	}
    	$this->render('form' , array(
            'slideShow' => $slideShow,
            'uploadPath' => Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles . $this->folderName
        ));
    }

    public function actionDelete($id){
    	$slideShow = $this->loadModel($id);
    	if(!empty($slideShow)){
    		$slideshowImageURL = $this->pUploadFiles . $this->folderName . '/' . $slideShow->slideshowImageURL;
    		@unlink($slideshowImageURL);

    		$slideShow->delete();

            if(!Yii::app()->request->isPostRequest)
                $this->redirect(array('slider/admin'));
            
            if (!isset($_GET['ajax']))

            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    	}
    }
}