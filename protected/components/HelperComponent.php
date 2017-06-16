<?php

class HelperComponent extends CComponent{

    public function init() {
        //init
    }
    public function generateRandomString() {
        $characters   = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        $length = strlen($characters) - 1;
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $length)];
        }
        return $randomString;
    }

    public function renderMessage(){
        $messgage = Yii::app()->user->getFlash('message');
        if(!empty($messgage)){
            if(is_array($messgage)){
                foreach($messgage as $title){
                    echo '<div class="successMessage FormMessage">' . $title . '</div>';
                }
            }
            else{
                echo '<div class="successMessage FormMessage">' . $messgage . '</div>';
            }
        }
    }
    
    public function renderErrorMessage(){
        $messgage = Yii::app()->user->getFlash('errorMessage');
        if(!empty($messgage)){
            if(is_array($messgage)){
                foreach($messgage as $title){
                    echo '<div class="errorMessage FormMessage">' . $title . '</div>';
                }
            }
            else{
                echo '<div class="errorMessage FormMessage">' . $messgage . '</div>';
            }
        }
    }    

    /**
     * Application LOGO
     * @return string
     */
    public function getApplicationIcon(){
        // $applicationLogo = SiteConfig::model()->getConfig('applicationLogo');
        // if($applicationLogo){
        //     return '<img src="'.Yii::app()->theme->baseUrl.'/uploads/'. $applicationLogo .'" alt="logo">';
        // }
        return '';
    }

    public function getApplicationLogo(){
        //$applicationLogo = SiteConfig::model()->getConfig('applicationLogo');
        // if($applicationLogo){
        //     return '<img src="'.Yii::app()->theme->baseUrl.'/uploads/'. $applicationLogo .'" alt="logo">';
        // }
        return '';
    }

    public function getPagingCustom($maxButtonCount=8){
        return array(
            'class' => 'CLinkPagerCustom', // custom CLinkPager
            'selectedPageCssClass' => 'selected',
            'internalPageCssClass' => 'page-numbers',
            'maxButtonCount'=>$maxButtonCount,
            'header'=>'',
            'firstPageLabel' => '«',
            'firstPageCssClass' => 'page-numbers',
            'lastPageLabel'  => '»',
            'lastPageCssClass' => 'page-numbers',
            'prevPageLabel'  => 'Trang truoc',
            'previousPageCssClass' => 'page-numbers',
            'nextPageLabel'  => 'Trang ke',
            'nextPageCssClass' => 'page-numbers',
        );
    }

    public function getAliasURL($strTitle){        
        $strTitle=strtolower($strTitle);
        $strTitle=trim($strTitle);
        $strTitle=str_replace(' ','-',$strTitle);
        $strTitle=preg_replace("/(ò|ó|ọ|ỏ|õ|ơ|ờ|ớ|ợ|ở|ỡ|ô|ồ|ố|ộ|ổ|ỗ)/",'o',$strTitle);
        $strTitle=preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ô|Ố|Ổ|Ộ|Ồ|Ỗ)/",'o',$strTitle);
        $strTitle=preg_replace("/(à|á|ạ|ả|ã|ă|ằ|ắ|ặ|ẳ|ẵ|â|ầ|ấ|ậ|ẩ|ẫ)/",'a',$strTitle);
        $strTitle=preg_replace("/(À|Á|Ạ|Ả|Ã|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ)/",'a',$strTitle);
        $strTitle=preg_replace("/(ề|ế|ệ|ể|ê|ễ|é|è|ẻ|ẽ|ẹ)/",'e',$strTitle);
        $strTitle=preg_replace("/(Ể|Ế|Ệ|Ể|Ê|Ễ|É|È|Ẻ|Ẽ|Ẹ)/",'e',$strTitle);
        $strTitle=preg_replace("/(ừ|ứ|ự|ử|ư|ữ|ù|ú|ụ|ủ|ũ)/",'u',$strTitle);
        $strTitle=preg_replace("/(Ừ|Ứ|Ự|Ử|Ư|Ữ|Ù|Ú|Ụ|Ủ|Ũ)/",'u',$strTitle);
        $strTitle=preg_replace("/(ì|í|ị|ỉ|ĩ)/",'i',$strTitle);
        $strTitle=preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/",'i',$strTitle);
        $strTitle=preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/",'y',$strTitle);
        $strTitle=preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/",'y',$strTitle);
        $strTitle=preg_replace('/(đ|Đ)/','d',$strTitle);
        $strTitle=preg_replace("/[^-a-zA-Z0-9]/",'',$strTitle);
        return $strTitle . '.html';
    }
}
?>