$(document).ready(function(){
	
	// Get Today's Date, Reference: http://jsfiddle.net/ipr101/X9hyZ/
	var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun",
		"Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
	var dayNames= ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]

	var newDate = new Date();
	newDate.setDate(newDate.getDate() + 1);    
	$('#Date').html("<strong>" + dayNames[newDate.getDay()] + "</strong> " + monthNames[newDate.getMonth()] + ' ' + newDate.getDate() + ' ,' + newDate.getFullYear());

}); 