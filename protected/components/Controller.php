<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();

    protected $folderName;
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    protected $pUploadFiles;
    public function  beforeAction($action){              
    	$this->pUploadFiles = $_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles;
    	if(!is_dir($this->pUploadFiles)){
            $old = umask(0);
            @mkdir($this->pUploadFiles, 0777);
            umask($old);
        }

        if($this->folderName){
            if(!is_dir($this->pUploadFiles . $this->folderName)){
                $old = umask(0);
                @mkdir($this->pUploadFiles . $this->folderName, 0777);
                umask($old);
            }
        }
        return true;
    }


    /**
     * [Set dynamic title]
     * http://redmine.elidev.info/issues/4892
     * @return [type] [description]
     */
    public function init() {
        parent::init();                
    }

    /*
    Check Acess for Admin pages    
    */
    public function checkAccess(){
        if(Yii::app()->user->isGuest){
            $this->redirect(array('admin/login'));
        }
    }

    public function getLanguage(){
        $language = isset(Yii::app()->session['sess_lang']) ? Yii::app()->session['sess_lang'] : 'en';
        return ($language == 'en_us') ? 'en' : $language;
    }

    public function setLanguage(){
        if(!empty(Yii::app()->session['sess_lang'])){
            $language=Yii::app()->session['sess_lang'];
        }
        else $language = 'en';
        Yii::app()->language=( $language == 'en_us') ? 'en' : $language;
    }
}