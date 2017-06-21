<?php 
$themeBaseURL = Yii::app()->theme->baseUrl.'/website/';
$mainSlideItems = '';
$smallSlitemItems = '';
foreach ($slideShows as $key => $slideInfo) {
	$slideImgUrl = $uploadPath . 'slider/' . $slideInfo['slideshowImageURL'];
	$mainSlideItems.= '<li><img class="img-responsive" src="'. $slideImgUrl .'" alt="'. $slideInfo['slideshowCaption'] .'" /></li>';
	$smallSlitemItems.= '<li><div class="inner-script"><img class="img-responsive" src="'. $slideImgUrl .'" alt="'. $slideInfo['slideshowCaption'] .'" /></div></li>';
}
Yii::app()->language='vi';
?>
<style type="text/css">	
	.pignose-layerslider .slide-visual .script-wrap.script-wrap-home{		
		bottom: 0px;
		right: 50%;		
		margin-right: -138px;
		top: auto;
	}
	.script-wrap-home .slide-controller a{font-size: 24px;color: #FDA30E}
	#home_product_list #horizontalTab{
		display: none;width: 100%;margin: 0px;
	}
	@media (max-width: 1080px){
		.pignose-layerslider .slide-visual .script-wrap .slide-controller a{
			font-size: 18px;
			margin: 0 15px;
		}
	}
</style>

<!-- HOME SLIDER -->
<?php if(!empty($slideShows)): ?>
<div class="banner-grid">
	<div id="visual">
		<div class="slide-visual">
			<!-- Slide Image Area (1000 x 424) -->				
			<ul class="slide-group">
				<?php echo $mainSlideItems; ?>
			</ul>
			<!-- Slide Description Image Area (316 x 328) -->
			<div class="script-wrap script-wrap-home">					
				<div class="slide-controller">
					<a href="#" class="btn-prev" title="Prev"><span class="glyphicon glyphicon-backward"></span></a>
					<a href="#" class="btn-play" title="Start Slide"><span class="glyphicon glyphicon-play"></span></a>
					<a href="#" class="btn-pause" title="Stop Slide"><span class="glyphicon glyphicon-pause"></span></a>
					<a href="#" class="btn-next" title="Next"><span class="glyphicon glyphicon-forward"></span></a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<?php endif; ?>


<div class="product-easy" id="home_product_list">
	<div class="container">
		<div class="sap_tabs">
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span><?php echo Yii::t('trans', 'Latest_Products'); ?></span></li> 
					<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span><?php echo Yii::t('trans', 'Special_Offers'); ?></span></li> 					
				</ul>				  	 
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0" id="home-new-products">
						<!--ajax load new product-->
					</div>
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1" id="home-hot-products">
						<!--ajax load hot product-->
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>

<script type="text/javascript" src="<?php echo $themeBaseURL?>js/easyResponsiveTabs.js"></script>
<script type="text/javascript" src="<?php echo $themeBaseURL?>js/pignose.layerslider.js"></script>
<script type="text/javascript">
	//<![CDATA[	
	var urlAjaxLoadProduct = '<?php echo Yii::app()->createAbsoluteUrl('product/AjaxLoadProduct') ?>';
	
	function LoadProducts($containerId, $productType){
		$.ajax({
	        type: "POST",
	        url: urlAjaxLoadProduct,
	        dataType : 'html',
	        data: {
	        	'type' : $productType
	        },
	        success: function($response){		        			        
				$('#' + $containerId).html($response);
	        },
	        error:function(){
	        	return;
	        }
	    });
		return;
	}

	$(window).load(function() {		
		$('#visual').pignoseLayerSlider({
			play    : '.btn-play',
			pause   : '.btn-pause',
			next    : '.btn-next',
			prev    : '.btn-prev'
		});

		$('#horizontalTab').easyResponsiveTabs({
			type: 'default', //Types: default, vertical, accordion           
			width: 'auto', //auto or any width like 600px
			fit: true   // 100% fit in a container
		});

		//Load New Products
		LoadProducts('home-new-products', 'new');

		//Load Hot Products
		LoadProducts('home-hot-products', 'hot');		

	});
//]]>
</script>