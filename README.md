# LittleBits-CoudBit-PHP-Wrapper
a Simple PHP wrapper for your cloudBit.

Sending commands to your cloudBit made easy with PHP function

Usage :

    <?php
    $cloudBitKey = 'YOUR-CLOUDBIT-KEY';
    $deviceId = 'YOUR-CLOUDBIT-ID';
    $durationInMillis = 6000; // max is 32000
    $value = 99; //(this is the value sent to the bit 0-100)
    sendToCloudBit($cloudBitKey, $deviceId, $durationInMillis, $value);
    
    //returns: "Little Bit said: OK" if no errors.

