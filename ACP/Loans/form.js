$(document).ready(function () {
	$('.toggle').parent().parent().next().hide();
	
	$('.toggle').on('click' ,function () {
		$(this).parent().parent().next().toggle("slow");
		$(this).children().toggleClass('glyphicon glyphicon-circle-arrow-down glyphicon glyphicon-circle-arrow-up');
	});
});