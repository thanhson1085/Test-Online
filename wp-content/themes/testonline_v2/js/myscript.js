/**
 * Mon Feb 13, 2012 23:43:08 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */

(function($) {

  jQuery.fn.extend({
    slimScroll: function(options) {

      var defaults = {
        wheelStep : 20,
        width : 'auto',
        height : '250px',
        size : '7px',
        color: '#000',
        position : 'right',
        distance : '1px',
        start : 'top',
        opacity : .4,
        alwaysVisible : false,
        railVisible : false,
        railColor : '#333',
        railOpacity : '0.2',
        railClass : 'slimScrollRail',
        barClass : 'slimScrollBar',
        wrapperClass : 'slimScrollDiv',
        allowPageScroll: false,
        scroll: 0
      };

      var o = ops = $.extend( defaults , options );

      // do it for every element that matches selector
      this.each(function(){

      var isOverPanel, isOverBar, isDragg, queueHide, barHeight, percentScroll,
        divS = '<div></div>',
        minBarHeight = 30,
        releaseScroll = false,
        wheelStep = parseInt(o.wheelStep),
        cwidth = o.width,
        cheight = o.height,
        size = o.size,
        color = o.color,
        position = o.position,
        distance = o.distance,
        start = o.start,
        opacity = o.opacity,
        alwaysVisible = o.alwaysVisible,
        railVisible = o.railVisible,
        railColor = o.railColor,
        railOpacity = o.railOpacity,
        allowPageScroll = o.allowPageScroll,
        scroll = o.scroll;
      
        // used in event handlers and for better minification
        var me = $(this);

        //ensure we are not binding it again
        if (me.parent().hasClass('slimScrollDiv'))
        {
            //check if we should scroll existing instance
            if (scroll)
            {
                //find bar and rail
                bar = me.parent().find('.slimScrollBar');
                rail = me.parent().find('.slimScrollRail');

                //scroll by given amount of pixels
                scrollContent( me.scrollTop() + parseInt(scroll), false, true);
            }

            return;
        }

        // wrap content
        var wrapper = $(divS)
          .addClass( o.wrapperClass )
          .css({
            position: 'relative',
            overflow: 'hidden',
            width: cwidth,
            height: cheight
          });

        // update style for the div
        me.css({
          overflow: 'hidden',
          width: cwidth,
          height: cheight
        });

        // create scrollbar rail
        var rail  = $(divS)
          .addClass( o.railClass )
          .css({
            width: size,
            height: '100%',
            position: 'absolute',
            top: 0,
            display: (alwaysVisible && railVisible) ? 'block' : 'none',
            'border-radius': 0,
            background: railColor,
            opacity: railOpacity,
            zIndex: 90
          });

        // create scrollbar
        var bar = $(divS)
          .addClass( o.barClass )
          .css({
            background: color,
            width: size,
            position: 'absolute',
            top: 0,
            opacity: opacity,
            display: alwaysVisible ? 'block' : 'none',
            'border-radius' : 0,
            BorderRadius: 0,
            MozBorderRadius: 0,
            WebkitBorderRadius: 0,
            zIndex: 99
          });

        // set position
        var posCss = (position == 'right') ? { right: distance } : { left: distance };
        rail.css(posCss);
        bar.css(posCss);

        // wrap it
        me.wrap(wrapper);

        // append to parent div
        me.parent().append(bar);
        me.parent().append(rail);

        // make it draggable
        bar.draggable({ 
          axis: 'y', 
          containment: 'parent',
          start: function() { isDragg = true; },
          stop: function() { isDragg = false; hideBar(); },
          drag: function(e) 
          { 
            // scroll content
            scrollContent(0, $(this).position().top, false);
          }
        });

        // on rail over
        rail.hover(function(){
          showBar();
        }, function(){
          hideBar();
        });

        // on bar over
        bar.hover(function(){
          isOverBar = true;
        }, function(){
          isOverBar = false;
        });

        // show on parent mouseover
        me.hover(function(){
          isOverPanel = true;
          showBar();
          hideBar();
        }, function(){
          isOverPanel = false;
          hideBar();
        });

        var _onWheel = function(e)
        {
          // use mouse wheel only when mouse is over
          if (!isOverPanel) { return; }

          var e = e || window.event;

          var delta = 0;
          if (e.wheelDelta) { delta = -e.wheelDelta/120; }
          if (e.detail) { delta = e.detail / 3; }

          // scroll content
          scrollContent(delta, true);

          // stop window scroll
          if (e.preventDefault && !releaseScroll) { e.preventDefault(); }
          if (!releaseScroll) { e.returnValue = false; }
        }

        function scrollContent(y, isWheel, isJump)
        {
          var delta = y;

          if (isWheel)
          {
            // move bar with mouse wheel
            delta = parseInt(bar.css('top')) + y * wheelStep / 100 * bar.outerHeight();

            // move bar, make sure it doesn't go out
            var maxTop = me.outerHeight() - bar.outerHeight();
            delta = Math.min(Math.max(delta, 0), maxTop);

            // scroll the scrollbar
            bar.css({ top: delta + 'px' });
          }

          // calculate actual scroll amount
          percentScroll = parseInt(bar.css('top')) / (me.outerHeight() - bar.outerHeight());
          delta = percentScroll * (me[0].scrollHeight - me.outerHeight());

          if (isJump)
          {
            delta = y;
            var offsetTop = delta / me[0].scrollHeight * me.outerHeight();
            bar.css({ top: offsetTop + 'px' });
          }

          // scroll content
          me.scrollTop(delta);

          // ensure bar is visible
          showBar();

          // trigger hide when scroll is stopped
          hideBar();
        }

        var attachWheel = function()
        {
          if (window.addEventListener)
          {
            this.addEventListener('DOMMouseScroll', _onWheel, false );
            this.addEventListener('mousewheel', _onWheel, false );
          } 
          else
          {
            document.attachEvent("onmousewheel", _onWheel)
          }
        }

        // attach scroll events
        attachWheel();

        function getBarHeight()
        {
          // calculate scrollbar height and make sure it is not too small
          barHeight = Math.max((me.outerHeight() / me[0].scrollHeight) * me.outerHeight(), minBarHeight);
          bar.css({ height: barHeight + 'px' });
        }

        // set up initial height
        getBarHeight();

        function showBar()
        {
          // recalculate bar height
          getBarHeight();
          clearTimeout(queueHide);

          // release wheel when bar reached top or bottom
          releaseScroll = allowPageScroll && percentScroll == ~~ percentScroll;

          // show only when required
          if(barHeight >= me.outerHeight()) {
            //allow window scroll
            releaseScroll = true;
            return;
          }
          bar.stop(true,true).fadeIn('fast');
          if (railVisible) { rail.stop(true,true).fadeIn('fast'); }
        }

        function hideBar()
        {
          // only hide when options allow it
          if (!alwaysVisible)
          {
            queueHide = setTimeout(function(){
              if (!isOverBar && !isDragg) 
              { 
                bar.fadeOut('slow');
                rail.fadeOut('slow');
              }
            }, 1000);
          }
        }

        // check start position
        if (start == 'bottom') 
        {
          // scroll content to bottom
          bar.css({ top: me.outerHeight() - bar.outerHeight() });
          scrollContent(0, true);
        }
        else if (typeof start == 'object')
        {
          // scroll content
          scrollContent($(start).position().top, null, true);

          // make sure bar stays hidden
          if (!alwaysVisible) { bar.hide(); }
        }
      });
      
      // maintain chainability
      return this;
    }
  });

  jQuery.fn.extend({
    slimscroll: jQuery.fn.slimScroll
  });

})(jQuery);
 function display(){ 
	if (milisec == 0 && seconds == 0){
		jQuery('#i-submit-form').submit();
	}
 if (milisec<=0){ 
    milisec=60
    seconds-=1 
 } 
 if (seconds<=-1){ 
    milisec=0 
    seconds+=1 
 } 
  else 
    milisec-=1 
	if (milisec < 10){
		milisecs = '0' + milisec;
	}
	else{
		milisecs = milisec;
	}
	 if (seconds < 10){
		second = '0' + seconds;
	}
	else{
		second = seconds;
	}
    jQuery('#clock').html(second+":"+milisecs); 
    setTimeout("display()",1000) 
}

