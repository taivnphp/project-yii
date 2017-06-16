<?php
class comment extends CWidget
{
    public $status;
    public $user_id;         
    public $measureID;          //measureID
    public $pagining;    
    public $assets;

    public function init() {
        parent::init();
        $this->assets =  Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');
        Yii::app()->clientScript->scriptMap = array(            
            '*.css'            => false, //remove all yii css,
            'jquery.js'        => false,
            'jquery.min.js'    => false,            
        );
    }

    public function run(){
        $model = new Comments;
        $model->pagining = $this->pagining;
        $model->user_id = $this->user_id;
        $allcomment = $model->getAllCommentWithIdLimit();
        $totalcomment = Comments::getTotalcomentWithId($this->user_id);

        $this->render('view',array(
            'allcomment'=> $allcomment,
            'totalcomment'=>$totalcomment,
            'assets' =>$this->assets,
            'measureID' => $this->measureID,
            'model' => $model
        ));
    }
}