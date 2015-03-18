<?php
include 'cloudBit.php';

echo "New Relic Error And Little Bits<br>";

$deviceId = 'XXX'; //cloudBit device id
$cloudKitKey = 'XXX'; //cloudBit seacret key
$appId = 90210; //new relic's application id
$relicKey = 'XXX'; // new relic's seacret key

$timePicker = 30; //time to measure error rate for (this is now - 30 minutes)
date_default_timezone_set('Asia/Jerusalem'); //set for your current timezone

$durationMillis = 30000;

$errorRate = getMetricFromRelic($relicKey, $appId, $timePicker);
sendToCloudBit($cloudKitKey, $deviceId, $durationMillis, $errorRate);

function getMetricFromRelic($relicKey, $appId, $timePicker){
	$errorURL = 'Errors/all&values[]=error_count';
	$countURL = 'HttpDispatcher&values[]=call_count';
	$otherTransactionsURL = 'OtherTransaction/all&values[]=call_count';
	$errorKey = 'error_count';
	$countKey = 'call_count';

	$nowMinus30 = strtotime("-$timePicker minutes");
	$startTimeDate = date('Y-m-d', $nowMinus30);
	$startTimeMinutes = date('h:i:s', $nowMinus30);
	$startTimeStr = "{$startTimeDate}T{$startTimeMinutes}+02:00";
	$now = time();
	$endTimeDate = date('Y-m-d', $now);
	$endTimeMinutes = date('h:i:s', $now);
	$endTimeStr = "{$endTimeDate}T{$endTimeMinutes}+02:00";

	$errorCount = getMetrics($relicKey, $errorURL, $appId, $errorKey, $startTimeStr, $endTimeStr);
	$callCount = getMetrics($relicKey, $countURL, $appId, $countKey, $startTimeStr, $endTimeStr);
	$otherTransactionsCount = getMetrics($relicKey, $otherTransactionsURL, $appId, $countKey, $startTimeStr, $endTimeStr);

	echo "Error Count: $errorCount<br>";
	echo "Call Count: $callCount<br>";
	$errorRate = 100 * $errorCount / ($callCount + $otherTransactionsCount);
	echo "The error rate is: $errorRate<br>";

	return $errorRate;
}

function getMetrics($relicKey, $url, $appId, $jsonKey, $start, $end){
	$url = "https://api.newrelic.com/v2/applications/$appId/metrics/data.JSON?names[]=$url&from=$start&to=$end&summarize=true";
	$opts = array(
			'http'=>array(
					'method'=>"GET",
					'header'=>"X-Api-Key: $relicKey\r\n" .
					"Accept: application/json\r\n"

			)
	);
	$context = stream_context_create($opts);
	$result = file_get_contents($url, false, $context);
	$json = json_decode($result,true);
	$count = $json['metric_data']['metrics'][0]['timeslices'][0]['values'][$jsonKey];
	return $count;
}


?>
