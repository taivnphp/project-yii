<?php
$this->breadcrumbs = array(Yii::t('trans', 'Sliders'));
?>
<div class="blk">
    <div class="blk-ct">
        <div class="row">
            <div class="col-12">                

                <form id="admin_product_form">
                    <?php
                    $button_template = '<ul class="nav list-operations"><li>{update}</li><li>{delete}</li><li></li></ul>';                    
                    $template = '<div class="cp-toolbar">
                        <h3>{summary}</h3>
                        <ul class="nav">
                            <li><a title="Create New Slider" href="' . Yii::app()->createUrl('slider/create') . '" class="bl-plus"><i class="fa fa-plus"></i></a></li>                            
                        </ul>
                    </div><div class="tbl-data"><div class="blk-tbl">{items}</div></div><div class="paging-blk"><div class="f-r">{pager}</div></div>';
                    
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id'            => 'product-admin-grid',
                        'itemsCssClass' => 'tbl',
                        'loadingCssClass' => 'blk tbl-data',
                        'dataProvider' => $model->search(),
                        'template'     => $template,
                        'summaryText'  => '{count} danh muc',
                        'ajaxUpdate'    =>true,
                        'columns'      => array(                           
                            array(                
                                'header' => 'Thumbnail',
                                'type' => 'raw',
                                'value' => function ($data) use ($uploadPath){
                                    if(!empty($data['slideshowImageURL'])){
                                        $sliderThumbImg = $uploadPath . $data['slideshowImageURL'];                                        
                                        return '<img src="'.$sliderThumbImg . '" class="img_admin_thumb" />';        
                                    }
                                    return '';
                                }                                
                            ), 
                            array(                
                                'header' => 'Caption',
                                'name' => 'slideshowCaption',
                            ),   
                             array(                
                                'header' => 'Caption (English)',
                                'name' => 'slideshowCaptionE',
                            ),           
                            array(
                                'class'    => 'CButtonColumn',
                                'header'   => 'Thao Tác',
                                'template' => $button_template,
                                'deleteConfirmation'=> 'Bạn có chắc muốn xóa mục này?',
                                'buttons'  => array(                                                   
                                    'update' => array(
                                        'label'    => '<i class="fa fa-pencil"></i>',
                                        'url'      => 'Yii::app()->createUrl("slider/update", array("id" => $data->slideshowID))',
                                        'imageUrl' => false,
                                        'options' => array(                         
                                            'title' => 'Edit'                            
                                        ),
                                    ),
                                    'delete' => array(                        
                                        'label' => '<i class="fa fa-trash-o"></i>',
                                        'imageUrl' => false,                                                
                                        'options' => array(                         
                                            'title' => 'Delete'                            
                                        ),
                                    ),                    
                                ),
                                'headerHtmlOptions' => array(
                                    'width' => '200px',
                                ),
                                'htmlOptions' => array(
                                    'width' => '200px',
                                )
                            ),             
                        ),
                        'pagerCssClass' => 'pagination clearfix',
                        'pager'=> Yii::app()->helper->getPagingCustom(),
                        'enablePagination'=>true
                    ));
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>