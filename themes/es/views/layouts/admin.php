<?php
$randomkey    = Yii::app()->helper->generateRandomString();
$controllerID = Yii::app()->controller->id;
$actionID     = strtolower(Yii::app()->controller->action->id);
$themeBaseURL = Yii::app()->theme->baseUrl;
Yii::app()->language = 'vi';
?>
<!DOCTYPE html>
<!--[if IE 8]><html lang="en" class="no-js ie ie8"><![endif]-->
<!--[if IE 9]><html lang="en" class="no-js ie ie9"><![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,300,600,800,400" rel="stylesheet" type="text/css">
        <!-- <link rel='shortcut icon' href='<?php echo Yii::app()->helper->getApplicationIcon(); ?>?k=<?php echo $randomkey; ?>' type="image/x-icon"/>         -->
        <link rel="stylesheet"    href="<?php echo $themeBaseURL; ?>/css/style.css?k=<?php echo $randomkey; ?>">
        <link rel="stylesheet"    href="<?php echo $themeBaseURL; ?>/css/override.css?k=<?php echo $randomkey; ?>">
        <link rel="stylesheet"    href="<?php echo $themeBaseURL; ?>/css/editor.css?k=<?php echo $randomkey; ?>">        
        <script type="text/javascript" src="<?php echo $themeBaseURL; ?>/js/libs.js?k=<?php echo $randomkey; ?>"></script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body class="gap-in-cared expanded">
        <header class="header">
            <div class="header-bar">
                <div class="mm-menu"><a href="/" class="call-main-menu" title="<?php echo Yii::t('trans', 'Back_To_Home'); ?>"> <i class="fa fa-home"></i> <span><?php echo Yii::t('trans', 'Back_To_Home'); ?></span></a></div>
                <div class="header-top-bar">
                    <div class="row-clearfix">
                        <div class="tbar search-frm col-4">
                            <form id="search-frm">
                                <div class="frow">
                                    <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                                    <input type="text" placeholder="Search ...">
                                </div>
                            </form>
                        </div>
                        <div class="tbar t-r user-lik col-6">
                            <div class="user-lik-ct">
                                <div class="user-lik-ct-inner">
                                    <a href="javascript:;" class="user-admin">
                                        <span class="avatar">
                                            <img src="https://secure.gravatar.com/avatar/<?php echo md5(Yii::app()->user->getState('email')) ?>?secure=true&amp;d=identicon" alt="avatar">
                                        </span>
                                        <span class="user-admin-name"><?php echo Yii::t('trans', 'Welcome'); ?>, <?php echo Yii::app()->user->name; ?></span><i class="fa fa-sort-desc"></i>
                                    </a>                                    
                                    <div class="profile-popup">
                                        <ul>                                         
                                            <li><a href="<?php echo Yii::app()->createUrl('admin/logout'); ?>">logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="alogo col-2"><?php echo Yii::app()->helper->getApplicationLogo(); ?></a>
                    </div>
                </div>
            </div>
        </header>
        <section class="main">
            <div class="inner">
                <div class="left-nav">
                    <div class="lft-nav-inner">
                        <div class="l-blk">
                            <?php 
                            //Load Left Menu
                            $this->widget("ext.widgets.admin_main_navigation_widget");
                            ?>
                        </div>
                    </div>
                </div>
                <div class="contentpanel">

                    <?php if(isset($this->breadcrumbs)):?>
                    <div class='pathway'>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'homeLink'=>CHtml::link(Yii::t('trans','Home'), array('/site/index')),
                            'links'=>$this->breadcrumbs,
                            'encodeLabel' => false,
                            'separator' => ''
                        )); ?>
                    </div><!-- breadcrumbs -->
                    <?php endif?>

                    <div class="container clearboth">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>            
        </section>
        <footer class="footer">
            <p class="t-c">Copy Right © <?php echo date('Y'); ?></p>
        </footer>
        <div id="cover"></div>
        <div id="popupMessage"></div>
        <script type="text/javascript">
            window.paceOptions = {
                startOnPageLoad:false,
                restartOnRequestAfter: 50000
            };
            var _urlDeleteMultiProducts   = '<?php echo Yii::app()->createUrl('product/DeleteMultiProducts'); ?>';
        </script>
        <script type="text/javascript" src="<?php echo $themeBaseURL; ?>/js/plugins.js?k=<?php echo $randomkey; ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/product.js?k=<?php echo $randomkey; ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/start.js?k=<?php echo $randomkey; ?>"></script>
    </body>
</html>