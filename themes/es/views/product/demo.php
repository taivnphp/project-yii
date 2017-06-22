<h1>Demo Page - Random Product </h1>
<div class="container">
<?php
$view = '//product/product_item_col3';            
$template = '{summary}{items}{pager}';
$this->widget('application.components.EListView', array(
    'summaryText' => '{count} Exercises found   
            <div class="view-styles">                
                <a class="viewstyle gridview active" title="Grid View" ></a>
            </div>',
    'dataProvider' => $products->search(),
    'id' => 'exercises-list',
    'ajaxUpdate'=>true,          
    'template'=> $template,
    'itemView' => $view,
    'viewData' => array(
    	'uploadPath' => '/uploadFiles/product/',
    	'language' => 'vi'
	),
    'pager'=>array(
        'maxButtonCount'=>'8',
        'header'=>'',
        'firstPageLabel' => '&#60;&#60;', //<<
        'lastPageLabel' => '&#62;&#62;',// >>
        'prevPageLabel' => '&#60;',// <
        'nextPageLabel' => '&#62;',// >
    ),
    'enablePagination'=>true,    
));
?>
</div>