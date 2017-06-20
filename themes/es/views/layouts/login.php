<!DOCTYPE html>
<!--[if IE 8]><html lang="en" class="no-js ie ie8"><![endif]-->
<!--[if IE 9]><html lang="en" class="no-js ie ie9"><![endif]-->
<!--[if gt IE 9]><!-->
<?php
$randomkey    = Yii::app()->helper->generateRandomString();
?>
<html lang="en" class="no-js">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Test Application</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,300,600,800,400" rel="stylesheet" type="text/css">        
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/style.css">
    </head>
    <body class="landing blank">
        <header class="header">            
            <div class="header-bar t-c"><a href="javascript:;" class="alogo col-2"></a></div>
        </header>
        <section class="main">            
            <?php echo $content; ?>            
        </section>
        <script type="text/javascript">
            window.paceOptions = {    
                catchupTime : 1000,
                minTime: 1000,
                ghostTime: 1000,      
                elements: false,
                startOnPageLoad:false
            };
        </script>
        <!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/libs.js"></script>         -->
    </body>
</html>