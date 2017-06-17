<div class="top_nav_left">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav menu__list">
            <li class="active menu__item <?php if($controllerId=='site' && $actionId=='index'){echo 'menu__item--current';} ?> "><a class="menu__link" href="<?php echo Yii::app()->getBaseUrl(true); ?>"><?php echo Yii::t('trans', 'Home'); ?></a></li>
            <li class="active menu__item "><a class="menu__link" href="<?php echo Yii::app()->createUrl('site/about'); ?>"><?php echo Yii::t('trans', 'About_Us'); ?></a></li>
            <li class="dropdown menu__item">
                <a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo Yii::t('trans', 'Product'); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu multi-column columns-3">
                    <div class="row">                        
                        <div class="col-sm-12 multi-gd-img">
                            <?php if(!empty($listCategories)){?>
                            <ul class="multi-column-dropdown">
                                <?php foreach ($listCategories as $catInfo) { 
                                    $catLink = Yii::app()->createUrl('category/'). '/' . $catInfo['id'] . '?' . $catInfo['alias']; 
                                ?>
                                <li><a href="<?php echo $catLink; ?>"><?php echo $catInfo['name']; ?></a></li>    
                                <?php } ?>                                
                            </ul>
                            <?php } //endif ?>
                        </div>                        
                        <div class="clearfix"></div>
                    </div>
                </ul>
            </li>
            <li class=" menu__item <?php if($controllerId=='site' && $actionId=='question'){echo 'menu__item--current';} ?>"><a class="menu__link" href="<?php echo Yii::app()->createUrl('site/question'); ?>"><?php echo Yii::t('trans', 'Question'); ?></a></li>
            <li class=" menu__item "><a class="menu__link" href="<?php echo Yii::app()->createUrl('site/contact'); ?>"><?php echo Yii::t('trans', 'Contact'); ?></a></li>
            <?php if($controllerId=='site' && $actionId=='error'){ ?>
            <li class=" menu__item menu__item--current"><a class="menu__link" href="javascript:;"><?php echo Yii::t('trans', 'Error'); ?></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>  
</div>
<div class="top_nav_right">    
    <div class="cart box_1">
        <a href="checkout.html">
            <h3> <div class="total">
                <i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
                <span class="simpleCart_total">$0.00</span> (<span id="simpleCart_quantity" class="simpleCart_quantity">0</span> items)</div>
                
            </h3>
        </a>
        <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>                
    </div>  
</div>
<div class="clearfix"></div>