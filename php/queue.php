<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'AmqLibConnect.php';
require_once 'DbConnectMaria.php';
require_once 'DbConnectClickHouse.php';

$maria = new DbConnectMaria();
$clickhouse = new DbConnectClickHouse();

$am = new  AmqLibConnect();

echo isset($_SERVER['REMOTE_ADDR']) ? "</pre></body></html>\n" : "";

$callback = function ($message) {
//    echo "Received: ", $message->body, "\n";
    $url = $message->body;
    $curlRequest = new RequestUrl;
    $curlResp = $curlRequest->execute($url);

    $time = microtime(true);
    $maria->create($curlResp['url'], $curlResp['response_length'], $time);
    $clickhouse->create($curlResp['url'], $curlResp['response_length'], $time);


};

$listen = $am->listen($callback);

while (count($listen->callbacks)) {
    $listen->wait();
}

echo isset($_SERVER['REMOTE_ADDR']) ? "</pre></body></html>\n" : "";

