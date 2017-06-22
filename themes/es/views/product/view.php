<?php
$maxQuantity = 10; //Set Max Of Quantity
$breadcrumbs = array();
$breadcrumbs[] = ($language == 'vi') ? $product->proName : $product->proNameE;
$this->breadcrumbs = $breadcrumbs;
?>
<style type="text/css">
    .related_products{
        margin-top: 20px
    }
    .related_products h1{
        padding: 10px 0px;
    }
</style>
<div class="single">
    <div class="container">
        <div class="col-md-6 single-right-left animated wow slideInUp animated" data-wow-delay=".5s">
            <div class="grid images_3_of_2">
                <div class="flexslider">
                    <?php
                    if (!empty($productPhotos)) {
                        echo '<ul class="slides">';
                        foreach ($productPhotos as $productPhotoInfo) {
                            if (!empty($productPhotoInfo['prophotosImageURL'])) {
                                $proPhotoURL = $uploadPath . $product->proID . '/' . $productPhotoInfo['prophotosImageURL'];
                                ?>
                                <li data-thumb="<?php echo $proPhotoURL; ?>">
                                    <div class="thumb-image"> <img src="<?php echo $proPhotoURL; ?>" data-imagezoom="true" class="img-responsive"> </div>                                    
                                </li>                                
                                <?php
                            }
                        }
                        echo '</ul>';
                    } else {
                    	//Load Product ThumbNail
                    	$productThumbNail = $uploadPath . $product->proID . '/' . $product->proThumbImageURL;
                    	if($productThumbNail){ ?>
                    		<ul class="slides">
                    			<li data-thumb="<?php echo $productThumbNail; ?>">
                                    <div class="thumb-image"> <img src="<?php echo $productThumbNail; ?>" data-imagezoom="true" class="img-responsive"></div>                                    
                                </li>
                    		</ul>
                    	<?php } else echo '<div class="item-photo-row">Prodcut Phto Not Found</div>';
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>	
            </div>
        </div>
        <div class="col-md-6 single-right-left simpleCart_shelfItem animated wow slideInRight animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInRight;">
            <h3><?php echo ($language == 'vi') ? $product->proName : $product->proNameE; ?></h3>
            <?php if (!empty($product->proPriceL)) { ?> 
                <p><span class="item_price"><?php echo number_format($product->proPriceL) . 'VNĐ'; ?></span> <del><?php echo number_format($product->proPriceM) . 'VNĐ'; ?></del></p> <!-- Product is sale off -->
            <?php } else { ?>
                <p><span class="item_price"><?php echo number_format($product->proPriceM) . 'VNĐ'; ?></span></p><!-- No sale off -->
            <?php } ?>

            <div class="rating1">
                <span class="starRating">
                    <input id="rating5" type="radio" name="rating" value="5">
                    <label for="rating5">5</label>
                    <input id="rating4" type="radio" name="rating" value="4">
                    <label for="rating4">4</label>
                    <input id="rating3" type="radio" name="rating" value="3" checked="">
                    <label for="rating3">3</label>
                    <input id="rating2" type="radio" name="rating" value="2">
                    <label for="rating2">2</label>
                    <input id="rating1" type="radio" name="rating" value="1">
                    <label for="rating1">1</label>
                </span>						
            </div><br/>					
            <div class="color-quality">
                <div class="color-quality-right">
                    <h5><?php echo Yii::t('trans', 'Quantity'); ?> :</h5>
                    <select id="productQuantity" class="frm-field required sect">
                        <?php
                        for ($i = 1; $i <= $maxQuantity; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>														
                    </select>
                </div>
            </div><br/>					
            <div class="occasion-cart">
                <a href="#" class="item_add hvr-outline-out button2" data-product-id="<?php echo $product->proID; ?>"><?php echo Yii::t('trans', 'Add to cart'); ?></a>
            </div>
        </div>
        
        <div class="clearfix"> </div>

        <div class="bootstrap-tab animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo Yii::t('trans', 'Description'); ?></a></li>
                    <li role="presentation"><a href="#previews" role="tab" id="previews-tab" data-toggle="tab" aria-controls="profile"><?php echo Yii::t('trans', 'Reviews'); ?></a></li>							
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
                        <h5><?php echo ($language == 'vi') ? $product->proShortDescription : $product->proShortDescriptionE; ?></h5><!-- Shot Description -->
                        <p><?php echo ($language == 'vi') ? $product->proFullContent : $product->proFullContentE; ?></p><!-- Full Description -->
                    </div>
                    <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="previews" aria-labelledby="previews-tab">
                        <!-- Load Preview here -->
                        <p>Load Facebook comments here...</p>
                    </div>							
                </div>
            </div>
        </div>                
    </div>
    
    <!-- Relational Products -->
    <div class="container">
        <div class="related_products">        	
            <h1><?php echo Yii::t('trans', 'Related_Products'); ?></h1>
            <?php
            $relatedProducts = Product::model()->getRelatedProducts($product->catID, $product->proID);
            if(!empty($relatedProducts)){ 
            	foreach ($relatedProducts as $productModel) {            		
            		$this->renderPartial('product_item' , array(
            			'productModel' => $productModel,
            			'uploadPath' => $uploadPath,
            			'language' => $language,
            			'column' => 'col-md-3'
        			));
            	}
            	$relatedProducts = NULL;
        	?>           
            <?php }		
            else{
            	echo '<p><br/>'. Yii::t('trans', 'Product_not_found') .'</p>';
            }          
            ?>
        </div>
    </div>
</div>
<!-- FlexSlider -->
<script type="text/javascript">
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });
</script>