<?php 
$hotProducts = Product::model()->getHotProducts();
if(!empty($hotProducts)){
	foreach ($hotProducts as $hotProductModel) {
		echo $this->renderPartial('//product/product_item' , array(
			'productModel' => $hotProductModel,
			'uploadPath' => $uploadPath . '/product/',
			'language' => $language,
			'column' => 'col-md-3'
		));   
	}
}
$hotProducts = null;
?>