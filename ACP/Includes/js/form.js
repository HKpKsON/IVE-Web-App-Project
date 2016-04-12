$(document).ready(function(){
	$('.formtoggle').parent().parent().next().hide();
	$('.formtoggle').parent().parent().next().next().hide();
	
	$('.formtoggle').on('click', function(){
		$(this).parent().parent().next().toggle();
		$(this).parent().parent().next().next().toggle();
		$(this).children().toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
	});
});