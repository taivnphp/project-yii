/**
 * START - ONLOAD - JS
 */
/* ----------------------------------------------- */
/* ------------- FrontEnd Functions -------------- */
/* ----------------------------------------------- */
/* SET AJAX GLOBAL */
var requestRunning=false;
$(document).ajaxStart(function() { 
    $('#cover').show();    
});
/**
  * JS Tooltip
  */
function FETooltip(objDisplay){
    if(!$(objDisplay).length) { return; }
    $(objDisplay).tooltip();
}
// --------------------------------------------------

/**
  * Funcion Account Popover
  */
function AccPopover(objCLK, objDL){
    if(!$(objCLK).length) { return; }

    $('.header-top-bar').on('click', objCLK, function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(objDL).fadeOut('3000');
        }else{
            $(this).addClass('active');
            $(objDL).fadeIn('3000');
        }
    });

    $(document).click(function(e){
        if($(e.target).is(objDL + " *") || $(e.target).is(objCLK + " *")) {return;}
        $(objCLK).removeClass('active');
        $(objDL).fadeOut('3000');
    }); 
}
// --------------------------------------------------

/**
  * Function Scroll Height
  */
function HomeAffix(){
    if ( $('.sub-sideba').length ) {return;}
    $('.sub-sidebar .blk').css({
        width : $('.sub-sidebar .blk').width()
    });
    $('.sub-sidebar .blk').affix({
        offset: {
            top : 300
        }
    });
    $('.sub-sidebar .blk').perfectScrollbar();
}
// --------------------------------------------------

/** 
  * Function Add Class For MacOS
  */
function AddClassMacOS(){
    if (navigator.userAgent.indexOf('Mac OS X') !== -1) {
      $("body").addClass("mac");
    }
}
// END : Function Add Class For MacOS

/**
  * ChoiceSharedObject
  * Choice Item Shared Object
  */
function ChoiceSharedObject () {
    $('.tree-list').each(function (i) {
        $(this).bonsai({ expandAll: true });
    });
}

/**
  * ChangeIconCollapse
  * Change icon plus or minus when click
  */
function ChangeIconCollapse () {
    $('.contentpanel').on('click', '.cl-plus', function () {
        var $a_this = $(this),
            $a_icon = $a_this.find('.fa');

        if($a_this.hasClass('cl-active')) {
            $a_this.removeClass('cl-active');
            $a_icon.removeClass('fa-minus');
            $a_icon.addClass('fa-plus');
        } else {
            $a_this.addClass('cl-active');
            $a_icon.addClass('fa-minus');
            $a_icon.removeClass('fa-plus');
        }
    });
}
/**
  * fastFilterMGroup
  * Search filter Measure Group
  */
function fastFilterMGroup () {
    $('.m-group-wrap').liveFilter('.search-group', 'ol', {
      filterChildSelector: 'ol'
    });

    $(".search-group").keyup(function(){
        var filter = $(this).val();

        // Expand result
        $(".m-group-wrap li.has-children").each(function(){
            $(this).removeClass('collapsed');
            $(this).addClass('expanded');
            $(this).find('.bonsai').css('height','auto');
        });
    });
}

/**
  * MeasureExorCol
  * Function Click Expand All or Collapse All
  */
function MeasureExorCol () {
    $('.contentpanel').on('click', '.m-tool > a', function () {
        var $a_click  = $(this),
            $a_parent = $a_click.closest('.m-tool'),
            $a_list   = $a_parent.siblings('.tree-list');

        if($a_click.hasClass('m-open')) {
            // Active button
            $a_click.addClass('m-active');
            $a_click.next('a').removeClass('m-active');

            // Close or Open Measure List
            $a_list.find('.has-children').removeClass('collapsed');
            $a_list.find('.has-children').addClass('expanded');
            $a_list.find('.bonsai').css('height','auto');
        } else {
            // Active button
            $a_click.addClass('m-active');
            $a_click.prev('a').removeClass('m-active');
            // Close or Open Measure List
            $a_list.find('.has-children').addClass('collapsed');
            $a_list.find('.has-children').removeClass('expanded');
            $a_list.find('.bonsai').css('height','0px');
        }
    });
}

/**
  * EventClickEnable
  * Function click on / off enable For Batchs/ Jobs......
  */
