<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'DbConnect.php';
require_once 'RequestUrl.php';
require_once 'AmqLibConnect.php';

ini_set('display_errors', 1);

/**
 * 1) make ursl array
 */
$urls = [
    'https://example.com/',
    'https://www.youtube.com/watch?v=mWNm-CIbHv8',
    'https://2gis.kg/bishkek/geo/70030076170260091/74.619367%2C42.846491?m=74.625229%2C42.845397%2F15.28',
    'https://www.o.kg/kg/chastnym-klientam/',
    'https://formulae.brew.sh/formula/telnet',
    'https://www.lazyvim.org/keymaps',
    'https://symfony.com/doc/current/setup/docker.html',
    'https://docs.portainer.io/start/install-ce/server/docker/linux',
    'https://hub.docker.com/r/portainer/portainer/tags?page=1&ordering=-name',
    'https://hub.docker.com/layers/portainer/portainer/1.25.0/images/sha256-88166e7da037129e27df224f76954255309e7990517b220abd30f32eeb4fda78?context=explore'
];

echo "<html><head></head><body><pre>\n";
//var_dump($urls);


/**
 * 2) put urls to queue with delay
 */
$am = new  AmqLibConnect();

foreach ($urls as $url) {
//    $responseData = $this->execute($url);
//    $timeout = rand(5, 30); // Generate a random timeout between 5 and 30 seconds
    $timeout = rand(0, 1); // Generate a random timeout between 5 and 30 seconds
    sleep($timeout); // Sleep for the random timeout
    $am->send($url);
    echo $timeout."\n";
    // Output the result for each URL
//    echo "URL: " . $responseData['url'] . "\n";
//    echo "Response Length: " . $responseData['response_length'] . " bytes\n";
}

/**
 * 3) get urls from queue
 * and make request to urls -get content length
 * and save to db
 */
$resp = $am->get();

$curlRequest = new RequestUrl;
$curlRequest->makeRequestByUrlArrays($resp);

echo "</pre></body></html>\n";
//$con = new DbConnect();
//
//use PhpAmqpLib\Connection\AMQPStreamConnection;
//use PhpAmqpLib\Message\AMQPMessage;
//
//$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
//$channel = $connection->channel();
//
//foreach ($urls as $url) {
//    $message = new AMQPMessage($url);
//    $channel->basic_publish($message, '', 'urls_queue');
//
//    // Задержка от 5 до 30 секунд
//    sleep(mt_rand(5, 30));
//}
//
//$channel->close();
//$connection->close();
//
