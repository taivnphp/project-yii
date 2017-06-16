<?php 
$breadcrumbs = array();
$breadcrumbs['Manage Products'] = array('product/admin');    
if($product->proID){    
    $breadcrumbs[] = 'Update San pham';
}
else{    
    $breadcrumbs[] = 'Tao San pham Moi';
}
$this->breadcrumbs = $breadcrumbs;
?>
<div class="blk">
    <div class="blk-ct">    
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id'=>'product_form',
            'enableAjaxValidation'=>true,     
            'htmlOptions' => array(
                'enctype'=>"multipart/form-data"
            )       
        )); ?>
        
        <?php Yii::app()->helper->renderMessage(); ?>
        
        <?php echo $form->errorSummary($product); ?>
                
        <div class="row">
            <div class="col-12 blk-batch-left">
                <h3>Thông tin sản phẩm</h3>
				<div class="blk-create-batch">
					<div class="blk-batch clearfix">
					    <label>Ma sản phẩm</label>
					    <div class="b-right">					        
					        <?php echo $form->textField($product, 'proCode', array('class' => 'txt-name')); ?>
					    </div>
					</div>
					<div class="blk-batch clearfix">
					    <label>Tên sản phẩm</label>
					    <div class="b-right">					        
					        <?php echo $form->textField($product, 'proName', array('class' => 'txt-name', 'placeholder' => '...')); ?>
					    </div>
					</div>
					<div class="blk-batch clearfix">
					    <label>Tên sản phẩm (Tiếng Anh)</label>
					    <div class="b-right">					        
					        <?php echo $form->textField($product, 'proNameE', array('class' => 'txt-name', 'placeholder' => 'Batch Name')); ?>
					    </div>
					</div>
                    <div class="blk-batch clearfix">
                        <label>Gia goc</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($product, 'proPriceM', array('class' => 'txt-name', 'placeholder' => 'Batch Name')); ?>
                        </div>
                    </div>
                     <div class="blk-batch clearfix">
                        <label>Gia Khuyen Mai</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($product, 'proPriceL', array('class' => 'txt-name', 'placeholder' => 'Batch Name')); ?>
                        </div>
                    </div>
					<div class="blk-batch clearfix">
						<label>Danh mục</label>						
                        <?php echo $form->dropDownList($product, 'catID', CHtml::listData(Category::model()->findAll(), 'catID', 'catName') , array('prompt' => '...', 'class' => 'ipt', 'style' => 'width:200px'));?>
					</div>

                    <div class="blk-batch clearfix">
                        <label>Gioi thieu ngan</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($product, 'proShortDescription', array('class' => 'txt-name', 'placeholder' => 'Batch Name')); ?>
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>Gioi thieu ngan - English</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($product, 'proShortDescriptionE', array('class' => 'txt-name', 'placeholder' => 'Batch Name')); ?>
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>San Pham Moi</label>
                        <div class="b-right">                           
                            <input type="checkbox" name="Product[proNEW]" />                            
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>Gioi thieu ngan - English</label>
                        <div class="b-right">                           
                            <?php
                                $this->widget('application.extensions.xheditor.XHeditor',array(
                                    'model' => $product,
                                    'modelAttribute' => 'proFullContent',
                                    'language'=>'en', //options are en, zh-cn, zh-tw
                                    'config'=>array(
                                        'id'=>'xh_proFullContent',
                                        'name'=>'Product[proFullContent]',
                                        'tools'=>'full', // mini, simple, fill or from XHeditor::$_tools
                                        'width'=>'100%',  
                                        'height' => '500px',                         
                                        'upImgUrl' => $this->createUrl('default/upload'), // NB! Access restricted by IP
                                        'upImgExt' => 'jpg,jpeg,gif,png'
                                    ),                                
                                ));            
                            ?>
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>Gioi thieu ngan - English</label>
                        <div class="b-right">                           
                            <?php                            
                            $this->widget('application.extensions.xheditor.XHeditor',array(
                                'model' => $product,
                                'modelAttribute' => 'proFullContentE',
                                'language'=>'en', //options are en, zh-cn, zh-tw
                                'config'=>array(
                                    'id'=>'xh_proFullContentE',
                                    'name'=>'Product[proFullContentE]',
                                    'tools'=>'full', // mini, simple, fill or from XHeditor::$_tools
                                    'width'=>'100%',  
                                    'height' => '500px',                         
                                    'upImgUrl' => $this->createUrl('default/upload'), // NB! Access restricted by IP
                                    'upImgExt' => 'jpg,jpeg,gif,png'
                                ),                                
                            ));            
                            ?>
                        </div>
                    </div>
                                         
				</div>                                
            </div>            
        </div>
        <div class="row">
            <div class="col-12 blk-batch-left">
                <h3>HINH ANH SAN PHAM</h3>
                <div class="blk-create-batch">
                    <div class="blk-batch clearfix">
                        <label>Thumbnail</label>
                        <div class="b-right">
                            <?php
                            if(!empty($product->proThumbImageURL)){
                                $proThumbImageURL = $uploadPath . $product->proThumbImageURL;                                
                                echo '<img src="'.$proThumbImageURL . '" class="img_admin_thumb large" />';
                            }
                            ?>
                            <div class="item-photo-row"><input type="file" name="ProductThumbnail" accept="image/*"></div>
                        </div>
                    </div> 
                    <div class="blk-batch clearfix">
                        <label>Danh sach hinh anh</label>
                        <div class="b-right">
                        <?php 
                            
                            if(!empty($productPhotos)){
                                echo '<div class="productPhotoContainer">';
                                foreach($productPhotos as $productPhotoInfo){
                                    if(!empty($productPhotoInfo['prophotosImageURL'])){
                                        $proPhotoURL = $uploadPath . $productPhotoInfo['prophotosImageURL'];
                                        ?>
                                        <div class="item-photo-grid" data-id="<?php echo $productPhotoInfo['prophotosID'];?>">
                                            <a class="delete" title="Delete" onclick="product_fn.deletePhoto(this);"><i class="fa fa-trash-o"></i></a>
                                            <img src="<?php echo $proPhotoURL;?>" class="img_admin_thumb large" />
                                        </div>
                                <?php } 
                                }                                 
                                echo '</div>';
                            }
                            else{
                                echo '<div class="item-photo-row">';
                                echo '<input type="file" name="ProductPhotos[]" accept="image/*">';
                                echo '</div>';
                            }
                        ?>
                            <input type="hidden" name="ProductPhotoDeleted" id="hd_productPhotoDeleted"/>
                            <div class="item-photo-add-row">
                                <button type="button" class="btn btn-dblue" onclick="product_fn.addPhoto();"><i class="fa fa-plus"></i> Add Photo</button>
                            </div>                
                        </div>
                    </div> 
                </div>
            </div>
        </div>        
        <div class="row-buttons-fixed">
            <button type="submit" class="btn btn-dblue uppercase"><i class="fa fa-floppy-o"></i> SAVE</button>  
            <button type="button" class="btn uppercase" onclick="reloadForm();"><i class="fa fa-undo"></i> CANCEL</button>  
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>