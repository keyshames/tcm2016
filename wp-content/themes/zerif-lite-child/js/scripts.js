jQuery(document).ready(function($) {
	
	$('table.variations tbody tr').append("<button type='submit' class='single_add_to_cart_button button alt'>Add to cart</button>");
	$('.itemDesc p').append("&nbsp;&nbsp;<a class='toggleTxt'>Less</a>");
	$('.itemDesc p').after("<a class='toggleTxt'>More</a>");
	$('.itemDesc p').addClass('hideTxt');
	$('a[rel=tag]').removeAttr('href');
	$('.toggleTxt').click(function() {
		if( $( this ).prev('p').hasClass('hideTxt') ) {
			$( this ).prev('p').removeClass('hideTxt').addClass('showTxt');
			$( this ).hide();
		} else if ( $( this ).parent().hasClass('showTxt') ) {
			$( this ).parent().removeClass('showTxt').addClass('hideTxt');
			$( this ).parent().next('a').show();
		}
	});
		
	/*$('.showImg').click(function() {
		if( $(this).parent().hasClass('grdt') ) {
			$(this).parent().removeClass('grdt');
			$(this).nextUntil('div.grdt').hide();
		} else {
			$(this).parent().addClass('grdt');
			$(this).nextUntil('div.grdt').show();
		}
	});*/
	
	$('.hidePop').click(function() {
	  	$('#popWrap').css('display','none');
	});
	$('.products li').each(function() {
		if( $(this).hasClass('outofstock') ) {
			$(this).find('.value').attr('class', 'vote').html('<i>Want more of this item?&nbsp;<a class="showPop" style="padding-left:8px">Tell us!</a></i>');
			$(this).find('button').addClass('disable').attr('onclick', 'return false').html('Out Of Stock');
		}
	});
	$('.showPop').click(function() {
		$('#popWrap').css('display','block');
	});
	
	hideFilter=true;
	$("#filter-wrap").hide();
	$("#toggle-filter").click(function(){
		if(hideFilter==true) {
			$("#filter-wrap").show();
			hideFilter=false;
		} else {
			$("#filter-wrap").hide();
			hideFilter=true;
		}
	});
	
	$('[name="all"]').change(function(){
		if (this.checked) {
			$('.filter-ul [type="checkbox"]').not('[name="all"]').attr('checked',false);
		}
	});
	$('.filter-ul [type="checkbox"]').not('[name="all"]').change(function(){
		if (this.checked) {
			$('[name="all"]').attr('checked',false);
		}
	});



})