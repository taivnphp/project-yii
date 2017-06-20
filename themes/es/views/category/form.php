<?php
$breadcrumbs = array();
$breadcrumbs[Yii::t('trans', 'Manage Category')] = array('category/admin');
if ($category->catID) {
    $breadcrumbs[] = 'Sửa Danh Mục';
} else {
    $breadcrumbs[] = 'Tạo Mới Danh Mục';
}
$this->breadcrumbs = $breadcrumbs;
?>
<div class="blk">
    <div class="blk-ct">    
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'category_form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array(
                'enctype' => "multipart/form-data"
            )
        ));
        ?>

        <?php Yii::app()->helper->renderMessage(); ?>

        <?php echo $form->errorSummary($category); ?>

        <div class="row">
            <div class="col-12 blk-batch-left">
                <h3>Thông tin Danh Mục</h3>
                <div class="blk-create-batch">
                    <div class="blk-batch clearfix">
                        <label>Tên danh mục</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($category, 'catName', array('class' => 'txt-name')); ?>
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>Tên danh mục (English)</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($category, 'catNameE', array('class' => 'txt-name')); ?>
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>Thumbnail</label>
                        <div class="b-right">
                            <?php
                            if (!empty($category->catImageURL)) {
                                $catThumbImageURL = $uploadPath . $category->catImageURL;
                                echo '<img src="' . $catThumbImageURL . '" class="img_admin_thumb large" />';
                            }
                            ?>
                            <div class="item-photo-row"><input type="file" name="CategoryThumbnail" accept="image/*"></div>
                        </div>
                    </div> 
                    <div class="blk-batch clearfix">
                        <label>Vị trí hiển thị</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($category, 'catSortID', array('class' => 'txt-name')); ?>
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>Mô Tả</label>
                        <div class="b-right">                           
                            <?php
                            $this->widget('application.extensions.xheditor.XHeditor', array(
                                'model' => $category,
                                'modelAttribute' => 'catDescription',
                                'language' => 'en', //options are en, zh-cn, zh-tw
                                'config' => array(
                                    'id' => 'xh_catDescription',
                                    'name' => 'Category[catDescription]',
                                    'tools' => 'full', // mini, simple, fill or from XHeditor::$_tools
                                    'width' => '100%',
                                    'height' => '500px',
                                    'upImgUrl' => $this->createUrl('default/upload'), // NB! Access restricted by IP
                                    'upImgExt' => 'jpg,jpeg,gif,png'
                                ),
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>Mô Tả (English)</label>
                        <div class="b-right">                           
                            <?php
                            $this->widget('application.extensions.xheditor.XHeditor', array(
                                'model' => $category,
                                'modelAttribute' => 'catDescriptionE',
                                'language' => 'en', //options are en, zh-cn, zh-tw
                                'config' => array(
                                    'id' => 'xh_catDescriptionE',
                                    'name' => 'Category[catDescriptionE]',
                                    'tools' => 'full', // mini, simple, fill or from XHeditor::$_tools
                                    'width' => '100%',
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

        <div class="row-buttons-fixed">
            <button type="submit" class="btn btn-dblue uppercase"><i class="fa fa-floppy-o"></i> SAVE</button>  
            <button type="button" class="btn uppercase" onclick="reloadForm();"><i class="fa fa-undo"></i> CANCEL</button>  
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>