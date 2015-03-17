<?php
function sendToCloudBit($cloudBitKey, $deviceId, $durationInMillis, $value){
	$url = "https://api-http.littlebitscloud.cc/v3/devices/$deviceId/output";
	$data = array('percent' => $value, 'duration_ms' => $durationInMillis);
	
	$options = array(
			'http' => array(
					'header'  => "Authorization: Bearer $cloudBitKey\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data),
			),
	);
	
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	
	echo "<br>Little Bit said: $result<br>";
}
?>
