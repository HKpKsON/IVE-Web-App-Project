$(document).ready(function(){
	$('.formtoggle').parent().parent().next().hide();
	$('.formtoggle').parent().parent().next().next().hide();
	
	$('.formtoggle').on('click', function(){
		$(this).parent().parent().next().toggle("slow");
		$(this).parent().parent().next().next().toggle("slow");
		$(this).children().toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
	});
});