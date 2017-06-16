<?php

class AdminController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
            
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{        
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else{
                $this->render('error_page', array(
                    'errorCode'=>$error['code'],
                    'errorMessage'=>$error['message'])
                );
                $error=NULL;
            }				
		}
	}

	public function checkAccess(){
        if(Yii::app()->user->isGuest){
            $this->redirect(array('admin/login'));
        }
    }

    /**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        $this->layout = 'login';
		$userLoginForm    = new LoginForm;
        $activeTab = 'login';
        $flagErr    = 0;		

		// // LOGIN
		if(isset($_POST['LoginForm']))
		{            
			$userLoginForm->attributes=$_POST['LoginForm'];

            $validate = ($userLoginForm->validate() && $userLoginForm->login());
            
            //validate login form
			if($validate) {
				$this->redirect(array('product/admin'));
            }
            else{
                $flagErr = 1;
            }
		}

		// display the login form
		$this->render('login',array('userLoginForm'=>$userLoginForm, 'activeTab' => $activeTab, 'flagErr' => $flagErr));
	}

    public function actionChangePassword(){
        echo 'change password';
    }
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
        $userId = Yii::app()->user->id;
		Yii::app()->user->logout();                
		$this->redirect(array('admin/login'));
	}
}