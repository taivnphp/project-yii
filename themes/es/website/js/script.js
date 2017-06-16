var website_fn = {
	changeLanguage: function(){
		$('.setLanguage').click(function(){
			var $this = $(this);

			if($this.hasClass('active')) return; //Language is already set

			$.ajax({
		        type: "POST",
		        url: _urlChangeLanguage,
		        dataType : 'html',
		        data: {
		        	'lang' : $this.data('language')
		        },
		        success: function($response){		        			        
		        	location.reload();
		        },
		        error:function(){
		        	return;
		        }
		    });
			return;
		});
	}
}
$( document ).ready(function() {
    website_fn.changeLanguage();
});