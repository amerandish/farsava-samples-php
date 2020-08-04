<?php
require __DIR__ . '/vendor/autoload.php';

$BUFFER_SIZE = 16000;

$baseUrl= 'wss://api.amerandish.com/v1';
$actionUrl= '/speech/asrlive';
$authKey= '<YOUR_API_KEY>';

$filePath = '<YOUR_WAV_FILE_PATH>';

$fileData = file_get_contents($filePath);

$url = $baseUrl.$actionUrl.'?jwt='.$authKey;

$request = curl_init($url);

$fileBase64 = base64_encode($fileData);

$socket = new WebSocket\Client($url);
for ($index=0; $index < strlen($fileBase64); $index+=$BUFFER_SIZE) {
    echo "sending ".$index." -> ".($index+$BUFFER_SIZE)."\n";
    if($index+$BUFFER_SIZE<strlen($fileBase64)){
        $socket->send(substr($fileBase64, $index, $BUFFER_SIZE),'binary');
    }else{
        $socket->send(substr($fileBase64, $index),'binary');
    }
}

while (true) {
    try {
        $message = $socket->receive();
        echo $message;
    } catch (\WebSocket\ConnectionException $e) {
        // Possibly log errors
        echo $e;
        $socket->close();
    }
}
$socket->close();

?>