/**
Function For PRODUCTS
**/

var product_fn = {    
    checkAllProduct: function (checked){    	
        $('input.cb_pro_checkbox').prop('checked', checked);        
    },
    deleteProducts: function(){
    	var countSelected = $('input.cb_pro_checkbox:checked').length;
    	if(!countSelected){
    		alert('Vui lòng chọn sản phẩm!');
    		return;
    	}
    	if(confirm('Bạn có chắc muốn xóa những sản phẩm này ??')){    		    		
    		//$.fn.yiiGridView.update('product-admin-grid');
    		//$('#overlay').show();    	
    		
		    $.ajax({
		        type: "POST",
		        url: _urlDeleteMultiProducts,
		        dataType : 'html',
		        data: $('#admin_product_form').serialize(),
		        success: function($response){
		        	$.fn.yiiGridView.update('product-admin-grid');
		            //$.fn.yiiGridView.update('user-grid');
		            //$('#overlay').hide();
		        },
		        error:function(){
		        	$('#overlay').hide();
		        }
		    });
		    
    	}
    },
    deletePhoto:function(element){
    	if(confirm('Bạn có chắc muốn xóa hình ảnh này?')){
    		var $thisPhoto = $(element),
    			$photoGrid = $thisPhoto.closest('.item-photo-grid'),
    			$photoID   = $photoGrid.data('id'),
				deletedPhotoIDs = $('#hd_productPhotoDeleted').val() + ',' + $photoID;
			
			$photoGrid.remove();
			$('#hd_productPhotoDeleted').val(deletedPhotoIDs);
    	}
    },
    addPhoto:function(){
    	var $htmlItemPhoto = '<div class="item-photo-row">'+
                                '<input type="file" name="ProductPhotos[]" accept="image/*">'+
                            '</div>';
		$('.item-photo-add-row').prepend($htmlItemPhoto);
    }
}