function EventClickEnable () {
    if(!$('.enable-click').length) { return; }
    $('.contentpanel').on('off', '.enable-click');
    $('.contentpanel').on('click', '.enable-click', function () {
        var $a_click = $(this);
        var $parent  = $a_click.parent();
        var value = 0;
        // check on / off
        if($a_click.hasClass('on')) {
            $a_click.removeClass('on');
            $a_click.text('off');
            value = 0;
        } else {
            $a_click.addClass('on');
            $a_click.text('on');
            value = 1;
        }
        
        if($parent.find('.on_of_value').length > 0){
            $parent.find('.on_of_value').val(value);
        }
        
        
        //Quick update flag
        var $data_id = $a_click.data('id');    
        var $data_type = $a_click.data('type');    
        if(typeof $data_id !== typeof undefined && typeof $data_type !== typeof undefined){
           
            if($data_type == 'batch'){
                _url = _urlQuickEnabledFlagBatch;
            }
            else{
                _url = _urlQuickEnabledFlagJob;
            }            
            $.ajax({
                type : 'POST',        
                url  : _url, 
                data : {
                    'id'     : $data_id,
                    'status' : value
                },       
                dataType: 'html',
                success: function() {                    
                    //EventClickEnable();
                }
            });
        }        
        
    });
}


/**
  * ClearValInput
  * Clear value input if string
  */
function ClearValInput () {    
    $( ".obj-shred-calendar input[type=text]" ).focus(function() {
        var $this   =   $(this),
            $val    =   $this.val();
                
        var d = new Date($val);
        var $check = !isNaN(d.valueOf());        
        if($check == false) {
            $this.val("");
        }
    });
}reloadForm

/**
  * UsedEditor
  */
function UsedEditor (textarea, div_toolbar) {
    var obj  = '#' + textarea;
    if(!$(obj).length) { return; }
    
    var editor = new wysihtml5.Editor( textarea , {
        toolbar:  div_toolbar   ,
        stylesheets:  _editor_css_url,
        parserRules:  wysihtml5ParserRules
      });
}


function reloadForm(){
    if(confirm('Are you sure?')){
        location.reload();
    }
}

var allpage_js = {};
(function( $ ) { 
    
            
    allpage_js.scrollBar = function (objScroll) {
        
        if(!$(objScroll).length) { return; }
        
        $(objScroll).perfectScrollbar();
    };
    
    /**
    * 9. Set Height For Nav Menu
    */
   allpage_js.setHeightMenu = function () {
       var $w_height   =   $(window).height() - 60;
       $('.main .lft-nav-inner').css('height', $w_height);       
   };
   
   allpage_js.removeMenuTooltip = function(){
       $('.main .left-nav').find('li')
        .removeClass('left-tooltip')
        .removeAttr('data-toggle')
        .removeAttr('data-placement');
   };
   
   allpage_js.closeAppendPopUp = function () {        
        $('body').on('click', '.cls-ms-append', function (e) {  
            
            e.preventDefault();
            var $a_close 		=	$(this),
            $body			=	$('body'),
            $dashboard		=	$body.find('.m-db-append');            
                        
            $body.removeClass('ms-body');
            $dashboard.hide();     
            $dashboard.find('.blk').empty();
        });
    };
   
})(jQuery);


/* ----------------------------------------------- */
/* ----------------------------------------------- */
/* OnLoad Page */
jQuery(document).ready(function($){    
    allpage_js.removeMenuTooltip();
    allpage_js.setHeightMenu ();
    allpage_js.scrollBar('.main .lft-nav-inner');   
                    
    allpage_js.closeAppendPopUp();                    
    // Tooltip : MAIN MENU LEFT SIDE BAR
    //FETooltip('.left-tooltip');
        
    // POPover : Top bar - User Admin
    AccPopover('.user-admin','.profile-popup');	
    
    //HomeAffix();
    // Add Class MacOS
    AddClassMacOS();            
    EventClickEnable();    
            
    
});
/* OnLoad Window */
var init = function () {    
};
//window.onload = init;
/* -------------------------------------------------- */
$( document )
    .ajaxStop(function()  {$('#cover').hide();})
    .ajaxError(function() {
        $('#cover').hide();
       // location.reload();
    });