<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'AmqLibConnect.php';
require_once 'Repository.php';
require_once 'RequestUrl.php';

//$maria = new DbConnectMaria();
//$clickhouse = new DbConnectClickHouse();

$am = new  AmqLibConnect();

echo isset($_SERVER['REMOTE_ADDR']) ? "</pre></body></html>\n" : "";


$callback = function ($message) {
    echo "Received: ", $message->body, "\n";

    $url = $message->body;
    $db = new Repository();
    $curlRequest = new RequestUrl;
    $curlResp = $curlRequest->execute($url);

    $db->execute($curlResp);
};

$listen = $am->listen($callback);

while (count($listen->callbacks)) {
    $listen->wait();
}

echo isset($_SERVER['REMOTE_ADDR']) ? "</pre></body></html>\n" : "";

