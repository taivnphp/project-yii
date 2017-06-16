<?php
class website_main_navigation_widget extends CWidget{
    public function run(){
        $this->render('website_main_navigation_widget_view', array(
        	'controllerId' => Yii::app()->controller->id,
        	'actionId' => strtolower(Yii::app()->controller->action->id),
        	'listCategories' => Category::model()->getListCatogoryByLanguage(Yii::app()->language),
    	));
    }
}
?>