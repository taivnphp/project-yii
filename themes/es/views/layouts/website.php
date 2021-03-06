<?php
$randomkey    = Yii::app()->helper->generateRandomString();
$controllerID = Yii::app()->controller->id;
$actionID     = strtolower(Yii::app()->controller->action->id);
$themeBaseURL = Yii::app()->theme->baseUrl.'/website/';

if(isset(Yii::app()->session['sess_lang'])){
    $language=Yii::app()->session['sess_lang'];
}
else $language = 'en';
Yii::app()->language=$language;

?>
<html>
    <head>
        <title>Smart Shop</title>
        <!-- for-mobile-apps -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="keywords" content="Smart Shop Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
        Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //for-mobile-apps -->
        <link rel="stylesheet" href="<?php echo $themeBaseURL; ?>css/flexslider.css" type="text/css" media="screen" />
        <link href="<?php echo $themeBaseURL; ?>css/pignose.layerslider.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo $themeBaseURL; ?>css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo $themeBaseURL . 'css/style.css?k=' . $randomkey; ?>" rel="stylesheet" type="text/css" media="all">
        <!-- js -->
        <script type="text/javascript" src="<?php echo $themeBaseURL; ?>js/jquery-2.1.4.min.js"></script>
        <!-- //js -->
        <!-- cart -->
        <!-- <script src="<?php echo $themeBaseURL; ?>js/simpleCart.min.js"></script> -->
        <!-- cart -->
        <!-- for bootstrap working -->
        <script type="text/javascript" src="<?php echo $themeBaseURL; ?>js/bootstrap-3.1.1.min.js"></script>
        <!-- //for bootstrap working -->
        <link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic" rel="stylesheet" type="text/css">
        <script src="<?php echo $themeBaseURL; ?>js/jquery.easing.min.js"></script>        
        <script src="<?php echo $themeBaseURL; ?>js/imagezoom.js"></script><!--Product Photo Image Zooms -->
        <script src="<?php echo $themeBaseURL; ?>js/jquery.flexslider.js"></script> <!--Product Photo Sliders -->                
    </head>
    <body cz-shortcut-listen="true">
        <!-- header -->
        <div class="header">
            <div class="container">
                <ul>
                    <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span><?php echo Yii::t('trans', 'Free and Fast Delivery');?></li>
                    <li><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><?php echo Yii::t('trans', 'Free shipping On all orders');?></li>
                    <li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:info@example.com">info@example.com</a></li>
                </ul>
            </div>
        </div>
        <!-- //header -->
        <!-- header-bot -->
        <div class="header-bot">
            <div class="container">
                <div class="col-md-3 header-left">
                    <h1><a href="<?php echo Yii::app()->getBaseUrl(true); ?>"><img src="<?php echo $themeBaseURL; ?>images/logo3.jpg"></a></h1>
                </div>
                <div class="col-md-5 header-right">
                    <?php 
                    //Load Languages
                    $this->widget("ext.widgets.language_widget");
                    ?>            
                </div>
                <div class="col-md-4 header-right footer-bottom">
                    <?php
                    //Load Social Medias
                    $this->widget("ext.widgets.social_media_widget");
                    ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- //header-bot -->
        <!-- banner -->
        <div class="ban-top">
            <div class="container">
                <?php 
                //Load Main Website Menu
                $this->widget("ext.widgets.website_main_navigation_widget");
                ?>
            </div>
        </div>

        <!-- breadcrumbs -->
        <?php if(!empty($this->breadcrumbs)):?>                
            <div class="page-head page-head-breadcrumbs">
                <div class="container">                
                    <div class='pathway'>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'homeLink'=>CHtml::link(Yii::t('trans','Home'), Yii::app()->getBaseUrl(true)),
                            'links'=>$this->breadcrumbs,
                            'encodeLabel' => false,
                            'separator' => ''
                        )); ?>
                    </div>                
                </div>
            </div>
        <?php endif?>
            
        <div class="mainContent">
            <!-- MAIN WEBSITE CONTENT -->
            <?php echo $content; ?>
            <div class="clearfix"></div>
        </div>    
        <!-- //contact -->

        <!-- //product-nav -->
        <div class="coupons">
            <div class="container">
                <div class="coupons-grids text-center">
                    <div class="col-md-3 coupons-gd">
                        <h3><?php echo Yii::t('trans', 'Buy your product in a simple way');?></h3>
                    </div>
                    <div class="col-md-3 coupons-gd">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <h4>LOGIN TO YOUR ACCOUNT</h4>
                        <p>Neque porro quisquam est, qui dolorem ipsum quia dolor
                    sit amet, consectetur.</p>
                    </div>
                    <div class="col-md-3 coupons-gd">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        <h4>SELECT YOUR ITEM</h4>
                        <p>Neque porro quisquam est, qui dolorem ipsum quia dolor
                    sit amet, consectetur.</p>
                    </div>
                    <div class="col-md-3 coupons-gd">
                        <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                        <h4>MAKE PAYMENT</h4>
                        <p>Neque porro quisquam est, qui dolorem ipsum quia dolor
                    sit amet, consectetur.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <div class="footer">
            <div class="container">
                <div class="col-md-3 footer-left">
                    <h2><a href="<?php echo Yii::app()->getBaseUrl(true); ?>"><img src="<?php echo $themeBaseURL; ?>images/logo3.jpg" alt=" "></a></h2>
                    <p><?php echo Yii::t('trans', 'shop_short_introduce');?></p>
                </div>
                <div class="col-md-9 footer-right">
                    <div class="col-sm-6 newsleft">
                        <h3><?php echo Yii::t('trans', 'sign_up_for_new_letter');?></h3>
                    </div>
                    <div class="col-sm-6 newsright">
                        <form>
                            <input type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
                            <input type="submit" value="<?php echo Yii::t('trans', 'Submit');?>">
                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <div class="sign-grds">
                        <div class="col-md-4 sign-gd">
                            <h4>Link</h4>
                            <ul>                                
                                <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>"><?php echo Yii::t('trans', 'Home'); ?></a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('site/about'); ?>"><?php echo Yii::t('trans', 'About_Us'); ?></a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('site/question'); ?>"><?php echo Yii::t('trans', 'Question'); ?></a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('site/contact'); ?>"><?php echo Yii::t('trans', 'Contact'); ?></a></li>
                            </ul>
                        </div>
                        
                        <div class="col-md-4 sign-gd-two">
                            <h4><?php echo Yii::t('trans','Store Information');?></h4>
                            <ul>
                                <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><?php echo Yii::t('trans','Address');?> : <?php echo Yii::app()->params['address']; ?></li>
                                <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Email : <a href="mailto:<?php echo Yii::app()->params['email']; ?>"><?php echo Yii::app()->params['email']; ?></a></li>
                                <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>Phone : <?php echo Yii::app()->params['hotline']; ?></li>
                            </ul>
                        </div>                        
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <p class="copy-right">Copy Right © <?php echo date('Y'); ?></p>
            </div>
        </div>
        <a class="backToTop" id="backToTop"><span class="glyphicon glyphicon-arrow-up"></span></a>
        <!-- //footer -->
        <script type="text/javascript">
            var _urlChangeLanguage='<?php echo Yii::app()->createUrl('site/ChangeLanguage'); ?>';
        </script>
        <script type="text/javascript" src="<?php echo $themeBaseURL; ?>js/script.js?k=<?php echo $randomkey?>"></script>
    </body>
</html>