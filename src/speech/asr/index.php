<?php

class Config {
    public $audioEncoding; //String
    public $sampleRateHertz; //int
    public $languageCode; //String
    public $maxAlternatives; //int
    public $profanityFilter; //boolean
    public $asrModel; //String
    public $languageModel; //String

    function __construct($audioEncoding,
            $sampleRateHertz,
            $languageCode,
            $maxAlternatives,
            $profanityFilter,
            $asrModel,
            $languageModel){
        $this->audioEncoding=$audioEncoding;
        $this->sampleRateHertz =$sampleRateHertz;
        $this->languageCode =$languageCode;
        $this->maxAlternatives =$maxAlternatives;
        $this->profanityFilter =$profanityFilter;
        $this->asrModel =$asrModel;
        $this->languageModel =$languageModel;
    }
}
class Audio {
    public $data; //String

    function __construct($data){
        $this->data = $data;
    }
}
class PayloadModel {
   public $config; //Config
   public $audio; //Audio
   function __construct($config, $audio){
    $this->config = $config;
    $this->audio = $audio;
    }
}


$baseUrl= 'https://api.amerandish.com/v1';
$actionUrl= '/speech/asr';
$authKey= '<YOUR_API_KEY>';

$filePath = '<YOUR_WAV_FILE_PATH>';

$fileData = file_get_contents($filePath);

$url = $baseUrl.$actionUrl;

$request = curl_init($url);

$config = new Config( "LINEAR16",16000,"fa",1,true,"default","general");
$audio = new Audio(base64_encode($fileData));
$payload = new PayloadModel($config, $audio);

curl_setopt($request, CURLOPT_HTTPHEADER, array(
    'Authorization: bearer '.$authKey,
));

curl_setopt($request, CURLOPT_POST, 1);

curl_setopt($request, CURLOPT_POSTFIELDS, json_encode($payload));

$response = curl_exec($request);

if(curl_error($request)) {
    fwrite($fp, curl_error($request));
}

curl_close($request);
?>