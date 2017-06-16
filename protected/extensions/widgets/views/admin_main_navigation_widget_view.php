<?php
$menuItems  = array();

// Products List
$menuItems[]=array(
    'label'=>'<i class="fa fa-database"> </i>Danh Mục Sản Phẩm',
    'url'=>array('category/admin'),
    'itemOptions' => array(
        'class' => 'left-tooltip',
        'title' => 'Danh Mục Sản Phẩm',
        'data-placement' => 'right',
        'data-toggle' => "tooltip"
    ),
);

// Products List
$menuItems[]=array(
    'label'=>'<i class="fa fa-database"> </i>Danh sách sản phẩm',
    'url'=>array('product/admin'),
    'itemOptions' => array(
        'class' => 'left-tooltip',
        'title' => 'Danh Sách Sản Phẩm',
        'data-placement' => 'right',
        'data-toggle' => "tooltip"
    ),
);

// LOG OUT
$menuItems[]=array(
    'label'=>'<i class="fa fa-power-off"> </i>Log Out',
    'url'=>array('admin/logout'),
    'itemOptions' => array(
        'class' => 'left-tooltip',
        'title' => 'Log out',
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