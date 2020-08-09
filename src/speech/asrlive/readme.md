
# Farsava - ASR live Api (WebSocket)

First create an `API KEY` [here](https://panel.amerandish.com/)

## install dependencies

```bash
composer i
```

## configs
```php
$baseUrl= 'wss://api.amerandish.com/v1';
$actionUrl= '/speech/asrlive';
$authKey= '<YOUR_API_KEY>';

$filePath = '<YOUR_WAV_FILE_PATH>';
```

## run

```bash
php index.php
```

