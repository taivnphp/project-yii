<?php

class SiteController extends Controller {

    public $layout = '//layouts/website';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->render('index');
    }

    public function actionLogin() {
        $this->redirect(array('admin/login'));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else {
                $this->render('error_page', array(
                    'errorCode' => $error['code'],
                    'errorMessage' => $error['message'])
                );
                $error = NULL;
            }
        }
    }

    public function actionAbout() {
        $this->render('about');
    }

    public function actionQuestion() {
        $this->render('question');
    }

    public function actionContact() {
        $this->render('contact');
    }

    public function actionNews(){
        $this->render('news');   
    }

    public function actionChangeLanguage() {
        $lang = Yii::app()->request->getParam('lang', 'en');
        Yii::app()->session['sess_lang'] = $lang;
    }

}
