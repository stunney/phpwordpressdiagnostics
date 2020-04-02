<?php

//You may be having issues with getting plugins or connecting to *.wordpress.ORG from your linux box.
//1) Make sure your firewall is not interfering with outbout traffic
//2) Run the following 'sudo setsebool httpd_can_network_connect 1'
//3) If this doesn't work, get TCPDump and run this page.  Good luck.

$url = "https://api.wordpress.org/plugins/info/1.2/?action=query_plugins&request";
//$url = "https://developers.googleblog.com/2018/03/transitioning-google-url-shortener.html";

$defaults = array(
    CURLOPT_URL => $url,
    CURLOPT_HEADER => array('Content-Type: application/json;charset=utf-8', 'Accept: application/json;charset=utf-8'),
    CURLOPT_FOLLOWLOCATION => TRUE,
//    CURLOPT_HEADER => array('Content-Type: text/html; charset=UTF-8', 'Accept: text/html; charset=UTF-8'),
    CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPGET => TRUE,
    CURLOPT_TIMEOUT => 100
);

// Show all information, defaults to INFO_ALL
phpinfo();


echo "<h1>Hello World</h1>";
$ch = curl_init($url);
curl_setopt_array($ch, $defaults);
$info = curl_getinfo($ch);

foreach($info as &$val) {
    if(is_array($val)) {
        foreach($val as &$v2) {
            echo "<h4>" . $v2 . "</h4>";
        }
    }
    else {
        echo "<h3>" . $val . "</h3>";
    }
}

$results = curl_exec($ch);

if(!$results) {
    echo "<h1>Connection Failure!</h1>";
}

echo "<h2>" . $results . "</h2>";

curl_close($ch);


?>
