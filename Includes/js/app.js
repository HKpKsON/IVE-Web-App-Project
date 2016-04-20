$(document).ready(function(){
	// Date Section
	// Reference http://jsfiddle.net/ipr101/X9hyZ/
	var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun",
		"Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
	var dayNames= ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]

	var newDate = new Date();
	newDate.setDate(newDate.getDate());    
	$('.Date').html("<strong>" + dayNames[newDate.getDay()] + "</strong> " + monthNames[newDate.getMonth()] + ' ' + newDate.getDate() + ' ,' + newDate.getFullYear());

	// Top Weather DIV
	var getWeather = $.get( "http://api.openweathermap.org/data/2.5/weather?q=hk&units=metric&appid=13c81a68eb47d0441a26b3f74543f2c2", "json" );
	getWeather.done(function(data){
		var tempinc = data.main.temp;
		tempinc = parseFloat(tempinc).toFixed(0);
		
		var icon = data.weather[0].icon;
		var weather = data.weather[0].main;
		icon = '<img src="http://openweathermap.org/img/w/'+icon+'.png" alt="'+weather+'" title="'+weather+'" />';
		
		$('.Weather').html(icon+tempinc);
	});
	
	// Weather Box DIV
	function ForecastItem(date, icon, weather, tmin, tmax){
		// Get Data to Form a Weather Card
		var html = "";
		html += '<div class="fc-items"><div class="thumbnail">';
		html += '<img src="http://openweathermap.org/img/w/'+icon+'.png" alt="'+weather+'" title="'+weather+'" />';
		html += '<p class="h6 text-center">'+weather+'</p>';
		html += '<div class="text-center"><h3>'+date+'</h3>';
		html += '<p class="text-center">'+tmin+'°C - '+tmax+'°C</p>';
		html += '</div></div></div>';
		
		return html;
	}
	
	function dateConverter(UNIX_timestamp){
		// Convert UNIX Timestamp to Human Friendly Text
		var ipt = new Date(UNIX_timestamp * 1000);
		var month = ipt.getMonth()+1;
		var date = ipt.getDate();
		var time = date+'/'+month;
		
		return time;
	}
	
	if($('.Forecast').length > 0){
		var getForecast = $.get( "http://api.openweathermap.org/data/2.5/forecast/daily?q=HongKong&units=metric&cnt=16&appid=13c81a68eb47d0441a26b3f74543f2c2", "json" );
		getForecast.done(function(data){
			var html = "";
			
			for(var i=2; i < 14; i++){
				var weatherData = data.list[i].weather[0];
				var fcdate = data.list[i].dt;
				var tempData = data.list[i].temp;
				var fcdate = dateConverter(fcdate);
				
				html += ForecastItem(fcdate, weatherData.icon, weatherData.main, parseFloat(tempData.min).toFixed(0), parseFloat(tempData.max).toFixed(0));
			}
			
			$('.Forecast').html(html)
		});
	}
});