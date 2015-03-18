# LittleBits-CoudBit-PHP-Wrapper
a Simple PHP wrapper for your cloudBit.

Sending commands to your cloudBit made easy with PHP function & intergration with Yahoo Weather API

Usage :
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
$temp = getTemperatureFor($city, "$countryCode, $isFahrenheit);
sendToCloudBit($cloudBitKey, $deviceId, $durationInMillis, $temp);
```

