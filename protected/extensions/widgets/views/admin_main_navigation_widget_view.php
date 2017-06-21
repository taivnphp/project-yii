<?php
$menuItems  = array();

// Products List

$menuItems[]=array(
    'label'=>'<i class="fa fa-database"> </i>' . Yii::t('trans', 'Sliders'),
    'url'=>array('slider/admin'),
    'itemOptions' => array(
        'class' => 'left-tooltip',
        'title' => Yii::t('trans', 'Manage Slider'),
        'data-placement' => 'right',
        'data-toggle' => "tooltip"
    ),
);

$menuItems[]=array(
    'label'=>'<i class="fa fa-database"> </i>' . Yii::t('trans', 'Manage Category'),
    'url'=>array('category/admin'),
    'itemOptions' => array(
        'class' => 'left-tooltip',
        'title' => Yii::t('trans', 'Manage Category'),
        'data-placement' => 'right',
        'data-toggle' => "tooltip"
    ),
);

// Products List
$menuItems[]=array(
    'label'=>'<i class="fa fa-database"> </i>' . Yii::t('trans', 'Manage Product'),
    'url'=>array('product/admin'),
    'itemOptions' => array(
        'class' => 'left-tooltip',
        'title' => Yii::t('trans', 'Manage Product'),
        'data-placement' => 'right',
        'data-toggle' => "tooltip"
    ),
);

// LOG OUT
$menuItems[]=array(
    'label'=>'<i class="fa fa-power-off"> </i>' . Yii::t('trans', 'Log_Out'),
    'url'=>array('admin/logout'),
    'itemOptions' => array(
        'class' => 'left-tooltip',
        'title' => Yii::t('trans', 'Log_Out'),
        'data-placement' => 'right',
        'data-toggle' => "tooltip"
    ),
);

$this->widget('zii.widgets.CMenu', array(
    'encodeLabel'=>false,
    'items'=>$menuItems,
    'htmlOptions' => array('class' => 'sidebar-nav uppercase')
));
?>