<?php 	
	if(!empty($newProducts)){
		foreach ($newProducts as $newProductModel) {
			echo $this->renderPartial('//product/product_item' , array(
				'productModel' => $newProductModel,
				'uploadPath' => $uploadPath . '/product/',
				'language' => $language,
				'column' => 'col-md-3'
			));   
		}
	}
	$newProducts = null;
?>
<div class="clear-fix"></div>