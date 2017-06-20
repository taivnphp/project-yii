<?php
$breadcrumbs = array();
$breadcrumbs[] = ($language == 'vi') ? $category->catName : $category->catNameE;
$this->breadcrumbs = $breadcrumbs;
$currentCatLink='';
?>
<style type="text/css">
	.category-list-products{
		margin-top: 20px
	}
	.category-list-products h1{
		padding: 10px 0px;
	}
	.form-search{		
		padding: 10px;		
	}
	.form-search input[type="text"]{		
		outline: none;    
	    padding: 6px 10px;
	    color: #848484;
	    font-size: 16px;
	    border: 1px solid #dadada;
		width: 75%;
		border-radius: 0px;
	}	
</style>

<div class="men-wear">
	<div class="container">
		<div class="col-md-4 products-left">
			
			<div class="css-treeview">
				<h4><?php echo Yii::t('trans', 'Categories'); ?></h4>
				<ul class="tree-list-pad">
					<?php if(!empty($listCategories)){
						foreach ($listCategories as $catInfo) { 
	                        $catLink = Yii::app()->createAbsoluteUrl('category/view'). '/' . $catInfo['id'] . '?' . $catInfo['alias'];
	                        if($catInfo['id'] == $category->catID) {
	                        	$class = 'active cat-menu-link';
	                        	$currentCatLink = $catLink;
	                        }
	                        else{
	                        	$class = 'cat-menu-link';
	                        }	                        	                       
	                    ?>
	                        <li class="<?php echo $class; ?>" data-href="<?php echo $catLink; ?>"><input type="checkbox"  id="item-0"><label for="item-0"><span></span><?php echo $catInfo['name']; ?></label></li>
	                    <?php } 
					} ?>
				</ul>
			</div>	

			<div class="community-poll">
				<h4><?php echo Yii::t('trans', 'Search'); ?></h4>
				<div class="swit form form-search">	
					<form method="get" action="<?php echo $currentCatLink; ?>">
						<input type="text" class="ipt-search" value="<?php echo $keyword ?>" name="k" >
						<input type="submit" value="<?php echo Yii::t('trans', 'Search_Button'); ?>">
					</form>	
				</div>
			</div>
			
			<div class="clearfix"> </div>
		</div>
		<div class="col-md-8 products-right">			
			<div class="category-introduce">
				<?php $catThumbnailURL = '/uploadFiles/category/' . $category->catID . '/' . $category->catImageURL;?>				
				<div class="col-sm-4 men-wear-left">											
					<img class="img-responsive" src="<?php echo $catThumbnailURL; ?>" alt=" ">
				</div>				
				<div class="col-sm-8 men-wear-right">
					<h4><?php echo ($language == 'vi') ? $category->catName : $category->catNameE; ?></h4>
					<p><?php echo ($language == 'vi') ? $category->catDescription : $category->catDescriptionE; ?></p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="category-list-products">
				<h1><?php echo Yii::t('trans', 'Products'); ?></h1>
				<?php 
				if(!empty($listProducts)){
					foreach ($listProducts as $key => $productModel) {
						# code...											
	            		echo $this->renderPartial('../product/product_item' , array(
	            			'productModel' => $productModel,
	            			'uploadPath' => '/uploadFiles/product/',
	            			'language' => $language,
	            			'column' => 'col-md-4'
	        			));            		            	        		
					}
				}
				else{
					echo '<p><br/>'. Yii::t('trans', 'Product_not_found') .'</p>';
				}

				
				?>
			</div>
		</div>
	</div>
</div>