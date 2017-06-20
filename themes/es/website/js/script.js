var website_fn = {
	changeLanguage: function(){
		if(!$('.setLanguage').length) return;
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
	},
	categoryChangeLink: function(){
		if(!$('.cat-menu-link').length) return;
		$('.cat-menu-link').click(function(){
			var $this = $(this);

			if($this.hasClass('active')) return; 
			
			window.location = $this.data('href');
			return;
		});
	}
}
$( document ).ready(function() {

    website_fn.changeLanguage();

    website_fn.categoryChangeLink();
});