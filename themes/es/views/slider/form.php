<?php
$breadcrumbs = array();
$breadcrumbs[Yii::t('trans', 'Manage Slide')] = array('slider/admin');
if ($slideShow->slideshowID) {
    $breadcrumbs[] = 'Sửa Slider';
} else {
    $breadcrumbs[] = 'Tạo Mới Slider';
}
$this->breadcrumbs = $breadcrumbs;
?>
<div class="blk">
    <div class="blk-ct">    
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'slideShow_form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array(
                'enctype' => "multipart/form-data"
            )
        ));
        ?>

        <?php Yii::app()->helper->renderMessage(); ?>

        <?php echo $form->errorSummary($slideShow); ?>

        <div class="row">
            <div class="col-12 blk-batch-left">
                <h3>Thông tin Danh Mục</h3>
                <div class="blk-create-batch">
                    <div class="blk-batch clearfix">
                        <label>Caption</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($slideShow, 'slideshowCaption', array('class' => 'txt-name')); ?>
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>Caption (English)</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($slideShow, 'slideshowCaptionE', array('class' => 'txt-name')); ?>
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>Slider URL</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($slideShow, 'slideshowURL', array('class' => 'txt-name')); ?>
                        </div>
                    </div>
                    <div class="blk-batch clearfix">
                        <label>Hinh anh</label>
                        <div class="b-right">
                            <?php
                            if (!empty($slideShow->slideshowImageURL)) {
                                $slideshowImageURL = $uploadPath . $slideShow->slideshowImageURL;
                                echo '<img src="' . $slideshowImageURL . '" class="img_admin_thumb large" />';
                            }
                            ?>
                            <div class="item-photo-row"><input type="file" name="slideShowImage" accept="image/*"></div>
                        </div>
                    </div> 
                    <div class="blk-batch clearfix">
                        <label>Vị trí hiển thị</label>
                        <div class="b-right">                           
                            <?php echo $form->textField($slideShow, 'slideshowSortID', array('class' => 'txt-name')); ?>
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