var milisec=0 
var seconds;
var question_list="";
var current_question = 1;
var passed_list="<span> Những câu hỏi đã làm xong:</span>";

jQuery(document).ready(function($){
	//alert(jQuery('#max-time').html());

	/*jQuery('#i-submit-form').submit(function(){
		
		if ( jQuery('input[name="yourname"]').val() == "" && jQuery('input[name="yourclass"]').val() == ""){
			jQuery('.q-message').html('Vui lòng nhập tên và lớp học của bạn!');
			jQuery('.q-message').fadeIn(300);
			//setTimeout("jQuery('#q-message').fadeOut(300)",10000)
			return false;
		}
	})*/
	seconds = jQuery('#max-time').html(); 
//Timer
	
	//document.getElementById("clock").firstChild.nodeValue ='30' 
	if(typeof jQuery('#clock').attr('id') != 'undefined'){
		display(); 
	}
//end
	jQuery('.megamenu').each(function(){ 
		var found = jQuery(this).find('.column ul li');
		if(found.length == 0){
			var sub_menu = jQuery(this).find('.column h3');
			sub_menu.css('font-weight','normal');
		}
		found = jQuery(this).find('.s-current-menu');
		if(found.length != 0){
			var strsubmenu = jQuery(this).attr('id');
			var strparrentmenu = strsubmenu.replace('sub','');
			jQuery('#'+strparrentmenu).parent().attr('class','s-current-menu');
		}
	});
	
	jQuery('.d-page-container').css('height',jQuery(window).height());
	jQuery('#page').css('min-height',jQuery(window).height());

	jQuery('.d-page').css('top',jQuery(window).height()/2 - jQuery('.d-page').height()/2);
	jQuery('.tq-content-container .q-content-container').each(function(){ 
		jQuery(this).fadeIn(300);
		return false;
	});
	
	
	jQuery('.btn-next').click(function(){
		
		var oThis = jQuery(this).parent().parent();
		
		var oTrues = jQuery(this).parent().parent().find('.True input');
		var b = true;
		oTrues.each(function(){
			//var iTrue = jQuery(this).find('input');
			if (!jQuery(this).attr('checked')){
				//alert('thanh son');
				b = false;
			}
		});
		var oFalses = jQuery(this).parent().parent().find('.False input');
		var c = true;;
		oFalses.each(function(){
			//var iFalse = jQuery(this).find('input');
			if (jQuery(this).attr('checked')){
			
				c = false;
			}
		});
		var oTexts = jQuery(this).parent().parent().find('p input[type="text"]');
		var d = true;;
		oTexts.each(function(){
			var iP = jQuery(this).parent();
			if (jQuery(this).val().trim().toUpperCase() != iP.attr('class').trim().toUpperCase()){
				d = false;
			}
		});
		var oNext = jQuery(this).parent().parent().next('.q-content-container.notyet');
		if (b && c && d){
			jQuery('#i-message').css('display','none');
			oThis.css('display','none');
			if (typeof oNext.attr('class') !== 'undefined'){
				oNext.fadeIn(300);
				var i = jQuery('#true-answers').html();
				i++;
				jQuery('#i-passed-list').fadeIn(300);
				jQuery('#true-answers').html(i);
				oThis.attr('class','q-content-container true');
				oThis.find('input').attr('disabled','disabled');
				passed_list += '<span>'+jQuery('.'+oThis.attr('id')).html()+', </span>';
				jQuery('#i-passed-list').html(passed_list);
				current_question++;
				jQuery('#no-answers').html(current_question);
			
		
			}		
			else{
				var i = jQuery('#true-answers').html();
				i++;
				jQuery('#true-answers').html(i);
				oThis.attr('class','q-content-container true');
				oThis.find('input').attr('disabled','disabled');
				passed_list += '<span>'+jQuery('.'+oThis.attr('id')).html()+', </span>';
				jQuery('#i-passed-list').html(passed_list);
				var e = true;
				jQuery('.q-content-container.notyet').each(function(){
					
					jQuery('.q-content-container').css('display','none');
					jQuery(this).fadeIn(300);
					current_question = jQuery(this).attr('id').substring(7);
					jQuery('#no-answers').html(current_question);

					e = false;
					return;
				});
				if (e){
					jQuery('#i-message').css('display','none');
					jQuery('#i-message').html('Chúc mừng! Bạn đã hoàn thành bài kiểm tra.');
					jQuery('#i-message').fadeIn(1000);
				}
				//jQuery('#i-message').fadeOut(1000);
			}
		}
		else{
			jQuery('#i-message').css('display','none');
			jQuery('#i-message').html('Bạn trả lời chưa đúng! Vui lòng thử lại.');
			jQuery('#i-message').fadeIn(1000);
			//jQuery('#i-message').fadeOut(1000);
		}
	});
	jQuery('.btn-bypass').click(function(){
		var oThis = jQuery(this).parent().parent();
		oThis.css('display','none');
		var oNext = jQuery(this).parent().parent().next('.q-content-container.notyet');
		if (typeof oNext.attr('class') !== 'undefined'){
			jQuery('#i-message').css('display','none');
			oNext.fadeIn(300);
			current_question++;
			jQuery('#no-answers').html(current_question);
				
		}		
		else{
			jQuery('#i-message').css('display','none');
				var e = true;
				jQuery('.q-content-container.notyet').each(function(){
					
					jQuery('.q-content-container').css('display','none');
					jQuery(this).fadeIn(300);
					current_question = jQuery(this).attr('id').substring(7);
					jQuery('#no-answers').html(current_question);

					e = false;
					return;
				});
			
				if (e){
					jQuery('#i-message').css('display','none');
					jQuery('#i-message').html('Chúc mừng! Bạn đã hoàn thành bài kiểm tra.');
					jQuery('#i-message').fadeIn(1000);
				}
		}
	});
	var i = 0;
		jQuery('.q-content-container').each(function(){
		i ++;
		question_list += '<span class="'+jQuery(this).attr('id')+'">Câu '+i+'</span> ';	
		});
	jQuery('#i-question-list').html(question_list);
	jQuery('#i-question-list span').click(function(){
		jQuery('.q-content-container').css('display','none');
		jQuery('#'+jQuery(this).attr('class')).fadeIn(300);
		current_question = jQuery(this).attr('class').substring(7);
		jQuery('#no-answers').html(current_question);
		
	});
	jQuery('.wg-menu ul li div').click(function(){
		jQuery('.wg-menu ul li ul').hide(300);
		var ul_item = jQuery(this).parent().find('ul');
		ul_item.show(300);
	});
	$('#loadingDiv')
    .hide()  // hide it initially
    .ajaxStart(function() {
        $(this).show();
    })
    .ajaxStop(function() {
        $(this).hide();
    })
;
jQuery.post(ajax_link,{action: "MyAjaxFunction", paged: paged, modo: "ajaxget" },
function(data){ jQuery("#session-items").html(data); });

jQuery.post(ajax_link,{action: "get_ajax_question", paged: paged, modo: "ajaxget" },
function(data){ jQuery("#question-items").html(data); });

jQuery(".get-ajax-post").live("click", function(e) {
e.preventDefault();
var get_id = jQuery(this).attr("id");
var arr_id = get_id.split("_");
if (arr_id[0] == "classterm")
classterm_slug = arr_id[1];
if (arr_id[0] == "class")
class_slug = arr_id[1];
if (arr_id[0] == "subject")
subject_slug = arr_id[1];
if (arr_id[0] == "hiddenterm"){
	hidden_term_slug = arr_id[1];
}
else{
	hidden_term_slug = "all";
}
//alert(hidden_term_slug);
if( hidden_term_slug == "all"){
	var checked_item = jQuery(this).parent().parent().find("span.checked-item");
	checked_item.html(jQuery(this).html());
	jQuery.post(ajax_link,{ action: "MyAjaxFunction", subject: subject_slug, classterm: classterm_slug, class: class_slug, modo: "ajaxget" },
	function(data){ jQuery("#session-items").html(data); });
}
jQuery.post(ajax_link,{ action: "get_ajax_question",hidden_term: hidden_term_slug, subject: subject_slug, classterm: classterm_slug, class: class_slug, modo: "ajaxget" },
function(data){ jQuery("#question-items").html(data); });

});

// User Ajax
jQuery(".get-ajax-user").live("click", function(e) {
e.preventDefault();
var get_id = jQuery(this).attr("id");
var arr_id = get_id.split("_");

if (arr_id[0] == "class")
class_slug = arr_id[1];

jQuery.post(ajax_link,{ action: "get_ajax_user", class: class_slug, modo: "ajaxget" },
function(data){ jQuery("#user-items").html(data); });

});

// End
jQuery("div.paging a").live("click", function(e) {
	e.preventDefault();
	switch (jQuery(this).attr('class')){
		case "page-numbers":
			paged =  parseInt(jQuery(this).html());
			break;
		case "next page-numbers":
			paged++;
			break;
		case "prev page-numbers":
			paged--;
			break;
	}
	if ( jQuery(this).parent().attr("id") == "session-paging"){
		jQuery.post(ajax_link,
		{ action: "MyAjaxFunction",paged: paged, subject: subject_slug, classterm: classterm_slug, class: class_slug, modo: "ajaxget" },
		function(data){ jQuery("#session-items").html(data); });
	}
	if ( jQuery(this).parent().attr("id") == "question-paging"){
		jQuery.post(ajax_link,{ action: "get_ajax_question",paged: paged, hidden_term: hidden_term_slug, subject: subject_slug, classterm: classterm_slug, class: class_slug, modo: "ajaxget" },
		function(data){ jQuery("#question-items").html(data); });
	}
});

jQuery("#friend-list-menu li a").live("click", function(e) {
	e.preventDefault();
	var get_id = jQuery(this).attr("id");
	var arr_id = get_id.split("_");

	if (arr_id[0] == "user-class")
	class_slug = arr_id[1];
	alert(class_slug);

	jQuery.post(ajax_link,{ action: "get_ajax_user", class: class_slug, modo: "ajaxget" },
	function(data){ 
		jQuery("#mybox").html(data); 
		jQuery("#fade").fadeIn(100);
		jQuery("#mybox").fadeIn(300);
	});

});
jQuery("#fade").click(function(){
		jQuery("#fade").css("display","none");
		jQuery("#mybox").css("display","none");
		
});

jQuery(".user-info-detail").live("click", function(e) {
	e.preventDefault();
	var get_id = jQuery(this).attr("id");

	user_id = get_id;

	jQuery.post(ajax_link,{ action: "get_ajax_user_info", user_id: user_id, modo: "ajaxget" },
	function(data){
		$('#user-info').slimScroll({
					wheelStep : 10,
					opacity : .6,
					color: '#D0162D',
					width: '100%',
					height: $('#mybox').height(),
                    railVisible: true,
					alwaysVisible : true,
					railColor : '#D0162D',
     
		});	
		jQuery("#user-info").html(data); 

	});

});



			  
})




