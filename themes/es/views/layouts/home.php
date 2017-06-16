<!DOCTYPE html>
<!--[if IE 8]><html lang="en" class="no-js ie ie8"><![endif]-->
<!--[if IE 9]><html lang="en" class="no-js ie ie9"><![endif]-->
<!--[if gt IE 9]><!-->
<?php
$randomkey    = Yii::app()->helper->generateRandomString();
$controllerID = Yii::app()->controller->id;
$actionID     = Yii::app()->controller->action->id;
$themeBaseURL = Yii::app()->theme->baseUrl;
?>
<html lang="en" class="no-js html-landing">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo SiteConfig::model()->getConfig('applicationTitle'); ?></title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,300,600,800,400" rel="stylesheet" type="text/css">
        <link rel='shortcut icon' href='<?php echo Yii::app()->helper->getApplicationIcon(); ?>?k=<?php echo $randomkey; ?>' type="image/x-icon"/>
        <link rel="stylesheet"    href="<?php echo $themeBaseURL; ?>/css/style.css?k=<?php echo $randomkey; ?>">
        <link rel="stylesheet"    href="<?php echo $themeBaseURL; ?>/css/style_v2.css?k=<?php echo $randomkey; ?>">
        <link rel="stylesheet"    href="<?php echo Yii::app()->theme->baseUrl; ?>/css/override.css?k=<?php echo $randomkey; ?>">
    </head>
    <body class="landing">        
        <header class="header"> 
            <div class="header-bar no-shadow">
                <div class="mm-menu"><a class="call-main-menu" href="javascript:;"> <i class="fa fa-bars"></i></a></div>
                <div class="header-top-bar">
                    <div class="row-clearfix"><a class="alogo" href="javascript:;"><?php echo Yii::app()->helper->getApplicationLogo(); ?></a></div>
                </div>
            </div>
            <div class="sub-wrap">
                <ul class="landing-sub">
                    <li><a target="_blank" href="javascript:;">Agility</a></li>
                    <li><a target="_blank" href="javascript:;">Freedom</a></li>
                    <li><a target="_blank" href="javascript:;">Visibility</a></li>
                </ul>
            </div>
        </header>
        <section class="main">
            <?php echo $content; ?>            
        </section>
        <footer class="footer">
            <p class="t-c">
                <?php echo str_replace(':current-year', date('Y'), SiteConfig::model()->getConfig('applicationFooter'));?>
            </p>
        </footer>        
        <script type="text/javascript">
            window.paceOptions = {    
                catchupTime : 1000,
                minTime: 1000,
                ghostTime: 1000,      
                elements: false,
                startOnPageLoad:false
            };
            var _controllerID = '<?php echo $controllerID ?>';
            var _actionID     = '<?php echo $actionID ?>';
            var batchAutoReload='<?php echo Yii::app()->session['batch_auto_reload']; ?>';
            var _urlCreateNewMeasure = '<?php echo Yii::app()->createUrl('measure/create');?>';
        </script>                
    </body>
</html>