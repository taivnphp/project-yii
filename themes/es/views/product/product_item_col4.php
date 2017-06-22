<?php 
$proPhotoURL  = $uploadPath . $data->proID . '/' . $data->proThumbImageURL;
$productAlias = ($language == 'vi') ? Yii::app()->helper->getAliasURL($data->proName) : Yii::app()->helper->getAliasURL($data->proNameE);
$productLink  = Yii::app()->createUrl('/product/view'.$data->proID . '?' . $productAlias);
?>
<div class="col-md-4 product-men">
	<div class="men-pro-item simpleCart_shelfItem">
		<div class="men-thumb-item">
			<img src="<?php echo $proPhotoURL; ?>" alt="" class="pro-image-thumb pro-image-front">
			<img src="<?php echo $proPhotoURL; ?>" alt="" class="pro-image-thumb pro-image-back">
			<?php if($data->proNEW) {?><span class="product-new-top label-success"><?php echo Yii::t('trans', 'proNEW'); ?></span><?php } ?>
			<?php if($data->proHOT) {?><span class="product-hot-top"><?php echo Yii::t('trans', 'proHOT'); ?></span><?php } ?>
		</div>
		<div class="item-info-product ">
			<h4><a href="<?php echo $productLink;  ?>"><?php echo ($language == 'vi') ? $data->proName : $data->proNameE; ?></a></h4>
			<div class="info-product-price">
				<?php if (!empty($data->proPriceL)) { ?> 
					<span class="item_price"><?php echo number_format($data->proPriceL) . 'VNĐ'; ?></span>
					<del><?php echo number_format($data->proPriceM) . 'VNĐ'; ?></del>
				<?php } else { ?>
					<span class="item_price"><?php echo number_format($data->proPriceM) . 'VNĐ'; ?></span>
				<?php } ?>				
			</div>
			<a href="#" class="single-item hvr-outline-out button2" data-product-id=<?php echo $data->proID; ?>><?php echo Yii::t('trans', 'Add to cart'); ?></a>
		</div>
	</div>
</div>