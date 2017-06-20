<?php
$manageProductLabel = Yii::t('trans', 'Manage Product');
$this->breadcrumbs = array(Yii::t('trans', 'Manage Product'));
?>
<div class="blk">
    <div class="blk-ct">
        <div class="row">
            <div class="col-12">
                <div class="filter-dashboard-wrap filter-batch-jobs">
                    <form action="<?php echo $adminUrl; ?>" method="get">
                        <div class="row">
                            <div class="col-6">
                                <span>Nhập mã sản phẩm hoặc tên sản phẩm:</span>
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
                    $button_template = '<ul class="nav list-operations"><li>{view}</li><li>{update}</li><li>{delete}</li><li></li></ul>';                    
                    $template = '<div class="cp-toolbar">
                        <h3>{summary}</h3>
                        <ul class="nav">
                            <li><a title="Create New Product" href="' . Yii::app()->createUrl('product/create') . '" class="bl-plus"><i class="fa fa-plus"></i></a></li>
                            <li><a href="javascript:;" onclick="product_fn.deleteProducts()" data-toggle="tooltip" data-placement="top" title="Delete Products" class="ctr-save left-tooltip"><i class="fa fa-trash-o"></i></a></li>
                        </ul>
                    </div><div class="tbl-data"><div class="blk-tbl">{items}</div></div><div class="paging-blk"><div class="f-r">{pager}</div></div>';
                    
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id'            => 'product-admin-grid',
                        'itemsCssClass' => 'tbl',
                        'loadingCssClass' => 'blk tbl-data',
                        'dataProvider' => $model->search(),
                        'template'     => $template,
                        'summaryText'  => '{count} sản phẩm',
                        'ajaxUpdate'    =>true,
                        'columns'      => array(   
                            array(
                                'header'            => '<input type="checkbox" onclick="product_fn.checkAllProduct(this.checked);"/>',
                                'headerHtmlOptions' => array(
                                    'style' => 'width:100px;'
                                ),
                                'type'  => 'raw',
                                'value' => 'CHtml::checkbox("ProductDelete[]", "", array("value" => $data["proID"], "class" => "cb_pro_checkbox"))'
                            ),   
                            array(                
                                'header' => 'Mã sản phẩm',
                                'name' => 'proCode',
                            ),
                            array(                
                                'header' => 'Thumbnail',
                                'type' => 'raw',
                                'value' => function ($data) use ($uploadPath){
                                    if(!empty($data['proThumbImageURL'])){
                                        $proThumbImageURL = $uploadPath . $data['proID'] .'/'. $data['proThumbImageURL'];
                                        return '<img src="'.$proThumbImageURL . '" class="img_admin_thumb" />';        
                                    }
                                    return '';                                    
                                }                                
                            ),             
                            array(
                                'header' => 'Danh mục',       
                                'name' => 'catID',                         
                                'value' => function ($data) {
                                    return Category::model()->getCategoryNameByID($data['catID']);
                                }                                
                            ),    
                            array(
                                'header' => 'Tên sản phẩm',
                                'name' => 'proName'
                            ),                    
                            array(
                                'header' => 'Tên sản phẩm (Tiếng Anh)',
                                'name' => 'proNameE'
                            ),
                            array(
                                'header' => 'Giá Gốc',
                                'name' => 'proPriceM'
                            ),
                            array(
                                'header' => 'Giá Khuyến Mãi',
                                'name' => 'proPriceL'
                            ),                            
                            array(
                                'class'    => 'CButtonColumn',
                                'header'   => 'Thao Tác',
                                'template' => $button_template,
                                'deleteConfirmation'=> 'Warning! Removing this product would affect measures, do you want to continue?',
                                'buttons'  => array(             
                                    'view' => array(
                                        'label'    => '<i class="fa fa-eye"></i>',
                                        'url'      => 'Product::buildProductViewLink("$data->proID", "$data->proName")',
                                        'imageUrl' => false,
                                        'options' => array(                         
                                            'title' => 'Edit'                            
                                        ),
                                    ),       
                                    'update' => array(
                                        'label'    => '<i class="fa fa-pencil"></i>',
                                        'url'      => 'Yii::app()->createUrl("product/update", array("id" => $data->proID))',
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