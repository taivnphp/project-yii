//<![CDATA[	
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
	},
	showHomeProducts:function(){
		if($('#horizontalTab').length){
			$('#horizontalTab').show();
		}
	},
	backToTop:function(){
		$('a.backToTop').click(function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});
	}
}
/* Window Scroll */
$(window).scroll(function(){
	if ($(this).scrollTop() > 100) {
		$('.backToTop').fadeIn();
	} else {
		$('.backToTop').fadeOut();
	}
});

$( document ).ready(function() {
	website_fn.backToTop();
    website_fn.changeLanguage();
    website_fn.categoryChangeLink();

    website_fn.showHomeProducts();
});

//]]>