<?php


require_once __DIR__ . '/vendor/autoload.php';
require_once 'AmqLibConnect.php';


$am = new  AmqLibConnect();


$callback = function ($message) {
    echo "Received: ", $message->body, "\n";
};

$listen = $am->listen($callback);

while (count($listen->callbacks)) {
    $listen->wait();
}

