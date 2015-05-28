# LittleBits-CloudBit-API-PHP-Wrapper

* a Simple PHP wrapper for your cloudBit API.
* Sending commands to your cloudBit made easy with PHP function
* intergration with Yahoo Weather API & New Relic

###Usage :
```php 
<?php
include 'cloudBit.php';
//send command to CloudBit example:
$cloudBitKey = 'YOUR-CLOUDBIT-KEY';
$deviceId = 'YOUR-CLOUDBIT-ID';
$durationInMillis = 6000; // max is 32000
$value = 99; //(this is the value sent to the bit 0-100)
sendToCloudBit($cloudBitKey, $deviceId, $durationInMillis, $value);

//send temp to cloudBit from Yahoo
include 'yahooWeather.php';
$city = "tel aviv";
$countryCode = "il";
$isFahrenheit = false;
$temp = getTemperatureFor($city, $countryCode, $isFahrenheit);
sendToCloudBit($cloudBitKey, $deviceId, $durationInMillis, $temp);

//get application error rate from relic to cloudbit
include 'newRelic.php';
$appId = 90210; //new relic's application id
$relicKey = 'XXX'; // new relic's secret key
$timePicker = 30; //time to measure error rate for (this is now - 30 minutes)
$errorRate = getMetricFromRelic($relicKey, $appId, $timePicker);
sendToCloudBit($cloudKitKey, $deviceId, $durationInMillis, $errorRate);
```

####more stuff - visit my blog : www.nimrodstech.com

