<?php

class CategoryController extends Controller
{
	public $layout = '//layouts/admin';
    protected $folderName = 'category/';
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionAdmin()
    {
        $this->checkAccess();
        $this->render('admin');
    }

    public function actionView($id){
        $this->layout = 'website';
        $catId=(int)$id;
        $this->render('view', array(
            'model' => Category::model()->findByPk($catId)
        ));
    }
    
}