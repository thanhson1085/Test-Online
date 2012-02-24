/**
 * Mon Feb 13, 2012 23:43:08 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */

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

	jQuery('#i-submit-form').submit(function(){
		
		if ( jQuery('input[name="yourname"]').val() == "" && jQuery('input[name="yourclass"]').val() == ""){
			jQuery('.q-message').html('Vui lòng nhập tên và lớp học của bạn!');
			jQuery('.q-message').fadeIn(300);
			//setTimeout("jQuery('#q-message').fadeOut(300)",10000)
			return false;
		}
	})
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
})



