<?php
function getTemperatureFor($city, $countryCode, $metricsInFahrenheit){
	echo "<h3>Yahoo Weather In Little Bit</h3>";
	$city = urlencode($city);
	$countryCode = urlencode($countryCode);
	
	$metricUrl="";
	if (!$metricsInFahrenheit){
		$metricUrl = urlencode(" and u='c'");
	}
	
	$yahooApiURL = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22$city%2C%20$countryCode%22)$metricUrl&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
	
	$jsonFromYahoo  = json_decode(file_get_contents($yahooApiURL),true);
	
	$tmp = $jsonFromYahoo['query']['results']['channel']['item']['condition']['temp'];
	
	echo "<h4>The temp is:$tmp </h4>";
	
	return $tmp;
}
?>
