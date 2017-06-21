<?php
$this->breadcrumbs = array(Yii::t('trans', 'Manage Category'));
?>
<div class="blk">
    <div class="blk-ct">
        <div class="row">
            <div class="col-12">
                <div class="filter-dashboard-wrap filter-batch-jobs">
                    <form action="<?php echo $adminUrl; ?>" method="get">
                        <div class="row">
                            <div class="col-6">
                                <span>Nhập ten danh muc:</span>
                                <input type="text" placeholder="Từ khóa" class="txt-keyword s-keyword-ipt" name="k" value="<?php echo $keyword; ?>">
                            </div>                            
                            <div class="col-4">
                                <button type="submit" class="btn btn-dblue uppercase   filter-batch">submit</button>
                                <button type="button" class="btn-cancel btn uppercase" onclick="window.location='<?php echo $adminUrl; ?>'">clear</button>                                
                            </div>                            
                        </div>
                    </form>
                </div>

                <form id="admin_product_form">
                    <?php
                    $button_template = '<ul class="nav list-operations"><li>{update}</li><li>{delete}</li><li></li></ul>';                    
                    $template = '<div class="cp-toolbar">
                        <h3>{summary}</h3>
                        <ul class="nav">
                            <li><a title="Create New Category" href="' . Yii::app()->createUrl('category/create') . '" class="bl-plus"><i class="fa fa-plus"></i></a></li>                            
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
                                    if(!empty($data['catImageURL'])){
                                        $catThumbImageURL = $uploadPath . $data['catID'] .'/'. $data['catImageURL'];
                                        return '<img src="'.$catThumbImageURL . '" class="img_admin_thumb" />';        
                                    }
                                    return '';
                                }                                
                            ), 
                            array(                
                                'header' => 'Tên danh mục',
                                'name' => 'catName',
                            ),   
                             array(                
                                'header' => 'Tên danh mục (English)',
                                'name' => 'catNameE',
                            ),           
                            array(
                                'class'    => 'CButtonColumn',
                                'header'   => 'Thao Tác',
                                'template' => $button_template,
                                'deleteConfirmation'=> 'Bạn có chắc muốn xóa danh mục này?',
                                'buttons'  => array(                                                   
                                    'update' => array(
                                        'label'    => '<i class="fa fa-pencil"></i>',
                                        'url'      => 'Yii::app()->createUrl("category/update", array("id" => $data->catID))',
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