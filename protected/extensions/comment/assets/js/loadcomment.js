
jQuery(document).ready(function($){
    function loadscroll(){
        if(item<=total && load==0){
             load=1;
             
             $('.show-more').find('img').remove();
             $('.show-more a').after('<img alt="loading" src="'+url+'/img/loader.gif">');
             $.ajax({
                type: "GET",
                url: ajaxLink+"="+item,
                success: function(data){
                    $('.new-item-comment > li:last').append($(data).find('.new-item-comment').html());
                    $('.show-more').find('img').remove();
                    $('.new-item-comment > li').tsort({data:'timestamp','order':'desc'}); 
                    item++;
                    load=0;
                },
                
                error: function(){
                 alert('Sorry! Load data error');
                 $('.show-more').find('img').remove();
             }
         });
             if(item==total){
               $('.show-more').find('a').remove();
           }
       }  
    }

    $('.show-more-item').on('click', function(){ 
        loadscroll();return false;
    });
}); 
