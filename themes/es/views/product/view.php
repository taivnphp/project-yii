<?php 
$maxQuantity=10;//Set Max Of Quantity
?>
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
                                $proPhotoURL = $uploadPath . $productPhotoInfo['prophotosImageURL'];
                                ?>
                                <li data-thumb="<?php echo $proPhotoURL; ?>">
                                	<div class="thumb-image"> <img src="<?php echo $proPhotoURL; ?>" data-imagezoom="true" class="img-responsive"> </div>                                    
                                </li>                                
                            <?php
                            }
                        }
                        echo '</ul>';
                    } else {
                        echo '<div class="item-photo-row">No Data</div>';
                    }
                    ?>										
					

					<div class="clearfix"></div>
				</div>	
			</div>
		</div>
		<div class="col-md-6 single-right-left simpleCart_shelfItem animated wow slideInRight animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInRight;">
					<h3><?php echo ($language == 'vi') ? $product->proName : $product->proNameE; ?></h3>
					<?php if(!empty($product->proPriceL)){ ?> 
					<p><span class="item_price"><?php echo $product->proPriceL ?>VNĐ</span> <del>- <?php echo $product->proPriceM ?>VNĐ</del></p> <!-- Product is sale off -->
					<?php } else { ?>
					<p><span class="item_price"><?php echo $product->proPriceM ?>VNĐ</span></p><!-- No sale off -->
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
							<h5><?php echo Yii::t('trans', 'Quantity');?> :</h5>
							<select id="productQuantity" class="frm-field required sect">
								<?php
								for ($i=1; $i <= $maxQuantity ; $i++) { 
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								?>														
							</select>
						</div>
					</div><br/>					
					<div class="occasion-cart">
						<a href="#" class="item_add hvr-outline-out button2"><?php echo Yii::t('trans', 'Add to cart');?></a>
					</div>
					
		</div>
				<div class="clearfix"> </div>

				<div class="bootstrap-tab animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
					<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo Yii::t('trans', 'Description');?></a></li>
							<li role="presentation"><a href="#previews" role="tab" id="previews-tab" data-toggle="tab" aria-controls="profile"><?php echo Yii::t('trans', 'Reviews');?></a></li>							
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
								<h5><?php echo ($language == 'vi') ? $product->proShortDescription : $product->proShortDescriptionE; ?></h5><!-- Shot Description -->
								<p><?php echo ($language == 'vi') ? $product->proFullContent : $product->proFullContentE; ?></p><!-- Full Description -->
							</div>
							<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="previews" aria-labelledby="previews-tab">
								<!-- Load Preview here -->
								<h2>Load Facebook comments here</h2>
							</div>							
						</div>
					</div>
				</div>
	</div>
</div>
<!-- FlexSlider -->
<script type="text/javascript">	
	$(window).load(function() {
		$('.flexslider').flexslider({
		animation: "slide",
		controlNav: "thumbnails"
		});
	});
</script>