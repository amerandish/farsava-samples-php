<?php

$baseUrl= 'https://api.amerandish.com/v1';
$actionUrl= '/speech/healthcheck';
$authKey= '<YOUR_API_KEY>';

$url = $baseUrl.$actionUrl;

$request = curl_init($url);

curl_setopt($request, CURLOPT_HTTPHEADER, array(
    'Authorization: bearer '.$authKey,
));

$response = curl_exec($request);

if(curl_error($request)) {
    fwrite($fp, curl_error($request));
}

curl_close($request);
?>