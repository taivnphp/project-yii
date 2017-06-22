<?php 
$proPhotoURL = $uploadPath . $productModel->proID . '/' . $productModel->proThumbImageURL;
$productAlias = ($language == 'vi') ? Yii::app()->helper->getAliasURL($productModel->proName) : Yii::app()->helper->getAliasURL($productModel->proNameE);
$productLink = Yii::app()->createUrl('/product/'.$productModel->proID . '?' . $productAlias);
if(empty($column)) $column = 'col-md-3';
?>
<div class="<?php echo $column ?> product-men">
	<div class="men-pro-item simpleCart_shelfItem">
		<div class="men-thumb-item">
			<img src="<?php echo $proPhotoURL; ?>" alt="" class="pro-image-thumb pro-image-front">
			<img src="<?php echo $proPhotoURL; ?>" alt="" class="pro-image-thumb pro-image-back">
			<?php if($productModel->proNEW) {?><span class="product-new-top label-success"><?php echo Yii::t('trans', 'proNEW'); ?></span><?php } ?>
			<?php if($productModel->proHOT) {?><span class="product-hot-top"><?php echo Yii::t('trans', 'proHOT'); ?></span><?php } ?>
		</div>
		<div class="item-info-product ">
			<h4><a href="<?php echo $productLink;  ?>"><?php echo ($language == 'vi') ? $productModel->proName : $productModel->proNameE; ?></a></h4>
			<div class="info-product-price">
				<?php if (!empty($productModel->proPriceL)) { ?> 
					<span class="item_price"><?php echo number_format($productModel->proPriceL) . 'VNĐ'; ?></span>
					<del><?php echo number_format($productModel->proPriceM) . 'VNĐ'; ?></del>
				<?php } else { ?>
					<span class="item_price"><?php echo number_format($productModel->proPriceM) . 'VNĐ'; ?></span>
				<?php } ?>				
			</div>
			<a href="#" class="single-item hvr-outline-out button2" data-product-id=<?php echo $productModel->proID; ?>><?php echo Yii::t('trans', 'Add to cart'); ?></a>
		</div>
	</div>
</div>